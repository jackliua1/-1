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
	<?php if(session('uid') == 3): ?><div class="TwoMenu">
            <a href="<?php echo U('Wechat_group/groups',array('token'=>$token));?>" >
                <img src="/tpl/User/default/common/images/CRM.jpg" />
            </a>
            <div id="TwoMenu-01" <?php if(in_array(MODULE_NAME,array('Wechat_group','Wechat_behavior','Recognition','ServiceUser','Message','Share','Auth','Brokerage','Districtmanager'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <img src="/tpl/User/default/common/images/CRM2.jpg" />
            </div>
            <a href="<?php echo U('Product/index',array('token'=>$token));?>" >
                <img src="/tpl/User/default/common/images/shangwu.jpg" />
            </a>
            <div id="TwoMenu-02" <?php if(in_array(MODULE_NAME,array('Dining','Invites','Shoptmpls','Product','Groupon','orders','Host','Yaoqing','Selfform','Wedding','Adma','Reply_info','Repast','Store','Yml','Alipay_config','Advert'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <img src="/tpl/User/default/common/images/shangwu2.jpg" />
            </div>			
        </div>
	<?php else: ?>
        <div class="TwoMenu">
            <a href="<?php echo U('Function/index',array('token'=>$token,'id'=>session('wxid')));?>" >
                <img src="/tpl/User/default/common/images/jichu.jpg" />
        
            </a>
            <div id="TwoMenu-01" <?php if(in_array(MODULE_NAME,array('Function','Areply','Text','Voiceresponse','Call','Company','Other','Diymen','Requerydata','Index','Printer','Api','Panorama','Img'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <img src="/tpl/User/default/common/images/jichu2.jpg" />
            </div>

<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <!--  <a href="<?php echo U('Lottery/index',array('token'=>$token));?>" >
                <img src="/tpl/User/default/common/images/yingxiao.jpg" />
            </a>
            <div id="TwoMenu-02" <?php if(in_array(MODULE_NAME,array('Lottery','Dati','Coupon','Guajiang','Zadan','Wxusermeasage','GoldenEgg','LuckyFruit','Router','Vcard','Wifi','Zhaopianwall','Czz','Game','Gamet','Gamett','Baoming'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <img src="/tpl/User/default/common/images/yingxiao2.jpg" />
            </div>-->

<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
          <!--  <a href="<?php echo U('Member_card/index',array('token'=>$token));?>" >
                <img src="/tpl/User/default/common/images/huiyuan.jpg" />
            </a>
            <div id="TwoMenu-03" <?php if(in_array(MODULE_NAME,array('info','Member_card','privilege','create','exchange','Member'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <img src="/tpl/User/default/common/images/huiyuan2.jpg" />
            </div>-->



<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <a href="<?php echo U('Wechat_group/groups',array('token'=>$token));?>" >
                <img src="/tpl/User/default/common/images/CRM.jpg" />
            </a>
            <div id="TwoMenu-02" <?php if(in_array(MODULE_NAME,array('Wechat_group','Wechat_behavior','Recognition','ServiceUser','Message','Share','Auth','Brokerage','Districtmanager'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
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
            <div id="TwoMenu-03" <?php if(in_array(MODULE_NAME,array('Dining','Invites','Shoptmpls','Product','Groupon','orders','Host','Yaoqing','Selfform','Wedding','Adma','Reply_info','Repast','Store','Yml','Alipay_config','Advert'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <img src="/tpl/User/default/common/images/shangwu2.jpg" />
            </div>			
        </div><!-- TwoMenu   end--><?php endif; ?>
</div>



<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
<div class="Menu">
	<?php if(session('uid') == 3): ?><div class="ThreeMenu">
            <div class="contab" <?php if(in_array(MODULE_NAME,array('Wechat_group','Wechat_zhiye','Wechat_behavior','Recognition','ServiceUser','Message','Share','Auth','Capital','Brokerage','Districtmanager'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
              
				<a href="<?php echo U('Wechat_group/groups',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/coin14.jpg" /><span>项目维护</span><span class="introduction">项目维护</span>
                </a>
            </div>

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
            </div>
        </div><!-- ThreeMenu end-->
	<?php else: ?>
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
            <div class="contab" <?php if(in_array(MODULE_NAME,array('Wechat_group','Wechat_zhiye','Wechat_behavior','Recognition','ServiceUser','Message','Share','Auth','Capital','Brokerage','Districtmanager'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
              
				
				<!-- <a href="<?php echo U('Wechat_behavior/rule',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/disanfang_34.jpg" /><span>基础信息维护</span><span class="introduction">基础信息维护</span>
                </a>-->
				
				<!-- <a href="<?php echo U('Recognition/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/bohaobanquan_34.jpg" /><span>注册条款维护</span><span class="introduction">注册条款维护</span>
                </a> -->
				
				<a href="<?php echo U('Wechat_group/groups',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/coin14.jpg" /><span>项目维护</span><span class="introduction">项目维护</span>
                </a>
				
				<a href="<?php echo U('ServiceUser/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/kefu.jpg" /><span>客户信息维护</span><span class="introduction">客户信息维护</span>
                </a>
				
				<a href="<?php echo U('Wechat_zhiye/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/shangjiashezhi_34.jpg" /><span>驻场经理维护</span><span class="introduction">驻场经理维护</span>
                </a>
				
					<a href="<?php echo U('Message/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/guanzhuhuifu_34.jpg" /><span>项目总监维护</span><span class="introduction">项目总监维护</span>
                </a>
				
                  <a href="<?php echo U('Districtmanager/index',array('token'=>$token));?>" class="Highland" >
                      <img src="<?php echo RES;?>/images/lbshuifu_34.jpg" /><span>片区经理管理</span><span class="introduction">经纪公司管理</span>
                  </a>
				
				<a href="<?php echo U('Brokerage/index',array('token'=>$token));?>" class="Highland" >
                      <img src="<?php echo RES;?>/images/lbshuifu_34.jpg" /><span>经纪公司管理</span><span class="introduction">经纪公司管理</span>
                  </a>

				
					<a href="<?php echo U('Share/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/lbshuifu_34.jpg" /><span>经纪人维护</span><span class="introduction">经纪人维护</span>
                </a>
			

                <!-- <a href="<?php echo U('Capital/index',array('token'=>$token));?>" class="LightBlue">
                    <img src="/tpl/User/default/common/images/coin14.jpg" /><span>佣金充值</span><span class="introduction">佣金充值</span>
                </a> -->
				
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
        </div><!-- ThreeMenu end--><?php endif; ?>
    </div><!--Menu   end -->


<!--鼠标移动上去效果start-->

<style>

    li .mbtip {

    display: none;

} 

.cateradio li:hover .mbtip {

    background-color: #000000;

    border: 1px solid rgba(0, 0, 0, 0.15);

    border-radius: 7px;

    box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.15);

    color: #FFFFFF;

    display: block;

    padding: 6px;

    float:right;

    position:relative;

    right:-140px;

    top:-325px;

    width: 130px;

    text-align: left;

    z-index: 999;

}



</style>





<!--鼠标移动上去效果end-->

<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/themes/default/default.css" />

<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.css" />

<script src="<?php echo STATICS;?>/kindeditor/kindeditor.js" type="text/javascript"></script>

<script src="<?php echo STATICS;?>/kindeditor/lang/zh_CN.js" type="text/javascript"></script>

<script src="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>

<div class="content">



    <div class="cLineB">

        <h4>商城首页模板管理 <span class="FAQ">选择适合您的商城首页模版风格，手机输入“商城”测试效果。</span></h4>

    </div>



    <div class="msgWrap form">

        <ul id="tags">

            <li class="selectTag"><a onclick="selectTag('tagContent0',this)" href="javascript:void(0)">1. 商城首页模板风格</a> </li>

     

            <div class="clr"></div>

        </ul>



        <div id="tagContent">

            <div class="tagContent selectTag" id="tagContent0">

                <fieldset>

                    <ul class="cateradio">
                   

					<li <?php if(($info["shoptpltypeid"]) == "1"): ?>class="active"<?php endif; ?>>                   

                            <label>

                                <img src="<?php echo RES;?>/images/shop/cate101.png" >

                                <input class="radio" type="radio" name="optype" value="1" <?php if(($info["shoptpltypeid"]) == "1"): ?>checked<?php endif; ?> /> 商城模板风格1

                            </label>

                             <?php if($desinfo[1] != ''): ?><p class="mbtip"><?php echo ($desinfo[1]); ?></p><?php endif; ?>

                        </li>

                        <li <?php if(($info["shoptpltypeid"]) == "2"): ?>class="active"<?php endif; ?>>                   

                            <label>

                                <img src="<?php echo RES;?>/images/shop/cate102.png" >

                                <input class="radio" type="radio" name="optype" value="2" <?php if(($info["shoptpltypeid"]) == "2"): ?>checked<?php endif; ?> /> 商城模板风格2 

                            </label>

                             <?php if($desinfo[2] != ''): ?><p class="mbtip"><?php echo ($desinfo[2]); ?></p><?php endif; ?>

                        </li>
                         <li <?php if(($info["shoptpltypeid"]) == "3"): ?>class="active"<?php endif; ?>>                   

                            <label>

                                <img src="<?php echo RES;?>/images/shop/cate103.png" >

                                <input class="radio" type="radio" name="optype" value="3" <?php if(($info["shoptpltypeid"]) == "3"): ?>checked<?php endif; ?> /> 商城模板风格3

                            </label>

                             <?php if($desinfo[3] != ''): ?><p class="mbtip"><?php echo ($desinfo[3]); ?></p><?php endif; ?>

                        </li>
                        <li <?php if(($info["shoptpltypeid"]) == "4"): ?>class="active"<?php endif; ?>>                   

                            <label>

                                <img src="<?php echo RES;?>/images/cate1142.png" >

                                <input class="radio" type="radio" name="optype" value="4" <?php if(($info["shoptpltypeid"]) == "4"): ?>checked<?php endif; ?> /> 商城模板风格4

                            </label>

                             <?php if($desinfo[4] != ''): ?><p class="mbtip"><?php echo ($desinfo[4]); ?></p><?php endif; ?>

                        </li>
                         <li <?php if(($info["shoptpltypeid"]) == "5"): ?>class="active"<?php endif; ?>>                   

                            <label>

                                <img src="<?php echo RES;?>/images/cate1139.png" >

                                <input class="radio" type="radio" name="optype" value="5" <?php if(($info["shoptpltypeid"]) == "5"): ?>checked<?php endif; ?> /> 商城模板风格5

                            </label>

                             <?php if($desinfo[5] != ''): ?><p class="mbtip"><?php echo ($desinfo[5]); ?></p><?php endif; ?>

                        </li>
                         <li <?php if(($info["shoptpltypeid"]) == "6"): ?>class="active"<?php endif; ?>>                   

                            <label>

                                <img src="<?php echo RES;?>/images/cate1133.png" >

                                <input class="radio" type="radio" name="optype" value="6" <?php if(($info["shoptpltypeid"]) == "6"): ?>checked<?php endif; ?> /> 商城模板风格6

                            </label>

                             <?php if($desinfo[6] != ''): ?><p class="mbtip"><?php echo ($desinfo[7]); ?></p><?php endif; ?>

                        </li>
                         <li <?php if(($info["shoptpltypeid"]) == "7"): ?>class="active"<?php endif; ?>>                   

                            <label>

                                <img src="<?php echo RES;?>/images/cate1131.png" >

                                <input class="radio" type="radio" name="optype" value="7" <?php if(($info["shoptpltypeid"]) == "7"): ?>checked<?php endif; ?> /> 商城模板风格7

                            </label>

                             <?php if($desinfo[6] != ''): ?><p class="mbtip"><?php echo ($desinfo[7]); ?></p><?php endif; ?>

                        </li>
                          <li <?php if(($info["shoptpltypeid"]) == "8"): ?>class="active"<?php endif; ?>>                   

                            <label>

                                <img src="<?php echo RES;?>/images/cate194.png" >

                                <input class="radio" type="radio" name="optype" value="8" <?php if(($info["shoptpltypeid"]) == "8"): ?>checked<?php endif; ?> /> 商城模板风格8

                            </label>

                             <?php if($desinfo[8] != ''): ?><p class="mbtip"><?php echo ($desinfo[8]); ?></p><?php endif; ?>

                        </li>
                         <li <?php if(($info["shoptpltypeid"]) == "9"): ?>class="active"<?php endif; ?>>                   

                            <label>

                                <img src="<?php echo RES;?>/images/cate1130.png" >

                                <input class="radio" type="radio" name="optype" value="9" <?php if(($info["shoptpltypeid"]) == "9"): ?>checked<?php endif; ?> /> 商城模板风格9

                            </label>

                             <?php if($desinfo[9] != ''): ?><p class="mbtip"><?php echo ($desinfo[9]); ?></p><?php endif; ?>

                        </li>
                         <li <?php if(($info["shoptpltypeid"]) == "10"): ?>class="active"<?php endif; ?>>                   

                            <label>

                                <img src="<?php echo RES;?>/images/cate199.png" >

                                <input class="radio" type="radio" name="optype" value="10" <?php if(($info["shoptpltypeid"]) == "10"): ?>checked<?php endif; ?> /> 商城模板风格10

                            </label>

                             <?php if($desinfo[10] != ''): ?><p class="mbtip"><?php echo ($desinfo[10]); ?></p><?php endif; ?>

                        </li>
                          <li <?php if(($info["shoptpltypeid"]) == "11"): ?>class="active"<?php endif; ?>>                   

                            <label>

                                <img src="<?php echo RES;?>/images/cate187.png" >

                                <input class="radio" type="radio" name="optype" value="11" <?php if(($info["shoptpltypeid"]) == "11"): ?>checked<?php endif; ?> /> 商城模板风格11

                            </label>

                             <?php if($desinfo[11] != ''): ?><p class="mbtip"><?php echo ($desinfo[11]); ?></p><?php endif; ?>

                        </li>
                         <li <?php if(($info["shoptpltypeid"]) == "12"): ?>class="active"<?php endif; ?>>                   

                            <label>

                                <img src="<?php echo RES;?>/images/cate184.png" >

                                <input class="radio" type="radio" name="optype" value="12" <?php if(($info["shoptpltypeid"]) == "12"): ?>checked<?php endif; ?> /> 商城模板风格12

                            </label>

                             <?php if($desinfo[12] != ''): ?><p class="mbtip"><?php echo ($desinfo[12]); ?></p><?php endif; ?>

                        </li>


                      
                      
                     




                        <!--li <?php if(($info["shoptpltypeid"]) == "6"): ?>class="active"<?php endif; ?>><label><img src="<?php echo RES;?>/images/cate6.png"><input class="radio" type="radio" name="optype" <?php if(($_SESSION['gid']) == "2"): ?>disabled="disabled"<?php endif; ?> value="6" <?php if(($info["shoptpltypeid"]) == "6"): ?>checked<?php endif; ?> /> v1模板6(metro风格) </label></li>

                        <li <?php if(($info["shoptpltypeid"]) == "7"): ?>class="active"<?php endif; ?>><label><img src="<?php echo RES;?>/images/cate7.png" title="提示：头部为首页封面图片外链720x400，高度可以根据自己情况调整，

                        图标最好是144x144透明png图片外链，

                        懂PS的玩，不懂的就算了，"><input class="radio" type="radio" name="optype" value="7" <?php if(($_SESSION['gid']) == "2"): ?>disabled="disabled"<?php endif; ?> <?php if(($info["shoptpltypeid"]) == "7"): ?>checked<?php endif; ?> />v1 模板7(自定义风格) </label></li>-->

                    </ul>

                </fieldset>

            </div>



            <div class="tagContent" id="tagContent1">

                <fieldset>

                    <ul class="cateradio2">
                     

                        <li <?php if(($info["tpllistid"]) == "4"): ?>class="active"<?php endif; ?> >

                            <label><img src="<?php echo RES;?>/images/list4.png">

                                <input class="radio2" type="radio" name="optype2" <?php if(($_SESSION['gid']) == "2"): ?>disabled="disabled"<?php endif; ?> value="4" <?php if(($info["tpllistid"]) == "4"): ?>checked<?php endif; ?> /> 模板2(省流量)

                            </label>

                        </li>

                        <li <?php if(($info["tpllistid"]) == "1"): ?>class="active"<?php endif; ?>>

                            <label><img src="<?php echo RES;?>/images/list1.png">

                                <input class="radio2" type="radio" name="optype2" value="1" <?php if(($info["tpllistid"]) == "1"): ?>checked<?php endif; ?> /> 模板1(美观)

                            </label>

                        </li>
                          <li <?php if(($info["tpllistid"]) == "5"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label><img src="<?php echo RES;?>/images/list-3.png" onclick="javascript:alert('已选择格状酷似微信列表')" />
                                <input class="radio2" type="radio" name="optype2" value="5" <?php if(($info["tpllistid"]) == "5"): ?>checked<?php endif; ?> />格状酷似微信列表
                            </label>
                        </li>
												                        <li <?php if(($info["tpllistid"]) == "6"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label><img src="<?php echo RES;?>/images/list-7.png" onclick="javascript:alert('已选择新闻图文列表模式')" />
                                <input class="radio2" type="radio" name="optype2" value="6" <?php if(($info["tpllistid"]) == "6"): ?>checked<?php endif; ?> /> 新闻图文列表模式
                            </label>
                        </li>
												                        <li <?php if(($info["tpllistid"]) == "7"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label><img src="<?php echo RES;?>/images/list-10.png" onclick="javascript:alert('已选择切图列表模式')" />
                                <input class="radio2" type="radio" name="optype2" value="7" <?php if(($info["tpllistid"]) == "7"): ?>checked<?php endif; ?> /> 切图列表模式
                            </label>
                        </li>
												                        <li <?php if(($info["tpllistid"]) == "8"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label><img src="<?php echo RES;?>/images/list-0.png" onclick="javascript:alert('已选择简洁列表模式A')" />
                                <input class="radio2" type="radio" name="optype2" value="8" <?php if(($info["tpllistid"]) == "8"): ?>checked<?php endif; ?> /> 简洁列表模式A
                            </label>
                        </li>

                        <!--                        <li <?php if(($info["tpllistid"]) == "2"): ?>class="active"<?php endif; ?> ><label><img src="<?php echo RES;?>/images/list2.png"><input class="radio2" type="radio" name="optype2" value="2" <?php if(($info["tpllistid"]) == "2"): ?>checked<?php endif; ?> /> 模板2(省流量) </label></li>

                                                <li <?php if(($info["tpllistid"]) == "3"): ?>class="active"<?php endif; ?> ><label><img src="<?php echo RES;?>/images/list3.png"><input class="radio2" type="radio" name="optype2" <?php if(($_SESSION['gid']) == "2"): ?>disabled="disabled"<?php endif; ?> value="3" <?php if(($info["tpllistid"]) == "3"): ?>checked<?php endif; ?> /> 模板3(小清晰)V1 </label></li>-->



                        <!--<li <?php if(($info["tpllistid"]) == "5"): ?>class="active"<?php endif; ?> ><label><img src="<?php echo RES;?>/images/list5.png"><input class="radio2" type="radio" name="optype2" <?php if(($_SESSION['gid']) == "2"): ?>disabled="disabled"<?php endif; ?> value="5" <?php if(($info["tpllistid"]) == "5"): ?>checked<?php endif; ?> /> 模板5(文艺风) V1</label></li>

                        <li <?php if(($info["tpllistid"]) == "6"): ?>class="active"<?php endif; ?> ><label><img src="<?php echo RES;?>/images/list6.png" title="提示：仅适合一张图片配少量文字内容的微信号，

                        如：冷笑话/经典语录"><input class="radio2" type="radio" name="optype2" <?php if(($_SESSION['gid']) == "2"): ?>disabled="disabled"<?php endif; ?> value="6" <?php if(($info["tpllistid"]) == "6"): ?>checked<?php endif; ?> /> 模板6(经典语录) V1</label></li>-->

                    </ul>

                </fieldset>

            </div>

            <div class="tagContent" id="tagContent2">

                <fieldset>

                    <ul class="cateradio3">

                        <li <?php if(($info["tplcontentid"]) == "1"): ?>class="active"<?php endif; ?> ><label><img src="<?php echo RES;?>/images/news1.png"><input class="radio3" type="radio" name="optype3" value="1" <?php if(($info["tplcontentid"]) == "1"): ?>checked<?php endif; ?>/>模板1(有头像) </label></li>

                        <!--<li <?php if(($info["tplcontentid"]) == "2"): ?>class="active"<?php endif; ?> ><label><img src="<?php echo RES;?>/images/news2.png"><input class="radio3" <?php if(($_SESSION['gid']) == "2"): ?>disabled="disabled"<?php endif; ?> type="radio" name="optype3" value="2" <?php if(($info["tplcontentid"]) == "2"): ?>checked<?php endif; ?>/>模板2 V1(无头像)</label></li>-->

                        <li <?php if(($info["tplcontentid"]) == "3"): ?>class="active"<?php endif; ?> ><label><img src="<?php echo RES;?>/images/news3.png"><input class="radio3" type="radio" name="optype3" value="3" <?php if(($info["tplcontentid"]) == "3"): ?>checked<?php endif; ?>/>模板3(无头像)</label></li>

                    </ul>

                </fieldset>

            </div>

            <div class="tagContent" id="tagContent3">

                <fieldset>

                    <div class="cateradio4">

                        <table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tbody>

                                <tr>

                                    <td width="400" rowspan="2" valign="top">

                                        <div class="samsung-render">

                                            <iframe src="/index.php?g=Wap&m=Index&token=<?php echo ($info["token"]); ?>&show=1" id="myiframe" width="320" height="406" frameborder="0" style="overflow-x:hidden;"></iframe>

                                        </div>

                                    </td>

                                    <td valign="top"><h3>请选择你喜欢的颜色风格，实时预览 (<span style="color:#c30">注意：只有在手机上才能获得最佳浏览效果，电脑浏览并不一定是最终显示效果，并且仅部分模板支持更换颜色风格</span>)</h3>

                                        <ul>

                                            <li><label><input class="radio4" type="radio" name="optype4" value="0" <?php if(($info["color_id"]) == "0"): ?>checked="checked"<?php endif; ?>> 默认风格</label></li>

                                            <li><label><input class="radio4" type="radio" name="optype4" value="1" <?php if(($info["color_id"]) == "1"): ?>checked="checked"<?php endif; ?>> 黑色风格</label></li>

                                            <li><label><input class="radio4" type="radio" name="optype4" value="2" <?php if(($info["color_id"]) == "2"): ?>checked="checked"<?php endif; ?>> 蓝色风格</label></li>

                                            <li><label><input class="radio4" type="radio" name="optype4" value="3" <?php if(($info["color_id"]) == "3"): ?>checked="checked"<?php endif; ?>> 木纹风格</label></li>

                                            <li><label><input class="radio4" type="radio" name="optype4" value="4" <?php if(($info["color_id"]) == "4"): ?>checked="checked"<?php endif; ?>> 橙色风格</label></li>

                                            <li><label><input class="radio4" type="radio" name="optype4" value="5" <?php if(($info["color_id"]) == "5"): ?>checked="checked"<?php endif; ?>> 紫色风格</label></li>

                                            <li><label><input class="radio4" type="radio" name="optype4" value="6" <?php if(($info["color_id"]) == "6"): ?>checked="checked"<?php endif; ?>> 绿色风格</label></li>

                                        </ul>

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                        <div class="clr"></div>

                    </div>

                </fieldset>

            </div>

        </div>



        <script type="text/javascript">

            function selectTag(showContent,selfObj){

                // 操作标签

                var tag = document.getElementById("tags").getElementsByTagName("li");

                var taglength = tag.length;

                for(i=0; i<taglength; i++){

                    tag[i].className = "";

                }

                selfObj.parentNode.className = "selectTag";

                // 操作内容

                for(i=0; j=document.getElementById("tagContent"+i); i++){

                    j.style.display = "none";

                }

                document.getElementById(showContent).style.display = "block";





            }

        </script>





        <script>



            $(".radio").click(function(){

                $(".cateradio li").each(function(){

                    $(this).removeClass("active");

                });

                $(this).parents("li").addClass("active");

                var myurl='index.php?g=User&m=Shoptmpls&a=add&style='+$(this).val()+'&r='+Math.random(); 

                $.ajax({url:myurl,async:false});



//                $("#homeurl").attr("href","http://baidu.com/index.php?ac=cate"+$(this).val()+"&tid=9379&w=1");

                $("#myiframe").attr("src",$("#myiframe").attr("src")+'&r='+Math.random());





            });

            $(".radio2").click(function(){

                $(".cateradio2 li").each(function(){

                    $(this).removeClass("active");

                });

                $(this).parents("li").addClass("active");

  

                var myurl ='index.php?g=User&m=Tmpls&a=lists&style='+$(this).val()+'&r='+Math.random(); 

                $.ajax({url:myurl,async:false});





            });

            $(".radio3").click(function(){

                $(".cateradio3 li").each(function(){

                    $(this).removeClass("active");

                });

                $(this).parents("li").addClass("active");

  

                var myurl='index.php?g=User&m=Tmpls&a=content&style='+$(this).val()+'&r='+Math.random(); 

                $.ajax({url:myurl,async:false});



            });

            $(".radio4").click(function(){

                var myurl='index.php?g=User&m=Tmpls&a=background&style='+$(this).val()+'&r='+Math.random(); 

                $.ajax({url:myurl,async:false});

                $("#myiframe").attr("src",$("#myiframe").attr("src")+'&r='+Math.random());

            });

            function changeapp(obj,gid){

                if(obj.checked==true){

                    //var image=new Image();   

                    var myurl='index.php?ac=app&op=open&value=1&id=9379&wxid=gh_858dwjkeww5&openid='+gid+'&r='+Math.random(); 

                    $.ajax({url:myurl,async:false});



                }else{

 

                    var myurl='index.php?ac=app&op=open&value=0&id=9379&wxid=gh_858dwjkeww5&openid='+gid+'&r='+Math.random(); 

                    $.ajax({url:myurl,async:false});



                }

            }



        </script>



 

        <div class="clr"></div>

    </div>



</div>



<div class="clr"></div>

</div>

</div>

</div> 

<!--底部-->

</div><script>

    KindEditor.ready(function(K) {

        var editor = K.editor({

            allowFileManager : true

        });



        K('#image').click(function() {

            editor.loadPlugin('image', function() {

                editor.plugin.imageDialog({

                    showRemote : false,

                    imageUrl : K('#img').val(),

                    clickFn : function(url, title, width, height, border, align) {

                        K('#img').val(url);

                        var show_img = '<img src = "' + url + '" width="80" height="80" />';

                        $('#show_img').html(show_img);

                        editor.hideDialog();

                    }

                });

            });

        });

    });

</script>

<div class="clr"></div>
</div>
</body>
</html>