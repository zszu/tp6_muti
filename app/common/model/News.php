<?php
namespace app\common\model;

use think\Model;

/**
 * 新闻模型
 *自定义方法，不要和 thinkphp 方法一样名称
 */
class News extends Model
{
	protected $name = 'News'; // 模型名称
	protected $table = 'tsj_news';//表名
	// pk 主键名称
	protected $pk = 'shop_id';
	//disuse  数据表废弃字段（数组）
    protected $disuse = [

        'discount',

        'stock'

    ];
	 protected $schema = [

        'shop_id' => 'int',

        'cat' => 'int',

        'title' => 'string',

        'price' => 'float',

        'discount' => 'int',

        'stock' => 'int',

        'status' => 'int',

        'add_time' => 'int'

    ];
    public function findOne($id){
        $find = static::find($id);
        return $find;
    }
    // public static function create($data){
    // 	$res = static::create($data);
    // 	return $res;
    // }
	
}

