<?php
class SelfformAction extends BaseAction{
	public $token;
	public $wecha_id;
	public $selfform_model;
	public $selfform_input_model;
	public $selfform_value_model;
	public $contents;
	public function __construct(){
		parent::__construct();
		$this->token		= $this->_get('token');
		$this->assign('token',$this->token);
		$this->wecha_id	= $this->_get('wecha_id');
		if (!$this->wecha_id){
			$this->wecha_id='null';
		}
		$this->assign('wecha_id',$this->wecha_id);
		//
		$this->selfform_model=M('Selfform');
		$this->selfform_input_model=M('Selfform_input');
		$this->selfform_value_model=M('Selfform_value');
		$this->assign('staticFilePath',str_replace('./','/',THEME_PATH.'common/css/product'));
	}
	public function index(){
		$formid=intval($_GET['id']);
		$thisForm=$this->selfform_model->where(array('id'=>$formid))->find();
		$thisForm['successtip']=$thisForm['successtip']==''?'提交成功':$thisForm['successtip'];
		$this->assign('thisForm',$thisForm);
		$where=array('formid'=>$formid);
		$list = $this->selfform_input_model->where($where)->order('taxis ASC')->select();
		$listByKey=array();
		$wheres=array('formid'=>$formid,'token'=>$this->token,'wecha_id'=>$this->wecha_id);
		$cnt=$this->selfform_value_model->where($wheres)->count();
        $this->assign('cnt',$cnt);
		if ($list){
			$i=0;
			foreach ($list as $l){
				if ($l['inputtype']=='select'){
					$options=explode('|',$l['options']);
					$optionStr='<option value="" selected>请选择'.$l['displayname'].'</option>';
					if ($options){
						foreach ($options as $o){
							$optionStr.='<option value="'.$o.'">'.$o.'</option>';
						}
					}
					$list[$i]['optionStr']=$optionStr;
				}
				if ($l['errortip']==''){
					$list[$i]['errortip']='请输入'.$l['displayname'];
				}
				$listByKey[$l['fieldname']]=$l;
				$i++;
			}
		}
		if (IS_POST){
			$row=array();
			$fields=array();
			if ($list){
				foreach ($list as $l){
					$fields[$l['fieldname']]=$_POST[$l['fieldname']];
					$contents=$contents."\n".$l['displayname'].":".$fields[$l['fieldname']];
				}
			}
			$row['values']=serialize($fields);
			$row['formid']=$thisForm['id'];
			$row['wecha_id']=$this->wecha_id;
			$row['time']=time();
			$contents=$contents."\n提交时间:".date("Y-m-d H:i:s",$row['time']);

			$this->selfform_value_model->add($row);
			//短信+邮件
		 $info=M('Wxuser')->where(array('token'=>$this->token))->find();
$phone=$info['phone'];
$user=$info['smsuser'];//短信平台帐号
$pass=md5($info['smspassword']);//短信平台密码
$smsstatus=$info['smsstatus'];//短信平台状态
$content = $contents;
$contentt = $contents;
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
$mailsubject = "您有新订单，请注意查收！";//邮件主题 
$mailbody = $content;//邮件内容 
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件 
########################################## 
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证. 
$smtp->debug = TRUE;//是否显示发送的调试信息 
$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype); 
                                }			
			
//            $info            = M('Wxuser')->where(array(
//                'token' => $this->token
//            ))->find();
//            $phone           = $info['sms_plat_reply'];
//            $user            = $info['sms_plat_user'];
//            $pass            = md5($info['sms_plat_pass']);
//            $if_sms          = $info['sms_plat_status'];
//            $sms_order_feed  = $info['sms_plat_order_feed'];
//            $if_smtp         = $info['smtp_plat_status'];
//            $smtp_order_feed = $info['smtp_plat_order_feed'];
//            $content         = $contents;
//            if ($if_sms == 1 && $sms_order_feed == 1) {
//                if (!empty($content)) {
//                    $this->sendSMS($user, $pass, $phone, $content);
//                }
//            }
//            $to                    = $info['smtp_plat_reply'];
//            $name                  = $info['wxname'];
//            $subject               = '您有新订单，请注意查收！';
//            $body                  = $contents;
//            $attachment            = NULL;
//            $config['SMTP_HOST']   = $info['smtp_plat_host'];
//            $config['SMTP_PORT']   = $info['smtp_plat_port'];
//            $config['SMTP_USER']   = $info['smtp_plat_send'];
//            $config['SMTP_PASS']   = $info['smtp_plat_pass'];
//            $config['FROM_EMAIL']  = $info['smtp_plat_send'];
//            $config['FROM_NAME']   = $info['wxname'];
//            $config['REPLY_EMAIL'] = $info['smtp_plat_reply'];
//            $config['REPLY_NAME']  = $info['wxname'];
//            $ssl                   = $info['smtp_plat_ssl'];
//            if ($if_smtp == 1 && $smtp_order_feed == 1) {
//                if (!empty($content)) {
//					$this->sendEMAIL($to, $name, $subject, $body, $attachment, $config, $ssl);
//                }
//            }
			//短信+邮件
			$this->redirect(U('Selfform/index',array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'id'=>$thisForm['id'],'success'=>1)));
		}else {
			//判断是否提交过信息了
			$submitInfo=$this->selfform_value_model->where(array('wecha_id'=>$this->wecha_id,'formid'=>$thisForm['id']))->find();
			if ($submitInfo){
				$info=unserialize($submitInfo['values']);
				if ($info){
					foreach ($info as $k=>$v){
						$info[$k]=array('displayname'=>$listByKey[$k]['displayname'],'value'=>$v);
					}
				}
				$this->assign('submitInfo',$info);
				$submitted=1;
				//二维码图片
				$imgSrc=generateQRfromGoogle(C('site_url').'/index.php?g=Wap&m=Selfform&a=submitInfo&token='.$this->token.'&wecha_id='.$this->wecha_id.'&id='.$thisForm['id']);
				
				$this->assign('imgSrc',$imgSrc);
			}else {
				$submitted=0;
			}
			$this->assign('submitted',$submitted);
			$this->assign('list',$list);
			$this->display();
		}
	}
	public function detail(){
		$formid=intval($_GET['id']);
		$thisForm=$this->selfform_model->where(array('id'=>$formid))->find();
		$this->assign('thisForm',$thisForm);
		$this->display();
	}
	public function submitInfo(){
		$formid=intval($_GET['id']);
		$thisForm=$this->selfform_model->where(array('id'=>$formid))->find();
		$thisForm['successtip']=$thisForm['successtip']==''?'提交成功':$thisForm['successtip'];
		$this->assign('thisForm',$thisForm);
		$where=array('formid'=>$formid);
		$list = $this->selfform_input_model->where($where)->order('taxis ASC')->select();
		$listByKey=array();
		//二维码图片
		$imgSrc=generateQRfromGoogle(C('site_url').'/index.php?g=Wap&m=Selfform&a=submitInfo&token='.$this->token.'&wecha_id='.$this->wecha_id.'&id='.$thisForm['id']);				
		$this->assign('imgSrc',$imgSrc);
		if ($list){
			$i=0;
			foreach ($list as $l){
				if ($l['inputtype']=='select'){
					$options=explode('|',$l['options']);
					$optionStr='<option value="" selected>请选择'.$l['displayname'].'</option>';
					if ($options){
						foreach ($options as $o){
							$optionStr.='<option value="'.$o.'">'.$o.'</option>';
						}
					}
					$list[$i]['optionStr']=$optionStr;
				}
				if ($l['errortip']==''){
					$list[$i]['errortip']='请输入'.$l['displayname'];
				}
				$listByKey[$l['fieldname']]=$l;
				$i++;
			}
		}
		$submitInfo=$this->selfform_value_model->where(array('wecha_id'=>$this->wecha_id,'formid'=>$thisForm['id']))->order('time desc')->select();
		if ($submitInfo){
			foreach($submitInfo as $n=>$vl)
			{
			$info=unserialize($vl['values']);
			if ($info){
				foreach ($info as $k=>$v){
					$info[$k]=array('displayname'=>$listByKey[$k]['displayname'],'value'=>$v);
				}
			}
			$submitInfos[$n]=$info;
			$this->assign('submitInfo',$submitInfos);
			}
		}else {
			$submitted=0;
		}
		$this->assign('submitted',$submitted);
		$this->assign('list',$list);
		$this->display();
	}
}
function generateQRfromGoogle($chl,$widhtHeight ='150',$EC_level='L',$margin='0'){
	$chl = urlencode($chl);
    $src='http://chart.apis.google.com/chart?chs='.$widhtHeight.'x'.$widhtHeight.'&cht=qr&chld='.$EC_level.'|'.$margin.'&chl='.$chl;
    return $src;
}
?>