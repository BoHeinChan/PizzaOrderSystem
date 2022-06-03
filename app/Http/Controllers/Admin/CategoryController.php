<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function category()
    {
        if (Session::has('KEY')) {
            Session::forget('KEY');
        }
        $pizzas = DB::table('categories')->leftJoin('pizzas', 'pizzas.category_id', 'categories.category_id')->select('categories.*', DB::raw('COUNT(pizzas.category_id) as count'))->groupBy('categories.category_id')->paginate(4);
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
        return redirect()->route('admin.category')->with('success', 'Successfully added category!');
    }

    public function delete_category($id)
    {
        Category::where('category_id', $id)->delete();
        return back()->with('successd', "Successfully deleted category!");
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
        return redirect()->route('admin.category')->with('successu', 'Successfully updated category!');
    }

    public function search_category(Request $request)
    {
        $pizzas = DB::table('categories')->leftJoin('pizzas', 'pizzas.category_id', 'categories.category_id')->select('categories.*', DB::raw('COUNT(pizzas.category_id) as count'))->groupBy('categories.category_id')->where('category_name', 'like', '%' . $request->searchCategory . '%')->paginate(3);
        Session::put('KEY', $request->searchCategory);
        $pizzas->appends($request->all());
        return view('admin.category.list', compact('pizzas'));
    }

    public function category_detail($id)
    {
        $pizzas = DB::table('pizzas')->join('categories', 'pizzas.category_id', 'categories.category_id')->where('pizzas.category_id', $id)->select('pizzas.*', 'categories.*', 'pizzas.pizza_id', 'pizzas.pizza_name', 'categories.category_name')->paginate(2);
        return view('admin.category.category_detail', compact('pizzas'));
    }

    public function csv()
    {
        if (Session::has('KEY')) {
            $searchCategory = Session::get('KEY');
            $categories = Category::leftJoin('pizzas', 'pizzas.category_id', 'categories.category_id')->select('categories.*', DB::raw('COUNT(pizzas.category_id) as count'))->groupBy('categories.category_id')->where('category_name', 'like', '%' . $searchCategory . '%')->get();
            Session::forget('KEY');
        } else {
            $categories = Category::get();

        }
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($categories, [
            'category_id' => 'category_id',
            'category_name' => 'category_name',
            'created_at' => 'created_at',
        ]);

        $csvReader = $csvExporter->getReader();
        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);
        $filename = 'categories.csv';
        return response((string) $csvReader)->header('Content-Type', 'text/csv; charset:UTF-8')->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
