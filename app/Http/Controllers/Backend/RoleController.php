<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Inertia\Inertia;
use App\Http\Requests\RoleRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use App\Services\AdminService;
use App\Services\RolePermissionService;
use App\Traits\SystemTrait;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    use SystemTrait;

    protected $roleService, $permissionService, $AdminService, $rolePermissionService;


    public function __construct(RoleService $roleService, PermissionService $permissionService, AdminService $AdminService, RolePermissionService $rolePermissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
        $this->AdminService = $AdminService;
        $this->rolePermissionService = $rolePermissionService;
    }

    public function index()
    {
       
        return Inertia::render(
            'Backend/Role/Index',
            [
                'pageTitle' => fn() => 'Role List',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'Role Manage'],
                    ['link' => route('backend.role.index'), 'title' => 'Role List'],
                ],
                'tableHeaders' => fn() => $this->getTableHeaders(),
                'dataFields' => fn() => $this->dataFields(),
                'datas' => fn() => $this->getDatas(),
                'filters' => request()->only(['numOfData', 'name']),
                'countData' => count($this->roleService->list()->get())
            ]
        );
    }



    private function getDatas()
    {
        $query = $this->roleService->list();


        if (request()->filled('name')) {
            $query->where(function ($q) {
                $q->where('name', 'like', request()->name . '%');
            });
        }

        $datas = $query->paginate(request()->numOfData ?? 10)->withQueryString();

        $formatedDatas = $datas->map(function ($data, $index) {
            $customData = new \stdClass();
            $customData->index = $index + 1;
            $customData->role_name = $data->name;
            $customData->guard_name = $data->guard_name;

            $customData->hasLink = true;
            $customData->links = [

                [
                    'linkClass' => 'btn btn-primary shadow btn-xs sharp me-1',
                    'link' => route('backend.role.edit', $data->id),
                    'linkLabel' => getLinkLabel(null, '<i class="fa fa-pencil"></i>', null)
                ],

                [
                    'linkClass' => 'deleteButton btn btn-danger shadow btn-xs sharp',
                    'link' => route('backend.role.destroy', $data->id),
                    'linkLabel' => getLinkLabel(null, '<i class="fa fa-trash"></i>', null)
                ]
            ];
            return $customData;
        });

        return regeneratePagination($formatedDatas, $datas->total(), $datas->perPage(), $datas->currentPage());
    }

    private function dataFields()
    {
        return [
            ['fieldName' => 'index', 'class' => 'text-center'],
            ['fieldName' => 'role_name', 'class' => 'text-center'],
            ['fieldName' => 'guard_name', 'class' => 'text-center'],
        ];
    }
    private function getTableHeaders()
    {
        return [
            'Sl/No',
            'Role Name',
            'Guard Name',
            'Action'
        ];
    }


    public function create()
    {
        return Inertia::render(
            'Backend/Role/Form',
            [
                'pageTitle' => fn() => 'Role Create',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'Role Manage'],
                    ['link' => route('backend.role.create'), 'title' => 'Role Create'],
                ],
                'permissions' => fn() => $this->permissionService->listWithAllChild(),
               
            ]
        );
    }

    public function store(RoleRequest $request)
    {
       
        DB::beginTransaction();
        try {

            $data = $request->validated();
            $dataInfo = $this->roleService->create($data);
            if ($dataInfo) {
                $message = 'Role created successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'roles', $message);

                DB::commit();

                return redirect()
                    ->route('backend.role.index')
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To create Role.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'RoleController', 'store', substr($err->getMessage(), 0, 1000));
            DB::commit();
            $message = "Server Errors Occur. Please Try Again.";
            return redirect()
                ->back()
                ->with('errorMessage', $message);
        }
    }

    public function edit($id)
    {
        $role = $this->roleService->find($id);


        $routes = Route::getRoutes();

        // Initialize an empty array to group routes by controller
        $groupedRoutes = [];

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
                $routeDetails = [
                    'uri' => $routeName,
                    'name' => $formattedName,
                    'controller_function' => $controllerFunction,
                    'method' => implode('|', $route->methods()),
                    'controllerName' => $controllerName,
                ];


                if($controllerName=='' || $controllerName=='CommandController' || $controllerName=='ModuleMakerController'){
                    continue;
                }

                // Group routes by controller name
                if ($controllerName) {
                    $groupedRoutes[$controllerName][] = $routeDetails;
                } else {
                    // If there's no controller name (e.g., closure), group them under 'Closure'
                    $groupedRoutes['Closure'][] = $routeDetails;
                }
            }
        }

        $existingRolePermissions = $this->rolePermissionService->listOfRolePermissions($id);

        $formattedExistingRolePermissions = $existingRolePermissions->map(function ($permission) {
            return [
                'uri' => $permission->uri,
                'name' => $permission->name,
                'controller_function' => $permission->controller_function,
                'method' => $permission->method,
                'controllerName' => $permission->controller_name,
            ];
        });

         
        return Inertia::render(
            'Backend/Role/Form',
            [
                'pageTitle' => fn() => 'Role Edit',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'Role Manage'],
                    ['link' => route('backend.role.edit', $role->id), 'title' => 'Role Edit'],
                ],
                'permissions' => fn() => $this->permissionService->listWithAllChild(),
                'groupedRoutes' => $groupedRoutes,
                'ExistingRolePermissions' => $formattedExistingRolePermissions,
                'role' => $role,
                'id' =>  $id,
            ]
        );
    }

    public function update(RoleRequest $request, $id)
    {


        DB::beginTransaction();
        // try {

        $data = $request->validated();

        if ($this->roleService->update($data, $id)) {


            // $users = $this->AdminService->list()->where('status', 'Active')->where('role_id', $id)->get();
            $existingRolePermissions = $this->rolePermissionService->listOfRolePermissions($id);

            // delete existing permission list
            foreach ($existingRolePermissions as  $existing) {
                $this->rolePermissionService->delete($existing->id);
            }
            $checkedRoutes = $request->checkedRoutes;

            foreach ($checkedRoutes as $data) {

                

                $list = [
                    'role_id' => $id,
                    'uri' => $data['uri'],
                    'name' => $data['name'],
                    'controller_function' => $data['controller_function'],
                    'controller_name' => $data['controllerName'],
                    'method' => $data['method'],
                ];
                $this->rolePermissionService->store($list);
            }

            $message = 'Role updated successfully';
            $this->storeAdminWorkLog($id, 'roles', $message);

            DB::commit();

            return redirect()
                ->route('backend.role.index')
                ->with('successMessage', $message);
        } else {
            DB::rollBack();

            $message = "Failed To update Role.";
            return redirect()
                ->back()
                ->with('errorMessage', $message);
        }
        // } catch (Exception $err) {
        //     DB::rollBack();
        //     $this->storeSystemError('Backend', 'RoleController', 'update', substr($err->getMessage(), 0, 1000));
        //     DB::commit();
        //     $message = "Server Errors Occur. Please Try Again.";
        //     return redirect()
        //         ->back()
        //         ->with('errorMessage', $message);
        // }
    }

    public function destroy($id)
    {

        DB::beginTransaction();

        try {
            // $dataInfo = $this->roleService->delete($id);

            if ($this->roleService->delete($id)) {
                $message = 'Role deleted successfully';
                $this->storeAdminWorkLog($id, 'roles', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To Delete Role.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'RoleController', 'destroy', substr($err->getMessage(), 0, 1000));
            DB::commit();
            $message = "Server Errors Occur. Please Try Again.";
            return redirect()
                ->back()
                ->with('errorMessage', $message);
        }
    }

    public function changeStatus()
    {
        DB::beginTransaction();

        try {
            $dataInfo = $this->roleService->changeStatus(request());

            if ($dataInfo->wasChanged()) {
                $message = 'Role ' . request()->status . ' Successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'roles', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To " . request()->status . " Role.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'RoleController', 'changeStatus', substr($err->getMessage(), 0, 1000));
            DB::commit();
            $message = "Server Errors Occur. Please Try Again.";
            return redirect()
                ->back()
                ->with('errorMessage', $message);
        }
    }
}
