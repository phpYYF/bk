<?php
//类别模块
namespace Controller\Admin;
class CategoryController extends \Controller\Admin\BaseController{
    public function listAction(){
        $model=new \Model\CategoryModel();
        $list=$model->getCatTree();
        $this->smarty->assign('list',$list);
        $this->smarty->display('cat_list.html');
    }
        //添加类别
    public function addAction(){
        $model=new \Model\CategoryModel();
        if(!empty($_POST)){    //添加类别的业务逻辑
            $data['cat_name']=$_POST['cat_name'];
            $data['sort_order']=$_POST['sort_order'];
            $data['parent_id']=$_POST['parentid'];
            if($model->insert($data))
                $this->success ('index.php?p=Admin&c=Category&a=list', '添加成功');
            else
                $this->error ('index.php?p=Admin&c=Category&a=add', '添加失败');
        }
        //显示添加类别页面
        $cat_list=$model->getCatTree();
        $this->smarty->assign('cat_list',$cat_list);
        $this->smarty->display('cat_add.html');
    }
    //修改类别
    public function editAction(){
        $cat_id=(int)$_GET['cat_id'];
        $cat_model=new \Model\CategoryModel();
        if(!empty($_POST)){
            $data['cat_name']=$_POST['cat_name'];
            $data['sort_order']=$_POST['sort_order'];
            $data['parent_id']=$_POST['parentid'];
            $data['cat_id']=$cat_id;
            //判断一：自己不能是自己的父级
            if($cat_id==$data['parent_id'])
                $this->error ('index.php?p=Admin&c=Category&a=edit&cat_id='.$cat_id,'指定的父级不能是自己');
            //判断二：指定的父级不能是自己的后代
            $sub_list=$cat_model->getCatTree($cat_id);
            foreach($sub_list as $rows){
                if($rows['cat_id']==$data['parent_id'])
                    $this->error ('index.php?p=Admin&c=Category&a=edit&cat_id='.$cat_id,'指定的父级不能是自己后代');
            }
            if($cat_model->update($data))
                $this->success ('index.php?p=Admin&c=Category&a=list', '修改成功');
            else
                $this->error ('index.php?p=Admin&c=Category&a=edit&cat_id='.$cat_id,'修改失败');
        }
        $data['cat_info']=$cat_model->find($cat_id);
        $data['cat_list']=$cat_model->getCatTree();
        $this->smarty->assign('data',$data);
        $this->smarty->display('cat_edit.html');
    }
    //删除类别
    public function delAction(){
        $cat_id=(int)$_GET['cat_id'];
        $model=new \Model\CategoryModel();
        if($model->isLeaf($cat_id)){
            if($model->delete($cat_id))
                $this->success ('index.php?p=Admin&c=Category&a=list', '删除成功');
            else
                $this->error ('index.php?p=Admin&c=Category&a=list', '删除失败');
        }else
            $this->error ('index.php?p=Admin&c=Category&a=list', '删除的节点不是叶子节点');
    }
}
