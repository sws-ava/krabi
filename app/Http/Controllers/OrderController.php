<?php

namespace App\Http\Controllers;

use App\Models\Admin\Order;
use App\Models\Admin\OrderItems;
use App\Services\DynamicTranlateService\DynamicTranlateService;
use App\Services\OrderService\OrderTgService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function order_accepted(Request $request)
    {

        $order = new Order();
        $order->name = $request['name'];
        $order->address = $request['address'];
        $order->phone = $request['phone'];
        $order->persons = $request['persons'];
        if(isset($request['comment'])){
            $order->comment = $request['comment'];
        }
        $order->status = 1;

        $order->save();

        foreach ($request->form as $item) {
            $newItem = new OrderItems();
            $newItem->order = $order->id;
            $newItem->item = $item['id'];
            $newItem->amount = $item['count'];
            $newItem->price = $item['price'];
            $newItem->save();
        }

        OrderTgService::sendTgOrder($order->id);

        $translates = DynamicTranlateService::getDynamicTranslates();
        $navigation = DynamicTranlateService::getNavigation();
        return view('order_accepted', compact('translates', 'navigation'));
    }
}
