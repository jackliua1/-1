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
</head>

<body>
	<p  class="mid_reg">我的客户</p>
	 
     <div class="mykh_top">
     	<div class="top_newkh">
            <a href="<?php echo U('Zhiye/newcustom',array('token'=>$zy['Token'],'wecha_id'=>$zy['Wecha_id'],'id'=>$vo['ID']));?>">新客户</a>
        </div> 
     	<div class="top_nowkh">
            <a href="<?php echo U('Zhiye/ingcustom',array('token'=>$zy['Token'],'wecha_id'=>$zy['Wecha_id'],'id'=>$vo['ID']));?>">跟进中</a>
        </div> 
     	<div class="top_ovekh_">
            已结束
        </div>
     </div>
        
         <!--新客户-->
  		  <div id="newkh" class="my_client_" style="min-height:200px; width:90%;">   
            <?php if($kh == null): ?><div class="mykh_cli" style="background-color:#fff;"> 
                    暂无完成客户
                </div>
            <?php else: ?> 
                <?php if(is_array($kh)): $i = 0; $__LIST__ = $kh;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="mykh_cli" style="background-color:#fff;">   
                    <span class="my_client_name" style=" width:25%"><?php echo ($vo["Name"]); ?></span>
                    <span class="my_client_phone"  style=" width:35%"><?php echo ($vo["Tel"]); ?></span>  
                    <span  class="my_client_name"  style=" width:20%;  ">
                     <a href="#" class="mykhhk_a"><?php echo ($vo["salesstatus"]); ?></a>
                    </span>

                    <span  class="my_client_name"  style=" width:15%;  ">
                     <a href="tel:<?php echo ($vo["Tel"]); ?>" class="mykhhk_a" style="background:url(<?php echo RES;?>/img/dh.jpg) no-repeat; height:29px; margin-top:8px;"> </a>
                    </span>
                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </div><!--新客户-->
            
            
            <!-- 
            <div class="mykh_lqnew">
            	<div  class="mykh_lqnew_">
                	已被领取客户<span>2</span>人<br>
                    当前新客户<span>0</span>人
                </div>
                
                <div  class="mykh_lqnew_">
                	<a class="mykh_lqxkh">领取新客户</a>
                </div>
            </div> -->
            
            
            
         
            
            
            

</body>
 
</html>