<?php
namespace Admin\Model;
use Think\Model;
class AttrModel extends Model{
	// 在添加时调用create方法时允许接收的字段
	protected $insertFields = array('type_id','attr_name','attr_type','attr_option_values');
	// 在修改时调用create方法时允许接收的字段
	protected $updateFields = array('id','type_id','attr_name','attr_type','attr_option_values');
	// 自动验证
	protected $_validate = array(
		array('type_id', 'require', '所在的类型的id不能为空！', 1, 'regex', 3),
        array('type_id', 'number', '所在的类型的id必须是一个整数！', 1, 'regex', 3),
        array('attr_name', 'require', '属性名不能为空！', 1, 'regex', 3),
        array('attr_name', '1,30', '属性名的值最长不能超过 30 个字符！', 1, 'length', 3),
        array('attr_type', 'require', '属性的类型0：唯一 1：可选不能为空！', 1, 'regex', 3),
        array('attr_type', 'number', '属性的类型0：唯一 1：可选必须是一个整数！', 1, 'regex', 3)
	);
    public function search($pageSize = 10){
        /************ 搜索 ****************/
        $where['type_id'] = I('get.type_id');
        /************ 分页 ****************/
        $count = $this->alias('a')->where($where)->count();
        $page = new \Think\Page($count, $pageSize);
        // 设置分页的样式
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $data['page'] = $page->show();
         /************ 取数据 ****************/
         $data['data'] = $this->alias('a')->where($where)->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
         return $data;
    }





}