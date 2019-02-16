<?php
//片区经理模块
class ManagerAction extends WapAction{
    public $token;
    public $wecha_id;
	public $areasinfo;

    public function _initialize() {
        parent::_initialize();
        $this->token    = filter_var($this->_get('token'),FILTER_SANITIZE_STRING);
        $this->wecha_id = filter_var($this->_get('wecha_id'),FILTER_SANITIZE_STRING);

		$nocheck = array('register');
		if(ACTION_NAME == 'register'){
			//如果到了注册页先清空wecha_id
			$this->wecha_id = '';
			unset($_SESSION['wecha_id']);
			setcookie("wecha_id","",time()-20);
		}
		if(!$this->wecha_id && !in_array(ACTION_NAME,$nocheck)){
			$this->redirect(U('Manager/register',array('token'=>$_GET['token'])));
		}
		if($this->wecha_id){
			//查询wecha_id是否存在
			$this->areasinfo = D("areas")->where(array('Token'=>$this->token,'Wecha_id'=>$this->wecha_id))->find();
			if(!$this->areasinfo){
				$this->redirect(U('Manager/register',array('token'=>$this->token)));
			}
		}

    }
    public function register(){
        if($_POST){
			//改成了账号密码登录
			$data['areaTel'] = $_POST['Tel'];
			$data['password'] = md5($_POST['password']);
			$data['Token']=$this->token;
			$info = D('areas')->where($data)->find();
			if($info){
				//保存session
				$_SESSION['wecha_id'] = $info['Wecha_id'];
				setcookie("wecha_id",$info['Wecha_id'],time()+30*24*3600);
				$this->redirect(U("Manager/ydl",array("token"=>$info['Token'])));
			}else{
				$this->error("账号密码错误");
			}
		}else{
			$this->display();
		}

    }
    //片区经理首页
	public function ydl(){
		$this->assign('date',$this->areasinfo);
		$this->display();
	}
	
	//显示和修改置业顾问信息
	public function myinfo(){
		$areas=D("areas");
		if($_POST){
			$data['ID']=$_POST['id'];
			if($_POST['password']){
				$data['password']=md5(trim($_POST['password']));
				$areas->save($data);
				$this->redirect(U('Manager/register',array('token'=>$this->token)));
			}else{
				$this->error('您未修改信息');
			}
		}else{
			//查询楼盘
			//$lpinfo=D("lpinfo");
			//$lplists=$lpinfo->where(array('token'=>$this->token,'id'=>array('in',$zyinfo['Uid'])))->select();
			//$this->assign("lplists",$lplists);
			$this->assign("areasinfo",$this->areasinfo);

			$this->display();
			
		}
	}
		
        //客户列表
        public function myCustom(){
            $status = $_GET['status']?intval($_GET['status']):1;
			$this->assign('status',$status);
			
			$where['wy_brokerage.areas_ID']=intval($this->areasinfo['ID']);
			$where['kh.Stutas']=$status;
			//查询新客户信息
			$where['wy_brokerage.Token']=$this->token;
			
			//搜索条件 电话号码和日期
			if($_REQUEST['Tel'] && !empty($_REQUEST['Tel'])){
				$tel = $_REQUEST['Tel'];
				$where['kh.Tel']=$tel;
				$this->assign('Tel',$tel);
			}
			$endtime = time();//结束时间设定为当前时间
			$starttime = 0;//全部
			if($_REQUEST['times'] && !empty($_REQUEST['times'])){
				switch($_REQUEST['times']){
					case 1:
						$starttime = strtotime(date('Y-m-d', strtotime('-1 week')));//一星期内
						break;
					case 2:
						$starttime = strtotime(date('Y-m-d', strtotime('-1 month')));//一个月内
						break;
					case 3:
						$starttime = strtotime(date('Y-m-d', strtotime('-1 year')));//一年内
						break;
					default:
						$starttime = 0;//全部
						break;
				}
				$times = $_REQUEST['times'];
				$this->assign('times',$times);
			}
			$page = $_GET['page']?intval($_GET['page']):1;
			$listRows = 12;//每页显示数
			$this->assign('page',$page);//当前页码
			$firstRow = ($page-1)*$listRows;
			
			if($status == 1){
				$where['kh.SrTime']=array('between',array($starttime,$endtime));
				$order = "kh.SrTime desc";
			}elseif($status == 2){
				$where['kh.DcTime']=array('between',array($starttime,$endtime));
				$order = "kh.DcTime desc";
			}elseif($status == 3){
				$where['kh.QyTime']=array('between',array($starttime,$endtime));
				$order = "kh.QyTime desc";
			}
			
			$list=D("brokerage")->join('left join wy_jjr as jjr on wy_brokerage.id=jjr.brokerage_id')
			->join('left join wy_kh as kh on jjr.ID=kh.JJ_id')
			->join('left join wy_lpinfo as lp on kh.LouPanTitle=lp.id')
			->join('left join wy_zy as zy on kh.zy_id=zy.ID')
			->field('kh.*,jjr.Name as jjrname,zy.Name as zyname,lp.LouPanTitle as lpname')
			->where($where)->limit($firstRow,$listRows)->order($order)->select();
			
			if(!$list){
				$list = array();
			}
			//如果是新用户需要隐藏手机号中间四位
			if($list){
				foreach($list as $k=>$v){
					if($v['Stutas'] == 1){
						$list[$k]['Tel'] = substr_replace($v['Tel'], '****', 3, 4);
						$list[$k]['showtime'] = date('Y-m-d',$list[$k]['SrTime']);
					}elseif($v['Stutas'] == 2){
						$list[$k]['Tel'] = substr_replace($v['Tel'], '****', 3, 4);
						$list[$k]['showtime'] = date('Y-m-d',$list[$k]['DcTime']);
					}else{
						$list[$k]['showtime'] = date('Y-m-d',$list[$k]['QyTime']);
					}
				}
			}
			
			if($_GET['is_ajax']){
				//如果是ajax请求
				$this->ajaxReturn($list,$page,1);
			}else{
				$this->assign("list",$list);
				$this->display();
			}
        }
		
