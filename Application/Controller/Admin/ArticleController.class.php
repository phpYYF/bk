<?php
namespace Controller\Admin;
class ArticleController extends BaseController{
    //显示文章列表
    public function listAction(){
        //检索文章
        $art_model=new \Model\ArticleModel();
        $cat_model=new \Model\CategoryModel();
        $data['cat_list']=$cat_model->getCatTree(); //类别列表
        if(!empty($_POST)){
            $array=$art_model->search($_POST);  //搜索内容和分页字符串
        }else{
            $array=$art_model->getArticleAndCategory();  //获取内容列表和分页字符串
        }
        $data['art_list']=$array['list'];
        $data['pagestr']=$array['pagestr'];
        $data['condition']=  empty($_POST)?array():$_POST;  //保存搜索条件
        $this->smarty->assign('data',$data);
        $this->smarty->display('article_list.html');
    }
    //添加文章
    public function addAction(){
        if(!empty($_POST)){ //执行添加逻辑
            $_POST['art_time']=time();
            $_POST['user_id']=$_SESSION['user']['user_id'];
            $model=new \Core\Model('article');
            if($model->insert($_POST)){
                $this->success('index.php?p=Admin&c=Article&a=list', '添加成功');
            }else{
                $this->error('index.php?p=Admin&c=Article&a=add', '添加失败');
            }
        }
        //显示添加视图
        $cat_model=new \Model\CategoryModel();
        $cat_list=$cat_model->getCatTree();
        $this->smarty->assign('cat_list',$cat_list);
        $this->smarty->display('article_add.html');
    }
    //修改文章
    public function editAction(){
        $art_id=(int)$_GET['art_id'];
        $art_model=new \Model\ArticleModel();
        //执行修改的业务逻辑
        if(!empty($_POST)){
            $_POST['art_id']=$art_id;
            if($art_model->update($_POST))
                $this->success ('index.php?p=Admin&c=Article&a=list', '修改成功');
            else
                $this->error ('index.php?p=Admin&c=Article&a=edit&art_id='.$art_id, '修改失败');
        }        
        $data['art_info']=$art_model->find($art_id);    //需要修改的文章内容
        $cat_model=new \Model\CategoryModel();
        $data['cat_list']=$cat_model->getCatTree();     //分类树形结构
        $this->smarty->assign('data',$data);        
        $this->smarty->display('article_edit.html');
    }
    //删除文章(软删除)
    public function delAction(){
        $model=new \Model\ArticleModel();
        if($model->del($_GET['art_id']))
            $this->success ('index.php?p=Admin&c=Article&a=list', '删除成功');
        else
            $this->error ('index.php?p=Admin&c=Article&a=list', '删除失败');
    }
    //置顶和取消置顶
    public function topAction(){
        $data['art_id']=(int)$_GET['art_id'];
        $data['art_top']=(int)$_GET['art_top'];
        $art_model=new \Model\ArticleModel();
        if($art_model->update($data))
            $this->success ('index.php?p=Admin&c=Article&a=list', '操作成功');
        else
            $this->error ('index.php?p=Admin&c=Article&a=list', '操作失败');
    }
}








