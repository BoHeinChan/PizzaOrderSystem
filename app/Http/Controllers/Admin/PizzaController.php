<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class PizzaController extends Controller
{
    public function pizza()
    {
        $pizzas = DB::table('pizzas')->paginate(4);
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
            'waitingTime' => 'required',
            'description' => 'required',
        ]);
        $this->create_pizza_to_db($request);
        return redirect()->route('admin.pizza')->with('successp', "Successfully created pizza!");
    }

    public function delete_pizza($id)
    {
        $image = Pizza::where('pizza_id', $id)->first();
        $imageName = $image->image;

        Pizza::where('pizza_id', $id)->delete();
        if (File::exists(public_path() . '/storage/uploads/' . $imageName)) {
            File::delete(public_path() . '/storage/uploads/' . $imageName);
        }
        return back()->with('successdp', "Successfully deleted pizza!");
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
        $this->update_pizza_to_db($request, $id);
        return redirect()->route('admin.pizza')->with('successupdate', 'Successfully updated pizza!');
    }

    public function search_pizza(Request $request)
    {
        $searchKey = $request->table_search;
        // $pizzas = DB::table('pizzas')->orWhere('pizza_name', 'like', '%' . $searchKey . '%')
        //     ->orWhere('price', 'like', '%' . $searchKey . '%')->paginate(3);
        $pizzas = Pizza::query()->where('pizza_name', 'like', '%' . $searchKey . '%')
            ->orWhere('price', 'like', '%' . $searchKey . '%')->paginate(4);
        $pizzas->appends($request->all());
        Session::put('KEY1', $searchKey);
        return view('admin.pizza.list', compact('pizzas'));
    }

    public function csv()
    {
        if (Session::has('KEY1')) {
            $searchKey = Session::get('KEY1');
            $pizzas = DB::table('pizzas')->join('categories', 'pizzas.category_id', 'categories.category_id')->orWhere('pizzas.pizza_id', 'like', '%' . $searchKey . '%')->orWhere('pizzas.pizza_name', 'like', '%' . $searchKey . '%')->select('pizzas.*', 'categories.*', 'pizzas.pizza_id', 'pizzas.pizza_name', 'categories.category_name', 'pizzas.price', 'pizzas.discount_price')->get();
            Session::forget('KEY1');
        } else {
            $pizzas = DB::table('pizzas')->join('categories', 'pizzas.category_id', 'categories.category_id')->select('pizzas.*', 'categories.*', 'pizzas.pizza_id', 'pizzas.pizza_name', 'categories.category_name', 'pizzas.price', 'pizzas.discount_price')->get();
        }
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($pizzas, [
            'pizza_id' => 'ID',
            'pizza_name' => 'Pizza Name',
            'price' => 'Price',
            'category_name' => 'Category Name',
            'discount_price' => 'Discount',
            'created_at' => 'Created at',
        ]);

        $csvReader = $csvExporter->getReader();
        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);
        $filename = 'pizza.csv';
        return response((string) $csvReader)->header('Content-Type', 'text/csv; charset:UTF-8')->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    private function update_pizza_to_db($request, $id)
    {
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
        } else {
            Pizza::where('pizza_id', $id)->update($data);
        }

    }

    private function create_pizza_to_db($request)
    {
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
            'waiting_time' => $request->waitingTime,
            'description' => $request->description,
        ]);

    }

}
