<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\CmsSetting;
use Illuminate\Support\Facades\File;

class CmsSettingController extends Controller
{
    public function headerList()
    {
        $headerPath = resource_path('views/cms/layout/header');
        $headerFiles = File::files($headerPath);
        $headers = [];
        $activeHeader = CmsSetting::first();

        foreach ($headerFiles as $file) {
            $fileName = $file->getFilename();

            if (str_starts_with($fileName, 'header_')) {
                $id = str_replace(['header_', '.blade.php'], '', $fileName);
                $name = 'Header ' . ucfirst($id);
                $fileContent = File::get($file->getPathname());

                $headers[] = [
                    'id' => $id,
                    'file_name' => $fileName,
                    'name' => $name,
                    'file' => str_replace('.blade.php', '', $fileName),
                    'content' => $fileContent,
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
