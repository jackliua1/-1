<?php
class  Wechat_behaviorAction extends UserAction{
	public $token;
	private $data;
	private $openid;
	//private $data;
	public function _initialize(){
		parent::_initialize();
		$this->openid=$this->_get('openid','htmlspecialchars');
		if($this->openid==false){
			//$this->error('非法操作');
		}
		$this->token=session('token');
		$this->data=D('Behavior');
		
	}
	public function wechatList(){
		$this->modules=$this->_modules();
		$where['openid']=$this->openid;
		$userinfo=M('wechat_group_list')->where($where)->find();
		$this->assign('userinfo',$userinfo);
		$endtime=M('wehcat_member_enddate')->where($where)->find();
		//dump($endtime);
		$this->assign('endtime',$endtime['enddate']);
		$count=$this->data->where($where)->count();
		$page=new Page($count,25);
		$list=$this->data->where($where)->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
		foreach($list as $key=>$vo){
			$list[$key]['behavior']=$this->modules[strtolower($vo['model'])]['name'];
			if (!$list[$key]['behavior']){
				$list[$key]['behavior']='其他';
			}
		}
		//dump($list);
		$this->assign('page',$page->show());
		$this->assign('list',$list);
		$this->assign('type','list');
		$this->display();
	}
	public function statisticsOfSingleFans(){
		$where['openid']=$this->openid;
		$userinfo=M('wechat_group_list')->where($where)->find();
		$this->assign('userinfo',$userinfo);
		$endtime=M('wehcat_member_enddate')->where($where)->find();
		$this->assign('endtime',$endtime['enddate']);
		//
		$this->modules=$this->_modules();
		$openid=$this->openid;
		$where=array('token'=>$this->token);
		if ($openid){
			$where['openid']=$openid;
		}
		$behavior_db=M('Behavior');
		$items=$behavior_db->where($where)->order('num DESC')->select();
		$datas=array();
		if ($items){
			foreach ($items as $item){
				$module=strtolower($item['model']);
				if (key_exists($module,$datas)){
					$datas[$module]++;
				}else {
					$datas[$module]=1;
				}
			}
		}
		asort($datas);
		$xml='<chart borderThickness="0" caption="粉丝行为统计分析" baseFontColor="666666" baseFont="宋体" baseFontSize="14" bgColor="FFFFFF" bgAlpha="0" showBorder="0" bgAngle="360" pieYScale="90"  pieSliceDepth="5" smartLineColor="666666">';
		if ($datas){
			foreach ($datas as $k=>$v){
				$xml.='<set label="'.$this->modules[$k]['name'].'" value="'.$v.'"/>';
			}
		}
		$xml.='</chart>';
		$this->assign('items',$items);
		$this->assign('xml',$xml);
		$this->display('wechatList');
	}
	//客户信息显示
	public function statistics(){
		$kh=D('kh');
        $token=session('token');
        $where=array('Token'=>"$token");
        $count=$kh->where($where)->count();
        $page=new Page($count,20);
        $firstRow=$page->firstRow;
        $listRows=$page->listRows;
        $sql="select kh.ID,kh.Token,kh.Wecha_id,kh.`Name`,kh.Tel,lp.LouPanTitle,jjr.`Name` as jjr_name,zy.Name as zy_name, 
                kh.Stutas,kh.SrTime,kh.yxTime,kh.DcTime,kh.RcTime,kh.RgTime,kh.QyTime,kh.HkTime  
                from wy_kh as kh LEFT JOIN wy_jjr as jjr ON kh.JJ_id=jjr.ID 
                LEFT JOIN wy_lpinfo as lp ON kh.LouPanTitle=lp.id LEFT JOIN wy_zy as zy on kh.zy_id=zy.ID 
                where 1=1 and kh.Token='$token' 
                ORDER BY kh.ID DESC 
                LIMIT $firstRow,$listRows";
        $list=$kh->query($sql);
        $this->assign('page',$page->show());
        $this -> assign('list', $list);
        $this -> display();
	}

