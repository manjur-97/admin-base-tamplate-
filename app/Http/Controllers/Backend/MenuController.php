<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use Illuminate\Support\Facades\DB;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;
use App\Traits\SystemTrait;
use Exception;

class MenuController extends Controller
{
    use SystemTrait;

    protected $MenuService;

    public function __construct(MenuService $MenuService)
    {
        
        $this->MenuService = $MenuService;
    }

    public function index()
    {
        return Inertia::render(
            'Backend/Menu/Index',
            [
                'pageTitle' => fn () => 'Menu List',
                'breadcrumbs' => fn () => [
                    ['link' => null, 'title' => 'Menu Manage'],
                    ['link' => route('backend.menu.index'), 'title' => 'Menu List'],
                ],
                'tableHeaders' => fn () => $this->getTableHeaders(),
                'dataFields' => fn () => $this->dataFields(),
                'datas' => fn () => $this->getDatas(),
            ]
        );
    }

    private function getDatas()
    {
        $query = $this->MenuService->list();


        $datas = $query->paginate(request()->numOfData ?? 10)->withQueryString();

        $columnNames = Schema::getColumnListing('menus');
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
                    'link' => route('backend.menu.status.change', ['id' => $data->id, 'status' => $data->status == 'Active' ? 'Inactive' : 'Active']),
                    'linkLabel' => getLinkLabel((($data->status == 'Active') ? "Inactive" : "Active"), null, null)
                ],
                [
                    'linkClass' => 'bg-yellow-400 text-black semi-bold',
                    'link' => route('backend.menu.edit', [$data->id]),
                    'linkLabel' => getLinkLabel('Edit', null, null)
                ],
                [
                    'linkClass' => 'deleteButton bg-red-500 text-white semi-bold',
                    'link' => route('backend.menu.destroy', $data->id),
                    'linkLabel' => getLinkLabel('Delete', null, null)
                ]
            ];
            return $customData;
        });

        return regeneratePagination($formatedDatas, $datas->total(), $datas->perPage(), $datas->currentPage());
    }

    private function dataFields()
    {

        $columnNames = Schema::getColumnListing('menus');
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
            'Name',
            'Icon',
            'Route',
            'Description',
            'Sorting',
            'Parent id',
            'Permission name',
            'Status',
            'Action'
        ];
    }

    public function create()

    {

        return Inertia::render(
            'Backend/Menu/Form',
            [
                'pageTitle' => fn () => 'Menu Create',
                'breadcrumbs' => fn () => [
                    ['link' => null, 'title' => 'Menu Manage'],
                    ['link' => route('backend.menu.create'), 'title' => 'Menu Create'],
                ],
            ]
        );
    }


    public function store(MenuRequest $request)
    {
 
        DB::beginTransaction();
        try {

            $data = $request->validated();

            if ($request->hasFile('image'))
                $data['image'] = $this->imageUpload($request->file('image'), 'menus');

            if ($request->hasFile('file'))
                $data['file'] = $this->fileUpload($request->file('file'), 'menus');


            $dataInfo = $this->MenuService->create($data);

            if ($dataInfo) {
                $message = 'Menu created successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'menus', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To create Menu.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            //   dd($err);
            DB::rollBack();
            $this->storeSystemError('Backend', 'MenuController', 'store', substr($err->getMessage(), 0, 1000));
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
        $menu = $this->MenuService->find($id);

        return Inertia::render(
            'Backend/Menu/Form',
            [
                'pageTitle' => fn () => 'Menu Edit',
                'breadcrumbs' => fn () => [
                    ['link' => null, 'title' => 'Menu Manage'],
                    ['link' => route('backend.menu.edit', $id), 'title' => 'Menu Edit'],
                ],
                'menu' => fn () => $menu,
                'id' => fn () => $id,
            ]
        );
    }

    public function update(MenuRequest $request, $id)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();
            $menu = $this->MenuService->find($id);

            if ($request->hasFile('image')) {
                $data['image'] = $this->imageUpload($request->file('image'), 'menus');
                $path = strstr($menu->image, 'storage/');
                if (file_exists($path)) {
                    unlink($path);
                }
            } else {

                $data['image'] = strstr($menu->image ?? '', 'menus');
            }

            if ($request->hasFile('file')) {
                $data['file'] = $this->fileUpload($request->file('file'), 'menus/');
                $path = strstr($menu->file, 'storage/');
                if (file_exists($path)) {
                    unlink($path);
                }
            } else {

                $data['file'] = strstr($menu->file ?? '', 'menus/');
            }

            $dataInfo = $this->MenuService->update($data, $id);

            if ($dataInfo->save()) {
                $message = 'Menu updated successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'menus', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To update menus.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'MenuController', 'update', substr($err->getMessage(), 0, 1000));
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

            if ($this->MenuService->delete($id)) {
                $message = 'Menu deleted successfully';
                $this->storeAdminWorkLog($id, 'menus', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To Delete Menu.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'MenuController', 'destroy', substr($err->getMessage(), 0, 1000));
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

            $dataInfo = $this->MenuService->changeStatus($id, $status);

            if ($dataInfo->wasChanged()) {
                $message = 'Menu ' . request()->status . ' Successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'menus', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To " . request()->status . "Menu.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'MenuController', 'changeStatus', substr($err->getMessage(), 0, 1000));
            DB::commit();
            $message = "Server Errors Occur. Please Try Again.";
            return redirect()
                ->back()
                ->with('errorMessage', $message);
        }
    }
}
