<?php
/* Smarty version 3.1.32, created on 2018-05-18 15:47:13
  from 'F:\wamp\www\Application\View\Home\addSubReply.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afe85011506f4_44594027',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '07c0d743179385793c6483921489feb59543dbea' => 
    array (
      0 => 'F:\\wamp\\www\\Application\\View\\Home\\addSubReply.html',
      1 => 1526629625,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afe85011506f4_44594027 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <textarea name="reply" id="reply" cols="45" rows="5"></textarea>
  <br />
  <input type="submit" name="button" id="button" value="提交" />
  <input type="button" name="button2" id="button2" value="返回" onclick="location.href='index.php?p=Home&c=Article&a=article&art_id=<?php echo $_GET['art_id'];?>
'" />
</form>
</body>
</html>
<?php }
}
