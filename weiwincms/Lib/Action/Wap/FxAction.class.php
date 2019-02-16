<?php 

/**
* 微信界面达人活动控制器
*/
class FxAction extends BaseAction{

	private $token;
	private $wecha_id;
	public function _initialize() {
		parent::_initialize();
		$this->token    = filter_var($this->_get('token'),FILTER_SANITIZE_STRING);
		$this->wecha_id = filter_var($this->_get('wecha_id'),FILTER_SANITIZE_STRING);
		if(!isset($_GET['wecha_id'])){
			// $this->error('请通过微信浏览器访问~！');
		}
	}
	//达人活动显示页
	public function index(){
		$where['token']=$this->token;
		$wecha_id=$this->wecha_id;
		$where['starttime']=array("elt",time());
		$share_list=D("share_list");
		$endtime=time()-24*3600;
		$list=$share_list->where($where)->order("endtime desc,id desc")->select();
		$this->assign("list",$list);
		$this->assign("endtime",$endtime);
		$this->display();
	}

	//达人注册显示页
	public function register(){
		//查询是否是经纪人
		$where['Token']=$this->token;
		$where['Wecha_id']=$this->wecha_id;
		$jjr=D("jjr");
		$jjrinfo=$jjr->where($where)->find();
		if($jjrinfo){
			$this->assign("jjrinfo",$jjrinfo);
		}
		$this->display();
		
	}
	//达人注册处理
	public function insert(){
		$data['token']=$this->token;
		$data['wecha_id']=$this->wecha_id;
		$data['expertname']=trim($_POST['expertname']);
		$data['expertphone']=trim($_POST['expertphone']);
		//存入数据库
		$expert_info=D("expert_info");
		if($expert_info->add($data)){
			$this->redirect(U('Fx/expertinfo',array('token'=>$this->token,'wecha_id'=>$this->wecha_id)));
		}else{
			$this->error("注册失败");
		}
	}

	//我的活动显示页
	public function myactivite(){
		$this->isexpert();
		$where['token']=$this->token;
		$where['wecha_id']=$this->wecha_id;
		//查询出我在达人信息表中的id
		$eid=D("expert_info")->where($where)->field('id')->find();
		$eid=intval($eid['id']);
		$share_list=D("share_list");
		$sql="select sl.id,sl.endtime,sl.starttime,sl.token,sl.loupanid,
					sl.sharename,sl.shareloge,sl.sharereward,sl.rewardrule,
					sl.rewardnum,sl.rewardnums,es.hasreward 
				from wy_expert_share as es , wy_share_list as sl 
				WHERE es.sid=sl.id AND es.wecha_id='$this->wecha_id' 
				AND es.token='$this->token' AND es.eid=$eid  
				order by sl.endtime desc,sl.id desc";
		$list=$share_list->query($sql);
		
		//查询达人发起的浏览的人数
		$sql1="select count(id) as viewcount,sid from 
				wy_expert_custominfo 
				where token='$this->token' and wecha_id='$this->wecha_id' 
				group by sid";
		$customview=$share_list->query($sql1);
		foreach ($list as $key => $value) {
			foreach ($customview as $k => $v) {
				if($value['id']==$v['sid']){
					$list[$key]["viewcount"]=$customview[$k]['viewcount'];
				}
			}
			
		}
		//查询每个参与活动的人数
		$sql2="select count(id) as addcount,sid from 
				wy_expert_custominfo 
				where token='$this->token' and wecha_id='$this->wecha_id' 
				and customname is not null and customphone is not null 
				group by sid";
		$custom=$share_list->query($sql2);
		foreach ($list as $key => $value) {
			foreach ($custom as $k => $v) {
				if($value['id']==$v['sid']){
					$list[$key]["addcount"]=$custom[$k]['addcount'];
				}
			}
			
		}
		$endtime=time()-24*3600;

		$this->assign("list",$list);
		$this->assign("endtime",$endtime);
		$this->display();
	}

	//查看某个活动的规则
	public function activiterule(){
		$where['token']=$this->token;
		// $where['wecha_id']=$this->wecha_id;
		$where['id']=intval($_GET['id']);
		$share_list=D("share_list");
		$info=$share_list->where($where)->find();
		$this->assign("info",$info);
		$this->display();
	}

