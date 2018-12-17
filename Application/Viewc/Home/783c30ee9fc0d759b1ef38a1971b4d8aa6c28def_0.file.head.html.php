<?php
/* Smarty version 3.1.32, created on 2018-05-18 11:27:29
  from 'F:\wamp\www\Application\View\Home\head.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afe4821f05727_32105668',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '783c30ee9fc0d759b1ef38a1971b4d8aa6c28def' => 
    array (
      0 => 'F:\\wamp\\www\\Application\\View\\Home\\head.html',
      1 => 1526613991,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afe4821f05727_32105668 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="top">
	<div class="center">
    <div class="menu-left">
    <ul>
     <li><a href="javascript:;" onclick="setHomepage('http://www.myblog.com');">设为首页</a></li>
     <li><a href="javascript:;" onclick="addFavorite('http://www.myblog.com','www.myblog.com - Welcome to 我的博客')">收藏本站</a></li>      
    </ul>
    </div>
    <div class="menu-right">
	    <ul id="info">
<?php if (isset($_SESSION['user'])) {?>
        <li>欢迎 <?php echo $_SESSION['user']['user_name'];?>
(管理员)！</li>
        <li><a href="index.php?p=Admin&c=Admin&a=admin">管理</a></li>
        <li><a href="index.php?p=Admin&c=Login&a=logout">安全退出</a></li>  
<?php } else { ?>
	<li><a href="index.php?p=Admin&c=Login&a=login">登录</a></li>
<?php }?> 
    </ul>
 

	    </div>
   </div>	
</div><?php }
}
