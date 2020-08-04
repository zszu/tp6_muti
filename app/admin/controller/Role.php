<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\Request;
use app\common\model\Role as RoleModel;

class Role extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(){
        $name =  request()->param('username');

        $order = request()->param('order');
        $query = RoleModel::order([ 'created_at'=> $order])
            ->withSearch(['name'] , [
                'name' => $name,
            ]);
        return view('index',[
            'models' => $query->paginate([
                'list_rows' => 10,
                'query' => request()->param()
            ]),
            'count' => $query->count(),
            'name' => $name,
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = request()->param();

        //场景
        $scene = $data['scene'];
//        try{
//            validate(MemberValidate::class)->scene($scene)->batch()->check($data);
//        }catch (ValidateException $e){
//            return $this->error('提交失败' , $e->getError() );
//        }
        if($scene == 'insert'){
            $id = RoleModel::create($data)->getData('id');
        }else{
            $id = RoleModel::update($data);
        }

        if($id){
            return $this->success('保存成功' , '' , url('index'));
        }else{
            return $this->error('保存失败' , '' , url('index'));
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
