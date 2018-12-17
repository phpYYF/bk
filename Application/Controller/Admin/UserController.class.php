<?php
//后台用户管理模式
namespace Controller\Admin;
class UserController extends BaseController{
    //获取所有的普通用户
    public function listAction(){
        $model=new \Core\Model('user');
        $list=$model->select(array('is_admin'=>0));
        $this->smarty->assign('list',$list);
        $this->smarty->display('user_list.html');
    }
    //删除普通用户
    public function delAction(){
        $id=(int)$_GET['user_id'];
        $model=new \Core\Model('user');
        if($model->delete($id))
            $this->success ('index.php?p=Admin&c=User&a=list', '删除成功');
        else
            $this->error ('index.php?p=Admin&c=User&a=list', '删除失败');
    }
    //个人设置
    public function editAction(){
        if(!empty($_POST)){
            $pwd=trim($_POST['password']);
            if($pwd!='')    //更改密码
                $data['user_pwd']=md5($pwd);
            if($_FILES['face']['error']!=4){    //更改头像
                $upload=new \Lib\Upload($GLOBALS['config']['app']['upload_path'], $GLOBALS['config']['app']['upload_size'], $GLOBALS['config']['app']['upload_type']);
                if($path=$upload->upload($_FILES['face'])){
                    $data['user_face']=$path;
                }else{
                    $this->error('index.php?p=Admin&c=User&a=edit', $upload->getError());
                }
            }
            //$data不为空说明有修改的数据
            if(!empty($data)){
                $data['user_id']=$_SESSION['user']['user_id'];
                $model=new \Core\Model('user');
                if($model->update($data)){
                    session_destroy();
echo <<<str
    <script type="text/javascript">
         alert('修改成功，请重新登录');
         top.location.href='index.php?p=Admin&c=Login&a=login';
     </script>             
str;
                }
                else
                    $this->error ('index.php?p=Admin&c=User&a=edit', '修改失败');
            }
        }
        $model=new \Core\Model('user');
        $this->smarty->display('user_edit.html');
    }
}
