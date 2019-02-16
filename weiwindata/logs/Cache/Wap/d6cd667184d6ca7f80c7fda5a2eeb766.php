<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
<meta content="telephone=no" name="format-detection">
<meta name="keywords" content="首创置业，买房，看房，房地产">
<meta name="description" content="首创置业是中国领先的房地产综合营运商。公司于2003年6月19日在香港联合交易所主板上市，综合实力居国内领先地位，目前已进入全国四大区域十三个城市，土地储备规模超过1000万平方米，有相当高的市场知名度和品牌影响力。">
<title></title>

<link href="<?php echo RES;?>/css/defstyel.css" rel="stylesheet" type="text/css">
<script>
var imgUrl = "";
var lineLink = "<?php echo ($url); ?>";
var descContent = "我是<?php echo ($jjrinfo['Name']); ?>，我推荐您去<?php echo ($lpinfo['LouPanTitle']); ?>看看，可电话联系:<?php echo ($jjrinfo['Tel']); ?> 预约看房。";
var shareTitle = "邀请函";
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
	<!--返回上一页-->
	<div class="goback">
		<a href="javascript:history.go(-1);">&nbsp;&nbsp;<&nbsp;&nbsp;</a>
		邀请函
	</div>
	<p  class="mid_reg"> </p>
	<!--返回上一页-->
	<div class="activity_box">邀请函
    	<div  class="activity_box_cli" >
    		<?php if($type == 1): ?><p class="agreement_content"><?php echo ($khinfo['Name']); ?>您好：</p>
        		<p class="agreement_content">我是<?php echo ($jjrinfo['Name']); ?>，我推荐您去<?php echo ($lpinfo['LouPanTitle']); ?>看看，如果您有兴趣购买，可电话联系:<?php echo ($jjrinfo['Tel']); ?> 预约看房。</p>
        	<?php else: ?>
        		<p class="agreement_content">姓名：<?php echo ($khinfo['Name']); ?></p>
        		<p class="agreement_content">消费需求：<?php echo ($lpinfo['LouPanTitle']); ?></p>
        		<p class="agreement_content">优惠政策：<?php echo ($lpinfo['traffic']); ?></p><?php endif; ?>

         </div>
    </div>

</body>
</html>