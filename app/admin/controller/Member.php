<?php
namespace app\admin\controller;

use  \app\common\enum\StatusEnum;
use think\exception\ValidateException;
use think\Request;
use app\common\model\User as UserModel;
use app\admin\validate\MemberValidate;
/**
* 会员管理
*/
class Member extends Base
{
	//首页
	public function index(){
	    $username =  request()->param('username');
        $start =  request()->param('start');
        $end =  request()->param('end');


        $start = $start ? strtotime($start) : '';
        $end = $end ? strtotime($end) : '';

        $order = request()->param('order');
	    $query = UserModel::order([/*'id'  => 'asc' ,*/ 'created_at'=> $order])
            ->withSearch(['username' , 'created_at'] , [
                'username' => $username,
                'created_at' => [$start , $end],
            ]);
		return view('index',[
			'models' => $query->paginate([
			    'list_rows' => 10,
                'query' => request()->param()
            ]),
            'count' => $query->count(),
            'username' => $username,
            'start' => $start ? date('Y-m-d' ,$start) : '',
            'end' => $end ? date('Y-m-d' ,$end) : '',
            'order' => $order =='desc' ? 'asc' : 'desc',
		]);
	}
	//添加
	public function create(){
		return view('create');
	}
	//编辑
	public function edit($id){
		$model = UserModel::find($id);

		return view('edit' , [
			'model' => $model,
            'id' => $id,
            'statusArr' => StatusEnum::$listStatus,
		]);
	}

	//删除
	public function delete($id){
		$bool = UserModel::destroy($id);
		if($bool){
            return $this->success('删除成功' , '' , url('index'));
		}else{
            return $this->error('删除失败');
        }
	}
	//保存 
	public function save(Request $request){
	    $data = request()->param();

	    //场景
	    $scene = $data['scene'];
        try{
            validate(MemberValidate::class)->scene($scene)->batch()->check($data);
        }catch (ValidateException $e){
            return $this->error('提交失败' , $e->getError() );
        }

        //密码加密
        $data['password'] = sha1($data['password']);
        if($scene == 'insert'){
            $id = UserModel::create($data)->getData('id');
        }else{
            $id = UserModel::update($data);
        }

        if($id){
            return $this->success('保存成功' , '' , url('index'));
        }else{
            return $this->error('保存失败' , '' , url('index'));
        }
	}
}