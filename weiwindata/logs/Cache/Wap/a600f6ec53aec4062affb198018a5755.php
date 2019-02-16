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
<link href="<?php echo RES;?>/css/nestyle.css?v=<?php echo ($vtime); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo RES;?>/css/defstyel.css?v=<?php echo ($vtime); ?>" rel="stylesheet" type="text/css">
<style>
	.khxq_dh a{color:#fff;}
	.khxq_name_ a{color:#4ca2f7;}
	.status{margin-top:10px;width:90%;height:39px;line-height:39px;background-color:#fff;border: #d1d1d1 1px solid;
		outline: none;
		border-radius: 5px;
		text-indent: 1em;
		font-size: 14px;
		color: #999;}
	.reg_content .info {
		height: 40px;
		line-height: 40px;
	}
	.reg_content .value input{
		height: 28px;
		line-height: 28px;
		margin-top:0px;
	}
	.reg_content input[type='date']{
		outline: none;
		margin: 0;
		padding: 0;
		border: none;
		height: 32px;
		line-height: 32px;
		font-size: 14px;
		background-color: #fff;
		-webkit-appearance: none;
	}
</style>
</head>

<body>
	<!--返回上一页-->
	<div class="goback">
		<a href="javascript:history.go(-1);">&nbsp;&nbsp;<&nbsp;&nbsp;</a>
		客户详情
	</div>
	<p  class="mid_reg"> </p>
	<!--返回上一页-->
     <p class="khxq_name"> 
      <span><?php echo ($kh["khname"]); ?></span>
      <span class="khxq_dh"><?php if($status == 1): echo ($kh["khtel"]); else: ?><a href="tel:<?php echo ($kh["khtel"]); ?>"><?php echo ($kh["khtel"]); ?></a><?php endif; ?></span>
      </p>
	  
	  <p class="khxq_name khxq_name_">
		<?php if($kh[zjgs]): ?><span>中介公司：<?php echo ($kh["zjgs"]); ?></span> <br/><?php endif; ?>
		<?php if($kh[JJ_id] == 0): ?><span style="text-indent:10px;">推荐人</span>
          <span> <?php echo ($kh["zyname"]); ?></span>
          <span  style="font-size:16px; font-family:Arial, Helvetica, sans-serif;">(<a href="tel:<?php echo ($kh["zyTel"]); ?>"><?php echo ($kh["zyTel"]); ?></a>)</span>
		<?php else: ?> 
		<span style="text-indent:10px;">推荐人</span>
		  <span> <?php echo ($kh["jjrname"]); ?></span>
		  <span  style="font-size:16px; font-family:Arial, Helvetica, sans-serif;">(<a href="tel:<?php echo ($kh["jjrtel"]); ?>"><?php echo ($kh["jjrtel"]); ?></a>)</span><?php endif; ?>
		  <br/>
		  <span>项目名称：<?php echo ($kh["LouPanTitle"]); ?></span>
		</p>
	<form action="<?php echo U('Manager/custommodify',array('token'=>$token));?>" method="post">
		<div class="reg_content">
			<?php if($status == 1): ?><select name="status" class="status">
					<option value="1">带看</option>
				</select>
			<?php elseif($status == 2): ?>
				<select name="status" class="status">
					<option value="2">到访</option>
				</select>
			<?php elseif($status == 3): ?>
				<select name="status" class="status">
					<option value="3">完成</option>
				</select><?php endif; ?>
			
			<?php if($status == 3): ?><div class="info"><div class="name">产品：</div><div class="value"><input type="text" placeholder="产品" class="products" readonly value="<?php echo ($kh["products"]); ?>"></div></div>
			<div class="info"><div class="name">楼栋号：</div><div class="value"><input type="text" readonly placeholder="楼栋号" class="ldh" value="<?php echo ($kh["ldh"]); ?>"></div></div>
			<div class="info"><div class="name">房号：</div><div class="value"><input type="text" readonly placeholder="房号" class="houseno" value="<?php echo ($kh["houseno"]); ?>"></div></div>
			<div class="info"><div class="name">合同面积(平方)：</div><div class="value"><input type="text" readonly placeholder="合同面积(平方)" class="htmj" value="<?php echo ($kh["htmj"]); ?>"></div></div>
			<div class="info"><div class="name">合同总价：</div><div class="value"><input type="text" readonly placeholder="合同总价" class="htzj" value="<?php echo ($kh["htzj"]); ?>"></div></div>
			<div class="info"><div class="name">认购日期：</div><div class="value"><input type="date" readonly placeholder="认购日期" class="rgdate" value="<?php echo ($kh["rgdate"]); ?>"></div></div>
			
			
			<div class="info"><div class="name">请佣金额1：</div><div class="value"><input type="text" name="qyje1" placeholder="请佣金额1" class="qyje1" value="<?php echo ($kh["qyje1"]); ?>"></div></div>
			<div class="info"><div class="name">请佣日期1：</div><div class="value"><input type="date" name="qyrq1" placeholder="请佣日期1" class="qyrq1" value="<?php echo ($kh["qyrq1"]); ?>"></div></div>
			<div class="info"><div class="name">打款日期1：</div><div class="value"><input type="date" name="dkrq1" placeholder="打款日期1" class="dkrq1" value="<?php echo ($kh["dkrq1"]); ?>"></div></div>
			<div class="info"><div class="name">请佣金额2：</div><div class="value"><input type="text" name="qyje2" placeholder="请佣金额2" class="qyje2" value="<?php echo ($kh["qyje2"]); ?>"></div></div>
			<div class="info"><div class="name">请佣日期2：</div><div class="value"><input type="date" name="qyrq2" placeholder="请佣日期2" class="qyrq2" value="<?php echo ($kh["qyrq2"]); ?>"></div></div>
			<div class="info"><div class="name">打款日期2：</div><div class="value"><input type="date" name="dkrq2" placeholder="打款日期2" class="dkrq2" value="<?php echo ($kh["dkrq2"]); ?>"></div></div>
			
			
			<div class="info"><div class="name">总付款：</div><div class="value"><input type="text" name="zfk" placeholder="总付款" class="zfk" value="<?php echo ($kh["zfk"]); ?>" readonly></div></div>
			
			<input type="hidden" name="id" value="<?php echo ($kh["ID"]); ?>">
			<input type="submit" class="zc_but" value="保存" id="zhuce"><?php endif; ?>
		
		</div>
    </form>
	
     <div class="showbox_yxlp"  id="error_box" style="display:none;" >
        <div class="showbx_error">
        <a href="#" id="error_a">×</a> 
           <div style="clear:both;" id="errorinfo"> 成交价格不能为负数</div>  
        </div>
    </div> 
      
</body>
<script language="javascript">
  window.onload=function(){
    function GETdiv(id){
      return document.getElementById(id);
    }
    function GETname(name){
        return document.getElementsByClassName(name);
    }

    // showbox();
    //GETdiv("khxq_close").onclick=function(){GETdiv("showbox_yxlp").style.display="none";}
 
	
	 function showboxa(a,msg){
			$('#errorinfo').text(msg);
            document.getElementById(a).style.display="block";
        };
		$("#error_a").on('click',function(){
			$('#errorinfo').text('');
            $("#error_box").hide();
		});
 

    //检查表单提交的信息
    check=function(){
	 var status = <?php echo ($status); ?>;
	 var xgstatus = $(".status").val();
	 if(status == 1){
		var jdname = $(".jdname").val();
		if(!xgstatus){
            showboxa("error_box",'请修改客户状态');
            return false;
        }
		if(jdname==''){
            showboxa("error_box",'对接人姓名不能为空');
            return false;
        }
	 }
	 if(status == 2){
		if(!xgstatus){
            alert('请修改客户状态');
            return false;
        }
	 }
      // else{
      //   return(confirm('请确定您填写的成交价格'));
      // }
    }
  }
  
  $(".qyje1").on('keyup',function(){
	var reg = $(this).val().match(/\d+\.?\d{0,2}/);
	var txt = '';
	if (reg != null) {
	  txt = reg[0];
	}
	$(this).val(txt);
	getall_money();
  }).change(function () {
     $(this).keypress();
     var v = $(this).val();
     if (/\.$/.test(v)){
         $(this).val(v.substr(0, v.length - 1));
     }
	 getall_money();
  });
  $(".qyje2").on('keyup',function(){
	var reg = $(this).val().match(/\d+\.?\d{0,2}/);
	var txt = '';
	if (reg != null) {
	  txt = reg[0];
	}
	$(this).val(txt);
	getall_money();
  }).change(function () {
     $(this).keypress();
     var v = $(this).val();
     if (/\.$/.test(v)){
         $(this).val(v.substr(0, v.length - 1));
     }
	 getall_money();
  });
  
  function getall_money(){
	var qyje1 = isNaN(parseFloat($(".qyje1").val()))?0:parseFloat($(".qyje1").val());
	var qyje2 = isNaN(parseFloat($(".qyje2").val()))?0:parseFloat($(".qyje2").val());
	var zfk = parseFloat(qyje1+qyje2).toFixed(2);
	$(".zfk").val(zfk);
  }

</script>
</html>