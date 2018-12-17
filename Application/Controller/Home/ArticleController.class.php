<?php
namespace Controller\Home;
class ArticleController extends BaseController{
    //文章列表
    public function listAction(){
        $cat_id=(int)$_GET['cat_id'];
        $cat_model=new \Model\CategoryModel();
        $data['cat_list']=$cat_model->getCatTree(); //获取类别树
        $art_model=new \Model\ArticleModel();
        $data['art_list']=$art_model->getHomeArticleByCatId($cat_id);   //通过类别id
        $this->smarty->assign('data',$data);
        $this->smarty->display('art_list.html');
    }
    //文章内容
    public function articleAction(){
        $art_id=(int)$_GET['art_id'];
        $model=new \Core\Model('article');
        $data['art_info']=$model->find($art_id);    //获取文章内容
        //阅读数加1
        if(empty($_SESSION['is_read'][$art_id])){    //防止灌水
            $data['art_info']['art_read']=$data['art_info']['art_read']+1;
            if($model->update( $data['art_info']))
                $_SESSION['is_read']=array($art_id=>1);     //表示已经阅读
        }
        //阅读数加1结束
        $reply_model=new \Model\ReplyModel();
        $data['reply_list']=$reply_model->getReplyTree($art_id);    //获取回复内容 
        $this->smarty->assign('data',$data);
        $this->smarty->display('art_article.html');
    }
    //添加主回复
    public function addReplyAction(){
        if(empty($_SESSION['user']))
            $this->error ('index.php?p=Admin&c=Login&a=login', '您还没有登录，请先登录再回复');
        $data['art_id']=$_POST['art_id'];
        $data['user_id']=$_SESSION['user']['user_id'];
        $data['reply_content']=$_POST['txaArticle'];
        $data['reply_time']=time();
        $data['parent_id']=0;
        $model=new \Core\Model('reply');
        if($model->insert($data))
            $this->success ('index.php?p=Home&c=Article&a=article&art_id='. $data['art_id'], '回复成功');
        else
            $this->error ('index.php?p=Home&c=Article&a=article&art_id='. $data['art_id'], '回复失败');
    }
    //添加子评论
    public function addSubReplyAction(){
        if(empty($_SESSION['user']))
            $this->error ('index.php?p=Admin&c=Login&a=login', '您还没有登录，请先登录再回复');
        if(!empty($_POST)){
            $data['art_id']=(int)$_GET['art_id'];   //文章编号
            $data['user_id']=$_SESSION['user']['user_id'];
            $data['reply_content']=$_POST['reply'];
            $data['reply_time']=time();
            $data['parent_id']=(int)$_GET['reply_id'];   //回复编号
            $reply_model=new \Core\Model('reply');
            if($reply_model->insert($data))
                $this->success ('index.php?p=Home&c=Article&a=article&art_id='.$data['art_id'], '添加成功');
            else
                $this->error ('index.php?p=Home&c=Article&a=article&art_id='.$data['art_id'], '添加失败');
        }
        $this->smarty->display('addSubReply.html');
    }
    //赞踩
    public function SayGoodAction(){
        $art_id=(int)$_GET['art_id'];
        $art_model=new \Core\Model('article');
        $data=$art_model->find($art_id);
        if((int)$_GET['flag']==1 && empty($_SESSION['art_good']['art_id'])){
                $_SESSION['art_good']=array('art_id'=>$art_id);
                $data['art_good']= $data['art_good']+1;
        }
        elseif((int)$_GET['flag']==0 && empty($_SESSION['art_bad']['art_id'])){
            $_SESSION['art_bad']=array('art_id'=>$art_id);
             $data['art_bad']= $data['art_bad']+1;
        }
        $art_model->update($data);
        header('location:index.php?p=Home&c=Article&a=article&art_id='.$art_id);
    }
}