	//某个活动的首界面
	public function activiteindex(){
		//传递过来的参数信息
		$state=$_GET['state'];
		$arr=array();
		$arr=explode(",", $state);
		$wecha_id=$arr[0];             //分享人wecha_id
		$token=$arr[1];               //分享公众号的token
		$sid=intval($arr[2]);         //分享人参与的活动id
		$esid=intval($arr[3]);
		//对分享信息的处理
		$code=$_GET['code'];
		$wxuser=$this->haveinfo($token);
		$appid = $wxuser['appid'];
		$secret = $wxuser['appsecret'];
		$get_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
		$abc=$this->getToken($get_token_url);

		$json=json_decode($abc);
		if(is_object($json)){
			$json=(array)$json;
		}
		$customwecha_id=$json['openid'];     //当前浏览人wecha_id
		//每一个浏览的人都保存下记录对于同一个达人分享的活动只保留一次
		$expert_custominfo=D("expert_custominfo");
		$data['wecha_id']=$wecha_id;
		$data['token']=$token;
		$data['sid']=$sid;
		$data['customwecha_id']=$customwecha_id;
		$customid=$expert_custominfo->where($data)->getField("id");
		if(!$customid){
			$data['viewtime']=time();
			$customid=$expert_custominfo->add($data);
			//查询需要多少的浏览量才会赠送礼品
			$share_list=D("share_list")->where("token='$token' and id=$sid")->find();
			$rewardnum=$share_list['rewardnum'];           //总奖品数
			$rewardnums=$share_list['rewardnums'];         //当前剩余奖品数
			$rewardrule=$share_list['rewardrule'];         //浏览多少次才可获得奖品

			//查询此人当前的总浏览量
			$customview=D("expert_custominfo")->where("token='$token' and wecha_id='$wecha_id' and sid=$sid")->count("id");
			if($customview%$rewardrule==0){
				$num=array();
				if($rewardnums>=1){
					$num['rewardnums']=$rewardnums-1;
					//将修改后的rewardnums(剩余奖品数量)存入数据库
					D("share_list")->where("token='$token' and id=$sid")->save($num);
					//达人分享中间表奖品数量+1
					D("expert_share")->where("id=$esid")->setInc("hasreward");
				}
				
			}
		}

		//统计参与人数
		$sql="select count(a.id) as count from 
				(select id from wy_expert_custominfo 
					where token='$token' and sid=$sid group by customwecha_id) as a";
		// $countview=$expert_custominfo->where("token='$token' and sid=$sid")->distinct("customwecha_id")->getField("count(id)");
		$count=$expert_custominfo->query($sql);
		$countview=intval($count[0]['count']);
		$where['token']=$token;
		$where['wecha_id']=$wecha_id;		
		$share_list=D("share_list");
		$where['id']=$sid;
		$info=$share_list->where($where)->find();
		//查出所有楼房
		$lparr=D("lpinfo")->where("token='$token'")->field("id,LouPanTitle")->select();


		$this->assign("info",$info);
		$this->assign("lparr",$lparr);
		$this->assign("wecha_id",$wecha_id);
		$this->assign("esid",$esid);
		$this->assign("countview",$countview);
		$this->assign("customwecha_id",$customwecha_id);
		$this->display();
	}

