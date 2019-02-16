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
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<link href="<?php echo RES;?>/css/nestyle.css" rel="stylesheet" type="text/css">
</head>
 
<body  >
    <p  class="mid_reg">您的信息</p>
    <form action="#" method="post">
        <div class="reg_content">
            <input type="text"  value="<?php echo ($zyinfo['Name']); ?>" class="reg_cone" name="Name" id="name">
            <input type="text"  value="<?php echo ($zyinfo['Tel']); ?>" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" name="Tel" id="tel"> 

            <input type="text" value="<?php echo ($zyinfo['LouPanTitle']); ?>" id="lp" onclick="showboxa('lpinfo')" disabled class="but_selectlist"> 

            <input type="hidden" name="Uid" id="Uid" value="<?php echo ($zyinfo['Uid']); ?>">
            <input type="hidden" name="id" value="<?php echo ($zyinfo['ID']); ?>">
            <input type="submit" class="zc_but" value="保存" id="zhuce" onclick="return abc()">
			<input type="button" class="zc_but logout" value="退出" id="logout">
        </div> 
    </form>

    <div id="lpinfo" class="showbox_yxlp" style="display:none;" >
        <div class="showbox_yxlp_" >
            <div class="showbox_yxlp_title">消费需求</div>
            <?php if(is_array($lpinfo)): $i = 0; $__LIST__ = $lpinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="#"   title="<?php echo ($vo["id"]); ?>" ><?php echo ($vo["LouPanTitle"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>        
         </div>
     </div>
     <div class="showbox_yxlp"  id="error_box" style="display:none;" >
        <div class="showbx_error">
        <a href="#" id="error_a"  onclick="closeboxa('error_box')">×</a> 
           <div style="clear:both;" id="errorinfo"> 请正确填写注册内容</div>  
         </div>
    </div>
</body>
<script language="javascript">

    function showboxa(a){
            document.getElementById(a).style.display="";
        }
    function closeboxa(b){ 
            document.getElementById(b).style.display="none";    
        }     

    window.onload=function(){

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

    function abc(){
        var tel=document.getElementById("tel");
        var name=document.getElementById("name");
        var Uid=document.getElementById("Uid");
        //验证姓名
        if(name.value==""||name.value=="请输入您的姓名"){
            $("#errorinfo").html("请输入您的姓名");
            showboxa('error_box');
            return false;
        }
        //电话
        var reg=/^[1][3|5|6|7|8]\d{9}$/;
        if(tel.value==""||!reg.test(tel.value)){
            document.getElementById("errorinfo").innerText="请填写正确的电话号码";
            showboxa("error_box");
            return false;
        }

        //验证楼盘
        if(Uid.value==""){
            $("#errorinfo").html("请选择消费需求");
            showboxa('error_box');
            return false;
        }
    }
</script>
</html>