<?php
namespace app\admin\controller;

use think\facade\View;
use think\facade\Request;
use think\facade\Db;
use app\common\model\User;

/**
* 会员管理
*/
class Member 
{
	//会员列表 
	public function list(){
		return View::fetch('list',[
			'models' => Db::name('user')->select()->toArray(),
		]);
	}
	//添加
	public function create(){
		return View::fetch('create');
	}
	//编辑
	public function edit($id){
		$model = Db::name('user')->find($id);
		return View::fetch('edit' , [
			'id' => $id,
			'model' => $model,
		]);
	}

	//删除
	public function delete($id){
		$model = Db::name('user')->find($id);
		if(Db::name('user')->delete($id)){
			echo json_encode(['code'=>0 , 'msg' => '删除成功']);
		}
	}
	//保存 
	public function save(){
		if(Request::method() == 'POST'){
			$params = Request::param();
			unset($params['repass']);
			$params['password'] =md5(md5($params['password']));
			if(Db::name('user')->save($params)){
				return '修改成功';
			}else{
				return '修改失败';
			}
		}
	}
}