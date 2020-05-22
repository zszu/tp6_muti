<?php

namespace app\admin\controller;

use think\facade\Request;
use think\facade\Env;
use think\facade\Db;
use app\common\model\News;
use think\facade\View;
class Login
{

    /**
     *登录 login
     */
    public function login(){

    	if(Request::method() == 'POST'){
    		$params = Request::param();
    		 if(empty($admin)){
                echo json_encode(['code'=>1,'msg'=>'未找到管理员']);
                exit;
            }
            if(md5($all['pwd']) != $admin['password']){
                echo json_encode(['code'=>1,'msg'=>'密码错误']);
                exit;
            }
            Session::set('uid',$admin['uid']);
            Session::set('account',$admin['account']);
            echo json_encode(['code'=>0,'msg'=>'登陆成功']) ;
    	}
    	
        return View::fetch();
    }
    public function hello(){
    	var_dump('hello login controller');die;
    }

}