	//客户导出
    public function statisticsoutexc(){
        include('ExcelExport.class.php');
        $token=$_GET['token'];
        $language=$_GET['language'];
        $arr[] = array(
                array('val'=>'意向客户', 'align'=>'center','font-size'=>18,'colspan'=>8),
        );
        $arr[] = array(
                array('val'=>'姓名','align'=>'center','width'=>20),
                array('val'=>'电话','align'=>'center','width'=>20),
                array('val'=>'意向楼盘','align'=>'center','width'=>30),
                array('val'=>'状态','align'=>'center','width'=>20),
                array('val'=>'推荐人','align'=>'center','width'=>20),
                array('val'=>'置业顾问','align'=>'center','width'=>20),
                array('val'=>'输入时间','align'=>'center','width'=>30),
                array('val'=>'有效时间','align'=>'center','width'=>30)
                
        );
        $kh=D('kh');
        $sql="select kh.ID,kh.Token,kh.Wecha_id,kh.`Name`,kh.Tel,lp.LouPanTitle,jjr.`Name` as jjr_name,zy.Name as zy_name, 
                kh.Stutas,kh.SrTime,kh.yxTime,kh.DcTime,kh.RcTime,kh.RgTime,kh.QyTime,kh.HkTime  
                from wy_kh as kh LEFT JOIN wy_jjr as jjr ON kh.JJ_id=jjr.ID 
                LEFT JOIN wy_lpinfo as lp ON kh.LouPanTitle=lp.id LEFT JOIN wy_zy as zy on kh.zy_id=zy.ID 
                where 1=1 and kh.Token='$token' 
                ORDER BY kh.ID DESC";
        $ru=$kh->query($sql);
        foreach ($ru as $key => $value) {
            $arr[] = array(
                array('val'=>$value['Name']),
                array('val'=>$value['Tel']),
                array('val'=>$value['LouPanTitle']),
                array('val'=>$value['Stutas']),
                array('val'=>$value['jjr_name']),
                array('val'=>$value['zy_name']),
                array('val'=>date('Y-m-d',$value['SrTime'])),
                array('val'=>$value['yxTime']=='0'?'':date('Y-m-d',$value['yxTime']))
               
            );
        }
        $p=0;
        $excel = new ExcelExport('excel');
        foreach($arr as $val){
            $excel->setCells($val);
        }
        $excel->save();
    }

	//经纪人信息
	public function statisticsTrend(){
		$jjr=D('jjr');
        $where=array('token'=>session('token'));
        $count=$jjr->where($where)->count();
        $page=new Page($count,20);
        $list=$jjr->where($where)->limit($page->firstRow.','.$page->listRows)->order('ID desc')->select();
        $this->assign('page',$page->show());
        $this->assign('list',$list);
        $this -> display();
	}
	//经纪人维护statisticsTrendOfModule
	public function statisticsTrendOfModule(){
		if($_POST){
            $data['Token']=session('token');
            $data['wecha_id']="";
            $data['Name']=trim($_POST['Name']);
            $data['Tel']=trim($_POST['Tel']);
            $data['leibie']=trim($_POST['leibie']);
            $data['YlMoney']=intval(trim($_POST['YlMoney']));
            $data['DueMoney']=intval(trim($_POST['DueMoney']));
            $data['libao']=intval(trim($_POST['libao']));
            $id=$_POST['ID'];
            $data['ID']=$id;
            $jjrarr=D('jjr')->save($data);
            if($jjrarr){
                $this->success("修改成功",U('Wechat_behavior/statisticsTrend',array('token'=>session('token'))));
            }else{
                $this->error("修改失败");
            }
        }else{
        	 $where['ID']=$_GET['id'];
	        $where['Token']=$_GET['token'];
	        $jjr=D("jjr");
	        $list=$jjr->where($where)->find();
	        // echo $jjr->getLastSql();die();
	        $this->assign("list",$list);
	        $this->display();
        }
       
	}
	//删除经纪人
	public function statisticsTrendOfDel(){
		$data=D('jjr');
        $id=$this->_get('id','intval');
        if($id==false) $this->error('非法操作');
        $token=$this->token;
        $back=$data->where(array('Token'=>"$token"))->delete($id);
        if($back==false){
            $this->error('操作失败');
        }else{
            $this->success('操作成功');
        }
	}

	//经纪人导出
    public function statisticsTrendoutexc(){
        include('ExcelExport.class.php');
        $where['Token']=$_GET['token'];
        $language=$_GET['language'];
        $arr[] = array(
                array('val'=>'经纪人', 'align'=>'center','font-size'=>18,'colspan'=>6),
        );
        $arr[] = array(
                array('val'=>'姓名','align'=>'center','width'=>10),
                array('val'=>'电话','align'=>'center','width'=>40),
                array('val'=>'类别','align'=>'center','width'=>40),
                array('val'=>'注册时间','align'=>'center','width'=>40),
                array('val'=>'已领取佣金','align'=>'center','width'=>40),
                array('val'=>'未领取佣金','align'=>'center','width'=>40)
                
        );
        $data=D("jjr");
        $ru=$data->where($where)->order("ID DESC")->select();
        foreach ($ru as $key => $value) {
            $arr[] = array(
                array('val'=>$value['Name']),
                array('val'=>$value['Tel']),
                array('val'=>$value['leibie']),
                array('val'=>date('Y-m-d',$value['Mtime'])),
                array('val'=>$value['YlMoney']),
                array('val'=>$value['DueMoney'])
               
            );
        }
        $p=0;
        $excel = new ExcelExport('excel');
        foreach($arr as $val){
            $excel->setCells($val);
        }
        $excel->save();
    }

