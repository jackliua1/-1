<?php 
//经纪人控制

	class AgentAction extends WapAction{
		public $token;
		public $jjrdb;  //经纪人数据表
		public $jjrinfo; //经纪人信息
		
		public function _initialize() {
			parent::_initialize();
			$this->token    = filter_var($this->_get('token'),FILTER_SANITIZE_STRING);
			$this->jjrdb = D('jjr');
			 // var_dump($_SESSION);
			// var_dump($this->wecha_id);die;
			//不用判断微信浏览器了 , 直接判断用户是否需要登录
			$nocheck = array('register');
			if(ACTION_NAME == 'register'){
				//如果到了注册页先清空wecha_id
				$this->wecha_id = '';
				unset($_SESSION['wecha_id']);
				setcookie("wecha_id","",time()-20);
			}
			if(!$this->wecha_id && !in_array(ACTION_NAME,$nocheck)){
				$this->redirect(U('Agent/register',array('token'=>$_GET['token'])));
			}
			if($this->wecha_id){
				//查询wecha_id是否存在
				$this->jjrinfo = $this->jjrdb->where(array('Token'=>$this->token,'Wecha_id'=>$this->wecha_id))->find();
				
				if(!$this->jjrinfo){
					$this->redirect(U('Agent/register',array('token'=>$_GET['token'])));
				}
			}
			
            
		}
		//未注册经纪人登录首页
		public function index(){
			//定义需要显示的条数
			$num=20;
			//楼盘信息
			$token = $this->_get("token");
			$loupanwhere = array('token'=>$token);
			$loupaninfo = M('lpinfo') ->where($loupanwhere)->order("houseSort desc,id desc")->limit(0,$num)->select();
			$this->assign('lpinfo',$loupaninfo);

			$where['Wecha_id']=$this->wecha_id;
			$where['Token']=$_GET['token'];
			$jjrarr=M('jjr')->where($where)->find();
			$this->assign("num",$num);

			// var_dump($this->token);var_dump($where);var_dump($this->wecha_id);die;
			//查询分享设置
			$shareinfo=D("share_content")->where("token='$token'")->find();
			$this->assign("shareinfo",$shareinfo);
			$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?g=Wap&m=Agent&a=index&token='.$token;
			$this->assign("url",$url);
			if($jjrarr){
				$this->assign('jjrarr',$jjrarr);
				$this->redirect(U('Agent/ydl',array('token'=>$this->_get('token'),'wecha_id'=>$jjrarr['Wecha_id'])));
			}else{		
				$this->display();
			}
		}

		//已注册经纪人登录首页
		public function ydl(){
			//查找当前经纪人信息
			$where['Wecha_id']=$this->wecha_id;
			$where['Token']=$_GET['token'];
			$rewardinfo=D("agent_rewardinfo");
			//佣金总额
			$wecha_id=$this->wecha_id;
			$token=$_GET['token'];
			$allcount=$rewardinfo->where("wecha_id='$wecha_id' and token='$token' and rewardstatus =0")->sum("rewardamount");
			$jjrinfo=M('jjr')->where($where)->order('ID desc')->find();
			$data=D('brokerage');
			$date=$data->where(array("id"=>$jjrinfo['brokerage_id']))->find();
            $this->assign('date',$date);
			//只获取小数点后一位并不四舍五入
			$total=floor( $allcount* 10 ) /10;
			$allcount=sprintf( "%.1f ",(float)$total);
			// D("xmfx")->where("id>0")->delete();
			// D("xmfx_list")->where("id>0")->delete();
		// 	echo $jjrinfo['credit'];
		// 	$xmfx=D("xmfx")->select();
		// 	$xmfx_list=D("xmfx_list")->select();
		// 	echo "<pre>";
		// var_dump($xmfx_list);
		// echo "</pre><pre>";
		// var_dump($xmfx);
			//查询分享设置
			$shareinfo=D("share_content")->where("token='$token'")->find();
			$this->assign("shareinfo",$shareinfo);
			$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?g=Wap&m=Agent&a=index&token='.$token;
			$this->assign("url",$url);
			if(!$jjrinfo){
				$this->redirect(U('Agent/register',array('token'=>$this->_get('token'),'wecha_id'=>$wecha_id)));
			}
			$jjrid=intval($jjrinfo['ID']);
			//查找当前经纪人客户信息
			$countkh=D("kh")->where(array("Token"=>$where['Token'],"JJ_id"=>$jjrid))->count();

			//楼盘信息
			$loupanwhere = array('token'=>$where['Token']);
			//定义需要显示的条数
			$num=20;
			$loupaninfo = M('lpinfo') ->where($loupanwhere)->order("houseSort desc,id desc")->limit(0,$num)->select();
			$this->assign('lpinfo',$loupaninfo);
			$this->assign("jjrinfo",$jjrinfo);
			$this->assign("countkh",$countkh);
			$this->assign("num",$num);
			$this->assign('allcount',$allcount);
			$this->display();
		}
		//经纪人登录、注册
		public function register(){
			if($_POST){
                $data['Token']=$this->token;
                //$data['Wecha_id']=$_POST['wecha_id'];
				//改成了账号密码登录
				$data['Tel'] = $_POST['Tel'];
				$data['password'] = md5($_POST['password']);
//	            //验证是否已经注册过经纪人 $data['Wecha_id']=$_POST['Wecha_id'];
				$info = D('jjr')->where($data)->find();
	            if($info){
					//保存session
					$_SESSION['wecha_id'] = $info['Wecha_id'];
					setcookie("wecha_id",$info['Wecha_id'],time()+30*24*3600);
	            	$this->redirect(U("Agent/ydl",array("wecha_id"=>$info['Wecha_id'],"token"=>$info['Token'])));
	            }else{
	                $this->error("账号密码错误");
	            }
			}else{
				$token=$_GET['token'];
				// if(!$this->wecha_id){
					// //查询此公众号的二维码和公众号名称
					// $wxuser=D("wxuser")->where(array("token"=>$token))->field("wxname,headerpic")->find();
					// $this->assign("wxuser",$wxuser);

				// }
			 	//查询注册条款  cate=1表示经纪人
			 	//$jjrtk=D("zc")->field("TiaoKuan")->where(array('Token'=>$token,'cate'=>1))->find();
			 	//查询经纪人类型
			 	//$type=D("agent_type")->where(array('token'=>$token))->order("sort")->select();
                $types=D("brokerage")->where(array('token'=>$token))->select();
                $this->assign("types",$types);
		        //$this->assign("TiaoKuan",$jjrtk['TiaoKuan']);
		        //$this->assign("type",$type);
                $this->display();
			}
		}

		//经纪人信息页面
		public function myInfo(){
			if($_POST){
				$data['ID']=intval($_POST['id']);
				//$data['Tel']=trim($_POST['Tel']);
				if($_POST['password']){
					$data['password']=md5($_POST['password']);
					if(D("jjr")->save($data)){
						$this->redirect(U('Agent/register',array('token'=>$this->token)));
					}else{
						$this->error("修改失败");
					}
				}else{
					$this->error("修改失败");
				}
				
			}else{
				$where['Token']=$_GET['token'];
				$where['Wecha_id']=$this->wecha_id;
				$jjrinfo=D("jjr")->where($where)->find();
				if($jjrinfo){
					//查看经纪人类别
					$type=D("agent_type")->where(array('token'=>$_GET['token']))->select();
					$this->assign("jjrinfo",$jjrinfo);
					$this->assign("type",$type);
					$this->display();
				}else{
					$this->redirect(U('Agent/register',array('token'=>$_GET['token'],'wecha_id'=>$this->wecha_id)));
				}
			}
		}

		//点击楼盘进入楼盘详情页面
		public function loupanInfo(){

			$where['id']=$_GET['id'];
			// $where['Wecha_id']=$this->wecha_id;
			
			$where['token']=$_GET['token'];
			//总浏览量+1
			D("lpinfo")->where($where)->setInc("video",1);
			$lpinfo=D("lpinfo")->where($where)->find();
			$this->assign("lpinfo",$lpinfo);
			$this->display();
		}
		public function loupanInfo12(){

			if(isset($_GET['state'])){
				//已登录后详情页
				$state=intval($_GET['state']);  //xmfx表的id
				$code=$_GET['code'];
				$appid="wxe9501094aff155d1";
				$secret ="db0b42b92743a3a40f4d6e43697889c9";
				$get_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
				$abc=$this->getToken($get_token_url);
				$json=json_decode($abc);
				if(is_object($json)){
					$json=(array)$json;
				}
				//当前浏览者的cwecha_id
				$info=M('xmfx')->where(array('id'=>$_GET['state']))->find();
				$cwecha_id=$json['openid']; //浏览者wecha_id
				$token=$info['token'];		
				// echo $cwecha_id;die();
				// $jjrarr=M('jjr')->where(array('ID'=>$info['jid']))->find();
				// var_dump($_GET);

				$uid=intval($info['uid']);  //项目id
				// echo $uid;
				// die();
				
				$wecha_id=$info['wecha_id'];     //分享者wecha_id
				$xmfx_list=M('xmfx_list')->where(array('wecha_id'=>$cwecha_id,"token"=>$token,"uid"=>$uid,'mwecha_id'=>$wecha_id))->find();
				// var_dump($xmfx_list);
				if(!$xmfx_list){
					//总浏览量+1
					D("lpinfo")->where(array('id'=>$uid))->setInc("video",1);

					$data['token']=$token;
					$data['uid']=$uid;
					$data['mwecha_id']=$wecha_id;    //分享者wecha_id
					$data['wecha_id']=$cwecha_id;	  //浏览者wecha_id
					//将浏览人保存到表中
					M('xmfx_list')->add($data);
					//当前分享人的项目浏览人+1
					D("xmfx")->where(array("id"=>$_GET['state']))->setInc("views",1);
					//查询出浏览达到多少次才能获取积分
					$lpinfo=D("lpinfo")->where(array("id"=>$uid))->field("longitude,latitude")->find();
					$longitude=intval($lpinfo['longitude']);   //需要达到的浏览量
					$latitude=intval($lpinfo['latitude']);     //达到目标浏览量后可获得的积分
					//该分享记录的浏览量+1
					$views=intval($info['views'])+1;
					//判断积分与货币的关系
					$setting = M('Product_setting')->where(array('token' => $token))->find();
					$score=intval($setting['score']);   //需要这么多积分才能兑换0.1元
					if($score){
						//该项目之前分享获得的积分
						$credit=intval($info['hascredit']);
						$before=floor($credit/$score);
					}
					//判断是否达到获取积分标准
					if($views%$longitude==0){  
						//如果浏览次数达到浏览量的倍数则进行一次积分增加 两张表都进行了添加
						D("jjr")->where(array('ID'=>$info['jid']))->setInc("credit",$latitude);
						D("xmfx")->where(array("id"=>$_GET['state']))->setInc("hascredit",$latitude);

					}
					if($score){
						//增加之后的总积分
						$xmfx=D("xmfx")->where(array("id"=>$_GET['state']))->field("hascredit,hasmoney")->find();
						$credit=intval($xmfx['hascredit']);
						$after=floor($credit/$score);
						// echo $before."<hr>".$after."<hr>";
						if($after>$before){
							//如果修改后的积分可兑换的金额大于修改前的积分可兑换金额则兑换相应的金额
							$change=($after-$before)*0.1;
							// echo $xmfx['hasmoney']."<hr>".$change."<hr>";
							$hasmoney=(float)($xmfx['hasmoney']+$change);
							// echo $hasmoney;
							$sql="update wy_xmfx set hasmoney=$hasmoney where id=$state";
							D("xmfx")->execute($sql);
						}
					}
				}
				// $xmfx_list=M('xmfx_list')->where(array('wecha_id'=>$cwecha_id,"token"=>$token))->find();
				// var_dump($xmfx_list);die();
				$lpinfo=D("lpinfo")->where(array('id'=>$info['uid']))->find();
				$jjrarr=M('jjr')->where(array('ID'=>$info['jid']))->find();
				$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
				//判断是否达到积分要求
				$this->assign('token',$token);
				$this->assign('wecha_id',$info['wecha_id']);
				$this->assign('lpinfo',$lpinfo);
				$this->assign('jjrarr',$jjrarr);
				$this->assign('url',$url);
				$this->display();
				exit();
			}
			//分享之后，再返回 执行
			if(isset($_GET['flag'])){
				$info=M('xmfx')->where(array('id'=>$_GET['sid']))->find();
				$lpinfo=D("lpinfo")->where(array('id'=>$info['uid']))->find();
				 $this->assign("lpinfo",$lpinfo);
				 $this->assign("info",$info);
				 $this->display();
				 exit();
			}

			//左右美服务器返回的信息
			if(isset($_GET['action'])){
							// var_dump($_SESSION);die();
				$info=M('xmfx')->where(array('id'=>$_GET['action']))->find();
				$lpinfo=D("lpinfo")->where(array('id'=>$info['uid']))->find();
				$this->assign("lpinfo",$lpinfo);
				$this->assign("info",$info);
				$this->display();
				exit();
			}
			if(isset($this->wecha_id)){
				//如果是没有注册经纪人的
				if(isset($_GET['type'])&&$_GET['type']==3){
					$this->getjjrsa($_GET['id'],$this->wecha_id,$_GET['type']);
				}else{
					$this->getjjrsa($_GET['id'],$this->wecha_id,0);
				}
				
				exit();
			}
			//如果wecha_id不存在 是未关注过此公众号的人
			if($this->wecha_id==''){
				$where['id']=$_GET['id'];
				$where['token']=$_GET['token'];
				//总浏览量+1
				D("lpinfo")->where($where)->setInc("video",1);
				$lpinfo=D("lpinfo")->where($where)->find();
				$this->assign("lpinfo",$lpinfo);
				$this->display();
			}

		}

		//通过wecha_id获取经纪人信息；Index页不能使用
		private function getjjrsa($id,$wid,$type=0){
			$where['Wecha_id']=$this->wecha_id;
			$where['Token']=$this->_get('token');
			//区分未注册和已注册
			if($type==0){
				//获取当前分享经纪人的id
				$jjrarr=M('jjr')->where($where)->field('id')->find();
				$this->redirect(U('Agent/weimaoa',array('token'=>$_GET['token'],'wecha_id'=>$this->wecha_id,'uid'=>$_GET['id'],'jid'=>$jjrarr['id'])));
			}else{
				$this->redirect(U('Agent/weimaoa',array('token'=>$_GET['token'],'wecha_id'=>$this->wecha_id,'uid'=>$_GET['id'],'type'=>$_GET['type'])));
			}
			
			// if($jjrarr){//已经注册返回注册信息
			// 	$this->redirect(U('Agent/weimaoa',array('token'=>$_GET['token'],'wecha_id'=>$this->wecha_id,'uid'=>$_GET['id'],'jid'=>$jjrarr['id'])));
			// }else{//未注册，跳转注册页面
			// 	$this->redirect(U('Agent/register',array('token'=>$this->_get('token'),'wecha_id'=>$this->_get['wecha_id'])));
			// }
		}
		public function weimaoa(){
		return false;
			//项目分享
			// $where['id']=$_GET['uid'];      //项目id
			$where['token']=$_GET['token'];  
			// $lpinfo=D("lpinfo")->where($where)->field('id')->find();
			//存数据库
			// unset($where['id']);
			
			$where['wecha_id']=$this->wecha_id;   //经纪人wecha_id
			$where['uid']=$_GET['uid'];    //项目id
			$list=M('xmfx')->where($where)->field('id')->find();
			if($list==''){
				$where['type']=1;     //积分类型  1:表示获得积分  2:表示消耗积分
				$list=M('xmfx')->where($where)->add($where);
			}
			if(!$list==""){
				if(is_array($list))
				{
  					$num=$list['id'];
				}else{
					$num=$list;
				}
				if(isset($_GET['jid'])){
					$data['jid']=intval($_GET['jid']);    //传递过来的经纪人id
					$data['id']=intval($num);
					M('xmfx')->save($data);
				}
				
		 header("Location:http://weixin.zoyomei.com/index.php?g=Wap&m=Agent&a=kengsile&sid=$num");

				//$this->redirect(U('Agent/loupanInfo',array('sid'=>$num,'flag'=>1)));
			}

		}
		//获取openid
		// public function aiya(){
		// 	$state=$_GET['state'];
		// 	$code=$_GET['code'];
		// 	$appid="wxe9501094aff155d1";
		// 	$secret ="db0b42b92743a3a40f4d6e43697889c9";
		// 	$get_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
		// 	$abc=$this->getToken($get_token_url);
		// 	$json=json_decode($abc);
		// 	if(is_object($json)){
		// 		$json=(array)$json;
		// 	}
		// 	//当前浏览者的cwecha_id
		// 	$info=M('xmfx')->where(array('id'=>$_GET['state']))->find();
		// 	$cwecha_id=$json['openid']; //浏览者wecha_id
		// 	$token=$info['token'];		
			
		// 	$jjrarr=M('jjr')->where(array('ID'=>$info['jid']))->find();
		// 	$this->redirect(U('Agent/loupanInfo',array('state'=>$state,'cwecha_id'=>$cwecha_id,'wecha_id'=>$jjrarr['Wecha_id'],'token'=>$token)));

		// }


		//点击楼盘进入楼盘详情页面
		public function loupanInfoAAAAA(){

			$where['id']=$_GET['id'];
			$where['Wecha_id']=$this->wecha_id;
			$where['token']=$_GET['token'];
			$lpinfo=D("lpinfo")->where($where)->find();
			$this->assign("lpinfo",$lpinfo);
			// $this->display();
			$this->getjjr();
		}
		//未登陆者点击楼盘进入楼盘详情页面
		public function loupanInfo1(){

			$where['id']=$_GET['id'];
			// $where['Wecha_id']=$this->wecha_id;
			
			$where['token']=$_GET['token'];
			//总浏览量+1
			D("lpinfo")->where($where)->setInc("video",1);
			$lpinfo=D("lpinfo")->where($where)->find();
			$this->assign("lpinfo",$lpinfo);
			$this->display();
		}

		//录入客户信息
		public function addCustom(){
			//查看在售楼盘
			$where['token'] = $_GET['token'];
			$lpid=0;
			if(isset($_GET['lpid'])){
				$where['id']=intval($_GET['lpid']);
				$lpid=intval($_GET['lpid']);
			}
			$loupaninfo = M('lpinfo') ->where($where)->select();

//			var_dump($loupaninfo);
			$this->assign('lpinfo',$loupaninfo);
			$this->assign('lpid',$lpid);
			$this->assign('wecha_id',$this->wecha_id);
			$jjrInfo = $this->getjjr();
//            $this->display();
		}


		//通过手机号验证客户是否唯一
		public function khyz(){
			$where['Token']=$_POST['token'];
			$where['Tel']=$_POST['tel'];
			if($info= D('kh')->where($where)->find()){
				echo "1";die();
				
			}else{
				echo "0";die();
			}

		}

		//添加客户处理
		public function addCustomHandle(){
			if($_POST){
				$data['Token']=$_GET['token'];
                $data['Wecha_id']=$this->wecha_id;
				$data['Name']=$_POST['name'];
				$data['JJ_id']=$_POST['JJ_id'];
				$data['Tel']=$_POST['tel'];
				$data['LouPanTitle']=intval($_POST['lpid']); //楼盘id
				
				//查找第一个状态的  修改后只剩三个状态 
				//$stutas=D("agent_status")->where(array('token'=>$this->token))->order("sort asc")->limit(1)->field("id")->find();
				//$data['Stutas']=intval($stutas);
				$data['Stutas'] = 1; 				
				
				//所有人都可以添加同一个客户 所以现在只需要判断自己的是否重复
				$info = D('kh')->where(array('Tel'=>$data['Tel'],'Token'=>$_GET['token'],'LouPanTitle'=>$data['LouPanTitle'],'JJ_id'=>$data['JJ_id'],'Stutas'=>$data['Stutas']))->find();
				if($info){
					$this->error('客户已存在');
				}
				
				//自动匹配案场经理
				$data['zy_id'] = D('zy')->where(array('Token'=>$this->token,'_string'=>"FIND_IN_SET($_POST[lpid],Uid)"))->getField('ID');
				
				$data['SrTime']=time();
				$cid=D("kh")->add($data);
				if($cid){
					$this->redirect(U('Agent/successinfo',array('token'=>$data['Token'],'wecha_id'=>$this->wecha_id,'JJ_id'=>$data['JJ_id'],"type"=>1,"cid"=>$cid)));
				}else{
					$this->error("提交失败");
				}
			}
		}
		//客户推荐成功后跳转的页面
		public function successinfo(){
			$cid=intval($_GET['cid']);    //客户id
			$khinfo=D("kh")->where("ID=$cid")->find();
			$lpid=intval($khinfo['LouPanTitle']);  //项目id
			//查询项目名称
			$lpinfo=D("lpinfo")->where("id=$lpid")->field("id,LouPanTitle,traffic")->find();
			//查询项目优惠政策说明
			if(isset($_GET['JJ_id'])){
				$jjrid=intval($_GET['JJ_id']);
				$jjrinfo=D("jjr")->where("ID=$jjrid")->find();
				$this->assign("jjrinfo",$jjrinfo);
			}

			$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
			$this->assign("khinfo",$khinfo);
			$this->assign("lpinfo",$lpinfo);
			$this->assign("type",$_GET['type']);
			$this->assign("url",$url);
			$this->display();
		}

		//我的客户信息页
		public function myCustom(){
			$kh=D("kh");
			$token=$_GET['token'];
			$jjid=intval($_GET['JJ_id']);
			
			$where = "";
			//搜索条件 电话号码和日期
			if($_REQUEST['Tel'] && !empty($_REQUEST['Tel'])){
				$tel = $_REQUEST['Tel'];
				$where .= " and kh.Tel='$tel'";
				$this->assign('Tel',$tel);
			}
			if($_REQUEST['times'] && !empty($_REQUEST['times'])){
				$endtime = time();//结束时间设定为当前时间
				switch($_REQUEST['times']){
					case 1:
						$starttime = strtotime(date('Y-m-d', strtotime('-1 week')));//一星期内
						break;
					case 2:
						$starttime = strtotime(date('Y-m-d', strtotime('-1 month')));//一个月内
						break;
					case 3:
						$starttime = strtotime(date('Y-m-d', strtotime('-1 year')));//一年内
						break;
					default:
						$starttime = 0;//全部
						break;
				}
				$times = $_REQUEST['times'];
				$where .= " and kh.SrTime>='$starttime' and kh.SrTime<='$endtime'";
				$this->assign('times',$times);
			}
			$page = $_GET['page']?intval($_GET['page']):1;
			$listRows = 20;//每页显示数
			$this->assign('page',$page);//当前页码
			$firstRow = ($page-1)*$listRows;
			
			$sql="SELECT kh.ID,kh.Token,kh.Wecha_id,kh.`Name`,kh.Tel,
					lp.LouPanTitle,kh.SrTime,status.salesstatus,status.sort 
					from wy_kh as kh LEFT JOIN wy_lpinfo as lp on kh.LouPanTitle=lp.id 
					LEFT JOIN wy_agent_status as status on kh.Stutas=status.id 
					WHERE kh.Token='$token' AND kh.JJ_id=$jjid ".$where." order by kh.SrTime desc limit $firstRow,$listRows";
        	$list=$kh->query($sql);
			
			if($_GET['is_ajax']){
				//如果是ajax请求
				$this->ajaxReturn($list,$page,1);
			}else{
				$this->assign("list",$list);
				$jjrInfo = $this->getjjr();
			}

        	
		}

		//活动细则
		public function rule(){
			$where['token']=$_GET['token'];
			$rule=D("lp_rule")->where($where)->limit(1)->find();
			$this->assign("rule",$rule);
			$this->display();
		}	

		//我的佣金页面
		public function commission(){
			$where['token']=$_GET['token'];
			$where['wecha_id']=$this->wecha_id;
			$rewardinfo=D("agent_rewardinfo");
			//佣金详情
			$info=$rewardinfo->where($where)->order("rewardstatus desc,id desc")->select();
			//佣金总额
			$where['rewardstatus']=0;		//0:未取现  1:已取现  2:取现申请  -99:撤销
			$allcount=$rewardinfo->where($where)->sum("rewardamount");
			$total=floor($allcount*10)/10;
			$allcount=sprintf( "%.1f ",(float)$total);
			//已领取总额
			$where['rewardstatus']=1;		//0:未取现  1:已取现  2:取现申请  -99:撤销
			$ylcount=$rewardinfo->where($where)->sum("rewardamount");
			//不可领取总额
			$where['rewardstatus']=array("in","-1,1,2");		//0:未取现  1:已取现  2:取现申请  -1:撤销
			$nlcount=$rewardinfo->where($where)->sum("rewardamount");
			//可领总额
			$klcount=round(($allcount-$nlcount),2);
			$total=floor($klcount*10)/10;
			$klcount=sprintf( "%.1f ",(float)$total);
			//查看银行卡
			// $bank=D("agent_bank")->where($where)->find();
			// $this->assign("bank",$bank);
			$this->assign("info",$info);
			$this->assign("allcount",$allcount);
			$this->assign("ylcount",$ylcount);
			$this->assign("klcount",$klcount);
			$jjrInfo = $this->getjjr();
		}

		//申请提现
		public function rewardmodify(){
			if($_POST){
				$where['token']=$_GET['token'];
				$where['wecha_id']=$this->wecha_id;
				$rewardinfo=D("agent_rewardinfo");
				//佣金总额
				$where['rewardstatus']=0;		//0:未取现  1:已取现  2:取现申请  -1:撤销
				$allcount=$rewardinfo->where($where)->sum("rewardamount");
				//不可领取总额
				$where['rewardstatus']=array("in","-1,1,2");		//0:未取现  1:已取现  2:取现申请  -1:撤销
				$nlcount=$rewardinfo->where($where)->sum("rewardamount");
				//可领总额
				$klcount=round(($allcount-$nlcount),2);
				if($klcount<$_POST['rewardamount']){
					$this->error("提现金额大于可领金额");
				}
				$data['token']=$_GET['token'];
				$data['wecha_id']=$this->wecha_id;
				$data['rewardamount']=(float)$_POST['rewardamount'];
				$data['rewardstatus']=2;      //0:未取现  1:已取现  2:取现申请  -1:撤销
				$data['srtime']=time();
				if(D("agent_rewardinfo")->add($data)){
					$this->redirect("Agent/commission",array('token'=>$_GET['token'],'wecha_id'=>$this->wecha_id));
				}else{
					$this->error("申请失败，请重新申请");
				}
			}else{
				$this->error("非法操作");
			}
		}

		//积分明细
		public function credit(){
			if($_GET){
				$token=$_GET['token'];
				$wecha_id=$this->wecha_id;
				$jid=$_GET['JJ_id'];     //经纪人id
				$xmfx=D("xmfx");
				//总积分
				// $allcredit=$xmfx->where("token='$token' and jid=$jid and type=1")->sum("hascredit");
				// //已用积分
				// $ylcredit=$xmfx->where("token='$token' and jid=$jid and type=2")->sum("hascredit");
				// //未用积分
				// $klcredit=$allcredit-$ylcredit;
				$sql="select xmfx.id,xmfx.views,xmfx.hascredit,lp.LouPanTitle,xmfx.type,jjr.credit 
						from wy_xmfx as xmfx left join wy_lpinfo as lp on lp.id=xmfx.uid 
						left join wy_jjr as jjr on xmfx.jid=jjr.ID 
						where xmfx.token='$token' and xmfx.jid=$jid 
						order by xmfx.id desc";
				$list=$xmfx->query($sql);
				$this->assign("list",$list);
				$this->assign("allcredit",$allcredit);
				$this->assign("klcredit",$klcredit);
				$this->display();
			}else{
				$this->error("非法操作");				
			}
		}
		//绑定银行卡
		public function bank(){
			$bank=D("agent_bank");
			$where['token']=$_GET['token'];
			$where['wecha_id']=$this->wecha_id;
			if($_POST){
				$data['name']=$_POST['name'];
				$data['bankcard']=$_POST['bankcard'];
				$data['bankname']=$_POST['bankname'];
				if($bank->where($where)->find()){
					$list=$bank->where($where)->save($data);
				}else{
					$data['token']=$_GET['token'];
					$data['wecha_id']=$this->wecha_id;
					$list=$bank->add($data);
				}
				if($list){
					$this->redirect(U('Agent/commission',array('token'=>$_GET['token'],'wecha_id'=>$this->wecha_id)));
				}else{
					$this->error("修改失败");
				}
			}else{
				$info=$bank->where($where)->find();
				$this->assign("info",$info);
				$this->display();
			}
		}
		
		//领取佣金奖励页面
		public function reward(){
			$token=$_GET['token'];
			$wecha_id=$this->wecha_id;
			$sql="select rewardname ,sum(rewardamount) as reward from wy_agent_rewardinfo  
			where (token='$token' and wecha_id='$wecha_id' and rewardstatus=0) 
			GROUP BY(rewardname)";
			$list=D('agent_rewardinfo')->query($sql);
			$this->assign("list",$list);
			$jjrInfo = $this->getjjr();

		}
		//处理领取佣金
		public function rewardHandle(){
			$where['token']=$_GET['token'];
			$where['wecha_id']=$this->wecha_id;
			$where['rewardname']=$_GET['rewardname'];
			$data['rewardstatus']=1;
			if(D('agent_rewardinfo')->where($where)->save($data)){
				$this->redirect(U('Agent/reward',array('token'=>$_GET['token'],'wecha_id'=>$this->wecha_id)));
			}else{
				$this->error("领取失败");
			}
		}
		private function getjjr(){
			$where['Wecha_id']=$this->wecha_id;
			$where['Token']=$_GET['token'];
			$jjrarr=M('jjr')->where($where)->find();
			$list=M('jjr')->where(array('Token'=>$_GET['token']))->select();
			if($jjrarr){//已经注册返回注册信息
				$this->assign('jjrarr',$jjrarr);
				$this->display();
			}else{//未注册，跳转注册页面
				$this->redirect(U('Agent/register',array('token'=>$this->_get('token'),'wecha_id'=>$this->_get['wecha_id'])));
			}
		}
		
		private function getjjrAAAAA(){
			$where['Wecha_id']=$this->wecha_id;
			$where['Token']=$this->_get('token');
			$jjrarr=M('jjr')->where($where)->find();
			if($jjrarr){//已经注册返回注册信息
				$this->assign('jjrarr',$jjrarr);
				// var_dump($jjrarr);die()
				$this->display();
			}else{//未注册，跳转注册页面
				$this->redirect(U('Agent/register',array('token'=>$this->_get('token'),'wecha_id'=>$this->_get['wecha_id'])));
			}
		}
		//ajax加载楼盘信息
		public function ajaxlp(){
			$token=$_GET['token'];
			$num=$_POST['num'];
			//需要加载的条数
			$num1=4;
			$loupanwhere = array('token'=>$token);
			$lpinfo = M('lpinfo') ->where($loupanwhere)->order("id desc")->limit($num,$num1)->select();
			if($lpinfo){
				$this->ajaxReturn($lpinfo,"加载成功",1);
			}else{
				$this->ajaxReturn(0,"加载失败",0);
			}
		}

		//经纪人欢迎页
		public function begin(){
			$this->display();
		}
		//获取appid和secret
		public function haveinfo($token){
			$where['token']=$token;
			$wxuser=D("wxuser")->where($where)->field("appid,appsecret")->find();
			return $wxuser;
		}
	//处理分享信息
	public function getToken($url){
        $ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  
		//相当关键，这句话是让curl_exec($ch)返回的结果可以进行赋值给其他的变量进行，json的数据操作，如果没有这句话，则curl返回的数据不可以进行人为的去操作（如json_decode等格式操作）
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
		return curl_exec($ch); 
		//$row=curl_getinfo($ch, CURLINFO_HTTP_CODE);
	}
	//生成二维码
        public function getWeimas(){
	    if($_POST){
            $values['ID'] = $_POST['texts'];
            $data=D('kh');
          $list = $data->where($values)->find();

               ob_start();
               // $date=time();
               // if($list['yxTime']<$date){
                   // $this->error("二维码失效");
               // }else{
                   //$url = "http://".$_SERVER['HTTP_HOST'].$_POST['text'];//拼接url
				   $url = "http://".$_SERVER['HTTP_HOST'].U('Zhiye/newcustominfo',array('token'=>$_GET['token'],'id'=>$_POST['texts']));
                   vendor("phpqrcode.phpqrcode");
				   
                   $errorCorrectionLevel = 'L'; //容错级别
                   $matrixPointSize = 6; //生成图片大小
                   $mylogo = isset($_POST['text']) ? $_POST['text'] : "";
////生成二维码图片
                   QRcode::png($url, false, $errorCorrectionLevel, $matrixPointSize, 2);
				   $imageString =base64_encode(ob_get_contents());
				   ob_end_clean();
				   $data = array(
					  'code'=>200,
					  'data'=>$imageString
					);
					$this->ajaxReturn($data);

        }

//            if($_POST){
//
//                $value['text'] = $_POST['text'];
//                vendor("phpqrcode.phpqrcode");
//                $errorCorrectionLevel = 'L'; //容错级别
//                $matrixPointSize = 6; //生成图片大小
//                $mylogo = isset($_POST['text']) ? $_POST['text'] : "";
//////生成二维码图片
//                QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize, 2);
//            }else {
//
//
//            }

//            $this->assign("date",$date);
//            $this->display();
//            $logo = 'logo.png'; //准备好的logo图片
//            $QR = 'qrcode.png'; //已经生成的原始二维码图

//            $logo_rs = "../../../../modals/temp/".time().".png";//文件存放路径
//            $path = $_SERVER['DOCUMENT_ROOT']."/images/";
//            if ($mylogo == 1) { //带有logo
//                $QR = imagecreatefromstring(file_get_contents($QR));
//                $logo = imagecreatefromstring(file_get_contents($logo));
//                $QR_width = imagesx($QR); //二维码图片宽度
//                $QR_height = imagesy($QR); //二维码图片高度
//                $logo_width = imagesx($logo); //logo图片宽度
//                $logo_height = imagesy($logo); //logo图片高度
//                $logo_qr_width = $QR_width / 5;
//                $scale = $logo_width / $logo_qr_width;
//                $logo_qr_height = $logo_height / $scale;
//                $from_width = ($QR_width - $logo_qr_width) / 2;
//                imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
//                //输出图片
//                imagepng($QR, $path);
//                //重新组合图片并调整大小
//            } else { //不带logo
//             $date=   QRcode::png($value, $path, $errorCorrectionLevel, $matrixPointSize, 2);
//             var_dump($date);
//            }

        }
	}

 ?>