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
use App\Models\WebsiteMenu;
use Illuminate\Support\Str;

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
        $menus = WebsiteMenu::whereNull('parent_id')
            ->with('children')
            ->orderBy('order')
            ->get();

        return inertia('Backend/WebsiteMenu/Index', [
            'menus' => $menus
        ]);
    }

    public function create()
    {
        $parentMenus = WebsiteMenu::whereNull('parent_id')->get();
        return inertia('Backend/WebsiteMenu/Form', [
            'parentMenus' => $parentMenus
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:website_menus,id',
            'order' => 'required|integer|min:0',
            'status' => 'required|in:Active,Inactive'
        ]);

        $menu = WebsiteMenu::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'order' => $request->order,
            'status' => $request->status
        ]);

        return redirect()->route('backend.websitemenu.index')
            ->with('success', 'Menu created successfully.');
    }

    public function edit(WebsiteMenu $menu)
    {
        $parentMenus = WebsiteMenu::whereNull('parent_id')
            ->where('id', '!=', $menu->id)
            ->get();

        return inertia('Backend/WebsiteMenu/Form', [
            'menu' => $menu,
            'parentMenus' => $parentMenus
        ]);
    }

    public function update(Request $request, WebsiteMenu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:website_menus,id',
            'order' => 'required|integer|min:0',
            'status' => 'required|in:Active,Inactive'
        ]);

        $menu->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'order' => $request->order,
            'status' => $request->status
        ]);

        return redirect()->route('website.menus.index')
            ->with('success', 'Menu updated successfully.');
    }

    public function destroy(WebsiteMenu $menu)
    {
        // Delete all children first
        $menu->children()->delete();
        $menu->delete();

        return redirect()->route('website.menus.index')
            ->with('success', 'Menu deleted successfully.');
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
}
