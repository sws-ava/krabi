<?php

namespace App\Services\OrderService;

use App\Models\Admin\Goods;
use App\Models\Admin\GoodsItems;
use App\Models\Admin\Order;
use App\Models\Admin\OrderItems;

class OrderTgService

{
    public function __construct()
    {

    }



    public static function sendTgOrder($id)
    {
        $order = self::getOrder($id);
        $text = self::normalizeOrderToText($order);
        $send = self::sendTgOrderHandler($text, $order);
        return $send;
    }

    public static function sendMsgErr($order){
        $textMessage = urlencode('Новый заказ краби, но с ошибкой!');
        $text = urlencode(self::normalizeOrderToText($order));
        $token = env('TG_TOKEN');
        $chat = env('TG_MASTER_CHAT');
        $urlQuery = "https://api.telegram.org/bot". $token ."/sendMessage?chat_id=". $chat ."&text=" . $textMessage . ' ' . $text ;
        file_get_contents($urlQuery);
    }

    public static function sendTgOrderHandler($textMessage, $order)
    {
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => 'Content-Type: application/json; charset=utf-8'
            ]
        ];
        $context = stream_context_create($opts);

        $textMessage = urlencode($textMessage);
        $token = env('TG_TOKEN');
        $chat = env('TG_CHAT');
        $urlQuery = "https://api.telegram.org/bot". $token ."/sendMessage?chat_id=". $chat ."&text=" . $textMessage;

        $response = @file_get_contents($urlQuery, false, $context);
        if(gettype($response) === 'boolean'){
            self::sendMsgErr($order);
        }
    }

    public static function normalizeOrderToText($order){
        $textMessage = 'Новый заказ!';
        $textMessage .= "\n";
        $textMessage .= "Имя: ".$order->name;
        $textMessage .= "\n";
        $textMessage .= "Телефон: ".$order->phone;
        $textMessage .= "\n";
        $textMessage .= "Адрес: ".$order->address;
        $textMessage .= "\n";
        $textMessage .= "Персон: ".$order->persons;
        $textMessage .= "\n";
        if($order->comment){
            $textMessage .= "Комментарий: ".$order->comment;
            $textMessage .= "\n";
        }

        foreach ($order->items as $item) {
            if($item->full_title !== $item->title){
                $textMessage .= $item->full_title;
            }
            $textMessage .= $item->title.' '.$item->weight.' '.$item->amount.'ед '.' '.$item->price.' грн';
            $textMessage .= "\n";
        }
        $textMessage .= "Итого: ".$order->total.' грн';
        return $textMessage;
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
