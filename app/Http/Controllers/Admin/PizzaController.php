<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PizzaController extends Controller
{
    public function pizza()
    {
        $pizzas = DB::table('pizzas')->paginate(2);
        return view('admin.pizza.list', compact('pizzas'));
    }

    public function add_pizza()
    {
        $categories = Category::get();
        return view('admin.pizza.add_pizza', compact('categories'));
    }

    public function create_pizza(Request $request)
    {
        $request->validate([
            'pizza_name' => 'required',
            'image' => 'required',
            'price' => 'required',
            'publish' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'buyOneGetOne' => 'required',
            'waintingTime' => 'required',
            'description' => 'required',
        ]);

        $image = $request->file('image');
        $imageName = $image->getFilename();
        $extension = $image->getClientOriginalExtension();
        $fullName = $imageName . "." . $extension;
        $image->storeAs('public/uploads', $fullName);
        // $data = $request->file('image');
        // $fileName = uniqid('bhc')."_".$data->getClientOriginalName();
        // $data->move(public_path().'/uploads/', $fileName);
        Pizza::create([
            'pizza_name' => $request->pizza_name,
            'image' => $fullName,
            'price' => $request->price,
            'publish_status' => $request->publish,
            'category_id' => $request->category,
            'discount_price' => $request->discount,
            'buy_one_get_one_status' => $request->buyOneGetOne,
            'waiting_time' => $request->waintingTime,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.pizza')->with('successp', "Pizza Created...");
    }

    public function delete_pizza($id)
    {
        $image = Pizza::where('pizza_id', $id)->first();
        $imageName = $image->image;

        Pizza::where('pizza_id', $id)->delete();
        if (File::exists(public_path() . '/storage/uploads/' . $imageName)) {
            File::delete(public_path() . '/storage/uploads/' . $imageName);
        }
        return back()->with('successdp', "Pizza deleted...");
    }

    public function pizza_info($id)
    {
        $infos = Pizza::where('pizza_id', $id)->first();
        return view('admin.pizza.pizza_info', compact('infos'));
    }

    public function edit_pizza($id)
    {
        $categories = Category::get();
        $pizza = Pizza::query()->select('pizzas.*', 'categories.category_id', 'categories.category_name')->join('categories', 'pizzas.category_id', '=', 'categories.category_id')->where('pizza_id', $id)->first();
        return view('admin.pizza.edit_pizza', compact('pizza', 'categories'));
    }

    public function update_pizza($id, Request $request)
    {
        $request->validate([
            'pizza_name' => 'required',
            'price' => 'required',
            'publish' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'buyOneGetOne' => 'required',
            'waintingTime' => 'required',
            'description' => 'required',
        ]);

        $data = [
            'pizza_name' => $request->pizza_name,
            'price' => $request->price,
            'publish_status' => $request->publish,
            'category_id' => $request->category,
            'discount_price' => $request->discount,
            'buy_one_get_one_status' => $request->buyOneGetOne,
            'waiting_time' => $request->waintingTime,
            'description' => $request->description,
        ];
        if (isset($request->image)) {
            $image = Pizza::query()->where('pizza_id', $id)->first();
            $imageName = $image->image;

            if (File::exists(public_path() . '/storage/uploads/' . $imageName)) {
                File::delete(public_path() . '/storage/uploads/' . $imageName);
            }

            $image = $request->file('image');
            $imageName = $image->getFilename();
            $extension = $image->getClientOriginalExtension();
            $fullName = $imageName . "." . $extension;
            $image->storeAs('public/uploads', $fullName);

            $data['image'] = $fullName;

            Pizza::where('pizza_id', $id)->update($data);

            return redirect()->route('admin.pizza')->with('successupdate', 'Updated successfully...');
        } else {
            Pizza::where('pizza_id', $id)->update($data);
            return redirect()->route('admin.pizza')->with('successupdate', 'Updated successfully...');
        }
    }

    public function search_pizza(Request $request)
    {
        $searchKey = $request->table_search;
        // $pizzas = DB::table('pizzas')->orWhere('pizza_name', 'like', '%' . $searchKey . '%')
        //     ->orWhere('price', 'like', '%' . $searchKey . '%')->paginate(3);
        $pizzas = Pizza::query()->orWhere('pizza_name', 'like', '%' . $searchKey . '%')
            ->orWhere('price', 'like', '%' . $searchKey . '%')->paginate(3);
        $pizzas->appends($request->all());
        return view('admin.pizza.list', compact('pizzas'));
    }
}
