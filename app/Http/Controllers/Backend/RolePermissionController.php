<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermissionRequest;
use Illuminate\Support\Facades\DB;
use App\Services\RolePermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;
use App\Traits\SystemTrait;
use Exception;

class RolePermissionController extends Controller
{
    use SystemTrait;

    protected $RolePermissionService;

    public function __construct(RolePermissionService $RolePermissionService)
    {
        $this->RolePermissionService = $RolePermissionService;
    }

    public function index()
    {
        return Inertia::render(
            'Backend/RolePermission/Index',
            [
                'pageTitle' => fn() => 'RolePermission List',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'RolePermission Manage'],
                    ['link' => route('backend.rolepermission.index'), 'title' => 'RolePermission List'],
                ],
                'tableHeaders' => fn() => $this->getTableHeaders(),
                'dataFields' => fn() => $this->dataFields(),
                'datas' => fn() => $this->getDatas(),
            ]
        );
    }

    private function getDatas()
    {
        $query = $this->RolePermissionService->list();


        $datas = $query->paginate(request()->numOfData ?? 10)->withQueryString();

        $columnNames = Schema::getColumnListing('role_permissions');
        $formatedDatas = $datas->map(function ($data, $index) use ($columnNames) {
            $customData = new \stdClass();
            $customData->index = $index + 1;

            // Iterate through each column name and set the corresponding property in $customData
            foreach ($columnNames as $columnName) {
                // Check if the column exists in the $data object before accessing it
                if ($columnName == 'created_at' || $columnName == 'updated_at' || $columnName == 'deleted_at') {

                    continue;
                }
                if (isset($data->$columnName)) {
                    if ($columnName == 'image' || $columnName == 'file') {
                        $customData->$columnName = '<img src="' . $data->$columnName . '" height="50" width="50"/>';
                    } else {
                        $customData->$columnName = $data->$columnName;
                    }
                } else {
                    $customData->$columnName = null; // Or you can set a default value if the column doesn't exist
                }
            }

            // Set other properties as before
            $customData->status = getStatusText($data->status);
            $customData->hasLink = true;
            $customData->links = [
                [
                    'linkClass' => 'semi-bold text-white statusChange ' . (($data->status == 'Active') ? "bg-gray-500" : "bg-green-500"),
                    'link' => route('backend.rolepermission.status.change', ['id' => $data->id, 'status' => $data->status == 'Active' ? 'Inactive' : 'Active']),
                    'linkLabel' => getLinkLabel((($data->status == 'Active') ? "Inactive" : "Active"), null, null)
                ],
                [
                    'linkClass' => 'bg-yellow-400 text-black semi-bold',
                    'link' => route('backend.rolepermission.edit', [$data->id]),
                    'linkLabel' => getLinkLabel('Edit', null, null)
                ],
                [
                    'linkClass' => 'deleteButton bg-red-500 text-white semi-bold',
                    'link' => route('backend.rolepermission.destroy', $data->id),
                    'linkLabel' => getLinkLabel('Delete', null, null)
                ]
            ];
            return $customData;
        });

        return regeneratePagination($formatedDatas, $datas->total(), $datas->perPage(), $datas->currentPage());
    }

    private function dataFields()
    {

        $columnNames = Schema::getColumnListing('role_permissions');
        $fields = [];

        foreach ($columnNames as $columnName) {
            if (!in_array($columnName, ['created_at', 'updated_at', 'deleted_at'])) {
                $fields[] = [
                    'fieldName' => $columnName,
                    'class' => 'text-center'
                ];
            }
        }

        return $fields;
    }

    private function getTableHeaders()
    {
        return [
            'Sl/No',
            'Role id',
            'Uri',
            'Name',
            'Controller function',
            'Method',
            'Controller name',
            'Action'
        ];
    }

    public function create()
    {
        return Inertia::render(
            'Backend/RolePermission/Form',
            [
                'pageTitle' => fn() => 'RolePermission Create',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'RolePermission Manage'],
                    ['link' => route('backend.rolepermission.create'), 'title' => 'RolePermission Create'],
                ],
            ]
        );
    }


    public function store(RolePermissionRequest $request)
    {

        DB::beginTransaction();
        try {

            $data = $request->validated();

            if ($request->hasFile('image'))
                $data['image'] = $this->imageUpload($request->file('image'), 'role_permissions');

            if ($request->hasFile('file'))
                $data['file'] = $this->fileUpload($request->file('file'), 'role_permissions');


            $dataInfo = $this->RolePermissionService->create($data);

            if ($dataInfo) {
                $message = 'RolePermission created successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'role_permissions', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To create RolePermission.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            //   dd($err);
            DB::rollBack();
            $this->storeSystemError('Backend', 'RolePermissionController', 'store', substr($err->getMessage(), 0, 1000));
            dd($err);
            DB::commit();
            $message = "Server Errors Occur. Please Try Again.";
            // dd($message);
            return redirect()
                ->back()
                ->with('errorMessage', $message);
        }
    }

    public function edit($id)
    {
        $rolepermission = $this->RolePermissionService->find($id);

        return Inertia::render(
            'Backend/RolePermission/Form',
            [
                'pageTitle' => fn() => 'RolePermission Edit',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'RolePermission Manage'],
                    ['link' => route('backend.rolepermission.edit', $id), 'title' => 'RolePermission Edit'],
                ],
                'rolepermission' => fn() => $rolepermission,
                'id' => fn() => $id,
            ]
        );
    }

    public function update(RolePermissionRequest $request, $id)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();
            $rolepermission = $this->RolePermissionService->find($id);

            if ($request->hasFile('image')) {
                $data['image'] = $this->imageUpload($request->file('image'), 'role_permissions');
                $path = strstr($rolepermission->image, 'storage/');
                if (file_exists($path)) {
                    unlink($path);
                }
            } else {

                $data['image'] = strstr($rolepermission->image ?? '', 'role_permissions');
            }

            if ($request->hasFile('file')) {
                $data['file'] = $this->fileUpload($request->file('file'), 'role_permissions/');
                $path = strstr($rolepermission->file, 'storage/');
                if (file_exists($path)) {
                    unlink($path);
                }
            } else {

                $data['file'] = strstr($rolepermission->file ?? '', 'role_permissions/');
            }

            $dataInfo = $this->RolePermissionService->update($data, $id);

            if ($dataInfo->save()) {
                $message = 'RolePermission updated successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'role_permissions', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To update role_permissions.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'RolePermissionController', 'update', substr($err->getMessage(), 0, 1000));
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

            if ($this->RolePermissionService->delete($id)) {
                $message = 'RolePermission deleted successfully';
                $this->storeAdminWorkLog($id, 'role_permissions', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To Delete RolePermission.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'RolePermissionController', 'destroy', substr($err->getMessage(), 0, 1000));
            DB::commit();
            $message = "Server Errors Occur. Please Try Again.";
            return redirect()
                ->back()
                ->with('errorMessage', $message);
        }
    }

    public function changeStatus(Request $request, $id, $status)
    {
        DB::beginTransaction();

        try {

            $dataInfo = $this->RolePermissionService->changeStatus($id, $status);

            if ($dataInfo->wasChanged()) {
                $message = 'RolePermission ' . request()->status . ' Successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'role_permissions', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To " . request()->status . "RolePermission.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'RolePermissionController', 'changeStatus', substr($err->getMessage(), 0, 1000));
            DB::commit();
            $message = "Server Errors Occur. Please Try Again.";
            return redirect()
                ->back()
                ->with('errorMessage', $message);
        }
    }
}
