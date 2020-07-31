<?php
namespace app\admin\validate;

use think\Validate;

/**
 * User validate
 */
class UserValidate extends Validate
{
    protected $rule = [
        'username' => 'require|max:5',
        'password' => 'require|max:128',
    ];
    protected $message = [
        'username.require' => '用户必须填写',
        'username.max' => '用户长度最长 128',
        'name.require' => '密码必须填写',
        'password.max' => '用户必须长度最长 128',
    ];

}