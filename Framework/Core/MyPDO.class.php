<?php
namespace Core;
class MyPDO{
    private $type;      //数据库类型
    private $host;      //主机地址
    private $port;      //端口号
    private $dbname;    //数据库名
    private $charset;   //字符编码
    private $user;      //用户名
    private $pwd;       //密码
    private $pdo;       //pdo对象
    private static $instance;
    private function __construct($param){
        $this->initParam($param);
        $this->initPDO();
        $this->initException();
    }
    private function __clone(){
    }
    //初始化参数
    private function initParam($param){
        $this->type=isset($param['type'])?$param['type']:'mysql';
        $this->host=isset($param['host'])?$param['host']:'localhost';
        $this->port=isset($param['port'])?$param['port']:'3306';
        $this->dbname=isset($param['dbname'])?$param['dbname']:'';
        $this->charset=isset($param['charset'])?$param['charset']:'utf8';
        $this->user=isset($param['user'])?$param['user']:'';
        $this->pwd=isset($param['pwd'])?$param['pwd']:'';
    }
    //连接数据库
    private function initPDO(){
        try{
            $dsn="{$this->type}:host={$this->host};port={$this->port};dbname={$this->dbname};charset={$this->charset}";
            $this->pdo=new \PDO($dsn,$this->user,$this->pwd);
        }catch(\PDOException $ex){
            $this->showException($ex);
        }
    }
    //设置异常模式
    private function initException(){
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
    }
    //封装显示异常信息
    private function showException($ex,$sql=''){
        if($sql!=''){
            echo 'SQL语句执行失败<br>';
            echo '错误的SQL语句是：'.$sql,'<br>';
        }
        echo '错误编号：'.$ex->getCode(),'<br>';
        echo '错误文件：'.$ex->getFile(),'<br>';
        echo '错误行号：'.$ex->getLine(),'<br>';
        echo '错误信息：'.$ex->getMessage(),'<br>';
        exit;
    }
    //执行数据操作语句
    public function exec($sql){
        try{
            return $this->pdo->exec($sql);
        } catch (\PDOException $ex) {
            $this->showException($ex, $sql);
        }
    }
    //获取插入记录的自动增长的编号
    public function getLastInsertId(){
        return $this->pdo->lastInsertId();
    }
    //封装匹配的类型
    private function fetchType($type){
        switch($type){
            case 'assoc':
               return \PDO::FETCH_ASSOC;
            case 'num':
                return  \PDO::FETCH_NUM;
            case 'both':
                return   \PDO::FETCH_BOTH;
            default:
                return   \PDO::FETCH_ASSOC;
        }
    }
    //获取所有记录，返回二维数组
    public function fetchAll($sql,$type='assoc'){
        try{
            $stmt=$this->pdo->query($sql);
            $type=  $this->fetchType($type);
            return $stmt->fetchAll($type);
        }  catch (\PDOException $ex){
            $this->showException($ex, $sql);
        }
    }
    //匹配一行
    public function fetchRow($sql,$type='assoc'){
        try{
            $stmt=$this->pdo->query($sql);
            $type=  $this->fetchType($type);
            return $stmt->fetch($type);
        }catch(\PDOException $ex){
            $this->showException($ex, $sql);
        }
    }
    //匹配一行一列
    public function fetchColumn($sql){
        try{
            $stmt=$this->pdo->query($sql);
            return $stmt->fetchColumn();
        } catch (\PDOException $ex) {
            $this->showException($ex, $sql);
        }         
    }
    //获取单例
    public static function getInstance($param=array()){
        if(!self::$instance instanceof self)
            self::$instance=new self($param);
        return self::$instance;
    }
}