	//案场经理信息
	public function statisticsAnchang(){
		$ac=D('ac');
        $token=session('token');
        $where=array('Token'=>"{$token}");
        $count=$ac->where($where)->count();
        $page=new Page($count,20);
        $firstRow=$page->firstRow;
        $listRows=$page->listRows;
        $sql="select ac.ID,ac.Token,ac.Name,ac.Tel,lp.LouPanTitle,ac.addTime 
                from wy_ac as ac,wy_lpinfo as lp 
                where ac.Token='{$token}' and ac.Uid=lp.id 
                order by ac.ID DESC limit {$firstRow},{$listRows}";
        
        $list=$ac->query($sql);
        $this->assign('page',$page->show());
        $this->assign('list',$list);
        $this->display();
	}
	//案场经理维护
	public function statisticsAnchangOfModule(){
		$id=$_GET['id'];
	    if(IS_POST){
	        $arr=array();
	        $arr['ID']=$_POST['ID'];
	        $arr["Token"]=session("token");
	        $arr['Name']=trim($_POST['Name']);
	        $arr['Tel']=trim($_POST['Tel']);
	        $arr['Uid']=intval($_POST['Uid']);
	        $arr['BDTime']=strtotime($_POST['BDTime']);
	        if(D("ac")->save($arr)){
	            $this->success("修改成功",U("Wechat_behavior/statisticsAnchang",array('token'=>session('token'))));
	        }else{
	            $this->error("修改失败");
	        }
	    }else{
	    	$Token=session("token");
		    // $sql="select ac.ID,ac.Token,ac.Name,ac.Tel,lp.LouPanTitle,ac.addTime 
		    //             from wy_ac as ac,wy_lpinfo as lp 
		    //             where ac.Token='{$token}' and ac.Uid=lp.id and ac.ID=$id limit 1";
		    // $list=D("ac")->query($sql);
		    $lp=D("lpinfo")->where("Token='$Token'")->field('ID,LouPanTitle')->order("ID desc")->select();
		    $list=D("ac")->where("Token='$Token'")->find($id);
		    $this->assign("lp",$lp);
		    $this->assign("list",$list);
		    $this->display();
	    }
	    
	}
	//删除案场经理
	public function statisticsAnchangOfDel(){
		$data=D('ac');
        $id=$this->_get('id','intval');
        if($id==false) $this->error('非法操作');
        $token=$this->token;
        $back=$data->where(array('Token'=>"$token"))->delete($id);
        if($back==false){
            $this->error('操作失败');
        }else{
            $this->success('操作成功');
        }
	}

	

	//置业顾问信息
	public function statisticsZhiye(){
		$zy=D('zy');
        $token=session('token');
        $where=array('Token'=>"{$token}");
        $count=$zy->where($where)->count();
        $page=new Page($count,20);
        $firstRow=$page->firstRow;
        $listRows=$page->listRows;
        $sql="select zy.ID,zy.Token,zy.Name,zy.Tel,lp.LouPanTitle,zy.addTime,zy.BDTime 
                from wy_zy as zy,wy_lpinfo as lp 
                where zy.Token='{$token}' and zy.Uid=lp.id 
                order by zy.ID DESC limit {$firstRow},{$listRows}";
        
        $list=$zy->query($sql);
        $this->assign('page',$page->show());
        $this->assign('list',$list);
        $this->display();
	}
	//置业顾问维护
	public function statisticsZhiyeOfModule(){
		 $zy=D('zy');
        if(IS_POST){
            $arr=array();
            $arr['ID']=intval($this->_post("ID"));
            $arr['Name']=trim($this->_post('Name'));
            $arr['Tel']=trim($this->_post('Tel'));
            $arr['BDTime']=strtotime($this->_post('BDTime'));
            $arr['Token']=$this->token;
            if($zy->save($arr)){
                $this->success("修改成功",U("Wechat_zhiye/index",array('token'=>session('token'))));
            }else{
                $this->error("修改失败",U("Wechat_zhiye/edit"));
            }
        }else{
        	$id=intval($_GET['id']);
	        $token=session("token");
	        //显示所有楼盘
	        $lp=D("lpinfo")->where("Token='$token'")->field('ID,LouPanTitle')->order("ID desc")->select();
	        // $sql="select zy.ID,zy.Token,zy.Name,zy.Tel,zy.Uid,lp.LouPanTitle,zy.addTime,zy.BDTime 
	        //         from wy_zy as zy,wy_lpinfo as lp 
	        //         where zy.Token='{$token}' and zy.Uid=lp.id and zy.ID={$id} limit 1";
	        // $list=$zy->query($sql);
	        $list=D("zy")->where("Token='$Token'")->find($id);
	        $this->assign("list",$list);
	        $this->assign("lp",$lp);
	        $this->display();
        }
        
	}
	//删除置业顾问
	public function statisticsZhiyeOfDel(){
		$data=D('zy');
        $id=$this->_get('id','intval');
        if($id==false) $this->error('非法操作');
        $where['Token']=$this->token;
        $back=$data->where($where)->delete($id);
        if($back==false){
            $this->error('删除失败');
        }else{
            $this->success('删除成功');
        }
	}

