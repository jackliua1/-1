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

<!-- <link rel="stylesheet" type="text/css" href="./tpl/User/default/common/css/cymain.css" />
<div class="tab">
	<ul>
		<li class="<?php if(ACTION_NAME == 'index'): ?>current<?php endif; ?> tabli" id="tab0"><a href="<?php echo U('ServiceUser/index',array('token'=>$token));?>">客服工号管理</a></li>
		<li class="<?php if(ACTION_NAME == 'wechatService'): ?>current<?php endif; ?> tabli" id="tab1"><a href="<?php echo U('ServiceUser/wechatService',array('token'=>$token));?>">微信客服设置</a></li>
		<li class="<?php if(ACTION_NAME == 'son'): ?>current<?php endif; ?> tabli" id="tab2"><a href="<?php echo U('ServiceUser/chat_log',array('token'=>$token));?>">聊天记录管理</a></li>
	
	</ul>
</div> -->
<link rel="stylesheet" type="text/css" href="<?php echo Common;?>/default_user_com.css" media="all">
<link rel="stylesheet" href="tpl/User/default/common/css/tb.css" ></link>

<link rel="stylesheet" type="text/css" href="/tpl/static/dl/css/chosen.min.css"/>
<script src="/tpl/static/dl/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/tpl/static/dl/js/chosen.jquery.min.js" type="text/javascript" charset="utf-8"></script>
<style>
table tr th.span3{
	width:60px;
}
.span3 span{
	display: inline-block;
    width: 80px;
}
.span3 .w100{
    width: 100px;
}
</style>
<div class="content">
  <div class="cLineB">
	  <h4 class="left">客户信息管理</h4>
	   <div class="searchbar right" style="margin-top:20px;">  
			<form method="post" action="<?php echo U('ServiceUser/index',array('token'=>$token));?>">
			  <input type="text" class="txt left" placeholder="客户手机号" name="Tel" value="<?php echo ($Tel); ?>">
			  <select name="lpid" data-placeholder="选择楼盘" id="lpid" style="" class="chosen-select">
				<option value=""></option>
				<option value="">全部</option>
				<?php if(is_array($lp)): $i = 0; $__LIST__ = $lp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["ID"]); ?>" <?php if($vo[ID] == $lpid): ?>selected<?php endif; ?>><?php echo ($vo["LouPanTitle"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				
			  <input type="submit" value="搜索" id="msgSearchBtn" href="javascript:;" class="btnGrayS" title="搜索">
			  
			</form>
		</div>
  </div>
