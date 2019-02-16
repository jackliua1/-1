<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
<meta content="telephone=no" name="format-detection">
<meta name="keywords" content="首创置业，买房，看房，房地产">
<meta name="description" content="首创置业是中国领先的房地产综合营运商。公司于2003年6月19日在香港联合交易所主板上市，综合实力居国内领先地位，目前已进入全国四大区域十三个城市，土地储备规模超过1000万平方米，有相当高的市场知名度和品牌影响力。">
<title></title>
<link href="<?php echo RES;?>/css/nestyle.css" rel="stylesheet" type="text/css">
<link href="<?php echo RES;?>/css/defstyel.css" rel="stylesheet" type="text/css">
</head>

<body>
	<p  class="mid_reg">客户详情</p>
     <p class="khxq_name"> 
     	<span  ><?php echo ($kh["khname"]); ?></span>
     	<span class="khxq_dh"><?php echo ($kh["khtel"]); ?></span>
      </p>
    <?php switch($kh["khid"]): case "0": ?><p class="khxq_name khxq_name_">
            <span style="text-indent:10px;">推荐人</span>
            <span> <?php echo ($kh["zyname"]); ?></span>
            <span  style="font-size:16px; font-family:Arial, Helvetica, sans-serif;">(<?php echo ($kh["zyTel"]); ?>)</span><?php break;?>

        <?php default: ?> <p class="khxq_name khxq_name_">
        <span style="text-indent:10px;">推荐人</span>
        <span> <?php echo ($kh["jjrname"]); ?></span>
        <span  style="font-size:16px; font-family:Arial, Helvetica, sans-serif;">(<?php echo ($kh["jjrtel"]); ?>)</span>
    </p><?php endswitch;?>
      
      <?php if(is_array($status)): $i = 0; $__LIST__ = $status;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($sort >= $vo['sort']): ?><div class="khxq_zt_" id="daof_" style="display:block">
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
      <a href="<?php echo U('Zhiye/wxcustommodify',array('token'=>$kh['Token'],'wecha_id'=>$kh['Wecha_id'],'Stutas'=>$wxstatus['id'],'id'=>$kh['ID']));?>">
        <div class="khxq_zt">
          <div><?php echo ($wxstatus["salesstatus"]); ?></div>
          <span class="khxq_zg"></span>
        </div>
      </a>
     <div id="showbox_yxlp" class="showbox_yxlp" style="display:none;" >
        <div class="khxq_fwcj">              		
	      <div id="khxq_close" > </div>
        		成交价格
            <form action="<?php echo U('Zhiye/newcusprice',array('token'=>$kh['Token'],'wecha_id'=>$kh['Wecha_id'],'Stutas'=>$vo['id'],'id'=>$kh['ID']));?>" method="post">
                实收款：
                <input type="text" value="<?php echo ($datas["salesvalueq"]); ?>"  class="khxq_qian" name="salesvalueq" id="salesvalue"/><br>
                第一次：
                <input type="text" value="<?php echo ($datas["salesvalue"]); ?>"  class="khxq_qian" name="salesvalue" id="salesvaluee"/><br>
                第二次：
                <input type="text" value="<?php echo ($datas["salesvalues"]); ?>"  class="khxq_qian" name="salesvalues" id="salesvalues"/><br>
                第三次：
                <input type="text" value="0"  class="khxq_qian" name="salesvaluew" id="salesvaluew"/><br>
                总计：
                <input type="text" value="<?php echo ($datas["inde"]); ?>"  class="khxq_qian" name="inde" id="salesvaluewe"/>
                <!--<input type="text" value="0"  class="khxq_qian" name="salesvaluew" id="salesvaluew"/>-->
              <input type="submit" class="khxq_bc" onclick="return check()" value="保存">
            </form>
        </div>
     </div>
     
     <div class="showbox_yxlp"  id="error_box" style="display:none;" >
        <div class="showbx_error">
        <a href="#" id="error_a"  onclick="closeboxa('error_box')">×</a> 
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
		
    var getname=GETname("khxq_zt"); 
    for(i in  getname){
        getname[i].onclick=function(){
          if(this.title=='回款'){
            GETdiv("showbox_yxlp").style.display="block";
          }else{
            this.style.display="none";
          }
        }
    }

    //检查表单提交的信息
    check=function(){
      var salesvalue=document.getElementById("salesvalue").value;
      var preg=/^([1-9][\d]{0,7}|0)(\.[\d]{1})?$/;
      if(!preg.test(rewardamount)){
            $("#errorinfo").html("请输入正确金额,可精确到小数点后1位");
           GETdiv("error_box").style.display="block";
           return false;
        }
      if(salesvalue<0){
        GETdiv("error_box").style.display="block";
        return false;
      }
        if(salesvalues<0){
            GETdiv("error_box").style.display="block";
            return false;
        }
        if(salesvaluew<0){
            GETdiv("error_box").style.display="block";
            return false;
        }
      // else{
      //   return(confirm('请确定您填写的成交价格'));
      // }
    }
	}

</script>
</html>