		public function custominfo(){
			$id=$_GET['id'];
	        $sql="select kh.*,kh.Name as khname,kh.Tel as khtel,kh.LouPanTitle as lpid,
	        		jjr.Name as jjrname,jjr.brokerage_id,jjr.Tel as jjrtel,kh.DcTime,kh.RcTime,
	        		kh.RgTime,kh.QyTime,kh.HkTime,zy.Name as zyname,zy.Tel as zyTel,lp.LouPanTitle  
	        		from wy_kh as kh left join wy_jjr as jjr on kh.JJ_id=jjr.ID 
					left join wy_zy as zy on kh.zy_id=zy.ID 
					left join wy_lpinfo as lp on lp.id=kh.LouPanTitle 
	        		where kh.Token='$this->token' and kh.ID=$id ";
	        $kh=D("kh")->query($sql);
			
	        if($kh==null){
	        	$this->error('非法操作');
	        }
			//var_dump($kh);die;
			if($kh[0]['brokerage_id']){
				//查询经纪人所在公司
				$kh[0]['zjgs'] = D('brokerage')->where(array('Token'=>$this->token,'id'=>$kh[0]['brokerage_id']))->getField('usersname');
			}
			
	        $status=intval($kh[0]['Stutas']);
			//新客户隐藏电话
			if($status <= 2){
				$kh[0]['khtel'] = substr_replace($kh[0]['khtel'], '****', 3, 4);
			}
	        $this->assign("status",$status);
	        //$this->assign("wxstatus",$wxstatus);
	        $this->assign("kh",$kh[0]);
	        $this->assign("sort",intval($sort));
			$this->display();
		}
		
