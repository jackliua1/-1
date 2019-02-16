<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="shortcut icon" href="./tpl/static/logo.jpg">
  <title><?php echo C('site_title');?> <?php echo C('site_name');?></title>
  <link href="/tpl/User/default/common/css/ss.css" rel="stylesheet" type="text/css"  />
  <!-- <link href="/tpl/User/default/common/css/ss.css" rel="stylesheet" type="text/css"  /> -->
  <!-- <link href="/tpl/User/default/common/css/style.css" rel="stylesheet" type="text/css" /> -->
  <link href="/tpl/User/default/common/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../wm-xin-a/font-awesome.css" media="all" />
  <link rel="stylesheet" type="text/css" href="/tpl/User/default/common/css/stylet.css" />
  <!-- <link rel="stylesheet" type="text/css" href="/tpl/User/default/common/css/stylet.css" /> -->
<script type="text/javascript" src="/tpl/User/default/common/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="/tpl/User/default/common/js/jquery.min.js"></script> -->
<!-- <script type="text/javascript" src="/tpl/User/default/common/js/common.js"></script> -->
<script type="text/javascript" src="/tpl/User/default/common/js/common.js"></script>
<script type="text/javascript" charset="utf-8" src="/tpl/static/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/tpl/static/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/tpl/static/ueditor/lang/zh-cn/zh-cn.js"></script>
<script src="/tpl/static/artDialog/jquery.artDialog.js?skin=default"></script>

<script src="/tpl/static/artDialog/plugins/iframeTools.js"></script>



  <script src="<?php echo STATICS;?>/jquery-1.4.2.min.js" type="text/javascript"></script>

<script type="text/javascript" src="/tpl/static/audioplayer/inc/jquery.jplayer.min.js"></script>

    <script type="text/javascript" src="/tpl/static/audioplayer/inc/jquery.mb.miniPlayer.js"></script>

    <link rel="stylesheet" type="text/css" href="/tpl/static/audioplayer/css/miniplayer.css" title="style" media="screen"/>

<style>

/*UP*/ 

a.a_upload,a.a_choose{border:1px solid #3d810c;box-shadow:0 1px #CCCCCC;-moz-box-shadow:0 1px #CCCCCC;-webkit-box-shadow:0 1px #CCCCCC;cursor:pointer;display:inline-block;text-align:center;vertical-align:bottom;overflow:visible;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;vertical-align:middle;background-color:#f1f1f1;background-image: -webkit-linear-gradient(bottom, #CCC 0%, #2F8BC9 3%, #2F8BC9 97%, #FFF 100%); background-image: -moz-linear-gradient(bottom, #CCC 0%, #E5E5E5 3%, #FFF 97%, #FFF 100%); background-image: -ms-linear-gradient(bottom, #CCC 0%, #E5E5E5 3%, #FFF 97%, #FFF 100%); color:white;border:1px solid #AAA;padding:2px 8px 2px 8px;font-size: 14px;line-height: 1.5;

}

</style>
</head>

<body style="background-color:#3B82B8">
  <div class=" w top">
    <div class="left">
     
    </div>
    <div class="right">
      <img src="/tpl/User/default/common/images/portrait2.png" width="28" height="29" />
      <a><?php echo (session('uname')); ?></a>
      |
      <a href="<?php echo U('User/Index/index');?>">管理中心</a>
      |
      <a href="#" onclick="Javascript:window.open('<?php echo U('System/Admin/logout');?>')" onLoad=setTimeout("abc.style.display='none'",5000) >安全退出</a>
    </div>
  </div>


