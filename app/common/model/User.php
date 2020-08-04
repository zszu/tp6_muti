<?php
namespace app\common\model;

use app\common\enum\StatusEnum;
use think\Model;

/**
* 用户模型
* @param password string md5(md5())
*/
class User extends BaseModel
{
    //用户名 搜索器
    public function searchUsernameAttr($query , $value){
        return $value ? $query->where('username' , 'like' , "%$value%") : '';
    }
   //时间 搜索器
    public function searchCreatedAtAttr($query , $value){
        $value = array_filter($value);
        return $value ? $query->where('created_at' , 'between' , "$value[0] , $value[1]") : '';
    }

    //status 文本 获取器
    public function getStatusTextAttr($value , $data){
        $status = StatusEnum::$listStatus;
        return $status[$data['status']];
    }

    //虚拟 一个字段 status 状态
    public function getStatusClassAttr($value , $data){
        $class = StatusEnum::$statusClass;
        return $class[$data['status']];
    }

}