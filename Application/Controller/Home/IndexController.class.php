<?php
namespace Controller\Home;
class IndexController extends \Controller\Home\BaseController{
    public function indexAction(){
        $art_model=new \Model\ArticleModel();
        $data['art_list']=$art_model->getHomeArticle();
        $cat_model=new \Model\CategoryModel();
        $data['cat_list']=$cat_model->getCatTree();
        $this->smarty->assign('data',$data);
        $this->smarty->display('index.html');
    }
}

