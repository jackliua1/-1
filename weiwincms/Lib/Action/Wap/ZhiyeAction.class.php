<?php 
//置业顾问控制

	class ZhiyeAction extends WapAction{
		public $token;
		public $wecha_id;
		public $zyinfo;
		
		public function _initialize() {
			parent::_initialize();
			$this->token    = filter_var($this->_get('token'),FILTER_SANITIZE_STRING);
			$this->wecha_id = filter_var($this->_get('wecha_id'),FILTER_SANITIZE_STRING);

			$nocheck = array('register');
			if(ACTION_NAME == 'register'){
				//如果到了注册页先清空wecha_id
				$this->wecha_id = '';
				unset($_SESSION['wecha_id']);
				setcookie("wecha_id","",time()-20);
			}
			if(!$this->wecha_id && !in_array(ACTION_NAME,$nocheck)){
				$this->redirect(U('Zhiye/register',array('token'=>$_GET['token'])));
			}
			if($this->wecha_id){
				//查询wecha_id是否存在
				$this->zyinfo = D("zy")->where(array('Token'=>$this->token,'Wecha_id'=>$this->wecha_id))->find();
				
				if(!$this->zyinfo){
					$this->redirect(U('Zhiye/register',array('token'=>$this->token)));
				}
			}
		}
		//置业顾问登录首页
		public function index(){
			//查询楼盘
			$lpinfo=D("lpinfo");
			$lpinfo=$lpinfo->where(array('token'=>$this->token,'id'=>array('in',$this->zyinfo['Uid'])))->select();
			$this->assign("lpinfo",$lpinfo);
			
			$this->assign("info",$this->zyinfo);
			$this->display();
		}

		//置业顾问注册
		public function register(){
			if($_POST){
				//改成了账号密码登录
				$data['Tel'] = $_POST['Tel'];
				$data['password'] = md5($_POST['password']);
				$data['Token']=$this->token;
//	            //验证是否已经注册过经纪人 $data['Wecha_id']=$_POST['Wecha_id'];
				$info = D('zy')->where($data)->find();
	            if($info){
					//保存session
					$_SESSION['wecha_id'] = $info['Wecha_id'];
					setcookie("wecha_id",$info['Wecha_id'],time()+30*24*3600);
	            	$this->redirect(U("Zhiye/index",array("token"=>$info['Token'])));
	            }else{
	                $this->error("账号密码错误");
	            }
			}else{
			 	//查询注册条款  cate=2表示置业顾问
			 	//$zytk=D("zc")->field("TiaoKuan")->where(array('Token'=>$this->token,'cate'=>2))->find();

		        //$this->assign("TiaoKuan",$zytk['TiaoKuan']);

                $this->display();
			}
		}

		//显示和修改置业顾问信息
		public function zyinfo(){
			$zy=D("zy");
			if($_POST){
				$data['ID']=$_POST['id'];
				// $data['Tel']=$_POST['Tel'];
				// $data['Name']=$_POST['Name'];
				// $data['Uid']=$_POST['Uid'];
				// $data['Token']=$token;
				// $data['Wecha_id']=$wecha_id;
				if($_POST['password']){
					$data['password']=md5(trim($_POST['password']));
					D("zy")->save($data);
					$this->redirect(U('Zhiye/register',array('token'=>$this->token)));
				}else{
					$this->error('您未修改信息');
				}
				
			}else{
				// $sql="select zy.ID,zy.Token,zy.Wecha_id,zy.Name,zy.Tel,zy.Uid,lp.LouPanTitle 
					// from wy_zy as zy,wy_lpinfo as lp 
					// where zy.Uid=lp.id and zy.Token='$token' and zy.Wecha_id='$wecha_id' limit 1";
				//$zyinfo=$zy->query($sql);
				$zyinfo=$zy->where(array('Token'=>$this->token,'Wecha_id'=>$this->wecha_id))->find();
				if($zyinfo){
					//查询楼盘
				 	$lpinfo=D("lpinfo");
				 	$lplists=$lpinfo->where(array('token'=>$this->token,'id'=>array('in',$zyinfo['Uid'])))->select();
					$this->assign("lplists",$lplists);
					$this->assign("zyinfo",$zyinfo);

					$this->display();
				}else{
					$this->redirect(U('Zhiye/register',array('token'=>$this->token)));
				}
			}
		}

		//显示新客户
		public function newcustom(){
			//chancle 在这边改成了固定的流程status 1：带看（新客户）2：到访 3：成交
			$status = $_GET['status']?intval($_GET['status']):1;
			$this->assign('status',$status);
			$zy=$this->zyinfo;
			$where['wy_kh.zy_id']=intval($this->zyinfo['ID']);
			//查找销售类型为新客户的ID
			// $status=D("agent_status")->order("sort")->limit(1)->getField("id");
			// $where['Stutas']=intval($status);
			$where['wy_kh.Stutas']=$status;
			//查询新客户信息
			$where['wy_kh.Token']=$this->token;
			
			//搜索条件 电话号码和日期
			if($_REQUEST['Tel'] && !empty($_REQUEST['Tel'])){
				$tel = $_REQUEST['Tel'];
				$where['wy_kh.Tel']=$tel;
				$this->assign('Tel',$tel);
			}
			$endtime = time();//结束时间设定为当前时间
			$starttime = 0;//全部
			if($_REQUEST['times'] && !empty($_REQUEST['times'])){
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
				$this->assign('times',$times);
			}
			$page = $_GET['page']?intval($_GET['page']):1;
			$listRows = 20;//每页显示数
			$this->assign('page',$page);//当前页码
			$firstRow = ($page-1)*$listRows;
			
			if($status == 1){
				$where['wy_kh.SrTime']=array('between',array($starttime,$endtime));
				$order = "wy_kh.SrTime desc";
			}elseif($status == 2){
				$where['wy_kh.DcTime']=array('between',array($starttime,$endtime));
				$order = "wy_kh.DcTime desc";
			}elseif($status == 3){
				$where['wy_kh.QyTime']=array('between',array($starttime,$endtime));
				$order = "wy_kh.QyTime desc";
			}
			
			$list=D("kh")->join('left join wy_lpinfo as lp on wy_kh.LouPanTitle=lp.id')
			->field('wy_kh.ID,wy_kh.Name,wy_kh.Tel,wy_kh.Stutas,lp.LouPanTitle')
			->where($where)->limit($firstRow,$listRows)->order($order)->select();
			
			if(!$list){
				$list = array();
			}
			//如果是新用户需要隐藏手机号中间四位
			if($list && $status == 1){
				foreach($list as $k=>$v){
					$list[$k]['Tel'] = substr_replace($v['Tel'], '****', 3, 4);
				}
			}
			
			if($_GET['is_ajax']){
				//如果是ajax请求
				$this->ajaxReturn($list,$page,1);
			}else{
				$this->assign("kh",$list);
				$this->assign("zy",$zy);
				$this->display();
			}
			//查询已领取新客户总数
			//$newkhcount=D("kh")->where($where)->count();
			//查询销售类型为无效客户的id
			//$statuslast=D("agent_status")->order("sort desc")->limit(1)->getField("id");
			//查询已领取客户总数
			//$lpid=intval($zy['Uid']);            //所属楼盘
			//$zyid=intval($zy['ID']);             //置业id为0的是没有分配
			//$statusid=intval($statuslast);          //销售类型为无效客户的ID
			//$token=$where['Token'];
			//$havekhcount=D("kh")->where("LouPanTitle=$lpid and zy_id=$zyid and Token='$token' and Stutas not in ('$statusid')")->count();
			// var_dump(D("kh")->getLastSql());die();
			//通过所属楼盘id查看是否开启自动分配
			//$lpinfo=D("lpinfo")->where("id=$lpid and Token='$token'")->find();
			//$this->assign("newkhcount",$newkhcount);
			//$this->assign("havekhcount",$havekhcount);
			//$this->assign("lpinfo",$lpinfo);
			
		}

		//新客户状态修改页面
		public function newcustominfo(){
			$id=$_GET['id'];
	        // $kh=D("kh")->find($id);
	        $sql="select kh.*,kh.Name as khname,kh.Tel as khtel,kh.LouPanTitle as lpid,
	        		jjr.Name as jjrname,jjr.brokerage_id,jjr.Tel as jjrtel,kh.DcTime,kh.RcTime,
	        		kh.RgTime,kh.QyTime,kh.HkTime,zy.Name as zyname,zy.Tel as zyTel,lp.LouPanTitle  
	        		from wy_kh as kh left join wy_jjr as jjr on kh.JJ_id=jjr.ID 
					left join wy_zy as zy on kh.zy_id=zy.ID 
					left join wy_lpinfo as lp on lp.id=kh.LouPanTitle 
	        		where kh.Token='$this->token' and kh.ID=$id ";
	        $kh=D("kh")->query($sql);
			
	        if($kh==null){
	        	$this->error('非法操作');
	        }
			
			if($kh[0]['brokerage_id']){
				//查询经纪人所在公司
				$kh[0]['zjgs'] = D('brokerage')->where(array('token'=>$this->token,'ID'=>$kh[0]['brokerage_id']))->getField('usersname');
			}
			
	        $status=intval($kh[0]['Stutas']);
			//新客户隐藏电话
			if($status == 1){
				$kh[0]['khtel'] = substr_replace($kh[0]['khtel'], '****', 3, 4);
			}
	        //根据statusid查询出对应的sort值
	        //$sort=D("agent_status")->where("id=$statusid and token='$token'")->getField("sort");
	        //查询楼盘销售有哪些状态
	        //$status=D("agent_status")->where("token='$token'")->limit(1,5)->order("sort")->select();
	        //查询销售状态为无效的客户
	        //$wxstatus=D("agent_status")->where("token='$token'")->limit(1)->order("sort desc")->find();
	        $this->assign("status",$status);
	        //$this->assign("wxstatus",$wxstatus);
	        $this->assign("kh",$kh[0]);
	        $this->assign("sort",intval($sort));
			$this->display();
		}
		//chancle 修改后全变成了这个 客户状态修改处理
		public function custommodify(){
			if($_POST){
				$dbkh = D("kh");
				$data = $_POST;
				$data['ID'] = $khid = intval($_POST['id']);//客户id
				$data['Stutas'] = intval($_POST['status']);
				
				if(!$khid){
					$this->error('非法操作');
				}
				//客户到访
				if($data['Stutas']==2){
					$data['DcTime'] = time();//到场时间
					//查询该楼盘的保护时间
					$lpinfo = D('lpinfo')->where(array('id'=>intval($_POST['lpid'])))->find();
					$data['yxTime'] = time()+24*3600*intval($lpinfo['houseSortse']);//有效日期
					$data['jdname'] = $_POST['jdname'];
					$data['jdtel'] = $_POST['jdtel'];
				}
				//完成
				if($data['Stutas']==3){
					if(!$_POST['is_ok']){
						$data['QyTime'] = time();//完成时间
					}
					
					//实收金额
					$skje1 = sprintf("%.2f", $data['skje1']);
					$skje2 = sprintf("%.2f", $data['skje2']);
					$skje3 = sprintf("%.2f", $data['skje3']);
					$ssje = $skje1+$skje2+$skje3;
					$data['ssje'] = sprintf("%.2f", $ssje);//实收金额
				}
				
				if($dbkh->save($data)){
					$this->success('修改成功',U('Zhiye/newcustom',array('token'=>$this->token,'status'=>$data['Stutas'])));
				}else{
					$this->error("修改失败");
				}
			}
		}

		//新客户状态修改处理
		public function newcustommodify1(){
			if($_GET){
				$data['ID']=$_GET['id'];           //客户ID
				$data['Token']=$_GET['token'];     //Token
				//根据客户ID查找当前该客户的状态id
				$kh=D("kh")->where($data)->field("Stutas")->find();
				$Stutasid=intval($kh['Stutas']);
				//通过状态id查询sort排序
				$statusarr=D("agent_status")->find($Stutasid);
				$oldsort=intval($statusarr['sort']);  //该销售状态的当前排序
				$data['Stutas']=$_GET['Stutas'];   //销售状态id
				//根据销售状态ID查询出状态名称
				$status=D("agent_status")->find($data['Stutas']);
				$newsort=intval($status['sort']);    //该销售状态改变后的排序
				if($newsort!=($oldsort+1)){
					$this->error("请按正常流程操作");
				}
				$salesstatus=$status['salesstatus'];
				switch ($salesstatus) {
					case '到场':
						$data['DcTime']=time();
						break;
					case '认筹':
						$data['RcTime']=time();
						break;
					case '认购':
						$data['RgTime']=time();
						break;
					case '签约':
						$data['QyTime']=time();
						break;
					case '回款':
						$data['HkTime']=time();
						$data['salesvalue']=$_POST['salesvalue'];
						break;
				}
				if(D("kh")->save($data)){

					//添加一条操作记录到经纪人奖励明细表(wy_agent_rewardinfo)
					// 通过客户ID 获取 经纪人微信Wecha_id、客户姓名、楼盘名称loupanname、
					//销售状态名称salesstatus（上面已获取到）、奖励名称、奖励金额、生成时间
					$khid=$data['ID'];
					$sql="SELECT kh.ID,kh.`Name`,kh.salesvalue,kh.Stutas,jjr.Token,jjr.Wecha_id,
							lpinfo.id as lpid,lpinfo.LouPanTitle 
							from wy_kh as kh , wy_jjr as jjr , wy_lpinfo as lpinfo 
							where kh.ID=$khid AND kh.JJ_id=jjr.ID AND kh.LouPanTitle=lpinfo.id";
					$khinfo=D("kh")->query($sql);
					$token=$khinfo[0]['Token'];
					$lpid=$khinfo[0]['lpid'];
					$statusid=$khinfo[0]['Stutas'];
					
					//根据token  楼盘id  销售状态  查询出奖励内容
					$sqlreward="SELECT rewardname,rewardparam,rewardamount  
							from wy_reward_info as info , wy_reward_param as param 
							where info.token='$token' AND info.loupanid=$lpid 
							AND info.statusid=$statusid AND info.rewardid=param.id";
					$rewardinfo=D("reward_info")->query($sqlreward);

					//如果有奖励内容则进行状态记录
					if($rewardinfo){
						$rew['token']=$token;
						$rew['wecha_id']=$khinfo[0]['Wecha_id'];
						$rew['customname']=$khinfo[0]['Name'];
						$rew['loupanname']=$khinfo[0]['LouPanTitle'];
						$rew["statusname"]=$salesstatus;
						$rew['rewardname']=$rewardinfo[0]['rewardname'];
						if($rewardinfo[0]['rewardparam']==0){
							$rew['rewardamount']=(float)$rewardinfo[0]['rewardamount'];
						}else{
							$rew['rewardamount']=(float)($rewardinfo[0]['rewardamount']*floatval($_POST['salesvalue']*0.01));
						}
						$total=floor($rew['rewardamount']*10)/10;
						$rew['rewardamount']=sprintf( "%.1f ",(float)$total);
						$rew['srtime']=time();
						D("agent_rewardinfo")->add($rew);
					
					}
					if($salesstatus=="回款"){
						$this->redirect(U('Zhiye/endcustom',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$_GET['id'])));
					}else{
						$this->redirect(U('Zhiye/custominfo',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$_GET['id'])));
					}
				}else{
					$this->error("修改失败");
				}
			}else{
				$this->error("非法操作");
			}
		}

	//新客户领取显示页
	 public function fpCustom(){
	 	$where['Token']=$_GET['token'];
	 	$Wecha_id=$_GET['wecha_id'];
	 	//获取置业顾问所属楼盘id
	 	$lpid=intval($_GET['lpid']);
	 	//获取置业顾问即销售顾问的信息
	 	$zy=D('zy')->where(array("Token"=>$_GET['token'],"Uid"=>$lpid,"Wecha_id"=>$Wecha_id))->find();
	 	//查找销售类型为新客户的ID
		$status=D("agent_status")->order("sort")->limit(1)->getField("id");
		$where['Stutas']=intval($status);
		//查询已领取新客户总数
		$mykhcount=D("kh")->where(array('Token'=>$where['Token'],'zy_id'=>$zy['ID'],
								'LouPanTitle'=>$lpid,'Stutas'=>$status))->count();
	 	//获取未分配客户的信息
	 	$kh=D("kh");
	 	$where['zy_id']=0;
	 	$where['LouPanTitle']=$lpid;
	 	$where['JJ_id']=array("not in","0");
	 	$khinfo=$kh->where($where)->select();
	 	
	 	$this->assign("khinfo",$khinfo);
	 	$this->assign("zy",$zy);
	 	$this->assign("mykhcount",intval($mykhcount));
	 	$this->display();
	 }

	 //客户分配处理
	 public function fpHandle(){
	 	$token=$_GET['token'];   //获取toke值
	 	$khid=$_POST['khid'];     //获取客户id
	 	$zyid=$_POST['zyid'];     //获取置业顾问id
	 	$lpinfo=D("lpinfo");
	 	$kh=D("kh");
	 	// $khlength=count($kharr);
	 	$where['ID']  = array('in',$khid);
	 	$where['Token'] = $token;
	 	$data['zy_id'] = $zyid;
	 	$count=$kh->where($where)->save($data);
	 	if($count){
	 		$this->redirect(U('Zhiye/newcustom',array('token'=>$this->_get('token'),'wecha_id'=>$this->_get('wecha_id'))));
	 	}else{
	 		$this->error("领取失败");
	 	}
	 }

		//显示跟进中客户
		public function ingcustom(){
			//查找置业顾问ID
			$data['Token']=$_GET['token'];
	        $data['Wecha_id']=$_GET['wecha_id'];
			$zy=D("zy")->where($data)->find();
			if($zy==null){
				$this->redirect(U('Zhiye/register',array('token'=>$this->_get('token'),'wecha_id'=>$this->_get('wecha_id'))));
			}
			$zy_id=intval($zy['ID']);
			//查找销售类型中新客户的ID
			$status=D("agent_status")->where(array("token"=>$data['Token']))->order("sort")->limit("1,5")->field("id")->select();
			$statusid=array();
			foreach ($status as $key => $value) {
				$statusid[]=intval($value['id']);
			}
			$status=implode($statusid, ",");
			// $where['Stutas']=array("in",$status);
			//查询新客户信息
			$Token=$_GET['token'];
			// $kh=D("kh")->where($where)->select();
			$sql="select kh.ID,kh.Token,kh.Name,kh.Tel,status.salesstatus  
					from wy_kh as kh,wy_agent_status as status 
					where kh.Token='$Token' and kh.zy_id='$zy_id' 
					and kh.Stutas in ($status) and kh.Stutas=status.id";
			$kh=D("kh")->query($sql);
			$this->assign("kh",$kh);
			$this->assign("zy",$zy);
			$this->display();
		}

		//显示老客户
		public function endcustom(){
			//查找置业顾问ID
			$data['Token']=$_GET['token'];
	        $data['Wecha_id']=$_GET['wecha_id'];
			$zy=D("zy")->where($data)->find();
			if($zy==null){
				$this->redirect(U('Zhiye/register',array('token'=>$this->_get('token'),'wecha_id'=>$this->_get('wecha_id'))));
			}
			$zy_id=intval($zy['ID']);
			//查找销售类型中已回款客户的ID
			$token=$data['Token'];
			$status=D("agent_status")->where("token='$token'")->order("sort desc")->limit("1,1")->field("id")->select();
			$status=intval($status[0]['id']);
			// $where['Stutas']=array("in",$status);
			//查询新客户信息
			$Token=$_GET['token'];
			// $kh=D("kh")->where($where)->select();
			$sql="select kh.ID,kh.Token,kh.Name,kh.Tel,status.salesstatus  
					from wy_kh as kh,wy_agent_status as status 
					where kh.Token='$Token' and kh.zy_id=$zy_id 
					and kh.Stutas=$status and kh.Stutas=status.id";
			$kh=D("kh")->query($sql);
			$this->assign("kh",$kh);
			$this->assign("zy",$zy);
			$this->display();
		}
		

		//显示客户详情
		public function custominfo(){
			$id=$_GET['id'];
			$token=$_GET['token'];
	        $wecha_id=$_GET['wecha_id'];
	        // $kh=D("kh")->find($id);
	        $sql="select kh.ID,kh.Token,kh.Name as khname,kh.Tel as khtel,kh.Stutas,
	        		jjr.Name as jjrname,jjr.Tel as jjrtel,kh.DcTime,kh.RcTime,
	        		kh.RgTime,kh.QyTime,kh.HkTime,zy.Name as zyname,zy.Wecha_id 
	        		from wy_kh as kh,wy_jjr as jjr,wy_zy as zy 
	        		where kh.Token='$token' and kh.ID=$id 
	        		and kh.JJ_id=jjr.ID and kh.zy_id=zy.ID";
	        $kh=D("kh")->query($sql);
	        if($kh==null){
	        	$this->redirect(U('Zhiye/newcustom',array('token'=>$this->_get('token'),'wecha_id'=>$this->_get('wecha_id'))));
	        }
	        $statusid=intval($kh[0]['Stutas']);
	        //根据statusid查询出对应的sort值
	        $sort=D("agent_status")->where("id=$statusid and token='$token'")->getField("sort");
	        //查询楼盘销售有哪些状态
	        $status=D("agent_status")->where("token='$token'")->limit(2,4)->order("sort")->select();
	        //查询销售状态为无效的客户
	        $wxstatus=D("agent_status")->where("token='$token'")->limit(1)->order("sort desc")->find();
 		$datas=D('kh')->where("ID='$id'")->find();
            $datas['indes']=$datas['salesvalue']+$datas['salesvalues'];
            $datas['inde']=$datas['indes']+$datas['salesvaluew'];
	        $this->assign("status",$status);
	        $this->assign("wxstatus",$wxstatus);
	        $this->assign("kh",$kh[0]);
	        $this->assign("sort",intval($sort));
			$this->display();
		}

		//修改客户状态 现在汇总成了 custommodify
		public function custommodify_old(){
			if($_GET){
				$data['ID']=$_GET['id'];           //客户ID
				$data['Token']=$_GET['token'];     //Token
				//根据客户ID查找当前该客户的状态id
				$kh=D("kh")->where($data)->field("Stutas")->find();
				$Stutasid=intval($kh['Stutas']);
				//通过状态id查询sort排序
				$statusarr=D("agent_status")->find($Stutasid);
				$oldsort=intval($statusarr['sort']);  //该销售状态的当前排序
				$data['Stutas']=$_GET['Stutas'];   //销售状态id
				//根据销售状态ID查询出状态名称
				$status=D("agent_status")->find($data['Stutas']);
				$newsort=intval($status['sort']);    //该销售状态改变后的排序
				if($newsort!=($oldsort+1)){
					$this->error("请按正常流程操作");
				}
				$salesstatus=$status['salesstatus'];
				switch ($salesstatus) {
					case '到场':
						$data['DcTime']=time();
						break;
					case '认筹':
						$data['RcTime']=time();
						break;
					case '认购':
						$data['RgTime']=time();
						break;
					case '签约':
						$data['QyTime']=time();
						break;
					case '回款':
						$data['HkTime']=time();
						$data['salesvalue']=$_POST['salesvalue'];
						break;
				}
				if(D("kh")->save($data)){

					//添加一条操作记录到经纪人奖励明细表(wy_agent_rewardinfo)
					// 通过客户ID 获取 经纪人微信Wecha_id、客户姓名、楼盘名称loupanname、
					//销售状态名称salesstatus（上面已获取到）、奖励名称、奖励金额、生成时间
					$khid=$data['ID'];
					$sql="SELECT kh.ID,kh.`Name`,kh.salesvalue,kh.Stutas,jjr.Token,jjr.Wecha_id,
							lpinfo.id as lpid,lpinfo.LouPanTitle 
							from wy_kh as kh , wy_jjr as jjr , wy_lpinfo as lpinfo 
							where kh.ID=$khid AND kh.JJ_id=jjr.ID AND kh.LouPanTitle=lpinfo.id";
					$khinfo=D("kh")->query($sql);
					$token=$khinfo[0]['Token'];
					$lpid=$khinfo[0]['lpid'];
					$statusid=$khinfo[0]['Stutas'];
					
					//根据token  楼盘id  销售状态  查询出奖励内容
					$sqlreward="SELECT rewardname,rewardparam,rewardamount  
							from wy_reward_info as info , wy_reward_param as param 
							where info.token='$token' AND info.loupanid=$lpid 
							AND info.statusid=$statusid AND info.rewardid=param.id";
					$rewardinfo=D("reward_info")->query($sqlreward);

					//如果有奖励内容则进行状态记录
					if($rewardinfo){
						$rew['token']=$token;
						$rew['wecha_id']=$khinfo[0]['Wecha_id'];
						$rew['customname']=$khinfo[0]['Name'];
						$rew['loupanname']=$khinfo[0]['LouPanTitle'];
						$rew["statusname"]=$salesstatus;
						$rew['rewardname']=$rewardinfo[0]['rewardname'];
						if($rewardinfo[0]['rewardparam']==1){
							$rew['rewardamount']=floatval($rewardinfo[0]['rewardamount']);
						}else{
							$rew['rewardamount']=floatval($rewardinfo[0]['rewardamount']*$_POST['salesvalue']*0.01);
						}
						$total=floor($rew['rewardamount']*10)/10;
						$rew['rewardamount']=sprintf( "%.1f ",(float)$total);
						$rew['srtime']=time();
						D("agent_rewardinfo")->add($rew);
					}
					if($salesstatus=="回款"){
						$this->redirect(U('Zhiye/endcustom',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$_GET['id'])));
					}else{
						$this->redirect(U('Zhiye/custominfo',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$_GET['id'])));
					}
				}else{
					$this->error("修改失败");
				}
			}else{
				$this->error("非法操作");
			}
		}
		//修改客户状态为无效
		public function wxcustommodify(){
			if($_GET){
				$data['ID']=$_GET['id'];           //客户ID
				$data['Token']=$_GET['token'];     //Token
				$data['Stutas']=$_GET['Stutas'];   //销售状态id
				$data['Wecha_id']=$_GET['wecha_id'];  //微信号ID
				//根据销售状态ID查询出状态名称
				$status=D("agent_status")->find($data['Stutas']);
				if(D("kh")->save($data)){
					$this->redirect(U('Zhiye/newcustom',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$_GET['id'])));
				}else{
					$this->error("修改失败");
				}
			}else{
				$this->error("非法操作");
			}
		}

		//验证邀请码
		public function checkyqm(){

		}
		
		//通过wecha_id获取置业顾问信息；Index页不能使用
		private function getzy(){
			$where['Wecha_id']=$this->wecha_id;
			$where['Token']=$this->token;
			$zyarr=M('zy')->where($where)->find();
			if($zyarr){//已经注册返回注册信息
				$this->assign('zyarr',$zyarr);
				$this->display();
			}else{//未注册，跳转注册页面
				$this->redirect(U('Zhiye/register',array('token'=>$this->token,'wecha_id'=>$this->wecha_id)));
			}
		}
	//客户报备
	public function addcustom(){
            $where['Token']=$this->token;
			//查询经纪公司
			$jjgs = D('brokerage')->where($where)->select();
			$this->assign('jjgs',$jjgs);
			$where['Wecha_id']=$this->wecha_id;
            $data=D('zy');
			$list=$data->where($where)->find();//驻场经理
            if($_POST){
                $where['Name']=$_POST['name'];
                $where['Tel']=$_POST['tel'];
                $where['zy_id']=$list['ID'];
                $where['JJ_id']= intval($_POST['jjrid']);
                $where['LouPanTitle']=intval($_POST['lpid']); //楼盘id
                $where['DcTime'] = $where['SrTime']=time();//当前时间
                //$where['yxTime']=strtotime(date('Y-m-d',$where['SrTime']+3600*24*15));//没有经纪人的有效日期暂时不管
                $where['Stutas']=2; //案场经理输入的客户直接到场
				
				$where['jdname']= $_POST['jdname']?$_POST['jdname']:$list['Name'];
				$where['jdtel']= $_POST['jdtel']?$_POST['jdtel']:$list['Tel'];
				
				$datr=D('kh');
				$info=$datr->add($where);  //这里没有校验重复了
				if($info){
					$this->redirect(U('Zhiye/newcustom',array('token'=>$this->token,'status'=>2)));

				}else{
					$this->error("修改失败");
				}
            }else{
				$where['id'] = array('in',$list['Uid']);
				$loupaninfo = M('lpinfo')->where($where)->select();
				$this->assign('lpinfo',$loupaninfo);
				$this->assign('list',$list);
				$this->display();
			}
        }
		
		//ajax获取经纪人
		public function ajax_jjr(){
			$brokerage_id = intval($_POST['brokerage_id']);
			$jjrlist = D("jjr")->where(array("brokerage_id"=>$brokerage_id))->select();
			$this->ajaxReturn($jjrlist,'',1);
		}
	}

 ?>