<?php

//wap

class YuyueAction extends BaseAction{

	public $token;

	public $wecha_id;

	public $Yuyue_model;

	public $yuyue_order;

	public function __construct(){

		

		parent::__construct();

		$this->token=session('token');

		// $this->token = $this->_get('token');

		$this->assign('token',$this->token);

		$this->wecha_id	= $this->_get('wecha_id');

		if (!$this->wecha_id){

			$this->wecha_id='null';

		}
			$where['token']=$this->token;
		

		$this->assign('wecha_id',$this->wecha_id);

		$this->Yuyue_model=M('yuyue');

		$this->yuyue_order=M('yuyue_order');
		$this->type='Yuyue';

		



	}



	

	//预约列表

	//预约列表
	public function index(){
		$pid = $this->_get('id');
		$wecha_id = $this->_get('wecha_id');
		$where = array('token'=> $this->_get('token'),'id'=>$pid);
		$data = $this->Yuyue_model->where($where)->find();
		$info = M('yuyue_setcin')->where(array('pid'=>$pid,'type'=>$this->type))->select();
		//print_r($info);die;
		$data['count'] = $this->yuyue_order->where(array('wecha_id'=> $wecha_id,'pid'=>$pid))->count();
		$data['token'] = $this->_get('token');
		$data['wecha_id'] = $wecha_id;
		//print_r($str);die;
		$this->assign('data', $data);
		$this->assign('info', $info);
		$this->display();
	}
	
	public function info(){
		$pid = $this->_get('id');
		$id = $this->_get('aid');
		$where = array('token'=> $this->_get('token'),'id'=>$pid);
		
		$cast = array(
			'token'=> $this->_get('token'),
			'wecha_id'=> $this->_get('wecha_id')
		);
		$info = M('yuyue_setcin')->where(array('id'=>$id,'type'=>$this->type))->find();
	
		$info['sheng']=$info['yuanjia']-$info['youhui'];
		//dump($info);exit;
		$data = $this->Yuyue_model->where($where)->find();
		for($i=1;$i<6;$i++){
			if(!empty($info['pic'.$i])){
				$info['pic'][]=$info['pic'.$i];
				unset($info['pic'.$i]);
			}
		}
		$data['count'] = $this->yuyue_order->where($cast)->count();

		$data['token'] = $this->_get('token');

		$data['wecha_id'] = $this->_get('wecha_id');

		$wap= M('setinfo')->where(array('pid'=>$pid))->select();

		$str=array();

		foreach($wap as $v){

			if($v['kind']==5){

				$str["message"]=$v["name"];

			}

			else{

				$str[$v["name"]]=$v["value"];

			}
			

		}
		
       
		
		//print_r($str);die;

		$arr= M('setinfo')->where(array('kind'=>'3','pid'=>$pid))->select();
		$list= M('setinfo')->where(array('kind'=>'4','pid'=>$pid))->select();
		$i=0;


		foreach($list as $v){

			$list[$i]['value']= explode("|",$v['value']);

			$i++;

		}

		//print_r($data);die;

		

		$this->assign('str', $str);

		$this->assign('arr',$arr);

		$this->assign('list',$list);

		$this->assign('list_arr',$list);

		$this->assign('data', $data);
		$this->assign('info', $info);

		$this->display();

	}

	

	//添加订单

	public function add(){
		$info=M('Wxuser')->where(array('token'=>$this->token))->find();

		if(IS_POST){
		

			$url = U('Yuyue/order',array('token'=>$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],'id'=>$_POST['pid']));
			
			$_POST['date']= date("Y-m-d H:i:s",time());
			$_POST['type']=$this->type;

			
			
			
		

			if($this->yuyue_order->add($_POST)){
					//短线发送
				$info=M('Wxuser')->where(array('token'=>$this->token))->find();
$phone=$info['phone'];
$user=$info['smsuser'];//短信平台帐号
$pass=md5($info['smspassword']);//短信平台密码
$smsstatus=$info['smsstatus'];//短信平台状态
$content = $this->sms();
$contentt = $this->sms();
if ($smsstatus == 1) {
    if ($contentt) {
		
        $smsrs = file_get_contents('http://api.smsbao.com/sms?u='.$user.'&p='.$pass.'&m='.$phone.'&c='.urlencode($contentt));
        //$log = file_get_contents('http://www.test.com/test.php?u=' . $user . '&p=' . $pass . '&m=' . $phone . '&test=' . urlencode($content));
    }
}
			//发送短信通知结束

			// 增加 发送邮件
			$email=$info['email'];
$emailuser=$info['emailuser'];
$emailpassword=$info['emailpassword'];
$emailsendname=$info['wxname'];
$emailstatus=$info['yuyuemail'];
$mailbox=$info['mailbox'];
if ($emailstatus == 1) {

require("class.smtp1.php"); 
########################################## 
$smtpserver = "smtp.163.com";//SMTP服务器 
$smtpserverport = 25;//SMTP服务器端口 
$smtpusermail = $emailuser."@163.com";//SMTP服务器的用户邮箱 
$smtpemailto = $mailbox;//发送给谁 
$smtpuser = $emailuser;//SMTP服务器的用户帐号 
$smtppass =$emailpassword ;//SMTP服务器的用户密码 
$mailsubject = "来自".$emailsendname ."的订单";//邮件主题 
$mailbody = $content ;//邮件内容 
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件 
########################################## 
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证. 
$smtp->debug = FALSE;//是否显示发送的调试信息 
$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype); 
}
				

				

				$json = array(
				

					'error'=> 1,

					'msg'=> '添加成功！',

					'url'=> $url
					

				);

				echo  json_encode($json);

			}else{

				$json = array(

					'error'=> 0,

					'msg'=> '添加失败！',

					'url'=> U('Yuyue/index',array('token'=>$this->$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],$id=>$_POST['pid']))

				);

