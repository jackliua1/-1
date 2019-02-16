<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
<meta content="telephone=no" name="format-detection">
<meta name="keywords" content="首创置业，买房，看房，房地产">
<meta name="description" content="首创置业是中国领先的房地产综合营运商。公司于2003年6月19日在香港联合交易所主板上市，综合实力居国内领先地位，目前已进入全国四大区域十三个城市，土地储备规模超过1000万平方米，有相当高的市场知名度和品牌影响力。">
<title></title>

<link href="<?php echo RES;?>/css/defstyel.css" rel="stylesheet" type="text/css">
<link href="<?php echo RES;?>/css/nestyle.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/agent/register.js"></script>
</head>

<body  >
	<p  class="mid_reg">片区经理登录</p>
    <form action="#" method="post">
        <div class="reg_content">
            <input type="text" name="Tel" placeholder="请输入您的电话" id="tel">
			<input type="password" name="password" placeholder="请输入您的密码" id="password">		 
			<p  class="agreement" style="width:90%; height:40px; text-align:left;">提示</p>       
			<p class="agreement_content" style="width:90%; text-align:left; ">为方便管理，请您填写真实用户信息！</p>
			<input type="submit" class="zc_but" value="登录" id="zhuce" onclick="return abc()">
     </div>
    <div class="showbox_yxlp"  id="error_box" style="display:none;" >
        <div class="showbx_error">
        <a href="#" id="error_a"  onclick="closeboxa('error_box')">×</a> 
           <div style="clear:both;" id="errorinfo"> 请正确填写注册内容</div>  
        </div>
    </div> 
    </form>
    
</body>

<script language="javascript">

    function showboxa(a){
            document.getElementById(a).style.display="";
        }
    function closeboxa(b){
            document.getElementById(b).style.display="none";
        }

	function abc(){
        
        var tel=document.getElementById("tel");
        var password=document.getElementById("password");
        //手机号
        var reg=/^[1][3|5|6|7|8]\d{9}$/;
        if(tel.value==""||!reg.test(tel.value)){
            document.getElementById("errorinfo").innerText="请填写正确的电话号码";
            showboxa("error_box");
            return false;
        }
        //密码
        if(password.value==""){
            document.getElementById("errorinfo").innerText="请输入密码";
            showboxa("error_box");
            return false;
        }
        
    }
</script>
</html>