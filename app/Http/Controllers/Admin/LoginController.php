<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin.login.index');
    }
    public function post_login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            return redirect()->route('b.home');
        } else {
            return redirect()->back()->with(['type' => 'danger', 'mess' => 'Thông tin đăng nhập chưa chính xác']);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('b.login');
    }
}
