<?php
/* Smarty version 3.1.32, created on 2018-05-15 10:35:58
  from 'F:\wamp\www\Application\View\Admin\user_list.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afa478e525ed9_16794204',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '00d4c44149e2f0f67019a42b1ac88512d7674a40' => 
    array (
      0 => 'F:\\wamp\\www\\Application\\View\\Admin\\user_list.html',
      1 => 1526351513,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afa478e525ed9_16794204 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'F:\\wamp\\www\\Framework\\Core\\Smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>拼图后台管理-后台管理</title>
    <link rel="stylesheet" href="/Application/View/Admin/css/pintuer.css">
    <link rel="stylesheet" href="/Application/View/Admin/css/admin.css">
</head>

<body>
<div class="admin">
	<form method="post">
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>用户信息</strong></div>
    	<table class="table table-hover">
        	<tr>
        	  <th width="45">编号</th>
        	  <th width="*">姓名</th>
        	  <th width="*">登陆次数</th>
        	  <th width="*">最后登陆时间</th>
        	  <th width="*">最后登陆IP</th><th width="100">操作</th></tr>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'rows');
$_smarty_tpl->tpl_vars['rows']->iteration = 0;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rows']->value) {
$_smarty_tpl->tpl_vars['rows']->iteration++;
$__foreach_rows_0_saved = $_smarty_tpl->tpl_vars['rows'];
?>
    <tr>
    <td><?php echo $_smarty_tpl->tpl_vars['rows']->iteration;?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['rows']->value['user_name'];?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['rows']->value['login_count'];?>
</td>
    <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rows']->value['last_login_time'],'%Y-%m-%d %H:%M:%S');?>
</td>
    <td><?php echo long2ip($_smarty_tpl->tpl_vars['rows']->value['last_login_ip']);?>
</td>
    <td><a class="button border-yellow button-little" href="index.php?p=Admin&c=User&a=del&user_id=<?php echo $_smarty_tpl->tpl_vars['rows']->value['user_id'];?>
" onclick="return confirm('确认删除?')">删除</a></td></tr>
<?php
$_smarty_tpl->tpl_vars['rows'] = $__foreach_rows_0_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </table>
    </div>
    </form>
    <br />
    <p class="text-right text-gray">基于<a class="text-gray" target="_blank" href="#">传智播客</a>构建</p>
</div>
</body>
</html>






















<?php }
}
