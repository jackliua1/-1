<?php
/**
 *首页幻灯片回复
**/
class FlashAction extends UserAction{
	public $tip;
	public function _initialize(){
		parent::_initialize();
		if (isset($_GET['tip'])){
			$this->tip=$this->_get('tip','intval');
		}else {
			$this->tip=1;
		}
		$this->assign('tip',$this->tip);
	}
	public function index(){
		$db=D('Flash');
		//查询楼盘信息 本来应该要连表查询的
		$lpinfo=D("lpinfo");
		$lparr=$lpinfo->where(array('token'=>$this->token))->select();

		//tip区分是幻灯片还是背景图
		$tip=$this->tip;

		$where['uid']=session('uid');
		$where['token']=session('token');
		$where['tip']=$tip;
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->limit($page->firstRow.','.$page->listRows)->order('sort asc')->select();
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		$this->assign('tip',$tip);
		$this->assign('lparr',$lparr);
		$this->display();
	}
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
	public function edit(){
		//查询楼盘信息
		$lpinfo=D("lpinfo");
		$lparr=$lpinfo->where(array('token'=>$this->token))->select();

		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		$res=D('Flash')->where($where)->find();
		$this->assign('info',$res);

		$tip=$this->tip;
		$this->assign('tip',$tip);
		$this->assign('lparr',$lparr);
		$this->assign('id',$this->_get('id','intval'));
		$this->display();
	}
	public function del(){
		$tip=$this->tip;
		$where['id']=$this->_get('id','intval');
		$where['token']=$this->token;
		if(D(MODULE_NAME)->where($where)->delete()){
			$this->success('操作成功',U(MODULE_NAME.'/index',array('tip'=>$tip)));
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/index',array('tip'=>$tip)));
		}
	}
	public function insert(){
		$flash=D('Flash');
		$arr=array();
		$arr['token']=$this->token;
		$arr['img']=$this->_post('img');
		$arr['url']=$this->_post('url');
		$arr['info']=$this->_post('info');
		$arr['sort']=$this->_post('sort');
		$arr['lpid']=$this->_post('lpid');  //关联的楼盘id
		$arr['tip']=$this->tip;
		$flash->add($arr);
		$this->success('操作成功',U(MODULE_NAME.'/index',array('tip'=>$this->tip)));

		//$this->all_insert('Flash');
	}
	public function upsave(){
		$flash=D('Flash');
		$id=$this->_get('id','intval');
		$tip=$this->tip;
		$arr=array();
		$arr['img']=$this->_post('img');
		$arr['url']=$this->_post('url');
		$arr['info']=$this->_post('info');
		$arr['sort']=$this->_post('sort');
		$arr['lpid']=$this->_post('lpid');
		$flash->where(array('id'=>$id))->save($arr);
		$this->success('操作成功',U(MODULE_NAME.'/index',array('tip'=>$this->tip)));
	}

}
?>