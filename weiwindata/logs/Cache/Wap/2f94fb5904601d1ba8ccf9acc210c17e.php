<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
<meta content="telephone=no" name="format-detection">
<meta name="keywords" content="客带客，买房，看房，房地产">
<meta name="description" content="客带客是中国领先的房地产综合营运商。公司于2003年6月19日在香港联合交易所主板上市，综合实力居国内领先地位，目前已进入全国四大区域十三个城市，土地储备规模超过1000万平方米，有相当高的市场知名度和品牌影响力。">
<title></title>
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<link href="<?php echo RES;?>/css/defstyel.css" rel="stylesheet" type="text/css">
<link href="<?php echo RES;?>/css/nestyle.css" rel="stylesheet" type="text/css">
</head>

 
<body>

	 
	<p  class="mid_reg" style="font-size:20px; line-height:40px; color:#333; margin-top:20px;">我的佣金</p>
    <div class="my_brokerage_top">
    	<div class="my_brokerage_suq">总结佣（税前）
        	<div class="my_brokerage_moe" style="font-size:20px;" id="allcount"><?php echo (($allcount)?($allcount):0); ?></div>
        </div>
    </div>  
    
    <div class="my_brokerage_top" style=" margin-left:0%; ">
    	<!-- <div class="my_brokerage_suq">已结佣（税前）
        	<div class="my_brokerage_moe" id="ylcount"><?php echo (($ylcount)?($ylcount):0); ?></div>
        </div> -->
        <div class="my_brokerage_suq">可结佣（税前）
            <div class="my_brokerage_moe" style="font-size:20px;" id="ylcount"><?php echo (($klcount)?($klcount):0); ?></div>
        </div>
    </div>  <br clear="all">
        
    	<!-- <a class="my_brokerage_cli" href="<?php echo U('Agent/bank',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" >  	
            卡号  -->
              <!-- <span>1111</span><span>2222</span><span>3333</span><span>4444</span><span>5555</span>   -->
             <!--  <span><?php echo (($bank['bankcard'])?($bank['bankcard']):"请填写您的银行卡"); ?></span>
        </a> -->
    	<!-- <a class="my_brokerage_cli" href="<?php echo U('Agent/reward',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" style="background-image:none; text-align:center; text-indent:0px; font-size:20px;" >  	
             领取佣金
        </a> -->
        
            <p  class="agreement" style="width:90%; height:60px; line-height:60px;">账目明细
                <input type="button" value="取现" onclick="showboxa('showbox_yxlp')" style=" float:right; position:relative; top:15px;  width:120px; height:35px; font-weight:bold; font-size:18px;   background:#fff;font-family:微软雅黑; outline:none; color:#666;-moz-border-radius:5px;
  -webkit-border-radius:5px; 
  border-radius: 5px; background-color:#f5f5f5; border:2px solid #e3e3e3;"> 
            </p>
            <input type="hidden" id="klcount" value="<?php echo ($klcount); ?>">       
            <div class="agreement_content_age" style="width:100%; text-align:left; ">
            
                    
                    <div class="my_brokerage_minxi">    
                        <span style="width:20%;">日期</span>
                        <span style="width:35%;">详情</span>
                        <span style="width:20%;">金额</span> 
                        <span style="width:25%;">状态</span>
                        
                    </div> 

                <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="my_brokerage_xianq">
                        <span style="width:25%;"><?php echo (date("Y.m.d",$vo["srtime"])); ?></span>
                        <span style="width:30%;">
                            <?php if($vo['rewardstatus'] == '-1'): ?>购买商品
                            <?php elseif(($vo['rewardstatus'] == '0')): ?>
                            <?php echo ($vo["customname"]); echo ($vo["statusname"]); ?>
                            <?php elseif(($vo['rewardstatus'] == '-99')): ?>
                                撤销操作
                            <?php else: ?>
                                取现操作<?php endif; ?>
                        </span>
                        <span style="width:20%; font-size:14px;  color:#333;">
                            <?php if(($vo['rewardstatus'] == 0) || ($vo['rewardstatus'] == '-99')): ?>+<?php else: ?>-<?php endif; echo ($vo["rewardamount"]); ?>
                        </span> 
                        <span style="width:20%;" id="statusinfo">
                            <?php if($vo['rewardstatus'] == 0): ?><a href="<?php echo U('Agent/rewardmodify',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$vo['id']));?>" style="color:#0f0;">普通佣金</a>
                            <?php elseif($vo['rewardstatus'] == 1): ?>
                                <a style="color:#00f;">已提现</a>
                            <?php elseif($vo['rewardstatus'] == 2): ?>
                                <a style="color:#f00;">提现审核</a>
                            <?php elseif($vo['rewardstatus'] == '-1'): ?>
                                购买商品
                            <?php elseif($vo['rewardstatus'] == '-99'): ?>
                                已撤销<?php endif; ?>
                        </span>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>       
            </div>

    <div class="showbox_yxlp" style="display:none;" id="error_box">
        
        <div class="showbx_error">
            
        <a href="#"  id="error_a"  onclick="closeboxa('error_box')">×</a> 
        
           <div style="clear:both;" id="errorinfo">提现申请</div> 
          
        </div>
    </div>

    <div id="showbox_yxlp" class="showbox_yxlp" style="display:none;" >
        <div class="khxq_fwcj">                 
        <div id="khxq_close" onclick="closeboxa('showbox_yxlp')"> </div>
            提取金额
            <form action="<?php echo U('Agent/rewardmodify',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" method="post">
              <input type="text" value="0"  class="khxq_qian" name="rewardamount" id="rewardamount"/> 
              <input type="submit" class="khxq_bc" onclick="return check()" value="保存">
            </form>
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
    function modify(id){
        var token=id;
        $.ajax({
            type:'post',
            url:"<?php echo U('Agent/rewardmodify');?>",
            dataType:"json",
            data:{"id":id},
            success: function(datas){
                        if(datas==1){
                            $("#errorinfo").html("申请成功，请等待审核！");
                            $("#statusinfo").html("<span style='color:#00f;'>提现审核</span>");
                            showboxa('error_box');
                        }else{
                            $("#errorinfo").html("申请失败，请重新申请！");
                            showboxa('error_box');
                        }
                      }
        });
        // href="<?php echo U('Agent/rewardmodify',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$vo['id']));?>"
    }

    function check(){
        var rewardamount=document.getElementById("rewardamount").value;  //取现金额
        var klcount=document.getElementById("klcount").value;  //可领金额
        var preg=/^([1-9][\d]{0,7}|0)(\.[\d]{1})?$/;
        if(rewardamount<=0){
           $("#errorinfo").html("请输入提现金额");
           closeboxa('showbox_yxlp');
           showboxa('error_box');
           return false;
        }
        if(!preg.test(rewardamount)){
            $("#errorinfo").html("请输入正确金额,可精确到小数点后1位");
           closeboxa('showbox_yxlp');
           showboxa('error_box');
           return false;
        }
        if(parseFloat(rewardamount)>parseFloat(klcount)){
            $("#errorinfo").html("提现金额大于可领金额");
           closeboxa('showbox_yxlp');
           showboxa('error_box');
           return false;
        }
    }
</script>
</html>