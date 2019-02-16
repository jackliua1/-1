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
<style>
    .cycle::-ms-expand { display: none; }

</style>
<body  >
    <p  class="mid_reg">客户备案</p>
    <form action="#" method="post">
    <div class="reg_content">

      姓名:  <input type="text"  value="" class="reg_cone" name="Name" id="name"><br>

       电话:  <input type="text"  value="" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" name="Tel" id="tel">

 	<input type="hidden"  name="LouPanTitle"  value="<?php echo ($list["Uid"]); ?>">
        <input type="hidden"  name="zy_id"  value="<?php echo ($list["ID"]); ?>">
        <!--<input type="text" name="usersname" value="请输入您的经纪公司" id="usersname" onclick="showboxa('ds')"   class="but_selectlist">-->
        <!--<input type="hidden" name="companyname" value="请输入您的公司名称" id="companynames">-->
        <!--<input type="hidden" name="typeid" id="typeids" value="">-->
    
        <!--<input type="text" name="" value="请输入您所属项目名称" id="lp" onclick="showboxa('lpinfo')"  class="but_selectlist">-->
        <!--<input type="hidden" name="id" id="Uids" value="<?php echo ($info["id"]); ?>">-->
        <!--<input type="hidden" name="companyname" value="" id="companynames">-->
        <!--<input type="text" name="yqm" value="请输入您的邀请码" id="yqm">-->
        <!--<input type="hidden" name="typeid" id="typeids" value="">-->
        <!--修改成后来改掉的那个-->

        <input type="submit" class="zc_but" value="保存" id="zhuce" onclick="return abc()">
     </div>
     <div id="lpinfo" class="showbox_yxlp" style="display:none;" >
        <div class="showbox_yxlp_" >
            <div class="showbox_yxlp_title">消费需求</div>
            <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="#"   title="<?php echo ($vo["id"]); ?>" ><?php echo ($vo["LouPanTitle"]); ?></a>
                <!--<option  title="<?php echo ($vo["id"]); ?>"><?php echo ($vo["LouPanTitle"]); ?></option>--><?php endforeach; endif; else: echo "" ;endif; ?>
         </div>
         <div id="ds" class="showbox_yxlp" style="display:none;" >
             <div class="showbox_yxlp_" >
                 <div class="showbox_yxlp_title">经纪公司</div>
                 <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="#" title="<?php echo ($vo["id"]); ?>"><?php echo ($vo["LouPanTitle"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
             </div>
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
        document.getElementById("clearbut").onclick=function(){
            if (document.getElementById("clearbut").checked) {
                document.getElementById("zhuce").disabled=false;
                document.getElementById("zhuce").style.background="";
                document.getElementById("zhuce").value="注册";
            }
            else{

                document.getElementById("zhuce").disabled=true;
                document.getElementById("zhuce").style.background="#999";
                document.getElementById("zhuce").value="请同意协议方能注册";

            }
        }

        document.getElementById("zhuce").disabled=false;
        document.getElementById("zhuce").style.background="";
        document.getElementById("zhuce").value="注册";

    }
</script>

</html>