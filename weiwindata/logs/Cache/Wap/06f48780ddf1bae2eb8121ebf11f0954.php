<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
<meta content="telephone=no" name="format-detection">
<meta name="keywords" content="首创置业，买房，看房，房地产">
<meta name="description" content="首创置业是中国领先的房地产综合营运商。公司于2003年6月19日在香港联合交易所主板上市，综合实力居国内领先地位，目前已进入全国四大区域十三个城市，土地储备规模超过1000万平方米，有相当高的市场知名度和品牌影响力。">
<title></title>

<link href="<?php echo RES;?>/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo RES;?>/css/defstyel.css?v=<?php echo ($vtime); ?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<!-- <link href="<?php echo RES;?>/css/nestyle.css" rel="stylesheet" type="text/css"> -->
 
<!-- <link href="<?php echo RES;?>/css/yjstyle.css?v=<?php echo ($vtime); ?>" rel="stylesheet" type="text/css"> -->


</head>
 
<body  >
	<!--返回上一页-->
	<div class="goback">
		<a href="javascript:history.go(-1);">&nbsp;&nbsp;<&nbsp;&nbsp;</a>
		个人信息
	</div>
	<p  class="mid_reg"> </p>
	<!--返回上一页-->
         <div id="img_" style="overflow:hidden;">
    <p  class="mid_reg">您的信息</p>
    <form action="#" method="post">
        <div class="reg_content">
            <input type="text"  value="<?php echo ($jjrinfo['Name']); ?>" class="reg_cone" readonly>
            <input type="tel"  placeholder="请输入您的电话" value="<?php echo ($jjrinfo['Tel']); ?>" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" name="Tel" id="tel" readonly> 
			<input type="text" value="" placeholder="请输入您的密码" name="password" id="password"> 
			<span class="tsmsg">*密码不填写默认为不修改</span>
            <input type="submit" class="zc_but" value="保存" id="zhuce" onclick="return save();">
			<input type="button" class="zc_but logout" value="退出" id="logout">
        </div> 
        <input type="hidden" name="id" value="<?php echo ($jjrinfo['ID']); ?>">
    </form>
    
     <div class="showbox_yxlp"  id="error_box" style="display:none;" >
        <div class="showbx_error">
        <a href="#" id="error_a"  onclick="closeboxa('error_box')">×</a> 
           <div style="clear:both;" id="errorinfo"> 请正确填写注册内容</div>  
         </div>
    </div>

     </div>
     
	<style>
a {
    text-decoration: none;
}
ul,p{
	margin:0px;
	padding:0px;
}
.wt_ul1 {
    position: fixed;
    width: 100%;
    height: 60px;
    background-color: #ffffff;
    z-index: 999;
    bottom: 0;
    left: 0;
    border-top: 1px solid #e4e4e4;
}
li {
    list-style: none;
}
.wt_li1_a {
    float: left;
    width: 33%;
    height: 60px;
    text-align: center;
}
.wt_ul1 li {
    position: relative;
}
.nav_active p i, .nav_active p span {
    color: #33ccff;
}
.div_footer{
	margin-bottom:60px;
}
</style>
<div class="div_footer"></div>
<ul class="wt_ul1">
	<?php if(ACTION_NAME == 'ydl'): ?><li class="wt_li1_a nav_active">
	<?php else: ?>
	<li class="wt_li1_a"><?php endif; ?>
        <a href="<?php echo U('Agent/ydl',array('token'=>$token));?>">
            <p style="margin-top: 10px;">
				<i class="fa fa-home fa-2x"></i>
			</p>
			<p class="wt_p2">
				<span>首页</span>
			</p>
        </a>
            
    </li>
    <?php if(ACTION_NAME == 'myCustom'): ?><li class="wt_li1_a nav_active">
	<?php else: ?>
	<li class="wt_li1_a"><?php endif; ?>
        <a href="<?php echo U('Agent/myCustom',array('token'=>$token,'JJ_id'=>$jjrinfo['ID']));?>">
            <p style="margin-top: 10px;">
                <i class="fa fa-sitemap fa-2x"></i>
            </p>
            <p class="wt_p2">
                <span>我的客户</span>
            </p>
        </a>
    </li>
    <?php if(ACTION_NAME == 'myInfo'): ?><li class="wt_li1_a nav_active">
	<?php else: ?>
	<li class="wt_li1_a"><?php endif; ?>
		<a href="<?php echo U('Agent/myInfo',array('token'=>$token));?>">
			<p style="margin-top: 10px;">
				<i class="fa fa-user-o fa-2x"></i>
			</p>
			<p class="wt_p2">
				<span>个人中心</span>
			</p>
		</a> 
    </li>
