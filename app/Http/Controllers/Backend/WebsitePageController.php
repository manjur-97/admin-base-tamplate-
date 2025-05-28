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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Log;

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
        $componentPath = resource_path('views/cms/components');
        $files = File::allFiles($componentPath);

        $groupedComponentFiles = [];

        foreach ($files as $file) {
            $relativePath = $file->getRelativePath();
            $fileName = $file->getFilename();
            $fileContent = File::get($file->getPathname());

            // Process the Blade template with dummy data
            $processedContent = Blade::render($fileContent, [
                'website_menus' => [], // Add any dummy data needed for preview
                'data' => [] // Add any other dummy data needed
            ]);

            if (!isset($groupedComponentFiles[$relativePath])) {
                $groupedComponentFiles[$relativePath] = [];
            }

            $groupedComponentFiles[$relativePath][] = [
                'name' => $fileName,
                'content' => $processedContent,
                'raw_content' => $fileContent
            ];
        }

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
                'groupedComponentFiles' =>  $groupedComponentFiles,
            ]
        );
    }

    private function createDynamicPage($page)
    {
        // Create pages directory if it doesn't exist
        $pagesDirectory = resource_path('views/cms/pages');
        if (!File::exists($pagesDirectory)) {
            File::makeDirectory($pagesDirectory, 0755, true);
        }

        // Create blade template
        $bladePath = $pagesDirectory . '/' . $page->slug . '.blade.php';
        $bladeContent = $this->generateBladeContent($page);
        File::put($bladePath, $bladeContent);

        // Add route to web.php
        $routeContent = "\nRoute::get('/" . $page->slug . "', [App\Http\Controllers\Cms\CmsController::class, '" . $page->slug . "'])->name('" . $page->slug . "');";
        $webPath = base_path('routes/web.php');
        File::append($webPath, $routeContent);

        // Add method to CmsController
        $controllerPath = app_path('Http/Controllers/Cms/CmsController.php');
        $controllerContent = $this->generateControllerMethod($page);

        // Read the current controller content
        $currentContent = File::get($controllerPath);

        // Check if the method already exists
        $methodPattern = "/public\s+function\s+" . $page->slug . "\s*\(\)/";
        if (preg_match($methodPattern, $currentContent)) {
            // Method exists, replace it
            $pattern = "/public\s+function\s+" . $page->slug . "\s*\(\)\s*{[^}]*}/s";
            $newContent = preg_replace($pattern, $controllerContent, $currentContent);
        } else {
            // Method doesn't exist, add it before the last closing brace
            $newContent = preg_replace('/}\s*$/', $controllerContent . "\n}", $currentContent);
        }

        // Write back to the controller
        File::put($controllerPath, $newContent);
    }

    private function generateBladeContent($page)
    {
        $content = "@extends('cms.app')\n\n@section('content')\n";

        // Decode JSON components if it's a string
        $components = is_string($page->components) ? json_decode($page->components, true) : $page->components;

        // Ensure components is an array
        if (!is_array($components)) {
            $components = [];
        }

        // Sort components by position
        $components = collect($components)->sortBy('position');

        foreach ($components as $component) {
            if (!isset($component['name'])) {
                continue;
            }

            // Extract component type and number from the name (e.g., "contact_1" -> "contact", "1")
            $parts = explode('_', $component['name']);
            $componentType = $parts[0];

            // Remove .blade.php extension if present
            $componentName = str_replace('.blade.php', '', $component['name']);

            $content .= "    @include('cms.components." . $componentType . "." . $componentName . "')\n";
        }

        $content .= "@endsection";
        return $content;
    }

    private function generateControllerMethod($page)
    {
        return "\n    public function " . $page->slug . "()\n    {\n        \$pageComponents = WebsitePage::where('slug', '" . $page->slug . "')->first();\n        return view('cms.pages." . $page->slug . "', compact('pageComponents'));\n    }\n";
    }

    public function store(WebsitePageRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            // Validate menu_id if it's provided
            if (!empty($data['menu_id'])) {
                $menuExists = $this->MenuService->find($data['menu_id']);
                if (!$menuExists) {
                    DB::rollBack();
                    return redirect()->back()
                        ->with('errorMessage', 'The selected menu does not exist.')
                        ->withInput();
                }
            }

            // Ensure components is properly formatted as JSON
            if (isset($data['components'])) {
                $data['components'] = json_encode($data['components']);
            }

            $dataInfo = $this->WebsitePageService->create($data);

            if ($dataInfo) {
                // Create dynamic page
                $this->createDynamicPage($dataInfo);

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
            Log::error('WebsitePage Creation Error: ' . $err->getMessage());
            Log::error('Stack trace: ' . $err->getTraceAsString());

            $this->storeSystemError('Backend', 'WebsitePageController', 'store', substr($err->getMessage(), 0, 1000));

            if (str_contains($err->getMessage(), 'foreign key constraint fails')) {
                $message = "The selected menu is invalid or has been deleted.";
            } else {
                $message = "Server Errors Occurred. Please Try Again.";
            }

            return redirect()->back()
                ->with('errorMessage', $message)
                ->withInput();
        }
    }

    public function edit($id)
    {
        $websitepage = $this->WebsitePageService->find($id);
        $componentPath = resource_path('views/cms/components');
        $files = File::allFiles($componentPath);

        $groupedComponentFiles = [];

        foreach ($files as $file) {
            $relativePath = $file->getRelativePath();
            $fileName = $file->getFilename();
            $fileContent = File::get($file->getPathname());

            // Process the Blade template with dummy data
            $processedContent = Blade::render($fileContent, [
                'website_menus' => [], // Add any dummy data needed for preview
                'data' => [] // Add any other dummy data needed
            ]);

            if (!isset($groupedComponentFiles[$relativePath])) {
                $groupedComponentFiles[$relativePath] = [];
            }

            $groupedComponentFiles[$relativePath][] = [
                'name' => $fileName,
                'content' => $processedContent,
                'raw_content' => $fileContent
            ];
        }

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
                'groupedComponentFiles' => $groupedComponentFiles,
            ]
        );
    }

    public function update(WebsitePageRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $oldPage = $this->WebsitePageService->find($id);

            $dataInfo = $this->WebsitePageService->update($data, $id);

            if ($dataInfo) {
                // If slug has changed, update the files
                if ($oldPage->slug !== $dataInfo->slug) {
                    // Delete old blade file
                    $oldBladePath = resource_path('views/cms/pages/' . $oldPage->slug . '.blade.php');
                    if (File::exists($oldBladePath)) {
                        File::delete($oldBladePath);
                    }

                    // Update route in web.php
                    $webPath = base_path('routes/web.php');
                    $routeContent = File::get($webPath);
                    $oldRoute = "Route::get('/" . $oldPage->slug . "', [App\Http\Controllers\Cms\CmsController::class, '" . $oldPage->slug . "'])->name('" . $oldPage->slug . "');";
                    $newRoute = "Route::get('/" . $dataInfo->slug . "', [App\Http\Controllers\Cms\CmsController::class, '" . $dataInfo->slug . "'])->name('" . $dataInfo->slug . "');";
                    $newContent = str_replace($oldRoute, $newRoute, $routeContent);
                    File::put($webPath, $newContent);

                    // Update method in CmsController
                    $controllerPath = app_path('Http/Controllers/Cms/CmsController.php');
                    $controllerContent = File::get($controllerPath);
                    $oldMethodPattern = "/\s*public\s+function\s+" . $oldPage->slug . "\(\)\s*{[^}]*}/s";
                    $newMethod = $this->generateControllerMethod($dataInfo);
                    $newControllerContent = preg_replace($oldMethodPattern, $newMethod, $controllerContent);
                    File::put($controllerPath, $newControllerContent);
                }

                // Create/Update blade template
                $this->createDynamicPage($dataInfo);

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
            $page = $this->WebsitePageService->find($id);

            if ($page) {
                // Delete blade file
                $bladePath = resource_path('views/cms/pages/' . $page->slug . '.blade.php');
                if (File::exists($bladePath)) {
                    File::delete($bladePath);
                }

                // Remove route from web.php
                $webPath = base_path('routes/web.php');
                $routeContent = File::get($webPath);
                $routeToRemove = "Route::get('/" . $page->slug . "', [App\Http\Controllers\Cms\CmsController::class, '" . $page->slug . "'])->name('" . $page->slug . "');";
                $newContent = str_replace($routeToRemove, '', $routeContent);
                File::put($webPath, $newContent);

                // Remove method from CmsController
                $controllerPath = app_path('Http/Controllers/Cms/CmsController.php');
                $controllerContent = File::get($controllerPath);

                // Pattern to match the entire method
                $methodPattern = "/\s*public\s+function\s+" . $page->slug . "\(\)\s*{[^}]*}/s";
                $newControllerContent = preg_replace($methodPattern, '', $controllerContent);
                File::put($controllerPath, $newControllerContent);

                // Delete the page from database
                if ($this->WebsitePageService->delete($id)) {
                    $message = 'WebsitePage deleted successfully';
                    $this->storeAdminWorkLog($id, 'website_pages', $message);

                    DB::commit();

                    return redirect()
                        ->back()
                        ->with('successMessage', $message);
                }
            }

            DB::rollBack();
            $message = "Failed To Delete WebsitePage.";
            return redirect()
                ->back()
                ->with('errorMessage', $message);

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
