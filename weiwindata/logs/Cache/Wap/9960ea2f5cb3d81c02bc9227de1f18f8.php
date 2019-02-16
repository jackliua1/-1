<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta content="telephone=no" name="format-detection">
<meta name="keywords" content="客带客，买房，看房，房地产">
<meta name="description" content="客带客是中国领先的房地产综合营运商。公司于2003年6月19日在香港联合交易所主板上市，综合实力居国内领先地位，目前已进入全国四大区域十三个城市，土地储备规模超过1000万平方米，有相当高的市场知名度和品牌影响力。">
<title>客户推荐</title>
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<link href="<?php echo RES;?>/css/nestyle.css" rel="stylesheet" type="text/css">

<!-- <script type="text/javascript" src="<?php echo RES;?>/js/agent/addCustom.js?t=1234"></script> -->
<link href="<?php echo RES;?>/css/defstyel.css" rel="stylesheet" type="text/css">

 <link rel="stylesheet" type="text/css" href="/tpl/static/dl/css/chosen.min.css"/>
 <script src="/tpl/static/dl/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
 <script src="/tpl/static/dl/js/chosen.jquery.min.js" type="text/javascript" charset="utf-8"></script>
 <style>
	.chzn-container{
		margin-bottom: 10px;
	}
	.chzn-container-single .chzn-single{
		height: 35px;
	}
	.chzn-container-single .chzn-single span,.chzn-container-active .chzn-single,.chzn-container-single .chzn-default{
		height: 35px;
		line-height: 35px;
		text-align: left;
	}
	.chzn-container .chzn-results{
		text-align: left;
	}
 </style>
</head>

<body  >
	<!--返回上一页-->
	<div class="goback">
		<a href="javascript:history.go(-1);">&nbsp;&nbsp;<&nbsp;&nbsp;</a>
		客户推荐
	</div>
	<p  class="mid_reg"> </p>
	<!--返回上一页-->
    <form action="<?php echo U('Agent/addCustomHandle',array('token'=>$jjrarr['Token'],'wecha_id'=>$jjrarr['Wecha_id']));?>" method="post">
        <div class="reg_content">
			<select name="lpid" data-placeholder="选择项目名称" id="lpid" class="chosen-select">
				<option value=""></option>
				<?php if(is_array($lpinfo)): $i = 0; $__LIST__ = $lpinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['id'] == $_GET['lpid']): ?>selected<?php endif; ?>><?php echo ($vo["LouPanTitle"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
            <input type="text"  value="客户姓名" class="reg_cone" name="name" id="name">
            <input type="text"  value="手机号码" name="tel" id="tel">
            <?php if($lpid == 0): ?><!-- <input type="text" value="项目名称" name="LouPanName" id="lp" onfocus="showboxa('lpinfo')"  class="but_selectlist">
                <input type="hidden" name="type" value="1"> -->
            <?php else: ?>
               <!--  <input type="text" class="but_lp" value="<?php echo ($lpinfo[0]['LouPanTitle']); ?>" name="LouPanName" readonly> --><?php endif; ?>
            <!-- <input type="hidden" name="LouPanTitle" id="lpid" value="<?php echo ($lpid); ?>"> -->
            <input type="hidden" name="JJ_id" value="<?php echo ($jjrarr["ID"]); ?>">
            <p  class="agreement" style="width:90%; height:40px;">提示</p>
            <p class="agreement_content" style="width:90%; text-align:left; ">请务必提交真实的客户信息，若多次提交虚假信息，您的帐号会被禁用！</p>

            <input type="submit" id="zhuce" class="zc_but" onclick="return abc()" value="提交">
        </div>
    </form>
    <div id="lpinfo" class="showbox_yxlp" style="display:none;" >
        <div class="showbox_yxlp_" >

        <div class="showbox_yxlp_title">项目名称</div>
            <?php if(is_array($lpinfo)): $i = 0; $__LIST__ = $lpinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="#"   title="<?php echo ($vo["id"]); ?>" ><?php echo ($vo["LouPanTitle"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>

     <div class="showbox_yxlp" style="display:none;" id="error_box">

     	<div class="showbx_error">

     	<a href="#"  id="error_a"  onclick="closeboxa('error_box')">×</a>

           <div style="clear:both;" id="errorinfo">客户已经存在！</div>

          <input type="button"  class="error_but" value="请重新推荐！">

         </div>
     </div>

</body>
<script language="javascript">
	$('.chosen-select').chosen({search_contains: true,width:"90%"});
    function showboxa(a){

            document.getElementById(a).style.display="";
        }
    function closeboxa(b){
            document.getElementById(b).style.display="none";
        }
    var token="<?php echo ($jjrarr["Token"]); ?>";
    window.onload=function(){
       // var a=document.getElementById("lpinfo").getElementsByTagName("a");

        //    for(var i=0;i<a.length;i++)
        //    {
        //        a[i].onclick=function(){
       //             closeboxa("lpinfo");
        //            document.getElementById("lp").value=this.innerText;
        //            document.getElementById("lpid").value=this.title;
        //        }
        //    }

        var name=document.getElementById("name");
        var tel=document.getElementById("tel");
        name.onfocus=function(){
            if(name.value=="客户姓名"){
                name.value="";
            }
        }
        name.onblur=function(){
            if(name.value==""){
                name.value="客户姓名";
            }
        }
        tel.onfocus=function(){
            if(tel.value=="手机号码"){
                tel.value="";
            }
        }
        tel.onblur=function(){
            if(tel.value==""){
                tel.value="手机号码";
            }
        }

    }
function abc(){
    var x=0;
    var name=document.getElementById("name");
    var tel=document.getElementById("tel");
    var lp=document.getElementById("lp");
	var lpid=document.getElementById("lpid");
    var telval=tel.value;
    document.getElementById("error_a").onclick=function(){ document.getElementById("error_box").style.display="none"};
    //验证姓名
    if(name.value==""||name.value=="客户姓名"){
        $("#errorinfo").html("请输入客户姓名");
        showboxa('error_box');
        return false;
    }

    //验证手机
    var telreg= /^[1-9][3|5|6|7|8]\d{9}$/;
    if(tel.value==""||tel.value=="手机号码"||!telreg.test(tel.value)){
        $("#errorinfo").html("请输入手机号码");
        showboxa('error_box');
        return false;
    }else{
       // $.ajax({
       //     type:'post',
       //     url:"<?php echo U('Agent/khyz',array('token'=>$jjrarr['Token'],'wecha_id'=>$jjrarr['Wecha_id']));?>",
        //    dataType:"json",
        //    data:{"token":token,'tel':telval},
        //    success: function(datas){
        //                if(datas==1){
        //                    $("#errorinfo").html("客户已经存在！");
        //                    showboxa('error_box');
        //                    return false;
        //                }else{
        //                    return true;
        //                }
        //              }
       // });
    }
    //验证身份
	if(lpid.value==""){
        $("#errorinfo").html("请输入项目名称");
        showboxa('error_box');
        return false;
    }
    //if(lp.value==""||lp.value=="项目名称"){
    //    $("#errorinfo").html("请输入项目名称");
    //    showboxa('error_box');
    //    return false;
   // }
}
</script>
</html>