	//客户信息修改
	public function statisticsOfModule(){
		$kh=D('kh');
        if(IS_POST){
            $arr=array();
            $arr['ID']=intval($this->_post("ID"));
            $arr['Name']=trim($this->_post('Name'));
            $arr['Tel']=trim($this->_post('Tel'));
            $arr['zy_id']=trim($this->_post('zy_id'));
            $arr['Stutas']=trim($this->_post('Stutas'));
            // $arr['addTime']=strtotime($this->_post('addTime'));
            $arr['yxTime']=strtotime($this->_post('yxTime'));
            $arr['Token']=$this->token;
            if($kh->save($arr)){
                $this->success("修改成功",U("Wechat_behavior/statistics",array('token'=>session('token'))));
            }else{
                $this->error("修改失败");
            }
        }else{
        	$id=intval($_GET['id']);
	        $token=session("token");
	        // $sql="select kh.ID,kh.Token,kh.Wecha_id,kh.`Name`,kh.Tel,lp.LouPanTitle,jjr.`Name` as jjr_name,zy.`Name` as zy_name,
	        //         kh.Stutas,kh.SrTime,kh.yxTime,kh.DcTime,kh.RcTime,kh.RgTime,kh.QyTime,kh.HkTime  
	        //         from wy_kh as kh, wy_jjr as jjr,wy_lpinfo as lp,wy_zy as zy 
	        //         where kh.JJ_id=jjr.ID and kh.LouPanTitle=lp.id and kh.zy_id=zy.ID and kh.Token='{$token}' and kh.ID=$id 
	        //         limit 1";
	        // $list=$kh->query($sql);
	        $lp=D("lpinfo")->where("Token='$token'")->field('ID,LouPanTitle')->order("ID desc")->select();
	        $list=D("kh")->where("Token='$token'")->find($id);
	        $jjr=D("jjr")->where("Token='$token'")->field('ID,Name')->order("ID desc")->select();
	        $zy=D("zy")->where("Token='$token'")->field('ID,Name')->order("ID desc")->select();
	        // var_dump($lp);die();
	        $this->assign("lp",$lp);
	        $this->assign("jjr",$jjr);
	        $this->assign("zy",$zy);
	        $this->assign("list",$list);
			$this->display();
        }
        
	}
	//客户信息删除
	public function statisticsOfDel(){
		$data=D('kh');
        $id=$this->_get('id','intval');
        if($id==false) $this->error('非法操作');
        $token=$this->token;
        $back=$data->where(array('Token'=>"$token"))->delete($id);
        if($back==false){
            $this->error('操作失败');
        }else{
            $this->success('操作成功');
        }
	}
    //活动细则
    public function rule(){
        $where['token']=$_GET['token'];
        $rule=D("lp_rule")->where($where)->limit(1)->find();
        if($rule){
            $this->assign("rule",$rule);
        }
        $this->display();
    }
    //活动细则修改
    public function ruleHandle(){
        $rule=D("lp_rule");
        $data['token']=$_GET['token'];
        if($_POST){
            $data['content']=$_POST['content'];
            if($_POST['id']){
                $data['id']=$_POST['id'];
                $list=$rule->save($data);
            }else{
                $list=$rule->add($data);
            }
            if($list){
                $this->success("修改成功",U("Wechat_behavior/rule",array('token'=>session('token'))));
            }else{
                $this->error("修改失败");
            }
        }else{
            $this->error("非法进入");
        }
    }
	private function getModel($model,$type='1'){
		$data['token']=session('token');
		$data['model']=$model;
		if($type==1){
			$data['openid']=$this->openid;
		}
		$sqlArray= $this->data->where($data)->select();
		return count($sqlArray);
		//return $data;
	}
	public function _modules(){
		return array(
		'home'=>array('name'=>'微网站'),
		'text'=>array('name'=>'文本请求','detail'=>1),
		'member_card_set'=>array('name'=>'会员卡'),
		'lottery'=>array('name'=>'推广活动','detail'=>1),
		'help'=>array('name'=>'帮助'),
		'wedding'=>array('name'=>'婚庆喜帖','detail'=>1),
		'img'=>array('name'=>'图文消息','detail'=>1),
		'selfform'=>array('name'=>'万能表单','detail'=>1),
		'host'=>array('name'=>'通用订单','detail'=>1),
		'panorama'=>array('name'=>'全景','detail'=>1),
		'usernamecheck'=>array('name'=>'账号审核'),
		'album'=>array('name'=>'相册'),
		'vote'=>array('name'=>'投票','detail'=>1),
		'product'=>array('name'=>'商城','detail'=>1),
		'voiceresponse'=>array('name'=>'语音消息'),
		'estate'=>array('name'=>'房产'),
		'follow'=>array('name'=>'关注'),
		);
	}
	public function modelName($str){
		$array=array(
			'3G微网站'=>'3G微网站',
			'Lottery'=>'1',
			'Member_card_set'=>'会员卡',
			'Wedding'=>'喜帖',
			'Img'=>'图文信息',
			'帮助'=>'帮助提示',
			'Selfform'=>'万能表单功能',
			'Text'=>'文本信息',
			'Host'=>'订单信息',
			'帐号审核'=>'帐号审核',
			'3g相册'=>'帐号审核',
			'Vote'=>'投票活动',
			'Product'=>'电商产品',
		);
		return $array[$str];
	}

