<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function order_list()
    {
        $orders = Order::query()->join('pizzas', 'orders.pizza_id', 'pizzas.pizza_id')->join('users', 'orders.customer_id', 'users.id')->select('orders.order_id', 'users.name', 'pizzas.pizza_name', 'orders.payment_status', 'orders.count', 'orders.order_time')->paginate(2);
        return view('admin.order_list', compact('orders'));
    }

    public function search_order(Request $request)
    {
        $KEY4 = $request->table_search;
        $orders = Order::query()->join('pizzas', 'orders.pizza_id', 'pizzas.pizza_id')->join('users', 'orders.customer_id', 'users.id')
            ->orWhere('orders.order_id', 'like', '%' . $request->table_search . '%')
            ->orWhere('users.name', 'like', '%' . $request->table_search . '%')
            ->orWhere('pizzas.pizza_name', 'like', '%' . $request->table_search . '%')
            ->select('orders.order_id', 'users.name', 'pizzas.pizza_name', 'orders.payment_status', 'orders.count', 'orders.order_time')->paginate(4);
        $orders->appends($request->all());
        Session::put('KEY4', $KEY4);
        return view('admin.order_list', compact('orders'));
    }

    public function csv()
    {
        if (Session::has('KEY4')) {
            $searchKey = Session::get('KEY4');
            $orders = Order::query()->join('pizzas', 'orders.pizza_id', 'pizzas.pizza_id')->join('users', 'orders.customer_id', 'users.id')
                ->orWhere('orders.order_id', 'like', '%' . $searchKey . '%')
                ->orWhere('users.name', 'like', '%' . $searchKey . '%')
                ->orWhere('pizzas.pizza_name', 'like', '%' . $searchKey . '%')
                ->select('orders.order_id', 'users.name', 'pizzas.pizza_name', 'orders.payment_status', 'orders.count', 'orders.order_time')->get();

            Session::forget('KEY');
        } else {
            $orders = Order::query()->join('pizzas', 'orders.pizza_id', 'pizzas.pizza_id')->join('users', 'orders.customer_id', 'users.id')->select('orders.order_id', 'users.name', 'pizzas.pizza_name', 'orders.payment_status', 'orders.count', 'orders.order_time')->get();

        }
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($orders, [
            'order_id' => 'ID',
            'pizza_name' => 'Pizza Name',
            'payment_status' => 'Payment',
            'count' => 'Count',
            'order_time' => 'Waiting Time',
        ]);

        $csvReader = $csvExporter->getReader();
        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);
        $filename = 'orders.csv';
        return response((string) $csvReader)->header('Content-Type', 'text/csv; charset:UTF-8')->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
