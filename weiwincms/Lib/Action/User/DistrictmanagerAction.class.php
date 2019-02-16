<?php
class DistrictmanagerAction extends UserAction{
    public $tokenWhere;
    public function _initialize(){
        parent :: _initialize();
        $this -> canUseFunction('share');
        $this -> tokenWhere = array('token' => $this -> token);
    }
//片区经理列表
    public function index(){
        $where['Token']=$_GET['token'];

        $data=D('areas');
        $count= $data->where($where)->order('ID desc' )->count();

        $page=new Page($count,20);
        $list = $data->where($where)->limit($page->firstRow.','.$page->listRows)->order('ID desc' )
           ->select();

        $this->assign('page',$page->show());
        $this->assign('list',$list);

        $this->display();
    }

//删除
    public function del(){
        $data=D('areas');
        $id=$this->_get('ID','intval');
        if($id==false) $this->error('非法操作');
        $token=$this->token;
        $back=$data->where(array('Token'=>"$token"))->delete($id);
        if($back==false){
            $this->error('操作失败');
        }else{
            $this->success('操作成功');
        }
    }



    //添加片区经理
    public function addAgent(){
        $wheres['ID']=$_GET['ID'];
//        $wheres['ID']=$_GET['ID'];
        $dates=D('areas');
       $lists= $dates->where($wheres)->find();
        $this->assign('lists',$lists);
        $where['Token']=$_GET['token'];
        $data=D('brokerage');
        $list=$data->where($where)->select();
         $this->assign('list',$list);
        $this->display();
    }
    //处理片区经理
    public function add(){

        if($_POST){
            $where['areaName']=$_POST['areaName'];
            $where['areaTel']=$_POST['areaTel'];
			if($_POST['areaTel']){
				$where['Wecha_id']=md5($_POST['areaTel']);
			}
			if($_POST['password']){
				$where['password']=md5($_POST['password']);
			}
            $where['areaTime']=time();
            
            $where['Token']=$this->token;

            $data=D('areas'); //片区经理表

            //判断是否添加过片区经理

            if($data->where(array('areaTel'=>$where['areaTel'],'areaName'=>$where['areaName'],'Token'=>$this->token))->find()==null){
                $cid=  $data->add($where);

            }else{
                $this->error('片区经理已存在');
            }


			if($cid){
				$this->success('操作成功',U('Districtmanager/index',array('token'=>$this->token)));
			}else{
				$this->error('操作失败');
			}

        }


    }
    //修改页面
    public function update(){
        $wheres['ID']=$_GET['ID'];
        $dates=D('areas');
        $lists= $dates->where($wheres)->find();
        $this->assign('lists',$lists);
//        $where['Token']=$_GET['token'];
//        $data=D('brokerage');
//        $list=$data->where($where)->select();
//        $this->assign('list',$list);
        $this->display();

    }
    //修改信息
    public function updates(){
        if($_POST) {
            $where['Token']=$_GET['token'];
            $where['ID']=$_POST['ID'];
            $where['areaName'] = $_POST['areaName'];
            $where['areaTel'] = $_POST['areaTel'];
            if($_POST['areaTel']){
				$where['Wecha_id']=md5($_POST['areaTel']);
			}
			if($_POST['password']){
				$where['password']=md5($_POST['password']);
			}
            
            $data = D('areas');
			//获取当前用户信息
			$info = $data->where(array('areaTel'=>$where['areaTel'],'areaName'=>$where['areaName'],'Token'=>$this->token))->find();
			if($_POST['ID'] != $info['ID']){
				$this->error('手机号变更后用户已存在');
			}
            $cid = $data->save($where);
            if ($cid) {
                $this->success('修改成功', U('Districtmanager/index',array('token' => $this -> token)));
            } else {
                $this->error('操作失败');
            }
        }

    }
}