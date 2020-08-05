<?php
namespace app\common\model;


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



}