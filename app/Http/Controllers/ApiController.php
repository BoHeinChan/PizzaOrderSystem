<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Pizza;
use App\Models\User;

class ApiController extends Controller
{
    public function category_list()
    {
        $category = Category::query()->get();
        return response()->json($category);
    }

    public function pizza_list()
    {
        $pizza = Pizza::query()->get();
        return response()->json($pizza);
    }

    public function user_list()
    {
        $user = User::query()->get();
        return response()->json($user);
    }
}
