<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function profile()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('admin.profile.index', compact('userData'));
    }

    public function update_profile($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return back();
    }

    public function change_password($id)
    {
        return view('admin.profile.change_password');
    }

    public function update_password($id, Request $request)
    {
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'comfirmPassword' => 'required',
        ]);

        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;
        $comfirmPassword = $request->comfirmPassword;

        $data = User::where('id', $id)->first();
        $hashedPassword = $data->password;
        if (Hash::check($oldPassword, $hashedPassword)) {
            if ($newPassword != $comfirmPassword) {
                return back()->with('npwderror', "New password and comfirm password do not match!!!");
            } else {
                if (strlen($newPassword) <= 6 || strlen($comfirmPassword) <= 6) {
                    return back()->with('numpwderror', "Password must be grater than 6!!!");
                } else {
                    $hashed = Hash::make($newPassword);
                    DB::table('users')->where('id', $id)->update([
                        'password' => $hashed,
                    ]);
                    return back()->with('successpwd', "Password Changed!!");
                };
            }
        } else {
            return back()->with('pwderror', "Old password do not match!!!");
        };

    }

    public function contact_list()
    {
        $datas = Contact::query()->paginate(4);
        return view('admin.contact', compact('datas'));
    }

    public function search_contact(Request $request)
    {
        $search_key = $request->table_search;
        $datas = Contact::query()->orWhere('name', 'like', '%' . $search_key . '%')->orWhere('email', 'like', '%' . $search_key . '%')->orWhere('message', 'like', '%' . $search_key . '%')->paginate(4);
        $datas->appends($request->all());
        return view('admin.contact', compact('datas'));
    }
}
