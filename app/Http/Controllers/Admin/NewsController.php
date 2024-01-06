<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\News;

class NewsController extends Controller
{
//
//    public function getNewsByCat(Request $request){
//        if($request->cat == 0){
//            $pages = News::get();
//        }else{
//            $pages = News::where('cat', $request->cat)->get();
//        }
//        return $pages;
//    }
//    public function fetchNews(Request $request){
//        $page = News::find($request->pageId);
//        return $page;
//    }
//    public function saveNews(Request $request){
//        $page = News::find($request->page['id']);
//        $page->title_ru = $request->page['title_ru'];
//        $page->title_ua = $request->page['title_ua'];
//        $page->description_ru = $request->page['description_ru'];
//        $page->description_ua = $request->page['description_ua'];
//        $page->content_ru = $request->page['content_ru'];
//        $page->content_ua = $request->page['content_ua'];
//        $page->cat = $request->page['cat'];
//        $page->save();
//    }
//    public function addNews(Request $request){
//        $page = new News();
//        $page->title_ru = $request->page['title_ru'];
//        $page->title_ua = $request->page['title_ua'];
//        $page->description_ru = $request->page['description_ru'];
//        $page->description_ua = $request->page['description_ua'];
//        $page->content_ru = $request->page['content_ru'];
//        $page->content_ua = $request->page['content_ua'];
//        $page->cat = $request->page['cat'];
//        $page->save();
//        return $page->id;
//    }
//    public function deleteNews(Request $request){
//        $page = News::find($request->id);
//        $page->delete();
//    }
//    public function showPage(Request $request){
//        $page = News::find($request->page['id']);
//        $page->show == 0 ? $page->show = 1 : $page->show = 0;
//        $page->save();
//
//        return $page->show;
//    }


    // Client
    public function getNews(){
        $news = News::where('cat', 1)->orderBy('id', 'desc')->get();
        foreach ($news as $new) {
            if($request->locale == 'ua'){
                $new->title = $new->title_ua;
                $new->description = $new->description_ua;
                $new->content = $new->content_ua;
            }else{
                $new->title = $new->title_ru;
                $new->description = $new->description_ru;
                $new->content = $new->content_ru;
            }
        }
        return $news;
    }
    public function getSales(){
        $sales = News::where('cat', 2)->orderBy('id', 'desc')->get();
        foreach ($sales as $new) {
            if($request->locale == 'ua'){
                $new->title = $new->title_ua;
                $new->description = $new->description_ua;
                $new->content = $new->content_ua;
            }else{
                $new->title = $new->title_ru;
                $new->description = $new->description_ru;
                $new->content = $new->content_ru;
            }
        }
        return $sales;
    }


}
