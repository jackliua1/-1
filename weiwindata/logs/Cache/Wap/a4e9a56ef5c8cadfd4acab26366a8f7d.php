<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
<meta content="telephone=no" name="format-detection">
<meta name="keywords" content="首创置业，买房，看房，房地产">
<meta name="description" content="首创置业是中国领先的房地产综合营运商。公司于2003年6月19日在香港联合交易所主板上市，综合实力居国内领先地位，目前已进入全国四大区域十三个城市，土地储备规模超过1000万平方米，有相当高的市场知名度和品牌影响力。">
<title></title>

<link href="<?php echo RES;?>/css/defstyel.css?v=<?php echo ($vtime); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo RES;?>/css/nestyle.css?v=<?php echo ($vtime); ?>" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/agent/register.js?v=<?php echo ($vtime); ?>"></script>
</head>

<body  >
	<p  class="mid_reg">经纪人登录</p>
    <form action="#" method="post">
        <div class="reg_content">
            <!-- <input type="text" name="Name" value="请输入您的姓名" class="reg_cone" id="name"> -->
            <input type="text" name="Tel" placeholder="请输入您的电话" id="tel">
			<input type="password" name="password" placeholder="请输入您的密码" id="password">
            <!--<input type="text" name="leibie" value="请输入您的身份类别" id="leibie" onclick="showboxa('sf')"   class="but_selectlist">-->
             <!--<input type="text" name="yqm" placeholder="请输入您的邀请码" id="yqm"> -->
            <!--<input type="hidden" name="companyname" value="请输入您的公司名称" id="companyname">-->

            <input type="text" name="usersname" value="请输入您的经纪公司" id="usersname" onclick="showboxa('ds')"  style="display:none;"  class="but_selectlist">
            <input type="hidden" name="companyname" value="请输入您的公司名称" id="companynames">
            <input type="hidden" name="typeid" id="typeid" value="">
            <input type="hidden" name="typeid" id="typeids" value="">
            <input type="hidden" name="wecha_id" value="<?php echo ($wecha_id); ?>">
            <input type="hidden" name="token" value="<?php echo ($token); ?>">
            <div class="agreement_box_" style="display:none;"> 
                <p  class="agreement">规则协议</p>     
                <div style=" height:90px;width:100%;margin:auto;overflow:auto;text-align:left;">    <p class="agreement_content"><?php echo ($TiaoKuan); ?></p>
                </div>
            </div>  
            <div id="sf" class="showbox_yxlp" style="display:none;" >
                <div class="showbox_yxlp_" >
                    <div class="showbox_yxlp_title">身份类型</div>
                    <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="#" title="<?php echo ($vo["id"]); ?>" hreflang="<?php echo ($vo["iscompany"]); ?>"><?php echo ($vo["typename"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
             </div>
            <div id="ds" class="showbox_yxlp" style="display:none;" >
                <div class="showbox_yxlp_" >
                    <div class="showbox_yxlp_title">经纪公司</div>
                    <?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="#" title="<?php echo ($vo["id"]); ?>"><?php echo ($vo["usersname"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
            <div class="clearbox" style="display:none;"> <input id="clearbut" name="tk" type="checkbox" value="" class="clearbut" checked><label for="clearbut">我同意以上协议</label></div>
             
                <p  class="agreement" style="width:90%; height:40px; text-align:left;">提示</p>       
                <p class="agreement_content" style="width:90%; text-align:left; ">为方便管理，请您使用手机号进行登录！</p>
            <input type="submit" id="zhuce" class="zc_but" onclick="return abc()" value="登录">
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

    window.onload=function(){
        var a=document.getElementById("ds").getElementsByTagName("a");

            for(var i=0;i<a.length;i++)
            {
                a[i].onclick=function(){
                    closeboxa("ds");
                    document.getElementById("usersname").value=this.innerText;
                    document.getElementById("typeids").value=this.title;
                    if(this.hreflang==0){
                        document.getElementById("companynames").type='hidden';
                    }else{
                        document.getElementById("companynames").type='text';
                    }
                }
            }
//        window.onload=function(){
//            var c=document.getElementById("ds").getElementsByTagName("c");

//            for(var i=0;i<a.length;i++)
//            {
//                c[i].onclick=function(){
//                    closeboxa("ds");
////                    document.getElementById("usersname").value=this.innerText;
////                    document.getElementById("typeids").value=this.title;
////                    if(this.hreflang==0){
////                        document.getElementById("companyname").type='hidden';
////                    }else{
////                        document.getElementById("companyname").type='text';
////                    }
//                }
//            }
        //document.getElementById("clearbut").onclick=function(){
        //    if (document.getElementById("clearbut").checked) {
        //        document.getElementById("zhuce").disabled=false;
        //        document.getElementById("zhuce").style.background="";
        //        document.getElementById("zhuce").value="登录";
        //    }
        //    else{ 
//
        //    document.getElementById("zhuce").disabled=true;
        //    document.getElementById("zhuce").style.background="#999";
        //    document.getElementById("zhuce").value="请同意协议方能注册";

        //    }
        //}

        document.getElementById("zhuce").disabled=false;
        document.getElementById("zhuce").style.background="";
        document.getElementById("zhuce").value="登录";

    }
</script>
</html>