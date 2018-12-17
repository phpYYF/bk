<?php
//基础控制器
namespace Controller\Admin;
class BaseController extends \Core\Controller{
    public function __construct() {
        parent::__construct();
        $this->checkLogin();
    }
    //验证是否登录
    private function checkLogin(){
        if(strtoupper(CONTROLLER_NAME)=='LOGIN')    //LOGIN控制器不需要验证
            return;
        if(empty($_SESSION['user']))
            header('location:index.php?p=Admin&c=Login&a=login');
    }
}
