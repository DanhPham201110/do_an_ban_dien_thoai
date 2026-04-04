<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Http\Requests\LoginRequest;
use Monolog\Handler\IFTTTHandler;

class AuthAdminController extends Controller
{
    public function vLogin()
    {
        return view('auth::admin.login');
    }

    public function pLogin(LoginRequest $request)
    {
        $data       = $request->except("remember","_token");
        $remember   = $request->has("remember");

        $statusLogin = Auth::guard("admin")->attempt($data, $remember);

        if ($statusLogin){
            toastr()->success("Đăng nhập thành công");

            return redirect()->route("get.home.index");
        }
        toastr()->error("Tên tài khoản họăc mật khẩu không chính xác","Đăng nhập thất bại");

        return redirect()->back()->withInput();
    }
    public function vRegister()
    {
        return view('auth::admin.register');
    }
    public function vForgetPassword()
    {
        return view('auth::admin.forget_password');
    }

    public function logOut(){
        Auth::guard("admin")->logout();

        return redirect()->route("get.auth.login");
    }
}
