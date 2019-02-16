<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
<meta content="telephone=no" name="format-detection">
<meta name="keywords" content="首创置业，买房，看房，房地产">
<meta name="description" content="首创置业是中国领先的房地产综合营运商。公司于2003年6月19日在香港联合交易所主板上市，综合实力居国内领先地位，目前已进入全国四大区域十三个城市，土地储备规模超过1000万平方米，有相当高的市场知名度和品牌影响力。">
<title></title>
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>                                                         
<link href="<?php echo RES;?>/css/defstyel.css" rel="stylesheet" type="text/css">
</head>

<body>
	
    	<div  class="customenr_top">
        	<div  class="cust_kh_" id="but_newkh" onClick="showbox('but_newkh','newkh')">充值记录</div>
        	<div  class="cust_kh" id="but_befkh" onClick="showbox('but_befkh','beforekh')">消耗记录</div>
        
        </div>
        
         <!--新用户-->
  		    <div id="newkh" class="my_client_" style="margin-top:10px;"> 
               <div class="my_property_cli" >   
                    <span class="my_client_name" style=" width:48%">充值金额</span>
                    <span class="my_client_phone"  style=" width:48%">充值时间</span>
                </div>
                <?php if(is_array($capital)): $i = 0; $__LIST__ = $capital;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="my_client_cli">     
                        <span class="my_client_name" style=" width:48%"><?php echo ($vo["money"]); ?></span>
                        <!-- <span class="my_client_phone"  style=" width:40%"><?php echo ($vo["Tel"]); ?></span>  -->
                        <span  class="my_client_day"  style=" width:48%"><?php echo (date("Y.m.d",$vo["createtime"])); ?></span> 
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php if($capital == ''): ?><a class="customenr_top"> 
                    亲，暂无充值记录！！！
                  </a><?php endif; ?>
            </div>
            <!--新用户-->
        
         <!--历史用户-->
           <div id="beforekh" class="my_client_" style="display:none;margin-top:10px;"> 
              <div class="my_property_cli" >    
                  <span class="my_client_name" style=" width:33%">会员</span>
                    <span class="my_client_phone"  style=" width:33%">佣金金额</span>
                    <span class="my_client_phone"  style=" width:33%">备注</span>
              </div>
              <?php if(is_array($comm)): $i = 0; $__LIST__ = $comm;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="my_client_cli">     
                      <span class="my_client_name" style=" width:33%"><?php echo ($vo["Name"]); ?></span>
                      <span class="my_client_phone"  style=" width:33%"><?php echo ($vo["rewardamount"]); ?></span> 
                      <?php if($vo['type'] == 1): ?><span class="my_client_name" style=" width:33%">分享获得</span>
                      <?php else: ?>
                        <span class="my_client_name" style=" width:33%">推荐获得</span><?php endif; ?>
                  </div><?php endforeach; endif; else: echo "" ;endif; ?>
              <?php if($comm == ''): ?><a class="customenr_top"> 
                  亲，暂无消耗记录！！！
                </a><?php endif; ?> 
            </div>
            <!--历史用户-->
</body>

<script language="javascript">


  function showbox(a,b){
	var div1=document.getElementById(a);
	var div2=document.getElementById(b); 
	document.getElementById("but_newkh").className="cust_kh";
	document.getElementById("but_befkh").className="cust_kh";
	document.getElementById("newkh").style.display="none";
	document.getElementById("beforekh").style.display="none";
	div1.className="cust_kh_";
	div2.style.display=""
  }


  function showboxa(a){
        
            document.getElementById(a).style.display="";
        }
    function closeboxa(b){ 
            document.getElementById(b).style.display="none";    
        }
 
</script>
</html>