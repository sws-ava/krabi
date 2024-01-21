<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use App\Models\Admin\OrderItems;
use App\Services\OrderService\OrderService;
use App\Services\OrderService\OrderTgService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = OrderService::getOrders(1);
        return view('dashboard.orders.index', [
            'orders' => $orders,
        ]);
    }

    public function orders_done() : View
    {
        $orders = OrderService::getOrders(2);
        return view('dashboard.orders.index', [
            'orders' => $orders,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = OrderService::getOrder($id);
        return view('dashboard.orders.item', [
            'order' => $order,
        ]);
    }

    public function set_status($id)
    {
        $order = Order::find($id);
        if($order->status === 1){
            $order->status = 2;
        }elseif($order->status === 2){
            $order->status = 1;
        }else{
            $order->status = 1;
        }
        $order->save();
        return redirect('/dashboard/orders/'.$id);
    }

    public function remove_order($id)
    {
        $order = Order::find($id);
        $order->delete();
        $orderItems = OrderItems::where('order', $order->id)->get();
        foreach($orderItems as $orderItem){
            $item = OrderItems::where('id', $orderItem->id)->first();
            $item->delete();
        }
        return redirect('/dashboard/orders/');
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
}
