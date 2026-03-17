<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $owner_id)
    {
        //list of all properties for a landlord/agent
        $properties = Property::where('owner_id', $owner_id)->get   ();
        return response()->json([
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
    public function store(Request $request, string $owner_id)
    {
        //validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'amenities' => 'nullable|string',
        ]);
        $validatedData['owner_id'] = $owner_id;
        $validatedData['status'] = 'available';
        //create the property
        try{
            $property = Property::create($validatedData);
            return response()->json([
                'message' => 'Property created successfully',
                'property' => $property
            ], 201);
        } catch(\Exception $err)
        {
            //throw $err;
            return back()->with('error','We could not create the property, please try again')->withInput(); 
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
    public function edit(Property $property)
    {
        //find property
        $property = Property::find($property);
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
            return response()->json([
                'message' => 'Property not found'
            ], 404);
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
            return response()->json([
                'message' => 'Property updated successfully',
                'property' => $property
            ]);
        } catch(\Exception $err) {
            return response()->json([
                'message' => 'We could not update the property, please try again'
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $owner_id)
    {
        //check if the property exists
        $property = Property::find($id);
        if(!$property){
            return response()->json([
                'message' => 'Property not found'
            ], 404);
        }

        //check if the property belongs to the landlord/agent
        if($property->owner_id != $owner_id){
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }
        //delete the property
        $property->delete();
        return response()->json([
            'message' => 'Property deleted successfully'
        ]);
    }
}
