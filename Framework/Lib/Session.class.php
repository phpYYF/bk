<?php
namespace Lib;
class Session{
    private $mypdo;
    public function __construct() {
        session_set_save_handler(
                array($this,'open'),
                array($this,'close'),
                array($this,'read'),
                array($this,'write'),
                array($this,'destroy'),
                array($this,'gc')
        );
        session_start();
    }
    public function open(){
        $this->mypdo=  \Core\MyPDO::getInstance($GLOBALS['config']['database']);
        return true;
    }
    public function close(){
        return true;
    }
    public function read($sess_id){
        $sql="select sess_value from sess where sess_id='$sess_id'";
        return (string)$this->mypdo->fetchColumn($sql);
    }
    public function write($sess_id,$sess_value){
        $time=time();
        $sql="insert into sess values ('$sess_id','$sess_value',$time) on duplicate key update sess_value='$sess_value',sess_time=$time";
        return $this->mypdo->exec($sql)!==false;
    }
    public function destroy($sess_id){
        $sql="delete from sess where sess_id='$sess_id'";
        return $this->mypdo->exec($sql)!==false;
    }
    public function gc($lifetime){
        $time=time()-$lifetime;	//垃圾时间的临界点
	$sql="delete from sess where sess_time<$time";
        return $this->mypdo->exec($sql)!==false;
    }
}
