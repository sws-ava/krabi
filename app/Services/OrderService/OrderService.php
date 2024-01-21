<?php

namespace App\Services\OrderService;

use App\Models\Admin\Goods;
use App\Models\Admin\GoodsItems;
use App\Models\Admin\Order;
use App\Models\Admin\OrderItems;

class OrderService

{
    public function __construct()
    {

    }

    public static function getOrders($statuses = '1,2')
    {
        $orders = Order::orderBy('id', 'desc')->whereIn('status', [$statuses])->get();

        foreach ($orders as $order) {
            $order->items = OrderItems::where('order', $order->id)->get();
            $order->total = self::calcOrderTotal($order->items);
        }
        return $orders;
    }

    public static function calcOrderTotal($items){
        $total = 0;
        foreach ($items as $item) {
            if ($item->price && $item->amount){
                $total += $item->price * $item->amount;
            }
        }
        return $total;
    }

    public static function getOrder($id)
    {
        $order = Order::where('id', $id)->first();

        $order->items = OrderItems::where('order', $id)->get();
        $order->total = self::calcOrderTotal($order->items);

        $order->items = self::getOrderItemRelationships($order->items);

        return $order;
    }

    public static function getOrderItemRelationships($items)
    {
        foreach ($items as $item) {
            $goodsItem = GoodsItems::where('id', $item->item)->first();
            $pre_title = Goods::select('title_ru')->where('id',$goodsItem->item )->first();
            $item->full_title = $pre_title->title_ru;
            $item->title = $goodsItem->title_ru;
            $item->weight = $goodsItem->weight.' '.$goodsItem->weightKind;
        }
        return $items;
    }
}
