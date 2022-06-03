<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function user_list()
    {
        $userDatas = User::where('role', 'user')->paginate(4);

        return view('user.user_list', compact('userDatas'));
    }

    public function edit_user($id)
    {
        $userData = User::query()->where('id', $id)->first();
        return view('user.edit_user', compact('userData'));
    }

    public function update_user(Request $request, $id)
    {
        User::query()->where('id', $id)->update([
            'role' => $request->role,
        ]);
        return to_route('admin.user_list')->with('successupdate', 'Successfully updated role!');
    }

    public function admin_list()
    {
        $userDatas = User::where('role', 'admin')->paginate(4);

        return view('user.admin_list', compact('userDatas'));
    }

    public function edit_admin($id)
    {
        $userData = User::query()->where('id', $id)->first();
        return view('user.edit_admin', compact('userData'));
    }

    public function update_admin(Request $request, $id)
    {
        User::query()->where('id', $id)->update([
            'role' => $request->role,
        ]);
        return to_route('admin.admin_list')->with('successupate', 'Successfully updated role!.');

    }

    public function search_user(Request $request)
    {
        $key = $request->searchUser;
        $userDatas = User::where('role', 'user')->where(function ($query) use ($key) {
            $query->orWhere('name', 'like', '%' . $key . '%')
                ->orWhere('email', 'like', '%' . $key . '%')
                ->orWhere('phone', 'like', '%' . $key . '%')
                ->orWhere('address', 'like', '%' . $key . '%');
        })->paginate(3);
        Session::put('KEY2', $key);
        return view('user.user_list', compact('userDatas'));
    }

    public function search_admin(Request $request)
    {
        $key = $request->searchUser;
        $userDatas = User::where('role', 'admin')->where(function ($query) use ($key) {
            $query->orWhere('name', 'like', '%' . $key . '%')
                ->orWhere('email', 'like', '%' . $key . '%')
                ->orWhere('phone', 'like', '%' . $key . '%')
                ->orWhere('address', 'like', '%' . $key . '%');
        })->paginate(3);
        Session::put('KEY3', $key);
        return view('user.admin_list', compact('userDatas'));
    }

    public function csv()
    {
        if (Session::has('KEY2')) {
            $searchKey = Session::get('KEY2');
            $users = User::where('role', 'user')->where(function ($query) use ($searchKey) {
                $query->orWhere('name', 'like', '%' . $searchKey . '%')
                    ->orWhere('email', 'like', '%' . $searchKey . '%')
                    ->orWhere('phone', 'like', '%' . $searchKey . '%')
                    ->orWhere('address', 'like', '%' . $searchKey . '%');
            })->get();
            Session::forget('KEY2');
        } else {
            $users = User::query()->where('role', 'user')->get();
        }
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($users, [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
        ]);

        $csvReader = $csvExporter->getReader();
        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);
        $filename = 'user.csv';
        return response((string) $csvReader)->header('Content-Type', 'text/csv; charset:UTF-8')->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function csv_admin()
    {
        if (Session::has('KEY3')) {
            $searchKey = Session::get('KEY3');
            $users = User::where('role', 'admin')->where(function ($query) use ($searchKey) {
                $query->orWhere('name', 'like', '%' . $searchKey . '%')
                    ->orWhere('email', 'like', '%' . $searchKey . '%')
                    ->orWhere('phone', 'like', '%' . $searchKey . '%')
                    ->orWhere('address', 'like', '%' . $searchKey . '%');
            })->get();
            Session::forget('KEY3');

        } else {
            $users = User::query()->where('role', 'admin')->get();
        }
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($users, [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
        ]);

        $csvReader = $csvExporter->getReader();
        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);
        $filename = 'user.csv';
        return response((string) $csvReader)->header('Content-Type', 'text/csv; charset:UTF-8')->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
