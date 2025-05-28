<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsSetting;
use App\Models\WebsitePage;

class CmsController extends Controller
{
    public function index()
    {
        $cmsSetting = CmsSetting::first();
        $header = $cmsSetting->header;

        return view('cms.pages.home', compact('cmsSetting'));
    }

    // Dynamic page methods will be added here

    public function video_gallery()
    {
        $pageComponents = WebsitePage::where('slug', 'video-gallery')->first();
        return view('cms.pages.video-gallery', compact('pageComponents'));
    }


    public function about()
    {
        $pageComponents = WebsitePage::where('slug', 'about')->first();
        return view('cms.pages.about', compact('pageComponents'));
    }

}