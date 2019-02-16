<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="shortcut icon" href="./tpl/static/logo.jpg">
  <title><?php echo C('site_title');?> <?php echo C('site_name');?></title>
  <link href="<?php echo RES;?>/css/ss.css" rel="stylesheet" type="text/css"  />
  <link href="<?php echo RES;?>/css/style.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/stylet.css" />
  <script type="text/javascript" src="<?php echo RES;?>/js/jquery.min.js"></script>
  <script src="<?php echo STATICS;?>/kindeditor/kindeditor.js" type="text/javascript"></script>
<script src="<?php echo STATICS;?>/kindeditor/lang/zh_CN.js" type="text/javascript"></script>
<script src="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>
</head>

<body style="background-color:#3978a5;">
  <div class=" w top">
  
    <div class="right">
      <img src="<?php echo RES;?>/images/portrait2.png" width="28" height="29" />
      <a><?php echo (session('uname')); ?></a>
      |
      <a href="?g=User&m=Index&a=index">返回首页</a>
      |
      <a href="#" onclick="Javascript:window.open('<?php echo U('System/Admin/logout');?>')" onLoad=setTimeout("abc.style.display='none'",5000) >安全退出</a>
    </div>
  </div>


<div id="Frame">
    <div id="nav">
        <div class="top"></div>
        <div class="account">
            <div class="uname">
              <img src="<?php echo RES;?>/images/portrait2.png" />
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
            <!-- <div class="public">
                <img src="<?php echo RES;?>/images/title1.jpg" width="71" height="28" />
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
                            <a href="{:U('Index/del',array('id'=>$_GET['id']))}">删除</a>
                            </span>      
                        </li>
                    </ul>
                                          
                </div>
            </div> -->
            <div class="analyse">
                <img src="<?php echo RES;?>/images/title2.jpg" width="71" height="28" />
                <div>
                    <ul>
                        <li>日期:2012-12-12</li>
                        <li>文本请求数: 0/4000 &nbsp;&nbsp;关注人数：100</li>
                        <li>图文请求数: 0/4000 &nbsp;&nbsp;取消关注：100</li>
                        <li>语音请求数: 0/4000</li>
                        
                    </ul>                     
                </div>
                <!-- <span class="add">
                    <a href="<?php echo U('Index/add');?>"><img src="<?php echo RES;?>/images/jia.png" /></a>                        
                </span>  -->                                
            </div>
        </div>
    </div><!--nav 结束-->


  

<div class="content">

          <div class="cLineB"><h4>添加微信公众号</h4></div>

          <form method="post" action="<?php echo U('User/Index/insert');?>" enctype="multipart/form-data">

          <div class="msgWrap">

            <table class="userinfoArea" border="0" cellspacing="0" cellpadding="0" width="100%">

              <thead>

                <tr>

                  <th><span class="red">*</span>公众号名称：</th>

                  <td><input type="text" required="" class="px" name="wxname" value="" tabindex="1" size="25">
                    <span class="red">用于公众号搜索添加</span>
                  </td>

                </tr>

              </thead>

              <tbody>

                <tr>

                  <th><span class="red">*</span>公众号原始id：</th>

                  <td><input type="text" required="" name="wxid" value="" onmouseup="this.value=this.value.replace('_430','')" class="px" tabindex="1" size="25">　<span class="red">请认真填写，错了不能修改。</span>比如：gh_423dwjkeww3 <a href="/tpl/static/getoid.htm" target="_blank"><img src="<?php echo RES;?>/images/help.png" class="vm helpimg" title="帮助"></a></td>

                </tr>

                <tr>

                  <th><span class="red">*</span>微信号：</th>

                  <td><input type="text" required="" name="weixin" value="" class="px" tabindex="1" size="25">　比如：weiwin </td>

                </tr>

                <tr>

                  <th><span class="red"></span>AppID：</th>

                  <td><input type="text" name="appid" value="" class="px" tabindex="1" size="25">　用于自定义菜单等高级功能，可以不填 </td>

                </tr>

                <tr>

                  <th><span class="red"></span>AppSecret：</th>

                  <td><input type="text" name="appsecret" value="" class="px" tabindex="1" size="25">　用于自定义菜单等高级功能，可以不填 </td>

                </tr>

                

                <tr>

                  <th><span class="red"></span>微信号类型：</th>

                  <td><select id="winxintype" name="winxintype">                  

                  <option value="1">订阅号</option>

                  <option value="2">服务号</option>

                  <option value="3">高级服务号</option>

                  </select>　高级服务号是指每年向微信官方交300元认证费的公众号 </td>

                </tr>

                  <tr style="display:none">

                  <th><span class="red">*</span>头像地址（url）:</th>

                  <td><input class="px" name="headerpic" value="<?php echo RES;?>/images/portrait.jpg" size="60">请填写图片外链地址 <a onclick="alert('请填写以jpg,png,gif,bmp等后缀的图文')" target="_blank"><img src="<?php echo RES;?>/images/help.png" class="vm helpimg" title="帮助"></a></td>

                </tr>

                 <tr style="display:none">

                  <th><span class="red">*</span>TOKEN</th>

                  <td><input type="text" name="token" value="<?php echo ($tokenvalue); ?>" class="px" tabindex="1" size="40">(填写你的公众号)例：pigcmsweixin,请勿填写文,或者其它特殊字符，此处token和腾讯平台必须一致!</td>

                </tr>

                

                <tr style="display:none">

                  <th><span class="red">*</span>地区</th>

                  <td>

                  <input type="text" class="px" id="province" value="p" name="province" tabindex="1" size="20"> 省  <input id="city" value="c" type="text" name="city" class="px" tabindex="1" value="c" size="20"> 市

               （此处关联公交等本地化查询）

                  </td>

                </tr>

                <tr style="display:none">

                  <th><span class="red">*</span>公众号邮箱：</th>

                  <td><input type="text" required="" class="px" tabindex="1" value="<?php echo ($email); ?>" name="qq" size="25"></td>

                </tr>

                 <tr style="display:none">

                  <th><span class="red">*</span>粉丝数：</th>

                  <td><input type="text" required="" name="wxfans" value="0" class="px" tabindex="1" size="25"></td>

                </tr>

             

                <tr style="display:none">

                  <th>类型：</th>

                  <td><select id="type" name="type">                  

                  <option value="1,情感">情感</option>

                  <option value="2,数码">数码</option>

                  <option value="3,娱乐">娱乐</option>

                  <option value="4,IT">IT</option>

                  <option value="5,数码">数码</option>

                  <option value="6,购物">购物</option>

                  <option value="7,生活">生活</option>

                  <option value="8,服务" selected>服务</option>

                  </select></td>

                </tr>

              

                <tr>

                  <th></th>

                  <td><button type="submit" class="btnGreen" id="saveSetting">保存</button></td>

                </tr>

              </tbody>

            </table>

            

          </div>

          </form>

        </div>

        

        <div class="clr"></div>

      </div>

    </div>

  </div>

  <!--底部-->

  	</div>

<div class="clr"></div>
</div>
</body>
</html>