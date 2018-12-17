<?php
//配置文件
return array(
    'database'=>array(
            'dbname'    =>  'php15',
            'user'      =>  'root',
            'pwd'       =>  'root'
    ),
    'app'   =>  array(
        'pagesize'  =>  2,
        'debug'     =>  true,   //开发模式
        'upload_path'   =>  './Public/uploads/',
        'upload_size'   =>  '1234567',
        'upload_type'   =>  array('image/jpeg','image/png','image/gif'),
        'default_platform'  =>  'Home',
        'default_controller'=>  'Index',
        'default_action'    =>  'index'
    )
);









