<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EmployeeLoginRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\TanentLoginRequest;
use App\Models\Tanent;
use App\Services\AdminService;

use App\Traits\SystemTrait;
use Inertia\Inertia;
use Hash;
use Auth;

class LoginController extends Controller
{
    use SystemTrait;

    protected $AdminService;

    public function __construct(AdminService $AdminService)
    {
        $this->AdminService = $AdminService;

    }
    // public function login(LoginRequest $request)
    // {



    //     $userInfo =  $this->AdminService->AdminExists(request()->email);

    //     if (!empty($userInfo)) {
    //         if ($userInfo->status != "Active") {
    //             return Inertia::render('Login')->with('errorMessage', 'Your Account Temporary Blocked. Please Contact Administrator.');
    //         }

    //         if (Hash::check(request()->password, $userInfo->password)) {

    //             Auth::guard('admin')->login($userInfo);

    //             // session()->flash('message', 'Logged In Successfully');
    //             return redirect()->route('backend.dashboard')->with('successMessage', 'Logged In Successfully');
    //             // return Inertia::render('Backend/Dashboard')->with('warningMessage', 'Logged In Successfully');
    //         } else {
    //             return Inertia::render('Login')->with('warningMessage', 'Wrong Password. Please Enter Valid Password.');
    //         }
    //     } else {
    //         session()->flash('errorMessage', 'Invalid email. Please enter a valid email.');
    //         return Inertia::render('Login')->with('errorMessage', 'Invalid Email. Please Enter Valid Email.');
    //     }
    // }
    public function login(LoginRequest $request)
    {
        try {
            // Validate request
            $request->validated();

            // Get user info based on the provided email
            $userInfo = $this->AdminService->AdminExists(request()->email);

            if (!empty($userInfo)) {
                // Check if the account is blocked
                if ($userInfo->status != "Active") {
                    session()->flash('errorMessage', 'Your account is temporarily blocked. Please contact the administrator.');
                    return Inertia::render('Login', [
                        'errorMessage' => session('errorMessage')
                    ]);
                }

                // Check if the password matches
                if (Hash::check(request()->password, $userInfo->password)) {
                    // Log the user in and redirect to the dashboard
                    Auth::guard('admin')->login($userInfo);

                    session()->flash('successMessage', 'Logged in successfully.');
                    return redirect()->route('backend.dashboard')->with('successMessage', 'Logged in successfully.');
                } else {

                    return Inertia::render('Login', [
                        'errorMessage' => 'Wrong password. Please enter a valid password.'
                    ]);
                }
            } else {


                return Inertia::render('Login', [
                    'errorMessage' => 'Invalid email. Please enter a valid email.'
                ]);
            }
        } catch (\Exception $e) {
            // Catch any unexpected errors


            return Inertia::render('Login', [
                'errors' => $e
            ]);
        }
    }

   

    function loginPage()
    {

        
        return Inertia::render('Login');
    }

    public function logout()
    {
        auth('admin')->logout();
        session()->flash('successMessage', "Successfully Logged Out.");
        return redirect()->route('backend.auth.login');
    }
    public function TanentLogout()
    {
        auth('tanent')->logout();
        session()->flash('successMessage', "Successfully Logged Out.");
        return redirect()->route('backend.auth.login');
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
                return redirect()->route('tanent.register')->withErrors('Wrong Password. Please Enter Valid Password.');
            }
        } else {
            return redirect()->route('tanent.register')->withErrors('Invalid Username. Please Enter Valid Username.');  
        }
    }
}