    //楼盘销售状态列表
    public function salesstatus(){
        $token=$this->token;
        $where['token']=$token;
        $status=D('agent_status');
        $count=$status->where($where)->count();
        $page=new Page($count,20);
        $list=$status->where($where)->limit($page->firstRow.','.$page->listRows)->order('sort ASC')->select();
        $this->assign('page',$page->show());
        $this->assign('list',$list);
        $this->display();
    }
    //新增楼盘销售状态
    public function salesstatusadd(){
        $token=$this->token;
        if($_POST){
            $data['token']=$token;
            $data['salesstatus']=trim($_POST['salesstatus']);
            $data['statusinstr']=trim($_POST['statusinstr']);
            $data['sort']=intval($_POST['sort']);
            if(D('agent_status')->add($data)){
                $this->success("添加成功",U('Wechat_behavior/salesstatus',array('token'=>$token)));
            }else{
                $this->error("添加失败");
            }
        }else{
            $this->display();
        }
    }
    //修改楼盘销售状态
    public function salestatusOfModule(){
        $token=$this->token;
        $status=D('agent_status');
        $where['id']=intval($_GET['id']);
        $where['token']=$token;
        if($_POST){
            $where['salesstatus']=trim($_POST['salesstatus']);
            $where['statusinstr']=trim($_POST['statusinstr']);
            $where['sort']=intval($_POST['sort']);
            if($status->save($where)){
                $this->success("修改成功",U('Wechat_behavior/salesstatus',array('token'=>$token)));
            }else{
                $this->error("修改失败");
            }
        }else{
            $status=$status->where($where)->find();
            $this->assign('status',$status);
            $this->display();
        }
    }
    //删除楼盘销售状态
    public function salestatusOfDel(){
        $token=$this->token;
        $status=D('agent_status');
        if($_GET){
            $where['token']=$token;
            $id=intval($_GET['id']);
            if($status->where($where)->delete($id)){
                $this->success("删除成功",U('Wechat_behavior/salesstatus',array('token'=>$token)));
            }else{
                $this->error("删除失败");
            }
        }else{
            $this->error("非法操作");
        }
    }