		//chancle 修改后全变成了这个 客户状态修改处理
		public function custommodify(){
			if($_POST){
				$dbkh = D("kh");
				$data = $_POST;
				$data['ID'] = $khid = intval($_POST['id']);//客户id
				
				//实收金额
				$qyje1 = sprintf("%.2f", $data['qyje1']);
				$qyje2 = sprintf("%.2f", $data['qyje2']);
				$zfk = $qyje1+$qyje2;
				$data['zfk'] = sprintf("%.2f", $zfk);//总付款
				
				if($dbkh->save($data)){
					$this->success('修改成功',U('Manager/myCustom',array('token'=>$this->token,'status'=>3)));
				}else{
					$this->error("修改失败");
				}
			}
		}
        //经纪人
        public function jingji(){
			//查询新客户信息
			$where['jjr.Token']=$this->token;
			
			//搜索条件 电话号码和日期
			if($_REQUEST['Tel'] && !empty($_REQUEST['Tel'])){
				$tel = $_REQUEST['Tel'];
				$where['jjr.Tel']=$tel;
				$this->assign('Tel',$tel);
			}
			
			$page = $_GET['page']?intval($_GET['page']):1;
			$listRows = 20;//每页显示数
			$this->assign('page',$page);//当前页码
			$firstRow = ($page-1)*$listRows;
			
			$where['wy_brokerage.areas_ID'] = $this->areasinfo['ID'];
			$list=D("brokerage")->join('left join wy_jjr as jjr on wy_brokerage.id=jjr.brokerage_id')
			->field('jjr.*,wy_brokerage.usersname')
			->where($where)->limit($firstRow,$listRows)->order('id desc')->select();
			
			if(!$list){
				$list = array();
			}
			foreach($list as $k=>$v){
				$list[$k]['Mtime'] = date('Y-m-d',$v['Mtime']);
			}
			
			if($_GET['is_ajax']){
				//如果是ajax请求
				$this->ajaxReturn($list,$page,1);
			}else{
				$this->assign("list",$list);
				$this->display();
			}

        }
        //客户到访
        public function daofang(){

            $where=$_GET['wecha_id'];

//            $token=$_GET['token'];
            $xmfx=D('jjr');
            $sql="SELECT
a.ID,
a.areaName,
a.areaTel,
b.id,
b.usersname,
b.tel,
b.address,
b.areas_ID,
j.Mtime,
k.`Name`,
k.Tel,
j.ID,
k.SrTime
FROM
wy_areas AS a
INNER JOIN wy_brokerage AS b ON a.ID = b.areas_ID
INNER JOIN wy_jjr AS j ON b.id = j.brokerage_id
INNER JOIN wy_kh AS k ON j.ID = k.JJ_id
WHERE
a.Wecha_id = $where AND
k.Stutas = 3
ORDER BY
j.ID DESC";
            $list=$xmfx->query($sql);
            $this->assign('list',$list);
                $this->display();
        }
        //签约
        public function Contract(){
            $where=$_GET['wecha_id'];

//            $token=$_GET['token'];
            $xmfx=D('jjr');
            $sql="SELECT
a.ID,
a.areaName,
a.areaTel,
b.id,
b.usersname,
b.tel,
b.address,
b.areas_ID,
j.Mtime,
k.`Name`,
k.Tel,
j.ID,
k.SrTime
FROM
wy_areas AS a
INNER JOIN wy_brokerage AS b ON a.ID = b.areas_ID
INNER JOIN wy_jjr AS j ON b.id = j.brokerage_id
INNER JOIN wy_kh AS k ON j.ID = k.JJ_id
WHERE
a.Wecha_id = $where AND
k.Stutas = 8
ORDER BY
j.ID DESC";
            $list=$xmfx->query($sql);
            $this->assign('list',$list);
            $this->display();
        }
        //客户报名列表根据手机号查询
        public function myCustoms(){
            if($_POST){
                $where=$_GET['wecha_id'];
                $tel=$_POST['Tel'];
                if($tel==null){
                    $this->error('请输入手机号');
                }
                $sql="SELECT
a.ID,
a.areaName,
a.areaTel,
b.id,
b.usersname,
b.tel,
b.address,
b.areas_ID,
j.Mtime,
k.`Name`,
k.Tel,
j.ID,
k.SrTime
FROM
wy_areas AS a
INNER JOIN wy_brokerage AS b ON a.ID = b.areas_ID
INNER JOIN wy_jjr AS j ON b.id = j.brokerage_id
INNER JOIN wy_kh AS k ON j.ID = k.JJ_id
WHERE
a.Wecha_id = $where AND
k.Tel = $tel
ORDER BY
j.ID DESC";
                $xmfx=D('jjr');
                $list=$xmfx->query($sql);

                $this->assign('list',$list);
            $this->display('myCustom');
            }

        }
        //客户到访通过手机号查询
        public function daofangs(){
            if($_POST){
                $where=$_GET['wecha_id'];
                $tel=$_POST['Tel'];
                if($tel==null){
                    $this->error('请输入手机号');
                }
                $sql="SELECT
a.ID,
a.areaName,
a.areaTel,
b.id,
b.usersname,
b.tel,
b.address,
b.areas_ID,
j.Mtime,
k.`Name`,
k.Tel,
j.ID,
k.SrTime
FROM
wy_areas AS a
INNER JOIN wy_brokerage AS b ON a.ID = b.areas_ID
INNER JOIN wy_jjr AS j ON b.id = j.brokerage_id
INNER JOIN wy_kh AS k ON j.ID = k.JJ_id
WHERE
a.Wecha_id = $where AND
k.Tel = $tel
ORDER BY
j.ID DESC";
                $xmfx=D('jjr');
                $list=$xmfx->query($sql);

                $this->assign('list',$list);
                $this->display('daofang');
            }

        }
        //通过手机号查询签约
        public function Contracts(){
            if($_POST){
                $where=$_GET['wecha_id'];
                $tel=$_POST['Tel'];
                if($tel==null){
                    $this->error('请输入手机号');
                }
                $sql="SELECT
a.ID,
a.areaName,
a.areaTel,
b.id,
b.usersname,
b.tel,
b.address,
b.areas_ID,
j.Mtime,
k.`Name`,
k.Tel,
j.ID,
k.SrTime
FROM
wy_areas AS a
INNER JOIN wy_brokerage AS b ON a.ID = b.areas_ID
INNER JOIN wy_jjr AS j ON b.id = j.brokerage_id
INNER JOIN wy_kh AS k ON j.ID = k.JJ_id
WHERE
a.Wecha_id = $where AND
k.Tel = $tel
ORDER BY
j.ID DESC";
                $xmfx=D('jjr');
                $list=$xmfx->query($sql);

                $this->assign('list',$list);
                $this->display('Contract');
            }
        }




}



