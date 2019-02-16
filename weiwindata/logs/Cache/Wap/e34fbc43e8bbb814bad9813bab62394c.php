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

<link rel="stylesheet" type="text/css" href="<?php echo $staticFilePath;?>/css/detail.css?v=2.2.0">
<style>
#content{display:none;width:100%;overflow:hidden;position:absolute;top:0}
#imgs{-webkit-transition-property:-webkit-transform;-webkit-transition-duration:0.5s;-webkit-transition-timing-function:ease-out;-webkit-transform:translate3d(0px,0px,0px);height:100%}
#imgs li{float:left;text-align:center;height:100%;padding-top:65px}
#imgs img{width:94%;-webkit-transform:translate3d(0px,0px,0px)}
.bg{width:100%;top:0;left:0;background:#000;opacity:0.8;position:absolute;display:none}
.close{display:none;position:absolute;z-index:10;right:3%;top:20px;color:#fff;cursor:pointer;background:#999;border-radius:3px;padding:5px 8px}.s_count{display:none;position:absolute;z-index:10;right:3%;top:25px;color:#fff;margin-right:60px}
  
	.color{   display:inline-block;  font-family:"微软雅黑"; font-size: 14px; background: #f5f5f5; height:25px; line-height:25px; border: 1px solid #dfdfdf;    padding: 2px 10px; margin-right: 10px; margin-bottom: 5px;
	 }  
	.norms{ display:inline-block;  font-family:"微软雅黑"; font-size: 14px; background: #f5f5f5; height:25px; line-height:25px; border: 1px solid #dfdfdf; padding: 2px 10px; margin-right: 10px; margin-bottom: 5px; } 
	.onspan{border: #b90000 1px solid; color: #b90000;}  
</style>
<!--轮播-->
<!-- <div class="focusPic">
	<div class="views">
		<?php if(empty($imageList) != true): ?><ul class="warp" id="fd">
				<?php if(is_array($imageList)): $i = 0; $__LIST__ = $imageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i;?><li class="li"><img src="<?php echo ($img["image"]); ?>"></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		<?php else: ?>
			<ul class="warp" id="fd">
				<li class="li"><img src="<?php echo ($product["logourl"]); ?>"></li>
			</ul><?php endif; ?>
	</div>
	<?php if(empty($imageList) != true): ?><ul class="tabs">
			<?php if(is_array($imageList)): $i = 0; $__LIST__ = $imageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i;?><li class="li"><?php echo ($i); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	<?php else: ?>
		<ul class="tabs"><li>0</li></ul><?php endif; ?>
</div> -->
<div class="focusPic">
	<div class="views" id="full-screen-slider" style="width:100%;float:left;position:relative">
		<ul class="warp" id="slides">
		<?php if(empty($imageList) != true): if(is_array($imageList)): $i = 0; $__LIST__ = $imageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i;?><li class="li" style="width:100%;text-align:center;">
					<img src="<?php echo ($img["image"]); ?>" style="width:90%;height:280px;">
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		<?php else: ?>
				<li class="li" style="width:100%;text-align:center;"><img src="<?php echo ($product["logourl"]); ?>" style="width:90%;height:280px;"></li><?php endif; ?>
		</ul>
	</div>	
	<?php if(empty($imageList) != true): ?><ul class="tabs">
			<?php if(is_array($imageList)): $i = 0; $__LIST__ = $imageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i;?><li class="li"><?php echo ($i); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	<?php else: ?>
		<ul class="tabs"><li>0</li></ul><?php endif; ?>
</div>
<script>
var focusPic = new Swiper('.focusPic .views',{pagination: '.focusPic .tabs',autoplay:3000})
</script>
<!--轮播结束-->
<div class="purchaseH clearfix">


<div style=" padding:20px 22px 0px 10px; font-size:16px; line-height:22px; color:#3e3e3e; font-weight:bold; font-family:微软雅黑; text-align:center; "> <?php echo ($product["name"]); ?></div>

</div>

<?php if(empty($catData['norms']) != true OR empty($catData['color']) != true): if(is_array($productDetail)): $i = 0; $__LIST__ = $productDetail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pro): $mod = ($i % 2 );++$i;?><input type="hidden" id="color_<?php echo ($pro["color"]); ?>_norms_<?php echo ($pro["format"]); ?>" value="<?php echo ($pro["num"]); ?>" did="<?php echo ($pro["id"]); ?>" price="<?php echo ($pro["price"]); ?>" vprice="<?php echo ($pro["vprice"]); ?>" class="hidden"/><?php endforeach; endif; else: echo "" ;endif; endif; ?>

<div style=" padding:0px 22px 5px 22px;display:block;overflow:hidden;">
     
     <p style="    font-family:微软雅黑;  margin-left:5px;float:left;font-size:14px; color:#fff;  background:#c00; padding:0px 5px;">销售价：<em id="xsprice">￥<?php echo ($product["price"]); ?></em>元</p>
     <p style=" text-decoration:line-through;  font-size:12px;  float:left; background:# ; color:#999; padding:4px ;   ">原价：￥<?php echo ($product["oprice"]); ?>元</p>
     <br clear="all">

     <p style=" padding-top:5px;  color:#000; font-family:微软雅黑;  margin-left:5px;float:left;font-size:14px; color:#333;">运费：￥<?php echo (($product["mailprice"])?($product["mailprice"]):0); ?>元<span class="stock" style="padding-left:10px;">(库存<span id="stock"><?php echo ($product["num"]); ?></span>)</span></p><br clear="all"> <br>

     <?php if(empty($catData['color']) != true): ?><div>
			<div style=" width:95%; margin:auto; text-align:left;">
				<?php echo ($catData["color"]); ?>：
			</div>
			<div  >
				<div  style=" width:95%; margin:auto; text-align:left; padding-top:10px;">
					<?php if(is_array($colorData)): $colorId = 0; $__LIST__ = $colorData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$detail): $mod = ($colorId % 2 );++$colorId;?><span name="color" class="color"  id="color_<?php echo ($detail['color']); ?>">
							<?php if($detail['logo'] != ''): ?><img src="<?php echo ($detail['logo']); ?>">
									<?php else: echo ($detail['colorName']); endif; ?> 
						</span><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
		</div><?php endif; ?>
		
	<?php if(empty($catData['norms']) != true): ?><div>
			<div style=" width:95%; margin:auto; text-align:left;">
				<?php echo ($catData["norms"]); ?>：
			</div> 
			<div  style=" width:95%; margin:auto; text-align:left; padding:10px 0px 10px 0px;">
				<?php if(is_array($formatData)): $colorId = 0; $__LIST__ = $formatData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$detail): $mod = ($colorId % 2 );++$colorId;?><span name="norms" class="norms"  id="norms_<?php echo ($detail['format']); ?>">
						<?php echo ($detail['formatName']); ?>
					</span><?php endforeach; endif; else: echo "" ;endif; ?>
			</div> 
		</div><?php endif; ?>

 

     <img src="<?php echo $staticFilePath;?>/images/adbg.jpg" style=" width:100%; height:60px";>
     <div class="sn-block buy-bar">
		<div class="wbox" id="buyBtn" style=" width:99%; float:rignt; margin:0px; ">
			<a href="javascript:;" onClick="QuickBuy()" class="buyNow" id="buyNow" style=" float:left; width:50%;margin:0px; height:40px; font-size:16px; line-height:40px;">立即购买</a>
			<a href="javascript:;" id="btn_add_cart" class="appendToCart" onclick="add_cart();" style=" float:left; width:50%;margin:0px; height:40px; font-size:16px; line-height:40px;" >加入购物车</a>
		</div>
	</div>
</div>
<div class="d-info">
	<div class="detailinfo">
		<ul class="tabs"><li>详情</li></ul>
		<div class="views">
			<div class="warp">
				<div class="li">
					<ul class="detail-list">
					<?php if(is_array($attributeData)): $i = 0; $__LIST__ = $attributeData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attribute): $mod = ($i % 2 );++$i;?><li><label><?php echo ($attribute["name"]); ?>：</label><span><?php echo ($attribute["value"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="infodetail"><?php echo ($product["intro"]); ?></div>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"> 
//var detailinfo = new Swiper('.detailinfo .views',{pagination: '.detailinfo .tabs',autoplay:false});

// function changecolor(divname){
// 	var div document.getelementBysname("");
// }

var SysSecond; 
var InterValObj; 
var buyDetailId = '';
$(document).ready(function() {
	SysSecond = parseInt($("#remainSeconds").html()); //这里获取倒计时的起始时间 
	InterValObj = window.setInterval(SetRemainTime, 1000); //间隔函数，1秒执行 
	$(".color").click(function(){
		if ($(this).attr('class') != 'color onspan') {
			$(this).addClass('onspan').siblings().removeClass('onspan');
			var id = $(this).attr('id');
			var nextid = 'norms_0';
			$('.norms').each(function(){
				if ($(this).attr('class') == 'norms onspan') {
					nextid = $(this).attr('id');
				}
			});
			if ($("#" + id + "_" + nextid).val() != null && $("#" + id + "_" + nextid).val() != '') {
				buyDetailId = id + "_" + nextid;
				$("#stock").text($("#" + id + "_" + nextid).val());
				$("#xsprice").text('￥' + $("#" + id + "_" + nextid).attr('price'));
				$("#vprice").text('￥' + $("#" + id + "_" + nextid).attr('vprice'));
			} else {
				$("#stock").text(0);
			}
		} else {
			$(this).removeClass('onspan');
		}
	});
	$(".norms").click(function(){
		if ($(this).attr('class') != 'norms onspan') {
			$(this).addClass('onspan').siblings().removeClass('onspan');
			var id = $(this).attr('id');
			var nextid = 'color_0';
			$('.color').each(function(){
				if ($(this).attr('class') == 'color onspan') {
					nextid = $(this).attr('id');
				}
			});
			if ($("#" + nextid + "_" + id).val() != '' && $("#" + nextid + "_" + id).val() != null) {
				buyDetailId = nextid + "_" + id;
				$("#stock").text($("#" + nextid + "_" + id).val());
				$("#xsprice").text('￥' + $("#" + nextid + "_" + id).attr('price'));
				$("#vprice").text('￥' + $("#" + nextid + "_" + id).attr('vprice'));
			} else {
				$("#stock").text(0);
			}
		} else {
			$(this).removeClass('onspan');
		}
	});
}); 

//将时间减去1秒，计算天、时、分、秒 
function SetRemainTime() {
	if (SysSecond > 0) { 
		SysSecond = SysSecond - 1; 
		var second = Math.floor(SysSecond % 60);             // 计算秒     
		var minite = Math.floor((SysSecond / 60) % 60);      //计算分 
		var hour = Math.floor((SysSecond / 3600) % 24);      //计算小时 
		var day = Math.floor((SysSecond / 3600) / 24);        //计算天 
		$("#remainTime").html('&nbsp;&nbsp;还剩'+day + "天" + hour + "小时" + minite + "分" + second + "秒"); 
	} else {//剩余时间小于或等于0的时候，就停止间隔函数 
		window.clearInterval(InterValObj); 
		//这里可以添加倒计时时间为0后需要执行的事件 
	} 
}
//加减
function plus_minus(rowid, number,price) {
    var num = parseInt($('#buy_num').val());
    num = num + parseInt(number);
    if (num > parseInt($('#stock').text())) {
    	num = parseInt($('#stock').text());
    }
    if (num < 0) {
        return false;
    }
     $('#buy_num').attr('value',num);
}
function add_cart() {
	$("#btn_add_cart").attr("disable", false);
	var count = parseInt($('#buy_num').val())?parseInt($('#buy_num').val()):1;
	var did = parseInt($("#" + buyDetailId).attr('did'));
	if ($('.hidden').eq(0).val() != null && $('.hidden').eq(0).val() != '' && $('.hidden').eq(0).val() != 'undefined') {
		if (isNaN(did)) {
	        return floatNotify.simple('请选择相应属性的产品');
		}
	} else {
		did = 0;
	}
	if (count > parseInt($("#stock").text())) {
		return floatNotify.simple('抱歉，您的购买量超过了库存了');
	}
	$.ajax({
		url: "<?php echo U('Store/addProductToCart',array('token'=>$token,'id'=>$product['id'],'wecha_id'=>$_GET['wecha_id']));?>" + '&count='+count + '&did=' + did,
		success: function(data) {
			if(data){
				var datas=data.split('|');
                $('.cart_com').text(datas[0]); 
                $("#btn_add_cart").attr("disable", true);
                return floatNotify.simple('加入购物车成功');
			} else {
				return floatNotify.simple('抱歉，您的请求不正确');
			}
		}
	});
}
function QuickBuy() {
	var count = parseInt($('#buy_num').val())?parseInt($('#buy_num').val()):1;
	var did = parseInt($("#" + buyDetailId).attr('did'));
	if ($('.hidden').eq(0).val() != null && $('.hidden').eq(0).val() != '' && $('.hidden').eq(0).val() != 'undefined') {
		if (isNaN(did)) {
			return floatNotify.simple('请选择颜色与尺码');
			return false;
		}
	} else {
		did = 0;
	}
	if (count > parseInt($("#stock").text())) {
		return floatNotify.simple('抱歉，您的购买量超过了库存了');
	}
	$.ajax({
		url: "<?php echo U('Store/addProductToCart',array('token'=>$token,'id'=>$product['id'],'wecha_id'=>$_GET['wecha_id']));?>" + '&count='+count + '&did=' + did,
		success: function(data) {
			if(data){
				location.href = "<?php echo U('Store/cart',array('token' => $token,'wecha_id' => $_GET['wecha_id']));?>";;
			} else {
				return floatNotify.simple('抱歉，您的请求不正确');
			}
		}
	});
}
</script>
</body>
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Store",
            "moduleID":"<?php echo ($product['id']); ?>",
            "imgUrl": "<?php echo ($product['logourl']); ?>", 
            "timeLineLink": "<?php echo C('site_url') . U('Store/product',array('token' => $_GET['token']));?>",
            "sendFriendLink": "<?php echo C('site_url') . U('Store/product',array('token' => $_GET['token']));?>",
            "weiboLink": "<?php echo C('site_url') . U('Store/product',array('token' => $_GET['token']));?>",
            "tTitle": "<?php echo ($metaTitle); ?>",
            "tContent": "<?php echo ($metaTitle); ?>"
        };
</script>
<?php echo ($shareScript); ?>
</html>