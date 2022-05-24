<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
        return to_route('admin.user_list')->with('successupdate', 'Updated role successfully...');
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
        return to_route('admin.admin_list')->with('successupate', 'Updated role successfully...');

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

        return view('user.admin_list', compact('userDatas'));
    }
}
