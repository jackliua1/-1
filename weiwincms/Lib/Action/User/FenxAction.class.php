<?php 
/**
* 活动分享/达人介绍
*/
class FenxAction extends BaseAction
{
	
	public function _initialize(){
		parent::_initialize();
		$this->token=session('token');
		// $this->data=D('Behavior');
		
	}

	public function index(){
		$share_introduce=D('share_introduce');
		$where['token']=$this->token;
		$info=$share_introduce->where($where)->find();
		if($info){
			$this->assign("info",$info);
		}
		$this->display();
		
	}
	//保存操作
	public function upsave(){
		$arr=array();
		
		$share_introduce=D('share_introduce');
		$id=$this->_post('id','intval');
		$arr['aboutexpert']=rtrim($this->_post('aboutexpert'));
		$arr['howexpert']=rtrim($this->_post('howexpert'));
		if($id){
			$where['id']=$id;
			$where['token']=$this->token;
			$share_introduce->where($where)->save($arr);
		}else{
			$arr['token']=$this->token;
			$share_introduce->add($arr);
		}
		$this->success('操作成功',U(MODULE_NAME.'/index',array('token'=>$this->token)));
	}
}


 ?>