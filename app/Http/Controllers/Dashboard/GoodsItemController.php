<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\GoodsItems;
use Illuminate\Http\Request;

class GoodsItemController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $count = GoodsItems::where('item', $request->item)->count();


        $item = new GoodsItems;
        $item->item = $request->item;
        $item->title_ru = $request->title_ru;
        $item->title_ua = $request->title_ua;
        $item->weight = $request->weight;
        $item->weightKind = $request->weightKind;
        $item->price = str_replace(',', '.', $request->price);
        $item->show = 0;
        $item->order = $count + 1;
        $item->save();

        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function order_top(string $good, string $order){
        $itemToRight = GoodsItems::where('item', $good)->where('order', $order - 1)->first();
        $itemToLeft = GoodsItems::where('item', $good)->where('order', $order)->first();
        $itemToRight->order = $order;
        $itemToRight->save();
        $itemToLeft->order = $order - 1;
        $itemToLeft->save();

        return redirect()->back();
    }
    public function order_bottom(string $good, string $order){
        $itemToLeft = GoodsItems::where('item', $good)->where('order', $order + 1)->first();
        $itemToRight = GoodsItems::where('item', $good)->where('order', $order)->first();
        $itemToRight->order = $order + 1;
        $itemToRight->save();
        $itemToLeft->order = $order;
        $itemToLeft->save();

        return redirect()->back();
    }
    public function show_item(string $id, string $show_flag)
    {
        $cat = GoodsItems::find($id);
        $cat->show = $show_flag;
        $cat->save();

        return redirect()->back();
    }




    public function destroy2(string $id)
    {
        $good = GoodsItems::find($id);

        $good->delete();

        $i=1;
        $goods = GoodsItems::orderBy('order')->where('item', $good->item)->get();
        foreach ($goods as $item){
            $it=GoodsItems::find($item->id);
            $it->order = $i;
            $i++;
            $it->save();
        }


        return redirect()->back();
    }
}
