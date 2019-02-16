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

<link href="<?php echo RES;?>/css/defstyel.css?v=<?php echo ($vtime); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo RES;?>/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script>
var imgUrl = "<?php echo ($shareinfo["shareimg"]); ?>";
var lineLink = "<?php echo ($url); ?>";
var descContent = "<?php echo ($shareinfo["sharecontent"]); ?>";
var shareTitle = "<?php echo ($shareinfo["sharetitle"]); ?>";
var appid = '';
function shareFriend() {
    WeixinJSBridge.invoke('sendAppMessage',{
        "appid": appid,
        "img_url": imgUrl,
        "img_width": "200",
        "img_height": "200",
        "link": lineLink,
        "desc": descContent,
        "title": shareTitle
    }, function(res) {
    })
}
function shareTimeline() {
    WeixinJSBridge.invoke('shareTimeline',{
        "img_url": imgUrl,
        "img_width": "200",
        "img_height": "200",
        "link": lineLink,
        "desc": descContent,
        "title": shareTitle
    }, function(res) {
    });
}
function shareWeibo() {
    WeixinJSBridge.invoke('shareWeibo',{
        "content": descContent,
        "url": lineLink,
    }, function(res) {
    });
}
// 当微信内置浏览器完成内部初始化后会触发WeixinJSBridgeReady事件。
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
    // 发送给好友
    WeixinJSBridge.on('menu:share:appmessage', function(argv){
        shareFriend();
    });
    // 分享到朋友圈
    WeixinJSBridge.on('menu:share:timeline', function(argv){
        shareTimeline();
    });
    // 分享到微博
    WeixinJSBridge.on('menu:share:weibo', function(argv){
        shareWeibo();
    });
}, false);

</script>
</head>

<body>
	<div class=" personal_hearder" >
        
    	<a href="<?php echo U('Agent/myInfo',array('token'=>$jjrinfo['Token']));?>"><div class="personal_portrait touxianga"></div></a>
		<!-- <a href="<?php echo U('Agent/myInfo',array('token'=>$jjrinfo['Token']));?>"  class="jjr_sz">
			<img src="<?php echo RES;?>/img/cnt_ico.png">
		</a> -->
        <div  class="personal_petname" style="float:none;line-height:40px;"><?php echo ($jjrinfo["Name"]); ?></div>

        <div  class="personal_client" style="height:20px;line-height:20px;"><?php echo ($date["usersname"]); ?></div>

        <div class="personal_message" style="min-width:100px;" >

        	<div class="personal_client">
            	推荐人数
                <span class="personal_client_" style="border-right:none;"><?php echo (($countkh)?($countkh):0); ?></span>
            </div>
        	<div class="personal_client"  style="display:none;">
            	总佣金
                <span class="personal_brokerage"><?php echo (($allcount)?($allcount):0); ?></span>
            </div> <br><br> 

            <!-- <div style="width:100%;margin:auto; text-align:left; margin-top:25px; line-height:25px; color:rgba(0,0,0,1); font-family:Arial; font-size:12px;"> <span style="display:inline-block; float；left; width:55%; height:25px; overflow:hidden;  white-space:nowrap; ">积分：<?php echo (($jjrinfo["credit"])?($jjrinfo["credit"]):0); ?></span>
                <span style="display:inline-block; float；left; width:3%; height:25px; overflow:hidden; text-align:center;"> | </span>
                <a href="<?php echo U('Store/cats',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" style="display:inline-block; float；left; width:38%; height:25px; overflow:hidden;">&nbsp;&nbsp;积分商城 </a>
            </div> -->
        </div>
    </div>
    
     <nav>      
        <a href="<?php echo U('Agent/addCustom',array('token'=>$_GET['token']));?>" class="navbut">
            <img src="<?php echo RES;?>/img/nav_RCM.jpg"  >
        </a>
        <a href="<?php echo U('Agent/myCustom',array('token'=>$_GET['token'],'JJ_id'=>$jjrinfo['ID']));?>" class="navbut">
            <img src="<?php echo RES;?>/img/nav_CLi.jpg"  >
        </a>
        <a href="<?php echo U('Agent/commission',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'JJ_id'=>$jjrinfo['ID']));?>" class="navbut" style="display:none;">
            <img src="<?php echo RES;?>/img/nav_CMM.jpg"  >
        </a>
        <a href="<?php echo U('Agent/rule',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'JJ_id'=>$jjrinfo['ID']));?>" class="navbut" style="display:none;">
            <img src="<?php echo RES;?>/img/nav_RUL.jpg"  >
        </a>
        <!-- <a href="<?php echo U('Agent/credit',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'JJ_id'=>$jjrinfo['ID']));?>" class="navbut">
            <img src="<?php echo RES;?>/img/nav_INT.jpg" style="border-radius:5px;" >
        </a>
        <a href="<?php echo U('Store/cats',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" class="navbut">
            <img src="<?php echo RES;?>/img/nav_MAL.jpg" style="border-radius:5px;" >
        </a> -->
    </nav>
    
    
    <div class="sale_"  id="dady">
        
    <p class="headline"></p>
        <?php if(is_array($lpinfo)): $i = 0; $__LIST__ = $lpinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Agent/loupanInfo',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$vo['id']));?>">
                <img style="width:100%;height:200px;" src="<?php echo ($vo["LouPanUpLoad"]); ?>" >
                <span class="salespan" ><?php echo ($vo["LouPanTitle"]); ?></span>
                <p  class="personal_yjk">佣金：<span class="personal_fand"><?php echo ($vo["commission"]); ?></span></p>
                <p  class="personal_yjk">奖励：<span class="personal_fand"><?php echo ($vo["encourage"]); ?></span></p>
            </a><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <input type="hidden" value="<?php echo ($num); ?>" id="num">
    <p class="personal_bz" style="text-align:center"><span id="ts"></span></p>
	
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
<script type="text/javascript">
    //获取滚动条当前的位置 
    window.onload=function(){
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
        window.onscroll= function () { 
            if (getScrollTop() + getClientHeight() == getScrollHeight()) { 
                var num=document.getElementById('num').value;
                var url="<?php echo U('Agent/ajaxlp',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>";
                $.ajax({
                    type:'post',
                    url:url+"&t="+Math.random(),
                    dataType:"json",
                    data:{'num':num},
                    success: function(datas){
                                if(datas.status==1){
                                    //返回的列表个数
                                    var length=datas.data.length;
                                    //定义需要显示的字符串
                                    var str="";
                                    for(var i=0;i<length;i++){
                                        var id=parseInt(datas.data[i].id);
                                        str+="<a href=\"<?php echo U('Agent/loupanInfo',array('token'=>'"+datas.data[i].token+"','wecha_id'=>$_GET['wecha_id'],'id'=>'"+id+"'));?>\">";
                                        str+="<img style='width:100%;height:200px;' src='"+datas.data[i].LouPanUpLoad+"'>";
                                        str+="<span class='salespan'>"+datas.data[i].LouPanTitle+"</span>";
                                        str+="<p class='personal_yjk'>佣金：<span class='personal_fand'>"+datas.data[i].commission+"</span></p>";
                                        str+="<p class='personal_yjk'>奖励：<span class='personal_fand'>"+datas.data[i].encourage+"</span></p>";
                                        
                                        str+="</a>";
                                        document.getElementById("dady").innerHTML+=str;
                                        document.getElementById('num').value=parseInt(length)+parseInt(num);
                                    }
                                }
                              }
                });
                     
            } 
        
        }
    }
     
</script>
</html>