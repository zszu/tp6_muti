<?php
declare (strict_types = 1);

namespace app\common\model;

use think\Model;

/**
 * @mixin think\Model
 */
class Role extends Model
{
   public function searchNameAttr($query , $value){
       return $value ? $query->where('name' , 'like' , '%'.$value.'%') : '';
   }

}