<div id="Frame">
    <div id="nav">
        <div class="top"></div>
        <div class="account">
            <div class="uname">
              <img src="/tpl/User/default/common/images/portrait2.png" />
              <span><?php echo (session('uname')); ?></span>  
            </div>
            <ul>
                <!-- <li>
                    用户等级：VIP<?php if($_SESSION['gid']>1){echo $_SESSION['gid']-1;}else{echo 0;}?>
                </li>
                <li>会员余额</li>
                <li>
                    VIP有效时间：
                    <?php if($_SESSION['viptime'] != 0): echo (date("Y-m-d",$thisUser["viptime"])); ?>
                    <?php else: ?>
                    vip0不限时间<?php endif; ?>
                </li> -->
                <li>
                  <span>
                    <a href="<?php echo U('Index/useredit');?>">修改密码</a>
                  </span>
                 <!--  <span>
                    <a href="<?php echo U('Alipay/index');?>">会员充值</a>
                  </span> -->
                  <span>
                    <a href="#" onclick="Javascript:window.open('<?php echo U('System/Admin/logout');?>')" onLoad=setTimeout("abc.style.display='none'",5000) >安全退出</a>
                  </span>                    
                </li>
            </ul>
            
        </div>
        <div>
           <!--  <div class="public">
                <img src="/tpl/User/default/common/images/title1.jpg" width="71" height="28" />
                <div>
                    <div class="img">
                        <img src="<?php echo ($wecha["headerpic"]); ?>"/>
                    </div>
                    <ul>
                        <li>公众账号:<?php echo ($wecha["weixin"]); ?></li>
                        <li>VIP等级:VIP<?php if($_SESSION['gid']>1){echo $_SESSION['gid']-1;}else{echo 0;}?></li>
                        <li>图文数量:<?php echo ($thisUser["diynum"]); ?>/<?php echo ($userinfo["diynum"]); ?></li>
                        <li>请求数量:<?php echo $_SESSION['diynum']; ?>/<?php echo ($userinfo["connectnum"]); ?>
                            <span>
                            <a href="<?php echo U('Index/edit',array('id'=>$_GET['id']));?>">编辑</a>
                            <a href="<?php echo U('Index/del',array('id'=>$_GET['id']));?>">删除</a>
                            </span>      
                        </li>
                    </ul>
                                          
                </div>
            </div> -->
            <div class="analyse">
                <img src="/tpl/User/default/common/images/title2.jpg" width="71" height="28" />
                <div>
                    <ul>
                       <li>今日新增粉丝:<?php if(empty($$statistics_list["follownum"])): ?>0<?php else: echo ($statistics_list["follownum"]); endif; ?></li>
                        <li>今日官网访问:<?php if(empty($$statistics_list["3g"])): ?>0<?php else: echo ($statistics_list["3g"]); endif; ?></li>
                        <li>今日参与活动:<?php if(empty($$statistics_list["other"])): ?>0<?php else: echo ($statistics_list["other"]); endif; ?></li>
                        <li>今日请求总量: <?php echo $statistics_list['3g']+$statistics_list['textnum']+$statistics_list['imgnum']+$statistics_list['videonum']+$statistics_list['other']?></li>
                        
                    </ul>                     
                </div>
                <!-- <span class="add">
                    <a href="<?php echo U('Index/add');?>"><img src="/tpl/User/default/common/images/jia.png" /></a>                        
                </span>   -->                               
            </div>
        </div>
    </div><!--nav 结束-->


    <div id="floatline"></div>

    <div class="Menu">
        <div class="TwoMenu">
            <a href="<?php echo U('Function/index',array('token'=>$token,'id'=>session('wxid')));?>" >
                <img src="/tpl/User/default/common/images/jichu.jpg" />
        
            </a>
            <div id="TwoMenu-01" <?php if(in_array(MODULE_NAME,array('Function','Areply','Text','Voiceresponse','Call','Company','Other','Diymen','Requerydata','Index','Printer','Api','Panorama','Img'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <img src="/tpl/User/default/common/images/jichu2.jpg" />
            </div>

<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
             <a href="<?php echo U('Lottery/index',array('token'=>$token));?>" >
                <img src="/tpl/User/default/common/images/yingxiao.jpg" />
            </a>
            <div id="TwoMenu-02" <?php if(in_array(MODULE_NAME,array('Lottery','Dati','Coupon','Guajiang','Zadan','Wxusermeasage','GoldenEgg','LuckyFruit','Router','Vcard','Wifi','Zhaopianwall','Czz','Game','Gamet','Gamett','Baoming'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <img src="/tpl/User/default/common/images/yingxiao2.jpg" />
            </div>

<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <a href="<?php echo U('Member_card/index',array('token'=>$token));?>" >
                <img src="/tpl/User/default/common/images/huiyuan.jpg" />
            </a>
            <div id="TwoMenu-03" <?php if(in_array(MODULE_NAME,array('info','Member_card','privilege','create','exchange','Member'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <img src="/tpl/User/default/common/images/huiyuan2.jpg" />
            </div>



<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <a href="<?php echo U('Wechat_behavior/rule',array('token'=>$token));?>" >
                <img src="/tpl/User/default/common/images/CRM.jpg" />
            </a>
            <div id="TwoMenu-04" <?php if(in_array(MODULE_NAME,array('Wechat_group','Wechat_behavior','Recognition','ServiceUser','Message','Share','Auth'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <img src="/tpl/User/default/common/images/CRM2.jpg" />
            </div>


<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
             <!-- <a href="<?php echo U('Fenx/index',array('token'=>$token));?>" >
                <img src="/tpl/User/default/common/images/hangye.jpg" />
            </a>
            <div id="TwoMenu-05" <?php if(in_array(MODULE_NAME,array('Fenx','Share_activite','Expert','Custom'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <img src="/tpl/User/default/common/images/hangye2.jpg" />
            </div> -->
            <a href="<?php echo U('Product/index',array('token'=>$token));?>" >
                <img src="/tpl/User/default/common/images/shangwu.jpg" />
            </a>
            <div id="TwoMenu-05" <?php if(in_array(MODULE_NAME,array('Dining','Invites','Shoptmpls','Product','Groupon','orders','Host','Yaoqing','Selfform','Wedding','Adma','Reply_info','Repast','Store','Yml','Alipay_config','Advert'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <img src="/tpl/User/default/common/images/shangwu2.jpg" />
            </div>			
        </div><!-- TwoMenu   end-->
</div>



<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
<div class="Menu">
        <div class="ThreeMenu">
            <div class="contab" <?php if(in_array(MODULE_NAME,array('Function','Areply','Text','Voiceresponse','Call','Company','Other','Requerydata','Index','Img','Printer','Panorama'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <!-- <a href="<?php echo U('Function/index',array('token'=>$token,'id'=>session('wxid')));?>" class="Red" >
                    <img src="/tpl/User/default/common/images/coin6.jpg" /><span>互联网接入</span><span class="introduction">这里您可以开启想接入的互联网应用</span>
                </a> -->
                <a href="<?php echo U('Areply/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/guanzhuhuifu_34.jpg" /><span>关注回复</span><span class="introduction">设置新客户关注后第一条信息</span>
                </a>
                <a href="<?php echo U('Text/index',array('token'=>$token));?>" class="Navy" >
                    <img src="/tpl/User/default/common/images/wannengbiaoge_34.jpg" /><span>内容回复</span><span class="introduction">您可以设置图文关键字回复</span>
                </a>
                <!-- <a href="<?php echo U('Voiceresponse/index',array('token'=>$token));?>" class="DarkGreen" >
                    <img src="/tpl/User/default/common/images/yuyinhuifu_33.jpg" /><span>语音回复</span><span class="introduction">设置语音关键字回复</span>
                </a> -->

                     <a href="<?php echo U('Other/index',array('token'=>$token));?>" class="LightRed" >
                    <img src="/tpl/User/default/common/images/coin8.jpg" /><span>自定义回复</span><span class="introduction">关闭聊天后回复信息</span>
                </a>

                <a href="<?php echo U('Diymen/index',array('token'=>$token));?>" class="LightBlue" >
                    <img src="/tpl/User/default/common/images/coin15.jpg" /><span>微信导航菜单管理</span><span class="introduction">添加微信底部菜单（需开通接口服务）</span>
                </a>
               <!--  <a href="<?php echo U('Index/editsms',array('token'=>$token));?>" class="LightBlue" >
                    <img src="/tpl/User/default/common/images/coin9.jpg" /><span>短信设置</span><span class="introduction">系统短信接口配置</span>
                </a>
               <a href="<?php echo U('Index/mailset',array('token'=>$token));?>" class="LightBlue" >
                    <img src="/tpl/User/default/common/images/coin9.jpg" /><span>邮件设置</span><span class="introduction">邮件发送设置</span>
                </a> -->
                <!-- <a href="<?php echo U('Company/index',array('token'=>$token));?>" class="Brown" >
                    <img src="/tpl/User/default/common/images/lbshuifu_34.jpg" /><span>LBS回复</span><span class="introduction">LBS回复设置</span>
                </a>
                <a href="<?php echo U('Alipay_config/index',array('token'=>$token));?>" class="LightPurple" >
                    <img src="/tpl/User/default/common/images/zhifuguanli_34.jpg" /><span>支付系统配置</span><span class="introduction">电子商务支付系统配置</span>
                </a> -->
				 <!--  <a href="<?php echo U('Printer/index',array('token'=>$token));?>" class="LightPurple" >
                    <img src="/tpl/User/default/common/images/bohaobanquan_34.jpg" /><span>无线打印</span><span class="introduction">无线打印配置</span>
                </a> -->
                <a href="<?php echo U('Requerydata/index',array('token'=>$token));?>" class="LightRed" >
                    <img src="/tpl/User/default/common/images/coin12.jpg" /><span>统计分析</span><span class="introduction">提供站点数据分析</span>

                </a>
                <a href="<?php echo U('Api/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/disanfang_34.jpg" /><span>第三方</span><span class="introduction">调用第三方插件</span>
                </a>
                <!-- <a href="<?php echo U('Wall/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/coin20.jpg" /><span>微信墙</span><span class="introduction">微信墙</span>
                </a> -->

                <!-- <a href="<?php echo U('Home/set',array('token'=>$token));?>" class="Red" >
                     <img src="/tpl/User/default/common/images/coin7.jpg" /><span>微网站基本设置</span><span class="introduction">在这里您需要设置微网站基本信息</span>
                 </a>
                <a href="<?php echo U('Tmpls/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/coin14.jpg" /><span>微网站模版管理</span><span class="introduction">在这里您可以自由切换微信站风格</span>
                </a> -->
                <!--   <a href="/cms/manage/index.php" class="Highland" >
                    <img src="/tpl/User/default/common/images/coin18.jpg" /><span>高级模版管理</span><span class="introduction">高级模版管理</span>
                </a> -->
                <!-- <a href="<?php echo U('Classify/index',array('token'=>$token));?>" class="Navy" >
                    <img src="/tpl/User/default/common/images/coin1.jpg" /><span>微网站板块分类管理</span><span class="introduction">这里您可以设置微网站的分类</span>
                </a> -->
               <!--  <a href="<?php echo U('Img/index',array('token'=>$token));?>" class="DarkGreen" >
                    <img src="/tpl/User/default/common/images/coin2.jpg" /><span>微网站内容管理</span><span class="introduction">在这里您可以添加微网站内容</span>
                </a> -->
                <!-- <a href="<?php echo U('Flash/index',array('token'=>$token,'tip'=>1));?>" class="Orange" >
                    <img src="/tpl/User/default/common/images/coin4.jpg" /><span>幻灯片</span><span class="introduction">微网站头部幻灯片管理</span>
                </a>
                 <a href="<?php echo U('Flash/index',array('token'=>$token,'tip'=>2));?>" class="Orange" >
                    <img src="/tpl/User/default/common/images/coin4.jpg" /><span>轮播背景图</span><span class="introduction">微网站轮播背景图管理</span>
                </a>
               <a href="<?php echo U('Catemenu/index',array('token'=>$token));?>" class="LightPurple" >
                    <img src="/tpl/User/default/common/images/bohaobanquan_34.jpg" /><span>底部导航菜单</span><span class="introduction">设置微网站版权信息及底部菜单</span>
                </a>
                <a href="<?php echo U('Daohang/index',array('token'=>$token));?>" class="LightPurple" >
                    <img src="/tpl/User/default/common/images/coin6.jpg" /><span>一键导航生成</span><span class="introduction">一键导航生成</span>
                </a>
                <a target="_blank" href="<?php echo U('Yulan/index',array('token'=>$token));?>" class="LightPurple" >
                    <img src="/tpl/User/default/common/images/coin18.JPG" /><span>在线预览</span><span class="introduction">您可以用通过PC浏览器进行3G站的预览</span>
                </a> -->

                <a href="<?php echo U('Panorama/index',array('token'=>$token));?>" class="LightPurple" >
                    <img src="/tpl/User/default/common/images/360quanjing_34.jpg" /><span>360全景</span><span class="introduction">3D全景展示</span>
                </a>
            </div>

<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="contab" <?php if(in_array(MODULE_NAME,array('Lottery','Dati','Coupon','Guajiang','Research','Zadan','Wxusermeasage','GoldenEgg','LuckyFruit','Vcard','Router','Wifi','Czz','Zhaopianwall','Game','Gamet','Gamett','Baoming'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <a href="<?php echo U('Lottery/index',array('token'=>$token));?>" class="Red"  >
                    <img src="/tpl/User/default/common/images/dazhuanpan_34.jpg" /><span>大转盘</span><span class="introduction">发布大转盘营销活动</span>
                </a>
               <!--  <a href="<?php echo U('Coupon/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/youhuiquan_34.jpg" /><span>优惠券</span><span class="introduction">发布优惠券营销活动</span>
                </a> -->
                <a href="<?php echo U('Guajiang/index',array('token'=>$token));?>" class="Navy" >
                    <img src="/tpl/User/default/common/images/guaguaka_34.jpg" /><span>刮刮卡</span><span class="introduction">发布刮刮卡营销活动</span>
                </a>
                <!--  <a href="<?php echo U('GoldenEgg/index',array('token'=>$token));?>" class="DarkGreen">
                    <img src="/tpl/User/default/common/images/zajindan_34.jpg" /><span>砸金蛋</span><span class="introduction">发布砸金蛋营销活动</span>
                </a> -->
				 <a href="<?php echo U('LuckyFruit/index',array('token'=>$token));?>" class="DarkGreen">
                    <img src="/tpl/User/default/common/images/zajindan_34.jpg" /><span>水果机</span><span class="introduction">发布水果机营销活动</span>
                </a>

				 <!-- <a href="<?php echo U('Wifi/index',array('token'=>$token));?>" class="Orange" >
                    <img src="/tpl/User/default/common/images/huiyuanka_34.jpg" /><span>无线wifi</span><span class="introduction">无线wifi</span>
                </a>
				  <a href="<?php echo U('Vcard/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/coin18.jpg" /><span>微名片</span><span class="introduction">微名片</span>
                </a>
				
				  <a href="<?php echo U('Dati/index',array('token'=>$token));?>" class="LightBlue">
                    <img src="/tpl/User/default/common/images/diyxuanchuan_34.jpg" /><span>一战到底</span><span class="introduction">一战到底</span>
                </a>
			   <a href="<?php echo U('Zhaopianwall/index',array('token'=>$token));?>" class="LightBlue">
                    <img src="/tpl/User/default/common/images/coin14.jpg" /><span>照片墙</span><span class="introduction">照片墙</span>
                </a>
				
				  <a href="<?php echo U('Czz/index',array('token'=>$token));?>" class="LightBlue">
                    <img src="/tpl/User/default/common/images/weixitie_34.jpg" /><span>吃粽子</span><span class="introduction">吃粽子</span>
                </a>
				 <a href="<?php echo U('Baoming/index',array('token'=>$token));?>" class="LightBlue">
                    <img src="/tpl/User/default/common/images/coin14.jpg" /><span>主题报名</span><span class="introduction">主题报名</span>
                </a>
				  <a href="<?php echo U('Game/index',array('token'=>$token));?>" class="LightBlue">
                    <img src="/tpl/User/default/common/images/coin14.jpg" /><span>2048游戏</span><span class="introduction">2048游戏</span>
                </a>
				  <a href="<?php echo U('Gamet/index',array('token'=>$token));?>" class="LightBlue">
                    <img src="/tpl/User/default/common/images/coin14.jpg" /><span>2048加强版</span><span class="introduction">2048加强版</span>
                </a>
				  <a href="<?php echo U('Gamett/index',array('token'=>$token));?>" class="LightBlue">
                    <img src="/tpl/User/default/common/images/coin14.jpg" /><span>Flappy 2048</span><span class="introduction">Flappy 2048</span>
                </a>
               
                               <a href="<?php echo U('Wxusermeasage/index',array('token'=>$token));?>" class="Orange" >
                    <img src="/tpl/User/default/common/images/kefu.jpg" /><span>人工客服</span><span class="introduction">这里您可以开通人工客户服务</span>
                </a> -->
            </div>


<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="contab" <?php if(in_array(MODULE_NAME,array('info','Member_card','privilege','create','exchange','Member'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <a href="<?php echo U('Member_card/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/huiyuanka_34.jpg" /><span>会员卡</span><span class="introduction">会员卡样式名称等信息设置</span>
                </a>
                <a href="<?php echo U('Member_card/replyInfoSet',array('token'=>$token));?>" class="Navy" >
                    <img src="/tpl/User/default/common/images/huiyuantequan_34.jpg" /><span>回复设置</span><span class="introduction">回复设置</span>
                </a>
         		 <a href="<?php echo U('Member_card/focus',array('token'=>$token));?>" class="DarkGreen" >
                    <img src="/tpl/User/default/common/images/zaixiankaika_34.jpg" /><span>幻灯片广告</span><span class="introduction">幻灯片广告</span>
                </a>
                <a href="<?php echo U('Member_card/custom',array('token'=>$token));?>" class="LightBlue" >
                    <img src="/tpl/User/default/common/images/jifenguanli_34.jpg" /><span>自定义输入项</span><span class="introduction">自定义输入项</span>
                </a>
            </div>

			
			<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="contab" <?php if(in_array(MODULE_NAME,array('Wechat_group','Wechat_zhiye','Wechat_behavior','Recognition','ServiceUser','Message','Share','Auth','Capital'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
              
				
				<a href="<?php echo U('Wechat_behavior/rule',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/disanfang_34.jpg" /><span>基础信息维护</span><span class="introduction">基础信息维护</span>
                </a>
				
				<a href="<?php echo U('Wechat_group/groups',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/coin14.jpg" /><span>项目维护</span><span class="introduction">项目维护</span>
                </a>
				
				<a href="<?php echo U('Wechat_zhiye/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/shangjiashezhi_34.jpg" /><span>置业顾问维护</span><span class="introduction">置业顾问维护</span>
                </a>
				
				<a href="<?php echo U('Recognition/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/bohaobanquan_34.jpg" /><span>注册条款维护</span><span class="introduction">注册条款维护</span>
                </a>
				
				<a href="<?php echo U('ServiceUser/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/kefu.jpg" /><span>客户信息维护</span><span class="introduction">客户信息维护</span>
                </a>
				
					<a href="<?php echo U('Message/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/guanzhuhuifu_34.jpg" /><span>案场经理维护</span><span class="introduction">案场经理维护</span>
                </a>
				
					<a href="<?php echo U('Share/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/lbshuifu_34.jpg" /><span>经纪人维护</span><span class="introduction">经纪人维护</span>
                </a>

                <a href="<?php echo U('Capital/index',array('token'=>$token));?>" class="LightBlue">
                    <img src="/tpl/User/default/common/images/coin14.jpg" /><span>佣金充值</span><span class="introduction">佣金充值</span>
                </a>
				
            </div>

<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <!-- <div class="contab" <?php if(in_array(MODULE_NAME,array('Expert','Fenx','Share_activite','Custom'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <a href="<?php echo U('Fenx/index',array('token'=>$token));?>" class="Navy" >
                    <img src="/tpl/User/default/common/images/coin22.jpg" /><span>分享设置</span><span class="introduction">分享设置</span>
                </a>
                  
                <a href="<?php echo U('Share_activite/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/lbshuifu_34.jpg" /><span>分享活动</span><span class="introduction">分享活动</span>
                </a> 

                <a href="<?php echo U('Expert/index',array('token'=>$token));?>" class="LightBlue">
                    <img src="/tpl/User/default/common/images/coin14.jpg" /><span>达人信息维护</span><span class="introduction">达人信息维护</span>
                </a> 

                <a href="<?php echo U('Custom/index',array('token'=>$token));?>" class="LightBlue">
                    <img src="/tpl/User/default/common/images/coin14.jpg" /><span>预约客户维护</span><span class="introduction">预约客户维护</span>
                </a>
                    
            </div> -->
            <div class="contab" <?php if(in_array(MODULE_NAME,array('Dining','Invites','Product','Groupon','orders','Host','Selfform','Adma','Reply_info','Xitie','Repast','Wedding','Yaoqing','Shoptmpls','Store','Yml','Alipay_config','Advert'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
           <a href="<?php echo U('Product/index',array('token'=>$token));?>" class="Red"  >
                    <img src="/tpl/User/default/common/images/weishangcheng_34.jpg" /><span>微商城</span><span class="introduction">移动端电子商务平台</span>
                </a>
            <a href="<?php echo U('Store/index',array('token'=>$token));?>" class="Red"  >
                    <img src="/tpl/User/default/common/images/weishangcheng_34.jpg" /><span>商城</span><span class="introduction">高级商城设置</span>
                </a>
        
        
            <a href="<?php echo U('Shoptmpls/index',array('token'=>$token));?>" class="Red"  >
                    <img src="/tpl/User/default/common/images/weishangcheng_34.jpg" /><span>商城模版</span><span class="introduction">商城模版设置</span>
                </a>
         
            <a href="<?php echo U('Alipay_config/index',array('token'=>$token));?>" class="LightPurple" >
                    <img src="/tpl/User/default/common/images/zhifuguanli_34.jpg" /><span>支付系统配置</span><span class="introduction">电子商务支付系统配置</span>
                </a>
                <a href="<?php echo U('Advert/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/weituangou_34.jpg" /><span>广告设置</span><span class="introduction">商城首页广告管理</span>
                </a>
               <!--  <a href="<?php echo U('Groupon/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/weituangou_34.jpg" /><span>微团购</span><span class="introduction">移动端团购平台</span>
                </a>
                <a href="<?php echo U('Host/index',array('token'=>$token));?>"  class="DarkGreen" >
                    <img src="/tpl/User/default/common/images/tongyongdingcan_34.jpg" /><span>通用订单</span><span class="introduction">电子商务平台订单管理</span>
                </a> -->
          
            </div>
        </div><!-- ThreeMenu end-->
    </div><!--Menu   end -->

<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.css" />
<script src="<?php echo STATICS;?>/kindeditor/kindeditor.js" type="text/javascript"></script>
<script src="<?php echo STATICS;?>/kindeditor/lang/zh_CN.js" type="text/javascript"></script>
<script src="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>
<script src="/tpl/static/artDialog/jquery.artDialog.js?skin=default"></script>
<script src="/tpl/static/artDialog/plugins/iframeTools.js"></script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#intro', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : true,
uploadJson : '/index.php?g=User&m=Upyun&a=kindedtiropic',
items : [
'source','undo','clearhtml','hr',
'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
'insertunorderedlist', '|', 'emoticons', 'image','link', 'unlink','baidumap','lineheight','table','anchor','preview','print','template','code','cut', 'music', 'video'],
afterBlur: function(){this.sync();}
});
});
</script>
  <div class="content"> 
   <div class="cLineB"> 
    <h4>商品设置</h4> 
    <a href="<?php echo U('Store/product',array('token'=>$token,'catid'=>$catid));?>" class="right  btnGreen" style="margin-top:-27px">返回</a> 
   </div> 
<?php if($isUpdate == 1): ?><input type="hidden" name="id" value="<?php echo ($set["id"]); ?>" /><?php endif; ?>
<form method="post" action="" id="formID">
<input type="hidden" name="discount" id="discount" value="<?php echo ($set["discount"]); ?>" />
    <div class="msgWrap bgfc"> 
     <table class="userinfoArea" style=" margin:0;" border="0" cellspacing="0" cellpadding="0" width="100%"> 
      <tbody> 
       <tr> 
        <th><span class="red">*</span>名称：</th> 
        <td>
        <input type="hidden" name="pid" id="pid" value="<?php echo ($set["id"]); ?>"/>
        <input type="text" name="name" id="name" value="<?php echo ($set["name"]); ?>" class="px" style="width:400px;" />
        </td> 
       </tr> 
       <tr> 
        <th>类别：</th> 
        <td><span class="red"><?php echo ($productCatData["name"]); ?></span></td> 
       </tr>
       <?php if(empty($productCatData['color']) != true): ?><tr>
	       <th><?php echo ($productCatData["color"]); ?>：</th>
	       <td>
	       		<table>
	       		<tr>
	       		<?php if(is_array($colorData)): $i = 0; $__LIST__ = $colorData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$norms): $mod = ($i % 2 );++$i;?><td width="130">
				<?php if((in_array($norms['id'], $colorList))): ?><input type="checkbox" name="color[]" value="<?php echo ($norms["id"]); ?>" class="color" id="norms_<?php echo ($norms["id"]); ?>" atr="<?php echo ($norms["value"]); ?>" checked/>&nbsp;&nbsp;<label for="norms_<?php echo ($norms["id"]); ?>"><?php echo ($norms["value"]); ?></label>
				<?php else: ?>
				<input type="checkbox" name="color[]" value="<?php echo ($norms["id"]); ?>" class="color" id="norms_<?php echo ($norms["id"]); ?>" atr="<?php echo ($norms["value"]); ?>"/>&nbsp;&nbsp;<label for="norms_<?php echo ($norms["id"]); ?>"><?php echo ($norms["value"]); ?></label><?php endif; ?>
				</td>
				<?php if(($i%5 == 0)): ?></tr><tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</tr>
				</table>
	       </td>
       </tr><?php endif; ?>
       <!-- 规格 -->
       <?php if(empty($productCatData['norms']) != true): ?><tr>
	       <th><?php echo ($productCatData["norms"]); ?>：</th>
	       <td>
	       		<table>
	       		<tr>
	       		<?php if(is_array($formatData)): $i = 0; $__LIST__ = $formatData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$norms): $mod = ($i % 2 );++$i;?><td width="130">
				<?php if((in_array($norms['id'], $formatList))): ?><input type="checkbox" name="norms[]" value="<?php echo ($norms["id"]); ?>" class="norms" id="norms_<?php echo ($norms["id"]); ?>" atr="<?php echo ($norms["value"]); ?>" checked/>&nbsp;&nbsp;<label for="norms_<?php echo ($norms["id"]); ?>"><?php echo ($norms["value"]); ?></label>
				<?php else: ?>
				<input type="checkbox" name="norms[]" value="<?php echo ($norms["id"]); ?>" class="norms" id="norms_<?php echo ($norms["id"]); ?>" atr="<?php echo ($norms["value"]); ?>"/>&nbsp;&nbsp;<label for="norms_<?php echo ($norms["id"]); ?>"><?php echo ($norms["value"]); ?></label><?php endif; ?>
				</td>
				<?php if(($i%5 == 0)): ?></tr><tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</tr>
				</table>
	       </td>
       </tr><?php endif; ?>
       <tr>
			<td colspan="2">
				<table id="priceList">
					<?php if(($productDetailData != null) ): ?><tr><th width="130">产品外观</th><th width="130">产品规格</th><th width="130">价格</th><th width="130">会员价</th><th width="130">数量</th></tr>
			        <?php if(is_array($productDetailData)): $i = 0; $__LIST__ = $productDetailData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$detail): $mod = ($i % 2 );++$i;?><input type="hidden" class="editselect" value="<?php echo ($detail["id"]); ?>,<?php echo ($detail["color"]); ?>,<?php echo ($detail["colorName"]); ?>,<?php echo ($detail["format"]); ?>,<?php echo ($detail["formatName"]); ?>,<?php echo ($detail["price"]); ?>,<?php echo ($detail["num"]); ?>"/>
				       <tr class="tnorms">
					       <td width="130"><?php echo ($detail["colorName"]); ?><input type="hidden" value="<?php echo ($detail["color"]); ?>"/></td>
					       <td width="130"><?php echo ($detail["formatName"]); ?><input type="hidden" value="<?php echo ($detail["format"]); ?>"/></td>
					       <td width="130"><input type="text" class="px" style="width:60px;" value="<?php echo ($detail["price"]); ?>"/></td>
					       <td width="130"><input type="text" class="px" style="width:60px;" value="<?php echo ($detail["vprice"]); ?>"/></td>
					       <td width="130"><input type="text" class="px" style="width:60px;" value="<?php echo ($detail["num"]); ?>"/></td>
					       <td width="130"><input type="hidden" value="<?php echo ($detail["id"]); ?>"/></td>
				       </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
				</table>
			</td>
       </tr>
       <?php if(is_array($attributeData)): $i = 0; $__LIST__ = $attributeData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attribute): $mod = ($i % 2 );++$i;?><tr>
		       <th><?php echo ($attribute["name"]); ?>：</th>
		       <td>
					<input type="text" value="<?php echo ($attribute["value"]); ?>" class="attribute px" style="width:400px;" atr="<?php echo ($attribute["name"]); ?>" id="<?php echo ($attribute["id"]); ?>" aid="<?php echo ($attribute["aid"]); ?>"/>
		       </td>
	       </tr><?php endforeach; endif; else: echo "" ;endif; ?>
       <tr> 
        <th><span class="red">*</span>价格：</th>
        <td><input type="text" id="price" name="price" value="<?php echo ($set["price"]); ?>" class="validate[required, length[0,20]] px" style="width:100px;" /> 元</td> 
       </tr>
       <tr> 
        <th><span class="red">*</span>会员价：</th> 
        <td><input type="text" id="vprice" name="vprice" value="<?php echo ($set["vprice"]); ?>" class="px" style="width:100px;" /> 元</td> 
       </tr>
       <tr> 
        <th><span class="red">*</span>原价：</th> 
        <td><input type="text" id="oprice" name="oprice" value="<?php echo ($set["oprice"]); ?>" class="px" style="width:100px;" /> 元</td> 
       </tr>
       <tr> 
        <th>库存：</th> 
        <td><input type="text" id="num" name="num" value="<?php echo ($set["num"]); ?>" class="px" style="width:100px;" /></td> 
       </tr>
       <tr> 
        <th>邮费：</th> 
        <td><input type="text" id="mailprice" name="mailprice" value="<?php echo ($set["mailprice"]); ?>" class="px" style="width:100px;" /> 元</td> 
       </tr>
        <tr> 
        <th><span class="red">*</span>关键词：</th>
        <td><input type="text" name="keyword" id="keyword" value="<?php echo ($set["keyword"]); ?>" class="px" style="width:400px;" /></td> 
       </tr>
       <tr> 
        <th>Logo地址：</th>
        <td><input type="text" name="logourl" value="<?php echo ($set["logourl"]); ?>" class="px" id="pic" style="width:400px;" />  <script src="/tpl/static/upyun.js"></script><a href="###" onclick="upyunPicUpload('pic',700,700,'<?php echo ($token); ?>')" class="a_upload">上传</a> <a href="###" onclick="viewImg('pic')">预览</a></td> 
       </tr>
       <tr> 
        <th>展示图片一：</th>
        <td><input type="text" name="image1" value="<?php echo ($imageList[0]["image"]); ?>" imageid="<?php echo ($imageList[0]["id"]); ?>" class="px" id="image1" style="width:400px;" />  <script src="/tpl/static/upyun.js"></script><a href="###" onclick="upyunPicUpload('image1',700,700,'<?php echo ($token); ?>')" class="a_upload">上传</a> <a href="###" onclick="viewImg('image1')">预览</a></td> 
       </tr>
       <tr> 
        <th>展示图片二：</th>
        <td><input type="text" name="image2" value="<?php echo ($imageList[1]["image"]); ?>" imageid="<?php echo ($imageList[1]["id"]); ?>" class="px" id="image2" style="width:400px;" />  <script src="/tpl/static/upyun.js"></script><a href="###" onclick="upyunPicUpload('image2',700,700,'<?php echo ($token); ?>')" class="a_upload">上传</a> <a href="###" onclick="viewImg('image2')">预览</a></td> 
       </tr>
       <tr> 
        <th>展示图片三：</th>
        <td><input type="text" name="image3" value="<?php echo ($imageList[2]["image"]); ?>" imageid="<?php echo ($imageList[2]["id"]); ?>" class="px" id="image3" style="width:400px;" />  <script src="/tpl/static/upyun.js"></script><a href="###" onclick="upyunPicUpload('image3',700,700,'<?php echo ($token); ?>')" class="a_upload">上传</a> <a href="###" onclick="viewImg('image3')">预览</a></td> 
       </tr>
       <tr> 
        <th>展示图片四：</th>
        <td><input type="text" name="image4" value="<?php echo ($imageList[3]["image"]); ?>" imageid="<?php echo ($imageList[3]["id"]); ?>" class="px" id="image4" style="width:400px;" />  <script src="/tpl/static/upyun.js"></script><a href="###" onclick="upyunPicUpload('image4',700,700,'<?php echo ($token); ?>')" class="a_upload">上传</a> <a href="###" onclick="viewImg('image4')">预览</a></td> 
       </tr>
       <tr> 
        <th>展示图片五：</th>
        <td><input type="text" name="image5" value="<?php echo ($imageList[4]["image"]); ?>" imageid="<?php echo ($imageList[4]["id"]); ?>" class="px" id="image5" style="width:400px;" />  <script src="/tpl/static/upyun.js"></script><a href="###" onclick="upyunPicUpload('image5',700,700,'<?php echo ($token); ?>')" class="a_upload">上传</a> <a href="###" onclick="viewImg('image5')">预览</a></td> 
       </tr>
       <tr> 
        <th>展示图片六：</th>
        <td><input type="text" name="image6" value="<?php echo ($imageList[5]["image"]); ?>" imageid="<?php echo ($imageList[5]["id"]); ?>" class="px" id="image6" style="width:400px;" />  <script src="/tpl/static/upyun.js"></script><a href="###" onclick="upyunPicUpload('image6',700,700,'<?php echo ($token); ?>')" class="a_upload">上传</a> <a href="###" onclick="viewImg('image6')">预览</a></td> 
       </tr>
       <TR>
          <TH valign="top"><label for="info">图文详细页内容：</label></TH>
          <TD><textarea name="intro" id="intro"  rows="5" style="width:590px;height:360px"><?php echo ($set["intro"]); ?></textarea></TD>
       </TR>  
       <tr>         
       <th>&nbsp;</th>
       <td>
       <button type="button" name="button" class="btnGreen" id="save">保存</button> &nbsp; <a href="<?php echo U('Store/index',array('token'=>$token, 'catid' => $catid));?>" class="btnGray vm">取消</a></td> 
       </tr> 
      </tbody> 
     </table> 
     </div>
</form>
  </div> 
<script type="text/javascript">
$(document).ready(function(){
	var oldselect = [];
	$(".editselect").each(function(){
		var t = $(this).val().split(",");
		//alert(t[0]+'---'+ parseInt(t[1])+'---'+  t[2]+'---'+  t[3]+'---'+  t[4]+'---'+  t[5]+'---'+  t[6]);
		oldselect[t[1] + '_' + t[3]] = new Array(t[0], t[1], t[2], t[3], t[4], t[5], t[6], t[7]);
	});
	$(".color").click(function(){
		var selectValue = [];
		var html = '';
		var header = '<tr><th width="130">产品外观</th><th width="130">产品规格</th><th width="130">价格</th><th width="130">会员价</th><th width="130">数量</th></tr>';
		if ($(".norms").html() == null) {
			$(".color").each(function(){
				if ($(this).attr('checked')) {
					var color = $(this).attr('atr');
					var colorid = $(this).val();
					selectValue[colorid + '_' + 0] = new Array(0, colorid, color, 0, '', 0, 0, 0);
				}
			});
		} else {
			$(".color").each(function(){
				if ($(this).attr('checked')) {
					var color = $(this).attr('atr');
					var colorid = $(this).val();
					$(".norms").each(function(){
						if ($(this).attr('checked')) {
							var norms = $(this).attr('atr');
							var normsid = $(this).val();
							selectValue[colorid + '_' + normsid] = new Array(0, colorid, color, normsid, norms, 0, 0, 0);
							//selectValue[colorid + '_' + normsid] = '<tr class="tnorms"><td width="130">' + color + '<input type="hidden" value="' + colorid + '"/></td><td width="130">' + norms + '<input type="hidden" value="' + normsid + '"/></td><td width="130"><input type="text" class="px" style="width:60px;"/></td><td width="130"><input type="text" class="px" style="width:60px;"/></td><td><input type="hidden" value="0"/></td></tr>';
						}
					});
				}
			});
		}
		for (var index in selectValue) {
			if (oldselect[index] != null && oldselect[index] != '') {
				html += '<tr class="tnorms"><td width="130">' + oldselect[index][2] + '<input type="hidden" value="' + oldselect[index][1] + '"/></td>';
				html += '<td width="130">' + oldselect[index][4] + '<input type="hidden" value="' + oldselect[index][3] + '"/></td>';
				html += '<td width="130"><input type="text" class="px" style="width:60px;" value="' + oldselect[index][5] + '"/></td>';
				html += '<td width="130"><input type="text" class="px" style="width:60px;" value="' + oldselect[index][6] + '"/></td>';
				html += '<td width="130"><input type="text" class="px" style="width:60px;" value="' + oldselect[index][7] + '"/></td>';
				html += '<td><input type="hidden" value="' + oldselect[index][0] + '"/></td></tr>';
			} else {
				html += '<tr class="tnorms"><td width="130">' + selectValue[index][2] + '<input type="hidden" value="' + selectValue[index][1] + '"/></td>';
				html += '<td width="130">' + selectValue[index][4] + '<input type="hidden" value="' + selectValue[index][3] + '"/></td>';
				html += '<td width="130"><input type="text" class="px" style="width:60px;" value="' + selectValue[index][5] + '"/></td>';
				html += '<td width="130"><input type="text" class="px" style="width:60px;" value="' + selectValue[index][6] + '"/></td>';
				html += '<td width="130"><input type="text" class="px" style="width:60px;" value="' + selectValue[index][7] + '"/></td>';
				html += '<td><input type="hidden" value="' + selectValue[index][0] + '"/></td></tr>';
			}
			//html += selectValue[index];
		}
		if (html != '') {
			$("#priceList").html(header + html);
		} else {
			$("#priceList").html('');
		}
	});
	$(".norms").click(function(){
		var selectValue = [];
		var html = '';
		var header = '<tr><th width="130">产品外观</th><th width="130">产品规格</th><th width="130">价格</th><th width="130">会员价</th><th width="130">数量</th></tr>';
		if ($(".color").html() == null) {
			$(".norms").each(function(){
				if ($(this).attr('checked')) {
					var norms = $(this).attr('atr');
					var normsid = $(this).val();
					selectValue[0 + '_' + normsid] = new Array(0, 0, '', normsid, norms, 0, 0, 0);
					//selectValue[colorid + '_' + normsid] = '<tr class="tnorms"><td width="130">' + color + '<input type="hidden" value="' + colorid + '"/></td><td width="130">' + norms + '<input type="hidden" value="' + normsid + '"/></td><td width="130"><input type="text" class="px" style="width:60px;"/></td><td width="130"><input type="text" class="px" style="width:60px;"/></td><td><input type="hidden" value="0"/></td></tr>';
				}
			});
		} else {
			$(".color").each(function(){
				if ($(this).attr('checked')) {
					var color = $(this).attr('atr');
					var colorid = $(this).val();
					$(".norms").each(function(){
						if ($(this).attr('checked')) {
							var norms = $(this).attr('atr');
							var normsid = $(this).val();
							selectValue[colorid + '_' + normsid] = new Array(0, colorid, color, normsid, norms, 0, 0, 0);
							//selectValue[colorid + '_' + normsid] = '<tr class="tnorms"><td width="130">' + color + '<input type="hidden" value="' + colorid + '"/></td><td width="130">' + norms + '<input type="hidden" value="' + normsid + '"/></td><td width="130"><input type="text" class="px" style="width:60px;"/></td><td width="130"><input type="text" class="px" style="width:60px;"/></td><td><input type="hidden" value="0"/></td></tr>';
						}
					});
				}
			});
		}
		for (var index in selectValue) {
			if (oldselect[index] != null && oldselect[index] != '') {
				html += '<tr class="tnorms"><td width="130">' + oldselect[index][2] + '<input type="hidden" value="' + oldselect[index][1] + '"/></td>';
				html += '<td width="130">' + oldselect[index][4] + '<input type="hidden" value="' + oldselect[index][3] + '"/></td>';
				html += '<td width="130"><input type="text" class="px" style="width:60px;" value="' + oldselect[index][5] + '"/></td>';
				html += '<td width="130"><input type="text" class="px" style="width:60px;" value="' + oldselect[index][6] + '"/></td>';
				html += '<td width="130"><input type="text" class="px" style="width:60px;" value="' + oldselect[index][7] + '"/></td>';
				html += '<td><input type="hidden" value="' + oldselect[index][0] + '"/></td></tr>';
			} else {
				html += '<tr class="tnorms"><td width="130">' + selectValue[index][2] + '<input type="hidden" value="' + selectValue[index][1] + '"/></td>';
				html += '<td width="130">' + selectValue[index][4] + '<input type="hidden" value="' + selectValue[index][3] + '"/></td>';
				html += '<td width="130"><input type="text" class="px" style="width:60px;" value="' + selectValue[index][5] + '"/></td>';
				html += '<td width="130"><input type="text" class="px" style="width:60px;" value="' + selectValue[index][6] + '"/></td>';
				html += '<td width="130"><input type="text" class="px" style="width:60px;" value="' + selectValue[index][7] + '"/></td>';
				html += '<td><input type="hidden" value="' + selectValue[index][0] + '"/></td></tr>';
			}
			//html += selectValue[index];
		}
		if (html != '') {
			$("#priceList").html(header + html);
		} else {
			$("#priceList").html('');
		}
	});
	$("#save").click(function(){
		var name = $("#name").val();
		if (name.length < 1) {
			art.dialog({title:'消息提示', ok:true, width:300, height:200, content:'名称不能为空'});
			return false;
		}
		var num = $("#num").val();
		if (isNaN(num)) {
			art.dialog({title:'消息提示', ok:true, width:300, height:200, content:'库存应该是为正整数'});
			return false;
		}
		var price = $("#price").val();
		var vprice = $("#vprice").val();
		var oprice = $("#oprice").val();
		var mailprice = $("#mailprice").val();
		var keyword = $("#keyword").val();
		var pic = $("#pic").val();
		var intro = $("#intro").val();
		var attribute = [];
		var i = 0;
		var str = '';
		$(".attribute").each(function(){
			attribute[i]= {'name':$(this).attr('atr'), 'value':$(this).val(), 'aid':$(this).attr('aid'), 'id':$(this).attr('id')};//new Array($(this).attr('atr'), $(this).val());
			i ++;
		});
		var norms = [];
		var i = 0;
		var tnum = 0;
		$(".tnorms").each(function(){
			tnum += parseInt($(this).children('td').eq(3).children('input').val());
			norms[i]= {'color':$(this).children('td').eq(0).children('input').val(), 'format':$(this).children('td').eq(1).children('input').val(), 'price':$(this).children('td').eq(2).children('input').val(), 'vprice':$(this).children('td').eq(3).children('input').val(), 'num':$(this).children('td').eq(4).children('input').val(), 'id':$(this).children('td').eq(5).children('input').val()};
			i ++;
		});
		if (tnum > 0) {
			num = tnum;
		}
		//num = num > tnum ? num : tnum;
		var image1 = $("#image1").val();
		var image2 = $("#image2").val();
		var image3 = $("#image3").val();
		var image4 = $("#image4").val();
		var image5 = $("#image5").val();
		var image6 = $("#image6").val();
		var imageid1 = parseInt($("#image1").attr('imageid'));
		var imageid2 = parseInt($("#image2").attr('imageid'));
		var imageid3 = parseInt($("#image3").attr('imageid'));
		var imageid4 = parseInt($("#image4").attr('imageid'));
		var imageid5 = parseInt($("#image5").attr('imageid'));
		var imageid6 = parseInt($("#image6").attr('imageid'));
		var images = [];
		images[0] = {'id':imageid1, 'image':image1};
		images[1] = {'id':imageid2, 'image':image2};
		images[2] = {'id':imageid3, 'image':image3};
		images[3] = {'id':imageid4, 'image':image4};
		images[4] = {'id':imageid5, 'image':image5};
		images[5] = {'id':imageid6, 'image':image6};
		var data = {pid:$("#pid").val(),
					name:name,
					num:num,
					price:price,
					vprice:vprice,
					oprice:oprice,
					mailprice:mailprice,
					keyword:keyword,
					pic:pic,
					intro:intro,
					attribute:JSON.stringify(attribute),
					norms:JSON.stringify(norms),
					images:JSON.stringify(images),
					token:'<?php echo ($token); ?>',
					catid:'<?php echo ($catid); ?>'
					};
		$.post('index.php?g=User&m=Store&a=productSave', data, function(response){
			if (response.error_code == false) {
				art.dialog({
					title:'消息提示', 
				    content: response.msg, 
				    width:300, 
				    height:200,
				    lock: true,
				    ok: function () {
				    	this.time(3);
				    	location.href='index.php?g=User&m=Store&a=product&token=<?php echo ($token); ?>&catid=<?php echo ($catid); ?>'
				        return false;
				    },
				    cancelVal: '关闭'
				});
			} else {
				art.dialog({title:'消息提示', time:2, width:300, height:200, content:response.msg});
			}
			
		}, 'json');
	});
});
</script>
<div class="clr"></div>
</div>
</body>
</html>