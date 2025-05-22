<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebsiteMenuRequest;
use Illuminate\Support\Facades\DB;
use App\Services\WebsiteMenuService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Traits\SystemTrait;
use Exception;

class WebsiteController extends Controller
{
    use SystemTrait;

    protected $WebsiteMenuService;

    public function __construct(WebsiteMenuService $WebsiteMenuService)
    {
        $this->WebsiteMenuService = $WebsiteMenuService;
    }

    public function index()
    {
        return Inertia::render(
            'Backend/WebsiteMenu/Index',
            [
                'pageTitle' => fn() => 'WebsiteMenu List',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'WebsiteMenu Manage'],
                    ['link' => route('backend.websitemenu.index'), 'title' => 'WebsiteMenu List'],
                ],
                'tableHeaders' => fn() => $this->getTableHeaders(),
                'dataFields' => fn() => $this->dataFields(),
                'datas' => fn() => $this->getDatas(),
                'countedData' => fn() => $this->countedData(),
            ]
        );
    }
    private function countedData()
    {
        $query = $this->WebsiteMenuService->list();

        $countedValue = $query->count();


        return $countedValue;
    }

    private function getDatas()
    {
        $query = $this->WebsiteMenuService->list();

        if (request()->filled('name')) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . request()->name . '%');
            });
        }

        $datas = $query->paginate(request()->numOfData ?? 10)->withQueryString();

        $formattedDatas = $datas->map(function ($data, $index) {
            $customData = new \stdClass();
            $customData->index = $index + 1;
            $customData->id = $data->id;
            $customData->name = $data->name;
            $customData->slug = $data->slug;
            $customData->order = $data->order;
            $customData->status = $data->status;                // Set other properties as before
            $customData->status = getStatusText($data->status);
            $customData->hasLink = true;
            $customData->links = [
                [
                    'linkClass' => 'statusChange btn btn-info shadow btn-xs sharp me-1 ' . (($data->status == 'Active') ?  "bg-info" : "bg-secondary"),
                    'link' => route('backend.websitemenu.status.change', ['id' => $data->id, 'status' => $data->status == 'Active' ? 'Inactive' : 'Active']),
                    'linkLabel' => getLinkLabel(
                        ($data->status == 'Active' ? "<i class='fas fa-toggle-on'></i>" : "<i class='fas fa-toggle-off'></i>"),
                        null,
                        null
                    )
                ],
                [
                    'linkClass' => 'btn btn-primary shadow btn-xs sharp me-1',
                    'link' => route('backend.websitemenu.edit', $data->id),
                    'linkLabel' => getLinkLabel(null, '<i class="fa fa-pencil"></i>', null)
                ],

                [
                    'linkClass' => 'deleteButton btn btn-danger shadow btn-xs sharp',
                    'link' => route('backend.websitemenu.destroy', $data->id),
                    'linkLabel' => getLinkLabel(null, '<i class="fa fa-trash"></i>', null)
                ]

            ];
            return $customData;
        });

        return regeneratePagination($formattedDatas, $datas->total(), $datas->perPage(), $datas->currentPage());
    }

    private function dataFields()
    {
        return [
            ['fieldName' => 'index', 'class' => 'text-center text-wrap'],
            ['fieldName' => 'name', 'class' => 'text-center text-wrap'],
            ['fieldName' => 'slug', 'class' => 'text-center text-wrap'],
            ['fieldName' => 'order', 'class' => 'text-center text-wrap'],
            ['fieldName' => 'status', 'class' => 'text-center text-wrap'],
        ];
    }

    private function getTableHeaders()
    {
        return [
            'Sl/No',
            'Name',
            'Slug',
            'Order',
            'Status',
            'Action'
        ];
    }

    public function create()
    {
        return Inertia::render(
            'Backend/WebsiteMenu/Form',
            [
                'pageTitle' => fn() => 'WebsiteMenu Create',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'WebsiteMenu Manage'],
                    ['link' => route('backend.websitemenu.create'), 'title' => 'WebsiteMenu Create'],
                ],
                'countedData' => fn() => $this->countedData(),
            ]
        );
    }

    public function store(WebsiteMenuRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            $dataInfo = $this->WebsiteMenuService->create($data);

            if ($dataInfo) {
                $message = 'WebsiteMenu created successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'website_menus', $message);

                DB::commit();

                return redirect()->route("backend.websitemenu.index")->with('successMessage', $message);
            } else {
                DB::rollBack();
                $message = "Failed to create WebsiteMenu.";
                return redirect()->back()->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'WebsiteController', 'store', substr($err->getMessage(), 0, 1000));
            $message = "Server Errors Occurred. Please Try Again.";
            return redirect()->back()->with('errorMessage', $message);
        }
    }

    public function edit($id)
    {
        $websitemenu = $this->WebsiteMenuService->find($id);

        return Inertia::render(
            'Backend/WebsiteMenu/Form',
            [
                'pageTitle' => fn() => 'WebsiteMenu Edit',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'WebsiteMenu Manage'],
                    ['link' => route('backend.websitemenu.edit', $id), 'title' => 'WebsiteMenu Edit'],
                ],
                'websitemenu' => fn() => $websitemenu,
                'id' => fn() => $id,
                'countedData' => fn() => $this->countedData(),
            ]
        );
    }

    public function update(WebsiteMenuRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $websitemenu = $this->WebsiteMenuService->find($id);





            $dataInfo = $this->WebsiteMenuService->update($data, $id);

            if ($dataInfo) {
                $message = 'WebsiteMenu updated successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'website_menus', $message);

                DB::commit();

                return redirect()->route("backend.websitemenu.index")->with('successMessage', $message);
            } else {
                DB::rollBack();
                $message = "Failed to update WebsiteMenu.";
                return redirect()->back()->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'WebsiteController', 'update', substr($err->getMessage(), 0, 1000));
            $message = "Server Errors Occurred. Please Try Again.";
            return redirect()->back()->with('errorMessage', $message);
        }
    }

    public function changeStatus($id, $status)
    {
        try {

            $dataInfo = $this->WebsiteMenuService->changeStatus($id, $status);

            if ($dataInfo->wasChanged()) {
                $message = 'WebsiteMenu ' . request()->status . ' Successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'website_menus', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To " . request()->status . "WebsiteMenu.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'WebsiteController', 'changeStatus', substr($err->getMessage(), 0, 1000));
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

            if ($this->WebsiteMenuService->delete($id)) {
                $message = 'WebsiteMenu deleted successfully';
                $this->storeAdminWorkLog($id, 'website_menus', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To Delete WebsiteMenu.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'WebsiteController', 'destroy', substr($err->getMessage(), 0, 1000));
            DB::commit();
            $message = "Server Errors Occur. Please Try Again.";
            return redirect()
                ->back()
                ->with('errorMessage', $message);
        }
    }
}
