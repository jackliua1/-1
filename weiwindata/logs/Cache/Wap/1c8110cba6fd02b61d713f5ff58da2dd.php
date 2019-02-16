<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta content="telephone=no" name="format-detection">
<meta name="keywords" content="客带客，买房，看房，房地产">
<meta name="description" content="客带客是中国领先的房地产综合。公司于2003年6月19日在香港联合交易所主板上市，综合实力居国内领先地位，目前已进入全国四大区域十三个城市，土地储备规模超过1000万平方米，有相当高的市场知名度和品牌影响力。">
<title><?php echo ($lpinfo["LouPanAddress"]); ?></title>
<link href="<?php echo RES;?>/css/defstyel.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<style type="text/css"> 
    #container{height:100%}

    .building_centext img{ margin: 20px 0px 20px 0px;}
</style>
<script>
var imgUrl = "<?php echo ($lpinfo["LouPanUpLoad"]); ?>";
var lineLink = "<?php echo ($url); ?>";
var descContent = "<?php echo ($lpinfo["projectinfo"]); ?>...";
var shareTitle = "<?php echo ($lpinfo["LouPanAddress"]); ?>";
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

    <div style=" width:95%; margin:auto; overflow:hidden;">
        <img src="<?php echo ($lpinfo["LouPanUpLoad"]); ?>" style="height:200px;">
    </div>  

    <div  class="building_cent" id="jjmore" style=" width:91%;padding-left:2%;padding-right:2%; padding-bottom:20px;">

        <div class="building_centitle" style=" background:none; width:95%; margin:auto; text-indent:0px; text-align:left; margin:auto; height:auto; padding-bottom:10px; line-height:26px; padding-top:20px; font-size:18px;">
            <?php echo ($lpinfo["LouPanAddress"]); ?><br>
            <span style="display:block; width:50%; float:left; text-align:left; font-size:14px; font-weight:100; overflow:hidden;">发布时间：<?php echo (date("Y-m-d",$lpinfo["BeginTime"])); ?></span>
            <span style="display:block;   width:40%; float:right; text-align:left; font-size:14px; font-weight:100; overflow:hidden; text-align:right; padding-right:5%;">&nbsp;&nbsp;浏览量：<?php echo ($lpinfo["video"]); ?></span><br>
        </div>  
        
         <div class="building_centext" style=" border:none; width:95%;">
            <?php echo (htmlspecialchars_decode($lpinfo["projectinfo"])); ?>
         </div> 
    </div> 

<script language="javascript">

    function showboxa(a){
            document.getElementById(a).style.display="";
        }
    function closeboxa(b){ 
            document.getElementById(b).style.display="none";    
        } 

    function showjj(){
        showboxa("jjlittle");
        closeboxa("jjmore");
    } 
    function closejj(){ 
        showboxa("jjmore");
        closeboxa("jjlittle");
    } 
    function showjt(){
        showboxa("jtlittle");
        closeboxa("jtmore");
    } 
    function closejt(){
        showboxa("jtmore");
        closeboxa("jtlittle");
    } 
    function showjs(){
        showboxa("jslittle");
        closeboxa("jsmore");
    } 
    function closejs(){
        showboxa("jsmore");
        closeboxa("jslittle");
    }   
</script>
</html>