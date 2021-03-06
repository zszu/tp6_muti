<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\common\enum\StatusEnum;
use think\Request;
use app\common\model\Cate as CateModel;

class Cate extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $title =  request()->param('title');

        $order = request()->param('order');
        $query = CateModel::order(['order_by'  => 'desc' , 'created_at'=> $order]);
        return view('index',[
            'models' => $query->paginate([
                'list_rows' => 10,
                'query' => request()->param()
            ]),
            'count' => $query->count(),
            'title' => $title,
            'order' => $order =='desc' ? 'asc' : 'desc',
        ]);
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


        if(!empty($_FILES['cover']['tmp_name'])){
            $file = $request->file('cover');
            $info = \think\facade\Filesystem::disk('public')->putFile( 'articles', $file);

            if(!$info){
                return $this->error('图片保存失败' , $file->getError() , url('index'));
            }

            $data['cover'] = '/storage/' . str_replace('\\' , '/' , $info);
        }

        if($scene == 'insert'){
            $id = CateModel::create($data)->getData('id');
        }else{
            $id = CateModel::update($data);
        }

        if($id){
            return $this->success('保存成功' , '' , url('index'));
        }else{
            return $this->error('保存失败' , '' , url('index'));
        }
    }



    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id = '')
    {
        $model = CateModel::find($id);

        return view('edit' , [
            'model' => $model,
            'id' => $id,
            'statusArr' => StatusEnum::$listStatus,
        ]);
    }


    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $bool = CateModel::destroy($id);
        if($bool){
            return $this->success('删除成功' , '' , url('index'));
        }else{
            return $this->error('删除失败');
        }
    }
}
