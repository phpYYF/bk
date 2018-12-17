<?php
//登录模块
namespace Controller\Admin;
class LoginController extends BaseController{
    //登录方法
    public function loginAction(){
        if(!empty($_POST)){
            //验证验证码
            $captcha=new \Lib\Captcha();
            if(!$captcha->checkCaptcha($_POST['passcode'])){
                $this->error('index.php?p=Admin&c=Login&a=login', '验证码错误');
            }
            $condition['user_name']=$_POST['username'];
            $condition['user_pwd']=md5($_POST['password']);
            $model=new \Core\Model('user');
            if($user=$model->select($condition)){
                $_SESSION['user']=$user[0];    //将用户信息保存到会话中
                $this->updateLoginInfo();   //更新登录信息
                //记住用户名和密码
                if(isset($_POST['remember'])){
                    $time=time()+3600*24*7;
                    setcookie('user_name',$_POST['username'],$time);
                    setcookie('user_pwd',$_POST['password'],$time);
                }
                //记住用户名和密码结束
                $this->success('index.php?p=Admin&c=Admin&a=Admin', '登录成功');
            }else{
                $this->error('index.php?p=Admin&c=Login&a=login', '登录失败，请重新登录');
            }            
        }
        $data['user_name']=$_COOKIE['user_name']??'';   //获取cookie中的用户名
        $data['user_pwd']=$_COOKIE['user_pwd']??''; //获取cookie中的密码
        $this->smarty->assign('data',$data);
        $this->smarty->display('login.html');
    }
    //注册
    public function registerAction(){
        if(!empty($_POST)){ //执行注册的业务逻辑
            //头像上传开始
            $path=$GLOBALS['config']['app']['upload_path'];
            $size=$GLOBALS['config']['app']['upload_size'];
            $type=$GLOBALS['config']['app']['upload_type'];
            $upload=new \Lib\Upload($path, $size, $type);
            if($face=$upload->upload($_FILES['face'])){
                $data['user_face']=$face;
            }else{
                $this->error('index.php?p=Admin&c=Login&a=register', $upload->getError());
            }
            //头像上传结束
            $data['user_name']=$_POST['username'];
            $data['user_pwd']=md5($_POST['password']);  //md5加密
            $model=new \Core\Model('user');
            if($model->insert($data)){
                $this->success('index.php?p=Admin&c=Login&a=login', '注册成功,你可以去登录了');
            }else{
                $this->error('index.php?p=Admin&c=Login&a=register','注册失败，请重新注册');
            }
        }
        $this->smarty->display('register.html');
    }
    //更新登录信息
    private function updateLoginInfo(){
        $data['last_login_time']=time();
        $data['last_login_ip']= ip2long($_SERVER['REMOTE_ADDR']);
        $data['login_count']=++$_SESSION['user']['login_count'];
        $data['user_id']=$_SESSION['user']['user_id'];
        $model=new \Core\Model('user');
        $model->update($data);  //更新登录信息
    }
    //验证码
    public function captchaAction(){
        $captcha=new \Lib\Captcha();
        $captcha->generalCaptcha();
    }
    //安全退出
    public function logoutAction(){
        session_destroy();
        header('location:index.php?p=Admin&c=Login&a=login');
    }
}












