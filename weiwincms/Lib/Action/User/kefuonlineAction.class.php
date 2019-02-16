<?php
class KefuonlineAction extends UserAction{
	//配置
	public function index(){
		$kefuonline=M('kefuonline')->where(array('token'=>session('token')))->find();
		if(IS_POST){
			$data['token'] = session('token');
			$data['title'] = $_POST['title'];
			$data['keyword'] = $_POST['keyword'];
			$data['picurl'] = $_POST['picurl'];
			$data['info'] = $_POST['info'];
			$data['info2'] = $_POST['info2'];
			if($kefuonline==false){	
				if($id = M('kefuonline')->add($data)){
					$post['pid']=$id;
					$post['module']='kefuonline';
					$post['token']=session('token');
					$post['keyword']=$_POST['keyword'];
					M('Keyword')->add($post);
					$this->success('添加成功',U('kefuonline/index',array('token'=>session('token'))));
				}else{
					$this->success('添加失败',U('kefuonline/index',array('token'=>session('token'))));
				}				
			}else{
				$where1['id'] = $_POST['id'];
				$where1['token'] = session('token');
				$save = M('kefuonline')->where($where1)->save($data);
				$where2['pid'] = $_POST['id'];
				$where2['token'] = session('token');
				$where2['module'] = 'kefuonline';
				if($save){
					M('Keyword')->where($where2)->save(array('keyword'=>$data['keyword']));
					$this->success('修改成功',U('kefuonline/index',array('token'=>session('token'))));
				}else{
					$this->success('修改失败',U('kefuonline/index',array('token'=>session('token'))));
				}
			}
		}else{
			//dump($kefuonline);
			$this->assign('kefuonline',$kefuonline);
			$this->display();
		}
	}
	
}



?>