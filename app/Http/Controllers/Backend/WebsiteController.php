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
            'website_id' => 'required',
            'parent_id' => 'nullable|exists:website_menus,id',
            
        ]);
        $lastOrder = WebsiteMenu::where('website_id', $request->website_id)->max('order');

        $existingMenu = WebsiteMenu::whereRaw('LOWER(name) = ?', [strtolower($request->name)])
            ->where('website_id', $request->website_id)
            ->first();
            
        if ($existingMenu) {
            return response()->json([
                'message' => 'Menu with this name already exists.'
            ], 422);
        }

        $menu = WebsiteMenu::create([
            'name' => $request->name,
            'website_id' => $request->website_id,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'order' => $lastOrder + 1,
            'status' => "Active"
        ]);

        return response()->json([
            'message' => 'Menu created successfully.',
            'menu' => $menu
        ], 201);
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'website_id' => 'required',
            'parent_id' => 'nullable|exists:website_menus,id',
            'order' => 'required|integer|min:0',
            'status' => 'required|in:Active,Inactive'
        ]);

        $menu = WebsiteMenu::findOrFail($id);

        // Check for duplicate name (case-insensitive) excluding current menu
        $existingMenu = WebsiteMenu::whereRaw('LOWER(name) = ?', [strtolower($request->name)])
            ->where('website_id', $request->website_id)
            ->where('id', '!=', $id)
            ->first();
            
        if ($existingMenu) {
            return response()->json([
                'message' => 'Menu with this name already exists (case-insensitive).'
            ], 422);
        }

        $menu->update([
            'name' => $request->name,
            'website_id' => $request->website_id,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'order' => $request->order,
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Menu updated successfully.',
            'menu' => $menu
        ], 200);
    }

    public function destroy($id)
    {
        $menu = WebsiteMenu::findOrFail($id);
        
        // Delete all children first
        $menu->children()->delete();
        $menu->delete();

        return response()->json([
            'message' => 'Menu deleted successfully.'
        ], 200);
    }

    public function reorder(Request $request, $id)
    {
        $request->validate([
            'parent_id' => 'nullable|exists:website_menus,id',
            'order' => 'required|integer|min:0',
            'website_id' => 'required'
        ]);

        $menu = WebsiteMenu::findOrFail($id);
        
        // Update the menu with new parent_id and order
        $menu->update([
            'parent_id' => $request->parent_id,
            'order' => $request->order
        ]);

        // Reorder all menus in the same parent to ensure proper ordering
        $siblings = WebsiteMenu::where('parent_id', $request->parent_id)
            ->where('website_id', $request->website_id)
            ->where('id', '!=', $id)
            ->orderBy('order')
            ->get();

        $order = 0;
        foreach ($siblings as $sibling) {
            if ($order == $request->order) {
                $order++; // Skip the position where we just placed our menu
            }
            $sibling->update(['order' => $order]);
            $order++;
        }

        return response()->json([
            'message' => 'Menu order updated successfully.',
            'menu' => $menu
        ], 200);
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
