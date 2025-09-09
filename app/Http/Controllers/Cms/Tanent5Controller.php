<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tanent;
use App\Models\Website;
use App\Models\WebsiteMenu;
use App\Models\WebsitePage;
use App\Models\CmsSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Traits\SystemTrait;

class Tanent5Controller extends Controller
{
    use SystemTrait;
    public function index(Request $request)
    {
        extract($this->getWebsiteData($request));
        $pageComponents = WebsitePage::where("slug", "home")->first();
        return view("cms.pages.5.home", compact("pageComponents","cmsSetting", "website_menus", "website", "slug"));
    }

}