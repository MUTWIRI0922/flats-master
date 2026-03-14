<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class AuthController extends Controller
{
    //registration of new landlord/agent
    public function register(Request $request)
    {
        //validation of form data
        $validatedData = $request->validate(
            [
                'first_name'=> 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:User',
                'phone' => 'required|integer|min:10|max:12|unique:User',
                'password' => 'required|string|min:8|confirmed',

            ],[
                'email.unique' => 'The email is already registered.',
                'phone.unique' => 'The phone number is already in use.',
            ]
        );

        $validatedData['password'] = bcrypt($validatedData['password']);
        //saving to database
        try{
            User::Create($validatedData);
            return back()->with('success','Successifuly registered. Proceed to login.');
        } catch(\Exception $err)
        {
            //throw $err;
            return back()->with('error','We could not register you, please try again')->withInput();
        }
    }

    //update of landlord/agent details
    public function update(Request $request, $id){
        $user = User::find($id);
        if(!$user){
            abort(404);
        }
        $validatedData = $request->validate(
        [
            'first_name'=> 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:User',
            'phone' => 'required|integer|min:10|max:12|unique:User',

        ],[
            'email.unique' => 'The email is already registered.',
            'phone.unique' => 'The phone number is already in use.',
        ]
        );
        try{
            $user = User::update($validatedData);
            return back()->with('success', 'User updated successfully');
        } catch(\Exception)
        {
            return back()->with('error', 'We could not update your details. Please try again.')->withInput();
        }


    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Authentication passed
            Auth::login($user);
            // You can set session or token here as per your requirement
            if ($user->is_agent){
                return redirect()->route('/agent')->with('success', 'Login successful.');
            } elseif ($user->is_admin) {
                return redirect()->route('/admin')->with('success', 'Login successful.');
            }
            else{
                return redirect()->route('/tenant')->with('success', 'Login successful.');
            }
            
        } else {
            return back()->with('error','Invalid credentials.')->withInput();
        }
    }   
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('/')->with('success', 'Logged out successfully.');
    }
}
