<?php
namespace Lib;
class Captcha{
    //生成验证码字符串
    private function generalRandomString(){
        $char_array=array_merge(range('a','z'),range('A','Z'),range(0,9));
        $index_array=array_rand($char_array,4);
        shuffle($index_array);
        $str='';
        foreach($index_array as $i){
            $str.=$char_array[$i];
        }
        $_SESSION['code']=$str; //保存生成的验证码字符串
    }
    //生成验证码
    public function generalCaptcha($w=80,$h=32,$font=5){
        $this->generalRandomString();
        $img=imagecreate($w,$h);    //创建图片资源
        imagecolorallocate($img,255,0,0);	//背景色
        $color=imagecolorallocate($img,255,255,255);	//前景色
        $x=(imagesx($img)-imagefontwidth($font)*strlen($_SESSION['code']))/2;
        $y=(imagesy($img)-imagefontheight($font))/2;
        imagestring($img,$font,$x,$y,  $_SESSION['code'],$color);
        //显示验证码
        header('content-type:image/png');
        imagepng($img);
    }
    //验证输入的验证码是否正确(不区分大小写)
    public function checkCaptcha($code){
        return strtoupper($code)==strtoupper($_SESSION['code']);
    }
}
