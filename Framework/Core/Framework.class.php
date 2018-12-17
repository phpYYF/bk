<?php
namespace Core;
class Framework{
    public static function run(){
        self::initConst();
        self::initConfig();
        self::initError();  //初始化错误处理
        self::initRoutes();
        self::initAutoLoad();
        self::initDispatch();
    } 

    //初始化路径常量
    private static function initConst(){
        define('DS', DIRECTORY_SEPARATOR);  //定义目录分隔符
        define('ROOT_PATH',getcwd().DS);       //index.php所在的目录
        define('APP_PATH', ROOT_PATH.'Application'.DS); //Application目录地址
        define('CONFIG_PATH', APP_PATH.'Config'.DS);    //配置目录
        define('CONTROLLER_PATH', APP_PATH.'Controller'.DS);    //控制器目录
        define('MODEL_PATH', APP_PATH.'Model'.DS);  //模型目录
        define('VIEW_PATH', APP_PATH.'View'.DS);    //视图目录
        define('FRAMEWORK_PATH', ROOT_PATH.'Framework'.DS); //框架目录
        define('CORE_PATH', FRAMEWORK_PATH.'Core'.DS);  //框架核心目录
        define('LIB_PATH', FRAMEWORK_PATH.'Lib'.DS);    //框架扩展
    }
    //引入配置文件
    private static function initConfig(){
        $GLOBALS['config']=require CONFIG_PATH.'config.php';
    }
    //确定路由
    private static function initRoutes(){
        $p=isset($_GET['p'])?$_GET['p']:$GLOBALS['config']['app']['default_platform'];        //获取平台
        $c=isset($_GET['c'])?$_GET['c']:$GLOBALS['config']['app']['default_controller'];	//获取控制器名
        $a=isset($_GET['a'])?$_GET['a']:$GLOBALS['config']['app']['default_action'];		//获取方法名
        $c=ucfirst(strtolower($c));	//首字母大写
        $a=strtolower($a);              //全部转成小写
        define('PLATFORM_NAME', $p);    //平台名字常量
        define('CONTROLLER_NAME', $c);  //控制器名字常量
        define('ACTION_NAME', $a);      //方法名字常量
        define('__URL__', CONTROLLER_PATH.$p.DS);          //当前控制器目录地址
        define('__VIEW__', VIEW_PATH.$p.DS);    //当前视图目录地址
    }
    //自动加载类
    private static function initAutoLoad(){
        //注册自动加载类
        spl_autoload_register(function($class_name){
            $class_map=array(
                'Smarty'    =>  CORE_PATH.'Smarty'.DS.'Smarty.class.php'
            );
            if(isset($class_map[$class_name])){
                require $class_map[$class_name];
                return;
            }            
            $namespace=dirname($class_name);    //命名空间
            $class_name=  basename($class_name);    //类名
            if(in_array($namespace, array('Core','Lib')))
                    $path=FRAMEWORK_PATH.$namespace.DS.$class_name.'.class.php';    //拼接框架类路径
            elseif($namespace=='Model')     
                $path=APP_PATH.$namespace.DS.$class_name.'.class.php';//拼接模型路径
            else
                $path=__URL__.$class_name.'.class.php'; //拼接控制器路径
            if(file_exists($path))  //如果类文件存在就加载
                require $path;    
        });
    }
    //请求分发
    private static function initDispatch(){
        $controller_name='\Controller\\'.PLATFORM_NAME.'\\'.CONTROLLER_NAME.'Controller';	//拼接控制器类名
        $action_name=ACTION_NAME.'Action';			//拼接方法名
        $obj=new $controller_name();	//实例化控制器
        $obj->$action_name();	//调用控制器的方法
    }
    //错误处理
    private static function initError(){
        ini_set('error_reporting', E_ALL);  //报所有的错
        if($GLOBALS['config']['app']['debug']){ //开发模式
            ini_set('display_errors', 'on');    //显示在浏览器上
            ini_set('log_errors','off');    //日志中不用记录
        }else{      //运行模式
            ini_set('display_errors', 'off');    //不显示在浏览器上
            ini_set('log_errors','on');    //日志中记录
            $errorfile=date('Y-m-d').'.log';    //错误文件名
            ini_set('error_log','F:\wamp\tmp\\'.$errorfile);    //日志地址
        }
    }
}

