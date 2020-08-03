<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\Request;
use app\common\model\Articles as ArticlesModel;

class Articles extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(){
        $title =  request()->param('title');

        $order = request()->param('order');
        $query = ArticlesModel::order(['order_by'  => 'desc' , 'created_at'=> $order])
            ->withSearch(['title' ] , [
                'title' => $title,
            ]);
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
//        dd($data);
        $file = $request->file('cover');

        $info = \think\facade\Filesystem::disk('public')->putFile( 'articles', $file);

        if(!$info){
            return $this->error('图片保存失败' , $file->getError() , url('index'));
        }

        $data['cover'] = '/storage/' . str_replace('\\' , '/' , $info);

        if($scene == 'insert'){
            $id = ArticlesModel::create($data)->getData('id');
        }else{
            $id = ArticlesModel::update($data);
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
        $model = ArticlesModel::find($id);

        return view('edit' , [
            'model' => $model,
            'id' => $id,
//            'statusArr' => StatusEnum::$listStatus,
        ]);
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
        $bool = ArticlesModel::destroy($id);
        if($bool){
            return $this->success('删除成功' , '' , url('index'));
        }else{
            return $this->error('删除失败');
        }
    }
}