    //奖励类型列表
    public function rewardparam(){
        $token=$this->token;
        $where['token']=$token;
        $reward=D('reward_param');
        $count=$reward->where($where)->count();
        $page=new Page($count,20);
        $list=$reward->where($where)->limit($page->firstRow.','.$page->listRows)->order('ID ASC')->select();
        $this->assign('page',$page->show());
        $this->assign('list',$list);
        $this->display();
    }
    //新增奖励类型
    public function rewardparamadd(){
        $token=$this->token;
        if($_POST){
            $data['token']=$token;
            $data['rewardname']=trim($_POST['rewardname']);
            $data['rewardparam']=intval(($_POST['rewardparam']));
            $data['rewardamount']=intval(($_POST['rewardamount']));
            $data['paraminstr']=trim($_POST['paraminstr']);
            if(D('reward_param')->add($data)){
                $this->success("添加成功",U('Wechat_behavior/rewardparam',array('token'=>$token)));
            }else{
                $this->error("添加失败");
            }
        }else{
            $this->display();
        }
    }
    //修改奖励类型
    public function rewardparamOfModule(){
        $token=$this->token;
        $reward=D('reward_param');
        $where['id']=intval($_GET['id']);
        $where['token']=$token;
        if($_POST){
            $where['rewardname']=trim($_POST['rewardname']);
            $where['rewardparam']=intval(($_POST['rewardparam']));
            $where['rewardamount']=intval(($_POST['rewardamount']));
            $where['paraminstr']=trim($_POST['paraminstr']);
            if($reward->save($where)){
                $this->success("修改成功",U('Wechat_behavior/rewardparam',array('token'=>$token)));
            }else{
                $this->error("修改失败11111");
            }
        }else{
            $reward=$reward->where($where)->find();
            $this->assign('reward',$reward);
            $this->display();
        }
    }
    //删除奖励类型
    public function rewardparamOfDel(){
        $token=$this->token;
        $reward=D('reward_param');
        if($_GET){
            $where['token']=$token;
            $id=intval($_GET['id']);
            if($reward->where($where)->delete($id)){
                $this->success("删除成功",U('Wechat_behavior/rewardparam',array('token'=>$token)));
            }else{
                $this->error("删除失败");
            }
        }else{
            $this->error("非法操作");
        }
    }

    //楼盘奖励列表
    public function rewardinfo(){
        $token=$this->token;
        $where['token']=$token;
        $reward=D('reward_info');
        $count=$reward->where($where)->count();
        $page=new Page($count,20);
        $firstRow=$page->firstRow;
        $listRows=$page->listRows;
        // $list=$reward->where($where)->limit($page->firstRow.','.$page->listRows)->order('ID ASC')->select();
        $sql="SELECT info.id as infoid,info.token,lpinfo.id as lpid, lpinfo.LouPanTitle, 
                `status`.id as staid,`status`.salesstatus,param.id as parid, param.rewardname 
                from wy_reward_info as info , wy_lpinfo as lpinfo , wy_agent_status as status , wy_reward_param as param 
                where info.loupanid=lpinfo.id and info.rewardid=param.id AND info.statusid=`status`.id 
                limit $firstRow,$listRows";
        $list=$reward->query($sql);
        $this->assign('page',$page->show());
        $this->assign('list',$list);
        $this->display();
    }
    //新增楼盘奖励
    public function rewardinfoadd(){
        $token=$this->token;
        if($_POST){
            $data['token']=$token;
            $data['loupanid']=intval(($_POST['loupanid']));
            $data['statusid']=intval(($_POST['statusid']));
            $data['rewardid']=intval(($_POST['rewardid']));
            if(D('reward_info')->add($data)){
                $this->success("添加成功",U('Wechat_behavior/rewardinfo',array('token'=>$token)));
            }else{
                $this->error("添加失败");
            }
        }else{
            //显示楼盘名称
            $lpinfo=D("lpinfo");
            $lp=$lpinfo->where(array('token'=>"$token"))->field('id,LouPanTitle')->order("id DESC")->select();
            //显示销售状态
            $status=D("agent_status");
            $sta=$status->where(array('token'=>"$token"))->order("sort")->limit(1,6)->select();
            //显示奖励类型
            $reward=D("reward_param");
            $rew=$reward->where(array('token'=>"$token"))->order("id ASC")->select();
            $this->assign("lp",$lp);
            $this->assign("sta",$sta);
            $this->assign("rew",$rew);
            $this->display();
        }
    }
    //修改楼盘奖励
    public function rewardinfoOfModule(){
        $token=$this->token;
        $reward=D('reward_info');
        $where['id']=intval($_GET['id']);
        $where['token']=$token;
        if($_POST){
            $where['loupanid']=intval(($_POST['loupanid']));
            $where['statusid']=intval(($_POST['statusid']));
            $where['rewardid']=intval(($_POST['rewardid']));
            if($reward->save($where)){
                $this->success("修改成功",U('Wechat_behavior/rewardinfo',array('token'=>$token)));
            }else{
                $this->error("修改失败");
            }
        }else{
            //显示楼盘名称
            $lpinfo=D("lpinfo");
            $lp=$lpinfo->where(array('token'=>"$token"))->field('id,LouPanTitle')->order("id DESC")->select();
            //显示销售状态
            $status=D("agent_status");
            $sta=$status->where(array('token'=>"$token"))->order("id ASC")->select();
            //显示奖励类型
            $rewardparam=D("reward_param");
            $rew=$rewardparam->where(array('token'=>"$token"))->order("id ASC")->select();
            //显示楼盘奖励
            $list=$reward->where($where)->find();
            // echo $reward->getLastSql();die();
            $this->assign("lp",$lp);
            $this->assign("sta",$sta);
            $this->assign("rew",$rew);
            $this->assign("list",$list);
            $this->display();
    }
}
    //删除楼盘奖励
    public function rewardinfoOfDel(){
        $token=$this->token;
        $reward=D('reward_info');
        if($_GET){
            $where['token']=$token;
            $id=intval($_GET['id']);
            if($reward->where($where)->delete($id)){
                $this->success("删除成功",U('Wechat_behavior/rewardinfo',array('token'=>$token)));
            }else{
                $this->error("删除失败");
            }
        }else{
            $this->error("非法操作");
        }
    }

