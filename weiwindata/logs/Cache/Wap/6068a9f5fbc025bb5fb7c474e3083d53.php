<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" /><meta charset="utf-8" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="black" name="apple-mobile-web-app-status-bar-style" />
<meta name="format-detection" content="telephone=no"/>
<title><?php echo ($metaTitle); ?></title>
<script src="<?php echo $staticFilePath;?>/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?php echo $staticFilePath;?>/js/jquery.lazyload.js" type="text/javascript"></script>
<script src="<?php echo $staticFilePath;?>/js/notification.js" type="text/javascript"></script>
<script src="<?php echo $staticFilePath;?>/js/swiper.min.js" type="text/javascript"></script>
<script src="<?php echo $staticFilePath;?>/js/main.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $staticFilePath;?>/css/style_touch.css">

<link href="<?php echo $staticFilePath;?>/css/defstyle.css" rel="stylesheet" type="text/css">   
<link href="<?php echo $staticFilePath;?>/css/style1.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $staticFilePath;?>/js/jquery.SuperSlide.js"></script>
</head>
<script>
$(document).ready(function(){
$(".m-hd .cat").parent('div').click( function() {
    var docH=$(document).height();
  	$('.sub-menu-list').toggle();
    $(".m-right-pop-bg2").addClass("on").css('min-height',docH);
});
$(".m-right-pop-bg2").click( function() {
    $('.sub-menu-list').hide();
   $(".m-right-pop-bg2").removeClass("on").removeAttr("style");
});
});
</script>
<style type="text/css">
	.m-hd>div{margin:0px;}
</style>
<body>
<div id="top"></div>
<div id="scnhtm5" class="m-body">
<div class="m-detail-mainout">
<div class="m-hd">
<div style=""><a href="javascript:history.go(-1);" class="back">返回</a></div>
<div><a href="javascript:void(0);" class="cat">商品分类</a></div>
<div class="tit"><?php echo ($metaTitle); ?></div>
<div><a href="<?php echo U('Store/my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" class="uc">用户中心</a></div>
<div><a href="<?php echo U('Store/cart',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" class="cart">购物车<i class="cart_com"><?php if($totalProductCount != 0): echo ($totalProductCount); endif; ?></i></a></div>
</div>
<ul class="sub-menu-list" style="z-index:10000;">
<li><a href="<?php echo U('Store/cats',array('token' => $_GET['token'], 'catid' => $hostlist['id'], 'wecha_id' => $wecha_id));?>">首页</a></li>
<?php if(is_array($cats)): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hostlist): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Store/products',array('token' => $_GET['token'], 'catid' => $hostlist['id'], 'wecha_id' => $wecha_id));?>"><?php echo ($hostlist["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>

