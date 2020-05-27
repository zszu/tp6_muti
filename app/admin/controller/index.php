<?php

namespace app\admin\controller;

use think\Request;
use think\facade\Env;
use think\facade\Db;
use think\facade\Session;
use app\common\model\News;
use think\facade\View;
class Index
{

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

      if(empty(Session::get('username'))){
            return '<script type="text/javascript">alert("请登录！");window.location.href = "/admin/user/login"; </script>';
      }  
      return View::fetch('index',[
        'username'=>Session::get('username'),
    ]);
    }
    public function welcome(){
       return View::fetch('welcome' ,[
            'username'=>Session::get('username'),
        ]);
    }
 

    public function hello(){
        return '我是admin模块中的hello方法';
    }


}
