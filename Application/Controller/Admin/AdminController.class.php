<?php
namespace Controller\Admin;
//后台管理模块
class AdminController extends BaseController{
    public function adminAction(){      //框架页面
        $this->smarty->display('admin.html');
    }
    public function topAction(){    //框架中的top页面
        $this->smarty->display('top.html');
    }
    public function menuAction(){   //框架中的menu页面
        $this->smarty->display('menu.html');
    }
    public function mainAction(){   //框架中的主页面
        $this->smarty->display('main.html');
    }
}
