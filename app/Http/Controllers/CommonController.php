<?php

namespace App\Http\Controllers;

use App\Admin\Log;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    //
    public function ere(){

    }
    public function log($do,$title)
    {
        $log = new Log();
        $log->controller = request()->route()->getAction()['controller'];
        $log->created_time = date('Y-m-d H:i:s', time());
        $log->user = $do;
        $log->title = $title;
        $islogin = session('islogin');
        if($islogin){
            $log->do_admin = $islogin->username;
        }else{
            $log->do_admin = '';
        }
        if (!$log->save()) {
            return redirect('/admin/index')->with('message', '日志记录失败！')->with('type','danger');
        }

    }
}
