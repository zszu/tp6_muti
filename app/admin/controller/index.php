<?php

namespace app\admin\controller;

use think\Request;
use think\facade\Env;
use think\facade\Db;
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

        return '我是admin模块中的index方法';
    }
    public function model(){
        $model = new News();
        // $res = $model->findOne(1);
        $data = [
            'title'=>'create',
        ];
        $res = News::create($data);
        var_dump($res);die;
    }


    public function hello(){
        return '我是admin模块中的hello方法';
    }
    /**
     *登录 login
     */
    public function login(){
        return View::fetch();
    }

}
