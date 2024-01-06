<?php

namespace App\Services\NewsService;

use App\Models\Admin\News;
use App\Models\Admin\Page;
use Illuminate\Support\Facades\App;

class NewsService

{
    public function __construct()
    {

    }

    public static function getNews($cat)
    {
        $current_locale = App::getLocale();
        $response = News::where('cat', $cat)->where('show', 1)->orderBy('id', 'desc')->get();

        if($response){
            foreach ($response as $item) {
                $item->title = $item->title_ru;
                $item->description = $item->description_ru;
                $item->content = stripcslashes($item->content_ru);

                if($current_locale === 'ua') {
                    $item->title = $item->title_ua;
                    $item->description = $item->description_ua;
                    $item->content = stripcslashes($item->content_ua);
                }

            }
        }
        return $response;
    }
}
