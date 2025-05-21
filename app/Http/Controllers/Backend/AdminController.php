<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Services\UserService;
use App\Services\RoleService;
use Inertia\Inertia;
use App\Traits\SystemTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    use SystemTrait;

    protected $userService, $roleService;

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    public function index()
    {
        return Inertia::render(
            'Backend/Admin/Index',
            [
                'pageTitle' => fn() => 'User List',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'User Manage'],
                    ['link' => route('backend.user.index'), 'title' => 'User List'],
                ],
                'tableHeaders' => fn() => $this->getTableHeaders(),
                'dataFields' => fn() => $this->dataFields(),
                'datas' => fn() => $this->getDatas(),
                'roles' => fn() => $this->roleService->activeList(),
                'filters' => request()->only(['numOfData', 'name', 'division', 'district', 'upazila', 'union']),
                'countedData' => fn() => $this->countedData(),
            ]
        );
    }
    private function countedData()
    {
        $query = $this->userService->list();

        $countedValue = $query->count();

        // Return the counted value
        return $countedValue;
    }

    private function getDatas()
    {
        $query = $this->userService->list()->with('role');

        if (request()->filled('name')) {
            $query->where(function ($q) {
                $q->where('first_name', 'like', '%' . request()->name . '%')
                    ->orWhere('last_name', 'like', '%' . request()->name . '%');
            });
        }

        if (request()->filled('phone'))
            $query->where('phone', 'like', request()->phone . '%');

        if (request()->filled('email'))
            $query->where('email', 'like', request()->email . '%');

        if (request()->filled('role_id'))
            $query->where('role', request()->role_id);

        $datas = $query->paginate(request()->numOfData ?? 10)->withQueryString();

        $formatedDatas = $datas->map(function ($data, $index) {
            $customData = new \stdClass();
            $customData->index = $index + 1;
            $customData->name = $data->name;
            $customData->email = $data->email;
            $customData->phone = $data->phone;
            $customData->role_name = $data->role?->name;
            $customData->photo = '<img src="' . $data->photo . '" height="50" width="50"/>';
            $customData->address = $data->address;
            $customData->status = getStatusText($data->status);

            $customData->hasLink = true;
            $customData->links = [
                [
                    'linkClass' => 'btn btn-danger shadow btn-xs sharp me-1 ' . (($data->status == 'Active') ? "bg-danger" : "bg-info"),
                    'link' => route('backend.user.status.change', ['id' => $data->id, 'status' => $data->status == 'Active' ? 'Inactive' : 'Active']),
                    'linkLabel' => getLinkLabel(
                        ($data->status == 'Active' ? "<i class='fas fa-toggle-on'></i>" : "<i class='fas fa-toggle-off'></i>"),
                        null,
                        null
                    )
                ],
                [
                    'linkClass' => 'btn btn-primary shadow btn-xs sharp me-1',
                    'link' => route('backend.user.edit', $data->id),
                    'linkLabel' => getLinkLabel(null, '<i class="fa fa-pencil"></i>', null)
                ],

                [
                    'linkClass' => 'btn btn-danger shadow btn-xs sharp',
                    'link' => route('backend.user.destroy', $data->id),
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
            ['fieldName' => 'photo', 'class' => 'text-center'],
            ['fieldName' => 'name', 'class' => 'text-center'],
            ['fieldName' => 'email', 'class' => 'text-center'],
            ['fieldName' => 'phone', 'class' => 'text-center'],
            ['fieldName' => 'address', 'class' => 'text-center'],
            ['fieldName' => 'role_name', 'class' => 'text-center'],
            ['fieldName' => 'status', 'class' => 'text-center'],
        ];
    }
    private function getTableHeaders()
    {
        return [
            'Sl/No',
            'Photo',
            'Name',
            'Email',
            'Phone',
            'Address',
            'Role Name',
            'Status',
            'Action',
        ];
    }

    public function create()
    {
        return Inertia::render(
            'Backend/Admin/Form',
            [
                'pageTitle' => fn() => 'User Create',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'User Manage'],
                    ['link' => route('backend.user.create'), 'title' => 'User Create'],
                ],
                'roles' => fn() => $this->roleService->activeList(),
                'countedData' => fn() => $this->countedData(),
            ]
        );
    }

    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();

            if ($request->hasFile('photo'))
                $data['photo'] = $this->imageUpload($request->file('photo'), 'users');

            $dataInfo = $this->userService->create($data);

            if ($dataInfo) {
                $message = 'User created successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'admins', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To create user.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'AdminController', 'store', substr($err->getMessage(), 0, 1000));
            DB::commit();
            $message = "Server Errors Occur. Please Try Again.";
            return redirect()
                ->back()
                ->with('errorMessage', $message);
        }
    }

    public function edit($id)
    {
        $user = $this->userService->find($id);

        return Inertia::render(
            'Backend/Admin/Form',
            [
                'pageTitle' => fn() => 'User Edit',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'User Manage'],
                    ['link' => route('backend.user.edit', $user->id), 'title' => 'Branch Edit'],
                ],
                'user' => fn() => $user,
                'id' => fn() => $id,
                'roles' => fn() => $this->roleService->activeList(),
                'countedData' => fn() => $this->countedData(),
            ]
        );
    }

    public function update(UserRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $admin = $this->userService->find($id);
            $data = $request->validated();
            if ($request->hasFile('photo')) {
                $data['photo'] = $this->imageUpload($request->file('photo'), 'users');
                if (isset($admin->photo)) {
                    $path = strstr($admin->photo, 'storage/');
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            } else {
                $data['photo'] = strstr($admin->photo, 'users/'); //remove text before specified text
            }

            $dataInfo = $this->userService->update($data, $id);
            if ($dataInfo->wasChanged()) {
                $message = 'User updated successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'admins', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To update Branch.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'AdminController', 'update', substr($err->getMessage(), 0, 1000));
            DB::commit();
            $message = "Server Errors Occur. Please Try Again.";
            return redirect()
                ->back()
                ->with('errorMessage', $message);
        }
    }

    public function destroy($id)
    {

        DB::beginTransaction();

        try {
            $dataInfo = $this->userService->delete($id);

            if ($dataInfo->wasChanged()) {
                $message = 'User deleted successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'admins', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To Delete User.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'AdminController', 'destroy', substr($err->getMessage(), 0, 1000));
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
            $dataInfo = $this->userService->changeStatus(request());

            if ($dataInfo->wasChanged()) {
                $message = 'User ' . request()->status . ' Successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'admins', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To " . request()->status . " User.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'AdminController', 'changeStatus', substr($err->getMessage(), 0, 1000));
            DB::commit();
            $message = "Server Errors Occur. Please Try Again.";
            return redirect()
                ->back()
                ->with('errorMessage', $message);
        }
    }

    public function profile()
    {
        $user = auth()->guard('admin')->user();

        $role = Role::find($user->role_id);
        return Inertia::render('Backend/Admin/Profile', [
            'user' => $user,
            'role' => $role
        ]);
    }

    public function change_password()
    {
        $user = auth()->guard('admin')->user();
        return Inertia::render(
            'Backend/Admin/ChangePassword',
            [
                'pageTitle' => fn() => 'Change Password',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'Manage User'],
                    ['link' => route('backend.profile'), 'title' => 'Change Password'],
                ],
                'user' => fn() => $user,
                'id' => fn() => $user->id
            ]
        );
    }



    public function password_update(Request $request)
    {
        $user = auth()->guard('admin')->user();

        $customMessages = [
            'current_password.required' => 'Please enter your current password.',
            'current_password.min' => 'Your current password must be at least :min characters long.',
            'new_password.required' => 'Please enter a new password.',
            'new_password.min' => 'Your new password must be at least :min characters long.',
            'new_password.confirmed' => 'The new password confirmation does not match.',
            'new_password_confirmation.required' => 'Please confirm your new password.',
        ];

        // Validate the password fields with custom messages
        $validated = $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
            'new_password_confirmation' => ['required', 'string'],
        ], $customMessages);

        // Check if the current password matches

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match']);
        }

        // Update the new password

        

        if ($user->update(['password' => $request->new_password])) {

            return redirect()->route('backend.profile')->with('successMessage', 'Password updated successfully.');

        }

        // Handle the case where the update fails
        return back()->withErrors(['errorMessage' => 'Failed to update password.']);
    }
}
