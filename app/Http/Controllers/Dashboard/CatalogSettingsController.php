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


        $opts = [
            "http" => [
                "method" => "GET",
                "header" => 'Content-Type: application/json; charset=utf-8'
            ]
        ];
        $context = stream_context_create($opts);

        $textMessage = '';
        if($flag){
            $textMessage = 'Возможность принятия заказа с сайта ВКЛЮЧЕНА';
        }else{
            $textMessage = 'Возможность принятия заказа с сайта ОТКЛЮЧЕНА';
        }
        $textMessage = urlencode($textMessage);

        $token = env('TG_TOKEN');
        $chat = env('TG_CHAT');
        $urlQuery = "https://api.telegram.org/bot". $token ."/sendMessage?chat_id=". $chat ."&text=" . $textMessage;

        $response = @file_get_contents($urlQuery, false, $context);


        return redirect()->back();
    }
}
