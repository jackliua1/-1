<?php
/**
 *语音回复
**/
class JiedianAction extends UserAction{
	public function index(){
		$id=$this->_get('id','intval');
		$db=D('Jiedian');
		$where['token']=session('token');
		$where['cid']=$id;
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->order('sorts desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('id',$id);
		$this->assign('info',$info);
		$this->display();
	}
	
	public function add(){
		$this->display();
	}
	
	public function edit(){
		$id=$this->_get('id','intval');
		$info=M('Jiedian')->find($id);
		$this->assign('info',$info);
		$this->display();
	}
	
	public function del(){
		$where['id']=$this->_get('id','intval');
		$cid=$_GET['cid'];
		$where['uid']=session('uid');
		if(D(MODULE_NAME)->where($where)->delete()){
			$this->success('操作成功',U(MODULE_NAME.'/index?id='.$cid));
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/index?id='.$cid));
		}
	}
	public function insert(){
		$cid=$_POST['cid'];
		$this->all_insert('Jiedian','/index?id='.$cid);
	}
	public function upsave(){
		//$where['cid']=$_GET['cid'];
		//$where['token']=session('token');
	//	$where['name']=$_GET['name'];
	//	$where['info']=$_GET['info'];
	//	$where['img']=$_GET['img'];
	//	$where['url']=$_GET['url'];
	//	$where['sorts']=$this->_get('sorts');
	//	$where['status']=$this->_get('status');
	//	$db=D('Jiedian');
	//  if($db->save()){
	//		$this->success('操作成功',U(MODULE_NAME.'/index'));
	//	}else{
	//		$this->error('操作失败',U(MODULE_NAME.'/index'));
	//	}
		$cid=$_GET['cid'];
			$this->save('Jiedian','/index?id='.$cid);
	}
}
?>