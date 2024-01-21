<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\Goods;
use App\Models\Admin\GoodsCats;
use App\Models\Admin\GoodsItems;
use App\Services\MenuService\MenuService;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats = MenuService::getCategories();
        return view('dashboard.menu.categories.index', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.menu.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $countCats = GoodsCats::get();
        $countCats = $countCats->count();
        $cat = new GoodsCats();
        $cat->title_ru = $request['title_ru'];
        $cat->title_ua = $request['title_ua'];
        $cat->description_ru = $request['description_ru'];
        $cat->description_ua = $request['description_ua'];
        $cat->slug = $request['slug'];
        $cat->order = $countCats + 1;
        $cat->show = 0;
        $cat->save();

        return redirect()->route('category.edit', $cat->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cat = MenuService::getCategory($id);
        return view('dashboard.menu.categories.show', compact('cat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cat = GoodsCats::find($id);
        $cat->cat_items = Goods::where('category', $cat->id)->count();
        return view('dashboard.menu.categories.edit', compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update2(Request $request, string $id)
    {
        $cat = GoodsCats::find($id);
        $cat->title_ru = $request['title_ru'];
        $cat->title_ua = $request['title_ua'];
        $cat->description_ru = $request['description_ru'];
        $cat->description_ua = $request['description_ua'];
        $cat->slug = $request['slug'];
        $cat->save();

        return redirect()->route('category.edit', $cat->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy2(string $id)
    {
        $cat = GoodsCats::find($id);
        $cat->delete();

        $i=1;
        $cats = GoodsCats::orderBy('order')->get();
        foreach ($cats as $item){
            $it=GoodsCats::find($item->id);
            $it->order = $i;
            $i++;
            $it->save();
        }
        return redirect()->route('category.index');
    }
    public function show_category(string $id, string $show_flag)
    {
        $cat = GoodsCats::find($id);
        $cat->show = $show_flag;
        $cat->save();

        return redirect()->back();
    }


    public function order_top(string $order){
        $catToRight = GoodsCats::where('order', $order - 1)->first();
        $catToLeft = GoodsCats::where('order', $order)->first();
        $catToRight->order = $order;
        $catToRight->save();
        $catToLeft->order = $order - 1;
        $catToLeft->save();

        return redirect()->back();
    }
    public function order_bottom(string $order){
        $catToLeft = GoodsCats::where('order', $order + 1)->first();
        $catToRight = GoodsCats::where('order', $order)->first();
        $catToRight->order = $order + 1;
        $catToRight->save();
        $catToLeft->order = $order;
        $catToLeft->save();

        return redirect()->back();
    }

    public function update_prices_in_cat(Request $request){
        if($request->goodsItems){
            foreach ($request->goodsItems as $item){
                $goodsItem = GoodsItems::find($item['id']);
                if($goodsItem && $item['id'] && $item['price']){
                    $goodsItem->price = str_replace(',', '.', $item['price']);
                    $goodsItem->save();
                }
            }
        }
        return redirect()->back();
    }


}
