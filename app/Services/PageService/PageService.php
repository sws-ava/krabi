<?php

namespace App\Services\PageService;

use App\Models\Admin\Page;
use Illuminate\Support\Facades\App;

class PageService

{
    public function __construct()
    {

    }

    public static function getPageContent($id)
    {
        $current_locale = App::getLocale();

        $response = Page::find($id);

        $page = $response;

        $page->title = $response->title_ru;
        $page->description = $response->description_ru;
        $page->content = $response->content_ru;

        if($current_locale === 'ua') {
            $page->title = $page->title_ua;
            $page->description = $page->description_ua;
            $page->content = $page->content_ua;
        }

        return $page;
    }
}
