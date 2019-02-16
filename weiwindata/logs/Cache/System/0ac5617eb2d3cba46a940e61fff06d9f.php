<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>您正在登录weiwincms后台管理系统</title>
<style>
html,body{ height:100%; overflow:hidden;}
body{font-size:12px;width:100%;background:#000 url(./tpl/System/common/login/loginbg.jpg) no-repeat center center;}
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,textarea,p,blockquote,th,td{padding:0;margin:0;} 
h1,h2,h3,h4,h5,h6{font-weight:normal;font-size:100%;} 
ol,ul{list-style:none;}
a{text-decoration:none;blr:expression(this.onFocus=this.blur());} 
a:focus{outline:none;} 
img{border:none;}

.con{ width:100%; height:100%; position:relative;}
.way{ position:absolute; left:50%; top:50%;}
.box{ width:416px; height:436px; background:url(./tpl/System/common/login/box.png); position:relative; left:-208px; top:-258px;}
.boxin{ width:400px; height:420px; padding:8px;}
.box h2{ font-size:30px; font-family:"微软雅黑"; width:364px; height:84px; padding:26px 0 0 36px; color:#ccc;}
.error{ width:400px; height:14px; line-height:14px; text-align:center; color:#FF3300; position:absolute; left:8px; top:140px;}
.username,.password{ width:155px; padding:0 10px 0 36px; height:32px; border:none; line-height:32px; color:#fff; float:left; background:url(./tpl/System/common/login/lgbg.png) no-repeat;}
.password{ background:url(./tpl/System/common/login/lgbg.png) left -32px;}
.lgbtn{ width:108px; height:44px; cursor:pointer; border:none; background:url(./tpl/System/common/login/lgbg.png) left -64px;}
.l1,.l2,.l3,.l4{ width:201px; height:32px; position:absolute; left:106px;}
.l1{ top:182px;}
.l2{ top:251px;}
.l3{ left:153px; top:320px;}

.l4{ top:300px; display:none;}
.l4 img{ float:left; margin-top:6px;}
.code{ width:101px; height:32px; border:none; line-height:32px; text-indent:36px; color:#fff; float:left; margin-right:16px; background:url(images/lgbg.png) left -108px;}

.jia{ width:400px; position:relative; display:none;}
.zhuan{ width:400px; height:130px; background:url(./tpl/System/common/login/zhun.gif) no-repeat center center; display:none;}
.avat{ display:none; width:400px; height:180px;}
.avat #photo{ width:240px; height:104px; padding:35px 0 0 139px;}
.avat #photo img{ width:88px; height:88px; cursor:pointer; padding:16px; background:url(./tpl/System/common/login/avatarbg.png) no-repeat;}
.avat h3{ width:400px; text-align:center; font-size:14px; font-family:"微软雅黑"; color:#ccc;}
.bottom{ position:absolute; width:100%; height:110px; bottom:0; background:url(./tpl/System/common/login/footbg.png) no-repeat center top;}
</style>
<!--[if IE 6]><script type="text/javascript" src="../inc/js/EvPng.js"></script>
<script type="text/javascript">
EvPNG.fix('div, ul, img, li, input');
</script>
<script type=text/javascript> EvPNG.fix('#nav li a:hover,#nav li a#currend');</script>
</script>
<![endif]-->
</head>
<body>
<div class="con">
	<div class="way">
		<div class="box pngFix">
			<form name="form1" method="post" action="<?php echo U('Admin/insert');?>" id="form1" class="myform">
            <div class="boxin">
				<h2>Welcome</h2>
				<div class="error"><?php echo $errorMsg;?></div>
				<div class="l1"><input name="username" type="text" id="username" class="username" /></div>
				<div class="zhuan"></div>					
				<div class="avat">
					<div id="photo"></div>
					<h3 id="name"></h3>
				</div>
				<div class="l2">
				  <input name="password" type="password" id="pw" class="password" />
				</div>

				<div class="l3"><input type="submit" name="Button1" value="" id="Button1" class="lgbtn" /></div>
			</div>
			</form>
		</div>
	</div>
</div>
<div class="bottom pngFix">
	<div class="footer"></div>
</div>
</body>
</html>