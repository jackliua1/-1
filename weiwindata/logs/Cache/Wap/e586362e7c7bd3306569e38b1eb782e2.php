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
		.search_div .sear_inp{
			width:70%;
			text-indent: 10px;
		}
		.search_div .sear_btn{
			width:20%;
		}
    </style>
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
    <link href="<?php echo RES;?>/css/nestyle.css" rel="stylesheet" type="text/css">
<link href="<?php echo RES;?>/css/defstyel.css" rel="stylesheet" type="text/css">
    <!--<script type="text/javascript" src="<?php echo RES;?>/css/js/jquery-1.11.2.min.js"></script>-->
    <!--<script type="text/javascript" src="<?php echo RES;?>/css/js/login.js"></script>-->

    <!--<link rel="stylesheet" type="text/css"  href="<?php echo RES;?>/css/css/style.css"/>-->
</head>
 <!--返回上一页-->
	<div class="goback">
		<a href="javascript:history.go(-1);">&nbsp;&nbsp;<&nbsp;&nbsp;</a>
		经纪人列表
	</div>
	<p  class="mid_reg"> </p>
	<!--返回上一页-->
   <!--  <div  class="my_client_mycl">
    经纪人列表
     </div> -->
    <div class="search_div">
		<form action="#" method="post">
		   <input type="tel" name="Tel" placeholder="请输入经纪人电话" value="<?php echo ($Tel); ?>" id="tel" class="sear_inp">
			<input type="submit" value="搜索" class="sear_btn">
		</form>
	</div>
    
    <div class="my_client_">  
    	<div class="my_client_top">  	
            <span class="my_client_name w20">姓名</span>
            <span class="my_client_phone w25">电话</span>
            <span class="my_client_lp w30">经纪公司</span>
            <span  class="my_client_status w25">时间</span>
        </div>
        <?php if($list == null): ?><div class="my_client_cli">
                您还没有管辖的经纪人
            </div>
        <?php else: ?> 
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="my_client_cli" id="daof_" style="display:block">
                    <span class="my_client_name w20"><?php echo ($vo["Name"]); ?></span>
                    <span class="my_client_phone w25"><a href="tel:<?php echo ($vo["Tel"]); ?>"><?php echo ($vo["Tel"]); ?></a></span>
                    <span class="my_client_lp w30"><?php echo ($vo["usersname"]); ?></span>
                     <span  class="my_client_day w25" ><?php echo ($vo["Mtime"]); ?></span>
                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        
    </div>
<div id="light" class="white_content">
    <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">X</a>
    <div>
        <!--<a href="#" class="my_client_a"><?php echo ($vo["salesstatus"]); ?></a>-->
    </div>
</div>
<div id="fade" class="black_overlay"></div>
<body>
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
//        GETdiv("khxq_close").onclick=function(){GETdiv("showbox_yxlp").style.display="none";}
        // GETdiv("huik").onclick=function(){GETdiv("showbox_yxlp").style.display="block";}
        // GETdiv("khxq_bc").onclick=function(){GETdiv("showbox_yxlp").style.display="none"; }
        // GETdiv("huik").style.display="none";  GETdiv("huik_").style.display="block";}
 
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
			var url="<?php echo U('Manager/jingji',array('token'=>$token,'Tel'=>$Tel));?>";
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
									str += '<div class="my_client_cli" id="daof_" style="display:block"><span class="my_client_name w20">'+datas.data[i].Name+'</span><span class="my_client_phone w25"><a href="tel:'+datas.data[i].Tel+'">'+datas.data[i].Tel+'</a></span><span class="my_client_lp w30">'+datas.data[i].usersname+'</span><span  class="my_client_day w25" >'+datas.data[i].Mtime+'</span></div>';
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