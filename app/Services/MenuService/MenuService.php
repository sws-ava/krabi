<?php

namespace App\Services\MenuService;

use App\Models\Admin\Goods;
use App\Models\Admin\GoodsCats;
use App\Models\Admin\GoodsItems;
use App\Models\Admin\News;
use App\Models\Admin\Page;
use Illuminate\Support\Facades\App;

class MenuService

{
    public function __construct()
    {

    }

    public static function getCategories()
    {
        $current_locale = App::getLocale();
        $cats = GoodsCats::orderBy('order', 'asc')->get();
        foreach ($cats as $item) {
            $item->title = $item->title_ru;
            $item->description = $item->description_ru;
            $item->content = $item->content_ru;

            if($current_locale === 'ua') {
                if($item->title_ua){
                    $item->title = $item->title_ua;
                }else{
                    $item->title = $item->title_ru;
                }
                if($item->description_ua){
                    $item->description = $item->description_ua;
                }else{
                    $item->description = $item->description_ru;
                }
                if($item->content_ua){
                    $item->content = $item->content_ua;
                }else{
                    $item->content = $item->content_ru;
                }
            }
            $item->goods = self::getGoodsByCat($item->id);
        }
        return $cats;
    }

    public static function getCategory($id)
    {
        $current_locale = App::getLocale();
        $item = GoodsCats::find($id);
        $item->title = $item->title_ru;
        $item->description = $item->description_ru;
        $item->content = $item->content_ru;

        if($current_locale === 'ua') {
            if($item->title_ua){
                $item->title = $item->title_ua;
            }else{
                $item->title = $item->title_ru;
            }
            if($item->description_ua){
                $item->description = $item->description_ua;
            }else{
                $item->description = $item->description_ru;
            }
            if($item->content_ua){
                $item->content = $item->content_ua;
            }else{
                $item->content = $item->content_ru;
            }
        }
        $item->goods = self::getGoodsByCat($item->id);
        return $item;
    }

    public static function getGoodsByCat($catId)
    {
        $current_locale = App::getLocale();
        $items = Goods::orderBy('order', 'asc')->where('category', $catId)->get();
        foreach ($items as $item) {
            $item->title = $item->title_ru;
            $item->description = $item->description_ru;
            $item->desc = $item->desc_ru;
            $item->content = $item->content_ru;
            if($current_locale === 'ua') {
                if($item->title_ua){
                    $item->title = $item->title_ua;
                }else{
                    $item->title = $item->title_ru;
                }
                if($item->description_ua){
                    $item->description = $item->description_ua;
                }else{
                    $item->description = $item->description_ru;
                }
                if($item->content_ua){
                    $item->content = $item->content_ua;
                }else{
                    $item->content = $item->content_ru;
                }
                if($item->desc_ua){
                    $item->desc = $item->desc_ua;
                }else{
                    $item->desc = $item->desc_ru;
                }
//                $item->title = $item->title_ua;
//                $item->description = $item->description_ua;
//                $item->desc = $item->desc_ua;
//                $item->content = $item->content_ua;
            }
            $item->goodsItems = self::getGoodsItemsByGoods($item->id);
        }
        return $items;
    }

    public static function getGoodsItemsByGoods($goodId)
    {
        $current_locale = App::getLocale();
        $items = GoodsItems::orderBy('order', 'asc')->where('item', $goodId)->get();
        foreach ($items as $item) {
            $item->title = $item->title_ru;
            if($current_locale === 'ua') {
                $item->title = $item->title_ua;
            }
        }
        return $items;
    }



    public static function getGoodItem($id)
    {
        $current_locale = App::getLocale();
        $item = Goods::find($id);
        $item->title = $item->title_ru;
        $item->description = $item->description_ru;
        $item->desc = $item->desc_ru;
        $item->content = $item->content_ru;
        if($current_locale === 'ua') {
            if($item->title_ua){
                $item->title = $item->title_ua;
            }else{
                $item->title = $item->title_ru;
            }
            if($item->description_ua){
                $item->description = $item->description_ua;
            }else{
                $item->description = $item->description_ru;
            }
            if($item->content_ua){
                $item->content = $item->content_ua;
            }else{
                $item->content = $item->content_ru;
            }
            if($item->desc_ua){
                $item->desc = $item->desc_ua;
            }else{
                $item->desc = $item->desc_ru;
            }
        }
        $item->goodsItems = self::getGoodsItemsByGoods($item->id);
        return $item;
    }
}
