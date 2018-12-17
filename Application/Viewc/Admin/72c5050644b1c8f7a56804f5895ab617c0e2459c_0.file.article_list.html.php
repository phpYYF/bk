<?php
/* Smarty version 3.1.32, created on 2018-05-16 16:28:48
  from 'F:\wamp\www\Application\View\Admin\article_list.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afbebc00db5d8_91030595',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '72c5050644b1c8f7a56804f5895ab617c0e2459c' => 
    array (
      0 => 'F:\\wamp\\www\\Application\\View\\Admin\\article_list.html',
      1 => 1526459320,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afbebc00db5d8_91030595 (Smarty_Internal_Template $_smarty_tpl) {
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
<form method="post" action="">
<div class="panel admin-panel">
<div class="panel-head"><strong>文章检索</strong>&nbsp;&nbsp;&nbsp;&nbsp;
	类别：
    <select name="cat_id">
    	<option value="">---请选择类别---</option>
    	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['cat_list'], 'rows');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rows']->value) {
?>
        	<option value="<?php echo $_smarty_tpl->tpl_vars['rows']->value['cat_id'];?>
" <?php echo isset($_smarty_tpl->tpl_vars['data']->value['condition']['cat_id']) && $_smarty_tpl->tpl_vars['rows']->value['cat_id'] == $_smarty_tpl->tpl_vars['data']->value['condition']['cat_id'] ? 'selected' : '';?>
><?php echo str_repeat('&nbsp;',$_smarty_tpl->tpl_vars['rows']->value['deep']*4);
echo $_smarty_tpl->tpl_vars['rows']->value['cat_name'];?>
</option>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </select>
    标题：<input type="text" name="art_title" value="<?php echo isset($_smarty_tpl->tpl_vars['data']->value['condition']['art_title']) ? $_smarty_tpl->tpl_vars['data']->value['condition']['art_title'] : '';?>
">
    内容：<input type="text" name="art_content" value="<?php echo isset($_smarty_tpl->tpl_vars['data']->value['condition']['art_content']) ? $_smarty_tpl->tpl_vars['data']->value['condition']['art_content'] : '';?>
">
    是否公开：<select name="art_public">
    	<option value="">不限</option>
        <option value="1" <?php echo isset($_smarty_tpl->tpl_vars['data']->value['condition']['art_public']) && $_smarty_tpl->tpl_vars['data']->value['condition']['art_public'] === '1' ? 'selected' : '';?>
>是</option>
        <option value="0" <?php echo isset($_smarty_tpl->tpl_vars['data']->value['condition']['art_public']) && $_smarty_tpl->tpl_vars['data']->value['condition']['art_public'] === '0' ? 'selected' : '';?>
>否</option></select>
    是否置顶：<select name="art_top">
    	<option value="">不限</option>
        <option value="1" <?php echo isset($_smarty_tpl->tpl_vars['data']->value['condition']['art_top']) && $_smarty_tpl->tpl_vars['data']->value['condition']['art_top'] === '1' ? 'selected' : '';?>
>是</option>
        <option value="0" <?php echo isset($_smarty_tpl->tpl_vars['data']->value['condition']['art_top']) && $_smarty_tpl->tpl_vars['data']->value['condition']['art_top'] === '0' ? 'selected' : '';?>
>否</option></select>
    <input type="submit"  value="搜索">
</div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
window.onload=function(){
	//全选和取消全选
	var flag=false;
	document.getElementById('selectAll').onclick=function(){
		flag=!flag;
		var checkbox_list=document.getElementsByName('id');
		for(var i=0;i<checkbox_list.length;i++){
			checkbox_list[i].checked=flag;
		}	
	}
	//批量删除
	document.getElementById('btn_more').onclick=function(){
		var id_array=[];
		var checkbox_list=document.getElementsByName('id');
		for(var i=0;i<checkbox_list.length;i++){
			if(checkbox_list[i].checked)
				id_array.push(checkbox_list[i].value);
		}	
		ids=id_array.join();	//将id连接成字符串
		if(ids=='')
			return;
		location.href='index.php?p=Admin&c=Article&a=del&art_id='+ids;
	}
}
<?php echo '</script'; ?>
>
</form>
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>内容列表</strong></div>
        <div class="padding border-bottom">
            <input type="button" class="button button-small checkall" id="selectAll" name="checkall" checkfor="id" value="全选" />
            <input type="button" class="button button-small border-green" value="添加文章" onClick="location.href='index.php?p=Admin&c=Article&a=add'"/>
            <input type="button" class="button button-small border-yellow" id="btn_more" value="批量删除" />
            <input type="button" class="button button-small border-blue" value="回收站" />
        </div>
        <table class="table table-hover">
            <tr><th width="45">选择</th><th width="120">分类</th><th width="*">内容</th><th width="200">时间</th>
            <th>是否公开</th><th>是否置顶</th>
            <th width="200">操作</th></tr>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['art_list'], 'rows');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rows']->value) {
?>
<tr>
    <td><input type="checkbox" name="id" value="<?php echo $_smarty_tpl->tpl_vars['rows']->value['art_id'];?>
" /></td>
    <td><?php echo $_smarty_tpl->tpl_vars['rows']->value['cat_name'];?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['rows']->value['art_content'];?>
</td>
    <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rows']->value['art_time'],'%Y-%m-%d %H:%M:%S');?>
</td>
    <td><img src="/Application/View/Admin/images/<?php echo $_smarty_tpl->tpl_vars['rows']->value['art_public'] == 1 ? 'yes' : 'no';?>
.gif"></td>
    <td><img src="/Application/View/Admin/images/<?php echo $_smarty_tpl->tpl_vars['rows']->value['art_top'] == 1 ? 'yes' : 'no';?>
.gif"></td>
    <td>
       <a class="button border-blue button-little" href="index.php?p=Admin&c=Article&a=edit&art_id=<?php echo $_smarty_tpl->tpl_vars['rows']->value['art_id'];?>
">修改</a>
       <a class="button border-yellow button-little" href="index.php?p=Admin&c=Article&a=del&art_id=<?php echo $_smarty_tpl->tpl_vars['rows']->value['art_id'];?>
" onclick="return confirm('确认删除?')">删除</a>
<?php if ($_smarty_tpl->tpl_vars['rows']->value['art_top'] == 0) {?>
<a class="button border-blue button-little" href="index.php?p=Admin&c=Article&a=top&art_id=<?php echo $_smarty_tpl->tpl_vars['rows']->value['art_id'];?>
&art_top=1">置顶</a>
<?php } else { ?>
<a class="button border-blue button-little" href="index.php?p=Admin&c=Article&a=top&art_id=<?php echo $_smarty_tpl->tpl_vars['rows']->value['art_id'];?>
&art_top=0">取消置顶</a>
<?php }?>
         
    </td>
</tr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </table>
        <div class="panel-foot text-center">
            <?php echo $_smarty_tpl->tpl_vars['data']->value['pagestr'];?>

        </div>
    </div>
    <br />
    <p class="text-right text-gray">基于<a class="text-gray" target="_blank" href="#">传智播客</a>构建</p>
</div>
</body>
</html><?php }
}
