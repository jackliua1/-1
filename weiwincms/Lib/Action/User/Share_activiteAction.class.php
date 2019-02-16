<?php 

/**
* 分享活动的Action
*/
class Share_activiteAction extends BaseAction{
	public function _initialize(){
		parent::_initialize();
		$this->token=session('token');
		// $this->data=D('Behavior');
		
	}
	
	public function index(){
		$share_list=D('share_list');
		$where['token']=$this->token;

		$count=$share_list->where($where)->count();
		$page=new Page($count,25);
		$list=$share_list->where($where)->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
		
		//查询楼盘
		$lparr=D("lpinfo")->where($where)->select();

		//创建当前时间戳
		$time=time();
		$endtime=time()-24*3600;
		$this->assign("list",$list);
		$this->assign('page',$page->show());
		$this->assign("lparr",$lparr);
		$this->assign("time",$time);
		$this->assign("endtime",$endtime);
		$this->display();
	}

	//新增分享活动显示页
	public function add(){
		//查询楼盘信息
		$lpinfo=D("lpinfo");
		$where['token']=$this->token;
		$lparr=$lpinfo->where($where)->select();

		$tip=$this->tip;
		$this->assign('tip',$tip);
		$this->assign('lparr',$lparr);
		$this->display();
	}
	//编辑分享活动显示页
	public function edit(){
		//查询楼盘信息
		$lpinfo=D("lpinfo");
		$lparr=$lpinfo->where(array('token'=>$this->token))->select();

		$where['id']=$this->_get('id','intval');
		$where['token']=$this->token;
		$res=D('share_list')->where($where)->find();

		$this->assign('info',$res);
		$this->assign('lparr',$lparr);
		$this->assign('id',$this->_get('id','intval'));
		$this->display();
	}

	//删除操作
	public function del(){
		$where['id']=$this->_get('id','intval');
		$where['token']=$this->token;
		if(D('share_list')->where($where)->delete()){
			$this->success('操作成功',U(MODULE_NAME.'/index',array('token'=>$this->token)));
		}else{
			$this->error('操作失败');
		}
	}
	//新增操作
	public function insert(){
		if(!$_POST){
			$this->error('非法操作');
		}
		$share_list=D('share_list');
		$arr=array();
		$arr['token']=$this->token;
		$arr['sharename']=trim($this->_post('sharename'));
		$arr['loupanid']=intval($this->_post('loupanid'));
		$arr['shareloge']=trim($this->_post('shareloge'));
		$arr['starttime']=strtotime($this->_post('starttime'));
		$arr['endtime']=strtotime($this->_post('endtime'));
		$arr['sharerule']=trim($this->_post('sharerule'));
		$arr['sharereward']=trim($this->_post('sharereward'));
		$arr['rewardrule']=intval($this->_post('rewardrule'));
		$arr['rewardnum']=intval($this->_post('rewardnum'));
		$arr['rewardnums']=intval($this->_post('rewardnum'));
		$arr['sharecontent']=trim($this->_post('sharecontent'));
		$arr['lpinfo']=trim($this->_post('lpinfo'));
		if($share_list->add($arr)){
			$this->success('操作成功',U(MODULE_NAME.'/index',array('token'=>$this->token)));
		}else{
			$this->error('操作失败');
		}

	}
	//保存操作
	public function upsave(){
		$share_list=D('share_list');
		$id=$this->_post('id','intval');
		$arr=array();
		$arr['sharename']=trim($this->_post('sharename'));
		$arr['loupanid']=intval($this->_post('loupanid'));
		$arr['shareloge']=trim($this->_post('shareloge'));
		$arr['starttime']=strtotime($this->_post('starttime'));
		$arr['endtime']=strtotime($this->_post('endtime'));
		$arr['sharerule']=trim($this->_post('sharerule'));
		$arr['sharereward']=trim($this->_post('sharereward'));
		$arr['rewardrule']=intval($this->_post('rewardrule'));
		$arr['rewardnum']=intval($this->_post('rewardnum'));
		$arr['sharecontent']=trim($this->_post('sharecontent'));
		$arr['lpinfo']=trim($this->_post('lpinfo'));
		$share_list->where(array('id'=>$id))->save($arr);
		$this->success('操作成功',U(MODULE_NAME.'/index',array('token'=>$this->token)));
	}

}

 ?>