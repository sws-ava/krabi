<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\GoodsCats;
use App\Models\Admin\Goods;

class GoodsCatsController extends Controller
{
    public function getGoodsCats(){
        $goodsCats = GoodsCats::orderBy('order', 'asc')->get();
        return $goodsCats;
    }
    public function getCategory(Request $request){
        $cat = GoodsCats::find($request->id);
        $cat->isChilds = Goods::where('category', $cat->id)->count();
        return $cat;
    }
    public function saveCategory(Request $request){
        $cat = GoodsCats::find($request->category['id']);
        $cat->title_ru = $request->category['title_ru'];
        $cat->title_ua = $request->category['title_ua'];
        $cat->description_ru = $request->category['description_ru'];
        $cat->description_ua = $request->category['description_ua'];
        $cat->slug = $request->category['slug'];
        $cat->save();
    }
    public function addCategory(Request $request){
        $countCats = GoodsCats::get();
        $countCats = $countCats->count();
        $cat = new GoodsCats();
        $cat->title_ru = $request->category['title_ru'];
        $cat->title_ua = $request->category['title_ua'];
        $cat->description_ru = $request->category['description_ru'];
        $cat->description_ua = $request->category['description_ua'];
        $cat->slug = $request->category['slug'];
        $cat->order = $countCats + 1;
        $cat->save();
        return $cat->id;
    }
    public function deleteCategory(Request $request){
        $cat = GoodsCats::where('id', $request->category['id'])->first();
        $cat->delete();
        $cats = GoodsCats::orderBy('order', 'asc')->get();
        $i = 1;
        foreach ($cats as $item) {
            $catItem = GoodsCats::where('id', $item->id)->first();
            $catItem->order = $i;
            $catItem->save();
            $i++;
        }
    }
    public function orderTop(Request $request){
        $catToRight = GoodsCats::where('order', $request->order - 1)->first();
        $catToLeft = GoodsCats::where('order', $request->order)->first();
        $catToRight->order = $request->order;
        $catToRight->save();
        $catToLeft->order = $request->order - 1;
        $catToLeft->save();
    }
    public function orderBottom(Request $request){
        $catToLeft = GoodsCats::where('order', $request->order + 1)->first();
        $catToRight = GoodsCats::where('order', $request->order)->first();
        $catToRight->order = $request->order + 1;
        $catToRight->save();
        $catToLeft->order = $request->order;
        $catToLeft->save();
    }
    public function showCategory(Request $request){
        $cat = GoodsCats::where('id', $request->id)->first();
        $cat->show = $request->show;
        $cat->save();
    }
}
