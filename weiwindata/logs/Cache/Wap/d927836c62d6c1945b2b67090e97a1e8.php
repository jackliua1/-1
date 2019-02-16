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
	<!--返回上一页-->
	<div class="goback">
		<a href="javascript:history.go(-1);">&nbsp;&nbsp;<&nbsp;&nbsp;</a>
		客户管理
	</div>
	<p  class="mid_reg"> </p>
	<!--返回上一页-->
    	<div  class="customenr_top">
			<?php if($status == 1): ?><div class="cust_kh_" id="but_newkh">
			<?php else: ?>
			<div class="cust_kh" id="but_newkh"><?php endif; ?>
				<a href="<?php echo U('SaleManager/custom',array('token'=>$token,'status'=>1));?>">报备客户</a>
			</div>
			<?php if($status == 2): ?><div class="cust_kh_" id="but_befkh">
			<?php else: ?>
			<div class="cust_kh" id="but_befkh"><?php endif; ?>
				<a href="<?php echo U('SaleManager/custom',array('token'=>$token,'status'=>2));?>">历史客户</a>
			</div>
        
        </div>
		<div class="search_div">
			<form action="<?php echo U('SaleManager/custom',array('token'=>$token,'status'=>$status));?>" method="post">
				<select name="times" class="times">
					<option value="0" <?php if($times == 0): ?>selected<?php endif; ?>>全部</option>
					<option value="1" <?php if($times == 1): ?>selected<?php endif; ?>>一星期</option>
					<option value="2" <?php if($times == 2): ?>selected<?php endif; ?>>一个月</option>
					<option value="3" <?php if($times == 3): ?>selected<?php endif; ?>>一年内</option>
				</select>
			   <input type="tel" name="Tel" placeholder="请输入客户电话" value="<?php echo ($Tel); ?>" id="tel" class="sear_inp">
				<input type="submit" value="搜索" class="sear_btn">
			</form>
		</div>
		<div class="content">
        <?php if($status == 1): ?><!--新用户-->
		<div class="my_property_cli" >  	
			<span class="my_client_name w30">客户姓名</span>
			<span class="my_client_phone w40">客户电话</span> 
			<span class="my_client_phone w30">添加时间</span>  
		</div> 
		<div id="newkh" class="my_client_" > 
			<?php if(is_array($kh)): $i = 0; $__LIST__ = $kh;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="my_client_cli"> 
					<a href="<?php echo U('SaleManager/custominfo',array('token'=>$token,'id'=>$vo['ID']));?>">				
						<span class="my_client_name w30"><?php echo ($vo["Name"]); ?></span>
						<span class="my_client_phone w40"><?php echo ($vo["Tel"]); ?></span> 
						<span  class="my_client_day w30"><?php echo (date("Y.m.d",$vo["SrTime"])); ?></span> 
					</a>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
			<input type="hidden" name="lpid" id="lpid" value="<?php echo ($lpinfo["id"]); ?>">
		</div>
		<!--新用户-->
        <?php else: ?>
         <!--历史用户-->
		 <div class="my_property_cli" >  	
			<span class="my_client_name w25">客户姓名</span>
			<span class="my_client_phone w30">客户电话</span> 
			<span class="my_client_phone w25">驻场经理</span> 
			<span class="my_client_phone w20">状态</span> 			
		</div> 
		 <div id="beforekh" class="my_client_"> 
			<?php if(is_array($kh)): $i = 0; $__LIST__ = $kh;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="my_client_cli"> 
					<a href="<?php echo U('SaleManager/custominfo',array('token'=>$token,'id'=>$vo['ID']));?>">				
					<span class="my_client_name w25"><?php echo ($vo["kh_name"]); ?></span>
					<span class="my_client_phone w30"><?php echo ($vo["Tel"]); ?></span> 
					<span  class="my_client_day w25"><?php echo ($vo["zy_name"]); ?></span> 
					<span  class="my_client_name w20">
					  <?php if($vo['salesstatus'] == '无效'): ?><span class="daofang_a_"><?php echo ($vo["salesstatus"]); ?></span>
					  <?php elseif($vo['salesstatus'] == '回款'): ?>
						<span class="daofang_a"><?php echo ($vo["salesstatus"]); ?></span>
					  <?php else: ?>
						<!-- <span style="padding:5px;background:#f88;border:1px solid #eee;border-radius:5px;"><?php echo ($vo["Stutas"]); ?></span> -->
						<span class="daofang_a__"><?php echo ($vo["salesstatus"]); ?></span><?php endif; ?>
					</span>
					 </a>
				</div><?php endforeach; endif; else: echo "" ;endif; ?> 
		</div>
		<!--历史用户--><?php endif; ?>
		</div>
			
            <div class="showbox_yxlp" style="display:none;" id="error_box">
      
              <div class="showbx_error">
                  
              <a href="#"  id="error_a"  onclick="closeboxa('error_box')">×</a> 
                
                   <div style="clear:both;" id="errorinfo">开启自动分配！</div> 
                  
                 </div>
             </div>

