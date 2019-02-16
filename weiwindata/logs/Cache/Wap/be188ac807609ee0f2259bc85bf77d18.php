<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
<meta content="telephone=no" name="format-detection">
<meta name="keywords" content="首创置业，买房，看房，房地产">
<meta name="description" content="首创置业是中国领先的房地产综合营运商。公司于2003年6月19日在香港联合交易所主板上市，综合实力居国内领先地位，目前已进入全国四大区域十三个城市，土地储备规模超过1000万平方米，有相当高的市场知名度和品牌影响力。">
<title></title>

<link href="<?php echo RES;?>/css/defstyel.css?v=1.1" rel="stylesheet" type="text/css">
<link href="<?php echo RES;?>/css/nestyle.css" rel="stylesheet" type="text/css">
<style>

</style>
</head>
<body>
	<!-- <a href="<?php echo U('Zhiye/zyinfo',array('token'=>$info['Token']));?>"  class="yhgl_sz"></a> -->
    
    <a href="<?php echo U('Zhiye/zyinfo',array('token'=>$info['Token']));?>">
	<div class="khgl_tx">	
    	<img src="<?php echo RES;?>/img/tx_.jpg" >
    </div>
	</a>
    
    <p class="khgl_name"> <?php echo ($info["Name"]); ?> </p>
    
    <div style="width:200px; margin:auto;">
    	<div class="khgl_dh"><?php echo ($info["Tel"]); ?></div>
        <div class="khgl_dl">
		<?php if($lpinfo): if(is_array($lpinfo)): $i = 0; $__LIST__ = $lpinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span><?php echo ($vo["LouPanTitle"]); ?></span><?php endforeach; endif; else: echo "" ;endif; endif; ?>
		</div>
    </div>
    

    <a href="<?php echo U('Zhiye/newcustom',array('token'=>$info['Token']));?>"  class="khgl_min"></a>
    <a href="<?php echo U('Zhiye/addcustom',array('token'=>$info['Token']));?>" class="khgl_mins"></a>

</body>
</html>