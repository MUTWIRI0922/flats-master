<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lease;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( string $owner_id)
    {
        //list of all tenants for a landlord/agent
        $tenants = User::where('owner_id', $owner_id)->get();
        return[
            'tenants' => $tenants
        ];
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
        //validate form data
        $validatedData = $request->validate(
            [
                'first_name'=> 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:User',
                'phone' => 'required|integer|min:10|max:12|unique:User  ',

            ],[
                'email.unique' => 'The email is already registered.',
                'phone.unique' => 'The phone number is already in use.',
            ]);
        $validatedData['owner_id'] = $owner_id;
        $validatedData['password'] = bcrypt('password');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
