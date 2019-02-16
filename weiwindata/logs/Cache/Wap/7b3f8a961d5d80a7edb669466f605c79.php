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
		
        .zhezhao{
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.2);
            display: none;
        }
        .zhezhao_div{
            width: 200px;
            height: 200px;
            position: fixed;left: 50%; top: 25%;
            margin-left: -100px;
        }
		.zhezhao_div img{
            width: 100%;
        }
    </style>
	
<link href="<?php echo RES;?>/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RES;?>/css/nestyle.css?v=<?php echo ($vtime); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo RES;?>/css/defstyel.css?v=<?php echo ($vtime); ?>" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
    <!--<script type="text/javascript" src="<?php echo RES;?>/css/js/login.js"></script>-->

    <!--<link rel="stylesheet" type="text/css"  href="<?php echo RES;?>/css/css/style.css"/>-->
</head>
<body>
	<!--遮罩层-->
	<div class="zhezhao">
		<div class="zhezhao_div">
			<img src="">
		</div>
	</div>
	<!--遮罩层-->

	<!--返回上一页-->
	<div class="goback">
		<a href="javascript:history.go(-1);">&nbsp;&nbsp;<&nbsp;&nbsp;</a>
		我的客户
	</div>
	<!--返回上一页-->
	<p  class="mid_reg"> </p>
    <!-- <div  class="my_client_mycl">
     我的客户
     </div> -->
    <div class="search_div">
		<form action="<?php echo U('Agent/myCustom',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'JJ_id'=>$_GET['JJ_id']));?>" method="post">
			<select name="times" class="times">
				<option value="0" <?php if($times == 0): ?>selected<?php endif; ?>>全部</option>
				<option value="1" <?php if($times == 1): ?>selected<?php endif; ?>>一星期</option>
				<option value="2" <?php if($times == 2): ?>selected<?php endif; ?>>一个月</option>
				<option value="3" <?php if($times == 3): ?>selected<?php endif; ?>>一年内</option>
			</select>
		   <input type="tel" name="Tel" placeholder="请输入您的电话" value="<?php echo ($Tel); ?>" id="tel" class="sear_inp">
			<input type="submit" value="搜索" class="sear_btn">
		</form>
	</div>
    
    <div class="my_client_">  
    	<div class="my_client_top">  	
            <span class="my_client_name" style="width:20%;">姓名</span>
            <span class="my_client_phone" style="width:30%;">电话</span>
            <span class="my_client_lp" style="width:30%;">消费需求</span>
             <!--<span  class="my_client_day" style="color:#666;" >日期</span>-->
            <span  class="my_client_status" style="width:20%;">状态</span>
        </div>
		<div class="content">
        <?php if($list == null): ?><div class="my_client_cli">
                您还没有客户哦，赶快推荐您的客户吧
            </div>
        <?php else: ?> 
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="my_client_cli" id="daof_" style="display:block">
                    <span class="my_client_name" style="width:20%;"><?php echo ($vo["Name"]); ?></span>
                    <span class="my_client_phone" style="width:30%;"><a href="tel:<?php echo ($vo["Tel"]); ?>"><?php echo ($vo["Tel"]); ?></a></span>
                    <span class="my_client_lp" style="width:30%;"><?php echo ($vo["LouPanTitle"]); ?></span>
                    <!-- <span  class="my_client_day" ><?php echo (date("Y.m.d",$vo["SrTime"])); ?></span> -->
                   
                    <span  class="my_client_status" style="width:20%;">
					
					<?php if($vo['sort'] == 0): ?><input type="button" id="sub_btn" class="sub_btn btn" style="background-color: #2D86E4;color: #fff;border: none;border-radius: 5px;font-size: 12px;height: 20px;line-height: 20px;" value="二维码" data-id ="<?php echo ($vo["ID"]); ?>"/>
					<?php else: ?>
						<a href="#" class="my_client_a"><?php echo ($vo["salesstatus"]); ?></a><?php endif; ?>
                   <!--<a href = "<?php echo U('Zhiye/getWeimas',array('token'=>$vo['Token'],'wecha_id'=>$vo['Wecha_id'],'id'=>$vo['ID']));?>" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'"><?php echo ($vo["salesstatus"]); ?></a>-->
        <!--<input type="hidden" name="name" id="name" value="<?php echo ($vo["ID"]); ?>">-->

                    </span>
                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </div>
    </div>
<!--<div id="showbox_yxlp" class="showbox_yxlp" style="display:none;" >-->
    <!--<div class="khxq_fwcj">-->
        <!--<div id="khxq_close" > </div>-->
        <!--成交价格-->
        <!--<form action="<?php echo U('Zhiye/newcusprice',array('token'=>$kh['Token'],'wecha_id'=>$kh['Wecha_id'],'Stutas'=>$vo['id'],'id'=>$kh['ID']));?>" method="post">-->
            <!--<input type="text" value="<?php echo ($datas["salesvalue"]); ?>"  class="khxq_qian" name="salesvalue" id="salesvalue"/>-->
            <!--<input type="text" value="<?php echo ($datas["salesvalues"]); ?>"  class="khxq_qian" name="salesvalues" id="salesvalues"/>-->
            <!--<input type="text" value="0"  class="khxq_qian" name="salesvaluew" id="salesvaluew"/>-->
            <!--<input type="submit" class="khxq_bc" onclick="return check()" value="保存">-->
        <!--</form>-->
    <!--</div>-->
