<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Tanent;
use Illuminate\Support\Facades\Auth;

class TanentRegistrationController extends Controller
{
    public function showForm()
    {
        return view('cms.registration');
    }

    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'mobile' => 'required|string|max:20|unique:tanents',
                'email' => 'required|email|max:255|unique:tanents',
                'address' => 'nullable|string|max:255',
                'password' => 'required|string|min:6|confirmed',
            ],
            [ // 👇 Custom error messages
                'name.required' => 'Please enter your name.',
                'mobile.required' => 'Mobile number is required.',
                'mobile.unique' => 'This mobile number is already registered.',
                'email.required' => 'Email address is required.',
                'email.email' => 'Enter a valid email address.',
                'email.unique' => 'This email is already taken.',
                'password.required' => 'Please enter a password.',
                'password.min' => 'Password must be at least 6 characters.',
                'password.confirmed' => 'Passwords do not match.',
            ]
        );
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $otp = rand(100000, 999999);
    
        $tanent = Tanent::Create(
           
            [
                'mobile' => $request->mobile,
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'otp' => $otp,
                'is_mobile_verified' => false,
            ]
        );
    
        // TODO: Send OTP to mobile
    
        return redirect()->route('tanent.register')
            ->with('show_otp_form', true)
            ->with('mobile', $request->mobile);
    }
    

    public function verifyOtp(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string|exists:tanents,mobile',
            'otp' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('show_otp_form', true)->with('mobile', $request->mobile);
        }

        $tanent = Tanent::where('mobile', $request->mobile)->where('otp', $request->otp)->first();

        if ($tanent) {
            $tanent->is_mobile_verified = true;
            $tanent->otp = null; // Clear OTP after verification
            $tanent->save();

            // Create tenant-specific controller and redirect
          

            // Log the user in
            // Auth::guard('tanent')->login($tanent); 

            // TODO: Log the user in
            // Auth::login($tanent);

            return redirect()->route('tanent.register')->with('success', 'Mobile number verified successfully! You are now logged in.');
        } else {
            return redirect()->back()->withErrors(['otp' => 'Invalid OTP. Please try again.'])->with('show_otp_form', true)->with('mobile', $request->mobile);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $tanent = Tanent::where('email', $credentials['email'])->first();

        if ($tanent && $tanent->is_mobile_verified && Hash::check($credentials['password'], $tanent->password)) {
            Auth::login($tanent);
            return redirect()->intended('dashboard'); // Redirect to a protected dashboard route
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
} 