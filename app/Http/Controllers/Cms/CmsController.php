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
        
        return view('cms.pages.home', compact('cmsSetting'));
    }


}
