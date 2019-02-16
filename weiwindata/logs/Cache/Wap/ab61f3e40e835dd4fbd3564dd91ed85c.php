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
	<div class=" personal_hearder" >
        <a href="<?php echo U('Manager/myinfo',array('token'=>$token));?>">
    	<div class="personal_portrait touxianga"></div>
		</a>
        <div  class="personal_petname"><?php echo ($date["areaName"]); ?></div>
    </div>
    
     <nav>      
        <a href="<?php echo U('Manager/jingji',array('token'=>$_GET['token']));?>" class="navbut">
            <img src="<?php echo RES;?>/img/nav_RCMs.jpg"  ><br>

        </a>
        <a href="<?php echo U('Manager/myCustom',array('token'=>$_GET['token'],'status'=>1));?>" class="navbut">
            <img src="<?php echo RES;?>/img/nav_RCMse.jpg"  ><br>

        </a>
        <a href="<?php echo U('Manager/myCustom',array('token'=>$_GET['token'],'status'=>2));?>" class="navbut">
            <img src="<?php echo RES;?>/img/nav_RCMd.jpg"  ><br>

        </a>
        <a href="<?php echo U('Manager/myCustom',array('token'=>$_GET['token'],'status'=>3));?>" class="navbut">
            <img src="<?php echo RES;?>/img/nav_RCMr.jpg"  ><br>
        </a>
        
    </nav>
    
    <input type="hidden" value="<?php echo ($num); ?>" id="num">
    <p class="personal_bz" style="text-align:center"><span id="ts"></span></p>
</body>
<script type="text/javascript">
    
     
</script>
</html>