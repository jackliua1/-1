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
<link href="<?php echo RES;?>/css/nestyle.css" rel="stylesheet" type="text/css">
</head>

<body>
	<!--返回上一页-->
	<div class="goback">
		<a href="javascript:history.go(-1);">&nbsp;&nbsp;<&nbsp;&nbsp;</a>
		我的客户
	</div>
	<p  class="mid_reg"> </p>
	<!--返回上一页-->
	<!-- <p  class="mid_reg">我的客户</p> -->
	 
     <div class="mykh_top">
     	
		<?php if($status == 1): ?><div class="top_newkh_">
			报备客户
		<?php else: ?>
		<div class="top_newkh">
			<a href="<?php echo U('Zhiye/newcustom',array('token'=>$token,'status'=>1));?>">报备客户</a><?php endif; ?>
		</div> 
     	
		 <?php if($status == 2): ?><div class="top_nowkh_">
			带看客户
		 <?php else: ?>
     	<div class="top_nowkh">
            <a href="<?php echo U('Zhiye/newcustom',array('token'=>$token,'status'=>2));?>">带看客户</a><?php endif; ?>
        </div> 
		
		 <?php if($status == 3): ?><div class="top_ovekh_">
			成交客户
		<?php else: ?>
     	<div class="top_ovekh">
            <a href="<?php echo U('Zhiye/newcustom',array('token'=>$token,'status'=>3));?>">成交客户</a><?php endif; ?>
        </div>
		
     </div>
	 
	<div class="search_div">
		<form action="<?php echo U('Zhiye/newcustom',array('token'=>$token,'status'=>$status));?>" method="post">
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
        
         <!--新客户-->
  		  <div id="newkh" class="my_client_" style="min-height:200px; width:90%;">  
            <?php if($kh == ''): ?><div class="mykh_cli" style="background-color:#fff;">
                    暂无新客户
                </div>   
            <?php else: ?>
                <?php if(is_array($kh)): $i = 0; $__LIST__ = $kh;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="mykh_cli" style="background-color:#fff;">
                  <a href="<?php echo U('Zhiye/newcustominfo',array('token'=>$token,'id'=>$vo['ID']));?>">
					<span class="my_client_name w35"><?php echo ($vo["LouPanTitle"]); ?></span>
                    <span class="my_client_name w25"><?php echo ($vo["Name"]); ?></span>
                   
				 <?php if($vo["Stutas"] == 1): ?><span class="my_client_phone w40"><?php echo ($vo["Tel"]); ?></span></a>
				<?php else: ?>
					</a><a href="tel:<?php echo ($vo["Tel"]); ?>"><span class="my_client_phone w40"><?php echo ($vo["Tel"]); ?></span></a><?php endif; ?>
                    <span  class="my_client_name"  style=" width:25%;display:none;">
                     <!-- <a href="tel:<?php echo ($vo["Tel"]); ?>" class="mykhhk_a" style="background:url(<?php echo RES;?>/img/dh.jpg) no-repeat; height:29px; margin-top:8px;"> </a> -->
					 <a href="javascript:void(0);" class="mykhhk_a" style="background:url(<?php echo RES;?>/img/dh.jpg) no-repeat; height:29px; margin-top:8px;"> </a>
                    </span>
                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>

        </div>
            
</body>
 <script type="text/javascript">
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
			var url="<?php echo U('Zhiye/newcustom',array('token'=>$token,status=>$status,'Tel'=>$Tel,'times'=>$times));?>";
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
									str = '<div class="mykh_cli" style="background-color:#fff;">没有更多了</div>';
									$(".my_client_").append(str);
									return false;
								}
								for(var i=0;i<length;i++){
									var id=parseInt(datas.data[i].ID);
									str += '<div class="mykh_cli" style="background-color:#fff;"><a href="<?php echo U('Zhiye/newcustominfo',array('token'=>$token));?>&id='+id+'"><span class="my_client_name w35">'+datas.data[i].LouPanTitle+'</span><span class="my_client_name w25">'+datas.data[i].Name+'</span>';
									if(datas.data[i].Stutas == 1){
										str += '<span class="my_client_phone w40">'+datas.data[i].Tel+'</span></a>';
									}else{
										str += '</a><a href="'+datas.data[i].Tel+'"><span class="my_client_phone w40">'+datas.data[i].Tel+'</span></a>';
									}
									str += '</div>';
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