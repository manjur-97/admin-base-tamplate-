<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\CmsSetting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;

class CmsSettingController extends Controller
{
    public function headerList()
    {
        $headerPath = resource_path('views/cms/layout/header');
        $headerFiles = File::files($headerPath);
        $headers = [];
        $activeHeader = CmsSetting::first();

        // Create dummy menu data for preview
        $dummyMenus = collect([
            (object)[
                'name' => 'Home',
                'url' => '#',
                'children' => collect([])
            ],
            (object)[
                'name' => 'Products',
                'url' => '#',
                'children' => collect([
                    (object)['name' => 'Category 1', 'url' => '#'],
                    (object)['name' => 'Category 2', 'url' => '#'],
                    (object)['name' => 'Category 3', 'url' => '#']
                ])
            ],
            (object)[
                'name' => 'About',
                'url' => '#',
                'children' => collect([])
            ],
            (object)[
                'name' => 'Contact',
                'url' => '#',
                'children' => collect([
                    (object)['name' => 'Support', 'url' => '#'],
                    (object)['name' => 'Sales', 'url' => '#']
                ])
            ]
        ]);

        foreach ($headerFiles as $file) {
            $fileName = $file->getFilename();

            if (str_starts_with($fileName, 'header_')) {
                $id = str_replace(['header_', '.blade.php'], '', $fileName);
                $name = 'Header ' . ucfirst($id);
                $fileContent = File::get($file->getPathname());

                // Process the Blade template with dummy data
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

        return Inertia::render('Backend/CmsSetting/HeaderList', [
            'headers' => $headers
        ]);
    }

    public function footerList()
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

        return Inertia::render('Backend/CmsSetting/FooterList', [
            'footers' => $footers
        ]);
    }

    public function saveHeader(Request $request)
    {
        $request->validate([
            'header' => 'required|string',
            'file_name' => 'required|string'
        ]);

        $settings = CmsSetting::first() ?? new CmsSetting();

        $settings->header = $request->file_name;
        $settings->save();

        return redirect()
            ->back()
            ->with('successMessage', 'Header updated successfully');
    }

    public function saveFooter(Request $request)
    {
        $request->validate([
            'footer' => 'required|string',
            'file_name' => 'required|string'
        ]);

        $settings = CmsSetting::first() ?? new CmsSetting();

        $settings->footer = $request->file_name;
        $settings->save();

        return redirect()
            ->back()
            ->with('successMessage', 'Footer updated successfully');
    }
}
