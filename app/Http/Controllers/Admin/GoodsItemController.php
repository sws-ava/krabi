<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\GoodsItems;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Goods;
use App\Models\Admin\GoodsCats;
use Illuminate\Support\Facades\Storage;

class GoodsItemController extends Controller
{
    public function orderTop(Request $request){
        $itemToRight = GoodsItems::where('item', $request->price['item'])->where('order', $request->price['order'] - 1)->first();
        $itemToLeft = GoodsItems::where('item', $request->price['item'])->where('order', $request->price['order'])->first();
        $itemToRight->order = $request->price['order'];
        $itemToRight->save();
        $itemToLeft->order = $request->price['order'] - 1;
        $itemToLeft->save();
    }
    public function orderBottom(Request $request){
        // return $request;
        $itemToLeft = GoodsItems::where('item', $request->price['item'])->where('order', $request->price['order'] + 1)->first();
        $itemToRight = GoodsItems::where('item', $request->price['item'])->where('order', $request->price['order'])->first();
        $itemToRight->order = $request->price['order'] + 1;
        $itemToRight->save();
        $itemToLeft->order = $request->price['order'];
        $itemToLeft->save();
    }
    public function addSubItem(Request $request){
        // return $request;
        $newSubItem = new GoodsItems();
        $newSubItem->title_ru = $request->newSubItem['title_ru'];
        $newSubItem->title_ua = $request->newSubItem['title_ua'];
        $newSubItem->weight = $request->newSubItem['weight'];
        $newSubItem->weightKind = $request->newSubItem['weightKind'];
        $newSubItem->price = $request->newSubItem['price'];
        $newSubItem->order = $request->newSubItem['order'];
        $newSubItem->item = $request->item;
        $newSubItem->save();
        return $newSubItem->id;
    }
    public function editSubItem(Request $request){
        $editedSubItem = GoodsItems::where('id', $request->item['id'])->first();
        $editedSubItem->title_ru = $request->item['title_ru'];
        $editedSubItem->title_ua = $request->item['title_ua'];
        $editedSubItem->weight = $request->item['weight'];
        $editedSubItem->weightKind = $request->item['weightKind'];
        $editedSubItem->price = $request->item['price'];
        $editedSubItem->item = $request->item['item'];
        $editedSubItem->save();
    }
    public function deleteSubItem(Request $request){
        $subItem = GoodsItems::where('id', $request->item['id'])->first();
        $subItem->delete();

        $subItems = GoodsItems::orderBy('order', 'asc')->where('item', $request->item['item'])->get();
        $i = 1;
        foreach ($subItems as $subItem) {
            $item = GoodsItems::where('id', $subItem->id)->first();
            $item->order = $i;
            $item->save();
            $i++;
        }
    }
    public function removeItemPhoto(Request $request){
        $good = Goods::where('id', $request->item['id'])->first();
        Storage::disk('public')->delete($request->item['picture']);
        $good->picture = '';
        $good->save();
    }
    public function uploadItemPhoto(Request $request){
        $path = $request['file']->store('/images/1', 'public');
        $good = Goods::where('id', $request['itemId'])->first();
        $good->picture = $path;
        $good->save();
        return $path;
    }
    public function removeItem(Request $request){
        // remove item;
        $good = Goods::where('id', $request->item['id'])->first();
        $good->delete();

        // remove item img file from server
        if($request->item['picture'] != ''){
            Storage::disk('public')->delete($request->item['picture']);
        }

        // reorder items in category
        $goodsInCat = Goods::where('category', $request->item['category'])->orderBy('order', 'asc')->get();
        $i = 1;
        foreach ($goodsInCat as $goodInCat){
            $goodInCat = Goods::where('id', $goodInCat->id)->first();
            $goodInCat->order = $i;
            $goodInCat->save();
            $i++;
        }

        // remove subItems by item
        $subItems = GoodsItems::where('item', $request->item['id'])->get();
        foreach($subItems as $subItem){
            $sItem = GoodsItems::where('id', $subItem->id)->first();
            $sItem->delete();
        }
    }
    public function editItem(Request $request){
        $countGoodsInCat = Goods::where('category', $request->item['category'])->orderBy('order', 'asc')->count();
        $item = Goods::where('id', $request->item['id'])->first();
        $oldItemsInCat = Goods::where('category', $item->category)->where('id', '!=',  $item->id)->orderBy('order', 'asc')->get();
        if($request->item['category'] != $item->category){
            $i = 1;
            foreach ($oldItemsInCat as $it){
                $it = Goods::where('id', $it->id)->first();
                $it->order = $i;
                $it->save();
                $i++;
            }
            $item->order = $countGoodsInCat + 1;
        }
        $item->title_ru = $request->item['title_ru'];
        $item->title_ua = $request->item['title_ua'];
        $item->description_ru = $request->item['description_ru'];
        $item->description_ua = $request->item['description_ua'];
        $item->desc_ru = $request->item['desc_ru'];
        $item->desc_ua = $request->item['desc_ua'];
        $item->category = $request->item['category'];
        $item->slug = $request->item['slug'];
        $item->save();
    }
    public function addItem(Request $request){

        // 

        
        $countGoodsInCat = Goods::where('category', $request->item['category'])->get();
        $countGoodsInCat = $countGoodsInCat->count();
        // return $countGoodsInCat;
        $item = new Goods();

        $item->title_ru = $request->item['title_ru'];
        $item->title_ua = $request->item['title_ua'];
        $item->category = $request->item['category'];
        $item->order = $countGoodsInCat + 1;
        $item->save();

        return $item->id;
    }
    
}
