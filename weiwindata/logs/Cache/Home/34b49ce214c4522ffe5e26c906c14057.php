<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0034)http://weixin.magicenglish.com.cn/ -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="shortcut icon" href="./tpl/static/logo.jpg">

<title>登陆与注册－微领先公共帐号营销平台</title>
<meta name="keywords" content="首创置业">
<meta name="description" content="首创置业">

</head><body><div class="banner gbanner"></div>
<div class="main">
<style>

.contaier{ zoom: 1; }
.contaier:after{ content : '.'; display: block; width: 0; height: 0; visibility: hidden; line-height: 0; font-size: 0; clear: both; }
/*基础*/
body{ font-size:16px; font-family: Century Gothic, \5FAE\8F6F\96C5\9ED1,\5E7C\5706, Arial, Verdana; color: #323232; }
select,input,textarea{ outline: none; font-family: Century Gothic, \5FAE\8F6F\96C5\9ED1,\5E7C\5706, Arial, Verdana; font-size: 16px;color:#323232 }
textarea{ resize: none; overflow: auto;}
a{ text-decoration: none; color: #007DDB; }
a:hover{ text-decoration: underline; }
/*布局*/
.header{ width: 100%; height: 54px; background-color: #323232; line-height: 54px; color: #fff; position: fixed!important; position: absolute; top: 0; left: 0; z-index: 5;border-bottom:1px solid silver }
.wp{ max-width: 980px!important; width: auto!important; width: 980px; padding: 0 12px; margin: 0 auto; position:relative;}
.contaier{ padding-bottom: 50px; padding-top: 200px; background: #fff; height: auto!important; min-height: 500px; height: 500px; }

.header{ width: 100%; height: 54px; background-color: #323232; line-height: 54px; color: #fff; position: fixed!important; position: absolute; top: 0; left: 0; z-index: 5;border-bottom:1px solid silver }
.think-login,.think-register{ padding-right: 60px; }
.think-login,.think-register,.login-other{ margin-top: 36px; min-width: 320px; }
.think-login .head,.think-register .head,.login-other .head{ height: 36px; line-height: 36px; }
.think-login .head strong,.think-register .head strong{ font-weight: normal; font-size: 30px; vertical-align: bottom; }
.think-login .head span,.think-register .head span{ margin-left: 24px; color: #999; }
.think-login .head a,.think-register .head a{ color: #007DDB; margin-left: 6px; text-decoration: underline; }
.think-login .body,.think-register .body{ padding-top: 12px; }
.think-login,.think-register{ float: left; }
.think-form{ padding-bottom: 36px; }
.think-form .must{ font-style: normal; color: #c00; margin-right: 3px; }
.think-form th,.think-form td{ padding: 6px 0; }
.think-form th{ font-weight: normal; vertical-align: top; line-height: 32px; padding-right: 9px; text-align: left; }
.think-form .text{ height: 24px; width: 350px; line-height: 24px; padding: 3px; border: 1px solid #ccc; }
.think-form .text:focus{ box-shadow: 0 0 5px rgba(52,143,212,.6); border-color: #348FD4; }
.think-form .checkbox{ margin-right: 6px; }
.think-form .submit{ background: #348FD4; color: #fff; font-size: 16px; height: 30px; line-height: 21px; padding: 0 24px; vertical-align: middle; border: 0; cursor: pointer; }
.think-form .submit:hover{ background-color: #2F81BF; }
.think-form select{ height: 32px; padding: 3px; border: 1px solid #ccc; }
.think-form .login .text { height: 24px; width: 250px; line-height: 24px; padding: 3px; border: 1px solid #ccc; }
.think-form .login .verify { height: 24px; width: 150px; line-height: 24px; padding: 3px; border: 1px solid #ccc; }
.login-other{ float: left; padding-left: 60px; margin-left: -1px; display: inline; border-left: 1px solid #ddd; }
.login-other .head strong{ font-weight: normal; color: #999; }
</style>

        <div class="contaier wp cf">

    <div class="think-login">
        <div class="head">
            <strong>用户登录</strong>
        </div>
        <div class="body think-form ">
            <form action="<?php echo U('Users/checklogin');?>" method="post" class="login">
                <table>
                    <tbody><tr>
                        <th>用户名</th>
                        <td>
                            <input class="text" type="text" name="username">
                        </td>
                    </tr>
                    <tr>
                        <th>密　码</th>
                        <td>
                            <input class="text" type="password" name="password">
                        </td>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <td>
                            <input class="submit" type="submit" value="登录">
                        </td>
                    </tr>
					<tr>
                        <th>&nbsp;</th>
                        <td>
                            &nbsp;
                        </td>
                    </tr><tr>
                        <th>&nbsp;</th>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
					   <tr>
                        <th>技术支持：</th>
                        <td>
                            QQ:416471361
                        </td>
                    </tr>
                </tbody></table></form>
        </div>
    </div>
	<div class="login-other">
        <img src="<?php echo RES;?>/images/shouye.png" width="400px">
        
    </div>


</div>
    </div>
<script type="text/javascript">try{Dd('webpage_6').className='left_menu_on';}catch(e){}</script>
<script type="text/javascript">
function onpost() {
    var pw = max.$("password");
    var idname = max.$("idname");
    if(idname.value == "") {
        alert("请输入用户名");
        return false;
    }
    if (pw.value == "" ){
        alert("请输入密码");
        return false;
    }   
    return true;
}
</script> 
</body></html>