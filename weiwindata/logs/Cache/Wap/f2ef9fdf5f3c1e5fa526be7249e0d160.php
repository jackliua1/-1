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
	<div class=" personal_hearder">
        <a href="<?php echo U('SaleManager/acInfo',array('token'=>$token));?>">
        	<div class="personal_portrait  touxianga">
                <!-- <img src="<?php echo RES;?>/images/ceo.jpg" height="100%"> -->
            </div>
        </a>
        <div  class="personal_petname"><?php echo ($ac["Name"]); ?></div> 
        <div class="personal_message">
        	<div class="personal_client">
            	新客户
                <span class="personal_client_" style="background-image:url(<?php echo RES;?>/img/yige_KhIcon.jpg)"><?php echo ($newkh); ?></span>
            </div>
        	<div  class="personal_client" style="border:none;">
            	客户总数
                <span class="personal_brokerage" style=" background:url(<?php echo RES;?>/img/person_KhIcon.jpg) no-repeat;"><?php echo ($countkh); ?></span>
            </div>
        </div>
    </div>
    
    
     <nav>    	
        <a href="<?php echo U('SaleManager/custom',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" class="navbut">
            <img src="<?php echo RES;?>/img/nav_Cust.jpg"  >
        </a>
        <a href="<?php echo U('SaleManager/zhiye',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" class="navbut">
            <img src="<?php echo RES;?>/img/nav_Coun.jpg"  >
        </a> 
       <!--  <a href="<?php echo U('SaleManager/commission',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" class="navbut">
            <img src="<?php echo RES;?>/img/nav_COM.jpg" style="border-radius:5px" >
        </a>  -->
        
         
    </nav>
     

</body>
 
</html>