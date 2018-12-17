<?php
//基础控制器
namespace Core;
class Controller{
    protected $smarty;
    public function __construct() {
        $this->initSession();
        $this->initSmarty();
    }
    //开启会话
    private function initSession(){
        new \Lib\Session();
    }
    private function initSmarty(){
        $this->smarty=new \Smarty();      //实例化smarty对象
        $this->smarty->setTemplateDir(__VIEW__);  //设置模板文件夹
        $this->smarty->setCompileDir(APP_PATH.'Viewc'.DS.PLATFORM_NAME.DS);   //设置混编文件夹
    }
    //封装成功后跳转
    public function success($url,$info='',$time=1){
        $this->jump($url,$info,$time,'success');
    }
    //封装失败后跳转
    public function error($url,$info='',$time=3){
        $this->jump($url,$info,$time,'error');
    }
    /*
     * 跳转的方法
     * @param $url string 跳转的地址
     * @param $info string 显示的信息
     * @param $time int 停留的时间
     * @param $flag string success|error 
     */
    private function jump($url,$info='',$time=3,$flag='success'){
        if($info=='')   //没有信息显示就直接跳转
            header("location:{$url}");
        else{
            echo <<<str
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="{$time};{$url}"/>
<title>无标题文档</title>
<style type="text/css">
body{text-align:center;}
img{margin-top:100px;}
h2{font-size:24px;}
div{font-size:14px;}
#success{color:#060;}
#error{color:#F00;}
</style>
</head>

<body>
<img src="/Public/images/{$flag}.fw.png" />
<h2 id="{$flag}">{$info}</h2>
<div>{$time}秒以后跳转</div>
</body>
</html>
str;
exit;
        }
    }
}


