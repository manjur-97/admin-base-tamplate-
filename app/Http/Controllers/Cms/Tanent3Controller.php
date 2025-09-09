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

class Tanent3Controller extends Controller
{
    use SystemTrait;
    public function index(Request $request)
    {
        extract($this->getWebsiteData($request));
        $pageComponents = WebsitePage::where("slug", "home")->first();
        return view("cms.pages.3.home", compact("pageComponents","cmsSetting", "website_menus", "website" , "slug"));
    }


    public function about(Request $request)
    {    
            extract($this->getWebsiteData($request));   
            $pageComponents = WebsitePage::where('slug', 'about')->first();        
            return view('cms.pages.3.about', compact('pageComponents','cmsSetting', 'website_menus', 'website', 'slug'));
        }


    public function contact(Request $request)
    {    
            extract($this->getWebsiteData($request));   
            $pageComponents = WebsitePage::where('slug', 'contact')->first();        
            return view('cms.pages.3.contact', compact('pageComponents','cmsSetting', 'website_menus', 'website', 'slug'));
        }

}