</body>

<script language="javascript">

  function gotofp(){
    location.href="<?php echo U('SaleManager/fpCustom',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>";
  }

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
  //点击分配时触发的事件
  document.getElementById("clearbut").onclick=function(){
    var fpstatus=0;
    var lpid=document.getElementById("lpid").value;
      if (document.getElementById("clearbut").checked) {
          
          fpstatus=1;
      }else{ 
        
        fpstatus=0;
      }
     //通过ajax修改分配状态
     $.ajax({
      type:'post',
      url:"<?php echo U('SaleManager/fpstatus',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>",
      dataType:"json",
      data:{'fpstatus':fpstatus,'lpid':lpid},
      success: function(datas){
                  if(datas==1){
                    $("#errorinfo").html("开启自动分配！");
                    showboxa('error_box');
                    document.getElementById("gotofp").disabled=true;
                    document.getElementById("gotofp").style.background="#999";
                  }else if(datas==0){
                    $("#errorinfo").html("关闭自动分配！");
                    showboxa('error_box');
                    document.getElementById("gotofp").disabled=false;
                    document.getElementById("gotofp").style.background="";
                  }else{
                    $("#errorinfo").html("修改失败！");
                      showboxa('error_box');
                  }
                }
      }); 
  }
  
  //分页加载
	function getScrollTop() { 
		var scrollTop = 0; 
		if (document.documentElement && document.documentElement.scrollTop) { 
			scrollTop = document.documentElement.scrollTop; 
		}else if (document.body) { 
			scrollTop = document.body.scrollTop; 
		} 
		return scrollTop; 
	} 
	
	//获取当前可是范围的高度 
	function getClientHeight() { 
		var clientHeight = 0; 
		if (document.body.clientHeight && document.documentElement.clientHeight) { 
			clientHeight = Math.min(document.body.clientHeight, document.documentElement.clientHeight); 
		}else { 
			clientHeight = Math.max(document.body.clientHeight, document.documentElement.clientHeight); 
		} 
		return clientHeight; 
	} 
	
	//获取文档完整的高度 
	function getScrollHeight() { 
		return Math.max(document.body.scrollHeight, document.documentElement.scrollHeight); 
	} 
	var flag = false;//上拉加载的开关
	var page = 1; //页码
	window.onscroll= function () { 
		if (getScrollTop() + getClientHeight() == getScrollHeight()) { 
			if(flag){
				return false;
			}
			flag = true;
			var nextpage = page+1;//下一页
			var url="<?php echo U('SaleManager/custom',array('token'=>$token,status=>$status,'Tel'=>$Tel,'times'=>$times));?>";
			$.ajax({
				type:'get',
				url:url+"&t="+Math.random(),
				dataType:"json",
				data:{'page':nextpage,'is_ajax':1},
				success: function(datas){
							if(datas.status==1){
								//返回的列表个数
								var length=datas.data.length;
								//定义需要显示的字符串
								var str="";
								if(length<1){
									str = '<div class="my_client_cli" style="background-color:#fff;">没有更多了</div>';
									$(".my_client_").append(str);
									return false;
								}
								for(var i=0;i<length;i++){
									var id=parseInt(datas.data[i].ID);
									str += '<div class="my_client_cli"><a href="<?php echo U('SaleManager/custominfo',array('token'=>$token));?>&id='+id+'">;
									if(datas.data[i].Stutas == 1){
										str += '<span class="my_client_name w30">'+datas.data[i].Name+'</span><span class="my_client_phone w40">'+datas.data[i].Tel+'</span><span  class="my_client_day w30">'+datas.data[i].SrTime+'</span>';
									}else{
										str += '<span class="my_client_name w25">'+datas.data[i].kh_name+'</span><span class="my_client_phone w30">'+datas.data[i].Tel+'</span><span  class="my_client_day w25">'+datas.data[i].zy_name+'</span><span  class="my_client_name w20"><span class="daofang_a__">'+datas.data[i].salesstatus+'</span>';
									}
									str += '</a></div>';
								}
								$(".my_client_").append(str);
								page = datas.info;//当前页码
								flag = false;
							}
						  }
			});
				 
		} 
	
	}
</script>
</html>