    //经纪人类型列表
    public function agenttype(){
        $token=$this->token;
        $where['token']=$token;
        $type=D('agent_type');
        $count=$type->where($where)->count();
        $page=new Page($count,20);
        $list=$type->where($where)->limit($page->firstRow.','.$page->listRows)->order('sort')->select();
        $this->assign('page',$page->show());
        $this->assign('list',$list);
        $this->display();
    }
    //新增经纪人类型
    public function agenttypeadd(){
        $token=$this->token;
        if($_POST){
            $data['token']=$token;
            $data['typename']=trim($_POST['typename']);
            $data['iscompany']=intval(($_POST['iscompany']));
            $data['sort']=intval(($_POST['sort']));
            if(D('agent_type')->add($data)){
                $this->success("添加成功",U('Wechat_behavior/agenttype',array('token'=>$token)));
            }else{
                $this->error("添加失败");
            }
        }else{
            $this->display();
        }
    }
    //修改经纪人类型
    public function agenttypeOfModule(){
        $token=$this->token;
        $type=D('agent_type');
        $where['id']=intval($_GET['id']);
        $where['token']=$token;
        if($_POST){
            $where['typename']=trim($_POST['typename']);
            $where['iscompany']=intval(($_POST['iscompany']));
            $where['sort']=intval(($_POST['sort']));
            if($type->save($where)){
                $this->success("修改成功",U('Wechat_behavior/agenttype',array('token'=>$token)));
            }else{
                $this->error("修改失败");
            }
        }else{
            $list=$type->where($where)->find();
            $this->assign('list',$list);
            $this->display();
        }
    }
    //删除经纪人类型
    public function agenttypeOfDel(){
        $token=$this->token;
        $reward=D('agent_type');
        if($_GET){
            $where['token']=$token;
            $id=intval($_GET['id']);
            if($reward->where($where)->delete($id)){
                $this->success("删除成功",U('Wechat_behavior/agenttype',array('token'=>$token)));
            }else{
                $this->error("删除失败");
            }
        }else{
            $this->error("非法操作");
        }
    }

    //邀请码列表页
    public function invitationcode(){
        $token=$this->token;             //token
        $sql="select code.id,code.token,code.code,code.type,lpinfo.LouPanTitle,code.status,code.endtime 
                from wy_lpinfo as lpinfo , wy_agent_invitationcode as code 
                where lpinfo.id=code.lpid and code.token='$token'";
        $data=D("agent_invitationcode")->query($sql);
        $this->assign("list",$data);
        $this->display();
    }

