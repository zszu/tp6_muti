<?php

namespace app\admin\controller;


use think\facade\Request;
use think\facade\Db;
use think\facade\Session;
use think\facade\Validate;

class User
{

    /**
     *登录 login
     */
    public function login(){

    	if(Request::method() == 'POST'){
    		$data = Request::param();

    		$validate = Validate::rule([
    		    'username|用户名' => 'unique:user,username^password',
            ]);

            $res = $validate->batch(true)->check([
                'username' => $data['username'],
                'password' => sha1($data['password']),
            ]);
            $errors = [];
    		if(!captcha_check($data['verifyCode'])){
    		    $errors[] = '验证码错误';
            }
            if($res){
                $errors[] = '用户名或密码错误';
            }
//            dd($errors);

            $query = Db::name('user');

            $admin = $query->where('username',$data['username'])->find();

            Session::set('uid',$admin['id']);
            Session::set('username',$admin['username']);

            $data = [
                'login_times'=>++$admin['login_times'],
                'last_login_at'=>time()
            ];
            $query->where('id',$admin['id'])->save($data);

            if(!empty($errors)){
                return  json_encode(['code'=>1,'msg'=>implode('|' , $errors)]);
            }

            return json_encode(['code'=>0,'msg'=>'登陆成功']) ;
    	}
    	
        return view();
    }
    /**
     *注册 register
     */
    public function register(){
		$params = Request::param();
    	
    	if(Request::method() == 'POST'){
    		$params['password'] = sha1($params['password']);
			if(Db::name('user')->save($params)){
				return '注册成功';
			}else{
				return '注册失败';
			}

    	}

        return view();
    }
    /**
      * 退出
      */
    public function logout(){
    	Session::delete('uid');
    	Session::delete('username');
    	return view('login');
    }
    //个人信息
    public function userInfo(){
        echo "userInfo";
    }
    public function checkout(){
        echo "checkout";
    }

  

}
