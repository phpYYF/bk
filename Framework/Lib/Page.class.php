<?php
namespace Lib;
class Page{
    public $recordcount;    //总记录数
    public $pagesize;       //页面大小
    public $pagecount;      //总页数
    public $pageno;         //当前页
    public $startno;        //起始位置
    public function __construct($recordcount,$pagesize=10) {
        $this->initParam($recordcount, $pagesize);
    }
    private function initParam($recordcount,$pagesize){
        $this->recordcount=$recordcount;
        $this->pagesize=$pagesize;
        $this->pagecount=ceil($this->recordcount/  $this->pagesize);
        $this->pageno=isset($_GET['pageno'])?$_GET['pageno']:1;
        if($this->pageno<1)
            $this->pageno=1;
        if($this->pageno>$this->pagecount)
            $this->pageno=  $this->pagecount;
        $this->startno=($this->pageno-1)*  $this->pagesize;
    }
    //拼接分页字符串
    public  function show(){
        $url='index.php?p='.PLATFORM_NAME.'&c='.CONTROLLER_NAME.'&a='.ACTION_NAME;
        $str='<ul class="pagination"><li><a href="'.$url.'&pageno='.($this->pageno-1).'">上一页</a></li></ul>';
        $str.='<ul class="pagination pagination-group">';
        for($i=1;$i<=$this->pagecount;$i++){
            if($i==$this->pageno)
                $str.='<li class="active"><a href="'.$url.'&pageno='.$i.'">'.$i.'</a></li>';
            else
                $str.='<li><a href="'.$url.'&pageno='.$i.'">'.$i.'</a></li>';
        }
        $str.=' </ul>';
        $str.='<ul class="pagination"><li><a href="'.$url.'&pageno='.($this->pageno+1).'">下一页</a></li></ul>';
        return $str;
    }
}
