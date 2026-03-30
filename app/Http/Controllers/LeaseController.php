<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use App\Models\User;
use App\Models\Property;
use App\Models\Unit;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $property)
    {
        //list of all leases for a property
        $property = Property::find($property)->with('units')->first();
        if(!$property){
            abort(404);
        }
        $leases = Lease::where('unit_id', $property->units->pluck('id'))->get();
        return[
            'leases' => $leases
        ];

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($owner_id, $tenant_id)
    {
        $properties = Property::where('owner_id', $owner_id)->with('units')->where('status', 'available')->get();
        $tenant = User::find($tenant_id)->first();
        return[
            'properties' => $properties,
            'tenant' => $tenant
        ];
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'property_id' => 'required|integer',
            'unit_id' => 'required|integer',
            'tenant_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
        try{
            $lease = Lease::create(
                [
                    'property_id' => $validatedData['property_id'],
                    'unit_id' => $validatedData['unit_id'],
                    'tenant_id' => $validatedData['tenant_id'],
                    'start_date' => $validatedData['start_date'],
                    'status' => 'active',
                    
                ]
            );
             // Update unit status to occupied
             $unit = Unit::find($validatedData['unit_id']);
             $unit->status = 'occupied';
             $unit->save();
            
            return response()->json([
                'message' => 'Lease created successfully',
                'lease' => $lease
            ], 201);
        } catch(\Exception $err)
        {
            //throw $err;
            return back()->with('error','We could not create the lease, please try again')->withInput();
        }
        $lease = Lease::create($validatedData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lease $id)
    {
        //lease details
        $lease = Lease::find($id);
        return[
            'lease' => $lease
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lease $id)
    {
        //
            $lease = Lease::find($id);
            return[
                'lease' => $lease
            ];

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lease $lease)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lease $id)
    {
        //
        $lease = Lease::find($id);
        $lease->delete();
        return response()->json([
            'message' => 'Lease deleted successfully'
        ], 200);

    }
}
