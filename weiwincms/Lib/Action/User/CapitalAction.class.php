<?php
/**
 * @置业顾问操作模块
 */
class CapitalAction extends UserAction{
    public $token;
    private $data;
    private $openid;
    public function _initialize(){
        parent :: _initialize();
        $this -> openid = $this -> _get('openid', 'htmlspecialchars');
        if($this -> openid == false){
        }
        $this -> token = session('token');
        $this -> data = D('Service_user');
    }
    //佣金充值列表页
    public function index(){
		$token=$this->token;
		$capital=D('Capital');
		//查询总条数
		$s="select count(a.id) as count from (select id from wy_Capital where token='$token' group by lpid) as a";
		// $count=$capital->where("token='$token'")->group("lpid")->count();
		$count=$capital->query($s);
		$count=intval($count[0]['count']);
        $page=new Page($count,20);
        $firstRow=$page->firstRow;
        $listRows=$page->listRows;
        //查询项目佣金总额列表
		$sql="select cap.token,cap.id as capid,cap.money,lp.id as lpid,lp.LouPanTitle,sum(cap.money) as allmoney 
					from wy_Capital as cap,wy_lpinfo as lp 
					where cap.token='$token' and cap.token=lp.token and cap.lpid=lp.id 
					group by cap.lpid 
					order by cap.id desc limit $firstRow,$listRows";
		$list=$capital->query($sql);
		//查询每个项目应发佣金
		// $rewardinfo=D("agent_rewardinfo")->field("loupanname,sum(rewardamount) as rewardamount")->where("token='$token' and rewardstatus=1")->group("loupanname")->select();
		$rewardinfo=D("agent_rewardinfo")->field("loupanname,sum(rewardamount) as rewardamount")->where("token='$token' and rewardstatus in (0)")->group("loupanname")->select();
		//查询每个项目通过分享获取积分可兑换的佣金
		$sql1="select xmfx.token,lp.id as lpid,lp.LouPanTitle,sum(xmfx.hasmoney) as allhasmoney 
				from wy_xmfx as xmfx , wy_lpinfo as lp 
				where xmfx.token='$token' and xmfx.token=lp.token and xmfx.uid=lp.id and type=1 
				group by xmfx.uid";
		$xmfx=D("xmfx")->query($sql1);
		//减去应发佣金的部分
		foreach($list as $key=>$val){
			foreach($rewardinfo as $k=>$v){
				if($val['LouPanTitle']==$v['loupanname']){
					$list[$key]['rewardamount']=$v['rewardamount'];  //应发佣金总额
					$list[$key]['residue']=$list[$key]['allmoney']-$v['rewardamount']; //剩余佣金
				}
			}
			if(!isset($list[$key]['rewardamount'])){
				$list[$key]['rewardamount']=0;
				$list[$key]['residue']=$list[$key]['allmoney'];
			}
		}
		// 减去积分兑换佣金的部分
		foreach($list as $key=>$val){
			foreach($xmfx as $k=>$v){
				if($val['LouPanTitle']==$v['LouPanTitle']){
					$list[$key]['rewardamount']+=$v['allhasmoney'];    //应发佣金总额
					$list[$key]['rewardamount']=round($list[$key]['rewardamount'],2);
					$list[$key]['residue']-=$v['allhasmoney'];       //剩余佣金
					$list[$key]['residue']=round($list[$key]['residue'],2);
				}
			}
		}
		$this->assign("list",$list);
		$this->assign('page',$page->show());
        $this->display();
    }
    //佣金充值页
	public function addmoney(){
	$token=$this->token;
		if($_POST){
			$data['token']=$token;
			$data['lpid']=intval($_POST['lpid']);
			$data['money']=intval($_POST['money']);
			$data['createtime']=time();
			if(D('Capital')->add($data)){
				$this->success("充值成功",U("Capital/index",array("token"=>$token)));
			}else{
				$this->error("充值失败");
			}
		}else{
			//查询所有项目
			$lp=D('lpinfo')->where("token='$token'")->order('id desc')->select();
			$this->assign('lp',$lp);
			$this->display();
		}
		
	}
    
	//佣金充值明细
	public function detailmoney(){
		$lpid=intval($_GET['lpid']);
		$token=$this->token;
		$capital=D('Capital');
		//总条数
		$count=$capital->where("token='$token' and lpid=$lpid")->count();
        $page=new Page($count,20);
        $firstRow=$page->firstRow;
        $listRows=$page->listRows;
		//明细
		$sql="select cap.id,cap.lpid,lp.LouPanTitle,cap.money,cap.createtime 
				from wy_Capital as cap, wy_lpinfo as lp 
				where cap.token='$token' and cap.lpid=lp.id and cap.lpid=$lpid 
				order by cap.id desc limit $firstRow,$listRows";
		// $list=$capital->where($where)->select();
		$list=$capital->query($sql);
		$this->assign("list",$list);
		$this->assign('page',$page->show());
		$this->display();
	}

}
?>