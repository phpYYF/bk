<?php
/* Smarty version 3.1.32, created on 2018-05-18 16:22:02
  from 'F:\wamp\www\Application\View\Home\art_article.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5afe8d2a8bf300_46258453',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '47b51f4888e3c978c773eaa9353410b99fe419f2' => 
    array (
      0 => 'F:\\wamp\\www\\Application\\View\\Home\\art_article.html',
      1 => 1526631716,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.html' => 1,
  ),
),false)) {
function content_5afe8d2a8bf300_46258453 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="Content-Language" content="zh-CN" />
	<title>www.myblog.com - 数量测试 - Powered by ITCAST</title>
	<link rel="stylesheet"  href="/public/style/default.css" type="text/css" media="all"/>
	<?php echo '<script'; ?>
 src="/public/script/common.js" type="text/javascript"><?php echo '</script'; ?>
>
</head>
<body class="single article">

<!-- top bar -->
<?php $_smarty_tpl->_subTemplateRender('file:head.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  
<div id="divAll">
	<div id="divPage">
	<div id="divMiddle">
		<div id="divTop">
			<h1 id="BlogTitle"><a href="">www.myblog.com</a></h1>
			<h3 id="BlogSubTitle">Welcome to TQBlog!</h3>
		</div>
		<div id="divNavBar">
			<ul>
				<li id="nvabar-item-index"><a href="">首页</a></li><li id="navbar-page-2"><a href="?id=2">留言本</a></li><li id="navbar-category-2"><a href="?cate=2">旅游</a></li>			</ul>
		</div>

		<div id="divMain">
<div class="post single">
	<h4 class="post-date"><?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['data']->value['art_info']['art_time']);?>
</h4>
	<h2 class="post-title"><?php echo $_smarty_tpl->tpl_vars['data']->value['art_info']['art_title'];?>
</h2>
	<div class="post-body"><?php echo $_smarty_tpl->tpl_vars['data']->value['art_info']['art_content'];?>
</div>
	<h5 class="post-tags"></h5>
	<h6 class="post-footer">
     阅读:<?php echo $_smarty_tpl->tpl_vars['data']->value['art_info']['art_read'];?>
 | <a href="index.php?p=Home&c=Article&a=sayGood&art_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['art_info']['art_id'];?>
&flag=1">赞</a>:<?php echo $_smarty_tpl->tpl_vars['data']->value['art_info']['art_good'];?>
 |<a href="index.php?p=Home&c=Article&a=sayGood&art_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['art_info']['art_id'];?>
&flag=0">踩</a>：<?php echo $_smarty_tpl->tpl_vars['data']->value['art_info']['art_bad'];?>

		 	</h6>
</div>



<label id="AjaxCommentBegin"></label>
<!--评论输出-->
<ul class="msg msghead">
	<li class="tbname">评论列表:</li>
</ul>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['reply_list'], 'rows');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rows']->value) {
?>
<ul id="cmt1" class="msg" style="margin-left:<?php echo $_smarty_tpl->tpl_vars['rows']->value['deep']*40;?>
px">
	<li class="msgname"><img width="32" alt="" src="/Public/uploads/<?php echo $_smarty_tpl->tpl_vars['rows']->value['user_face'];?>
" class="avatar">&nbsp;<span class="commentname"><?php echo $_smarty_tpl->tpl_vars['rows']->value['user_name'];?>
</span><br><small>发布于&nbsp;<?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['rows']->value['reply_time']);?>
&nbsp;&nbsp;<span class="revertcomment"><a  href="index.php?p=Home&c=Article&a=addSubReply&art_id=<?php echo $_smarty_tpl->tpl_vars['rows']->value['art_id'];?>
&reply_id=<?php echo $_smarty_tpl->tpl_vars['rows']->value['reply_id'];?>
">回复</a></span></small></li>
	<li class="msgarticle"><?php echo $_smarty_tpl->tpl_vars['rows']->value['reply_content'];?>
<label id="AjaxComment1"></label> 
		<label id="cmt2"></label>
	</li>
</ul>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<!--评论翻页条输出-->
<div class="pagebar commentpagebar">
</div>
<label id="AjaxCommentEnd"></label>

<!--评论框-->
<div class="post" id="divCommentPost">
	<p class="posttop"><a name="comment"><?php echo isset($_SESSION['user']) ? $_SESSION['user']['user_name'] : '';?>
发表评论:</a><a rel="nofollow" id="cancel-reply" href="#divCommentPost" style="display:none;"><small>取消回复</small></a></p>
	<form id="frmSumbit"  method="post" action="index.php?p=Home&c=Article&a=addReply" >	
		<p><label for="txaArticle">正文(*)</label></p>
		<p><textarea name="txaArticle" id="txaArticle" class="text" cols="50" rows="4" tabindex="6" ></textarea></p>
		<p><input name="sumbit" type="submit" tabindex="7" value="提交" onclick="return VerifyMessage()" class="button" /></p>

		<!--增加数据-->
		<input type="hidden" name="art_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['art_info']['art_id'];?>
">
		
	</form>
	<p class="postbottom">☆欢迎发表您的看法、交流您的观点。</p>
</div>
		</div>
		<div id="divBottom">
        	<h3 id="BlogCopyRight">
                                            	Copyright © 2008-2028 tqtqtq.com All Rights Reserved            </h3>
			<h4 id="BlogPowerBy">Powered by <a href="http://www.tqtqtq.com/" title="TQBlog" target="_blank">TQBlog V2.0 Release 20140101</a></h4>
		</div><div class="clear"></div>
	</div><div class="clear"></div>
	</div><div class="clear"></div>
</div>
</body>
</html><!--86.655ms--><?php }
}
