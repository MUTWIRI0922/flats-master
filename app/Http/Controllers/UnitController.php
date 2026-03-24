<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $property_id)
    {
        //get all units for a property
        $units = Unit::where('property_id', $property_id)->get();
        return response()->json([
            'units' => $units
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
    public function store(Request $request, string $property_id)
    {
        //validate form data
        $validatedData = $request -> validate([
            'unit_number' => 'required|string|max:255',
            'rent_amount' => 'required|numeric',
            'unit_class' => 'required|string'
        ]);
        $validatedData['property_id'] = $property_id;
        try{
            $unit = Unit::create($validatedData);
            return response()->json([
                'message' => 'Unit created successfully',
                'unit' => $unit
            ], 201);
        } catch(\Exception $err) {
            return response()->json([
                'message' => 'We could not create the unit, please try again'
            ], 500);
        }



    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit_id)
    {
        $unit = Unit::find($unit_id);
        return response()->json([
            'unit' => $unit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($unit_id)
    {
        //fetch the unit details for editing
        $unit = Unit::find($unit_id);
        if(!$unit){
            abort(404);
        }
        return response()->json([
            'unit' => $unit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $unit_id)
    {
        //validate the request
        $validatedData = $request->validate([
            'unit_number' => 'required|string|max:255',
            'rent_amount' => 'required|numeric',
            'unit_class' => 'required|string',

        ]);
        //update the unit details
        try{
            $unit = Unit::find($unit_id);
            if(!$unit){
                abort(404); 
            }
            $unit->update($validatedData);
            return response()->json([
                'message' => 'Unit updated successfully',
                'unit' => $unit
            ]); 
        } catch(\Exception $err) {
            return response()->json([
                'message' => 'We could not update the unit details, please try again'
            ], 500);
        }
    }


     //Remove the specified resource from storage.

    public function destroy(Unit $unit)
    {
        //
    }
}