<div class="mBan">
<style type="text/css">
	a.clickagao{width:90%; position: relative; display:block; margin:auto; overflow:hidden;margin:8px auto;}
	a.clickagao img{width:100%;}
	a.clickagao span{ background:rgba(0,0,0,.7); color:#fff; display:block; height:25px; line-height:25px; font-size:12px; text-indent:10px; position: absolute; width:100%; top:100%; left:0px; margin-top:-25px; font-family:微软雅黑}

	.className_wap{text-align:center;font-size:0;   margin:auto; width:98%; margin-top:20px;  }
	a.className_showbox{ display:inline-block; width:49%; font-size:14px;  text-decoration:none;   min-height:190px; margin:0px;  border:1px #ddd solid; color:#333; text-align:left; font-family:微软雅黑;
	 line-height:16px; padding-bottom:10px; overflow:hidden; }
 	.className_showbox div{ width:90%; margin:5px auto}
	span.money{ font-family:Arial, Helvetica, sans-serif; color:#f00;}
	span.qianggou{ display:inline-block; position:relative; font-family:Arial, Helvetica, sans-serif; color:#fff; background-color:#C30; padding:3px 5px 3px 5px; }
	.className_showbox img{ width:100%; height: 150px;} 
</style>
<div id="slideBox" class="slideBox">
	<form method="post" id="subform" action="<?php echo U('Store/products',array('token'=>$token,'wecha_id'=>$wecha_id));?>" >
	<div class="select_bg">
		<input type="hidden" name="wecha_id" value="<?php echo ($wecha_id); ?>">
		<input type="hidden" name="token" value="<?php echo ($token); ?>">
		<input type="text" name="search_name"class="select_box" required/>
		<input type="submit" class="select_but" value=""/> 
	</div>
	</form>
    <div class="hd">
        <ul><li></li><li></li><li></li></ul>
    </div>
    <div class="bd">
        <ul>
		<?php if(is_array($info['picurls'])): foreach($info['picurls'] as $key=>$vo): ?><li><a><img src="<?php echo ($vo); ?>" /></a></li><?php endforeach; endif; ?>

        </ul>
    </div>
</div>
</div>

<div style=" min-height:250px;">
<div class="nav" style=" height:auto; padding-bottom:0px; ">
	<!-- <a  href="<?php echo U('Store/product_details',array('token'=>$token,'wecha_id'=>$wecha_id,'username'=>$username));?>" > <img src="<?php echo $staticFilePath;?>/image/ICqb.jpg" width="50px;" ><br>全部分类</a> -->
	<a  href="<?php echo U('Store/my',array('token'=>$token,'wecha_id'=>$wecha_id));?>"> <img src="<?php echo $staticFilePath;?>/image/ICmy.jpg" width="50px;" ><br>我的订单</a>
	<a  href="<?php echo U('Store/cart',array('token'=>$token,'wecha_id'=>$wecha_id));?>" > <img src="<?php echo $staticFilePath;?>/image/ICby.jpg" width="50px;" ><br>购物车</a>

    <?php if(is_array($cats)): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hostlist): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Store/products',array('token' => $_GET['token'], 'catid' => $hostlist['id'], 'wecha_id' => $wecha_id));?>"><img src="<?php echo ($hostlist["logourl"]); ?>" width="50px;" height="48px;" ><br><?php echo ($hostlist["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>

    <br clear="all"> <br></div>
    <!-- 广告开始 -->
	<?php if(is_array($advert)): $i = 0; $__LIST__ = $advert;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="clickagao" href="<?php echo U('Store/product',array('token' => $_GET['token'], 'id' => $vo['pid'], 'wecha_id' => $wecha_id));?>">
		    <img src="<?php echo ($vo["picurl"]); ?>"   >
			<!-- <span  ><?php echo ($vo["advertname"]); ?></span> -->
		</a><?php endforeach; endif; else: echo "" ;endif; ?>
	<!-- 广告结束 -->
<div class="nav" style=" height:auto; padding-bottom:0px; ">
    <!-- 热销商品 -->
    <span style="display:block;width:100%;">热销商品 <img src="<?php echo $staticFilePath;?>/image/hotcomm_small.jpg" width="25" style="position:relative; top:-5px"></span>
    <!-- <?php if(is_array($hotcomm)): $i = 0; $__LIST__ = $hotcomm;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Store/product',array('token' => $_GET['token'], 'id' => $vo['id'], 'wecha_id' => $wecha_id));?>" style="width:49%;height:160px;border:1px solid #edf;">
			<img src="<?php echo ($vo["logourl"]); ?>" style="width:100px;height:100px;"  >

			<span style="display:block;margin:auto;width:96%;font-size:12px;height:28px;line-height:28px;">
				<?php echo (mb_substr($vo["name"],0,10,"utf-8")); ?>...
			</span>
			<span style="display:block;margin:auto;width:96%;font-size:12px;height:28px;line-height:28px;">热销价：<span style="color:red;">￥<?php echo ($vo["price"]); ?></span>
			<span style="background:red;color:#fff;padding:3px 5px 5px 5px;border-radius:3px;">立即秒杀</span>
		</span>
		</a><?php endforeach; endif; else: echo "" ;endif; ?>  -->
	<div class="className_wap">
		<?php if(is_array($hotcomm)): $i = 0; $__LIST__ = $hotcomm;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Store/product',array('token' => $_GET['token'], 'id' => $vo['id'], 'wecha_id' => $wecha_id));?>" class="className_showbox">
        	<div>
                <img  src="<?php echo ($vo["logourl"]); ?>"> 
                <span><?php echo (mb_substr($vo["name"],0,10,"utf-8")); ?>...</span><br><span class="money">￥<?php echo ($vo["price"]); ?></span> <span class="qianggou"> 查看购买</span>
       		</div>
        </a><?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="className_showbox" style="width:49%; height:1px; border:none;"></div>    <div class="className_showbox" style="width:49%; height:1px; border:none;"></div>
    </div>
	   <br clear="all"> <br>
</div> 
	

</div>
<br clear="all">

<!-- <div style="width:95%; margin:auto; background:url(<?php echo $staticFilePath;?>/image/tejia_line.jpg) repeat-x; margin-top:0px; overflow:hidden;">
	<p style="height:50px; background:url(<?php echo $staticFilePath;?>/image/tejia.jpg) 0px 0px no-repeat; height:85px;  "> </p>

</div> -->



<div class="secbox">
<?php if(is_array($advert_list)): $i = 0; $__LIST__ = $advert_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$advert): $mod = ($i % 2 );++$i;?><!--四栏广告-->
<?php if($advert['advert_type'] == 3): ?><!-- 	<p class="setitle"><?php echo ($advert["advert_name"]); ?></p>
 -->
	<a href="<?php echo ($advert["advert_url1"]); ?>" class="showimg"><img src="<?php echo ($advert["advert_pic1"]); ?>" style="margin-top:10px;" ></a>
	<div class="showimg">
		<a  href="<?php echo ($advert["advert_url2"]); ?>" class="showimg_"><img src="<?php echo ($advert["advert_pic2"]); ?>"  style="margin-top:10px;"></a>
		<div  class="showimg_">
			<a href="<?php echo ($advert["advert_url3"]); ?>" class="showimg1"><img src="<?php echo ($advert["advert_pic3"]); ?>" style="margin-top:10px;" ></a>
			<a href="<?php echo ($advert["advert_url4"]); ?>" class="showimg1"><img src="<?php echo ($advert["advert_pic4"]); ?>" style="margin-top:10px;" ></a>
		</div>
	</div><?php endif; ?>
	
<!--三栏广告-->
<?php if($advert['advert_type'] == 2): ?><!-- 	<p  class="setitle"><?php echo ($advert["advert_name"]); ?></p>
 -->	<a href="<?php echo ($advert["advert_url1"]); ?>" class="showimg"><img src="<?php echo ($advert["advert_pic1"]); ?>"  style="margin-top:10px;"></a>
	<a href="<?php echo ($advert["advert_url2"]); ?>" class="showimg"><img src="<?php echo ($advert["advert_pic2"]); ?>" style="margin-top:10px;"></a>
	<a href="<?php echo ($advert["advert_url3"]); ?>" class="showimg"><img src="<?php echo ($advert["advert_pic3"]); ?>" style="margin-top:10px;"></a><?php endif; ?>
<!--两栏广告-->
<?php if($advert['advert_type'] == 1): ?><!-- 	<p  class="setitle"><?php echo ($advert["advert_name"]); ?></p>
 -->	<a href="<?php echo ($advert["advert_url1"]); ?>" class="showimg"><img src="<?php echo ($advert["advert_pic1"]); ?>" style="margin-top:10px;" ></a>
	<a href="<?php echo ($advert["advert_url2"]); ?>" class="showimg"><img src="<?php echo ($advert["advert_pic2"]); ?>" style="margin-top:10px;"></a><?php endif; ?>
<!--单栏广告-->
<?php if($advert['advert_type'] == 0): ?><!-- 	<p  class="setitle"><?php echo ($advert["advert_name"]); ?></p>
 -->	<a href="<?php echo ($advert["advert_url1"]); ?>" class="showimg"><img src="<?php echo ($advert["advert_pic1"]); ?>" style="margin-top:10px;"></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>

</div>
 

<!-- <div  class="foot"> 
    <div  class="foot_">
		<a href="<?php echo U('Store/login',array('token'=>$token,'wecha_id'=>$wecha_id,'username'=>$username));?>"  class="foot1">登录</a>
		<a href="<?php echo U('Store/register',array('token'=>$token,'wecha_id'=>$wecha_id,'username'=>$username));?>"  class="foot2">注册</a>
        <a href="<?php echo U('Store/shopping_list',array('token'=>$token,'wecha_id'=>$wecha_id,'username'=>$username));?>"  class="foot3">购物车</a>
    </div> 
</div> -->
<!-- <div  class="foot" style="border-top:none; text-align:center;"> 
     客服热线:400-885-2282 
</div> -->
 
<br>
<div s class="copyrig" style=" position:fixed; top:100%; left:0px; margin-top:-25px; background:rgba(150,150,150,.2)">
	 
	<a  class="backtop"href="javascript:scroll(0,0)" mce_href="javascript:scroll(0,0)" style=" height:20px; line-height:  20px;padding:0px; margin:0px;border-radius:2px; padding:2px 5px; ">返回顶部</a> 
	 <a style="background:none;" href="<?php echo ($replyinfo["copyrighturl"]); ?>">Copyright &<?php echo ($replyinfo["copyright"]); ?></a>
</div>


</body>
<script language="javascript">
 

jQuery(".slideBox").slide({mainCell:".bd ul",effect:"fold",autoPlay:true});
function autFun(){
	var mW=$(".mBan").width();
	var mBL=460/218;
	$(".slideBox .bd").css("height",mW/mBL);
	$(".slideBox .bd img").css("width",mW);
	$(".slideBox .bd img").css("height",mW/mBL);
}
setInterval(autFun,1);
</script>
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Store",
            "moduleID":"<?php echo ($cats[0]['id']); ?>",
            "imgUrl": "<?php echo ($cats[0]['logourl']); ?>", 
            "timeLineLink": "<?php echo C('site_url') . U('Store/index',array('token' => $_GET['token']));?>",
            "sendFriendLink": "<?php echo C('site_url') . U('Store/index',array('token' => $_GET['token']));?>",
            "weiboLink": "<?php echo C('site_url') . U('Store/index',array('token' => $_GET['token']));?>",
            "tTitle": "<?php echo ($metaTitle); ?>",
            "tContent": "<?php echo ($metaTitle); ?>"
        };
</script>
<?php echo ($shareScript); ?>
</html>