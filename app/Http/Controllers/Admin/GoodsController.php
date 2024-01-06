<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Goods;
use App\Models\Admin\GoodsCats;
use App\Models\Admin\GoodsItems;
use Illuminate\Support\Facades\DB;

class GoodsController extends Controller
{
    public function getItemsByCategory(Request $request){
        $goods = Goods::orderBy('order', 'asc')->where('category', $request->catId)->get();
        foreach($goods as $good){
            $items = DB::table('goods_items')->where('item', $good->id)->get();
            $good->items = $items;
        }
        return $goods;
    }
    public function showSubItem(Request $request){
        $item = GoodsItems::where('id', $request->subItem['id'])->first();

        if($item->show == 1){
            $item->show = 0;
        }else{
            $item->show = 1;
        }
        $item->save();
    }
    public function showItem(Request $request){
        $item = Goods::where('id', $request->item['id'])->first();

        if($item->show == 1){
            $item->show = 0;
        }else{
            $item->show = 1;
        }
        $item->save();
    }
    public function changePriceFetch(Request $request){
        $item = GoodsItems::where('id', $request->subItem['id'])->first();
        $item->price = $request->price;
        $item->save();
    }
    public function orderTop(Request $request){
        // return $request;
        $itemToRight = Goods::where('category', $request->item['category'])->where('order', $request->item['order'] - 1)->first();
        $itemToLeft = Goods::where('category', $request->item['category'])->where('order', $request->item['order'])->first();
        $itemToRight->order = $request->item['order'];
        $itemToRight->save();
        $itemToLeft->order = $request->item['order'] - 1;
        $itemToLeft->save();
    }
    public function orderBottom(Request $request){
        $itemToLeft = Goods::where('category', $request->item['category'])->where('order', $request->item['order'] + 1)->first();
        $itemToRight = Goods::where('category', $request->item['category'])->where('order', $request->item['order'])->first();
        $itemToRight->order = $request->item['order'] + 1;
        $itemToRight->save();
        $itemToLeft->order = $request->item['order'];
        $itemToLeft->save();
    }
    public function getGoodsItem(Request $request){
        $item = Goods::where('id', $request->itemId)->first();
        $item->prices = DB::table('goods_items')->where('item', $item->id)->get();

        return $item;

    }
}
