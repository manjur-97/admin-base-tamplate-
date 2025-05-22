<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsSetting;
class CmsController extends Controller
{
    public function index()
    {
        $cmsSetting = CmsSetting::first();
        $header = $cmsSetting->header;
        // $headerContent = file_get_contents(resource_path('views/cms/layout/header/' . $header));
        return view('cms.pages.home', compact('cmsSetting'));
    }


}
