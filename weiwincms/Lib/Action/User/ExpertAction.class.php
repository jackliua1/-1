<?php 

/**
* 达人维护的Action
*/
class ExpertAction extends BaseAction{
	public function _initialize(){
		parent::_initialize();
		$this->token=session('token');
		// $this->data=D('Behavior');
		
	}
	//达人首页列表
	public function index(){
		$expert_info=D('expert_info');
		$where['token']=$this->token;

		$count=$expert_info->where($where)->count();
		$page=new Page($count,25);
		$list=$expert_info->where($where)->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
		$this->assign("list",$list);
		$this->assign('page',$page->show());
		$this->display();
	}
	//编辑达人信息显示页
	public function edit(){
		$where['id']=$this->_get('id','intval');
		$where['token']=$this->token;
		$res=D('expert_info')->where($where)->find();

		$this->assign('info',$res);
		$this->assign('id',$this->_get('id','intval'));
		$this->display();
	}

	//删除操作
	public function del(){
		$where['id']=$this->_get('id','intval');
		$where['token']=$this->token;
		if(D('expert_info')->where($where)->delete()){
			$this->success('操作成功',U('Expert/index',array('token'=>$this->token)));
		}else{
			$this->error('操作失败');
		}
	}
	
	//保存操作
	public function upsave(){
		$expert_info=D('expert_info');
		$id=$this->_post('id','intval');
		$arr=array();
		$arr['expertname']=trim($this->_post('expertname'));
		$arr['expertphone']=trim($this->_post('expertphone'));
		$info=$expert_info->where(array('id'=>$id))->save($arr);
		if($info){
			$this->success('操作成功',U('Expert/index',array('token'=>$this->token)));
		}else{
			$this->error("修改失败");
		}
		
	}

	//达人参与互动
	public function index1(){
		$expert_share=D("expert_share");
		$token=$this->token;
		$count=$expert_share->where("token='$token'")->count();
		$page=new Page($count,25);
		$firstRow=$page->firstRow;
		$listRows=$page->listRows;
		$sql="select es.id as id,es.token,es.hasreward,sl.id as sid,
				sl.sharename,ei.id as eid,ei.expertname,ei.expertphone,es.lqreward 
				from wy_expert_share as es, wy_share_list as sl, wy_expert_info as ei 
				where es.token='$token' and es.sid=sl.id and es.eid=ei.id 
				order by es.id desc limit $firstRow,$listRows";
		$list=$expert_share->query($sql);
		$this->assign("list",$list);
		$this->assign("page",$page->show());
		$this->display();
	}
	//显示修改界面
	public function edites(){
		$expert_share=D("expert_share");
		$id=intval($_GET['id']);
		$token=$this->token;
		$sql="select es.id as id,es.token,es.hasreward,sl.id as sid,
				sl.sharename,ei.id as eid,ei.expertname,ei.expertphone,es.lqreward 
				from wy_expert_share as es, wy_share_list as sl, wy_expert_info as ei 
				where es.token='$token' and es.sid=sl.id and es.eid=ei.id and es.id=$id";
		$list=$expert_share->query($sql);
		$this->assign("info",$list[0]);
		$this->display();
	}

	//修改领取数量
	public function upsavees(){
		$expert_share=D("expert_share");
		$data['id']=intval($_POST['id']);
		$data['lqreward']=intval($_POST['lqreward']);
		if($expert_share->save($data)){
			$this->success('操作成功',U('Expert/index1',array('token'=>$this->token)));
		}else{
			$this->error("修改失败");
		}

	}

	//删除关注活动
	public function deles(){
		$where['id']=$this->_get('id','intval');
		$where['token']=$this->token;
		if(D('expert_share')->where($where)->delete()){
			$this->success('操作成功',U('Expert/index',array('token'=>$this->token)));
		}else{
			$this->error('操作失败');
		}

	}

}

 ?>