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
        	客户分配
        </div>
        
        
        
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
                        	<input name="khid" type="checkbox" value="<?php echo ($vo["ID"]); ?>" class="fpei" >
                        </span>  
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                
                
        </div>
        
        
    	<a href="#"  class="customenr_top"  onclick="showboxa('sale')" > 
        	分配
        </a>
        
        <input type="hidden" name="token" id="token" value="<?php echo ($khinfo[0]["Token"]); ?>">
        
        
     
     <div id="sale" class="showbox_yxlp" style="display:none;" >
     	<div class="showbox_yxlp_" >
        	<div class="showbox_yxlp_title" style="background-color:#31ABD4;">销售顾问</div>
            <?php if(is_array($zyinfo)): $i = 0; $__LIST__ = $zyinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="#" onclick="fenpeia(this)" title="<?php echo ($vo["ID"]); ?>"><?php echo ($vo["Name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>      
         </div>
     </div>
     
     
     
     <div id="fenpei" class="showbox_yxlp" style="display:none;">
     	
     	<div class="showbx_error" style="width:250px; height:100px;">
        	
     	<a href="#" style="background-color:#31ABD4;" onclick="closeboxa('fenpei')">×</a> 
        
           <div class="cust_fpeicg" id="fpinfo">分配成功！</div>   
          
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
    function fenpeia(obj){
        var zyid=obj.title;
        var kh=document.getElementById('newkh').getElementsByTagName('input');
        var khlength=kh.length;
        var khid="";
        for(var i=0;i<khlength;i++){
            if(kh[i].checked){
                khid+=kh[i].value;
                if(i!=khlength-1){
                    khid+=",";
                 }
            }
        }
        var fpinfo=document.getElementById("fpinfo");
        if(khid==""){
            closeboxa("sale");
             
            fpinfo.innerText="请选择客户"; 
            showboxa("fenpei");
            return;
        }
        var token=document.getElementById("token").value;
        var url="<?php echo U('SaleManager/fpHandle',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>";

        $.ajax({
            type:'post',
            url:url,
            dataType:"json",
            data:{"token":token,"khid":khid,"zyid":zyid},
            success: function(datas){
                     if(datas=="1"){
                        fpinfo.innerText="分配成功！";

        window.location.href="<?php echo U('SaleManager/custom',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>";
                     }else{
                        fpinfo.innerText="分配失败！";
                     }
                     
                   }
        });
        closeboxa("sale");  
        showboxa("fenpei");
    }
</script>
</html>