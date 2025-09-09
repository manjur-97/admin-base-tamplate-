<?php

namespace App\Http\Controllers\Tanent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\Category;
use App\Models\CmsSetting;
use App\Models\WebsiteMenu;
use App\Models\WebsitePage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TanentDashboardController extends Controller
{
    public function index()
    {
        $tanent = auth()->guard('tanent')->user();
        $website = Website::where('tanent_id', $tanent->id)->get();
        return view('tanent.dashboard', compact('website'));
    }
    public function create()
    {
        $tanent = auth()->guard('tanent')->user();
        $category = Category::all();
        return view('tanent.pages.website.create', compact('category', 'tanent'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'tanent_id' => 'required|exists:tanents,id',
                'category_id' => 'required|exists:categories,id',
                'logo' => 'nullable|image|max:2048',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'email' => 'nullable|email|max:255',
                'mobile' => 'nullable|string|max:30',
                'address' => 'nullable|string|max:255',
                'facebook' => 'nullable|string|max:255',
                'linkedin' => 'nullable|string|max:255',
                'youtube' => 'nullable|string|max:255',
                'twitter' => 'nullable|string|max:255',
                'instagram' => 'nullable|string|max:255',
                'git' => 'nullable|string|max:255',
                'status' => 'required|in:active,inactive,deleted',
            ]);

            // Generate slug from title
            $slug = $request->input('slug') ?:
                strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($request->input('title'))));
            $slug = trim($slug, '-');

            // Ensure slug is unique
            $originalSlug = $slug;
            $i = 1;
            while (\App\Models\Website::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $i;
                $i++;
            }
            $validated['slug'] = $slug;
            $validated['status'] = 'active';

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('logos', 'public');
                $validated['logo'] = $logoPath;
            }

            $website = Website::create($validated);

            $menu=WebsiteMenu::create([
                'name' => 'Home',
                'website_id' => $website->id,
                'slug' => Str::slug("Home"),
                'parent_id' => null,
                'order' => '1',
                'status' => "Active"
            ]);
            WebsitePage::create([
                'name' => 'Home',
                'website_id' => $website->id,
                'slug' => null,
                'components' => null,
                'menu_id' =>  $menu->id,
                'status' => "Active"
            ]);

            $this->createTanentController($website);

            // Create tenant-specific view if not exists
            $viewDir = resource_path('views/cms/pages/' . $website->id);
            $viewPath = $viewDir . '/home.blade.php';
            if (!file_exists($viewPath)) {
                if (!is_dir($viewDir)) {
                    mkdir($viewDir, 0777, true);
                }
                $viewContent = "@extends('cms.app')\n\n@section('content')\n    <h1>Home</h1>\n@endsection\n";
                file_put_contents($viewPath, $viewContent);
            }

            $routeFile = base_path('routes/cms_dynamic.php');
            $routeContent = "\nRoute::get('/{$website->slug}', [\\App\\Http\\Controllers\\Cms\\Tanent{$website->id}Controller::class, 'index'])->name('{$website->slug}');\n";
            file_put_contents($routeFile, $routeContent, FILE_APPEND);

            DB::commit();
            return redirect()->route('tanent.dashboard');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }



    /**
     * Create tenant-specific controller after OTP verification
     */
    private function createTanentController($website)
    {
        // Create tenant-specific controller file
        $controllerName = 'Tanent' . $website->id . 'Controller';
        $controllerPath = app_path('Http/Controllers/Cms/' . $controllerName . '.php');

        if (!file_exists($controllerPath)) {
            $controllerContent = $this->generateTanentControllerContent($controllerName, $website);
            file_put_contents($controllerPath, $controllerContent);
        }
    }

    /**
     * Generate tenant-specific controller content
     */

    private function generateTanentControllerContent($controllerName, $website)
    {
        return '<?php

namespace App\\Http\\Controllers\\Cms;

use App\\Http\\Controllers\\Controller;
use Illuminate\\Http\\Request;
use App\\Models\\Tanent;
use App\\Models\\Website;
use App\\Models\\WebsiteMenu;
use App\\Models\\WebsitePage;
use App\\Models\\CmsSetting;
use Illuminate\\Support\\Facades\\Auth;
use Illuminate\\Support\\Facades\\Validator;
use App\\Traits\\SystemTrait;

class ' . $controllerName . ' extends Controller
{
    use SystemTrait;
    public function index(Request $request)
    {
        extract($this->getWebsiteData($request));
        $pageComponents = WebsitePage::where("slug", "home")->first();
        return view("cms.pages.' . $website->id . '.home", compact("pageComponents","cmsSetting", "website_menus", "website", "slug"));
    }

}';
    }
}
