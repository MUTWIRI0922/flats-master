<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenants;
use App\Models\Property;
use App\Models\User;
use App\Models\Lease;
use App\Models\Unit;
use App\Services\LeaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\TenantWelcome;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owner_id = session()->get('owner_id');
        //list of all tenants for a landlord/agent
        $tenants = Tenants::where('owner_id', $owner_id)->with('leases')->orderBy('created_at', 'desc')->paginate(15);
        return view('user.tenants', compact('tenants', 'owner_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, string $owner_id)
    {
        $properties = Property::where('owner_id', $owner_id)->with('units')->get();
        //show form to add a new tenant
        return view('user.tenants.add', compact('owner_id', 'properties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $owner_id, LeaseService $leaseService)
    {

        //validate form data
        $validatedData = $request->validate(
            [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:Tenants',
                'phone' => 'required|string|unique:Tenants',
                'property_id' => 'required|exists:properties,id',
                'unit_id' => [
                    'required',
                    Rule::exists('units', 'id')
                        ->where('property_id', $request->input('property_id'))
                        ->where('status', 'available'),
                ],

            ],
            [

                'email.required' => 'Email is required',
                'phone.required' => 'Phone number is required',
                'email.unique' => 'The email is already registered.',
                'phone.unique' => 'The phone number is already in use.',
                'unit_id.exists' => 'The selected unit is not available for this property.',
            ]
        );
        $validatedData['owner_id'] = $owner_id;
        $validatedData['role'] = 'Tenant';
        // Generate a one-time password for the tenant.
        $pword = bin2hex(random_bytes(5));

        $validatedData['password'] = bcrypt($pword);

        try {
            $result = DB::transaction(function () use ($validatedData, $leaseService) {
                $unit = Unit::where('property_id', $validatedData['property_id'])
                    ->where('status', 'available')
                    ->lockForUpdate()
                    ->findOrFail($validatedData['unit_id']);

                $tenant = Tenants::create(Arr::only($validatedData, [
                    'first_name',
                    'last_name',
                    'email',
                    'phone',
                    'owner_id',
                    'password',
                ]));

                $leaseService->createForTenant($tenant, $unit);

                return compact('tenant', 'unit');
            });
            $tenant = $result['tenant'];
            $unit = $result['unit'];
            // Send email to the tenant with their login details
            $property = Property::find($validatedData['property_id']);
            Mail::to($validatedData['email'])->queue(new TenantWelcome($tenant, $property, $unit, $pword));
            return redirect()->route('user.tenants')->with('success', 'Tenant created successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during tenant creation
            return redirect()->route('user.tenants')->with('error', 'Failed to create tenant');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $owner_id = session()->get('owner_id');
        $tenant = Tenants::find($id);
        if (!$tenant) {
            return redirect()->back()->with('error', 'Tenant not found')->withInput();
        } else if ($tenant->owner_id != $owner_id) {
            return redirect()->back()->with('error', 'You cannot view this tenant')->withInput();
        }
        return view('user.tenants.view', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $owner_id = session()->get('owner_id');
        //get tenant details for editing
        $tenant = Tenants::find($id);
        if (!$tenant) {
            return redirect()->back()->with('error', 'Tenant not found')->withInput();
        } else if ($tenant->owner_id != $owner_id) {
            return redirect()->back()->with('error', 'Unauthorized')->withInput();
        }
        return view('user.tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $owner_id = session()->get('owner_id');
        //cehck if tenant exists
        $tenant = Tenants::find($id);

        if (!$tenant) {
            return redirect()->back()->with('error', 'Tenant not found')->withInput();
        } else if ($tenant->owner_id != $owner_id) {
            return redirect()->back()->with('error', 'Unauthorized')->withInput();
        }
        //validate form data
        $validatedData = request()->validate(
            [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:Tenants,email,' . $tenant->id,
                'phone' => 'required|string|unique:Tenants,phone,' . $tenant->id,

            ],
            [
                'email.email' => 'The email must be a valid email address.',
                'last_name.string' => 'The last name must be a string.',
                'first_name.string' => 'The first name must be a string.',
                'phone.string' => 'The phone number must be a valid string.',
                'email.unique' => 'The email is already registered.',
                'phone.unique' => 'The phone number is already in use.',
            ]
        );
        //update tenant details
        try {
            $tenant->update($validatedData);
            return redirect()->route('user.tenants')->with('success', 'Tenant updated successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during tenant update
            return redirect()->back()->with('error', 'Failed to update tenant')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $owner_id = session()->get('owner_id');
        //
        $tenant = Tenants::find($id);
        if (!$tenant) {
            return redirect()->back()->with('error', 'Tenant not found')->withInput();
        }
        //check if tenant belongs to the landlord/agent
        if ($tenant->owner_id != $owner_id) {
            return redirect()->back()->with('error', 'Unauthorized')->withInput();
        }
        try {
            $result = DB::transaction(function () use ($tenant, $id) {
                //set the unit status to available
                $lease = Lease::where('tenant_id', $id)->first();
                if ($lease) {
                    $unit = Unit::find($lease->unit_id);
                    if ($unit) {
                        $unit->status = 'available';
                        $unit->save();
                    }
                    $lease->status = 'terminated';
                    $lease->save();
                }
                $tenant->delete();
            });
            if ($result) {
                return redirect()->back()->with('success', 'Tenant deleted successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to delete tenant');
            }
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during tenant deletion
            return redirect()->back()->with('error', 'Failed to delete tenant');
        }       

    }
}