<!--</div>-->
<div id="light" class="white_content">
    <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">X</a>
    <div>
        <!--<a href="#" class="my_client_a"><?php echo ($vo["salesstatus"]); ?></a>-->
    </div>
</div>
<div id="fade" class="black_overlay"></div>

	<style>
a {
    text-decoration: none;
}
ul,p{
	margin:0px;
	padding:0px;
}
.wt_ul1 {
    position: fixed;
    width: 100%;
    height: 60px;
    background-color: #ffffff;
    z-index: 999;
    bottom: 0;
    left: 0;
    border-top: 1px solid #e4e4e4;
}
li {
    list-style: none;
}
.wt_li1_a {
    float: left;
    width: 33%;
    height: 60px;
    text-align: center;
}
.wt_ul1 li {
    position: relative;
}
.nav_active p i, .nav_active p span {
    color: #33ccff;
}
.div_footer{
	margin-bottom:60px;
}
</style>
<div class="div_footer"></div>
<ul class="wt_ul1">
	<?php if(ACTION_NAME == 'ydl'): ?><li class="wt_li1_a nav_active">
	<?php else: ?>
	<li class="wt_li1_a"><?php endif; ?>
        <a href="<?php echo U('Agent/ydl',array('token'=>$token));?>">
            <p style="margin-top: 10px;">
				<i class="fa fa-home fa-2x"></i>
			</p>
			<p class="wt_p2">
				<span>首页</span>
			</p>
        </a>
            
    </li>
    <?php if(ACTION_NAME == 'myCustom'): ?><li class="wt_li1_a nav_active">
	<?php else: ?>
	<li class="wt_li1_a"><?php endif; ?>
        <a href="<?php echo U('Agent/myCustom',array('token'=>$token,'JJ_id'=>$jjrinfo['ID']));?>">
            <p style="margin-top: 10px;">
                <i class="fa fa-sitemap fa-2x"></i>
            </p>
            <p class="wt_p2">
                <span>我的客户</span>
            </p>
        </a>
    </li>
    <?php if(ACTION_NAME == 'myInfo'): ?><li class="wt_li1_a nav_active">
	<?php else: ?>
	<li class="wt_li1_a"><?php endif; ?>
		<a href="<?php echo U('Agent/myInfo',array('token'=>$token));?>">
			<p style="margin-top: 10px;">
				<i class="fa fa-user-o fa-2x"></i>
			</p>
			<p class="wt_p2">
				<span>个人中心</span>
			</p>
		</a> 
    </li>
</ul>
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

        //var getname=GETname("khxq_zt");
        //for(i in  getname){
        //    getname[i].onclick=function(){
        //        if(this.title=='回款'){
        //            GETdiv("showbox_yxlp").style.display="block";
        //        }else{
        //            this.style.display="none";
        //       }
        //    }
        //}

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
                var url="<?php echo U('Agent/myCustom',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'JJ_id'=>$_GET['JJ_id'],'Tel'=>$Tel,'times'=>$times));?>";
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
										str = '<div class="my_client_cli">没有更多了</div>';
										$(".content").append(str);
										return false;
									}
                                    for(var i=0;i<length;i++){
                                        var id=parseInt(datas.data[i].id);
										str += '<div class="my_client_cli" id="daof_" style="display:block"><span class="my_client_name" style="width:20%;">'+datas.data[i].Name+'</span><span class="my_client_phone" style="width:30%;"><a href="'+datas.data[i].Tel+'">'+datas.data[i].Tel+'</a></span><span class="my_client_lp" style="width:30%;">'+datas.data[i].LouPanTitle+'</span><span  class="my_client_status" style="width:20%;">';
										if(datas.data[i].sort == 0){
											str += '<input type="button" id="sub_btn" class="btn sub_btn" style="background-color: #2D86E4;color: #fff;border: none;border-radius: 5px;font-size: 12px;height: 20px;line-height: 20px;" value="二维码" data-id="'+datas.data[i].ID+'" />';
										}else{
											str += '<a href="#" class="my_client_a">'+datas.data[i].salesstatus+'</a>';
										}
										str += '</span></div>';
                                    }
                                    $(".content").append(str);
									page = datas.info;//当前页码
									flag = false;
                                }
                              }
                });
                     
            } 
        
        }
		
    }

	

	$(".content").on('click',".sub_btn",function() {
		var texts = $(this).attr("data-id");
		var url="<?php echo U('Agent/getWeimas',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>";
			$.ajax({
				type:'post',
				url:url+"&t="+Math.random(),
				dataType:"json",
				data:{'texts':texts},
				success: function(datas){
					var path = 'data:image/png;base64,'+datas.data;
				  //给img的sec赋值。
					$(".zhezhao_div img").attr('src',path);
					$(".zhezhao").show();
			  },
			  error:function(datas){
				//console.log(datas);
					//$(".zhezhao_div img").attr('src',datas.responseText);
					//$(".zhezhao_div").html(datas);
					//$(".zhezhao").show();
			  } 
			});
	});
	$(".zhezhao").on("click",function(){
		$(".zhezhao_div img").attr('src','');
		$(".zhezhao").hide();
	})

</script>
</html>