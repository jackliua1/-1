<?php
class RecognitionAction extends UserAction{
	public function _initialize(){
		parent::_initialize();
		$diymen=M('Diymen_set')->where(array('token'=>$_SESSION['token']))->find();
		if($diymen ==false){
			//$this->error('必须审请微信高级接口认证<br />若您已经审请了该接口，请填写高级接口配置文件',U('Set/index'));
			$this->error('只有微信官方认证的高级服务号才能使用本功能','?g=User&m=Index&a=edit&id='.$this->thisWxUser['id']);
		}
	}
	//经纪人注册条款的显示及处理页  cate=1表示经纪人注册条款
	public function index(){
		$zc=D('zc');
		if(IS_POST){
			// $data['id']
			$data['Token']=session('token');
			$data['TiaoKuan']=htmlspecialchars(trim($_POST['TiaoKuan']));
			$ID=intval($_POST['ID']);
			if($ID==true){
				$data['ID']=$ID;
				$arr=$zc->save($data);
			}else{
				$data['cate']=1;
				$arr=$zc->add($data);
			}
			if($arr){
				$this->success("修改成功",U('Recognition/index'));
			}else{
				$this->error("修改失败",U('Recognition/index'));
			}
		}else{
			$where['Token']=session('token');
			$where['cate']=1;
			$content=$zc->where($where)->find();
			if($content){
				$this->assign('content',$content);
			}
			$this->display();
		}
	}
	//置业顾问注册条款的显示及处理页    cate=2表示置业顾问注册条款
	public function zytk(){
		$zc=D('zc');
		if(IS_POST){
			// $data['id']
			$data['Token']=session('token');
			$data['TiaoKuan']=htmlspecialchars(trim($_POST['TiaoKuan']));
			$ID=intval($_POST['ID']);
			if($ID==true){
				$data['ID']=$ID;
				$arr=$zc->save($data);
			}else{
				$data['cate']=2;
				$arr=$zc->add($data);
			}
			if($arr){
				$this->success("修改成功",U('Recognition/zytk'));
			}else{
				$this->error("修改失败",U('Recognition/zytk'));
			}
		}else{
			$where['Token']=session('token');
			$where['cate']=2;
			$content=$zc->where($where)->find();
			if($content){
				$this->assign('content',$content);
			}
			$this->display();
		}
	}
	//案场经理注册条款的显示及处理页    cate=3表示案场经理注册条款
	public function actk(){
		$zc=D('zc');
		if(IS_POST){
			// $data['id']
			$data['Token']=session('token');
			$data['TiaoKuan']=htmlspecialchars(trim($_POST['TiaoKuan']));
			$ID=intval($_POST['ID']);
			if($ID==true){
				$data['ID']=$ID;
				$arr=$zc->save($data);
			}else{
				$data['cate']=3;
				$arr=$zc->add($data);
			}
			if($arr){
				$this->success("修改成功",U('Recognition/actk'));
			}else{
				$this->error("修改失败",U('Recognition/actk'));
			}
		}else{
			$where['Token']=session('token');
			$where['cate']=3;
			$content=$zc->where($where)->find();
			if($content){
				$this->assign('content',$content);
			}
			$this->display();
		}
	}
	public function get_code(){
			$where=array('id'=>$this->_get('id','intval'),'token'=>session('token'));
			$GetDb=M('Recognition');
			$recognition=$GetDb->where($where)->field('id')->find();
			if($recognition == false) $this->error('非法操作');
			//查询appid appkey是否存在
			$api=M('Diymen_set')->where(array('token'=>session('token')))->find();
			//dump($api);
			if($api['appid']==false||$api['appsecret']==false){$this->error('必须先填写【AppId】【 AppSecret】');exit;}
			//获取微信认证
			$url_get='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$api['appid'].'&secret='.$api['appsecret'];
			$json=json_decode($this->curlGet($url_get));
			$qrcode_url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$json->access_token;
			//{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": 123}}}
			$data['action_name']='QR_LIMIT_SCENE';
			$data['action_info']['scene']['scene_id']=$recognition['id'];
			$post=$this->api_notice_increment($qrcode_url,json_encode($data));
			if($post ==false ) $this->error('微信接口返回信息错误，请联系管理员');
			$update=$GetDb->where(array_merge(array('id'=>$recognition['id']),$where))->save(array('code_url'=>$post));
			if($update !=false){
				$this->success('获取成功');
			}else{
				$this->error('操作失败');
			}
	}
	public function del(){
		$data=D('Recognition');
		$where['id']=$this->_get('id','intval');
		if($where['id']==false) $this->error('非法操作');
		$where['token']=$this->token;
		//dump($where);exit;
		$back=$data->where($where)->delete();
		if($back==false){
			$this->error('操作失败');
		}else{
			$this->success('操作成功');
		}
	}	
	public function status(){
		$data=D('Recognition');
		$where['id']=$this->_get('id','intval');
		if($where['id']==false) $this->error('非法操作');
		$where['token']=session('token');
		$type=$this->_get('type','intval');
		if($type==0){
			$back=$data->where($where)->setInc('status');
		}else{
			$back=$data->where($where)->setDec('status');
		}
		if($back==false){
			$this->error('操作失败');
		}else{
			$this->success('操作成功');
		}
	}

	function api_notice_increment($url, $data){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		if ($errorno) {
			return array('rt'=>false,'errorno'=>$errorno);
		}else{
			//dump($tmpInfo);
			
			$js=json_decode($tmpInfo,1);
			return $js['ticket'];
		}
	}
	function curlGet($url){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}

}
	?>