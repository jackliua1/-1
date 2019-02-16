<?php if (!defined('THINK_PATH')) exit();?> ﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
 
  <div class="content" style="width:86%; border:none; margin-bottom:30px;" > 
 <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/cymain.css" />
<script src="<?php echo RES;?>/js/date/WdatePicker.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/formCheck/formcheck.js"> </script>

<script src="/tpl/static/artDialog/jquery.artDialog.js?skin=default"></script>
<script src="/tpl/static/artDialog/plugins/iframeTools.js"></script>
<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.css" />
<script src="<?php echo STATICS;?>/kindeditor/kindeditor.js" type="text/javascript"></script>
<script src="<?php echo STATICS;?>/kindeditor/lang/zh_CN.js" type="text/javascript"></script>
<script src="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>
<script src="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>
<script>
  KindEditor.ready(function(K){
    var editor = K.editor({
      allowFileManager:true
    });
    K('#upload_pic').click(function() {
      editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
          fileUrl : K('#pic').val(),
          clickFn : function(url, title) {
            if(url.indexOf("http") > -1){
              K('#pic').val(url);
            }else{
              K('#pic').val("<?php echo C('site_url');?>"+url);
            }
            editor.hideDialog();
          }
        });
      });
    });
    K('#upload_opening_animation').click(function() {
      editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
          fileUrl : K('#opening_animation').val(),
          clickFn : function(url, title) {
            if(url.indexOf("http") > -1){
              K('#opening_animation').val(url);
            }else{
              K('#opening_animation').val("<?php echo C('site_url');?>"+url);
            }
            editor.hideDialog();
          }
        });
      });
    });
    K('#upload_small_pic').click(function() {
      editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
          fileUrl : K('#small_pic').val(),
          clickFn : function(url, title) {
            if(url.indexOf("http") > -1){
              K('#small_pic').val(url);
            }else{
              K('#small_pic').val("<?php echo C('site_url');?>"+url);
            }
            editor.hideDialog();
          }
        });
      });
    });
    K('#upload_site_map_1').click(function() {
      editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
          fileUrl : K('#site_map_1').val(),
          clickFn : function(url, title) {
            if(url.indexOf("http") > -1){
              K('#site_map_1').val(url);
            }else{
              K('#site_map_1').val("<?php echo C('site_url');?>"+url);
            }
            editor.hideDialog();
          }
        });
      });
    });
    K('#upload_site_map_2').click(function() {
      editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
          fileUrl : K('#site_map_2').val(),
          clickFn : function(url, title) {
            if(url.indexOf("http") > -1){
              K('#site_map_2').val(url);
            }else{
              K('#site_map_2').val("<?php echo C('site_url');?>"+url);
            }
            editor.hideDialog();
          }
        });
      });
    });
    K('#upload_site_map_3').click(function() {
      editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
          fileUrl : K('#site_map_3').val(),
          clickFn : function(url, title) {
            if(url.indexOf("http") > -1){
              K('#site_map_3').val(url);
            }else{
              K('#site_map_3').val("<?php echo C('site_url');?>"+url);
            }
            editor.hideDialog();
          }
        });
      });
    });
    K('#upload_site_map_4').click(function() {
      editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
          fileUrl : K('#site_map_4').val(),
          clickFn : function(url, title) {
            if(url.indexOf("http") > -1){
              K('#site_map_4').val(url);
            }else{
              K('#site_map_4').val("<?php echo C('site_url');?>"+url);
            }
            editor.hideDialog();
          }
        });
      });
    });
    K('#upload_site_map_5').click(function() {
      editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
          fileUrl : K('#site_map_5').val(),
          clickFn : function(url, title) {
            if(url.indexOf("http") > -1){
              K('#site_map_5').val(url);
            }else{
              K('#site_map_5').val("<?php echo C('site_url');?>"+url);
            }
            editor.hideDialog();
          }
        });
      });
    });
  });
</script>

<script>

var editor;
KindEditor.ready(function(K) {
editor = K.create('#content', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : false,
items : [
'source','undo','clearhtml','hr',
'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
'insertunorderedlist', '|', 'emoticons', 'image','link', 'unlink','baidumap','lineheight','table','anchor','preview','print','template','code','cut']
});

});
</script>
<script type="text/javascript">
function setlatlng(longitude,latitude){
  art.dialog.data('longitude', longitude);
  art.dialog.data('latitude', latitude);
  // 此时 iframeA.html 页面可以使用 art.dialog.data('test') 获取到数据，如：
  // document.getElementById('aInput').value = art.dialog.data('test');
  art.dialog.open('<?php echo U('Map/setLatLng',array('token'=>$token,'id'=>$id));?>',{lock:false,title:'设置经纬度',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.87});
}
</script>
   <div class="cLineB"> 
    <h4>广告位设置</h4> 
    <a href="<?php echo U('Advert/index',array('token'=>$token));?>" class="right  btnGreen" style="margin-top:-27px">返回</a> 
   </div> 
   

   <form class="form" method="post" id="form" action=""> 
