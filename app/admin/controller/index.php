<?php

namespace app\admin\controller;

use think\facade\Session;
use think\facade\View;
class Index extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
      return view('index',[
            'username'=>Session::get('username'),
        ]);
    }
    public function welcome(){
       return view('welcome' ,[
            'username'=>Session::get('username'),
        ]);
    }
 

    public function hello(){
        return '我是admin模块中的 index 控制器 中的hello方法';
    }


}
