<?php

namespace App\Http\Controllers;
use App\Models\Admin\Gallery;
use App\Models\Admin\Interior;
use App\Models\Admin\News;
use App\Models\Admin\Page;
use App\Services\DynamicTranlateService\DynamicTranlateService;
use App\Services\MenuService\MenuService;
use App\Services\NewsService\NewsService;
use App\Services\PageService\PageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use App\Services\LocaleService\LocaleService;
use Illuminate\View\View;

class PageController extends Controller
{
    public function main_page() : View
    {
        $page = PageService::getPageContent(1);
        $translates = DynamicTranlateService::getDynamicTranslates();
        $navigation = DynamicTranlateService::getNavigation();

        return view('main_page', compact('translates', 'navigation', 'page'));
    }
    public function menu()
    {
        $cats = MenuService::getCategories();
        $page = PageService::getPageContent(10);
        $translates = DynamicTranlateService::getDynamicTranslates();
        $navigation = DynamicTranlateService::getNavigation();

        return view('menu', compact('translates', 'navigation', 'page', 'cats'));
    }
    public function delivery() : View
    {
        $page = PageService::getPageContent(4);
        $translates = DynamicTranlateService::getDynamicTranslates();
        $navigation = DynamicTranlateService::getNavigation();
        return view('delivery', compact('translates', 'navigation', 'page'));
    }
    public function conception() : View
    {
        $page = PageService::getPageContent(2);
        $translates = DynamicTranlateService::getDynamicTranslates();
        $navigation = DynamicTranlateService::getNavigation();
        return view('conception', compact('translates', 'navigation', 'page'));
    }
    public function contacts() : View
    {
        $page = PageService::getPageContent(3);
        $translates = DynamicTranlateService::getDynamicTranslates();
        $navigation = DynamicTranlateService::getNavigation();
        return view('conception', compact('translates', 'navigation', 'page'));
    }
    public function gallery() : View
    {
        $images = Gallery::orderBy('order', 'asc')->get();
        foreach ($images as $image) {
            $image->path_lg = str_replace('s.jpg', '.jpg', $image->path);
        }

        $page = PageService::getPageContent(6);
        $translates = DynamicTranlateService::getDynamicTranslates();
        $navigation = DynamicTranlateService::getNavigation();
        return view('gallery', compact('translates', 'navigation', 'page', 'images'));
    }
    public function interior() : View
    {
        $images = Interior::orderBy('order', 'asc')->get();
        foreach ($images as $image) {
            $image->path_sm = str_replace('.jpg', 's.jpg', $image->path);
        }

        $page = PageService::getPageContent(7);
        $translates = DynamicTranlateService::getDynamicTranslates();
        $navigation = DynamicTranlateService::getNavigation();
        return view('interior', compact('translates', 'navigation', 'page', 'images'));
    }
    public function sale()
    {
//        $news = NewsService::getNews(2);

//        return $news;
        $page = PageService::getPageContent(8);
        $translates = DynamicTranlateService::getDynamicTranslates();
        $navigation = DynamicTranlateService::getNavigation();
        return view('sale', compact('translates', 'navigation', 'page'));
    }
    public function news()
    {

        $page = PageService::getPageContent(9);
        $translates = DynamicTranlateService::getDynamicTranslates();
        $navigation = DynamicTranlateService::getNavigation();
        return view('news', compact('translates', 'navigation', 'page'));
    }



}
