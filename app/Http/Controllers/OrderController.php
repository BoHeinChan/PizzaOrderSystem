<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function order_list()
    {
        $orders = Order::query()->join('pizzas', 'orders.pizza_id', 'pizzas.pizza_id')->join('users', 'orders.customer_id', 'users.id')->select('orders.order_id', 'users.name', 'pizzas.pizza_name', 'orders.payment_status', 'orders.count', 'orders.order_time')->paginate(2);
        return view('admin.order_list', compact('orders'));
    }
}
