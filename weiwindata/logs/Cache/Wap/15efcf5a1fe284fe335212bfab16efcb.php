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

		<!-- <p class="my_reward_top">我的积分:<?php echo ($allcredit); ?>积分</p> -->
    <p  class="mid_reg" style="font-size:20px; line-height:40px; color:#333; margin-top:20px;">我的积分</p>
    <div style="width:85%; margin:auto;text-align:right;">
        <!-- <div class="my_brokerage_top" style="width:50%;">
            总积分:<?php echo (($allcredit)?($allcredit):0); ?>积分
        </div> -->
        <!-- <div class="my_brokerage_top" style="width:49%;margin-right:0%; text-align:right;"> -->
            可用积分:<?php echo (($list[0]['credit'])?($list[0]['credit']):0); ?>积分
        <!-- </div><br clear="all">  -->
    </div>
     
        <?php if($list): ?><div class="my_reward_cli my_reward_cli_jifen" style="margin:5px auto;" >  
                <div  class="my_reward_cli_fir" style="width:50%" id="rewardname">项目名</div>   
                <!-- <div  class="my_reward_cli_oth" style="width:25%" id="reward">浏览量</div>      -->
                <div  class="my_reward_cli_oth" style="width:48%">获得积分</div>
            </div>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="my_reward_cli my_reward_cli_jifen" style="margin:5px auto;">  	
                <div  class="my_reward_cli_fir" style="width:50%;" id="rewardname">
                    <?php if($vo['type'] == 1): echo ($vo["LouPanTitle"]); else: ?>购买商品<?php endif; ?>
                </div>
                <!-- <div  class="my_reward_cli_oth" style="width:25%;" id="reward"><?php echo (($vo["views"])?($vo["views"]):0); ?></div> -->
                <div  class="my_reward_cli_oth"style="width:48%;">
                    <?php if($vo['type'] == 1): ?>+<?php else: ?>-<?php endif; echo (($vo["hascredit"])?($vo["hascredit"]):0); ?>
                </div>  	 
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        <?php else: ?>
            <div class="mykh_cli" style="background-color:#fff;">
                暂无积分明细
            </div><?php endif; ?>
        
    	<!-- <div class="my_reward_cli my_reward_cli_quan" href="#" >  	
            <div  class="my_reward_cli_fir">我的优惠券</div>  	
            <div  class="my_reward_cli_oth">+4张</div>  	
            <div  class="my_reward_cli_oth">
            	<span  class="my_reward_cli_span">领取</span>            
            </div>  	 
        </div>
 

    	<div class="my_reward_cli my_reward_cli_card" href="#" >  	
            <div  class="my_reward_cli_fir">我的购物卡</div>  	
            <div  class="my_reward_cli_oth">+3张</div>  	
            <div  class="my_reward_cli_oth">
            	<span  class="my_reward_cli_span">领取</span>            
            </div>  	 
        </div>
 

    	<div class="my_reward_cli my_reward_cli_hbao" href="#" >  	
            <div  class="my_reward_cli_fir">我的红包</div>  	
            <div  class="my_reward_cli_oth">+3个</div>  	
            <div  class="my_reward_cli_oth">
            	<span  class="my_reward_cli_span_none">领取</span>            
            </div>  	 
        </div> -->
 
</body>
</html>