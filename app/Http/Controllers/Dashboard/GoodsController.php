<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\Goods;
use App\Models\Admin\GoodsCats;
use App\Models\Admin\GoodsItems;
use App\Services\MenuService\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats = GoodsCats::get();
        return view('dashboard.menu.goods.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $countGoodsInCat = Goods::where('category', $request->category)->get();
        $countGoodsInCat = $countGoodsInCat->count();
        $item = new Goods();

        $item->title_ru = $request->title_ru;
        $item->title_ua = $request->title_ua;
        $item->desc_ru = $request->desc_ru;
        $item->desc_ua = $request->desc_ua;
        $item->category = $request->category;
        $item->order = $countGoodsInCat + 1;
        $item->save();

        $item = MenuService::getGoodItem($item->id);
        return redirect('/goods/'.$item->id.'/edit');
//        return view('dashboard.menu.goods.edit', $item);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = MenuService::getGoodItem($id);
        return view('dashboard.menu.goods.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $request;
    }


    public function update_good(Request $request, string $id)
    {
        $item = Goods::find($id);

        if($request->file){
            if($item->picture){
                Storage::disk('public')->delete($item->picture);
                $item->picture = '';
            }
            $path = $request->file->store('/goods_images', 'public');
            $item->picture = $path;
        }

        $item->title_ru = $request['title_ru'];
        $item->title_ua = $request['title_ua'];
        $item->description_ru = $request['description_ru'];
        $item->description_ua = $request['description_ua'];
        $item->desc_ru = $request['desc_ru'];
        $item->desc_ua = $request['desc_ua'];
        $item->save();

        if($request->goodsItems){
            foreach ($request->goodsItems as $gItem) {
                $gooItem = GoodsItems::find($gItem['id']);
                $gooItem->title_ru = $gItem['title_ru'];
                $gooItem->title_ua = $gItem['title_ua'];
                $gooItem->weight = $gItem['weight'];
                $gooItem->weightKind = $gItem['weightKind'];
                $gooItem->price = str_replace(',', '.', $gItem['price']);
//                $gooItem->item = $gItem['item'];
                $gooItem->save();
            }

        }
        return redirect()->back();
    }


    public function remove_goods_photo(string $id)
    {
        $item = Goods::find($id);

        if($item->picture){
            Storage::disk('public')->delete($item->picture);
            $item->picture = '';
            $item->save();
        }

        return redirect()->back();
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }




    public function order_top(string $category, string $order){
        $catToRight = Goods::where('order', $order - 1)->where('category', $category)->first();
        $catToLeft = Goods::where('order', $order)->where('category', $category)->first();
        $catToRight->order = $order;
        $catToRight->save();
        $catToLeft->order = $order - 1;
        $catToLeft->save();

        return redirect()->back();
    }
    public function order_bottom(string $category, string $order){
        $catToLeft = Goods::where('order', $order + 1)->where('category', $category)->first();
        $catToRight = Goods::where('order', $order)->where('category', $category)->first();
        $catToRight->order = $order + 1;
        $catToRight->save();
        $catToLeft->order = $order;
        $catToLeft->save();

        return redirect()->back();
    }
    public function show_item(string $id, string $show_flag)
    {
        $cat = Goods::find($id);
        $cat->show = $show_flag;
        $cat->save();

        return redirect()->back();
    }


    public function destroy2(string $id)
    {
        $good = Goods::find($id);

        if($good->picture){
            Storage::disk('public')->delete($good->picture);
        }

        $good->delete();

        $i=1;
        $goods = Goods::orderBy('order')->where('category', $good->category)->get();
        foreach ($goods as $item){
            $it=Goods::find($item->id);
            $it->order = $i;
            $i++;
            $it->save();
        }


        return redirect()->route('category.show', $good->category);
    }
}
