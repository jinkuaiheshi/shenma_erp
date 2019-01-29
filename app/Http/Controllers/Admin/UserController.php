<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Log;
use App\Admin\User;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Crypt;
use Symfony\Component\VarDumper\Cloner\Data;

class UserController extends CommonController
{
    public function index(){
        $data = User::where('parentid',session('islogin')->id)->get();
        return view('admin/user')->with('data',$data);
    }
    public function add(Request $request){
        if ($request->isMethod('POST')) {
            $username = trim($request['username']);
            $user = User::where('username',$username)->first();
            if($user){
                return redirect(url()->previous())->with('message', '用户名已经存在')->with('type','danger')->withInput();
            }else{
                $Nuser = new User();
                $Nuser->username = $username;
                $Nuser->created_time = date('Y-m-d H:i:s', time());
                $Nuser->password = Crypt::encrypt(trim($request['password']));
                $Nuser->status = 1;
                $Nuser->auth = 1;
                $Nuser->ip = $request->getClientIp();
                $Nuser->parentid = session('islogin')->id;
                if($Nuser->save()){
                    $this->log($Nuser->username,'添加用户');
                    return redirect(url()->previous())->with('message', '添加用户成功')->with('type','success')->withInput();
                }
            }
        }
    }
    public function data(){
        $islogin = session('islogin');
        $data = Log::where('do_admin',$islogin->username)->orderBy('created_time','DESC')->get();
        return view('admin/data')->with('data',$data);
    }
    public function status($id){
        if($id){
            $user= User::where('auth',1)->where('id',$id)->first();
            if($user){
                if($user->status==1){
                    $user->status = -1;
                }else{
                    $user->status = 1;
                }
                if($user->update()){
                    $this->log($user->username,'更改状态');
                    return redirect(url()->previous())->with('message', '更改状态成功')->with('type','success');
                }
            }
        }
    }
}
