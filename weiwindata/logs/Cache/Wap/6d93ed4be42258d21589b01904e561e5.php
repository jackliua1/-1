<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
<meta content="telephone=no" name="format-detection">
<meta name="keywords" content="客带客，买房，看房，房地产">
<meta name="description" content="客带客是中国领先的房地产综合营运商。公司于2003年6月19日在香港联合交易所主板上市，综合实力居国内领先地位，目前已进入全国四大区域十三个城市，土地储备规模超过1000万平方米，有相当高的市场知名度和品牌影响力。">
<title></title>
    <style>
        .black_overlay{
            display: none;
            position: absolute;
            top: 0%;
            left: 0%;
            width: 100%;
            height: 100%;
            /*background-color: black;*/
            z-index:1001;
            -moz-opacity: 0.8;
            opacity:.80;
            filter: alpha(opacity=88);
        }
        .white_content {
            display: none;
            position: absolute;
            top: 25%;
            left: 43%;
            width: 15%;
            height: 30%;
            padding: 5px;
            /*border: 10px solid orange;*/
            background-color: white;
            z-index:1002;
            overflow: auto;
        }
		.search_div{
			margin-top: 10px;
			text-align: center;
		}
		.sear_inp{
			height: 24px;
			line-height: 24px;
			border-radius: 5px;
			border: none;
		}
		.sear_btn{
			height: 24px;
			line-height: 24px;
			border-radius: 5px;
			border: none;
			background-color: #2D86E4;
			color: #fff;
		}
    </style>
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
    <link href="<?php echo RES;?>/css/nestyle.css" rel="stylesheet" type="text/css">
<link href="<?php echo RES;?>/css/defstyel.css" rel="stylesheet" type="text/css">

</head>
 
	<!--返回上一页-->
	<div class="goback">
		<a href="javascript:history.go(-1);">&nbsp;&nbsp;<&nbsp;&nbsp;</a>
		我的客户
	</div>
	<p  class="mid_reg"> </p>
	<!--返回上一页-->
	<!-- <p  class="mid_reg"> </p>
    <div  class="my_client_mycl">
    客户报名列表
     </div> -->
	<div class="search_div">
		<form action="<?php echo U('Manager/myCustom',array('token'=>$token,'status'=>$status));?>" method="post">
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
    <div class="my_client_">  
    	<div class="my_client_top">  	
            <span class="my_client_name w25">客户姓名</span>
            <span class="my_client_phone w30">客户电话</span>
             <span  class="my_client_phone w20">经纪人</span>
            <span  class="my_client_status w25"><?php if($status == 1): ?>创建时间<?php elseif($status == 2): ?>到访时间<?php else: ?>成交时间<?php endif; ?></span>
        </div>
        <?php if($list == null): ?><div class="my_client_cli">
                您还没有客户哦，赶快推荐您的客户吧
            </div>
        <?php else: ?>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="my_client_cli" id="daof_" style="display:block">
					<a href="<?php echo U('Manager/custominfo',array('token'=>$token,'id'=>$vo['ID']));?>">
                    <span class="my_client_name w25"><?php echo ($vo["Name"]); ?></span>
					<?php if($vo["Stutas"] > 2): ?></a>
                    <span class="my_client_phone w30">
						<a href="tel:<?php echo ($vo["Tel"]); ?>"><?php echo ($vo["Tel"]); ?></a>
					</span>
					<a href="<?php echo U('Manager/custominfo',array('token'=>$token,'id'=>$vo['ID']));?>">
					<?php else: ?>
					<span class="my_client_phone w30">
						<?php echo ($vo["Tel"]); ?>
					</span><?php endif; ?>
					
                    <span class="my_client_name w20"><?php echo ($vo["jjrname"]); ?></span>
                     <span  class="my_client_day w25"><?php echo ($vo["showtime"]); ?></span>
					 </a>
                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        
    </div>
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
			var url="<?php echo U('Manager/myCustom',array('token'=>$token,status=>$status,'Tel'=>$Tel,'times'=>$times));?>";
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
									str += '<div class="my_client_cli" id="daof_" style="display:block"><a href="<?php echo U('Manager/custominfo',array('token'=>$token));?>&id='+id+'"><span class="my_client_name w25">'+datas.data[i].Name+'</span>';
									if(datas.data[i].Stutas >2 ){
										str += '</a><span class="my_client_phone w30"><a href="tel:'+datas.data[i].Tel+'">'+datas.data[i].Tel+'</a></span><a href="<?php echo U('Manager/custominfo',array('token'=>$token));?>&id='+id+'">';
									}else{
										str += '<span class="my_client_phone w30">'+datas.data[i].Tel+'</span>';
									}
									str += '<span class="my_client_name w20">'+datas.data[i].jjrname+'</span><span  class="my_client_day w25">'+datas.data[i].showtime+'</span></a>';
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