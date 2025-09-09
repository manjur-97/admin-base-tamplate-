<?php

namespace App\Http\Middleware;

use App\Models\RolePermission;
use Closure;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {


        if (auth()->guard('admin')->check() && auth()->guard('admin')->user()->status == 'Active' && auth()->guard('admin')->user()->role_id == 1) {

            return $next($request);

        } elseif (auth()->guard('admin')->check() && auth()->guard('admin')->user()->status == 'Active' && auth()->guard('admin')->user()->role_id !== 1) {

            $name_route = Request::route()->getName();

            $role_permission_url = RolePermission::where('role_id', auth()->guard('admin')->user()->role_id)->where('uri', $name_route)->count();
            $routes = Route::getRoutes();

            // Extract the URLs from the routes
            $matchRouteUrlsBetweenDatabaseAndRouteList = [];
            foreach ($routes as $route) {
                // Compare with route name instead of URI from database

                if ($route->getName() == $name_route) {
                    $matchRouteUrlsBetweenDatabaseAndRouteList[] = $route->getName(); // Get the URI of the route
                }
            }

            //authentication and role permission url check
            if (auth()->guard('admin')->check() && $role_permission_url !== 0) {

                // role permission url check if true
                return $next($request);
            } 
            // elseif (auth()->guard('admin')->check() && $role_permission_url == 0) {

            //     // Log the admin user out
            //     auth()->guard('admin')->logout();

            //     // Redirect back with an error message
            //     return redirect()->back()->with('errorMessage', 'You have been logged out due to insufficient permissions.');
            // }
             else {

                // action route check and not permission the url to the user role
                if (count($matchRouteUrlsBetweenDatabaseAndRouteList) > 0) {

                    $message = "you don't have permission to access this route";
                    return redirect()->route('backend.dashboard')
                        ->with('errorMessage', $message);
                } else {
                    // if action route check does not exist
                    return redirect()->route('backend.dashboard');
                }
            }
            return $next($request);
        } else {
            if(auth()->guard('tanent')->check()){
                // dd(auth()->guard('tanent')->check());
                return $next($request);
                // return redirect()->route('tanent.dashboard');
            }   
            // return redirect()->route('tanent.dashboard');

            // if (auth()->guard('tanent')->check() && auth()->guard('tanent')->user()->status == 'Active' && auth()->guard('tanent')->user()->role_id == 3) {

            //     $name_route = Request::route()->getName();

            //     $role_permission_url = RolePermission::where('role_id', auth()->guard('tanent')->user()->role_id)->where('uri', $name_route)->count();
            //     $routes = Route::getRoutes();

            //     // Extract the URLs from the routes
            //     $matchRouteUrlsBetweenDatabaseAndRouteList = [];
            //     foreach ($routes as $route) {
            //         // Compare with route name instead of URI from database

            //         if ($route->getName() == $name_route) {
            //             $matchRouteUrlsBetweenDatabaseAndRouteList[] = $route->getName(); // Get the URI of the route
            //         }
            //     }

            //     //authentication and role permission url check
            //     if (auth()->guard('tanent')->check() && $role_permission_url !== 0) {

            //         // role permission url check if true
            //         return $next($request);
            //     }
            //      elseif (auth()->guard('tanent')->check() && $role_permission_url == 0) {

            //         // Log the admin user out
            //         auth()->guard('tanent')->logout();

            //         // Redirect back with an error message
            //         return redirect()->back()->with('errorMessage', 'You have been logged out due to insufficient permissions.');
            //     }
            //      else {


            //         // action route check and not permission the url to the user role
            //         if (count($matchRouteUrlsBetweenDatabaseAndRouteList) > 0) {

            //             $message = "you don't have permission to access this route";
            //             return redirect()->route('tanent.dashboard')
            //                 ->with('errorMessage', $message);
            //         } else {
            //             // if action route check does not exist
            //                 return redirect()->route('tanent.dashboard');
            //         }
            //     }

            //     return $next($request);
            // } else {

            //     session()->flash('errMsg', 'Please Login First.');
            //     return redirect()->route('tanent.register');
            // }

            // session()->flash('errMsg', 'Please Login First.');
            // return redirect()->route('tanent.register');
        }
    }
}