</ul>
    
</body>
<script language="javascript">
 function duiqi(){
        var wid=document.body.scrollHeight; 
          document.getElementById("img_").style.minHeight=wid+"px"; 
        aa=document.getElementById("ads").offsetHeight; 
        document.getElementById("ads").style.marginTop=-aa+"px"; 
    } 

    function showboxa(a){
            document.getElementById(a).style.display="";
        }
    function closeboxa(b){ 
            document.getElementById(b).style.display="none";    
        }     

    window.onload=function(){
         duiqi();
        var a=document.getElementById("sf").getElementsByTagName("a"); 

            for(var i=0;i<a.length;i++)
            {
                a[i].onclick=function(){
                    closeboxa("sf");
                    document.getElementById("leibie").value=this.innerText;
                    document.getElementById("typeid").value=this.title;
                    if(this.hreflang==0){
                        document.getElementById("companyname").type='hidden';
                        document.getElementById("companyname").value='';
                    }else{
                        document.getElementById("companyname").type='text';
                        document.getElementById("companyname").value='请输入您的公司名称';
                    }
                    
                }
            }
        //tel获取焦点事件
        var tel=document.getElementById("tel");
        tel.onfocus=function(){
            if(tel.value=="请输入您的电话"){
                tel.value="";
            }
        }
        //tel获取焦点事件
        tel.onblur=function(){
            if(tel.value==""){
                tel.value="请输入您的电话";
            }
        }

        //companyname获取焦点事件
        var companyname=document.getElementById("companyname");
        companyname.onfocus=function(){
            if(companyname.value=="请输入您的公司名称"){
                companyname.value="";
            }
        }
        //companyname获取焦点事件
        companyname.onblur=function(){
            if(companyname.value==""){
                companyname.value="请输入您的公司名称";
            }
        }
        var a=document.getElementById("lpinfo").getElementsByTagName("a"); 

            for(var i=0;i<a.length;i++)
            {
                a[i].onclick=function(){
                    closeboxa("lpinfo");
                    document.getElementById("lp").value=this.innerText;
                    document.getElementById("Uid").value=this.title;
                }
            }

    }
	function save(){
		var password = $("#password").val();
		if(!password){
            $("#errorinfo").html("请输入您的修改密码");
            showboxa('error_box');
            return false;
        }
	}
    function abc(){
        var tel=document.getElementById("tel");
        var leibie=document.getElementById("leibie");
        var companyname=document.getElementById("companyname");
        //电话
        var reg=/^[1][3|5|6|7|8]\d{9}$/;
        if(tel.value==""||!reg.test(tel.value)){
            document.getElementById("errorinfo").innerText="请填写正确的电话号码";
            showboxa("error_box");
            return false;
        }
        //验证身份
        if(leibie.value=="请输入您的身份类别"){
            $("#errorinfo").html("请输入您的身份类别");
            showboxa('error_box');
            return false;
        }
        //验证公司
        if(companyname.type=="text"&&companyname.value=="请输入您的公司名称"){
            $("#errorinfo").html("请输入您的公司名称");
            showboxa('error_box');
            return false;
        }
    }
	
	//退出
	$("#logout").on('click',function(){
		location.href="<?php echo U('Agent/register',array('token'=>$token));?>";
	});
</script>
</html>