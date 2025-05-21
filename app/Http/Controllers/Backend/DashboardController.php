<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Services\DashboardService;

use DateTime;
use Inertia\Inertia;
use Exception;

class DashboardController extends Controller
{
    protected $dashboardService;


    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;

    }

    public function index()
    {



        $data = [
            'pageTitle' => 'Dashboard',
            'breadcrumbs' => [
                ['link' => route('backend.dashboard'), 'title' => 'Dashboard'],
            ],

        ];

        return Inertia::render('Backend/Dashboard', $data);
    }




}
