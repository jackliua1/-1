<?php 

/**
* 预约客户的维护Action
*/
class CustomAction extends BaseAction{
	public function _initialize(){
		parent::_initialize();
		$this->token=session('token');
		
	}
	//达人首页列表
	public function index(){
		$expert_custominfo=D('expert_custominfo');
		$token=$this->token;

		$count=$expert_custominfo->where("token='$token'")->count();
		$page=new Page($count,25);
		$firstRow=$page->firstRow;
		$listRows=$page->listRows;
		$sql="select ec.id,ec.token,ec.sid,ec.customname,ec.customphone,sl.sharename,lp.LouPanTitle 
				from wy_expert_custominfo as ec, wy_share_list as sl, wy_lpinfo as lp 
				where ec.token='$token' and ec.sid=sl.id and ec.loupanid=lp.id 
				order by ec.id desc limit $firstRow,$listRows";
		// $list=$expert_custominfo->where($where)->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
		$list=$expert_custominfo->query($sql);
		$this->assign("list",$list);
		$this->assign('page',$page->show());
		$this->display();
	}
	//编辑达人信息显示页
	public function edit(){
		$id=$this->_get('id','intval');
		$token=$this->token;
		$sql="select ec.id,ec.token,ec.sid,ec.customname,ec.customphone,sl.sharename,lp.LouPanTitle 
				from wy_expert_custominfo as ec, wy_share_list as sl, wy_lpinfo as lp 
				where ec.token='$token' and ec.sid=sl.id and ec.loupanid=lp.id and ec.id=$id";
		$res=D('expert_custominfo')->query($sql);

		$this->assign('info',$res[0]);
		$this->assign('id',$this->_get('id','intval'));
		$this->display();
	}

	//删除操作
	public function del(){
		$where['id']=$this->_get('id','intval');
		$where['token']=$this->token;
		if(D('expert_custominfo')->where($where)->delete()){
			$this->success('操作成功',U('Custom/index',array('token'=>$this->token)));
		}else{
			$this->error('操作失败');
		}
	}
	
	//保存操作
	public function upsave(){
		$expert_custominfo=D('expert_custominfo');
		$id=$this->_post('id','intval');
		$arr=array();
		$arr['customname']=trim($this->_post('customname'));
		$arr['customphone']=trim($this->_post('customphone'));
		$info=$expert_custominfo->where(array('id'=>$id))->save($arr);
		if($info){
			$this->success('修改成功',U('Custom/index',array('token'=>$this->token)));
		}else{
			$this->error("修改失败");
		}
	}

}

 ?>