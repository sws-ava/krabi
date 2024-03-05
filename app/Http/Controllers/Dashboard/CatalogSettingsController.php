<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\CatalogSetting;
use Illuminate\Http\Request;

class CatalogSettingsController extends Controller
{
    public static function is_online_order($flag)
    {
        $settings = CatalogSetting::query()->find(1);
        $settings->is_online_order = $flag;
        $settings->save();

        return redirect()->back();
    }
}
