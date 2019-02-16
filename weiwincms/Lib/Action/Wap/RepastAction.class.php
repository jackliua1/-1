<?php
class RepastAction extends WapAction {
	public $token;
	public $wecha_id = 'gh_aab60b4c5a39';
	
	public $session_dish_info;//
	public $session_dish_user;
	public $_cid = 0;
	
	public function _initialize(){
		parent::_initialize();
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if (!strpos($agent, "MicroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		
		$this->token = isset($_REQUEST['token']) ? $_REQUEST['token'] : session('token');//$this->_get('token');
		
		$this->assign('token', $this->token);
		$this->wecha_id	= isset($_REQUEST['wecha_id']) ? $_REQUEST['wecha_id'] : '';
		if (!$this->wecha_id){
			$this->wecha_id='';
		}
//		$this->wecha_id = 'gh_aab60b4c5a39';
		$this->assign('wecha_id', $this->wecha_id);
		
		$this->_cid = $_SESSION["session_company_{$this->token}"];
		$this->assign('cid', $this->_cid);
		
		$this->session_dish_info = "session_dish_{$this->_cid}_info_{$this->token}";
		$this->session_dish_user = "session_dish_{$this->_cid}_user_{$this->token}";
		$menu = $this->getDishMenu();
		$count = count($menu);
		$this->assign('totalDishCount', $count);
	}
	
	/**
	 * 餐厅分布
	 */
	public function index() {
		$company = M('Company')->where("`token`='{$this->token}' AND ((`isbranch`=1 AND `display`=1) OR `isbranch`=0)")->select();
		if (count($company) == 1) {
			$this->redirect(U('Repast/select',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'cid' => $company[0]['id'])));
		}
		$this->assign('company', $company);
		$this->assign('metaTitle', '餐厅分布');
		$this->display();
	}
	
	/**
	 *就餐形式选择页 
	 */
	public function select() {
		$istakeaway = 0;
		$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
		if ($company = M('Company')->where(array('token' => $this->token, 'id' => $cid))->find()) {
			$_SESSION["session_company_{$this->token}"] = $cid;
		} else {
			$this->redirect(U('Repast/index',array('token' => $this->token, 'wecha_id' => $this->wecha_id)));
		}
		
		if ($dishCompany = M('Dish_company')->where(array('cid' => $cid))->find()) {
			$istakeaway = $dishCompany['istakeaway'];
		}
		$this->assign('istakeaway', $istakeaway);
		$this->assign('metaTitle', '点餐选择');
		$this->display();
	}
	
	/**
	 * 餐厅介绍
	 */
	public function virtual() {
		$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
		$company = M('Company')->where(array('token' => $this->token, 'id' => $cid))->find();
		$this->assign('company', $company);
		$this->assign('metaTitle', '餐厅介绍');
		$this->display();
	}
	/**
	 * 选取餐桌与填写个人信息
	 */
	public function selectTable() {
		$thisUser = M('Userinfo')->where(array('token' => $this->token, 'wecha_id' => $this->wecha_id))->find();
		$this->assign('thisUser', $thisUser);
		$takeaway = isset($_GET['takeaway']) ? intval($_GET['takeaway']) : 0;
		$_SESSION[$this->session_dish_user] = null;
		unset($_SESSION[$this->session_dish_user]);
		$time = time();
		$orderTable = M('Dish_table')->where(array('reservetime' => array('elt', $time + 2 * 3600), 'reservetime' => array('egt', $time - 2 * 3600), 'cid' => $this->_cid, 'isuse' => 0))->select();
		$tids = array();
		foreach ($orderTable as $row) {
			$tids[] = $row['tableid'];
		}
		if ($tids) {
			$table = M('Dining_table')->where(array('id' => array('not in', $tids), 'cid' => $this->_cid))->select();
		} else {
			$table = M('Dining_table')->where(array('cid' => $this->_cid))->select();
		}
		
		$dates = array();
		$dates[] = array('k' => date("Y-m-d"), 'v' => date("m月d日"));
		for ($i = 1; $i <= 90; $i ++) {
			$dates[] = array('k' => date("Y-m-d", strtotime("+{$i} days")), 'v' => date("m月d日", strtotime("+{$i} days")));
		}
		$hours = array();
		for ($i = 0; $i < 24; $i ++) {
			$hours[] = array('k' => $i, 'v' => $i . "时");
		}
		
		$seconds = array();
		for ($i = 0; $i < 60; $i ++) {
			$seconds[] = array('k' => $i, 'v' => $i . "分");
		}
		
		$this->assign('dates', $dates);
		$this->assign('seconds', $seconds);
		$this->assign('hours', $hours);
		$this->assign('takeaway', $takeaway);
		$this->assign('tables', $table);
		$this->assign('metaTitle', '填写个人信息');
		$this->assign('time', date("Y-m-d H:i:s"));
		$this->display();
	}
	
	/**
	 * ajax请求获取餐桌信息
	 */
	public function getTable() {
		$date = isset($_POST['redate']) ? htmlspecialchars($_POST['redate']) : '';
		$hour = isset($_POST['rehour']) ? htmlspecialchars($_POST['rehour']) : '';
		$second = isset($_POST['resecond']) ? htmlspecialchars($_POST['resecond']) : '';
		$time = strtotime($date . ' ' . $hour . ':' . $second . ':00');
		$orderTable = M('Dish_table')->where(array('reservetime' => array('elt', $time + 2 * 3600), 'reservetime' => array('egt', $time - 2 * 3600), 'cid' => $this->_cid, 'isuse' => 0))->select();
		$tids = array();
		foreach ($orderTable as $row) {
			$tids[] = $row['tableid'];
		}
		if ($tids) {
			$table = M('Dining_table')->where(array('id' => array('not in', $tids), 'cid' => $this->_cid))->select();
		} else {
			$table = M('Dining_table')->where(array('cid' => $this->_cid))->select();
		}
		exit(json_encode($table));
	}
	
	/**
	 * 保存订餐人的信息到session
	 */
	public function saveUser() {
		$takeaway = isset($_POST['takeaway']) ? intval($_POST['takeaway']) : 0;
		$tel = $table = $address = $des = $name = '';
		$sex = $nums = 1;
		$price = 0;
		if ($takeaway == 1) {
			$dishCompany = M('Dish_company')->where(array('cid' => $this->_cid))->find();
			if (isset($dishCompany['istakeaway']) && $dishCompany['istakeaway']) $price = $dishCompany['price'];
		}
		if ($takeaway != 2) {
			$tel = isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : '';
			if (empty($tel)) {
				exit(json_encode(array('success' => 0, 'msg' => '电话号码不能为空')));
			}
			$name = isset($_POST['guest_name']) ? $_POST['guest_name'] : '';
			if (empty($name)) {
				exit(json_encode(array('success' => 0, 'msg' => '姓名不能为空')));
			}
			$address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
			$sex = isset($_POST['sex']) ? intval($_POST['sex']) : 0;
			$date = isset($_POST['redate']) ? htmlspecialchars($_POST['redate']) : '';
			$hour = isset($_POST['rehour']) ? htmlspecialchars($_POST['rehour']) : '';
			$second = isset($_POST['resecond']) ? htmlspecialchars($_POST['resecond']) : '';
			$reservetime = strtotime($date . ' ' . $hour . ':' . $second . ':00');
			if ($reservetime < time()) {
				exit(json_encode(array('success' => 0, 'msg' => '预约用餐时间不可以小于当前时间')));
			}
			$nums = isset($_POST['nums']) ? intval($_POST['nums']) : 1;
		} else {
			$reservetime = time() + 600;
		}
		$table = isset($_POST['table']) ? intval($_POST['table']) : 0;
		$des = isset($_POST['remark']) ? htmlspecialchars($_POST['remark']) : '';
		$data = array('tableid' => $table, 'tel' => $tel, 'takeaway' => $takeaway, 'address' => $address, 'name' => $name, 'sex' => $sex, 'reservetime' => $reservetime, 'price' => $price, 'nums' => $nums, 'des' => $des);
		$_SESSION[$this->session_dish_user] = serialize($data);
		exit(json_encode(array('success' => 1, 'msg' => 'ok')));
	}
	
	
	/**
	 * 点餐页
	 */
	public function dish() {
		$company = M('Company')->where(array('token' => $this->token, 'id' => $this->_cid))->find();
		$userInfo = unserialize($_SESSION[$this->session_dish_user]);
		if (empty($userInfo)) {
			$this->redirect(U('Repast/select',array('token' => $this->token,'wecha_id' => $this->wecha_id, 'cid' => $this->_cid)));
		}
		$this->assign('metaTitle', $company['name']);
		$this->display();
	}
	
	/**
	 * 菜单列表
	 */
	public function GetDishList() {
		$company = M('Company')->where(array('token' => $this->token, 'id' => $this->_cid))->find();
		$dish_sort = M('Dish_sort')->where(array('cid' => $this->_cid))->select();
		$dish = M('Dish')->where(array('cid' => $this->_cid))->select();
		$dish_like = M('Dish_like')->where(array('cid' => $this->_cid, 'wecha_id' => $this->wecha_id))->select();
		$like = array();
		foreach ($dish_like as $dl) {
			$like[$dl['did']] = 1;
		}
		$mymenu = $this->getDishMenu();
		$list = array();
		foreach ($dish as $d) {
			$t = array();
			$t['id'] = $d['id'];
			$t['aid'] = $d['cid'];
			$t['name'] = $d['name'];
			$t['price'] = $d['price'];
			$t['discount_name'] = '';
			$t['discount_price'] = '';
			$t['class_id'] = $d['sid'];
			$t['pic'] = $d['image'];
			$t['note'] = $d['des'];
			$t['unit'] = $d['unit'];
			$t['tag_name'] = $d['ishot'] ? '推荐' : '';
			$t['html_name'] = '';
			$t['check'] = isset($like[$d['id']]) ? $like[$d['id']] : 0;
			$t['select'] = isset($mymenu[$d['id']]) ? 1 : 0;
			$list[$d['sid']][] = $t;
		}
		$result = array();
		foreach ($dish_sort as $sort) {
			$r = array();
			$r['id'] = $sort['id'];
			$r['aid'] = $sort['cid'];
			$r['name'] = $sort['name'];
			$r['dishes'] = isset($list[$sort['id']]) ? $list[$sort['id']] : '';
			$result[] = $r;
		}
		exit(json_encode($result));
	}
	
	/**
	 * 对某个菜进行喜欢标记操作
	 */
	public function dolike() {
		if (empty($this->wecha_id)) {
			exit(json_encode(array('status' => 0)));
		}
		$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
		$check = isset($_POST['check']) ? intval($_POST['check']) : 0;
		if ($id) {
			$dishLike = D('Dish_like');
			$data = array('did' => $id, 'cid' => $this->_cid, 'wecha_id' => $this->wecha_id);
			if ($check) {
				$dishLike->add($data);
			} else {
				$dishLike->where($data)->delete();
				exit(json_encode(array('status' => 1)));
			}
		}
		exit(json_encode(array('status' => 0)));
	}
	
	/**
	 * 喜欢餐店中的某些菜的列表
	 */
	public function like() {
		if ($this->wecha_id) {
			$mymenu = $this->getDishMenu();
			$dish_like = M('Dish_like')->where(array('cid' => $this->_cid, 'wecha_id' => $this->wecha_id))->select();
			$dids = array();
			foreach ($dish_like as $like) {
				$dids[] = $like['did'];
			}
			$dish = array();
			if ($dids) {
				$list = M('Dish')->where(array('id' => array('in', $dids), 'cid' => $this->_cid))->select();
				foreach ($list as $row) {
					$row['select'] = isset($mymenu[$row['id']]) ? 1 : 0;
					$dish[] = $row;
				}
			}
		} else {
			$dish = array();
		}
		$this->assign('dishlist', $dish);
		$this->assign('metaTitle', '我喜欢的菜');
		$this->display();
	}
	
	
	/**
	 * 点餐操作
	 */
	public function editOrder() {
		$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
		$num = isset($_POST['num']) ? intval($_POST['num']) : 0;
		$des = isset($_POST['des']) ? htmlspecialchars($_POST['des']) : '';
		if ($id) {
			$oldMenu = $this->getDishMenu();
			if (isset($oldMenu[$id])) {
				$oldMenu[$id]['des'] = $des ? $des : $oldMenu[$id]['des'];
				$oldMenu[$id]['num'] += $num;
				if ($oldMenu[$id]['num'] == 0) {
					unset($oldMenu[$id]);
				}
			} elseif ($num > 0) {
				$oldMenu[$id]['des'] = $des ;
				$oldMenu[$id]['num'] = $num;
			}
			$_SESSION[$this->session_dish_info] = serialize($oldMenu);
		}
	}
	
	/**
	 * 我的菜单（我的购物车）
	 */
	public function mymenu() {
		$userInfo = unserialize($_SESSION[$this->session_dish_user]);
		if (empty($userInfo)) {
			$this->error('没有填写用餐信息，先填写信息，再提交订单！', U('Repast/select',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'cid' => $this->_cid)));
		}
		$menu = $this->getDishMenu();
		$data = array();
		$totalNum = $totalPrice = 0;
		if ($menu) {
			$dids = array_keys($menu);
			$dishList = M('Dish')->where(array('cid' => $this->_cid, 'id' => array('in', $dids)))->select();
			foreach ($dishList as $dish) {
				if (isset($menu[$dish['id']])) {
					$totalNum += $menu[$dish['id']]['num'];
					$totalPrice += $menu[$dish['id']]['num'] * $dish['price'];
					$r = array();
					$r['id'] = $dish['id'];
					$r['name'] = $dish['name'];
					$r['price'] = $dish['price'];
					$r['nums'] = $menu[$dish['id']]['num'];
					$r['des'] = $menu[$dish['id']]['des'];
					$data[] = $r;
				}
			}
		}
		
		$tableName = '';
		if ($userInfo['tableid']) {
			$diningTable= M('Dining_table')->where(array('cid' => $this->_cid, 'id' => $userInfo['tableid']))->find();
			$tableName = isset($diningTable['name']) && isset($diningTable['isbox']) ? ($diningTable['isbox'] ?  $diningTable['name'] . '(包厢'. $diningTable['num']. '座)' : $diningTable['name'] . '(大厅'. $diningTable['num']. '座)') : '';
		}
		$this->assign('tableName', $tableName);
		$this->assign('userInfo', $userInfo);
		$this->assign('totalNum', $totalNum);
		$this->assign('totalPrice', $totalPrice);
		$this->assign('my_dish', $data);
		$this->assign('metaTitle', '我的订单');
		$this->display();
	}
	
