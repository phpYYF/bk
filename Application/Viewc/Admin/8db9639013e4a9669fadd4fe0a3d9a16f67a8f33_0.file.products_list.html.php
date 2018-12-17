<?php
/* Smarty version 3.1.32, created on 2018-05-10 18:26:52
  from 'F:\wamp\www\Application\View\Admin\products_list.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5af41e6cea2809_25483703',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8db9639013e4a9669fadd4fe0a3d9a16f67a8f33' => 
    array (
      0 => 'F:\\wamp\\www\\Application\\View\\Admin\\products_list.html',
      1 => 1525948005,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5af41e6cea2809_25483703 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body>
<table width='900' border='1'>
	<tr>
		<th>编号</th> <th>商品名称</th> <th>商品规格</th> <th>价格</th> <th>删除</th>
	</tr>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rs']->value, 'rows');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rows']->value) {
?>
<tr>
	<td><?php echo $_smarty_tpl->tpl_vars['rows']->value['proID'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['rows']->value['proname'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['rows']->value['proguige'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['rows']->value['proprice'];?>
</td>
	<td> <input type="button" value="删除"
  onclick="if(confirm('确定要删除吗'))location.href='index.php?p=Admin&c=Products&a=del&id=<?php echo $_smarty_tpl->tpl_vars['rows']->value['proID'];?>
';"> </td>
</tr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>

</body>
</html>










<?php }
}
