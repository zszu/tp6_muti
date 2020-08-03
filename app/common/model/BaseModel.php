<?php
namespace app\common\model;

use \think\facade\Db;
class BaseModel extends \think\Model
{

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