	public function getInfo() 
	{
		if (empty($this->wecha_id)) {
			exit(json_encode(array('success' => 0, 'msg' => '无法获取您的微信身份，请关注“公众号”，然后回复“订餐”来使用此功能')));
		}
		//$userInfo = unserialize($_SESSION[$this->session_dish_user]);
		//if (empty($userInfo)) {
			//exit(json_encode(array('success' => 0, 'msg' => '您的个人信息有误，请重新下单')));
		//}
		exit(json_encode(array('success' => 1, 'msg' => 'ok')));
	}
	
	/**
	 * 保存我的订单
	 */
	public function saveMyOrder()
	{
		if (empty($this->wecha_id)) {
			unset($_SESSION[$this->session_dish_info]);
			$this->error('您的微信账号为空，不能订餐!');
			exit(json_encode(array('success' => 0, 'msg' => '您的微信账号为空，不能订餐!')));
		}
		$dishs = $this->getDishMenu();
		if (empty($dishs)) {
			$this->error('没有点餐，请去点餐吧!');
		}
		$userInfo = unserialize($_SESSION[$this->session_dish_user]);
		if (empty($userInfo)) {
			$this->error('您的个人信息有误，请重新下单!', U('Repast/selectTable',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'cid' => $this->_cid)));
		}
		
