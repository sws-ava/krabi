<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CatalogSetting;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() : View
    {
        $catalog_settings = CatalogSetting::query()->find(1);
        return view('dashboard.main', compact('catalog_settings'));
    }
}
