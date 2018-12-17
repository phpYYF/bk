<?php
/* Smarty version 3.1.32, created on 2018-05-16 11:10:41
  from 'F:\wamp\www\Application\View\Admin\article_edit.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afba131638122_14175050',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6f77669de42092f57228ab258e0d5faf62f223fc' => 
    array (
      0 => 'F:\\wamp\\www\\Application\\View\\Admin\\article_edit.html',
      1 => 1526440124,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afba131638122_14175050 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title>拼图后台管理-后台管理</title>
<link rel="stylesheet" href="/Application/View/Admin/css/pintuer.css">
<link rel="stylesheet" href="/Application/View/Admin/css/admin.css">
</head>

<body>
<div class="admin">
  <div class="tab">
    <div class="tab-head"> <strong>文章管理</strong>
      <ul class="tab-nav">
        <li class="active"><a href="#tab-set">添加文章</a></li>
      </ul>
    </div>
    <div class="tab-body"> <br />
      <div class="tab-panel active" id="tab-set">
<form method="post" class="form-x" action="">
  <div class="form-group">
    <div class="label">
      <label for="art_title">文章标题</label>
    </div>
    <div class="field">
      <input type="text" class="input" id="art_title" name="art_title" size="50"  value="<?php echo $_smarty_tpl->tpl_vars['data']->value['art_info']['art_title'];?>
"/>
    </div>
  </div>
  <div class="form-group">
    <div class="label">
      <label for="cat_id">所属分类</label>
    </div>
    <div class="field">
      <select class="input" name="cat_id" style="width:20%" id="cat_id">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['cat_list'], 'rows');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rows']->value) {
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['rows']->value['cat_id'];?>
" <?php echo $_smarty_tpl->tpl_vars['data']->value['art_info']['cat_id'] == $_smarty_tpl->tpl_vars['rows']->value['cat_id'] ? 'selected' : '';?>
><?php echo str_repeat('&nbsp;',$_smarty_tpl->tpl_vars['rows']->value['deep']*4);
echo $_smarty_tpl->tpl_vars['rows']->value['cat_name'];?>
</option>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="label">
      <label for="art_content">文章内容</label>
    </div>
    <div class="field">
      <textarea name="art_content" cols="50" rows="5" class="input" id="art_content" placeholder="内容"><?php echo $_smarty_tpl->tpl_vars['data']->value['art_info']['art_content'];?>
</textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="label">
      <label for="art_top">是否置顶</label>
    </div>
    <div class="field">
      <input type="radio" name="art_top" value="1" checked>是
      <input type="radio" name="art_top" value="0" <?php echo $_smarty_tpl->tpl_vars['data']->value['art_info']['art_top'] == 0 ? 'checked' : '';?>
>否
    </div>
  </div>
  <div class="form-group">
    <div class="label">
      <label for="desc">是否公开</label>
    </div>
    <div class="field">
      <input type="radio" name="art_public" value="1" checked>是
      <input type="radio" name="art_public" value="0" <?php echo $_smarty_tpl->tpl_vars['data']->value['art_info']['art_public'] == 0 ? 'checked' : '';?>
>否
    </div>
  </div>
  <div class="form-group">
    <div class="label">
      <label for="desc">文章标签</label>
    </div>
    <div class="field">
      <input type="text" name="art_label" id="art_label" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['art_info']['art_label'];?>
">标签可以有多个，用逗号隔开
    </div>
  </div>
  
  <div class="form-button">
    <button class="button bg-main" type="submit">提交</button>
  </div>
</form>
      </div>
      <div class="tab-panel" id="tab-email">邮件设置</div>
      <div class="tab-panel" id="tab-upload">上传设置</div>
      <div class="tab-panel" id="tab-visit">访问限制</div>
    </div>
  </div>
  <p class="text-right text-gray">基于<a class="text-gray" target="_blank" href="#">传智播客</a>构建</p>
</div>
</body>
</html><?php }
}
