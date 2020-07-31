<?php
declare (strict_types = 1);

namespace app\admin\validate;

use think\Validate;

class MemberValidate extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'username' => 'require|min:2|max:10|chsDash|unique:user',
        'password' => 'require|min:6',
        'password_confirm' => 'require|confirm:password',
        'email' => 'require|email|unique:user',
//        'agree' => 'require|accepted',
        '__token__' => 'token',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'username.require' => '用户名不能为空',
        'username.min' => '用户名最短为2位',
        'username.max' => '用户名最长为10位',
        'username.chsDash' => '用户名只能为汉字,字母,数字或下划线以及破折号',
        'username.unique' => '用户名已存在',
        'password.require' => '密码不能为空',
        'password.min' => '密码最短为6位',
        'password_confirm.require' => '确认密码最短为6位',
        'password_confirm.confirm' => '两次输入密码不一致',
        'email.require' => '邮箱不能为空',
        'email.email' => '邮箱格式不对',
        'email.unique' => '邮箱已存在',
        'agree.require' => '协议不能为空',
        'agree.accepted' => '必须同意协议',
    ];
}
