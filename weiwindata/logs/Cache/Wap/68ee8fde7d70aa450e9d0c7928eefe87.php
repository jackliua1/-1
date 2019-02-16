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
  <p  class="mid_reg">客户详情</p>
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
		</p>
	<form action="<?php echo U('SaleManager/custommodify',array('token'=>$token));?>" method="post">
		<div class="reg_content">
			<?php if($status == 1): ?><select name="status" class="status">
					<option value="">--请修改状态--</option>
					<option value="2">到访</option>
				</select>
				<input type="text" name="jdname" placeholder="接待人姓名" class="jdname">
				<input type="text" name="jdtel" placeholder="接待人电话" class="jdtel">
			<?php elseif(($status == 2) or ($status == 3)): ?>
				<?php if($status == 2): ?><select name="status" class="status">
						<option value="">--请修改状态--</option>
						<option value="3">完成</option>
					</select>
				<?php else: ?>
					<input type="hidden" name="status" value="<?php echo ($kh["Stutas"]); ?>">
					<input type="hidden" name="isok" value="1"><?php endif; ?>
				<div class="info"><div class="name">项目名称：</div><div class="value"><?php echo ($kh["LouPanTitle"]); ?></div></div>
				<div class="info"><div class="name">现场接待人：</div><div class="value"><?php echo ($kh["jdname"]); ?></div></div>
				<div class="info"><div class="name">产品：</div><div class="value"><input type="text" name="products" placeholder="产品" class="products" value="<?php echo ($kh["products"]); ?>"></div></div>
				<div class="info"><div class="name">楼栋号：</div><div class="value"><input type="text" name="ldh" placeholder="楼栋号" class="ldh" value="<?php echo ($kh["ldh"]); ?>"></div></div>
				<div class="info"><div class="name">房号：</div><div class="value"><input type="text" name="houseno" placeholder="房号" class="houseno" value="<?php echo ($kh["houseno"]); ?>"></div></div>
				<div class="info"><div class="name">合同面积(平方)：</div><div class="value"><input type="text" name="htmj" placeholder="合同面积(平方)" class="htmj" value="<?php echo ($kh["htmj"]); ?>"></div></div>
				<div class="info"><div class="name">合同总价：</div><div class="value"><input type="text" name="htzj" placeholder="合同总价" class="htzj" value="<?php echo ($kh["htzj"]); ?>"></div></div>
				<div class="info"><div class="name">预约日期：</div><div class="value"><input type="date" name="yydate" placeholder="预约日期" class="yydate" value="<?php echo ($kh["yydate"]); ?>"></div></div>
				<div class="info"><div class="name">认购日期：</div><div class="value"><input type="date" name="rgdate" placeholder="认购日期" class="rgdate" value="<?php echo ($kh["rgdate"]); ?>"></div></div>
				<div class="info"><div class="name">签约日期：</div><div class="value"><input type="date" name="qydate" placeholder="签约日期" class="qydate" value="<?php echo ($kh["qydate"]); ?>"></div></div>
				<div class="info"><div class="name">应收金额：</div><div class="value"><input type="text" name="ysje" placeholder="应收金额" class="ysje" value="<?php echo ($kh["ysje"]); ?>"></div></div>
				<div class="info"><div class="name">实收金额：</div><div class="value"><input type="text" name="ssje" placeholder="实收金额" class="ssje" value="<?php echo ($kh["ssje"]); ?>" readonly></div></div>
				<div class="info"><div class="name">收款金额1：</div><div class="value"><input type="text" name="skje1" placeholder="收款金额1" class="skje1" value="<?php echo ($kh["skje1"]); ?>"></div></div>
				<div class="info"><div class="name">收款日期1：</div><div class="value"><input type="date" name="skrq1" placeholder="收款日期1" class="skrq1" value="<?php echo ($kh["skrq1"]); ?>"></div></div>
				<div class="info"><div class="name">收款方式1：</div><div class="value"><input type="text" name="skfs1" placeholder="收款方式1" class="skfs1" value="<?php echo ($kh["skfs1"]); ?>"></div></div>
				<div class="info"><div class="name">客户卡号1：</div><div class="value"><input type="text" name="khcard1" placeholder="客户卡号1" class="khcard1" value="<?php echo ($kh["khcard1"]); ?>"></div></div>
				<div class="info"><div class="name">POS单凭证号1：</div><div class="value"><input type="text" name="pos_pzh1" placeholder="POS单凭证号1" class="pos_pzh1" value="<?php echo ($kh["pos_pzh1"]); ?>"></div></div>
				<div class="info"><div class="name">收据编号1：</div><div class="value"><input type="text" name="sjnum1" placeholder="收据编号1" class="sjnum1" value="<?php echo ($kh["sjnum1"]); ?>"></div></div>
				<div class="info"><div class="name">收款金额2：</div><div class="value"><input type="text" name="skje2" placeholder="收款金额2" class="skje2" value="<?php echo ($kh["skje2"]); ?>"></div></div>
				<div class="info"><div class="name">收款日期2：</div><div class="value"><input type="date" name="skrq2" placeholder="收款日期2" class="skrq2" value="<?php echo ($kh["skrq2"]); ?>"></div></div>
				<div class="info"><div class="name">收款方式2：</div><div class="value"><input type="text" name="skfs2" placeholder="收款方式2" class="skfs2" value="<?php echo ($kh["skfs2"]); ?>"></div></div>
				<div class="info"><div class="name">客户卡号2：</div><div class="value"><input type="text" name="khcard2" placeholder="客户卡号2" class="khcard2" value="<?php echo ($kh["khcard2"]); ?>"></div></div>
				<div class="info"><div class="name">POS单凭证号2：</div><div class="value"><input type="text" name="pos_pzh2" placeholder="POS单凭证号2" class="pos_pzh2" value="<?php echo ($kh["pos_pzh2"]); ?>"></div></div>
				<div class="info"><div class="name">收据编号2：</div><div class="value"><input type="text" name="sjnum2" placeholder="收据编号2" class="sjnum2" value="<?php echo ($kh["sjnum2"]); ?>"></div></div>
				<div class="info"><div class="name">收款金额3：</div><div class="value"><input type="text" name="skje3" placeholder="收款金额3" class="skje3" value="<?php echo ($kh["skje3"]); ?>"></div></div>
				<div class="info"><div class="name">收款日期3：</div><div class="value"><input type="date" name="skrq3" placeholder="收款日期3" class="skrq3" value="<?php echo ($kh["skrq3"]); ?>"></div></div>
				<div class="info"><div class="name">收款方式3：</div><div class="value"><input type="text" name="skfs3" placeholder="收款方式3" class="skfs3" value="<?php echo ($kh["skfs3"]); ?>"></div></div>
				<div class="info"><div class="name">客户卡号3：</div><div class="value"><input type="text" name="khcard3" placeholder="客户卡号3" class="khcard3" value="<?php echo ($kh["khcard3"]); ?>"></div></div>
				<div class="info"><div class="name">POS单凭证号3：</div><div class="value"><input type="text" name="pos_pzh3" placeholder="POS单凭证号3" class="pos_pzh3" value="<?php echo ($kh["pos_pzh3"]); ?>"></div></div>
				<div class="info"><div class="name">收据编号3：</div><div class="value"><input type="text" name="sjnum3" placeholder="收据编号3" class="sjnum3" value="<?php echo ($kh["sjnum3"]); ?>"></div></div><?php endif; ?>
		
			<input type="hidden" name="id" value="<?php echo ($kh["ID"]); ?>">
			<input type="hidden" name="lpid" value="<?php echo ($kh["lpid"]); ?>">
			<input type="submit" class="zc_but" value="保存" id="zhuce" onclick="return check();">
		</div>
    </form>
		
      <!-- <?php if(is_array($status)): $i = 0; $__LIST__ = $status;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($sort >= $vo['sort']): ?><div class="khxq_zt_" id="daof_" style="display:block">
            <div >
              <?php echo ($vo["salesstatus"]); ?>
              <span>
                <?php if($vo['salesstatus'] == '到场'): echo (date("Y.m.d H:i",$kh["DcTime"])); ?>
                <?php elseif($vo['salesstatus'] == '认筹'): ?>
                  <?php echo (date("Y.m.d H:i",$kh["RcTime"])); ?>
                <?php elseif($vo['salesstatus'] == '认购'): ?>
                  <?php echo (date("Y.m.d H:i",$kh["RgTime"])); ?>
                <?php elseif($vo['salesstatus'] == '签约'): ?>
                  <?php echo (date("Y.m.d H:i",$kh["QyTime"])); ?>
                <?php elseif($vo['salesstatus'] == '回款'): ?>
                  <?php echo (date("Y.m.d H:i",$kh["HkTime"])); endif; ?>
              </span>
            </div>
            <p class="pp_">
              <?php if($vo['salesstatus'] == '到场'): ?>备注 有效客户<?php endif; ?>
            </p>
            <p>操作人 <?php echo ($kh["zyname"]); ?></p>
            <span class="khxq_zg_"></span>
          </div>
        <?php elseif($vo['salesstatus'] == '回款'): ?>
          <div class="khxq_zt" title="<?php echo ($vo["salesstatus"]); ?>">
            <div><?php echo ($vo["salesstatus"]); ?></div>
            <span class="khxq_zg"></span>
          </div>
        <?php else: ?>
          <a href="<?php echo U('Zhiye/custommodify',array('token'=>$kh['Token'],'wecha_id'=>$kh['Wecha_id'],'Stutas'=>$vo['id'],'id'=>$kh['ID']));?>">
            <div class="khxq_zt">
              <div><?php echo ($vo["salesstatus"]); ?></div>
              <span class="khxq_zg"></span>
            </div>
          </a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
      <!-- 无效 -->
      <!-- <a href="<?php echo U('Zhiye/wxcustommodify',array('token'=>$kh['Token'],'wecha_id'=>$kh['Wecha_id'],'Stutas'=>$wxstatus['id'],'id'=>$kh['ID']));?>">
        <div class="khxq_zt">
          <div><?php echo ($wxstatus["salesstatus"]); ?></div>
          <span class="khxq_zg"></span>
        </div>
      </a> -->
     <div id="showbox_yxlp" class="showbox_yxlp" style="display:none;" >
        <div class="khxq_fwcj">                 
        <div id="khxq_close" > </div>
            成交价格

            <form action="<?php echo U('Zhiye/newcusprice',array('token'=>$kh['Token'],'wecha_id'=>$kh['Wecha_id'],'Stutas'=>$vo['id'],'id'=>$kh['ID']));?>" method="post">
              实收款：
                <input type="text" value=<?php echo ($datas["salesvalueq"]); ?>  class="khxq_qian" name="salesvalueq" id="salesvalue"/><br>
              第一次：
                <input type="text" value=<?php echo ($datas["salesvalue"]); ?>  class="khxq_qian" name="salesvalue" id="salesvaluee"/><br>
                第二次：
                <input type="text" value="<?php echo ($datas["salesvalues"]); ?>"  class="khxq_qian" name="salesvalues" id="salesvalues"/><br>
                第三次：
                <input type="text" value="0"  class="khxq_qian" name="salesvaluew" id="salesvaluew"/><br>
               总计：
                <input type="text" value="0"  class="khxq_qian" name="salesvaluew" id="salesvaluewe"/>
                <!--<input type="text" value="0"  class="khxq_qian" name="salesvaluew" id="salesvaluew"/>-->
              <input type="submit" class="khxq_bc" onclick="return check()" value="保存">
            </form>

        </div>
     </div>
     
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
    GETdiv("khxq_close").onclick=function(){GETdiv("showbox_yxlp").style.display="none";}
    // GETdiv("huik").onclick=function(){GETdiv("showbox_yxlp").style.display="block";}
    // GETdiv("khxq_bc").onclick=function(){GETdiv("showbox_yxlp").style.display="none"; }
    // GETdiv("huik").style.display="none";  GETdiv("huik_").style.display="block";}

    //var getname=GETname("khxq_zt");
    //for(i in  getname){
    //    getname[i].onclick=function(){
    //      if(this.title=='回款'){
    //        GETdiv("showbox_yxlp").style.display="block";
    //      }else{
    //        this.style.display="none";
    //      }
    //    }
    //}
	
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
  
  $(".skje1").on('keyup',function(){
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
  $(".skje2").on('keyup',function(){
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
  $(".skje3").on('keyup',function(){
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
	var skje1 = isNaN(parseFloat($(".skje1").val()))?0:parseFloat($(".skje1").val());
	var skje2 = isNaN(parseFloat($(".skje2").val()))?0:parseFloat($(".skje2").val());
	var skje3 = isNaN(parseFloat($(".skje3").val()))?0:parseFloat($(".skje3").val());
	var ssje = parseFloat(skje1+skje2+skje3).toFixed(2);
	$(".ssje").val(ssje);
  }

</script>
</html>