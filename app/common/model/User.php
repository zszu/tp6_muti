<?php
namespace app\common\model;

use think\Model;
/**
* 用户模型
* @param password string md5(md5())
*/
class User extends Model
{
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