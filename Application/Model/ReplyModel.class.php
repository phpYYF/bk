<?php
namespace Model;
class ReplyModel extends \Core\Model{
    private $list=array();
    public function getReplyTree($art_id){
        $sql="select r.*,u.user_face,u.user_name from reply r natural join user u where art_id=$art_id";
        $list=  $this->mypdo->fetchAll($sql);
        $this->createTree($list);
        return $this->list;
    }
    private function createTree($list,$parent_id=0,$deep=0){
        foreach($list as $rows){
            if($rows['parent_id']==$parent_id){
                $rows['deep']=$deep;
                $this->list[]=$rows;
                $this->createTree($list, $rows['reply_id'], $deep+1);
            }
        }
    }
}
