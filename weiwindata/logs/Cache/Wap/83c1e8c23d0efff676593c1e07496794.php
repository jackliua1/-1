<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
<meta content="telephone=no" name="format-detection">
<meta name="keywords" content="首创置业，买房，看房，房地产">
<meta name="description" content="首创置业是中国领先的房地产综合。公司于2003年6月19日在香港联合交易所主板上市，综合实力居国内领先地位，目前已进入全国四大区域十三个城市，土地储备规模超过1000万平方米，有相当高的市场知名度和品牌影响力。">
<title></title>
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<link href="<?php echo RES;?>/css/defstyel.css" rel="stylesheet" type="text/css">
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
	<a href="<?php echo U('Agent/register',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" class="topbanner">
    	<img src="<?php echo RES;?>/img/banner.png"  >
    </a>
    
    <nav>    	
        <a href="<?php echo U('Agent/register',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" class="navbut">
            <img src="<?php echo RES;?>/img/nav_RCM.jpg"  >
        </a>
        <a href="<?php echo U('Agent/register',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" class="navbut">
            <img src="<?php echo RES;?>/img/nav_CLi.jpg"  >
        </a>
        <a href="<?php echo U('Agent/register',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" class="navbut">
            <img src="<?php echo RES;?>/img/nav_CMM.jpg"  >
        </a>
        <a href="<?php echo U('Agent/register',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" class="navbut">
            <img src="<?php echo RES;?>/img/nav_RUL.jpg"  >
        </a>
       <!--  <a href="<?php echo U('Agent/register',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" class="navbut">
            <img src="<?php echo RES;?>/img/nav_INT.jpg" style="border-radius:5px;" >
        </a>
        <a href="<?php echo U('Agent/register',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" class="navbut">
            <img src="<?php echo RES;?>/img/nav_MAL.jpg" style="border-radius:5px;" >
        </a> -->
    </nav>
    
    
    <div class="sale_"  id="dady">
    	
    <p class="headline"></p>
		<?php if(is_array($lpinfo)): $i = 0; $__LIST__ = $lpinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Agent/loupanInfo',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$vo['id'],'type'=>3));?>">
                <img style="width:100%;height:200px;" src="<?php echo ($vo["LouPanUpLoad"]); ?>" >
                <span class="salespan" ><?php echo ($vo["LouPanTitle"]); ?></span>
                <p  class="personal_yjk">佣金：<span class="personal_fand"><?php echo ($vo["commission"]); ?></span></p>
                <p  class="personal_yjk">奖励：<span class="personal_fand"><?php echo ($vo["encourage"]); ?></span></p>
            </a><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <input type="hidden" value="<?php echo ($num); ?>" id="num">
    <p class="personal_bz" style="text-align:center"><span id="ts"></span></p>
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
                                        str+="<a href=\"<?php echo U('Agent/loupanInfo',array('token'=>'"+datas.data[i].token+"','wecha_id'=>$_GET['wecha_id'],'id'=>'"+id+"','type'=>3));?>\">";
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