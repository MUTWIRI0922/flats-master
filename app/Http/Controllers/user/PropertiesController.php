<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Lease;
use App\Models\Property;
use App\Models\Tenants;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //list of all properties for a landlord/agent
        $user_id = session()->get('owner_id');
        $properties = Property::where('owner_id', $user_id)->with('units')->get();
        return view('user.properties', [
            'properties' => $properties
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate the request
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:properties',
            'location' => 'required|string|max:255',
            'amenities' => 'nullable|string',
        ]);
        $validatedData['owner_id'] = session()->get('owner_id');
        $validatedData['status'] = 'active';

        //create the property
        try{
            Property::create($validatedData);
            return redirect()->route('user.properties')->with('success','Property created successfully');
        } catch(\Exception $err)
        {
            //throw $err;
            return redirect()->route('user.properties')->with('error','We could not create the property, please try again'); 
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //fetch the property with its units and owner details
        $property = Property::with(['units', 'owner'])->find($id);
        return response()->json([
            'property' => $property
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //find property
        $property = Property::findorfail($id);
        return response()->json([
            'property' => $property
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        //check if the property exists
        $property = Property::find($id);
        if(!$property){
            return redirect()->route('user.properties')->with('error','Cannot find the property');
        }
        //validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'amenities' => 'nullable|string',
        ]);
        //update the property
        try{
            $property->update($validatedData);
            return redirect()->route('user.properties')->with('success','Property updated successfully');
        } catch(\Exception $err)
        {
            //throw $err;
            return redirect()->route('user.properties')->with('error','We could not update the property, please try again'); 
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //check if the property exists
        $property = Property::find($id);
        if(!$property){
            return response()->json([
                'message' => 'Property not found'
            ], 404);
        }
        $owner_id = session()->get('owner_id');
        //check if the property belongs to the landlord/agent
        if($property->owner_id != $owner_id){
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }
        //delete the property
        $property->delete();
        return redirect()->route('user.properties')->with('success','Property deleted successfully');

    }
    public function property_tenants(string $id)
    {
        $property = Property::findorfail($id);
        abort_unless((string) $property->owner_id === (string) session()->get('owner_id'), 403);

        $tenants = Tenants::whereHas('leases.unit', function ($query) use ($id) {
            $query->where('property_id', $id);
        })->with([
            'leases' => function ($query) use ($id) {
                $query->whereHas('unit', function ($query) use ($id) {
                    $query->where('property_id', $id);
                })->with('unit');
            },
        ])->get();

        return view('user.properties.proptenants', compact('property', 'tenants'));
    }
    public function property_units(string $id)
    {
        $property = Property::findorfail($id);
        abort_unless((string) $property->owner_id === (string) session()->get('owner_id'), 403);
        $units = Unit::where('property_id',$id)->paginate(10);

        return view('user.properties.units', compact('property', 'units'));
    }    
}
