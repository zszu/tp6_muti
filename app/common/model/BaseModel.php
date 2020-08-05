<?php
namespace app\common\model;

use app\common\enum\StatusEnum;

class BaseModel extends \think\Model
{
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
    public static function onBeforeInsert($obj)
    {
        $obj->created_at = time();
        $obj->updated_at = time();
    }
    public static function onBeforeUpdate($obj)
    {
        $obj->updated_at = time();
    }
}