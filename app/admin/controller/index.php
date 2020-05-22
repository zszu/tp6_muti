<?php

namespace app\admin\controller;

use think\Request;
use think\facade\Env;

class index
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
    public function mysql(){
        $mysql =  [
            'default' => Env::get('database.dirver','mysql'),
              // 自定义时间查询规则
            'time_query_rule'=>[],
            // 自动写入时间戳字段

            // true为自动识别类型 false关闭

            // 字符串则明确指定时间字段类型 支持 int timestamp datetime date

            'auto_timestamp'  => true,
            'database'=>Env::get('database.database','base'),
            'username'=>Env::get('database.username','11'),
            'password'=>Env::get('database.password','11'),


        ];
        var_dump($mysql);die;
    }
    public function hello(){
        return '我是admin模块中的hello方法';
    }

}