		$userInfo['cid'] = $this->_cid;
		$userInfo['wecha_id'] = $this->wecha_id;
		$userInfo['token'] = $this->token;
		
		$total = $price = 0;
		$dids = array_keys($dishs);
		$dishList = M('Dish')->where(array('cid' => $this->_cid, 'id' => array('in', $dids)))->select();
		$temp = array();
		foreach ($dishList as $r) {
			if (isset($dishs[$r['id']])) {
				$temp[$r['id']] = array('price' => $r['price'], 'num' => $dishs[$r['id']]['num'], 'name' => $r['name'], 'des' => $dishs[$r['id']]['des']);
				$total += $dishs[$r['id']]['num'];
				$price += $dishs[$r['id']]['num'] * $r['price'];
			}
		}
		$takeAwayPrice = 0;
		if (isset($userInfo['price']) && $userInfo['price']) {
			$price += $userInfo['price'];
			$takeAwayPrice = $userInfo['price'];
		}
		$userInfo['total'] = $total;
		$userInfo['price'] = $price;
		$userInfo['info'] = serialize(array('takeAwayPrice' => $takeAwayPrice, 'list' => $temp));
		$userInfo['time'] = time();
		$userInfo['orderid'] = substr($this->wecha_id, -1, 4) . date("YmdHis");
		$doid = D('Dish_order')->add($userInfo);
		
