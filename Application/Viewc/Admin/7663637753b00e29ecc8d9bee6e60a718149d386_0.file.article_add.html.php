<?php
/* Smarty version 3.1.32, created on 2018-05-18 09:59:54
  from 'F:\wamp\www\Application\View\Admin\article_add.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afe339a85bd90_62904568',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7663637753b00e29ecc8d9bee6e60a718149d386' => 
    array (
      0 => 'F:\\wamp\\www\\Application\\View\\Admin\\article_add.html',
      1 => 1526608078,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afe339a85bd90_62904568 (Smarty_Internal_Template $_smarty_tpl) {
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

    <link href="/Public/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <?php echo '<script'; ?>
 type="text/javascript" src="/Public/umeditor/third-party/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" charset="utf-8" src="/Public/umeditor/umeditor.config.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" charset="utf-8" src="/Public/umeditor/umeditor.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="/Public/umeditor/lang/zh-cn/zh-cn.js"><?php echo '</script'; ?>
>

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
              <input type="text" class="input" id="art_title" name="art_title" size="50" placeholder="请填写你文章标题的名称"/>
            </div>
          </div>
          <div class="form-group">
            <div class="label">
              <label for="cat_id">所属分类</label>
            </div>
            <div class="field">
              <select class="input" name="cat_id" style="width:20%" id="cat_id">
              	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cat_list']->value, 'rows');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rows']->value) {
?>
                	<option value="<?php echo $_smarty_tpl->tpl_vars['rows']->value['cat_id'];?>
"><?php echo str_repeat('&nbsp;',$_smarty_tpl->tpl_vars['rows']->value['deep']*4);
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
              <textarea name="art_content" cols="50" rows="5" class="input" id="art_content" placeholder="内容"></textarea>
              <?php echo '<script'; ?>
 type="text/javascript">
              UM.getEditor('art_content');	//调用文本编辑器，将文本框和文本编辑器绑定一起
              <?php echo '</script'; ?>
>
            </div>
          </div>
          <div class="form-group">
            <div class="label">
              <label for="art_top">是否置顶</label>
            </div>
            <div class="field">
              <input type="radio" name="art_top" value="1">是
              <input type="radio" name="art_top" value="0" checked>否
            </div>
          </div>
          <div class="form-group">
            <div class="label">
              <label for="desc">是否公开</label>
            </div>
            <div class="field">
              <input type="radio" name="art_public" value="1" checked>是
              <input type="radio" name="art_public" value="0">否
            </div>
          </div>
          <div class="form-group">
            <div class="label">
              <label for="desc">文章标签</label>
            </div>
            <div class="field">
              <input type="text" name="art_label" id="art_label">标签可以有多个，用逗号隔开
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
