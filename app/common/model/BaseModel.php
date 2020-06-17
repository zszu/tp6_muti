<?php
use \think\facade\Db;
class BaseModel extends \think\Model
{
    public $table = '';
    /**

     * 增加数据

     */

    public function addData($where=array(),$data=array()){

        return Db::name($this->table)->where($where)->save($data);

    }

    /**

     * 修改数据

     */

    public function savaData($where=array(),$data=array()){

        return Db::name($this->table)->where($where)->update($data);

    }

    /**

     * 删除数据

     */

    public function delData($where=array(),$data=array()){

        return Db::name($this->table)->where($where)->delete();

    }

    /**

     * 获取单个数据

     *

     */

    public function getOne($where=array(),$field='*'){

        return Db::name($this->table)->field($field)->where($where)->find();

    }

    /**

     * 获取某个字段单的的值

     */

    public function getValue($where=array(),$field='*'){

        return Db::name($this->table)->where($where)->value($field);

    }

    /**

     *

     * 获取某个字段的所有值

     */

    public function getColumn($where=array(),$field='*'){

        return Db::name($this->table)->where($where)->column($field);

    }

    /**

     * 字段的自增

     */

    public function SetIncData($where=array(),$field='*',$step=1){

        return Db::name($this->table)->where($where)->setInc($field);

    }
    public function onBeforeInsert()
    {
        $this->created_at = time();
        $this->updated_at = time();
    }
    public function onBeforeUpdate()
    {
        $this->updated_at = time();
    }
}