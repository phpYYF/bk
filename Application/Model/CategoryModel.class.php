<?php
namespace Model;
class CategoryModel extends \Core\Model{
    private $list=array();
    //获取类别的树形结构
    public function getCatTree($parent_id=0){
        $sql='select * from category order by sort_order,cat_id';
        $list=$this->mypdo->fetchAll($sql);
        $this->createTree($list,$parent_id);
        return $this->list;
    }
    //创建树形结果
    private function createTree($list,$parent_id=0,$deep=0){
        foreach($list as $rows){
            if($rows['parent_id']==$parent_id){
                $rows['deep']=$deep;
                $this->list[]=$rows;
                $this->createTree($list,$rows['cat_id'],$deep+1);
            }
        }
    }
    //判断节点是否在叶子节点
    public function isLeaf($cat_id){
        $sql="select count(*) from category where parent_id=$cat_id";
        return !$this->mypdo->fetchColumn($sql);
    }
}











