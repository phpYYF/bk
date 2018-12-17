<?php
namespace Model;
//products表的模型，用来操作Products表
class ProductsModel extends \Core\Model {
	//获取商品列表
	public function getList() {
		return $this->mypdo->fetchAll('select * from products');
	}
	//删除数据库
	public function del($id) {
		return (bool)$this->mypdo->exec("delete from products where proid=$id");
	}
}
