<?php

namespace App\Http\Middleware;


use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Support\Str;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {

        $sideMenus = [];
        // $companyInfo = [];
        if (auth()->guard('admin')->check() && auth()->guard('admin')->user()->status == 'Active') {
            $sideMenus = (session()->has('sideMenus')) ? session()->get('sideMenus') : getSideMenus();
        }
        $sideMenus = (session()->has('sideMenus')) ? session()->get('sideMenus') : getSideMenus();





        return array_merge(parent::share($request), [

            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => [
                'successMessage' => $request->session()->get('successMessage'),
                'errorMessage' => $request->session()->get('errorMessage'),
            ],
            'auth' => [
                'admin' => fn() => auth('admin')->user(),
                'employee' => fn() => auth('employee')->user(),

            ],
            'sideMenus' => $sideMenus,
           
            'routePermissions' => function () {
                $role_id = null;

                // Determine the role ID
                if (auth()->guard('employee')->check()) {
                    $role_id = auth()->guard('employee')->user()->role_id;
                } elseif (auth()->guard('admin')->check()) {
                    $role_id = auth()->guard('admin')->user()->role_id;
                }

                // Check if the user has permission
                if ($role_id == 1) {



                    $routes = Route::getRoutes();

                    // Initialize an empty array to group routes by controller
                    $routeDetails = [];

                    // Loop through the routes and collect necessary details
                    foreach ($routes as $route) {

                        if ($route->middleware() && in_array('web', $route->middleware()) && str_starts_with($route->getPrefix(), 'backend')) {
                            $action = $route->getActionName();
                            $controllerName = null;
                            $controllerFunction = null;

                            // Extract controller and function name if action is a string (controller method)
                            if (is_string($action) && str_contains($action, '@')) {
                                [$controller, $method] = explode('@', $action);
                                $controllerName = class_basename($controller); // Get controller class name
                                $controllerFunction = $method; // Get function name
                            }
                            $routeName = $route->getName();

                            if ($routeName) {
                                // Remove 'backend.' from the route name and convert to sentence case
                                $cleanedName = str_replace('backend.', '', $routeName); // e.g., "command.index"
                                $formattedName = Str::title(str_replace('.', ' ', $cleanedName)); // "Command Index"
                            } else {
                                $formattedName = null;
                            }
                            // Build route details
                            $routeDetails[] = [
                                'uri' => $routeName,
                                'name' => $formattedName,
                                'controller_function' => $controllerFunction,
                                'method' => implode('|', $route->methods()),
                                'controllerName' => $controllerName,
                            ];
                        }
                    }

                    $permissionList = [];
                    foreach ($routeDetails as $value) {
                        $permissionList[] = $value['uri'];
                    }

                    return $permissionList;
                } else {
                    $RolePermissions = RolePermission::where(
                        'role_id',
                        '=',
                        $role_id
                    )->get();
                }


                $permissionList = [];
                foreach ($RolePermissions as $value) {
                    $permissionList[] = $value->uri;
                }

                return $permissionList;
            },
            'currentAccessRoute' => function () {
                return Route::currentRouteName();
            },


        ]);
    }
}
