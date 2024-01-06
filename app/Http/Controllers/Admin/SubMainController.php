<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Review;
use App\Models\Admin\Order;
use App\Models\Admin\Feedback;

class SubMainController extends Controller
{
    public function getUnreadedMessages(){
        $reviews = Review::where('show', 0)->count();
        $feedbacks = Feedback::where('isRead', 0)->count();
        $orders = Order::where('status', 1)->count();

        return [
            'reviews' => $reviews, 
            'feedbacks' => $feedbacks,
            'orders' => $orders
        ];
    }
    public function getUnreadedOrders(){
        $orders = Order::where('status', 1)->count();

        return [ 'orders' => $orders ];
    }
}