    //邀请码新增页
    public function invitationcodeadd(){
        $where['token']=$this->token;             //token
        //查看楼盘信息
        $lpinfo=D("lpinfo")->where($where)->select();
        if($_POST){
            //查看已存在邀请码
            $code=D("agent_invitationcode");
            $where['lpid']=$_POST['lpid'];
            $where['type']=$_POST['type'];
            $where['status']=1;
            $where['endtime']=array("gt",time());
            if($code->where($where)->find()){
                // echo $code->getLastSql();die();
               $this->error("该楼盘已存在有效邀请码"); 
            }

            $data['token']=$where['token'];          //token
            $data['lpid']=$_POST['lpid'];            //楼盘ID
            $data['type']=$_POST['type'];            //适用类型
            $data['code']=$_POST['code'];            //邀请码
            $data['status']=$_POST['status'];        //是否有效
            $data['endtime']=strtotime($_POST['endtime']);        //是否有效
            if($code->add($data)){
                $this->success("生成成功",U('Wechat_behavior/invitationcode',array('token'=>$where['token'])));
            }else{
                $this->error("生成失败");
            }
        }else{
            $this->assign("lpinfo",$lpinfo);
           $this->display(); 
        }
        
    }

    //编辑邀请码
    public function invitationcodeedit(){
        $where['token']=$this->token;             //token
        //查看楼盘信息
        $lpinfo=D("lpinfo")->where($where)->select();
        $code=D("agent_invitationcode");
        if($_POST){
            //查看已存在邀请码
            $id=intval($_POST['id']);
            $where['lpid']=$_POST['lpid'];
            $where['type']=$_POST['type'];
            $where['status']=1;
            $where['endtime']=array("gt",time());
            $where['id']=array("not in","$id");
            if($code->where($where)->find()){
                echo $code->getLastSql();die();
               $this->error("该楼盘已存在有效邀请码"); 
            }
            $data['id']=$id;
            // $data['token']=$where['token'];          //token
            $data['lpid']=$_POST['lpid'];            //楼盘ID
            $data['type']=$_POST['type'];            //适用类型
            $data['code']=$_POST['code'];            //邀请码
            $data['status']=$_POST['status'];        //是否有效
            $data['endtime']=strtotime($_POST['endtime']);        //是否有效
            if($code->save($data)){
                $this->success("修改成功",U('Wechat_behavior/invitationcode',array('token'=>$where['token'])));
            }else{
                $this->error("修改失败");
            }
        }else{
            $where['id']=$_GET['id'];
            $list=$code->where($where)->find();
            // var_dump($code->getLastSql());
            // var_dump($list);die();
            $this->assign("list",$list);
            $this->assign("lpinfo",$lpinfo);
           $this->display(); 
        }
    }

    //删除邀请码
    public function invitationcodedel(){
        $id=intval($_GET['id']);
        $token=$_GET['token'];
        $code=D("agent_invitationcode")->where("id=$id and token='$token'")->delete();
        if($code){
            $this->success("删除成功",U('Wechat_behavior/invitationcode',array('token'=>$token)));
        }else{
            $this->error("删除失败");
        }
    }

    //生成邀请码
    public function code_start($type,$endtime){
        $where['token']=$this->token;             //token
        $where['status']=1;                      //使用状态  0：未使用   1：已使用
        $where['endtime']=array("gt",time());    //有效期大于当前时间


        $data=M('agent_invitationcode')->where($where)->select();
        $flag=true;
        $i=0;
        $len=count($data);
            //去重
        $randStr = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
        $rand = substr($randStr,0,6);
        while ($flag){
        $b=$data[$i++]['code'];
            if($b==$rand){
                $randStr = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
                $rand =substr($randStr,0,6);
                $i=0;
            }
            if($i>=$len){$flag=false;}
        }
        //存数据库
        $end['code']=$rand;
        $end['token']=$where['token'];
        $end['type']=$type;
        $end['status']=0;
        $end['endtime']=$endtime;
        if(M('agent_invitationcode')->add($end)){
            $this->success("生成邀请码成功",U('Wechat_behavior/invitationcode',array('token'=>$where['token'])));
        }else{
            $this->error("生成邀请码失败");
        }
        
        return true;
    }

    //首页分享
    public function shareindex(){
        $token=session("token");
        $info=D("share_content")->where("token='$token'")->find();
        if($_POST){
            $data['sharetitle']=$_POST['sharetitle'];
            $data['shareimg']=$_POST['shareimg'];
            $data['sharecontent']=$_POST['sharecontent'];
            if($info){
                $data['id']=$info['id'];
                $mes=D("share_content")->save($data);
            }else{
                $data['token']=$token;
                $mes=D("share_content")->add($data);
            }
            if($mes){
                $this->success("保存成功",U('Wechat_behavior/shareindex',array('token'=>$token)));
            }else{
                $this->error("保存失败");
            }
        }else{
            
            $this->assign("info",$info);
            $this->display();
        }
    }

	
}

?>