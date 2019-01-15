<?php

namespace App\Http\Controllers\Admin;

use App\Admin\User;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Crypt;

class AdminController extends CommonController
{
    public function login(Request $request){
        if ($request->isMethod('POST')) {
            $user = User::where('username', trim($request['username']))->orwhere('phone',trim($request['username']))->first();
            if($user){
                if (Crypt::decrypt($user->password) === $request['password']) {
                    //写入session

                    $user->last_login_time = date('Y-m-d H:i:s', time());

                    if($user->update()){
                        session(['islogin' => $user]);
                        return redirect('/admin/index');
                    }
                } else {
                    return redirect('/admin/login')->with('message', '密码错误，请重新输入!')->withInput();
                }
            }else {
                return redirect('/admin/login')->with('message', '用户名不存在或者密码错误')->withInput();
            }
        }else{

            return view('admin/login');
        }

    }
    public function forget()
    {
        dd(123);
    }
    public function index(){
        return view('admin/index');
    }

}
