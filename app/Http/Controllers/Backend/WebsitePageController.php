<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebsitePageRequest;
use App\Models\WebsiteMenu;
use Illuminate\Support\Facades\DB;
use App\Services\WebsitePageService;
use App\Services\MenuService;
use App\Services\WebsiteMenuService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Traits\SystemTrait;
use Exception;

class WebsitePageController extends Controller
{
    use SystemTrait;

    protected $WebsitePageService;
    protected $MenuService;
    public function __construct(WebsitePageService $WebsitePageService, WebsiteMenuService $MenuService)
    {
        $this->WebsitePageService = $WebsitePageService;
        $this->MenuService = $MenuService;
    }

    public function index()
    {
        return Inertia::render(
            'Backend/WebsitePage/Index',
            [
                'pageTitle' => fn() => 'WebsitePage List',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'WebsitePage Manage'],
                    ['link' => route('backend.websitepage.index'), 'title' => 'WebsitePage List'],
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
        $query = $this->WebsitePageService->list();

        $countedValue = $query->count();


        return $countedValue;
    }

    private function getDatas()
    {
        $query = $this->WebsitePageService->list();

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
            $customData->menu_id = $data->menu_id;
            $customData->name = $data->name;
            $customData->slug = $data->slug;
            $customData->status = $data->status;
            $customData->menu_name = $data->menu?->name ?? "";                // Set other properties as before
            $customData->status = getStatusText($data->status);
            $customData->hasLink = true;
            $customData->links = [
                [
                    'linkClass' => 'statusChange btn btn-info shadow btn-xs sharp me-1 ' . (($data->status == 'Active') ?  "bg-info" : "bg-secondary"),
                    'link' => route('backend.websitepage.status.change', ['id' => $data->id, 'status' => $data->status == 'Active' ? 'Inactive' : 'Active']),
                    'linkLabel' => getLinkLabel(
                        ($data->status == 'Active' ? "<i class='fas fa-toggle-on'></i>" : "<i class='fas fa-toggle-off'></i>"),
                        null,
                        null
                    )
                ],
                [
                    'linkClass' => 'btn btn-primary shadow btn-xs sharp me-1',
                    'link' => route('backend.websitepage.edit', $data->id),
                    'linkLabel' => getLinkLabel(null, '<i class="fa fa-pencil"></i>', null)
                ],

                [
                    'linkClass' => 'deleteButton btn btn-danger shadow btn-xs sharp',
                    'link' => route('backend.websitepage.destroy', $data->id),
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
            ['fieldName' => 'menu_name', 'class' => 'text-center text-wrap'],
            ['fieldName' => 'name', 'class' => 'text-center text-wrap'],
            ['fieldName' => 'slug', 'class' => 'text-center text-wrap'],
            ['fieldName' => 'status', 'class' => 'text-center text-wrap'],
        ];
    }

    private function getTableHeaders()
    {
        return [
            'Sl/No',
            'menu',
            'Name',
            'Slug',
            'Status',
            'Action'
        ];
    }

    public function create()
    {
        return Inertia::render(
            'Backend/WebsitePage/Form',
            [
                'pageTitle' => fn() => 'WebsitePage Create',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'WebsitePage Manage'],
                    ['link' => route('backend.websitepage.create'), 'title' => 'WebsitePage Create'],
                ],
                'countedData' => fn() => $this->countedData(),
                'menus' => fn() => $this->MenuService->activeList(),
            ]
        );
    }

    public function store(WebsitePageRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            $dataInfo = $this->WebsitePageService->create($data);

            if ($dataInfo) {
                $message = 'WebsitePage created successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'website_pages', $message);

                DB::commit();

                return redirect()->route("backend.websitepage.index")->with('successMessage', $message);
            } else {
                DB::rollBack();
                $message = "Failed to create WebsitePage.";
                return redirect()->back()->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'WebsitePageController', 'store', substr($err->getMessage(), 0, 1000));
            $message = "Server Errors Occurred. Please Try Again.";
            return redirect()->back()->with('errorMessage', $message);
        }
    }

    public function edit($id)
    {
        $websitepage = $this->WebsitePageService->find($id);

        return Inertia::render(
            'Backend/WebsitePage/Form',
            [
                'pageTitle' => fn() => 'WebsitePage Edit',
                'breadcrumbs' => fn() => [
                    ['link' => null, 'title' => 'WebsitePage Manage'],
                    ['link' => route('backend.websitepage.edit', $id), 'title' => 'WebsitePage Edit'],
                ],
                'websitepage' => fn() => $websitepage,
                'id' => fn() => $id,
                'countedData' => fn() => $this->countedData(),
                'menus' => fn() => $this->MenuService->activeList(),
            ]
        );
    }

    public function update(WebsitePageRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $websitepage = $this->WebsitePageService->find($id);





            $dataInfo = $this->WebsitePageService->update($data, $id);

            if ($dataInfo) {
                $message = 'WebsitePage updated successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'website_pages', $message);

                DB::commit();

                return redirect()->route("backend.websitepage.index")->with('successMessage', $message);
            } else {
                DB::rollBack();
                $message = "Failed to update WebsitePage.";
                return redirect()->back()->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'WebsitePageController', 'update', substr($err->getMessage(), 0, 1000));
            $message = "Server Errors Occurred. Please Try Again.";
            return redirect()->back()->with('errorMessage', $message);
        }
    }

    public function changeStatus($id, $status)
    {
        try {

            $dataInfo = $this->WebsitePageService->changeStatus($id, $status);

            if ($dataInfo->wasChanged()) {
                $message = 'WebsitePage ' . request()->status . ' Successfully';
                $this->storeAdminWorkLog($dataInfo->id, 'website_pages', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To " . request()->status . "WebsitePage.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'WebsitePageController', 'changeStatus', substr($err->getMessage(), 0, 1000));
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

            if ($this->WebsitePageService->delete($id)) {
                $message = 'WebsitePage deleted successfully';
                $this->storeAdminWorkLog($id, 'website_pages', $message);

                DB::commit();

                return redirect()
                    ->back()
                    ->with('successMessage', $message);
            } else {
                DB::rollBack();

                $message = "Failed To Delete WebsitePage.";
                return redirect()
                    ->back()
                    ->with('errorMessage', $message);
            }
        } catch (Exception $err) {
            DB::rollBack();
            $this->storeSystemError('Backend', 'WebsitePageController', 'destroy', substr($err->getMessage(), 0, 1000));
            DB::commit();
            $message = "Server Errors Occur. Please Try Again.";
            return redirect()
                ->back()
                ->with('errorMessage', $message);
        }
    }
}
