<?php 
//经纪人控制

	class AgentAction extends BaseAction{
		public $token;
		public $wecha_id;
		
		public function _initialize() {
			parent::_initialize();
			$this->token    = filter_var($this->_get('token'),FILTER_SANITIZE_STRING);
			$this->wecha_id = filter_var($this->_get('wecha_id'),FILTER_SANITIZE_STRING);
			// if(!isset($_GET['wecha_id'])){
			// 	$this->error('请通过微信浏览器访问~！');
			// }
            
		}
		//未注册经纪人登录首页
		public function index(){
			//定义需要显示的条数
			$num=10;
			//楼盘信息
			$token = $this->_get("token");
			$loupanwhere = array('token'=>$token);
			$loupaninfo = M('lpinfo') ->where($loupanwhere)->order("id desc")->limit(0,$num)->select();
			$this->assign('lpinfo',$loupaninfo);
			

			$where['Wecha_id']=$_GET['wecha_id'];
			$where['Token']=$_GET['token'];
			$jjrarr=M('jjr')->where($where)->find();
			$this->assign("num",$num);
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
			$where['Wecha_id']=$_GET['wecha_id'];
			$where['Token']=$_GET['token'];
			$rewardinfo=D("agent_rewardinfo");
			//佣金总额
			$allcount=$rewardinfo->where(array('wecha_id'=>$_GET['wecha_id'],'token'=>$_GET['token']))->sum("rewardamount");
			$jjrinfo=M('jjr')->where($where)->find();
			// D("xmfx")->where("id>0")->delete();
			// D("xmfx_list")->where("id>0")->delete();
		// 	echo $jjrinfo['credit'];
		// 	$xmfx=D("xmfx")->select();
		// 	$xmfx_list=D("xmfx_list")->select();
		// 	echo "<pre>";
		// var_dump($xmfx_list);
		// echo "</pre><pre>";
		// var_dump($xmfx);
			if(!$jjrinfo){
				$this->redirect(U('Agent/register',array('token'=>$this->_get('token'),'wecha_id'=>$jjrarr['Wecha_id'])));
			}
			$jjrid=intval($jjrinfo['ID']);
			//查找当前经纪人客户信息
			$countkh=D("kh")->where(array("Token"=>$where['Token'],"JJ_id"=>$jjrid))->count();

			//楼盘信息
			$loupanwhere = array('token'=>$where['Token']);
			//定义需要显示的条数
			$num=10;
			$loupaninfo = M('lpinfo') ->where($loupanwhere)->order("id desc")->limit(0,$num)->select();
			$this->assign('lpinfo',$loupaninfo);
			$this->assign("jjrinfo",$jjrinfo);
			$this->assign("countkh",$countkh);
			$this->assign("num",$num);
			$this->assign('allcount',$allcount);
			$this->display();
		}
		//经纪人注册
		public function register(){
			if($_POST){
				$data['Token']=$_POST['token'];
	            $data['Wecha_id']=$_POST['wecha_id'];
	            //验证是否已经注册过经纪人
	            if(D('jjr')->where($data)->find()){
	            	$this->redirect(U("Agent/ydl",array("wecha_id"=>$data['Wecha_id'],"token"=>$data['Token'])));
	            }
	            //验证是否已经注册过置业顾问
	            if(D('zy')->where($data)->find()){
	            	$this->redirect(U("Agent/ydl",array("wecha_id"=>$data['Wecha_id'],"token"=>$data['Token'])));
	            }
	            //验证是否已经注册过置业顾问
	            if(D('ac')->where($data)->find()){
	            	$this->redirect(U("Agent/ydl",array("wecha_id"=>$data['Wecha_id'],"token"=>$data['Token'])));
	            }
	            $data['Name']=trim($_POST['Name']);
	            $data['Tel']=trim($_POST['Tel']);
	            // $data['leibie']=trim($_POST['leibie']);
	            $data['leibie']=intval(($_POST['typeid']));
	            //通过typeid查找是否需要保存公司名称
	            $type=D("agent_type")->find($data['leibie']);
	            if($type['iscompany']){
	            	$data['companyname']=trim($_POST['companyname']);
	            }
	            $data['Mtime']=time();
	            $jjrarr=D('jjr')->add($data);
	            if($jjrarr){
	                $this->redirect(U('Agent/ydl',array("wecha_id"=>$data['Wecha_id'],"token"=>$data['Token'])));
	            }else{
	                $this->error("注册失败");
	            }
			}else{
				$token=$_GET['token'];

			 	//查询注册条款  cate=1表示经纪人
			 	$jjrtk=D("zc")->field("TiaoKuan")->where(array('Token'=>$token,'cate'=>1))->find();
			 	//查询经纪人类型
			 	$type=D("agent_type")->where(array('token'=>$token))->order("sort")->select();
			 	
	            $this->assign("list",$list);
	            $this->assign("wecha_id",$_GET['wecha_id']);
	            $this->assign("token",$_GET['token']);
		        $this->assign("TiaoKuan",$jjrtk['TiaoKuan']);
		        $this->assign("type",$type);

                $this->display();
			}
		}

		//经纪人信息页面
		public function myInfo(){
			if($_POST){
				$data['ID']=intval($_POST['id']);
				$data['Tel']=trim($_POST['Tel']);
				$data['leibie']=intval($_POST['typeid']);
				$data['companyname']=trim($_POST['companyname']);
				if(D("jjr")->save($data)){
					$this->redirect(U('Agent/ydl',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
				}else{
					$this->error("修改失败");
				}
			}else{
				$where['Token']=$_GET['token'];
				$where['Wecha_id']=$_GET['wecha_id'];
				$jjrinfo=D("jjr")->where($where)->find();
				if($jjrinfo){
					//查看经纪人类别
					$type=D("agent_type")->where(array('token'=>$_GET['token']))->select();
					$this->assign("jjrinfo",$jjrinfo);
					$this->assign("type",$type);
					$this->display();
				}else{
					$this->redirect(U('Agent/register',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
				}
			}
		}

		//点击楼盘进入楼盘详情页面
		public function loupanInfo(){

			if(isset($_GET['state'])){
				//已登录后详情页
				$state=$_GET['state'];
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
				$jjrarr=M('jjr')->where(array('ID'=>$info['jid']))->find();
				// var_dump($_GET);

				$uid=intval($info['uid']);  //项目id
				// echo $uid;
				// die();
				//总浏览量+1
				D("lpinfo")->where(array('id'=>$uid))->setInc("video",1);
				$wecha_id=$_GET['wecha_id'];     //经纪人wecha_id
				$xmfx_list=M('xmfx_list')->where(array('wecha_id'=>$cwecha_id,"token"=>$token,"uid"=>$uid))->find();
				// var_dump($xmfx_list);
				if(!$xmfx_list){
					// echo "<hr>11111<hr>";
					$data['token']=$token;
					$data['uid']=$uid;
					$data['wecha_id']=$cwecha_id;
					//将浏览人保存到表中
					M('xmfx_list')->add($data);
					//浏览人+1
					D("xmfx")->where(array("id"=>$_GET['state']))->setInc("views",1);
					//查询出浏览达到多少次才能获取积分
					$lpinfo=D("lpinfo")->where(array("id"=>$uid))->field("longitude,latitude")->find();
					$longitude=intval($lpinfo['longitude']);   //需要达到的浏览量
					$latitude=intval($lpinfo['latitude']);     //达到目标浏览量后可获得的积分
					//判断是否达到获取积分标准
					$views=intval($info['views'])+1;
					if($views%$longitude==0){  
						//如果浏览次数达到浏览量的倍数则进行一次积分增加
						D("jjr")->where(array('ID'=>$info['jid']))->setInc("credit",$latitude);
					}
				}
				// $xmfx_list=M('xmfx_list')->where(array('wecha_id'=>$cwecha_id,"token"=>$token))->find();
				// var_dump($xmfx_list);die();
				
				$lpinfo=D("lpinfo")->where(array('id'=>$info['uid']))->find();
				$jjrarr=M('jjr')->where(array('id'=>$info['jid']))->find();
				$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
				//判断是否达到积分要求
				$this->assign('token',$_GET['token']);
				$this->assign('wecha_id',$_GET['wecha_id']);
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
			if(isset($_GET['wecha_id'])){
				$this->getjjrsa($_GET['id'],$_GET['wecha_id']);
				exit();
			}

		}

		//通过wecha_id获取经纪人信息；Index页不能使用
		private function getjjrsa($id,$wid){
			$where['Wecha_id']=$_GET['wecha_id'];
			$where['Token']=$this->_get('token');
			//获取当前分享经纪人的id
			$jjrarr=M('jjr')->where($where)->field('id')->find();
			if($jjrarr){//已经注册返回注册信息
				$this->redirect(U('Agent/weimaoa',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'uid'=>$_GET['id'],'jid'=>$jjrarr['id'])));
			}else{//未注册，跳转注册页面
				$this->redirect(U('Agent/register',array('token'=>$this->_get('token'),'wecha_id'=>$this->_get['wecha_id'])));
			}
		}
		public function weimaoa(){
			//项目分享
			// $where['id']=$_GET['uid'];      //项目id
			$where['token']=$_GET['token'];  
			// $lpinfo=D("lpinfo")->where($where)->field('id')->find();
			//存数据库
			unset($where['id']);
			$where['jid']=$_GET['jid'];    //经纪人id
			$where['uid']=$_GET['uid'];    //项目id
			$list=M('xmfx')->where($where)->field('id')->find();
			if($list==''){
				$list=M('xmfx')->where($where)->add($where);
			}
			if(!$list==""){
				if(is_array($list))
				{
  					$num=$list['id'];
				}else{
					$num=$list;
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
			$where['Wecha_id']=$_GET['wecha_id'];
			$where['token']=$_GET['token'];
			$lpinfo=D("lpinfo")->where($where)->find();
			$this->assign("lpinfo",$lpinfo);
			// $this->display();
			$this->getjjr();
		}
		//未登陆者点击楼盘进入楼盘详情页面
		public function loupanInfo1(){

			$where['id']=$_GET['id'];
			// $where['Wecha_id']=$_GET['wecha_id'];
			
			$where['token']=$_GET['token'];
			//总浏览量+1
			D("lpinfo")->where($where)->setInc("video",1);
			$lpinfo=D("lpinfo")->where($where)->find();
			$this->assign("lpinfo",$lpinfo);
			$this->display();
		}

		//录入客户信息
		public function addCustom(){
			// $Wecha_id=$_GET['wecha_id'];
			// $Token=$_GET['token'];
			//查看在售楼盘
			$where['token'] = $_GET['token'];
			$lpid=0;
			if(isset($_GET['lpid'])){
				$where['id']=intval($_GET['lpid']);
				$lpid=intval($_GET['lpid']);
			}
			$loupaninfo = M('lpinfo') ->where($where)->select();
			$this->assign('lpinfo',$loupaninfo);
			$this->assign('lpid',$lpid);
			$jjrInfo = $this->getjjr();

		}


		//通过手机号验证客户是否唯一
		public function khyz(){
			$where['Token']=$_POST['token'];
			$where['Tel']=$_POST['tel'];
			if(D('kh')->where($where)->find()){
				echo "1";die();
			}else{
				echo "0";die();
			}

		}

		//添加客户处理
		public function addCustomHandle(){
			if($_POST){
				$data['Token']=$_GET['token'];
				$data['Name']=$_POST['name'];
				$data['JJ_id']=$_POST['JJ_id'];
				$data['Tel']=$_POST['tel'];
				$data['LouPanTitle']=intval($_POST['LouPanTitle']);
				if(D('kh')->where(array('Tel'=>$data['Tel'],'Token'=>$_GET['token'],'LouPanTitle'=>$data['LouPanTitle']))->find()){
					$this->error('客户已存在');
					// $this->redirect(U('Agent/ydl',array('token'=>$data['Token'],'wecha_id'=>$_GET['wecha_id'],'JJ_id'=>$data['JJ_id'])));
				}
				
				//查找第一个状态的
				$stutas=D("agent_status")->order("sort asc")->limit(1)->field("id")->find();
				$data['Stutas']=intval($stutas);
				$data['SrTime']=time();

				if(D("kh")->add($data)){
					if(isset($_POST['type'])){
						$this->redirect(U('Agent/myCustom',array('token'=>$data['Token'],'wecha_id'=>$_GET['wecha_id'],'JJ_id'=>$data['JJ_id'])));
					}else{
						$this->redirect(U('Agent/loupanInfo',array('token'=>$data['Token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$data['LouPanTitle'])));
					}
					
				}else{
					$this->error("提交失败");
				}
			}
		}
		
		//我的客户信息页
		public function myCustom(){
			$kh=D("kh");
			
			$token=$_GET['token'];
			$jjid=intval($_GET['JJ_id']);
			$sql="SELECT kh.ID,kh.Token,kh.Wecha_id,kh.`Name`,kh.Tel,
					lp.LouPanTitle,kh.SrTime,status.salesstatus 
					from wy_kh as kh LEFT JOIN wy_lpinfo as lp on kh.LouPanTitle=lp.id 
					LEFT JOIN wy_agent_status as status on kh.Stutas=status.id 
					WHERE kh.Token='$token' AND kh.JJ_id=$jjid order by kh.SrTime desc";
        	$list=$kh->query($sql);
        	$this->assign("list",$list);
			$jjrInfo = $this->getjjr();
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
			$where['wecha_id']=$_GET['wecha_id'];
			$rewardinfo=D("agent_rewardinfo");
			//佣金总额
			$allcount=$rewardinfo->where($where)->sum("rewardamount");

			//佣金详情
			
			$info=$rewardinfo->where($where)->order("id desc")->select();
			//已领取总额
			$where['rewardstatus']=1;
			$ylcount=$rewardinfo->where($where)->sum("rewardamount");
			//查看银行卡
			// $bank=D("agent_bank")->where($where)->find();
			// $this->assign("bank",$bank);
			$this->assign("info",$info);
			$this->assign("allcount",$allcount);
			$this->assign("ylcount",$ylcount);
			$jjrInfo = $this->getjjr();
		}

		//绑定银行卡
		public function bank(){
			$bank=D("agent_bank");
			$where['token']=$_GET['token'];
			$where['wecha_id']=$_GET['wecha_id'];
			if($_POST){
				$data['name']=$_POST['name'];
				$data['bankcard']=$_POST['bankcard'];
				$data['bankname']=$_POST['bankname'];
				if($bank->where($where)->find()){
					$list=$bank->where($where)->save($data);
				}else{
					$data['token']=$_GET['token'];
					$data['wecha_id']=$_GET['wecha_id'];
					$list=$bank->add($data);
				}
				if($list){
					$this->redirect(U('Agent/commission',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
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
			$wecha_id=$_GET['wecha_id'];
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
			$where['wecha_id']=$_GET['wecha_id'];
			$where['rewardname']=$_GET['rewardname'];
			$data['rewardstatus']=1;
			if(D('agent_rewardinfo')->where($where)->save($data)){
				$this->redirect(U('Agent/reward',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
			}else{
				$this->error("领取失败");
			}
		}
		private function getjjr(){
			$where['Wecha_id']=$_GET['wecha_id'];
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
			$where['Wecha_id']=$_GET['wecha_id'];
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

	}

 ?>