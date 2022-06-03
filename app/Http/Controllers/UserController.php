<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Pizza;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::query()->where('publish_status', 1)->paginate(3)->fragment('pizzas');
        $categories = Category::query()->get();
        return view('user.home', compact('pizzas', 'categories'));
    }

    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);
        Contact::query()->create([
            'user_id' => Auth()->user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);
        return back();
    }

    public function pizza_detail($id)
    {
        $data = Pizza::query()->join('categories', 'pizzas.category_id', 'categories.category_id')->select('pizzas.*', 'categories.category_id', 'categories.category_name', 'pizzas.image')->where('pizza_id', $id)->first();
        return view('user.pizza_detail', compact('data'));
    }

    public function category_search($id)
    {
        $pizzas = Pizza::query()->where('category_id', $id)->where('publish_status', 1)->paginate(3);
        $categories = Category::query()->get();
        return view('user.home', compact('pizzas', 'categories'));
    }

    public function pizza_search(Request $request)
    {
        $pizzas = Pizza::query()->where('pizza_name', 'like', '%' . $request->search_data . '%')->paginate(3);
        $categories = Category::query()->get();
        return view('user.home', compact('pizzas', 'categories'));

    }

    public function custom_search(Request $request)
    {
        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $pizzas = Pizza::query();
        if ($startDate != null && $endDate == null) {
            $pizzas = $pizzas->whereDate('created_at', '>=', $startDate);
        } elseif ($startDate == null && $endDate != null) {
            $pizzas = $pizzas->whereDate('created_at', '<=', $endDate);
        } elseif ($startDate != null && $endDate != null) {
            $pizzas = $pizzas->whereDate('created_at', '>=', $startDate)->where('created_at', '<=', $endDate);
        }

        if ($minPrice != null && $maxPrice == null) {
            $pizzas = $pizzas->where('price', '>=', $minPrice);
            // $pizzas = Pizza::query()->where('price', '>=', $minPrice)->paginate(2);
        } elseif ($minPrice == null && $maxPrice != null) {
            $pizzas = $pizzas->where('price', '<=', $maxPrice);
            // $pizzas = Pizza::query()->where('price', '<=', $maxPrice)->paginate(2);
        } elseif ($minPrice != null && $maxPrice != null) {
            $pizzas = $pizzas->where('price', '>=', $minPrice)
                ->where('price', '<=', $maxPrice);
            // $pizzas = Pizza::query()->where('price', '>=', $minPrice)->where('price', '<=', $maxPrice)->paginate(2);
        }
        $pizzas = $pizzas->paginate(2);
        $categories = Category::query()->get();
        return view('user.home', compact('pizzas', 'categories'));
    }

    public function order_page($id)
    {
        $data = Pizza::query()->join('categories', 'pizzas.category_id', 'categories.category_id')->select('pizzas.*', 'categories.category_id', 'categories.category_name', 'pizzas.image')->where('pizza_id', $id)->first();
        return view('user.order_page', compact('data'));
    }

    public function order(Request $request, $id)
    {
        $pizzaDetails = Pizza::query()->where('pizza_id', $id)->first();
        $userInfo = Auth::user()->id;
        $request->validate([
            'count' => 'required',
            'paymentStatus' => 'required',
        ]);

        Order::query()->create([
            'customer_id' => $userInfo,
            'pizza_id' => $pizzaDetails->pizza_id,
            'carrier' => null,
            'payment_status' => $request->paymentStatus,
            'count' => $request->count,
            'order_time' => Carbon::now(),
        ]);
        return back()->with(['success_order' => 'Order successful and pizza will get in ' . $pizzaDetails->waiting_time * $request->count . ' minutes']);
    }
}