				echo  json_encode($json);

			}

		}

	}
	public function sms(){
	
		$this->yuyue_order=M('yuyue_order');
		$orders=$this->yuyue_order->where(array('token'=>$this->token,'type'=>$this->type))->order('date desc')->limit(0,1)->find();
		
		
		
			
			$str="\r\n订单编号：".$orders['id']."\r\n姓名：".$orders['name']."\r\n电话：".$orders['phone']."\r\n数量：".$orders['nums']."\r\n类型：".$orders['kind']."\r\n预约时间：".$orders['or_date']."\r\n时间段：".$orders['time']."\r\n下单时间：".$orders['date']."\r\n";
			
			
			
			return $str;
		
	}
	
	

	//订单列表

	public function order(){
		
		$id = $this->_get('id');

		$token = $this->_get('token');

		$wecha_id = $this->_get('wecha_id');

		$where = array(

			'wecha_id'=> $wecha_id,

			'pid'=> $id

		);

		$data = $this->yuyue_order->where($where)->order('id desc')->select();

		$info= $this->Yuyue_model->where(array('token'=> $this->_get('token'),'id'=>$id))->find();
		$info1 = $this->Yuyue_model->where(array('token'=> $this->_get('token'),'id'=>$id))->find();
		
		

		//print_r($data);die;

		$this->assign('data',$data);

		$this->assign('info',$info);
		$this->assign('info1',$info1);

		$this->display();


	}

	

	//修改订单视图

	public function set(){
		$where = array('token'=> $this->_get('token'),'type'=>$this->type);

		$id = $this->_get('id');
		

		$pid = $this->_get('pid');
		
		$data1 = M('yuyue')->where($where)->find();
		
		$data = M('yuyue_order')->where(array('id'=>$id))->find();
		$info = M('yuyue_setcin')->where(array('name'=>$data['kind']))->find();
		

		$data['pid'] = $pid;

		$data['id'] = $id;
		//2014.4.22
		$wap= M('setinfo')->where(array('pid'=>$pid))->select();

		$str=array();

		foreach($wap as $v){

			if($v['kind']==5){

				$str["message"]=$v["name"];

			}

			else{

				$str[$v["name"]]=$v["value"];

			}
			

		}
		
       
		
		//print_r($str);die;

		$arr= M('setinfo')->where(array('kind'=>'3','pid'=>$pid))->select();
		$list= M('setinfo')->where(array('kind'=>'4','pid'=>$pid))->select();
		$i=0;


		foreach($list as $v){

			$list[$i]['value']= explode("|",$v['value']);

			$i++;

		}

		//print_r($data);die;

		

		$this->assign('str', $str);

		$this->assign('arr',$arr);

		$this->assign('list',$list);

		$this->assign('list_arr',$list);

		
		
		
		

		$this->assign('data',$data);
		$this->assign('data1',$data1);
		$this->assign('info', $info);

		$this->display();

	}

	

	//修改订单

	public function runSet(){

	

		$id = $_GET['id']; 

		if(IS_POST){

			$url = U('Yuyue/order',array('token'=>$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],'id'=>$_POST['pid'],));
			$url = substr($url,1);

			$where = array(

				'id' =>$id

			);

			if($this->yuyue_order->where($where)->save($_POST)){

				$json = array(

					'error'=> 1,

					'msg'=> '修改成功！',

					'url'=> $url

				);

				echo  json_encode($json);

			}else{

				$json = array(

					'error'=> 0,

					'msg'=> '修改失败！',

					'url'=> $url

				);

				echo  json_encode($json);

			}

		}

		

	}

	

	//删除订单

	public function del(){

		if(IS_POST){

			$url = U('Yuyue/order',array('token'=>$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],'id'=>$_POST['pid'],));
			$url = substr($url,1);

			$where = array(

				'id' =>$_POST['id']

			);

			if($this->yuyue_order->where($where)->delete()){

				$json = array(

					'error'=> 1,

					'msg'=> '删除成功！',

					'url'=> $url

				);

				echo  json_encode($json);

			}else{

				$json = array(

					'error'=> 0,

					'msg'=> '删除失败！',

					'url'=> $url

				);

				echo  json_encode($json);

			}

		}

	}

	

}





?>