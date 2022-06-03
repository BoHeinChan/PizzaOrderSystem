<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function profile()
    {
        $id = auth()->user()->id;
        $userData = User::find($id);
        return view('admin.profile.index', compact('userData'));
    }

    public function category()
    {
        $pizzas = Category::paginate(3);
        return view('admin.category.list', compact('pizzas'));
    }

    public function add_category()
    {
        return view('admin.category.add_category');
    }

    public function create_category(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);
        Category::create([
            'category_name' => $request->category_name,
        ]);
        return redirect()->route('admin.category')->with('success', 'Added category...');
    }

    public function delete_category($id)
    {
        Category::where('category_id', $id)->delete();
        return back()->with('successd', "Deleted category...");
    }

    public function edit_category($id)
    {
        $pizza = Category::where('category_id', $id)->first();
        return view('admin.category.edit_category', compact('pizza'));
    }

    public function update_category($id, Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);
        Category::where('category_id', $id)->update([
            'category_name' => $request->category_name,
        ]);
        return redirect()->route('admin.category')->with('successu', 'Updated category successfully...');
    }

    public function search_category(Request $request)
    {
        $pizzas = DB::table('categories')->where('category_name', 'like', '%' . $request->searchCategory . '%')->paginate(4);
        return view('admin.category.list', compact('pizzas'));
    }

    public function pizza()
    {
        return view('admin.pizza.list');
    }

    public function contact_list()
    {
        $datas = Contact::query()->paginate(3);
        return view('admin.contact', compact('datas'));
    }

    public function search_contact(Request $request)
    {
        $search_key = $request->table_search;
        $datas = Contact::query()->orWhere('name', 'like', '%' . $search_key . '%')->orWhere('email', 'like', '%' . $search_key . '%')->orWhere('message', 'like', '%' . $search_key . '%')->paginate(3);
        $datas->appends($request->all());
        return view('admin.contact', compact('datas'));
    }
}
