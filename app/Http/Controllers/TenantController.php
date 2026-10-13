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
use Illuminate\Support\Arr;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = session()->get('owner_id');
        //list of all tenants for a landlord/agent
        $tenants = Tenants::where('owner_id', $user_id)->with('leases')->paginate(15);
        return view('user.tenants', compact('tenants'));
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
                'unit_id' => 'required|exists:units,id',

            ], [
                'email.required' => 'Email is required',
                'phone.required' => 'Phone number is required',
                'email.unique' => 'The email is already registered.',
                'phone.unique' => 'The phone number is already in use.',
            ]
        );           
        $validatedData['owner_id'] = $owner_id;
        $validatedData['role'] = 'Tenant';
        //generate random password for tenant
        function getRandomString($length = 10)
        {
            return bin2hex(random_bytes($length / 2));
        }
        $pword = getRandomString();

        $validatedData['password'] = bcrypt($pword);
        
        try {
            $tenant = DB::transaction(function () use ($validatedData, $leaseService) {
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
            });
            // Send email to the tenant with their login details
                $to_email = $validatedData['email'];
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
        //
        $tenant = User::find($id);
        return [
            'tenant' => $tenant
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get tenant details for editing
        $tenant = User::find($id);
        return [
            'tenant' => $tenant
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //cehck if tenant exists
        $tenant = User::find($id);
        if (!$tenant) {
            return response()->json([
                'message' => 'Tenant not found'
            ], 404);
        }
        //validate form data
        $validatedData = request()->validate(
            [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:User,email,'.$tenant->id,
                'phone' => 'required|integer|min:10|max:12|unique:User,phone,'.$tenant->id,

            ], [
                'email.unique' => 'The email is already registered.',
                'phone.unique' => 'The phone number is already in use.',
            ]);
        //update tenant details
        try {
            $tenant->update($validatedData);
            return response()->json([
                'message' => 'Tenant updated successfully',
                'tenant' => $tenant
            ], 200);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during tenant update
            return response()->json([
                'message' => 'Failed to update tenant',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $owner_id)
    {
        //
        $tenant = User::find($id);
        if (!$tenant) {
            return response()->json([
                'message' => 'Tenant not found'
            ], 404);
        }
        //check if tenant belongs to the landlord/agent
        if ($tenant->owner_id != $owner_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        //delete tenant
        $tenant->delete();
        return response()->json([
            'message' => 'Tenant deleted successfully'
        ], 200);
    }
}
