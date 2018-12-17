<?php
namespace Core;
class Model {
    private $table=null; //表名
    private $pk=null;    //主键
    protected $mypdo;
    public function __construct($table='') {
            $this->initPDO();
            $this->initTableName($table);
            $this->initPrimaryKey();
    }
    //初始化MyPDO
    private function initPDO(){
            $this->mypdo=MyPDO::getInstance($GLOBALS['config']['database']);
    }
    //获取表名
    private function initTableName($table){
        if($table!='')
            $this->table=$table;
        else {
            $class_name=get_class($this);	//获取对象的类名（包括命名空间）
            $class_name=  basename($class_name);    //获取类名（去除命名空间，仅类名）
            $this->table=substr($class_name,0,-5);	//获取表名（表名和模型名同名）
        }
    }
    //封装获取主键的方法
    private function initPrimaryKey() {
	$rs=$this->mypdo->fetchAll("desc `{$this->table}`");
	foreach($rs as $rows){
            if($rows['Key']=='PRI'){
                $this->pk=$rows['Field'];	//返回主键字段名
                return;
            }
	}
    }
    /*
     * 封装万能的insert方法
     * @param array 插入的字段和值的关联数组
     * @param int|false,成功返回自动增长的编号，失败返回false
     */
    public function insert($data){
        $fields=array_keys($data);		//获取所有的键
        $fields=array_map(function($field){     //在所有的字段名上添加反引号
                return "`{$field}`";
        },$fields);
        $fields=implode(',',$fields);   //将数组连接成字符串
        $values=array_values($data);	//获取所有值
        $values=array_map(function($v){ //将所有的值添加引号
            $v=str_replace('<script', '< script', $v);
            $v=  str_replace('</script>', '< /script>', $v);
            return "'{$v}'";
        },$values);
        $values=implode(',',$values);   //将值用逗号连接起来
        $sql="insert into `{$this->table}` ($fields) values ($values)";
        if($this->mypdo->exec($sql))
            return $this->mypdo->getLastInsertId(); //返回自动增长的编号
        return false;
    }
    //封装万能的update语句,返回受影响的记录数
    public function update($data){
        $fields=array_keys($data);	//所有字段
        $pk_index=array_search($this->pk,$fields);	//在$fields数组中查找$pk,返回$pk的下标
        unset($fields[$pk_index]);	//是字段数组中删除主键字段
        $fields=array_map(function($field) use ($data){
                return "`{$field}`='{$data[$field]}'";
        },$fields);
        $fields=implode(',',$fields);//连接成字符串
        $sql="update `{$this->table}` set $fields where `{$this->pk}`='{$data[$this->pk]}'";
        return $this->mypdo->exec($sql);
    }
    //封装万能的delete方法
    public function delete($id){
        $sql="delete from `{$this->table}` where `$this->pk`='$id'";
        return $this->mypdo->exec($sql);
    }
    /*
     * 封装万能的查询select方法，获取所有数据
     * @param $condition array 条件数组
     * @return array 二维数组
     */
    public function select($condition=array()){
        $sql="select * from `{$this->table}` where 1";
        foreach($condition as $k=>$v){
            $v=  addslashes($v);    //添加转义字符
            $sql.=" and `$k`='$v'";
        }
        return $this->mypdo->fetchAll($sql);
    }
    /*
     * 封装万能的find()，获取一条数据
     * @pararm $id int 主键
     * @return array 一维数组
     */
    public function find($id){
        $sql="select * from `{$this->table}` where `{$this->pk}`='$id'";
        return $this->mypdo->fetchRow($sql);
    }
}