<?php
/**
邮箱设置
**/
class EmailAction extends UserAction{
	public $token;
	
	public function _initialize() {
		parent::_initialize();
		

		$this->assign('token',$this->_get('token','htmlspecialchars'));
	}
	public function index(){
		$set=M('email_set')->where(array('token'=>$this->_get('token'),'uid'=>session('uid')))->find();
		$db=M('email_set');

		if(IS_POST){
			$_POST['uid']=SESSION('uid');
			$_POST['token']=SESSION('token');
			if($set==false){
				if ($db->create() === false) {
					$this->error($db->getError());
				} else {
					$id = $db->add();
					if ($id == true) {
						$this->success('操作成功', U('Email/index',array('token'=>$this->_get('token'))));
					} else {
						$this->error('操作失败', U('Email/index',array('token'=>$this->_get('token'))));
					}
				}
			}else{

				$_POST['id']=$set['id'];
				if ($db->create() === false) {
					$this->error($db->getError());
				} else {
					$id = $db->save();
					if ($id == true) {
						$this->success('操作成功',  U('Email/index',array('token'=>$this->_get('token'))));
					} else {
						$this->error('操作失败',  U('Email/index',array('token'=>$this->_get('token'))));
					}
				}	
			}
		}else{

			$this->assign('set',$set);
			$this->display();
		}
	}
	//测试发送邮件
	public function send(){

		$set=M('email_set')->where(array('token'=>$this->_get('token'),'uid'=>session('uid')))->find();
		
		if(!$set['status']){
			$this->error('请先开启功能！',U('Email/index',array('token'=>$this->_get('token'))));
		}
		

		$re = $this->Send_email($set['emails'],"这是测试邮件","这是测试邮件内容", "赛维微信团队");

		if($re){
			$this->success('邮件发送成功',U('Email/index',array('token'=>$this->_get('token'))));
		}else{
			$this->error('邮件发送失败',U('Email/index',array('token'=>$this->_get('token'))));
		}
	}
	

}
?>