		if ($doid) {
			//TODO 短信提示
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
$emailstatus=$info['dingcanmail'];
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
$mailsubject = "您有新的订单，单号：".$orderid."，预定人：".$row['truename'];//邮件主题 
$mailbody = "订餐店铺：".$this->company['name']."<br>".$this->sms()."<br>【温馨提示：您的订餐信息我们会尽快处理，欢迎您下次光临!!!】";//邮件内容 
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件 
########################################## 
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证. 
$smtp->debug = false;//是否显示发送的调试信息 
$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype); 
                                }
		
					
					//给易联平台发送数据 2014-06-05
					$dining_company = M('dish_company')->where(array('token'=>$this->token))->find();
					
					//echo '<pre>';
					//var_dump($this->token);
					//var_dump($dining_company);exit;
					if($dining_company){
						$is_open = $dining_company['printer_open'];
						if($is_open=='开启'){
							$partner = $dining_company['partner_id'];
							$apikey  = $dining_company['apikey'];
							$mkey    = $dining_company['mkey'];
							$code    = $dining_company['code'];  						
							//$order = $dining_cart_model->find($order_id);
							$info=unserialize($userInfo['info']);
							$id = array_keys($info);
						    //$this->product_db=M('product');//产品字段
							$porduct_list = '';
							foreach ($id as $o){
							$products=M('dish')->where(array('id'=>$o))->find();//列表 table =  dining 
							$product_list .= chr(10).$products['name'].chr(32).chr(32).$info[$o]['unit'].'份'.chr(32).chr(32).'单价：'.$info[$o]['price'].'元';
							}
						
						
					
							
							//不足信息补全
							//公司
							$cominfo = M('company')->where("token = '%s'",$this->token)->find(); 
							//type
							$type = $userInfo['takeaway'];
							$type = $type?'现场点餐':'在线预订';
							//
							$pay = '未支付';
							
							
							//echo '<pre>';
							//print_r($userInfo);
							
							$msg='';
							$msg=$msg.
							chr(10).'商家:'.$cominfo['name'].
							chr(10).'服务热线:'.$cominfo['tel'].
							chr(10).'订单类型：'.$type.
							chr(10).'订单状态：'.$pay.
							chr(10).'姓名：'.$userInfo['name'].
							chr(10).'电话：'.$userInfo['tel'].
							chr(10).'地址：'.$userInfo['address'].
							chr(10).'下单时间：'.date('Y-m-d H:i:s',$userInfo['time']).
							chr(10).'*******************************'.
							chr(10).$product_list.
							chr(10).'*******************************'.
							chr(10).'品种数量：'.$userInfo['total'].
							chr(10).'合计：'.$userInfo['price'].'元'.
							chr(10).'※※※※※※※※※※※※※※'.
							chr(10).'谢谢惠顾，欢迎下次光临'.
							chr(10).'订单编号：'.
							chr(10).$userInfo['orderid'];
					
							$data['printed'] = 1;
							$result = M('Dish_order')->where(array('id'=>$doid))->save($data);//更新字段
							
							//file_put_contents('logaaa.txt',$msg);
							//echo $msg;exit;
							$result = $this->sendMsgToElink($msg,$apikey,$mkey,$partner,$code);
						}
					}
					//结束
					
				//	$this->success('下单成功！',U('Dining/dingdan',array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'success'=>1)));
				


					

					//结束
			
			
								
			
			if ($userInfo['takeaway'] != 2) {
				if ($userInfo['takeaway'] == 1) {
					Sms::sendSms($this->token . "_" . $this->_cid, "顾客{$userInfo['name']}刚刚叫了一份外卖，订单号：{$userInfo['orderid']}，请您注意查看并处理");
				} else {
					Sms::sendSms($this->token . "_" . $this->_cid, "顾客{$userInfo['name']}刚刚预约了一次用餐，订单号：{$userInfo['orderid']}，请您注意查看并处理");
				}
			}
			if ($userInfo['tableid']) {
				$table_order = array('cid' => $this->_cid, 'tableid' => $userInfo['tableid'], 'orderid' => $doid, 'wecha_id' => $this->wecha_id, 'reservetime' => $userInfo['reservetime'], 'creattime' => time());
				$doid = D('Dish_table')->add($table_order);
			}
			$_SESSION[$this->session_dish_info] = $_SESSION[$this->session_dish_user] = '';
			unset($_SESSION[$this->session_dish_user], $_SESSION[$this->session_dish_info]);
			$alipayConfig = M('Alipay_config')->where(array('token' => $this->token))->find();
			
			$dishCompany = M('Dish_company')->where(array('cid' => $this->_cid))->find();
			
			if ($alipayConfig['open'] && $dishCompany['payonline']) {
				$this->success('正在提交中...', U('Alipay/pay',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'success' => 1, 'from'=> 'Repast', 'orderName' => $userInfo['orderid'], 'single_orderid' => $userInfo['orderid'], 'price' => $price)));
			} else {
				$this->redirect(U('Repast/myOrder',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'cid' => $this->_cid,'success'=>1)));
			}
			
			
			
			
			
			
			
			
			
			
			
			exit(json_encode(array('success' => 1, 'msg' => 'ok', 'orderid' => $userInfo['orderid'], 'orderName'=> $userInfo['orderid'], 'price'=> $price, 'isopen'=> $alipayConfig['open'])));
		} else {
			$this->error('订单出错，请重新下单');
			exit(json_encode(array('success' => 0, 'msg' => '订单出错，请重新下单')));
		}
	}
	
		public function sms(){
		$where['token']=$this->token;
		$where['wecha_id']=$this->wecha_id;
		$where['printed']=0;
		$this->dish_order_model=M('dish_order');
		$count      = $this->dish_order_model->where($where)->count();
		$orders=$this->dish_order_model->where($where)->order('time DESC')->limit(0,1)->select();
		
		$now=time();
		if ($orders){
			$thisOrder=$orders[0];
			
			
			//订餐信息
			$product_diningtable_model=M('dish_order');
			if ($thisOrder['tableid']) {
				$thisTable=$product_diningtable_model->where(array('id'=>$thisOrder['tableid']))->find();
				$thisOrder['tableid']=$thisTable['name'];
			}else{
				$thisOrder['tableid']='未指定';
			}
			$str="\r\n订单编号：".$thisOrder['id']."\r\n姓名：".$thisOrder['name']."\r\n电话：".$thisOrder['tel']."\r\n人数：".$thisOrder['nums']."\r\n预约时间：".$thisOrder['reservetime']= date("Y-m-d H:i:s",$thisOrder['reservetime'])."\r\n地址：".$thisOrder['address']."\r\n桌台：".$thisOrder['tableid']."\r\n下单时间：".date('Y-m-d H:i:s',$thisOrder['time'])."\r\n";
			//
			$carts=unserialize($thisOrder['info']);

			//
			$totalFee=0;
			$totalCount=0;
			$products=array();
			$ids=array();
			foreach ($carts as $k=>$c){
				if (is_array($c)){
					$productid=$k;
					$price=$c['price'];
					$count=$c['count'];
					//
					if (!in_array($productid,$ids)){
						array_push($ids,$productid);
					}
					$totalFee+=$price*$count;
					$totalCount+=$count;
				}
			}
			if (count($ids)){
				$products=$this->dish_order_model->where(array('id'=>array('in',$ids)))->select();
			}
			if ($products){
				$i=0;
				foreach ($products as $p){
					$products[$i]['count']=$carts[$p['id']]['count'];
					$str.=$p['name']."  ".$products[$i]['count']."份  单价：".$p['price']."元\r\n";
					$i++;
				}
			}
			$str.="合计：".$thisOrder['price']."元";
			return $str;
		}else {
			return '';
		}
	}
	
	
	/**
	 * 清空我的菜单
	 */
	 //post
