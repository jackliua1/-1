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
<link href="<?php echo RES;?>/css/defstyel.css?v=<?php echo ($vtime); ?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<style type="text/css"> 
    #container{height:100%}
	.building_centitle span{
		font-size:14px;
		font-weight:normal;
	}
	.djname{
		    width: 40%;
		float: left;
		display: inline-block;
	}
	.djtel{
		width: 60%;
		float: right;
		display: block;
		text-align: right;
	}

    .building_centext img{ margin: 20px 0px 20px 0px;}
</style>  
<!-- <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.5&ak=VvtbHOtv7fAmn45bQ7W5wwkI"></script> -->
<script>
var imgUrl = "<?php echo ($lpinfo["LouPanUpLoad"]); ?>";
var lineLink = "<?php echo ($url); ?>";
var descContent = "<?php echo ($lpinfo["LouPanAddress"]); ?>";
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
	<!--返回上一页-->
	<div class="goback">
		<a href="javascript:history.go(-1);">&nbsp;&nbsp;<&nbsp;&nbsp;</a>
		楼盘信息
	</div>
	<p  class="mid_reg"> </p>
	<!--返回上一页-->
	<div style=" width:95%; margin:auto; overflow:hidden;">
		<img src="<?php echo ($lpinfo["LouPanUpLoad"]); ?>" style="height:200px;">
    </div>  

    <div  class="building_cent" id="jjmore" style=" width:91%;padding-left:2%;padding-right:2%; padding-bottom:20px;">

        <div class="building_centitle" style=" background:none; width:95%; margin:auto; text-indent:0px; text-align:left; margin:auto; height:auto; padding-bottom:10px; line-height:26px; padding-top:20px; font-size:18px;">
            <span class="djname">对接人：<?php echo ($lpinfo["djname"]); ?></span><span class="djtel">联系电话：<a href="tel:<?php echo ($lpinfo["djtel"]); ?>"><?php echo ($lpinfo["djtel"]); ?></a></span><br>
            <span style="display:block; width:58%; float:left; text-align:left; font-size:14px; font-weight:100; overflow:hidden;">发布时间：<?php echo (date("Y-m-d",$lpinfo["BeginTime"])); ?></span>
            <span style="display:block;   width:42%; float:right; text-align:left; font-size:14px; font-weight:100; overflow:hidden; text-align:right;">&nbsp;&nbsp;浏览量：<?php echo ($lpinfo["video"]); ?></span><br>
        </div>  
     	
         <div class="building_centext" style=" border:none; width:95%;">
            <?php echo (htmlspecialchars_decode($lpinfo["projectinfo"])); ?>
         </div> 
  	 <!--  	<span class="building_more" onclick="showjj()">更多</span> -->
    </div> 

<!-- 
    <div  class="building_cent" id="jjlittle" style="display:none;">
        <div class="building_centitle">项目简介</div>   
         <div class="building_centext" > <?php echo ($lpinfo["LouPanJieShao"]); ?> </div>       
        <a   class="building_more" onclick="closejj()" style="position:relative;" >收起</a>
    </div> 
     -->
<!--     
    <div  class="building_cent" id="jtmore">
    	<div class="building_centitle">交通配套</div>   
         <div class="building_centext"><?php echo (mb_substr($lpinfo["traffic"],0,50,"utf-8")); ?>...</div>   	
  	  	<span class="building_more" onclick="showjt()">更多</span>
    </div>
    <div  class="building_cent" style="display:none;" id="jtlittle">
        <div class="building_centitle">交通配套</div>   
         <div class="building_centext"><?php echo ($lpinfo["traffic"]); ?></div>     
        <span class="building_more" onclick="closejt()">收起</span>
    </div> -->

<!--     <div  class="building_cent" id="jsmore">
        <div class="building_centitle">项目介绍</div>   
         <div class="building_centext"><?php echo (htmlspecialchars_decode(mb_substr($lpinfo["projectinfo"],0,50,"utf-8"))); ?>...</div>     
        <span class="building_more" onclick="showjs()">更多</span>
    </div>
    <div  class="building_cent" style="display:none;" id="jslittle">
        <div class="building_centitle">项目介绍</div>   
         <div class="building_centext"><?php echo (htmlspecialchars_decode($lpinfo["projectinfo"])); ?></div>     
        <span class="building_more" onclick="closejs()">收起</span>
    </div>   --> 
    
<!--     <div  class="building_cent">
        <div class="building_centitle">视频欣赏</div>   
        <div class="building_centext" style="height:300px;">
            <embed src="http://player.youku.com/player.php/sid/XNDc4NDU1NjAw/v.swf" allowFullScreen="true" quality="high" width="100%" height="90%" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>
            <iframe height='90%' width='100%' src="<?php echo ($lpinfo["video"]); ?>" frameborder=0 allowfullscreen></iframe>
        </div>       
        <a class="building_more">更多</a>
    </div> -->
  
         </div>  	 
    </div>
    
    <a href="<?php echo U('Agent/addCustom',array('token'=>$token,'lpid'=>$lpinfo['id']));?>" style="text-decoration:none; display:block; width:200px; height:40px; line-height:40px; margin:auto; margin-top:15px; border-radius:3px; text-align:center; font-size:16px; color:#fff; background:#df3001;">我要推荐</a>
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