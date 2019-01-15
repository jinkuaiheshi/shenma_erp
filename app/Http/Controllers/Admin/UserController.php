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
        $data = User::where('status',1)->get();
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
                if($Nuser->save()){
                    $this->log($Nuser->username,'添加用户');
                    return redirect(url()->previous())->with('message', '添加用户成功')->with('type','success')->withInput();
                }
            }
        }
    }
    public function data(){
        $data = Log::get();
        return view('admin/data')->with('data',$data);
    }
}
