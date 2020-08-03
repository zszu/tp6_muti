<?php
declare (strict_types = 1);

namespace app\common\model;


/**
 * @mixin think\Model
 */
class Articles extends BaseModel
{
    public function searchTitleAttr($query , $value){

        return $value ? $query->where('title' , 'like' , '%'.$value.'%') : '' ;
    }

    //一对一  $model->cateObj 是一个对象
    public function cateObj(){
        return $this->hasOne(Cate::class , 'id' , 'type');
    }
}