<?php if($isUpdate == 1): ?><input type="hidden" name="id" value="<?php echo ($set["id"]); ?>" /><?php endif; ?>

    <div class="msgWrap bgfc"> 
     <table class="userinfoArea" style=" margin:0;" border="0" cellspacing="0" cellpadding="0" width="100%"> 
      <tbody> 
       <tr> <input id="token" name="token" type="hidden" value="<?php echo $token;?>"></tr>
        <tr>
        <th><span class="red">*</span>广告名称：</th>
        <td><input type="text" id="advertname" name="advertname" value="<?php echo ($set["advertname"]); ?>" class="px require" style="width:400px;" /></td> 
       </tr>

        <tr> 
          <th><span class="red">*</span>商品类别：</th>
          <td>
            <select id="pcid" name="pcid"  class="px require" style="width:400px;" onChange="productcatSelect(this.value);">
              <option value="">--请选择--</option>
              <?php if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pc): $mod = ($i % 2 );++$i;?><option value="<?php echo ($pc["id"]); ?>" <?php if($set['pcid'] == $pc['id']): ?>selected<?php endif; ?>><?php echo ($pc["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
          </td> 
       </tr>

       <tr> 
          <th><span class="red">*</span>选择商品：</th>
          <td>
            <select id="pid" name="pid"  class="px require" style="width:400px;">
              <option value="">--请选择--</option>
              <?php if(is_array($product)): $i = 0; $__LIST__ = $product;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><option value="<?php echo ($p["id"]); ?>" <?php if($set['pid'] == $p['id']): ?>selected<?php endif; ?>><?php echo ($p["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
          </td> 
       </tr> 
       <tr>

          <th><span class="red">*</span>广告图片：</th>

          <td><input type="text" name="picurl" value="<?php echo ($set["picurl"]); ?>" id="pic" class="px" style="width:550px;"> &nbsp; <script src="/tpl/static/upyun.js"></script><a href="###" onclick="upyunPicUpload('pic',700,420,'<?php echo ($token); ?>')" class="a_upload">上传</a> &nbsp; <a href="###" onclick="viewImg('pic')" class="btnGrayS vm">预览</a> &nbsp; 建议大小为600x200</td>

        </tr>

        <tr>
        <th><span class="red">*</span>排序：</th>
        <td><input type="text" id="sort" name="sort" value="<?php echo (($set["sort
          "])?($set["sort
          "]):1); ?>" class="px require" style="width:400px;" />
          <span>由小到大排序</span>
        </td> 
       </tr>

       <tr>
       <th>&nbsp;</th>
       <td>
       <button type="submit" name="button" class="btnGreen" onclick="return abc()">保存</button> &nbsp; <a href="<?php echo U('Advert/index',array('token'=>$token));?>" class="btnGray vm">取消</a></td> 
       </tr> 
      </tbody> 
     </table> 
     </div>
    
   </form> 
  </div> 
<script language="javascript">
//表单提交时检验
  function abc(){
    var advertname=$("#advertname").val();
    var pid=$("#pid").val();
    var pcid=$("#pcid").val();
    var pic=$("#pic").val();
    if(!advertname){
      alert("请填写广告名称");
      return false;
    }
    if(!pcid){
      alert("请选择商品类别");
      return false;
    }
    if(!pid){
      alert("请选择商品");
      return false;
    }
    if(pic==""){
      alert("请上传广告图片");
      return false;
    }
  }
  //选择省份后切换相应的城市
  function productcatSelect(pcid){
    var strs="<option value=''>请选择商品</option>",pid="";

    document.getElementById('pid').innerHTML="<option value=''>请选择商品</option>";
    $.post("index.php?g=User&m=Advert&a=productChange", {'pcid':pcid}, function(res) {
            
          var res = JSON.parse(res);

          if(res!=null)
          {
            for(var i=0;i<res.length;i++)
            {
              if(res[i]["catid"]!="undefined")
              {
                strs+='<option value="'+res[i]["id"]+'">'+res[i]["name"]+'</option>';
                document.getElementById('pid').innerHTML=strs;
                pid=res[0]["catid"];
              }
            }
          }
    });
  }
  //校验数据
$(function(){
  $("#form").valid([
  { name:"pid",simple:"商品",require:true},
  { name:"pcid",simple:"商品类别",require:true},
  { name:"advertname",simple:"广告名称",require:true},
  { name:"picurl",simple:"广告图片",require:true}
  ],true,true);
})
</script>
  <div class="clr"></div>
</div>
</body>
</html>