<!-- </div> -->
      <!-- <div class="msgWrap form">
        <ul id="tags" style="width:100%">
          <li class="selectTag">
            <a href="?g=User&m=ServiceUser&a=index">客户信息</a> 
          </li>
          <li>
            <a href="?g=User&m=ServiceUser&a=index1">导入客户信息</a> 
          </li>
        <div class="clr" style="height:1px;background:#eee;margin-bottom:20px;"></div>
        </ul>
      </div> -->
          
          <div class="cLine" style="width:100%">
            <div class="pageNavigator left" style="display: contents;">
                <!-- <a href="<?php echo U('ServiceUser/add',array('token'=>$token));?>" class="btnGrayS vm bigbtn">
                    <img src="tpl/User/default/common/images/text.png" class="vm">添加客户
                </a>
                &nbsp; -->
                <!--  <span class="btnGrayS vm bigbtn" id="import">
                    <img src="tpl/User/default/common/images/text.png" class="vm">导入客户
                </span>
                &nbsp; -->
                <a href="<?php echo U('ServiceUser/outexc',array('token'=>$token,'Tel'=>$Tel,'lpid'=>$lpid));?>" class="btnGrayS vm bigbtn">
                    <img src="tpl/User/default/common/images/text.png" class="vm">导出客户
                </a> 
                <!--导入-->
             <script type="text/javascript">
                $(document).ready(function(){
                //点击显示div和遮罩
                $("#import").live("click",function(){
                 // ShowMask();
                 ShowDv();
                });
                //点击隐藏遮罩和div
                $("#close").live("click",function(){
                hide();
                window.location="<?php echo U('ServiceUser/index');?>";
                });
                  //点击取消
                $("#btn_cancels").live("click",function(){
                hide();
                }); 
              });


              //显示遮罩
              function ShowMask ()
              {
              //$('body').css("overflow", 'hidden');  
              $msk=$('<div id=dvMsk><div>');
              $msk.css({"top":"0","left":"0","position":"absolute","display":"block","width":"400px","height":"100px;","background":"red","zIndex":"500","opacity":"0.3","filter":"Alpha(opacity=30)"});
              $('body').append($msk); 
              }
              //显示div
              function ShowDv()
              {
              $('#showDiv').css({'display':'block','position':'absolute','top':'30%','left':'40%',"zIndex":"500"});
              }
              //隐藏遮罩和div
              function hide()
              {
              $("#showDiv").css("display","none");
              $("#dvMsk").remove();
              }
             </script>
               <div id="showDiv" style="display:none;">
                 <div id="show_top">
                  <div id="rig" style="float:right;padding:3px;"><a href="#" id="close" ><img id="delete" src="tpl/User/default/common/images/delete.jpg" width="12px" height="12px"></img></a></div>
                 </div>
                 <div class="imtem" style="width:300px;">
                  <a href="tpl/User/default/common/tmp/客户.xls"><button class="btuFile"  id="" style="margin-top:5px;margin-left:10px;padding:5px;">下载模板</button></a>
                  </div>
                  <form action="<?php echo U('ServiceUser/excinkh',array('token'=>$token));?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="leadExcel" value="true">
                   <center>
                   <table border="0" style="margin-top:10px;" >
                    <tr>
                       <td colspan='2'>
                        <input type="file" name="inputExcel" size="20"  maxlength="20" /><span style="color:red;">注：只能为.xls</span>
                       </td>
                    </tr>
                    <tr height="50px;">
                      <td style="text-align:center">
                          <input type="submit" value="导入数据" style="width:100px; height:30px;" />
                      </td>
                      <td style="text-align:center;">
                         <a href="<?php echo U('ServiceUser/index');?>" id="close" ><input type="button" style="width:100px;height:30px;" value="取消" /></a>
                      </td>
                    </tr>
                    </table>
                  </center>
                </form>
              <!-- 导入模块部分结束 -->

            </div>
            <div class="clr"></div>
          </div>

          <!-- begin -->
          <div class="msgWrap" style="overflow-x: scroll;">
          <form method="post" action="" id="info">
          <input name="delall" type="hidden" value="del">
           <input name="wxid" type="hidden" value="gh_423dwjkewad">
            <table class="ListProduct" border="0" cellspacing="0" cellpadding="0" width="2000px">
              <thead>
             <tr>                        
      				<th class="span3"><span>客户姓名</span></th>
      				<th class="span3"><span>客户电话</span></th>
      				<th class="span3"><span>项目名称</span></th>
      				<th class="span3"><span>驻场经理</span></th>
					<th class="span3"><span>现场接待人</span></th>
					<th class="span3"><span>经纪公司</span></th>
				  <th class="span3"><span>经纪人</span></th>
				  <th class="span3"><span>经纪人电话</span></th>
				  <th class="span3"><span>状态</span></th>
				  
				  <th class="span3"><span>产品</span></th>
				  <th class="span3"><span>楼栋号</span></th>
				  <th class="span3"><span>房号</span></th>
				  <th class="span3"><span class="w100">合同面积(平方)</span></th>
				  <th class="span3"><span>合同总价</span></th>
				  <th class="span3"><span>预约日期</span></th>
				  <th class="span3"><span>认购日期</span></th>
				  <th class="span3"><span>签约日期</span></th>
				  <th class="span3"><span>应收金额</span></th>
				  <th class="span3"><span>实收金额</span></th>
				  <th class="span3"><span>收款金额1</span></th>
				  <th class="span3"><span>收款日期1</span></th>
				  <th class="span3"><span>收款方式1</span></th>
				  <th class="span3"><span>客户卡号1</span></th>
				  <th class="span3"><span class="w100">POS单凭证号1</span></th>
				  <th class="span3"><span>收据编号1</span></th>
				  <th class="span3"><span>收款金额2</span></th>
				  <th class="span3"><span>收款日期2</span></th>
				  <th class="span3"><span>收款方式2</span></th>
				  <th class="span3"><span>客户卡号2</span></th>
				  <th class="span3"><span class="w100">POS单凭证号2</span></th>
				  <th class="span3"><span>收据编号2</span></th>
				  <th class="span3"><span>收款金额3</span></th>
				  <th class="span3"><span>收款日期3</span></th>
				  <th class="span3"><span>收款方式3</span></th>
				  <th class="span3"><span>客户卡号3</span></th>
				  <th class="span3"><span class="w100">POS单凭证号3</span></th>
				  <th class="span3"><span>收据编号3</span></th>
				  
				  <th class="span3"><span>应付金额</span></th>
				  <th class="span3"><span>中介奖励</span></th>
				  <th class="span3"><span>请佣金额1</span></th>
				  <th class="span3"><span>请佣日期1</span></th>
				  <th class="span3"><span>打款日期1</span></th>
				  <th class="span3"><span>请佣金额2</span></th>
				  <th class="span3"><span>请佣日期2</span></th>
				  <th class="span3"><span>打款日期2</span></th>
				  <th class="span3"><span>总付款</span></th>
				  
				  <th class="span3"><span>是否已付</span></th>
				  <th class="span3"><span>是否退房</span></th>
				  <th class="span3"><span>备注</span></th>
				  
				  <th class="span3"><span>输入日期</span></th>
				  <th class="span3"><span>有效日期</span></th>
				  <th class="span3"><span>操作</span></th>
      			</tr>
			  </thead>
				<tbody>
					<?php if($list == null): ?><tr>
						<td colspan="51" style="text-align:center; height:30px;"><strong>暂无客户信息</strong></td>
						</tr>
					<?php else: ?>
					<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
						<td><?php echo ($list['Name']); ?></td>
            <td><span class="label"> <?php echo ($list['Tel']); ?></span></td>
            <td><span class="label"> <?php echo ($list['LouPanTitle']); ?></span></td>
            <td>
              <?php if($list['zy_name'] == ''): ?><span class="label">未分配</span>
              <?php else: ?>
                <span class="label"> <?php echo ($list['zy_name']); ?></span><?php endif; ?>
            </td>
			<td><span class="label"> <?php echo ($list['jdname']); ?></span></td>
			<td><span class="label"> <?php echo ($list['zjgs']); ?></span></td>
            <td><span class="label"> <?php echo ($list['jjr_name']); ?></span></td>
            <td><span class="label"> <?php echo ($list['jjrtel']); ?></span></td>
			<td><span class="label"> <?php echo ($list['salesstatus']); ?></span></td>
			
			<td><span class="label"> <?php echo ($list['products']); ?></span></td>
			<td><span class="label"> <?php echo ($list['ldh']); ?></span></td>
            <td><span class="label"> <?php echo ($list['houseno']); ?></span></td>
            <td><span class="label"> <?php echo ($list['htmj']); ?></span></td>
			<td><span class="label"> <?php echo ($list['htzj']); ?></span></td>
			<td><span class="label"> <?php echo ($list['yydate']); ?></span></td>
            <td><span class="label"> <?php echo ($list['rgdate']); ?></span></td>
            <td><span class="label"> <?php echo ($list['qydate']); ?></span></td>
			<td><span class="label"> <?php echo ($list['ysje']); ?></span></td>
			<td><span class="label"> <?php echo ($list['ssje']); ?></span></td>
            <td><span class="label"> <?php echo ($list['skje1']); ?></span></td>
            <td><span class="label"> <?php echo ($list['skrq1']); ?></span></td>
			<td><span class="label"> <?php echo ($list['skfs1']); ?></span></td>
			<td><span class="label"> <?php echo ($list['khcard1']); ?></span></td>
            <td><span class="label"> <?php echo ($list['pos_pzh1']); ?></span></td>
            <td><span class="label"> <?php echo ($list['sjnum1']); ?></span></td>
			<td><span class="label"> <?php echo ($list['skje2']); ?></span></td>
            <td><span class="label"> <?php echo ($list['skrq2']); ?></span></td>
			<td><span class="label"> <?php echo ($list['skfs2']); ?></span></td>
			<td><span class="label"> <?php echo ($list['khcard2']); ?></span></td>
            <td><span class="label"> <?php echo ($list['pos_pzh2']); ?></span></td>
            <td><span class="label"> <?php echo ($list['sjnum2']); ?></span></td>
			<td><span class="label"> <?php echo ($list['skje3']); ?></span></td>
            <td><span class="label"> <?php echo ($list['skrq3']); ?></span></td>
			<td><span class="label"> <?php echo ($list['skfs3']); ?></span></td>
			<td><span class="label"> <?php echo ($list['khcard3']); ?></span></td>
            <td><span class="label"> <?php echo ($list['pos_pzh3']); ?></span></td>
            <td><span class="label"> <?php echo ($list['sjnum3']); ?></span></td>
			
			<td><span class="label"> <?php echo ($list['yfje']); ?></span></td>
            <td><span class="label"> <?php echo ($list['jjrjl']); ?></span></td>
			
            <td><span class="label"> <?php echo ($list['qyje1']); ?></span></td>
            <td><span class="label"> <?php echo ($list['qyrq1']); ?></span></td>
            <td><span class="label"> <?php echo ($list['dkrq1']); ?></span></td>
			<td><span class="label"> <?php echo ($list['qyje2']); ?></span></td>
            <td><span class="label"> <?php echo ($list['qyrq2']); ?></span></td>
            <td><span class="label"> <?php echo ($list['dkrq2']); ?></span></td>
			<td><span class="label"> <?php echo ($list['zfk']); ?></span></td>
			
			<td><span class="label"> <?php if($list[isfk] == 2): ?>是<?php else: ?>否<?php endif; ?></span></td>
			<td><span class="label"> <?php if($list[istf] == 2): ?>是<?php else: ?>否<?php endif; ?></span></td>
            <td><span class="label"> <?php echo ($list['remark']); ?></span></td>
			
            <td><span class="label"> <?php echo (date('Y-m-d',$list['SrTime'])); ?></span></td>
            <td>
              <?php if($list["yxTime"] == 0): ?><span class="label"></span>
              <?php else: ?>
                <span class="label"> <?php echo (date('Y-m-d',$list['yxTime'])); ?></span><?php endif; ?>
            </td>
						<td>
							 <a href="<?php echo U('ServiceUser/edit',array('id'=>$list['ID'],'token'=>$list['Token']));?>" class="btn">编辑</a>
							&nbsp;<a href="<?php echo U('ServiceUser/del',array('id'=>$list['ID'],'token'=>$list['Token']));?>" onclick="return(confirm('确定要删除吗？'))" class="btn">删除</a></a>
						</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
				</tbody>
            </table>
           </form> 
          </div>
          <div class="cLine">
            <div class="pageNavigator right">
                 <div class="pages"><?php echo ($page); ?></div>
            </div>
            <div class="clr"></div>
          </div>
        </div>  
		
	<script>
	$('.chosen-select').chosen({search_contains: true,width:'200px'});
  </script>
        <!-- end -->


       <!--  <div class="msgWrap">
    <form method="post" action="" id="info">
      <input name="delall" type="hidden" value="del">
      <input name="wxid" type="hidden" value="gh_423dwjkewad">
      <table class="ListProduct" border="0" cellspacing="0" cellpadding="0" width="100%">
        <thead>
          <tr>                        
            <th class="span3">姓名</th>
            <th class="span3">电话</th>
            <th class="span1">意向项目</th>
            <th class="span3">推荐人</th>
            <th class="span3">状态</th>
            <th class="span3">驻场经理</th>
            <th class="span3">输入日期</th>
            <th class="span3">有效日期</th>
            <th class="span3">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php if($list == ''): ?><tr>
            <td colspan="6" style="text-align:center; height:30px;"><strong>暂无客户信息.</strong></td>
            </tr>
          <?php else: ?>
          <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($list['Name']); ?></td>
            <td><span class="label"> <?php echo ($list['Tel']); ?></span></td>
            <td><span class="label"> <?php echo ($list['LouPanTitle']); ?></span></td>
            <td><span class="label"> <?php echo ($list['jjr_name']); ?></span></td>
            <td><span class="label"> <?php echo ($list['zy_name']); ?></span></td>
            <td><span class="label"> <?php echo ($list['Stutas']); ?></span></td>
            <td>
              <?php if($list['zy_name'] == ''): ?><span class="label">未分配</span>
              <?php else: ?>
                <span class="label"> <?php echo ($list['zy_name']); ?></span><?php endif; ?>
            </td>
            <td><span class="label"> <?php echo (date('Y-m-d',$list['SrTime'])); ?></span></td>
            <td>
              <?php if($list['yxTime'] == 0): ?><span class="label">未设置有效期</span>
              <?php else: ?>
                <span class="label"> <?php echo (date('Y-m-d',$list['yxTime'])); ?></span><?php endif; ?>
            </td>
            <td>
              <a href="<?php echo U('ServiceUser/edit',array('id'=>$list['ID'],'token'=>$list['Token']));?>" class="btn">编辑</a>
              &nbsp;<a href="<?php echo U('ServiceUser/del',array('id'=>$list['ID'],'token'=>$list['Token']));?>" onclick="return(confirm('确定要删除吗？'))" class="btn">删除</a></a>
            </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </tbody>
      </table>
    </form> 
  </div>
  <div class="cLine">
    <div class="pageNavigator right">
         <div class="pages"><?php echo ($page); ?></div>
    </div>
    <div class="clr"></div>
  </div>
</div> -->