<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
            return redirect()->route('/login')->with('success','Successifuly registered. Proceed to login.');
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
            return[
                'user' => $user
            
            ];
            // You can set session or token here as per your requirement
            if ($user->is_agent){
                return redirect()->route('/agent')->with('success', 'Login successful.')->compact('user');
            } elseif ($user->is_admin) {
                return redirect()->route('/admin')->with('success', 'Login successful.')->compact('user');
            }
            else{
                return redirect()->route('/tenant')->with('success', 'Login successful.')->compact('user');
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
    public function sendOTP(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::where('email', $validatedData['email'])->first();
        if (!$user) {
            return back()->with('error', 'No user found with that email address.')->withInput();
        }

        // Generate OTP and send to user's email
        $otp = rand(100000, 999999);
        // Store OTP and expiry in session
        session([
            'otp'            => $otp,
            'otp_email'      => $request->email,
            'otp_expires_at' => now()->addMinutes(5),
        ]);
        Mail::raw("Your OTP for password reset is: $otp. The otp will expire in 5 minutes.", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Password reset OTP Code');
        });
        return back()->with('success', 'OTP sent to your email address.');
    }
    public function verifyOTP(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'otp' => 'required|integer',
        ]);
    
        if (session('otp_email') !== $validatedData['email'] || session('otp') !== $validatedData['otp'] || now()->lt(session('otp_expires_at'))) {
            return back()->with('error', 'Invalid or expired OTP.')->withInput();
        } else {
            // Clear OTP from session
            session()->forget(['otp', 'otp_email', 'otp_expires_at']);
            return redirect()->route('/')->with('success', 'OTP verified. You can now reset your password.');
        }

    }
    public function resetPassword(Request $request, $id)
    {
        $user = User::find($id);
        if(!$user){
            abort(404);
        }
        $validatedData = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return back()->with('error', 'Current password is incorrect.')->withInput();
        }

        try {
            $user->password = bcrypt($validatedData['new_password']);
            $user->save();
            return back()->with('success', 'Password changed successfully.');
        } catch (\Exception) {
            return back()->with('error', 'We could not change your password. Please try again.')->withInput();
        }
    }
}
