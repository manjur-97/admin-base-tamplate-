<?php

namespace App\Http\Controllers\ShowMyPro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\TanentLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Tanent;
use Illuminate\Support\Facades\Auth;

class ShowMyProController extends Controller
{
    public function landing_page()
    {

        return view('show_my_pro.landing_page');
    }
    public function login_page()
    {

        return view('show_my_pro.login');
    }
    public function register_page()
    {

        return view('show_my_pro.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'mobile' => [
                    'required',
                    'string',
                    'min:11',
                    'max:15',
                    'regex:/^(\+8801[3-9]\d{8}|01[3-9]\d{8})$/',
                    'unique:tanents,mobile',
                ],
                'email' => 'required|email|max:255|unique:tanents',
                'address' => 'nullable|string|max:255',
                'password' => 'required|string|min:6|confirmed',
            ],
            [ // 👇 Custom error messages
                'name.required' => 'Please enter your name.',
                'mobile.required' => 'Mobile number is required.',
                'mobile.max' => 'Mobile number will not more then 15.',
                'mobile.regex' => 'The mobile number must be valid (e.g., 017xxxxxxxx or +88017xxxxxxxx).',
                'mobile.unique' => 'This mobile number is already registered.Try another number to register',
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

            return redirect()->route('tanent.login')->with('success', 'Mobile number verified successfully! You are now logged in.');
        } else {
            return redirect()->back()->withErrors(['otp' => 'Invalid OTP. Please try again.'])->with('show_otp_form', true)->with('mobile', $request->mobile);
        }
    }

    public function TanentLogin(TanentLoginRequest $request)
    {

        $request->validated();

        $userInfo =  Tanent::where('mobile', request()->mobile)->first();



        if (!empty($userInfo)) {
            if ($userInfo->is_mobile_verified != 1) {

                return redirect()->route('tanent.register')->withErrors('Please verify your mobile number.');
            }

            if (Hash::check(request()->password, $userInfo->password)) {

                Auth::guard('tanent')->login($userInfo);

                return redirect()->route('tanent.dashboard')->with('successMessage', 'Logged In Successfully');
                // return Inertia::render('Backend/Dashboard')->with('warningMessage', 'Logged In Successfully');
            } else {
                return redirect()->route('tanent.login')->withErrors('Wrong Password. Please Enter Valid Password.');
            }
        } else {
            return redirect()->route('tanent.login')->withErrors('Invalid Mobile Number. Please Enter Valid Mobile Number.');
        }
    }
}
