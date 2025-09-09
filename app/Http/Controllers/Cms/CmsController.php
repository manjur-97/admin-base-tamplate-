<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsSetting;
use App\Models\Website;
use App\Models\WebsiteMenu;
use App\Models\WebsitePage;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;

class CmsController extends Controller
{
    public function index(Request $request)
    {

        $cmsSetting = CmsSetting::first();
        $header = $cmsSetting->header ?? "";

        return view('cms.pages.home', compact('cmsSetting'));
    }

    // Dynamic page methods will be added here

    public function video_gallery()
    {
        $pageComponents = WebsitePage::where('slug', 'video-gallery')->first();
        return view('cms.pages.video-gallery', compact('pageComponents'));
    }

    public function contact()
    {
        $pageComponents = WebsitePage::where('slug', 'contact')->first();
        return view('cms.pages.contact', compact('pageComponents'));
    }


    public function about()
    {
        $pageComponents = WebsitePage::where('slug', 'about')->first();
        return view('cms.pages.about', compact('pageComponents'));
    }

    public function page_create($id)
    {
        // 1. মেনুসমূহ (এই ওয়েবসাইটের জন্য)
        $website_id = $id;
        $menus = WebsiteMenu::where('website_id', $id)->where('status', 'Active')->get();


        $componentBase = resource_path('views/cms/components');


        $groupedComponentFiles = [];
        foreach (\File::directories($componentBase) as $dir) {
            $group = basename($dir);
            $groupedComponentFiles[$group] = [];
            foreach (\File::files($dir) as $file) {
                $name = str_replace('.blade.php', '', $file->getFilename());
                $content = \File::get($file->getPathname());
                $groupedComponentFiles[$group][] = [
                    'name' => $name,
                    'content' => $content, // চাইলে Blade::render($content, []) দিয়ে preview দেখাতে পারেন
                ];
            }
        }
        // dd(  $groupedComponentFiles);

        return view('tanent.pages.page_create.index', compact('menus', 'groupedComponentFiles', 'website_id'));
    }
    public function page_edit($page_id)
    {
        $page = WebsitePage::findOrFail($page_id);
        $website_id=$page->website_id;
        $menus = WebsiteMenu::where('website_id',  $website_id)->where('status', 'Active')->get();

        $componentBase = resource_path('views/cms/components');
        $groupedComponentFiles = [];
        foreach (\File::directories($componentBase) as $dir) {
            $group = basename($dir);
            $groupedComponentFiles[$group] = [];
            foreach (\File::files($dir) as $file) {
                $name = str_replace('.blade.php', '', $file->getFilename());
                $content = \File::get($file->getPathname());
                $groupedComponentFiles[$group][] = [
                    'name' => $name,
                    'content' => $content,
                ];
            }
        }

        return view('tanent.pages.page_create.index', compact('menus', 'groupedComponentFiles', 'website_id', 'page'));
    }

    public function configuration($id)
    {

        $website_id = $id;
        $website = Website::where('id', $website_id)->first();


        return view('tanent.pages.configuration.page.basic_conf', compact('website_id', 'website'));
    }
    public function header_config($id)
    {

        $website_id = $id;
        $headers = $this->header($website_id);

        return view('tanent.pages.configuration.page.header_conf', compact('headers', 'website_id'));
    }
    public function header_customization($id)
    {

        $website_id = $id;
        $header=CmsSetting::where('website_id', $website_id)->first();

        return view('tanent.pages.configuration.page.header_customization', compact('header', 'website_id'));
    }

    public function footer_config($id)
    {
        $website_id = $id;
        $footers = $this->footer($website_id);
        return view('tanent.pages.configuration.page.footer_conf', compact('footers', 'website_id'));
    }

    public function menu_config($id)
    {
        $website_id = $id;

        // Load all menus for this website with their children
        $menus = WebsiteMenu::where('website_id', $id)
            ->where('status', 'Active')
            ->with(['children' => function ($query) use ($id) {
                $query->where('website_id', $id)
                    ->where('status', 'Active')
                    ->orderBy('order');
            }])
            ->orderBy('order')
            ->get();



        return view('tanent.pages.configuration.page.menu_conf', compact('menus', 'website_id'));
    }
    public function pages_config($id)
    {
        $website_id = $id;

        // Load all menus for this website with their children
        $pages = WebsitePage::where('website_id', $id)
            ->where('status', 'Active')
            ->get();


        return view('tanent.pages.configuration.page.page_conf', compact('pages', 'website_id'));
    }


    public function header($website_id)
    {
        $headerPath = resource_path('views/cms/layout/header');
        $headerFiles = File::files($headerPath);
        $headers = [];
        $activeHeader = CmsSetting::where("website_id", $website_id)->first();

        // Create dummy menu data for preview
        $dummyMenus = [];


        foreach ($headerFiles as $file) {
            $fileName = $file->getFilename();

            if (str_starts_with($fileName, 'header_')) {
                $id = str_replace(['header_', '.blade.php'], '', $fileName);
                $name = 'Header ' . ucfirst($id);
                $fileContent = File::get($file->getPathname());

                $processedContent = Blade::render($fileContent, ['website_menus' => $dummyMenus]);



                $headers[] = [
                    'id' => $id,
                    'file_name' => $fileName,
                    'name' => $name,
                    'file' => str_replace('.blade.php', '', $fileName),
                    'content' => $processedContent,
                    'is_active' => $activeHeader && $activeHeader->header == $fileName
                ];
            }
        }

        return $headers;
    }

    public function footer()
    {
        $footerPath = resource_path('views/cms/layout/footer');
        $footerFiles = File::files($footerPath);
        $footers = [];
        $activeFooter = CmsSetting::first();

        foreach ($footerFiles as $file) {
            $fileName = $file->getFilename();

            if (str_starts_with($fileName, 'footer_')) {
                $id = str_replace(['footer_', '.blade.php'], '', $fileName);
                $name = 'Footer ' . ucfirst($id);
                $fileContent = File::get($file->getPathname());

                $footers[] = [
                    'id' => $id,
                    'file_name' => $fileName,
                    'name' => $name,
                    'file' => str_replace('.blade.php', '', $fileName),
                    'content' => $fileContent,
                    'is_active' => $activeFooter && $activeFooter->footer == $fileName
                ];
            }
        }
        return  $footers;
    }
}
