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
</head>


<body>
		
    	<!-- <div  class="customenr_top"> 
        	驻场经理
        </div> -->
        <!--返回上一页-->
	<div class="goback">
		<a href="javascript:history.go(-1);">&nbsp;&nbsp;<&nbsp;&nbsp;</a>
		驻场经理
	</div>
	<p  class="mid_reg"> </p>
	<!--返回上一页-->
        
        <div id="newkh" class="my_client_" style="margin-top:10px;width: 90%;">      
                <div class="my_property_cli" >  	
                    <span class="my_client_name w30">姓名</span>
                    <span class="my_client_phone w40">电话</span> 
                    <span class="my_client_phone w30">客户总数</span>  
                    <!-- <span  class="my_client_name"  style=" width:20%;  ">有效客户</span> -->
                </div> 
                
                <?php if(is_array($zy)): $i = 0; $__LIST__ = $zy;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="my_client_cli">  	
                        <span class="my_client_name w30"><?php echo ($vo["Name"]); ?></span>
                        <span class="my_client_phone w40"><?php echo ($vo["Tel"]); ?></span> 
                        <span  class="my_client_phone w30"><?php echo (($vo["khnum"])?($vo["khnum"]):0); ?>人</span> 
                        <!-- <span  class="my_client_name"  style=" width:20%;  ">
                        <a href="#" class="daofang_a">
                            有效<?php echo (($vo["status"])?($vo["status"]):0); ?>人
                        </a>
                        </span> -->
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                
        </div>

</body>
</html>