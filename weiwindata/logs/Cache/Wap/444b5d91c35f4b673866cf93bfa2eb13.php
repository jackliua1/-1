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
</head>

<body>
    	<div  class="customenr_top"> 
        	领取客户
        </div>
        <form action="<?php echo U('Zhiye/fpHandle',array('token'=>$zy['Token'],'wecha_id'=>$zy['Wecha_id']));?>" method="post">
        <div id="newkh" class="my_client_" style="margin-top:10px;">      
                <div class="my_property_cli" >  	
                    <span class="my_client_name" style=" width:30%">姓名</span>
                    <span class="my_client_phone"  style=" width:40%">电话</span> 
                    <span class="my_client_phone"  style=" width:30%">分配选择</span>   
                </div> 
                
                <?php if(is_array($khinfo)): $i = 0; $__LIST__ = $khinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="my_client_cli">  	
                        <span class="my_client_name" style=" width:30%"><?php echo ($vo["Name"]); ?></span>
                        <span class="my_client_phone"  style=" width:40%"><?php echo ($vo["Tel"]); ?></span> 
                        <span  class="my_client_phone"  style=" width:30%">
                        	<input name="khid[]" type="checkbox" value="<?php echo ($vo["ID"]); ?>" class="fpei" >
                        </span>  
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                
                <input type="hidden" value="<?php echo ($mykhcount); ?>" id="oldcount">
        </div>
        
        
    	<input type="submit" class="customenr_top" onclick="return abc()" value="领取"/> 
        
        <input type="hidden" name="zyid" value="<?php echo ($zy["ID"]); ?>">
        <input type="hidden" name="mykhcount" value="<?php echo ($zy["ID"]); ?>" >
     
         </form>

         <div class="showbox_yxlp"  id="error_box" style="display:none;" >
        
            <div class="showbx_error">
                
            <a href="#" id="error_a"  onclick="closeboxa('error_box')">×</a> 
            
               <div style="clear:both;" id="errorinfo"> 未领取客户</div>  
               
             </div>
        </div> 
</body>
<script type="text/javascript">

	function showboxa(a){
        
            document.getElementById(a).style.display="";
        }
    function closeboxa(b){ 
            document.getElementById(b).style.display="none";    
        }


	function abc(){
        //原有新客户总数
        var oldcount=document.getElementById('oldcount').value;
		var kh=document.getElementById('newkh').getElementsByTagName('input');
        var khlength=kh.length;
        var khid=0;
        for(var i=0;i<khlength;i++){
            if(kh[i].checked){
                khid++;
            }
        }
        if(khid==0){
            showboxa('error_box');
            return false;
        }
        var allcount=parseInt(oldcount)+khid;
        if(allcount>10){
            document.getElementById("errorinfo").innerText="领取后新客户总数超过10个";
            showboxa('error_box');
            return false;
        }
	}
</script>
</html>