	//处理分享链接
	public function activiteindexs(){
		//某达人参与的活动id
		$esid=$_GET['esid'];
		$expert_share=D("expert_share");
		$esinfo=$expert_share->where("id=$esid")->find();

		$wecha_id=$esinfo['wecha_id'];    //分享人的wecha_id
		$token=$esinfo['token'];          //分享活动的token
		$sid=intval($esinfo['sid']);    //达人参与活动的id
		$wxuser=$this->haveinfo($token);
		$appid = $wxuser['appid'];
		$secret = $wxuser['appsecret'];

		$action=$wecha_id.",".$token.",".$sid.",".$esid;     //将分享人的wecha_id和分享活动的id作为参数传递
		$uri=urlencode("http://weixin.yx4h.com/index.php?g=Wap&m=Fx&a=activiteindex");
		header("Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$uri&response_type=code&scope=snsapi_base&state=$action#wechat_redirect");

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

	//规则详情
	public function ruleinfo(){
		$where['token']=$this->token;
		// $where['wecha_id']=$this->wecha_id;
		$where['id']=intval($_GET['id']);
		$share_list=D("share_list");
		$info=$share_list->where($where)->field("id,sharecontent")->find();
		$this->assign("info",$info);
		$this->assign("esid",intval($_GET['esid']));
		$this->display();
	}
	

	//活动楼盘的详情-----即进入活动页面
	public function activiteinfo(){
		
		$esid=intval($_GET['esid']);
		$customwecha_id=$_GET['customwecha_id'];
		$expert_share=D("expert_share");
		$esinfo=$expert_share->where("id=$esid")->find();
		$token=$esinfo['token'];
		$sid=intval($esinfo['sid']);
		//查看活动信息
		// $info=D("share_list")->where($where)->find();
		$sql="select sl.id,sl.token,sl.lpinfo,sl.loupanid,lp.LouPanTitle from wy_share_list as sl , wy_lpinfo as lp 
						where sl.loupanid=lp.id and sl.token='$token' and sl.id=$sid";
		$info=D("share_list")->query($sql);
		$this->assign("info",$info[0]);
		$this->assign("esid",$esid);
		$this->assign("customwecha_id",$customwecha_id);
		$this->display();
	}


	//进入个人中心界面
	public function expertinfo(){
		$where['token']=$this->token;
		$where['wecha_id']=$this->wecha_id;
		$this->isexpert();
		$expert_info=D("expert_info");
		$info=$expert_info->where($where)->find();
		$this->assign("info",$info);
		$this->display();
	}
	//了解达人
	public function expert(){
		$where['token']=$this->token;
		$info=D("share_introduce")->where($where)->find();
		$this->assign("info",$info);
		$this->display();
	}
	//如何玩转分享达人
	public function howexpert(){
		$where['token']=$this->token;
		$info=D("share_introduce")->where($where)->find();
		$this->assign("info",$info);
		$this->display();
	}

	//判断是否是达人
	public function isexpert(){
		$where['token']=$this->token;
		$where['wecha_id']=$this->wecha_id;
		$expert_info=D("expert_info");
		if(!$expert_info->where($where)->find()){
			$this->redirect(U('Fx/register',array('token'=>$this->token,'wecha_id'=>$this->wecha_id)));
			exit();
		}
	}

	//新增我的活动
	public function addmyactivite(){
		//判断是否是达人
		$this->isexpert();
		//判断改活动是否在我的活动中
		$where['token']=$this->token;
		$where['wecha_id']=$this->wecha_id;
		//查询出达人id
		$eid=D("expert_info")->where($where)->field('id')->find();
		$where['eid']=intval($eid['id']);
		$where['sid']=intval($_GET['id']);
		
		$expert_share=D("expert_share");
		//如果不在我的活动中则添加
		$esinfo=$expert_share->where($where)->find();
		if(!$esinfo){
			$esid=$expert_share->add($where);
		}else{
			$esid=$esinfo['id'];
		}
		$this->redirect(U('Fx/activiteindexs',array('esid'=>$esid)));
	}

	//保存预约人信息
	public function addcustom(){
		//接收传递过来的值
		$lpid=intval($_POST['lpid']);   //楼盘id
		$customname=trim($_POST['customname']);   //预约人姓名
		$customphone=trim($_POST['customphone']);   //预约人电话
		// $customid=intval($_POST['customid']);        //预约对应的达人分享id
		$esid=intval($_POST['esid']);
		$customwecha_id=$_POST['customwecha_id'];
		$expert_share=D("expert_share");
		$esinfo=$expert_share->where("id=$esid")->find();
		$token=$esinfo['token'];           //活动的token
		$sid=intval($esinfo['sid']);               //活动的id
		$wecha_id=$esinfo['wecha_id'];    //分享人wecha_id
		//判断如果客户已提交过信息则提示已提交
		$expert_custominfo=D("expert_custominfo");
		$sql="select id from wy_expert_custominfo 
				where token='$token' and wecha_id='$wecha_id' and sid=$sid and customwecha_id='$customwecha_id' 
				and customname is not null and customphone is not null";
		$custominfo=$expert_custominfo->query($sql);
		if($custominfo){
			$this->error("该微信号已参加过此活动");
		}else{
			$data['customname']=$customname;
			$data['customphone']=$customphone;
			$data['loupanid']=$lpid;
			$where['token']=$token;
			$where['sid']=$sid;
			$where['wecha_id']=$wecha_id;
			$where['customwecha_id']=$customwecha_id;
			$expert_custominfo->where($where)->save($data);
			// $this->redirect("预约成功",U("Fx/activiteinfo"));
			$this->redirect(U("Fx/activiteinfo",array("esid"=>$esid,"customwecha_id"=>$customwecha_id)));
		}
	}

	//显示我的客户
	public function mycustom(){
		$token=$_GET['token'];
		$wecha_id=$_GET['wecha_id'];
		$expert_custominfo=D("expert_custominfo");
		//计算我的总客户
		$sql="select count(id) as count 
				from wy_expert_custominfo 
				where token='$token' and wecha_id='$wecha_id' 
				and customname is not null and customphone is not null";
		$count=$expert_custominfo->query($sql);
		$count=intval($count[0]['count']);
		$sql1="select ec.id,ec.token,ec.wecha_id,ec.sid,ec.customwecha_id,
					ec.customname,ec.customphone,sl.sharename  
					from wy_expert_custominfo as ec,wy_share_list as sl 
					where ec.token='$token' and ec.wecha_id='$wecha_id' 
					and ec.customname is not null and ec.customphone is not null and ec.sid=sl.id 
					order by id desc";
		$list=$expert_custominfo->query($sql1);
		$this->assign("count",$count);
		$this->assign("list",$list);
		$this->display();
	}

	//获取appid和secret
	public function haveinfo($token){
		$where['token']=$token;
		$wxuser=D("wxuser")->where($where)->field("appid,appsecret")->find();
		return $wxuser;
	}
}

 ?>