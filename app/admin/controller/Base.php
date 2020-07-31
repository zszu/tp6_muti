<?php
<<<<<<< HEAD
=======
namespace app\admin\controller;
use \think\facade\Session;
use think\template\exception\TemplateNotFoundException;

/**
 * @package app\admin\controller
 * desc: 基类控制器
 */
class Base
{
    public function __construct()
    {
        if(empty(Session::get('username'))){
            $url = url('user/login')->suffix('html');
            echo '<script type="text/javascript">alert("你尚未登录，请登录！");window.location.href = "'.$url.'"; </script>';
        }
    }
    public function msg($msg = '系统提示' , $infos = [], $url = '' , $type ='success'){

        return view(app()->getAppPath('admin') . 'view/public/msg.html' , [
                'msg' => $msg,
                'infos' => $infos,
                'type' => $type,
                'url' => $url,
            ]);
    }
    public function success($msg , $infos , $url = ''){
        return $this->msg($msg , $infos , $url);
    }
    public function error($msg , $infos , $url = ''){
        return $this->msg($msg , $infos , $url , 'error');
    }
}
>>>>>>> 118743116de122e9a373f8cbea5004c3cb46e32d
