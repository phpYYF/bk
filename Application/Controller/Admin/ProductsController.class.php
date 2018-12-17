<?php
namespace Controller\Admin;
//Products控制器，用来操作Products模块
class ProductsController extends BaseController {
	//获取数据
	public function listAction() {
            $model=new \Model\ProductsModel;
            $rs=$model->getList();
            $this->smarty->assign('rs',$rs);
            $this->smarty->display('products_list.html');
            //require __VIEW__.'products_list.html';
	}
	//删除商品
	public function delAction() {
		$id=(int)$_GET['id'];	//删除记录的编号
		$model=new \Model\ProductsModel;	//实例化模型
		if($model->del($id)){
                    $this->success('index.php?p=Admin&c=Products&a=list','删除成功');
		}else{
                    $this->error('index.php?p=Admin&c=Products&a=list','删除失败');
		}
	}
        public function addAction(){
            /*
            $data['proID']=79;
            $data['proname']='bbbb';
            $data['proprice']=100;
            $model=new \Model\ProductsModel();
            if($id=$model->update($data))
                    echo $id;
            else
                echo 'errror';
             */
            /*
            $model=new \Model\ProductsModel();
            $model->delete(10);
             */
            /*
            $model=new \Core\Model('products');
            $condition=array(
                'proname'   =>  'aa',
                'proprice'  =>  10
            );
            $rs=$model->select($condition);
            var_dump($rs);
             * 
             */
            
            $model=new \Core\Model('products');
            $rs=$model->find(11);
            var_dump($rs);
        }
}