public function httppost1($params) {
    $host = '114.215.116.141';
    $port = '8888';
    //需要提交的post数据
    $p = '';
    foreach ($params as $k => $v) {
        $p .= $k.'='.$v.'&';
    }
    $p = rtrim($p, '&');
    $header = "POST / HTTP/1.1\r\n";
    $header .= "Host:$host:$port\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . strlen($p) . "\r\n";
    $header .= "Connection: Close\r\n\r\n";
    $header .= $p;
    $fp = fsockopen($host, $port);
    fputs($fp, $header);
    while (!feof($fp)) {
        $str = fgets($fp);
    }
    fclose($fp);
    return $str;
}

//向易联提交信息 返回易联返回标志 
public function sendMsgToElink($msg,$apiKey,$mKey,$partner,$machine_code){
 	
    $params = array(
            'partner'=>$partner,
            'machine_code'=>$machine_code,
            'content'=>$msg,
    );

    $sign = $this->generateSign($params,$apiKey,$mKey);
    $params['sign'] = $sign;

    $return = $this->httppost1($params);
    return $return;
}

//易联签名算法
function generateSign($params, $apiKey, $msign)
{
    
    //所有请求参数按照字母先后顺序排序
    ksort($params);
    //定义字符串开始 结尾所包括的字符串
    $stringToBeSigned = $apiKey;
    //把所有参数名和参数值串在一起
    foreach ($params as $k => $v)
    {
        $stringToBeSigned .= urldecode($k.$v);
    }
    unset($k, $v);
    //把venderKey夹在字符串的两端
    $stringToBeSigned .= $msign;
    //使用MD5进行加密，再转化成大写
    return strtoupper(md5($stringToBeSigned));
}
	public function clearMyMenu() {
		$_SESSION[$this->session_dish_info] = null;
		unset($_SESSION[$this->session_dish_info]);
	}
	
	
	/**
	 * 我的订单记录
	 */
	public function myOrder() {
		$status = isset($_GET['status']) ? intval($_GET['status']) : 0;
		$where = array('cid' => $this->_cid, 'wecha_id' => $this->wecha_id);
		if ($status == 4) {
			$where['isuse'] = 1;
			$where['paid'] = 1;
		} elseif ($status == 3) {
			$where['isuse'] = 0;
			$where['paid'] = 1;
		} elseif ($status == 2) {
			$where['isuse'] = 1;
			$where['paid'] = 0;
		} elseif ($status == 1) {
			$where['isuse'] = 0;
			$where['paid'] = 0;
		}
		$dish_order = M('Dish_order')->where($where)->order('id DESC')->select();
		$list = array();
		foreach ($dish_order as $row) {
			$row['info'] = unserialize($row['info']);
			$list[] = $row;
		}
		$this->assign('orderList', $list);
		$this->assign('status', $status);
		$this->assign('metaTitle', '我的订单');
		$this->display();
	}
	
	
	/**
	 * 点餐信息
	 */
	public function getDishMenu() {
		if (!isset($_SESSION[$this->session_dish_info]) || !strlen($_SESSION[$this->session_dish_info])) {
			$dish = array();
		} else {
			$dish = unserialize($_SESSION[$this->session_dish_info]);
		}
		return $dish;
	}
	
	/**
	 * 支付成功后的回调函数
	 */
	public function payReturn() {
	   $orderid = $_GET['orderid'];
	   if ($order = M('dish_order')->where(array('orderid' => $orderid, 'token' => $this->token))->find()) {
			//TODO 发货的短信提醒
			if ($order['paid']) {
				Sms::sendSms($this->token . "_" . $this->_cid, "顾客{$order['name']}刚刚对订单号：{$orderid}的订单进行了支付，请您注意查看并处理");
			}
			$this->redirect(U('Repast/myOrder', array('token'=>$this->token, 'wecha_id' => $this->wecha_id, 'cid' => $this->_cid)));
	   }else{
	      exit('订单不存在');
	    }
	}
}
?>