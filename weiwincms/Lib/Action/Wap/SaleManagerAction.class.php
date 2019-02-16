<?php 
//销售经理
 class SaleManagerAction extends WapAction{
 	public $token;
	public $wecha_id;
	public $acinfo;
	
	public function _initialize() {
		parent::_initialize();
		$this->token    = filter_var($this->_get('token'),FILTER_SANITIZE_STRING);
		$this->wecha_id = filter_var($this->_get('wecha_id'),FILTER_SANITIZE_STRING);
		if(!isset($_GET['wecha_id'])){
			//$this->error('请通过微信浏览器访问~！');
		}
        $nocheck = array('register');
		if(ACTION_NAME == 'register'){
			//如果到了注册页先清空wecha_id
			$this->wecha_id = '';
			unset($_SESSION['wecha_id']);
			setcookie("wecha_id","",time()-20);
		}
		if(!$this->wecha_id && !in_array(ACTION_NAME,$nocheck)){
			$this->redirect(U('SaleManager/register',array('token'=>$_GET['token'])));
		}
		if($this->wecha_id){
			//查询wecha_id是否存在
			$this->acinfo = D("ac")->where(array('Token'=>$this->token,'Wecha_id'=>$this->wecha_id))->find();
			
			if(!$this->acinfo){
				$this->redirect(U('SaleManager/register',array('token'=>$this->token)));
			}
		}
	}
 	//销售经理首页
 	public function index(){
		$id=$this->acinfo['ID'];
		$kh=D("kh");
		$sql="SELECT count(kh.ID) as count from wy_ac as ac,wy_kh as kh where FIND_IN_SET(kh.LouPanTitle,ac.Uid) and ac.ID=$id";
		$newsql="SELECT count(kh.ID) as count from wy_ac as ac,wy_kh as kh where FIND_IN_SET(kh.LouPanTitle,ac.Uid) and ac.ID=$id and kh.Stutas=1";
		$countkh=$kh->query($sql);
		$newkh=$kh->query($newsql);
		$this->assign('countkh',$countkh[0]['count']);
		$this->assign('newkh',$newkh[0]['count']);
		$this->assign('ac',$this->acinfo);
		$this->display();
	 }

	 //销售经理注册
	 public function register(){
 	    if($_POST){
			//改成了账号密码登录
			$data['Tel'] = $_POST['Tel'];
			$data['password'] = md5($_POST['password']);
			$data['Token']=$this->token;
			$info = D('ac')->where($data)->find();
			if($info){
				//保存session
				$_SESSION['wecha_id'] = $info['Wecha_id'];
				setcookie("wecha_id",$info['Wecha_id'],time()+30*24*3600);
				$this->redirect(U("SaleManager/index",array("token"=>$info['Token'])));
			}else{
				$this->error("账号密码错误");
			}
            // $data['Name']=trim($_POST['Name']);
            // $data['Tel']=trim($_POST['Tel']);
            // $data['Token']=$_GET['token'];

            // $ac=D("ac")->where($data)->find();
            // //判断是否有注册过
            // if(!$ac){
                // $this->error("请先联系管理员添加账号");
            // }
            // //是否绑定过Wecha_id
            // if($ac && $ac['Wecha_id']){
                // $this->redirect(U("SaleManager/index",array("wecha_id"=>$ac['Wecha_id'],"token"=>$ac['Token'])));
            // }
            // $data['Wecha_id']=$_GET['wecha_id'];
            // $data['ID']=$ac['ID'];
            // $zyarr = D('ac')->save($data);
            // if($zyarr){
                // $this->redirect(U('SaleManager/index',array("wecha_id"=>$data['Wecha_id'],"token"=>$data['Token'])));
            // }else{
                // $this->error("注册失败");
            // }
        }
	 	$this->display();
	 }
	 //获取注册时的所属楼盘
	 public function getlp(){
	 	$token=$_POST['token'];
	 	$lpinfo=D("lpinfo");
	 	$lparr=$lpinfo->where("token='$token'")->select();
	 	if ($lparr) {
	 		echo json_encode($lparr);
	 	}
	 }
	 //销售经理注册处理
	 public function regHandle(){
	 	if($_POST){
	 		//判断邀请码
			$code['token']=$_POST["Token"];
			$code['code']=$_POST['yqm'];
			$code['type']=1;                 //适用类型  0：置业顾问   1：案场经理
			$code['status']=1;               //邀请码状态  0：无效   1：有效
			$code['endtime']=array("gt",time()-3600*24);
			$invitationcode=D("agent_invitationcode")->where($code)->find();
			if($invitationcode==false){
				$this->error("邀请码错误");
			}
	 		$data=D("ac");
	 		$where=array();
	 		$where['Token']=$_POST['Token'];
	 		$where['Wecha_id']=$_POST['Wecha_id'];
	 		//验证是否恶意注册
	 		if($data->where($where)->find()){
	 			$this->redirect(U("SaleManager/index",array("wecha_id"=>$where['Wecha_id'],"token"=>$where['Token'])));
	 		}
	 		$where['Name']=$_POST['Name'];    //销售经理姓名
	 		$where['Tel']=$_POST['Tel'];      //销售经理电话
	 		$where['Uid']=$_POST['Uid'];      //所属楼盘
	 		$where['addTime']=time();         //注册时间
	 		$acarr=$data->add($where);
	 		if($acarr){
	 			//修改邀请码状态
            	// $yqm['userid']=$acarr;
            	// $yqm['status']=1;
            	// $yqm['id']=$invitationcode['id'];
            	// D("agent_invitationcode")->save($yqm);
	 			$this->redirect(U("SaleManager/index",array("wecha_id"=>$where['Wecha_id'],"token"=>$where['Token'])));
	 		}else{
	 			$this->error("注册失败");
	 		}
	 	}else{
	 		$this->redirect(U('SaleManager/register',array("wecha_id"=>$_GET['wecha_id'])));
	 	}
	 }

	 //案场经理信息维护
	 public function acInfo(){
		$ac=D("ac");
		if($_POST){
			$data['ID']=$this->acinfo['ID'];
			if($_POST['password']){
				$data['password']=md5(trim($_POST['password']));
				D("ac")->save($data);
				$this->redirect(U('SaleManager/register',array('token'=>$this->token)));
			}else{
				$this->error('您未修改信息');
			}
		}else{
			//查询楼盘
			$lpinfo=D("lpinfo");
			$lplists=$lpinfo->where(array('token'=>$this->token,'id'=>array('in',$this->acinfo['Uid'])))->select();
			$this->assign("lplists",$lplists);
			$this->assign("acinfo",$this->acinfo);

			$this->display();
		}
	 }

	 //客户信息查看
	 public function custom(){
	 	//chancle 在这边改成了固定的流程status 1：带看（新客户）2：到访 3：成交
		$status = $_GET['status']?intval($_GET['status']):1;
		$this->assign('status',$status);
	 	$kh=D("kh");
	 	$where['Token']=$this->token;
	 	//获取销售经理所属楼盘id
	 	$lpid=$this->acinfo['Uid'];
		
		//搜索条件 电话号码和日期
		if($_REQUEST['Tel'] && !empty($_REQUEST['Tel'])){
			$tel = $_REQUEST['Tel'];
			$where['wy_kh.Tel']=$tel;
			$where1.=" and kh.Tel=$tel";
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
		$listRows = 10;//每页显示数
		$this->assign('page',$page);//当前页码
		$firstRow = ($page-1)*$listRows;
		
		if($status==1){
			$where['Stutas']=1; //新客户
			$where['SrTime'] = array('between',array($starttime,$endtime));
			$where['LouPanTitle'] = array('in',$lpid);
			$list=$kh->where($where)->select();
		}else{
			$where1.=" and kh.Stutas <> 1";//历史客户
			$where1.=" and kh.SrTime >=$starttime and kh.SrTime <$endtime";//历史客户
			//老客户
			$sql="SELECT kh.ID,kh.Token,kh.`Name` as kh_name,kh.Tel,kh.LouPanTitle,
				kh.Stutas,kh.SrTime,zy.`Name` as zy_name,status.salesstatus 
				FROM wy_kh as kh LEFT JOIN wy_zy as zy ON kh.zy_id=zy.ID 
				LEFT JOIN wy_agent_status as status on kh.Stutas=status.id 
				where kh.Token='".$this->token."' AND kh.zy_id > 0 AND kh.LouPanTitle in($lpid)".$where1." 
				ORDER by kh.id desc,status.sort";
			
			$list=$kh->query($sql);
		}
	 	
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
			$this->display();
		}
	 	// $this->assign("lpinfo",$lpinfo);
	 	// $this->assign("newkh",$newkh);
	 	// $this->assign("oldkh",$oldkh);
	 	// $this->display();
	 }
	 
	 //客户状态修改页面
	public function custominfo(){
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
		
		$this->assign("status",$status);
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

	 //置业顾问信息查看
	 public function zhiye(){
	 	$khdb=D("kh");
	 	//获取销售经理所属楼盘id
	 	$lpid=$this->acinfo['Uid'];
	 	//查询有哪些驻场经理
		$zylist = array();
		$zyids = array();//用来记录驻场经理是否重复
		if($lpid){
			$lplists = explode(',',$lpid);
			foreach($lplists as $k=>$v){
				$zy = D('zy')->where(array('Token'=>$this->token,'_string'=>"FIND_IN_SET($v,Uid)"))->find();
				if(!$zy){
					continue;
				}
				$khnum = $khdb->where(array('Token'=>$this->token,'LouPanTitle'=>$v))->count();
				if(in_array($zy['ID'],$zyids)){
					//如果驻场经理已存在
					$zylist[$zy['ID']]['khnum'] += $khnum;
				}else{
					//没有重复
					$zy['khnum'] = $khnum;
					$zylist[$zy['ID']] = $zy;
					$zyids[]=$zy['ID'];
				}
			}
		}
		
	 	$this->assign("zy",$zylist);
	 	$this->display();
	 }

	 //配置是否自动分配
	 public function fpstatus(){
	 	$data['id']=$_POST['lpid'];
	 	$data['token']=$_GET['token'];
	 	$data['fpstatus']=$_POST['fpstatus'];
	 	if(D("lpinfo")->save($data)){
	 		echo $data['fpstatus'];               //修改成功  返回状态
	 	}else{
	 		echo "error";               //修改失败   返回error
	 	}
	 }

	 //客户分配显示页
	 public function fpCustom(){
	 	$where['Token']=$_GET['token'];
	 	$Wecha_id=$_GET['wecha_id'];
	 	$token=$_GET['token'];
	 	//获取销售经理所属楼盘id
	 	$ac=D('ac')->where("Wecha_id='$Wecha_id' and Token='$token'")->find();
	 	$lpid=intval($ac['Uid']);
	 	//查找销售类型为新客户的ID
		$status=D("agent_status")->order("sort")->limit(1)->getField("id");
		$where['Stutas']=intval($status);
	 	//获取未分配客户的信息
	 	$kh=D("kh");
	 	$where['zy_id']=0;
	 	$where['JJ_id']=array("not in","0");
	 	$where['LouPanTitle']=$lpid;
	 	$khinfo=$kh->where($where)->select();
	 	//获取置业顾问即销售顾问的信息
	 	$zyinfo=D('zy')->where(array("Token"=>$_GET['token'],"Uid"=>$lpid))->select();
	 	$this->assign("khinfo",$khinfo);
	 	$this->assign("zyinfo",$zyinfo);
	 	$this->display();
	 }

	 //客户分配处理
	 public function fpHandle(){
	 	$token=$_POST['token'];   //获取toke值
	 	$khid=$_POST['khid'];     //获取客户id
	 	$zyid=$_POST['zyid'];     //获取置业顾问id
	 	$lpinfo=D("lpinfo");
	 	$kharr=explode(",", $khid);
	 	$kh=D("kh");
	 	// $khlength=count($kharr);
	 	$where['ID']  = array('in',$kharr);
	 	$where['Token'] = $token;
	 	$data['zy_id'] = $zyid;
	 	$count=$kh->where($where)->save($data);
	 	if($count){
	 		echo "1";
	 	}else{
	 		echo "0";
	 	}
	 	// $kh->save();
	 	// $lparr=$lpinfo->where("token='$token'")->select();
	 	// if ($lparr) {
	 	// 	echo json_encode($lparr);
	 	// }
	 }

	 //查看佣金
	 public function commission(){
	 	if($_GET){
	 		$token=$_GET['token'];
		 	$wecha_id=$_GET['wecha_id'];
		 	
		 	$ac=D("ac")->where(array("Token"=>$token,"Wecha_id"=>$wecha_id))->field("ID,Uid")->find();
		 	$lpid=$ac['Uid'];      //查询案场经理所在楼盘
		 	//充值明细
		 	$capital=D("capital")->where(array('token'=>$token,'lpid'=>$lpid))->select();
		 	//消费明细
		 	$sql="select jjr.Name,reward.rewardamount,reward.rewardstatus as type 
		 			from wy_agent_rewardinfo as reward , wy_lpinfo as lp , wy_jjr as jjr 
		 			where reward.token='$token' and lp.id=$lpid and lp.LouPanTitle=reward.loupanname 
		 					and reward.token=jjr.token and reward.wecha_id=jjr.Wecha_id and reward.rewardstatus=0  
		 			order by reward.id desc";
		 	$reward=D("agent_rewardinfo")->query($sql);
		 	//积分兑换佣金明细
		 	$sql1="select jjr.Name,xmfx.hasmoney as rewardamount,xmfx.type 
		 			from wy_xmfx as xmfx , wy_jjr as jjr 
		 			where xmfx.token='$token' and xmfx.jid=jjr.ID and uid=$lpid and xmfx.type=1 
		 			order by xmfx.id";
		 	$xmfx=D("xmfx")->query($sql1);
		 	$comm=array_merge($reward,$xmfx);   //整合成一个数组
		 	$this->assign("capital",$capital);
		 	$this->assign("comm",$comm);
		 	$this->display();
		 }else{
		 	$this->error("非法操作");
		 }
	 	
	 }

}


 ?>