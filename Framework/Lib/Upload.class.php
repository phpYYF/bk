<?php
namespace Lib;
class Upload{
    private $upload_path;   //文件保存的路径
    private $upload_size;   //文件允许的最大字节数
    private $upload_type;   //允许的类别
    private $error;         //报错错误信息
    public function __construct($path,$size,$type){
        $this->upload_path=$path;
        $this->upload_size=$size;
        $this->upload_type=$type;
    }
    //返回错误信息
    public function getError(){
        return $this->error;
    }
    /*
     * 文件上传
     * @param $files $_FILES[]的对象
     */
    public function upload($files){
	$error=$files['error'];
	if($error!=0){
            switch($error){
                case 1:
                    $this->error='文件大小超过了配置文件大小'.ini_get('upload_max_filesize');
                    return false;
                case 2:
                    $this->error='文件大小超出了表单允许的最大值';
                    return false;
                case 3:
                    $this->error='只有部分上传，没有完全上传';
                    return false;
                case 4:
                    $this->error='没有文件上传';
                    return false;
                case 6:
                    $this->error='找不到临时文件';
                    return false;
                case 7:
                    $this->error='文件写入失败';
                    return false;
                default:
                   $this->error='未知错误';
                    return false;
	    }
	}
	//验证格式
	$finfo=finfo_open(FILEINFO_MIME_TYPE);
	$type=finfo_file($finfo,$files['tmp_name']);
	if(!in_array($type,  $this->upload_type)){
            $this->error='上传文件格式不正确，允许的格式有：'.implode(',',  $this->upload_type);
            return false;
	}
	//验证大小
	if($files['size']>$this->upload_size){
            $this->error='文件不能超过'.number_format($this->upload_size/1024,1).'K';
            return false;
        }
	//验证是否是http的post上传
	if(!is_uploaded_file($files['tmp_name'])){
            $this->error='上传文件非法,必须是http上传';
            return false;
        }
	//文件上传
        $foldername=date('Y-m-d');  //文件夹名称
	$folderpath=  $this->upload_path.$foldername;   //文件夹路径
	if(!is_dir($folderpath))    //创建文件夹
            mkdir($folderpath);
        $filename=uniqid().strrchr($files['name'],'.');    //文件名
	$filepath=$folderpath.'/'.$filename;    //文件路径
	if(move_uploaded_file($files['tmp_name'],$filepath))
                return "{$foldername}/$filename";
        return false;
    }    
}