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

        //generate random password for tenant
        function getRandomString($length = 10){
            return bin2hex(random_bytes($length / 2));
        }
        $pword = getRandomString();
        $validatedData['owner_id'] = $owner_id;
        $validatedData['password'] = bcrypt($pword);

        try {
            $tenant = User::create($validatedData);
             // Send email to the tenant with their login details
            $to_email = $validatedData['email'];
            $subject = "Your Login Details";
            $body = "Dear " . $validatedData['first_name'] . ",\n\nYour account has been created. Here are your login details:
            \n\nEmail: " . $validatedData['email'] . "\nPassword: " . $pword . "
            \n\nPlease log in and change your password as soon as possible.
            \n\nBest regards,\n" . config('app.name');
            mail($to_email, $subject, $body);
             return response()->json([
                'message' => 'Tenant created successfully',
                'tenant' => $tenant
            ], 201);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during tenant creation
            return response()->json([
                'message' => 'Failed to create tenant',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $tenant = User::find($id);
        return[
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
        return[
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
        if(!$tenant){
            return response()->json([
                'message' => 'Tenant not found'
            ], 404);
        }
        //validate form data
        $validatedData = request()->validate(
            [
                'first_name'=> 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:User,email,'.$tenant->id,
                'phone' => 'required|integer|min:10|max:12|unique:User,phone,'.$tenant->id,

            ],[
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
        if(!$tenant){
            return response()->json([
                'message' => 'Tenant not found'
            ], 404);
        }
        //check if tenant belongs to the landlord/agent
        if($tenant->owner_id != $owner_id){
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
