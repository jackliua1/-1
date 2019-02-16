<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
<meta content="telephone=no" name="format-detection">
<meta name="keywords" content="首创置业，买房，看房，房地产">
<meta name="description" content="首创置业是中国领先的房地产综合营运商。公司于2003年6月19日在香港联合交易所主板上市，综合实力居国内领先地位，目前已进入全国四大区域十三个城市，土地储备规模超过1000万平方米，有相当高的市场知名度和品牌影响力。">
<title></title> 
<style type="text/css">
 
html,body{ min-width:320px;  height:100%; }
body{  font-family: '宋体'; color: #333; font-size: 18px; background:#F4F3EF  url(<?php echo RES;?>/images/bg1_.jpg) center bottom no-repeat; line-height:40px;   }

a{ color:#649da6; text-decoration:none;}
 
</style>
</head>
<body> 

 
<div  style=" width:280px; text-align:center; margin:auto;  position:relative; top:100%; height:30px; margin-top:-210px; ">
页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
<br>  
<?php echo($error); ?>
 
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time == 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>