<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Order;
use App\Models\Admin\OrderItems;
use App\Models\Admin\GoodsItems;
use App\Models\Admin\Goods;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function getNewOrders(){
        $orders = Order::where('status', 1)->orderBy('id', 'desc')->get();
        return $orders;
    }
    public function getDoneOrders(){
        $orders = Order::where('status', 2)->orderBy('id', 'desc')->get();
        return $orders;
    }
    public function getOrder(Request $request){
        $orderDetails = Order::where('id', $request->orderId)->first();
        $orderItems = OrderItems::where('order', $request->orderId)->get();
        foreach($orderItems as $orderItem){
            $goodsItem = GoodsItems::where('id', $orderItem->item)->first();
            $orderItem->title = $goodsItem->title_ru;
            $orderItem->weight = $goodsItem->weight;
            $orderItem->weightKind = $goodsItem->weightKind;
            $orderItem->cat = $goodsItem->item;

            $catName = Goods::where('id', $goodsItem->item)->first();
            $orderItem->catName = $catName->title_ru;

            $isMoreDishes = GoodsItems::where('item', $goodsItem->item)->count();
            $isMoreDishes > 1 ? $orderItem->isMoreDishes = true : $orderItem->isMoreDishes = false;

        }

        $orderDetails->orderItems =  $orderItems;

        return $orderDetails;
    }
    public function incrementOrderItem(Request $request){
        $item = OrderItems::where('id', $request->item['id'])->first();
        $item->amount += 1;
        $item->save();
    }
    public function decrementOrderItem(Request $request){
        $item = OrderItems::where('id', $request->item['id'])->first();
        if($item->amount > 1){
            $item->amount -= 1;
            $item->save();
        }
    }
    public function countTotalSum(Request $request){
        $item = Order::where('id', $request->order)->first();
        $item->total = $request->sum;
        $item->save();
    }
    public function removeOrderItem(Request $request){
        $item = OrderItems::where('id', $request->id)->first();
        $item->delete();
    }
    public function removeOrder(Request $request){
        $order = Order::where('id', $request->order)->first();
        $order->delete();
        $orderItems = OrderItems::where('order', $order->id)->get();
        foreach($orderItems as $orderItem){
            $item = OrderItems::where('id', $orderItem->id)->first();
            $item->delete();
        }
    }
    public function showSameOrderItemsByCat(Request $request){
        $items = GoodsItems::where('item', $request->item['cat'])->where('id', '!=', $request->item['item'])->get();
        return $items;
    }
    public function changeOrderStatus(Request $request){
        $order = Order::where('id', $request->order['id'])->first();
        $order->status == 1 ? $order->status = 2 : $order->status = 1;
        $order->save();
    }
    public function fetchDishesByQuery(Request $request){
        $query = $request['query'];
        
        $items = DB::table('goods_items')
            ->leftJoin('goods', 'goods_items.item', '=', 'goods.id')
            ->where(DB::raw("CONCAT_WS(' ', goods.title_ru, goods_items.title_ru)"), 'LIKE',  "%$query%")
            ->select(
                'goods_items.*',
                'goods.title_ru AS title',
            )
            ->get();
        
        $count = $items->count();

        return ['items' => $items, 'query' => $count];

    }

    public function addDishToOrderMenuItems(Request $request){
            $goodsItem = GoodsItems::where('id', $request->dish['id'])->first();
            $goodsItem->title = $goodsItem->title_ru;
            $goodsItem->order = $request->order;
            $goodsItem->amount = 1;
            $catName = Goods::where('id', $goodsItem->item)->first();
            $goodsItem->catName = $catName->title_ru;
            $goodsItem->cat = $catName->id;
            $isMoreDishes = GoodsItems::where('item', $goodsItem->item)->count();
            $isMoreDishes > 1 ? $goodsItem->isMoreDishes = true : $goodsItem->isMoreDishes = false;

            $newOrderItem = new OrderItems();
            $newOrderItem->order = $request->order;
            $newOrderItem->item = $goodsItem->id;
            $newOrderItem->amount = 1;
            $newOrderItem->price = $goodsItem->price;
            $newOrderItem->save();
            $goodsItem->id = $newOrderItem->id;

            return $goodsItem;
    }

    public function saveOrder(Request $request){
        $order = Order::where('id', $request->order['id'])->first();

        $order->address = $request->order['address'];
        $order->comment = $request->order['comment'];
        $order->name = $request->order['name'];
        $order->persons = $request->order['persons'];
        $order->phone = $request->order['phone'];
        $order->total = $request->order['total'];
        $order->save();

    }
}