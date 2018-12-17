<?php
namespace Model;
class ArticleModel extends \Core\Model{
    //获取文章和类别
    public function getArticleAndCategory(){
        $sql="select count(*) from article natural join category where art_recycle=0 and user_id=".$_SESSION['user']['user_id'];
        $recordcount=$this->mypdo->fetchColumn($sql);   //总记录数
        $page=new \Lib\Page($recordcount,$GLOBALS['config']['app']['pagesize']);    //实例化分页类
        $sql="select * from article natural join category where art_recycle=0 and user_id=".$_SESSION['user']['user_id']." limit {$page->startno},{$page->pagesize}";
        $data['list']=$this->mypdo->fetchAll($sql);
        $data['pagestr']=$page->show();
        return $data;
    }
    /*
     * 软删除,可以删除一条记录，也可以批量删除
     */
    public function del($art_id){
        $sql="update article set art_recycle=1 where art_id in ($art_id)";
        return $this->mypdo->exec($sql);
    }
    //文章检索
    public function search($condition=array()){
        //第一步：获取中记录数
        $sql="select count(*) from article natural join category where art_recycle=0 and user_id=".$_SESSION['user']['user_id'];
        $sql=$this->searchAddConditon($sql, $condition);
        $recordcount=$this->mypdo->fetchColumn($sql);   //总记录数
        //第二步：实例化Page对象
        $page=new \Lib\Page($recordcount,$GLOBALS['config']['app']['pagesize']);
        //第三步：获取当前页的内容
        $sql="select * from article natural join category where art_recycle=0 and user_id=".$_SESSION['user']['user_id'];
        $sql=$this->searchAddConditon($sql, $condition);
        $sql.=" limit {$page->startno},{$page->pagesize}";
        $data['list']=$this->mypdo->fetchAll($sql);
        $data['pagestr']=$page->show();
        return $data;
    }
    private function searchAddConditon($sql,$condition){
        foreach($condition as $k=>$v){
            $v=trim($v);
            if($v=='')
                continue;
            elseif($k=='art_title' || $k=='art_content')
                $sql.=" and `$k` like '%$v%'";
            elseif($k=='cat_id'){
                $sub_cat_ids=  $this->getSubCatId($v);
                $sql.=" and cat_id in ($sub_cat_ids)";
            }
            else
                $sql.=" and `$k`='$v'";
        }
        return $sql;
    }
    
    //获取类别和类别下的所有子类别的id
    private function getSubCatId($cat_id){
        $cat_model=new CategoryModel();
        $sub_cat_list=$cat_model->getCatTree($cat_id);
        $id_array[]=$cat_id;
        foreach($sub_cat_list as $rows){
            $id_array[]=$rows['cat_id'];
        }
        return implode(',', $id_array);
    }
    //前台获取
    public function getHomeArticle(){
        $sql="select a.*,u.user_name,c.cat_name from article a natural join user u natural join category c where art_recycle=0 and art_public=1 order by art_top desc";
        return $this->mypdo->fetchAll($sql);
    }
    //前台列表页，通过类别编号获取对于的文章
    public function getHomeArticleByCatId($cat_id){
        $cat_ids=$this->getSubCatId($cat_id);
        $sql="select a.*,u.user_name,c.cat_name from article a natural join user u natural join category c where art_recycle=0 and art_public=1 and a.cat_id in ($cat_ids) order by art_top desc";
        return $this->mypdo->fetchAll($sql);
    }
}










