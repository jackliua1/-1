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
            <div id="TwoMenu-05" <?php if(in_array(MODULE_NAME,array('Dining','Invites','Shoptmpls','Product','Groupon','orders','Host','Yaoqing','Selfform','Wedding','Adma','Reply_info','Repast','Store','Yml','Alipay_config'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
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
            <div class="contab" <?php if(in_array(MODULE_NAME,array('Dining','Invites','Product','Groupon','orders','Host','Selfform','Adma','Reply_info','Xitie','Repast','Wedding','Yaoqing','Shoptmpls','Store','Yml','Alipay_config'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
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
               <!--  <a href="<?php echo U('Groupon/index',array('token'=>$token));?>" class="Highland" >
                    <img src="/tpl/User/default/common/images/weituangou_34.jpg" /><span>微团购</span><span class="introduction">移动端团购平台</span>
                </a>
                <a href="<?php echo U('Host/index',array('token'=>$token));?>"  class="DarkGreen" >
                    <img src="/tpl/User/default/common/images/tongyongdingcan_34.jpg" /><span>通用订单</span><span class="introduction">电子商务平台订单管理</span>
                </a> -->
          
            </div>
        </div><!-- ThreeMenu end-->
    </div><!--Menu   end -->

 <div class="content">
          <div class="cLineB"><h4>编辑文本自定义内容</h4><a href="javascript:history.go(-1);"  class="right btnGrayS vm" style="margin-top:-27px" >返回</a></div> 
<div class="msgWrap">
  <form class="form" method="post"   action="<?php echo U('Text/insert');?>"  target="_top" enctype="multipart/form-data" >
<TABLE class="userinfoArea" style=" margin:20px 0 0 0;" border="0" cellSpacing="0" cellPadding="0" width="100%">
  <THEAD>
<TR>
  <TH valign="top"><label for="keyword">关键词：</label></TH>
  <TD><input type="input" class="px" id="keyword" value="" name="keyword" style="width:500px" ><br />
                  多个关键词请用空格格开：例如: 美丽&nbsp;漂亮&nbsp;好看   </TD>
  <TD>&nbsp;</TD>
</TR>
                            <TR style="display:none">
  <TH valign="top">关键词类型：</TH>
  <TD><label for="radio1"><input id="radio1" class="radio" type="radio" name="type" value="1"  checked="checked"> 完全匹配，用户输入的和此关键词一样才会触发!</label><br /><label for="radio2"><input class="radio" id="radio2" type="radio" name="type" value="2"> 包含匹配 (只要用户输入的文字包含本关键词就触发!<span class="red">v2用户才生效</span>)</label></TD>
</TR>
                            </THEAD>
  <TBODY>
<TR>
  <TH valign="top"><label for="text">内容或简介：</label></TH>
  <TD><textarea  class="px" id="Hfcontent" name="text" style="width:500px; height:150px"></textarea><br />请不要多于1000字否则无法发送!
 

</TD>
  <TD rowspan="2" valign="top"><div style="margin-left:20px" class="zdhuifu">
  	<h4 class="red">文字加超链接范例：</h4>
  
<div> &lt;a&nbsp;href=&quot;http://baidu.com/index.php?ac=cate1&amp;tid=9379&amp;c=fromUsername&quot;&gt;3G首页&lt;/a&gt; </div>
<br>
效果如下：<br>
<img src="<?php echo RES;?>/images/chaolianjie.jpg" alt="文字超链接效果">	
</div></TD>
   
<TR>
  <TH></TH>
  <TD><button type="submit"  name="button"  class="btnGreen left" >保存</button>　<a href="<?php echo U('Img/add');?>"  class="btnGray vm"  >切换到图文模式</a>　<a href="index.php?ac=importtxt&amp;id=9379"  class="btnGray vm">取消</a>
  	<div class="right" style="margin-right:10px"  >
  		<ul>
  			<li class="biaoqing"><span>表情</span>
  				<ul>
  					<li><img src="<?php echo RES;?>/images/face/0.gif" alt="微笑" onclick="jsbq('微笑')"></li>
  					<li><img src="<?php echo RES;?>/images/face/1.gif" alt="撇嘴" onclick="jsbq('撇嘴')"></li>
  					<li><img src="<?php echo RES;?>/images/face/2.gif" alt="色" onclick="jsbq('色')"></li>
  					<li><img src="<?php echo RES;?>/images/face/3.gif" alt="发呆" onclick="jsbq('发呆')"></li>
  					<li><img src="<?php echo RES;?>/images/face/4.gif" alt="得意" onclick="jsbq('得意')"></li>
  					<li><img src="<?php echo RES;?>/images/face/5.gif" alt="流泪" onclick="jsbq('流泪')"></li>
  					<li><img src="<?php echo RES;?>/images/face/6.gif" alt="害羞" onclick="jsbq('害羞')"></li>
  					<li><img src="<?php echo RES;?>/images/face/7.gif" alt="闭嘴" onclick="jsbq('闭嘴')"></li>
  					<li><img src="<?php echo RES;?>/images/face/8.gif" alt="睡" onclick="jsbq('睡')"></li>
  					<li><img src="<?php echo RES;?>/images/face/9.gif" alt="大哭" onclick="jsbq('大哭')"></li>
  					<li><img src="<?php echo RES;?>/images/face/10.gif" alt="尴尬" onclick="jsbq('尴尬')"></li>
  					<li><img src="<?php echo RES;?>/images/face/11.gif" alt="发怒" onclick="jsbq('发怒')"></li>
  					<li><img src="<?php echo RES;?>/images/face/12.gif" alt="调皮" onclick="jsbq('调皮')"></li>
  					<li><img src="<?php echo RES;?>/images/face/13.gif" alt="呲牙" onclick="jsbq('呲牙')"></li>
  					<li><img src="<?php echo RES;?>/images/face/14.gif" alt="惊讶" onclick="jsbq('惊讶')"></li>
  					<li><img src="<?php echo RES;?>/images/face/15.gif" alt="难过" onclick="jsbq('难过')"></li>
  					<li><img src="<?php echo RES;?>/images/face/16.gif" alt="酷" onclick="jsbq('酷')"></li>
  					<li><img src="<?php echo RES;?>/images/face/17.gif" alt="冷汗" onclick="jsbq('冷汗')"></li>
  					<li><img src="<?php echo RES;?>/images/face/18.gif" alt="抓狂" onclick="jsbq('抓狂')"></li>
  					<li><img src="<?php echo RES;?>/images/face/19.gif" alt="吐" onclick="jsbq('吐')"></li>
  					<li><img src="<?php echo RES;?>/images/face/20.gif" alt="偷笑" onclick="jsbq('偷笑')"></li>
  					<li><img src="<?php echo RES;?>/images/face/21.gif" alt="可爱" onclick="jsbq('可爱')"></li>
  					<li><img src="<?php echo RES;?>/images/face/22.gif" alt="白眼" onclick="jsbq('白眼')"></li>
  					<li><img src="<?php echo RES;?>/images/face/23.gif" alt="傲慢" onclick="jsbq('傲慢')"></li>
  					<li><img src="<?php echo RES;?>/images/face/24.gif" alt="饥饿" onclick="jsbq('饥饿')"></li>
  					<li><img src="<?php echo RES;?>/images/face/25.gif" alt="困" onclick="jsbq('困')"></li>
  					<li><img src="<?php echo RES;?>/images/face/26.gif" alt="惊恐" onclick="jsbq('惊恐')"></li>
  					<li><img src="<?php echo RES;?>/images/face/27.gif" alt="流汗" onclick="jsbq('流汗')"></li>
  					<li><img src="<?php echo RES;?>/images/face/28.gif" alt="憨笑" onclick="jsbq('憨笑')"></li>
  					<li><img src="<?php echo RES;?>/images/face/29.gif" alt="大兵" onclick="jsbq('大兵')"></li>
  					<li><img src="<?php echo RES;?>/images/face/30.gif" alt="奋斗" onclick="jsbq('奋斗')"></li>
  					<li><img src="<?php echo RES;?>/images/face/31.gif" alt="咒骂" onclick="jsbq('咒骂')"></li>
  					<li><img src="<?php echo RES;?>/images/face/32.gif" alt="疑问" onclick="jsbq('疑问')"></li>
  					<li><img src="<?php echo RES;?>/images/face/33.gif" alt="嘘" onclick="jsbq('嘘')"></li>
  					<li><img src="<?php echo RES;?>/images/face/34.gif" alt="晕" onclick="jsbq('晕')"></li>
  					<li><img src="<?php echo RES;?>/images/face/35.gif" alt="折磨" onclick="jsbq('折磨')"></li>
  					<li><img src="<?php echo RES;?>/images/face/36.gif" alt="衰" onclick="jsbq('衰')"></li>
  					<li><img src="<?php echo RES;?>/images/face/37.gif" alt="骷髅" onclick="jsbq('骷髅')"></li>
  					<li><img src="<?php echo RES;?>/images/face/38.gif" alt="敲打" onclick="jsbq('敲打')"></li>
  					<li><img src="<?php echo RES;?>/images/face/39.gif" alt="再见" onclick="jsbq('再见')"></li>
  					<li><img src="<?php echo RES;?>/images/face/40.gif" alt="擦汗" onclick="jsbq('擦汗')"></li>
  					<li><img src="<?php echo RES;?>/images/face/41.gif" alt="抠鼻" onclick="jsbq('抠鼻')"></li>
  					<li><img src="<?php echo RES;?>/images/face/42.gif" alt="鼓掌" onclick="jsbq('鼓掌')"></li>
  					<li><img src="<?php echo RES;?>/images/face/43.gif" alt="糗大了" onclick="jsbq('糗大了')"></li>
  					<li><img src="<?php echo RES;?>/images/face/44.gif" alt="坏笑" onclick="jsbq('坏笑')"></li>
  					<li><img src="<?php echo RES;?>/images/face/45.gif" alt="左哼哼" onclick="jsbq('左哼哼')"></li>
  					<li><img src="<?php echo RES;?>/images/face/46.gif" alt="右哼哼" onclick="jsbq('右哼哼')"></li>
  					<li><img src="<?php echo RES;?>/images/face/47.gif" alt="哈欠" onclick="jsbq('哈欠')"></li>
  					<li><img src="<?php echo RES;?>/images/face/48.gif" alt="鄙视" onclick="jsbq('鄙视')"></li>
  					<li><img src="<?php echo RES;?>/images/face/49.gif" alt="委屈" onclick="jsbq('委屈')"></li>
  					<li><img src="<?php echo RES;?>/images/face/50.gif" alt="快哭了" onclick="jsbq('快哭了')"></li>
  					<li><img src="<?php echo RES;?>/images/face/51.gif" alt="阴险" onclick="jsbq('阴险')"></li>
  					<li><img src="<?php echo RES;?>/images/face/52.gif" alt="亲亲" onclick="jsbq('亲亲')"></li>
  					<li><img src="<?php echo RES;?>/images/face/53.gif" alt="吓" onclick="jsbq('吓')"></li>
  					<li><img src="<?php echo RES;?>/images/face/54.gif" alt="可怜" onclick="jsbq('可怜')"></li>
  					<li><img src="<?php echo RES;?>/images/face/55.gif" alt="菜刀" onclick="jsbq('菜刀')"></li>
  					<li><img src="<?php echo RES;?>/images/face/56.gif" alt="西瓜" onclick="jsbq('西瓜')"></li>
  					<li><img src="<?php echo RES;?>/images/face/57.gif" alt="啤酒" onclick="jsbq('啤酒')"></li>
  					<li><img src="<?php echo RES;?>/images/face/58.gif" alt="篮球" onclick="jsbq('篮球')"></li>
  					<li><img src="<?php echo RES;?>/images/face/59.gif" alt="乒乓" onclick="jsbq('乒乓')"></li>
  					<li><img src="<?php echo RES;?>/images/face/60.gif" alt="咖啡" onclick="jsbq('咖啡')"></li>
  					<li><img src="<?php echo RES;?>/images/face/61.gif" alt="饭" onclick="jsbq('饭')"></li>
  					<li><img src="<?php echo RES;?>/images/face/62.gif" alt="猪头" onclick="jsbq('猪头')"></li>
  					<li><img src="<?php echo RES;?>/images/face/63.gif" alt="玫瑰" onclick="jsbq('玫瑰')"></li>
  					<li><img src="<?php echo RES;?>/images/face/64.gif" alt="凋谢" onclick="jsbq('凋谢')"></li>
  					<li><img src="<?php echo RES;?>/images/face/65.gif" alt="示爱" onclick="jsbq('示爱')"></li>
  					<li><img src="<?php echo RES;?>/images/face/66.gif" alt="爱心" onclick="jsbq('爱心')"></li>
  					<li><img src="<?php echo RES;?>/images/face/67.gif" alt="心碎" onclick="jsbq('心碎')"></li>
  					<li><img src="<?php echo RES;?>/images/face/68.gif" alt="蛋糕" onclick="jsbq('蛋糕')"></li>
  					<li><img src="<?php echo RES;?>/images/face/69.gif" alt="闪电" onclick="jsbq('闪电')"></li>
  					<li><img src="<?php echo RES;?>/images/face/70.gif" alt="炸弹" onclick="jsbq('炸弹')"></li>
  					<li><img src="<?php echo RES;?>/images/face/71.gif" alt="刀" onclick="jsbq('刀')"></li>
  					<li><img src="<?php echo RES;?>/images/face/72.gif" alt="足球" onclick="jsbq('足球')"></li>
  					<li><img src="<?php echo RES;?>/images/face/73.gif" alt="瓢虫" onclick="jsbq('瓢虫')"></li>
  					<li><img src="<?php echo RES;?>/images/face/74.gif" alt="便便" onclick="jsbq('便便')"></li>
  					<li><img src="<?php echo RES;?>/images/face/75.gif" alt="月亮" onclick="jsbq('月亮')"></li>
  					<li><img src="<?php echo RES;?>/images/face/76.gif" alt="太阳" onclick="jsbq('太阳')"></li>
  					<li><img src="<?php echo RES;?>/images/face/77.gif" alt="礼物" onclick="jsbq('礼物')"></li>
  					<li><img src="<?php echo RES;?>/images/face/78.gif" alt="拥抱" onclick="jsbq('拥抱')"></li>
  					<li><img src="<?php echo RES;?>/images/face/79.gif" alt="强" onclick="jsbq('强')"></li>
  					<li><img src="<?php echo RES;?>/images/face/80.gif" alt="弱" onclick="jsbq('弱')"></li>
  					<li><img src="<?php echo RES;?>/images/face/81.gif" alt="握手" onclick="jsbq('握手')"></li>
  					<li><img src="<?php echo RES;?>/images/face/82.gif" alt="胜利" onclick="jsbq('胜利')"></li>
  					<li><img src="<?php echo RES;?>/images/face/83.gif" alt="抱拳" onclick="jsbq('抱拳')"></li>
  					<li><img src="<?php echo RES;?>/images/face/84.gif" alt="勾引" onclick="jsbq('勾引')"></li>
  					<li><img src="<?php echo RES;?>/images/face/85.gif" alt="拳头" onclick="jsbq('拳头')"></li>
  					<li><img src="<?php echo RES;?>/images/face/86.gif" alt="差劲" onclick="jsbq('差劲')"></li>
  					<li><img src="<?php echo RES;?>/images/face/87.gif" alt="爱你" onclick="jsbq('爱你')"></li>
  					<li><img src="<?php echo RES;?>/images/face/88.gif" alt="NO" onclick="jsbq('NO')"></li>
  					<li><img src="<?php echo RES;?>/images/face/89.gif" alt="OK" onclick="jsbq('OK')"></li>
  					<li><img src="<?php echo RES;?>/images/face/90.gif" alt="爱情" onclick="jsbq('爱情')"></li>
  					<li><img src="<?php echo RES;?>/images/face/91.gif" alt="飞吻" onclick="jsbq('飞吻')"></li>
  					<li><img src="<?php echo RES;?>/images/face/92.gif" alt="跳跳" onclick="jsbq('跳跳')"></li>
  					<li><img src="<?php echo RES;?>/images/face/93.gif" alt="发抖" onclick="jsbq('发抖')"></li>
  					<li><img src="<?php echo RES;?>/images/face/94.gif" alt="怄火" onclick="jsbq('怄火')"></li>
  					<li><img src="<?php echo RES;?>/images/face/95.gif" alt="转圈" onclick="jsbq('转圈')"></li>
  					<li><img src="<?php echo RES;?>/images/face/96.gif" alt="磕头" onclick="jsbq('磕头')"></li>
  					<li><img src="<?php echo RES;?>/images/face/97.gif" alt="回头" onclick="jsbq('回头')"></li>
  					<li><img src="<?php echo RES;?>/images/face/98.gif" alt="跳绳" onclick="jsbq('跳绳')"></li>
  					<li><img src="<?php echo RES;?>/images/face/99.gif" alt="挥手" onclick="jsbq('挥手')"></li>
  					<li><img src="<?php echo RES;?>/images/face/100.gif" alt="激动" onclick="jsbq('激动')"></li>
  					<li><img src="<?php echo RES;?>/images/face/101.gif" alt="街舞" onclick="jsbq('街舞')"></li>
  					<li><img src="<?php echo RES;?>/images/face/102.gif" alt="献吻" onclick="jsbq('献吻')"></li>
  					<li><img src="<?php echo RES;?>/images/face/103.gif" alt="左太极" onclick="jsbq('左太极')"></li>
  					</ul>
  				</li>
  			</ul>
  		</div><div class="clr"></div>
  	<script type="text/javascript">
function jsbq(srt){
document.getElementById("Hfcontent").value=document.getElementById("Hfcontent").value+"/"+srt;
}
</script></TD>
  </TR>
  </TBODY>
</TABLE>
  </form>



  </div> 

        </div>
        
        <div class="clr"></div>
      </div>
    </div>
  </div> 

<!--底部-->
  	</div>