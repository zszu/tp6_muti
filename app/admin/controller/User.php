<?php

namespace app\admin\controller;

use think\facade\Request;
use think\facade\Env;
use think\facade\Db;
use think\facade\Session;
use app\common\model\News;
use think\facade\View;
class User
{

    /**
     *登录 login
     */
    public function login(){

    	if(Request::method() == 'POST'){
    		$params = Request::param();
    		$admin = Db::name('user')->where('username',$params['username'])->find();

    		 if(empty($admin)){
                echo json_encode(['code'=>1,'msg'=>'未找到管理员']);
                exit;
            }
            if(md5(md5($params['pwd'])) != $admin['password']){
                echo json_encode(['code'=>1,'msg'=>'密码错误']);
                exit;
            }
            Session::set('uid',$admin['id']);
            Session::set('username',$admin['username']);

            $data = [
                'login_times'=>++$admin['login_times'],
                'last_login_at'=>time()
                ];
            Db::name('user')->where('id',$admin['id'])->save($data);
            return json_encode(['code'=>0,'msg'=>'登陆成功']) ;
    	}
    	
        return View::fetch();
    }
    /**
     *注册 register
     */
    public function register(){
		$params = Request::param();
    	
    	if(Request::method() == 'POST'){
    		$params['password'] = md5(md5($params['password']));
			if(Db::name('user')->save($params)){
				return '注册成功';
			}else{
				return '注册失败';
			}

    	}
		

        return View::fetch();
    }
    /**
      * 退出
      */
    public function logout(){
    	Session::delete('uid');
    	Session::delete('username');
    	return View::fetch('login');
    }
    //个人信息
    public function userInfo(){
        echo "userInfo";
    }
    public function checkout(){
        echo "checkout";
    }

  

}
