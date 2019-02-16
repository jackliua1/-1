<?php
class StoreAction extends WapAction{
	public $token;
	public $wecha_id = 'gh_aab60b4c5a39';
	public $product_model;
	public $product_cat_model;
	public $session_cart_name;
	
	public function _initialize() {
		parent::_initialize();

		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if (!strpos($agent, "MicroMessenger")) {
			//	echo '此功能只能在微信浏览器中使用';exit;
		}
		$this->token = isset($_GET['token']) ? htmlspecialchars($_GET['token']) : session('token');
		$this->session_cart_name = 'session_cart_products_' . $this->token;
		$this->assign('token', $this->token);
		$this->wecha_id	= isset($_GET['wecha_id']) ? htmlspecialchars($_GET['wecha_id']) : '';
		if (!$this->wecha_id){
			//$this->wecha_id='';
			//exit('非法请求');
		}
		$this->assign('wecha_id', $this->wecha_id);
		$this->product_model = M('Product');
		$this->product_cat_model = M('Product_cat');
		$this->assign('staticFilePath', str_replace('./','/',THEME_PATH.'common/css/store'));
		//购物车
		$calCartInfo = $this->calCartInfo();
		$where['token']=$this->token;
		$kefuonline=M('kefuonline')->where($where)->find();
		$this->assign('kefuonline',$kefuonline);
		$this->assign('totalProductCount', $calCartInfo[0]);
		$this->assign('totalProductFee', $calCartInfo[1]);

		//底部版权
		$replyinfo = M('reply_info')->where(array("token"=>$this->token))->field("copyright,copyrighturl")->find();
		$this->assign("replyinfo",$replyinfo);
		
		$cats = $this->product_cat_model->where(array('token' => $this->token))->order('id asc')->select();
		$this->assign('cats', $cats);
	}
	
	function remove_html_tag($str){  //清除HTML代码、空格、回车换行符
		//trim 去掉字串两端的空格
		//strip_tags 删除HTML元素
		$str = trim($str);
		$str = @preg_replace('/<script[^>]*?>(.*?)<\/script>/si', '', $str);
		$str = @preg_replace('/<style[^>]*?>(.*?)<\/style>/si', '', $str);
		$str = @strip_tags($str,"");
		$str = @ereg_replace("\t","",$str);
		$str = @ereg_replace("\r\n","",$str);
		$str = @ereg_replace("\r","",$str);
		$str = @ereg_replace("\n","",$str);
		$str = @ereg_replace(" ","",$str);
		$str = @ereg_replace("&nbsp;","",$str);
		return trim($str);
	}
	
	public function index() {
		echo $this->tpl;
		$this->assign('tpl',$this->tpl);
		$this->assign('metaTitle', '商品分类');
	
	}
	
	public function cats() {
		$where = array('token'=> $this->_get('token'));
			//获取商城模版名称
		$wh=array('token'=>$this->token); 
		$tpl=D('Wxuser')->where($wh)->find();
		//dump($tpl);exit;
		$this->weixinUser=$tpl;
		$this->tpl=$tpl;
	    //幻灯
		$info = M('reply_info')->where($where)->find();
		
		for($i=1;$i<6;$i++){
			if(!empty($info['picurls'.$i])){
				$info['picurls'][]=$info['picurls'.$i];
				unset($info['picurls'.$i]);
			}
		}
		//广告内容
		$advert=M("advert")->where($wh)->order("sort desc")->select();
		$this->assign('advert', $advert);
		//热销商品
		$hotcomm=$this->product_model->where(array('token'=> $this->_get('token'),'groupon' => 0))
				->order("salecount desc")->limit(0,10)->select();
		$date = M('reply_info')->where($where)->find();
		$this->assign('info', $info);
		$this->assign('metaTitle', $date['indextitle']);
		$this->assign('date', $date);
		$this->assign("hotcomm",$hotcomm);
		// $this->display($this->tpl['shoptpltypename']);
		$this->display();
	}
	
	public function products() {
		$where = array('token' => $this->token, 'groupon' => 0);
		$catid = isset($_GET['catid']) ? intval($_GET['catid']) : 0;
		if ($catid) {
			$where['catid'] = $catid;
			$thisCat = $this->product_cat_model->where(array('id'=>$catid))->find();
			$this->assign('thisCat', $thisCat);
		}
		if (IS_POST){
			$key = $this->_post('search_name');
            $this->redirect('/index.php?g=Wap&m=Store&a=products&token=' . $this->token . '&wecha_id=' . $this->wecha_id . '&keyword=' . $key);
		}
		if (isset($_GET['keyword'])){
            $where['name|intro|keyword'] = array('like', "%".$_GET['keyword']."%");
            $this->assign('isSearch', 1);
		}
		$count = $this->product_model->where($where)->count();
		$this->assign('count', $count); 
		//排序方式
		$method = isset($_GET['method']) && ($_GET['method']=='DESC' || $_GET['method']=='ASC') ? $_GET['method'] : 'DESC';
		$orders = array('time', 'discount', 'price', 'salecount');
		$order = isset($_GET['order']) && in_array($_GET['order'], $orders) ? $_GET['order'] : 'time';
		$this->assign('order', $order);
		$this->assign('method', $method);
        	
		$products = $this->product_model->where($where)->order("sort ASC, " . $order.' '.$method)->limit('0, 8')->select();
		$this->assign('products', $products);
		$name = isset($thisCat['name']) ? $thisCat['name'] . '列表' : "商品列表";
		$this->assign('metaTitle', $name);
		$this->display();
	}
	
	public function ajaxProducts(){
		$where=array('token'=>$this->token);
		if (isset($_GET['catid'])){
			$catid=intval($_GET['catid']);
			$where['catid']=$catid;
		}
		$page = isset($_GET['page']) && intval($_GET['page'])>1 ? intval($_GET['page']) : 2;
		$pageSize = isset($_GET['pagesize']) && intval($_GET['pagesize']) > 1 ? intval($_GET['pagesize']) : 8;
		
		$method = isset($_GET['method']) && ($_GET['method']=='DESC' || $_GET['method']=='ASC') ? $_GET['method'] : 'DESC';
		$orders = array('time', 'discount', 'price', 'salecount');
		$order = isset($_GET['order']) && in_array($_GET['order'], $orders) ? $_GET['order'] : 'time';
		$start=($page-1)*$pageSize;
		$products = $this->product_model->where($where)->order("sort ASC, " . $order.' '.$method)->limit($start . ',' . $pageSize)->select();
		$str='{"products":[';
		if ($products){
			$comma='';
			foreach ($products as $p){
				$str.=$comma.'{"id":"'.$p['id'].'","catid":"'.$p['catid'].'","storeid":"'.$p['storeid'].'","name":"'.$p['name'].'","price":"'.$p['price'].'","token":"'.$p['token'].'","keyword":"'.$p['keyword'].'","salecount":"'.$p['salecount'].'","logourl":"'.$p['logourl'].'","time":"'.$p['time'].'","oprice":"'.$p['oprice'].'"}';
				$comma=',';
			}
		}
		$str.=']}';
		$this->show($str);
	}
	
	public function product() {
		$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
		$where = array('token' => $this->token, 'id' => $id);
		$product = $this->product_model->where($where)->find();
		if (empty($product)) {
			$this->redirect(U('Store/products',array('token' => $this->token,'wecha_id' => $this->wecha_id)));
		}
		
		$product['intro'] = isset($product['intro']) ? htmlspecialchars_decode($product['intro']) : '';
		$this->assign('product', $product);
		if ($product['endtime']){
			$leftSeconds = intval($product['endtime'] - time());
			$this->assign('leftSeconds', $leftSeconds);
		}
        $normsData = M("Norms")->where(array('catid' => $product['catid']))->select();
        foreach ($normsData as $row) {
        	$normsList[$row['id']] = $row['value'];
        }
        if($productCatData = M('Product_cat')->where(array('id' => $product['catid'], 'token' => $this->token))->find()) {
        	$this->assign('catData', $productCatData);
        }
		$colorDetail = $normsDeatail = $productDetail = array();
		$attributeData = M("Product_attribute")->where(array('pid' => $product['id']))->select();
		
		$productDetailData = M("Product_detail")->where(array('pid' => $product['id']))->select();
		foreach ($productDetailData as $p) {
			$p['formatName'] = $normsList[$p['format']];
			$p['colorName'] = $normsList[$p['color']];
			
			$formatData[$p['format']] = $colorData[$p['color']] = $productDetail[] = $p;
			
			$colorDetail[$p['color']][] = $p;
			$normsDetail[$p['format']][] = $p;
		}
		$productimage = M("Product_image")->where(array('pid' => $product['id']))->select();
		$this->assign('imageList', $productimage);
		$this->assign('productDetail', $productDetail);
		$this->assign('attributeData', $attributeData);
		$this->assign('normsDetail', $normsDetail);
		$this->assign('colorDetail', $colorDetail);
		$this->assign('formatData', $formatData);
		$this->assign('colorData', $colorData);
		$this->assign('metaTitle', $product['name']);
		$product['intro'] = str_replace(array('&lt;','&gt;','&quot;','&amp;nbsp;'),array('<','>','"',' '), $product['intro']);
		$intro = $this->remove_html_tag($product['intro']);
		$intro = mb_substr($intro, 0, 30,'utf-8');
		$this->assign('intro',$intro);
		$this->display();
	}
	
	/**
	 * 添加购物车
	 */
	public function addProductToCart() {
		$count = isset($_GET['count']) ? intval($_GET['count']) : 1;
		if (empty($this->wecha_id)) {
			echo false;
			die;
		}
		$carts = $this->_getCart();
		$id = intval($_GET['id']);
		$did = isset($_GET['did']) ? intval($_GET['did']) : 0;//商品的详细id,即颜色与尺寸
		if (isset($carts[$id])) {
			if ($did) {
				if (isset($carts[$id][$did])) {
					$carts[$id][$did]['count'] += $count;
				} else {
					$carts[$id][$did]['count'] = $count;
				}
			} else {
				$carts[$id] += $count;
			}
		} else {
			if ($did) {
				$carts[$id][$did]['count'] = $count;
			} else {
				$carts[$id] = $count;
			}
		}
		$_SESSION[$this->session_cart_name] = serialize($carts);
		$calCartInfo = $this->calCartInfo();
		echo $calCartInfo[0].'|'.$calCartInfo[1];
	}
	//查询购物在车中购买商品的总数量、总价格、和支付方式
	private function calCartInfo($carts=''){
		$totalCount = $totalFee = 0;
		if (!$carts) {
			$carts = $this->_getCart();
		}
		$data = $this->getCat($carts);
		if (isset($data[1])) {
			foreach ($data[1] as $pid => $row) {
				$totalCount += $row['total'];
				$totalFee += $row['totalPrice'];
			}
		}
		
		return array($totalCount, $totalFee, $data[2]);
	}
	//查看session中是否存在购物的内容
	private function _getCart() {
		if (!isset($_SESSION[$this->session_cart_name])||!strlen($_SESSION[$this->session_cart_name])){
			$carts = array();
		} else {
			$carts=unserialize($_SESSION[$this->session_cart_name]);
		}
		return $carts;
	}
	
	/**
	 * 购物车列表
	 */
	public function cart(){
		if (empty($this->wecha_id)) {
			unset($_SESSION[$this->session_cart_name]);
		}
		$totalCount = $totalFee = 0;
		$data = $this->getCat($this->_getCart());
		if (isset($data[1])) {
			foreach ($data[1] as $pid => $row) {
				$totalCount += $row['total'];
				$totalFee += $row['totalPrice'];
			}
		}
		$list = $data[0];
		
		$this->assign('products', $list);
		$this->assign('totalFee', $totalFee);
		$this->assign('totalCount', $totalCount);
		$this->assign('metaTitle','购物车');
		$this->display();
	}
	
	
	
	/**
	 * 计算一次购物的总的价格与数量
	 * @param array $carts
	 */
	public function getCat($carts = '')
	{
		$carts = empty($carts) ? $this->_getCart() : $carts;
		//邮费
		$mailPrice = 0;
		//商品的IDS
		$pids = array_keys($carts);
		
		//商品分类IDS
		$productList = $cartIds = array();
		if (empty($pids)) {
			return array(array(), array(), array());
		}
		
		$productdata = $this->product_model->where(array('id'=> array('in', $pids)))->select();
		foreach ($productdata as $p) {
			if (!in_array($p['catid'], $cartIds)) {
				$cartIds[] = $p['catid'];
			}
			$mailPrice = max($mailPrice, $p['mailprice']);
			$productList[$p['id']] = $p;
		}
		//商品规格参数值
		$catlist = $norms = array();
		if ($cartIds) {
			$normsdata = M('norms')->where(array('catid' => array('in', $cartIds)))->select();
			foreach ($normsdata as $r) {
				$norms[$r['id']] = $r['value'];
			}
			//商品分类
			$catdata = M('Product_cat')-> where(array('id' => array('in', $cartIds)))->select();
			foreach ($catdata as $cat) {
				$catlist[$cat['id']] = $cat;
			}
		}
		$dids = array();
		foreach ($carts as $pid => $rowset) {
			if (is_array($rowset)) {
				$dids = array_merge($dids, array_keys($rowset));
			}
		}
		//商品的详细
		$totalprice = 0;
		$data = array();
		if ($dids) {
			$dids = array_unique($dids);
			$detail = M('Product_detail')->where(array('id'=> array('in', $dids)))->select();
			foreach ($detail as $row) {
				$row['colorName'] = isset($norms[$row['color']]) ? $norms[$row['color']] : '';
				$row['formatName'] = isset($norms[$row['format']]) ? $norms[$row['format']] : '';
				$row['count'] = isset($carts[$row['pid']][$row['id']]['count']) ? $carts[$row['pid']][$row['id']]['count'] : 0;
				if ($this->fans['getcardtime'] > 0) {
					$row['price'] = $row['vprice'] ? $row['vprice'] : $row['price'];
				}
				$productList[$row['pid']]['detail'][] = $row;
				$data[$row['pid']]['total'] = isset($data[$row['pid']]['total']) ? intval($data[$row['pid']]['total'] + $row['count']) : $row['count'];
				$data[$row['pid']]['totalPrice'] = isset($data[$row['pid']]['totalPrice']) ? intval($data[$row['pid']]['totalPrice'] + $row['count'] * $row['price']) : $row['count'] * $row['price'];//array('total' => $totalCount, 'totalPrice' => $totalFee);
				$totalprice += $data[$row['pid']]['totalPrice'];
			}
		}
		//商品的详细列表
		$list = array();
		foreach ($productList as $pid => $row) {
			if (!isset($data[$pid]['total'])) {
				$row['count'] = $data[$pid]['total'] = isset($carts[$pid]['count']) ? $carts[$pid]['count'] : (isset($carts[$pid]) && is_int($carts[$pid]) ? $carts[$pid] : 0);
				if ($this->fans['getcardtime'] > 0) {
					$row['price'] = $row['vprice'] ? $row['vprice'] : $row['price'];
				}
				$data[$pid]['totalPrice'] = $data[$pid]['total'] * $row['price'];
				$totalprice += $data[$pid]['totalPrice'];
			}
			$row['formatTitle'] =  isset($catlist[$row['catid']]['norms']) ? $catlist[$row['catid']]['norms'] : '';
			$row['colorTitle'] =  isset($catlist[$row['catid']]['color']) ? $catlist[$row['catid']]['color'] : '';
			$list[] = $row;
		}
		if ($obj = M('Product_setting')->where(array('token' => $this->token))->find()) {
			if ($totalprice >= $obj['price']) $mailPrice = 0;
		}
		return array($list, $data, $mailPrice);
	}
	
	public function deleteCart(){
		$products=array();
		$ids=array();
		$carts=$this->_getCart();
		$did = isset($_GET['did']) ? intval($_GET['did']) : 0;
		$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
		if ($did) {
			unset($carts[$id][$did]);
			if (empty($carts[$id])) {
				unset($carts[$id]);
			}
		} else {
			unset($carts[$id]);
		}
		$_SESSION[$this->session_cart_name] = serialize($carts);
		$this->redirect(U('Store/cart',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
	}
	public function ajaxUpdateCart(){
		$count = isset($_GET['count']) ? intval($_GET['count']) : 1;
		$carts = $this->_getCart();
		$id = intval($_GET['id']);
		$did = isset($_GET['did']) ? intval($_GET['did']) : 0;
		if (isset($carts[$id])) {
			if ($did) {
				$carts[$id][$did]['count'] = $count;
			} else {
				$carts[$id] = $count;
			}
		} else {
			if ($did) {
				$carts[$id][$did]['count'] = $count;
			} else {
				$carts[$id] = $count;
			}
		}
		$_SESSION[$this->session_cart_name] = serialize($carts);
		$calCartInfo = $this->calCartInfo();
		echo $calCartInfo[0].'|'.$calCartInfo[1];
	}
	
	
	public function ordersave() {
		$row = array();
		$row['orderid'] = $orderid = substr($this->wecha_id, -1, 4) . date("YmdHis");  //订单号
		$row['truename'] = $this->_post('truename');      //真实姓名
		$row['tel'] = $this->_post('tel');                //电话号码
		$row['address'] = $this->_post('address');        //收货地址
		$row['token'] = $this->token;                     
		$row['wecha_id'] = $this->wecha_id;
		$row['time'] = $time = time();                   //订单生成时间
		$row['paymode'] = isset($_POST['paymode']) ? intval($_POST['paymode']) : 1;   //支付方式
		
		$normal_rt = 0;
		$carts = $this->_getCart();   //查询购物车中是否有商品
		
		if ($carts){
			$calCartInfo = $this->calCartInfo($carts);
			//订单产品信息
			$setting = M('Product_setting')->where(array('token' => $this->token))->find();
			$totalprice = $calCartInfo[1] + $calCartInfo[2];
			if($row['paymode']==4){
				//积分支付
				$jjrinfo=D("jjr")->where(array('Token'=>$this->token,'Wecha_id'=>$this->wecha_id))->field("ID,Token,Wecha_id,credit")->find();
				$credit=intval($jjrinfo['credit']);      //查询积分credit
				$score=$totalprice*$_POST['score']*10;            //需要支付的积分
				if($score>$credit){
					$this->error("积分不足，请选择其他方式支付");
				}
			}else{
				$score=0;
			}
			//将使用的积分在金额中扣去相应的数字  ---不知道怎么用
			// if ($score && $setting && $setting['score'] > 0 && $this->fans['total_score'] >= $score) {
			// 	echo $score."<br>";
			// 	$totalprice -= $score / $setting['score'];
			// 	if ($totalprice < 0) {
			// 		$score = ($calCartInfo[1] + $calCartInfo[2]) * $setting['score']*10;
			// 		$totalprice = 0;
			// 		$row['paid'] = 1;
			// 	}
			// }
			$row['total'] = $calCartInfo[0];   //总数量
			if($row['paymode']==5){
				//佣金支付   1:查询当前经纪人的总佣金
				$where['token']=$this->token;
				$where['wecha_id']=$this->wecha_id;
				$where['rewardstatus']=0;
				$rewardall=D("agent_rewardinfo")->where($where)->sum("rewardamount");
				//查询当前经纪人的不可使用佣金
				$where['rewardstatus']=array("in","-1,1,2");
				$rewardbk=D("agent_rewardinfo")->where($where)->sum("rewardamount");
				$rewardamount=round(($rewardall-$rewardbk),2);
				if($total>$rewardamount){
					$this->error("佣金不足，请选择其他方式支付");
				}
			}
			$row['price'] = $totalprice;       //需要消耗的费用
			$row['diningtype'] = 0;
			$row['buytime'] = date("m月d日H点",$row['time']);
			$row['tableid'] = 0;
			$row['info'] = serialize($carts);
			$row['groupon']=0;
			$row['dining'] = 0;
			$row['score'] = $score;             //消耗积分
			$product_cart_model = M('product_cart');
			$normal_rt = $product_cart_model->add($row);
			//TODO 发货的短信提醒
			$info=M('Wxuser')->where(array('token'=>$this->token))->find();
			$phone=$info['phone'];
			$user=$info['smsuser'];//短信平台帐号
			$pass=md5($info['smspassword']);//短信平台密码
			$smsstatus=$info['smsstatus'];//短信平台状态
			$content = $this->sms();
			$contentt = $this->smss();
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
			// $emailstatus=$info['shopmail'];   //原来的
			$emailstatus=$info['emailstatus'];   //修改后
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
			// echo "SMTP服务器:$smtpserver<br>SMTP服务器端口:$smtpserverport<br>";
			// echo "SMTP服务器的用户邮箱:$smtpusermail<br>发送给谁:$smtpemailto<br>";
			// echo "SMTP服务器的用户帐号:$smtpuser<br>SMTP服务器的用户密码:$smtppass<br>";
			// echo "邮件主题:$mailsubject<br>邮件内容:$mailbody<br>";die();
			$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证. 
			$smtp->debug = TRUE;//是否显示发送的调试信息 FALSE
			$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype); 

			}
		}
		//如果订单保存成功
		if ($normal_rt){
			$product_model = M('product');                    
			$product_cart_list_model = M('product_cart_list');
			$crow = array();
			$tdata = $this->getCat($carts);
			foreach ($carts as $k => $c){
				$crow['cartid'] = $normal_rt;     //生成订单的id
				$crow['productid'] = $k;          //购买商品的id
				$crow['price'] = $tdata[1][$k]['totalPrice'];//$c['price'];
				$crow['total'] = $tdata[1][$k]['total'];      
				$crow['wecha_id'] = $row['wecha_id'];
				$crow['token'] = $row['token'];
				$crow['time'] = $time;
				$product_cart_list_model->add($crow);
				
				//增加销量
				$product_model->where(array('id'=>$k))->setInc('salecount', $tdata[1][$k]['total']);
			}
			//删除库存   ————目前没有库存的概念
			foreach ($carts as $pid => $rowset) {
				$total = 0;
				if (is_array($rowset)) {
					foreach ($rowset as $did => $ro) {
						M('Product_detail')->where(array('id' => $did, 'pid' => $pid, 'num' => array('egt', $ro['count'])))->setDec('num', $ro['count']);
						$total += $ro['count'];
					}
				} else {
					$total = $rowset;
				}
				$product_model->where(array('id' => $pid, 'num' => array('egt', $total)))->setDec('num', $total);
			}
			$_SESSION[$this->session_cart_name] = null;
			unset($_SESSION[$this->session_cart_name]);
			//保存个人信息
			if ($_POST['saveinfo']){
				$userinfo_model = M('Userinfo');
				$thisUser = $userinfo_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
				$this->assign('thisUser', $thisUser);
				$userRow=array('tel'=>$row['tel'],'truename'=>$row['truename'],'address'=>$row['address']);
				if ($thisUser) {
					$userinfo_model->where(array('id' => $thisUser['id']))->save($userRow);
					$userinfo_model->where(array('id' => $thisUser['id'], 'total_score' => array('gt', $score)))->setDec('total_score', $score);
					F('fans_token_wechaid', NULL);
				} else {
					$userRow['token']=$this->token;
					$userRow['wecha_id']=$this->wecha_id;
					$userRow['wechaname']='';
					$userRow['qq']=0;
					$userRow['sex']=-1;
					$userRow['age']=0;
					$userRow['birthday']='';
					$userRow['info']='';

					$userRow['total_score']=0;
					$userRow['sign_score']=0;
					$userRow['expend_score']=0;
					$userRow['continuous']=0;
					$userRow['add_expend']=0;
					$userRow['add_expend_time']=0;
					$userRow['live_time']=0;
					$userinfo_model->add($userRow);
				}
			}
			//支付配置
			$alipayConfig = M('Alipay_config')->where(array('token' => $this->token))->find();
			if ($alipayConfig['open'] && $totalprice && $row['paymode'] == 1) {
				$this->redirect(U('Alipay/pay',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'success' => 1, 'from'=> 'Store', 'orderName' => $orderid, 'single_orderid' => $orderid, 'price' => $totalprice)));
			} else {
				//不是微信支付的情况下扣除相应的积分或佣金 开始 
				//wy_product_cart表下的paid修改为1表示已支付
				if($row['paymode']==4){
					//积分扣除
					$token=$this->token;
					$wecha_id=$this->wecha_id;
					$jjrinfo=D("jjr")->where("Token='$token' and Wecha_id='$wecha_id'")->field("ID,credit")->find();
					$xmfx['jid']=$jjrinfo['ID'];     //获取到经纪人id
					$xmfx['token']=$token;
					$xmfx['hascredit']=$score;
					$xmfx['type']=2;
					$xmid=$fxid=D("xmfx")->add($xmfx);
					D("jjr")->where(array("ID"=>$xmfx['jid']))->setDec("credit",$score);  //经纪人表中的总积分减去消耗的积分

					$data['id']=$normal_rt;
					$data['paid']=1;          //表示已支付
					$data['xmid']=$xmid;        //佣金明细id
					$product_cart_model->save($data);   //将对应的积分记录保存
				}elseif($row['paymode']==5){
					//佣金支付
					$reward['token']=$this->token;
					$reward['wecha_id']=$this->wecha_id;
					$reward['rewardamount']=$totalprice;
					$reward['rewardstatus']="-1";      //0:未取现  1:已取现  2:取现申请 -1:用于支付 -99:撤销
					$reward['srtime']=time();
					$rid=D("agent_rewardinfo")->add($reward);

					$data['id']=$normal_rt;
					$data['paid']=1;          //表示已支付
					$data['rid']=$rid;        //佣金明细id
					$product_cart_model->save($data);
				}
				//结束
				$this->redirect(U('Store/my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'success'=>1)));
			}
			exit(json_encode(array('error_code' => false, 'msg' => 'ok', 'orderid' => $orderid, 'price' => $calCartInfo[1] + $calCartInfo[2], 'orderName'=> $orderid, 'isopen'=> $alipayConfig['open'])));
		} else {
			exit(json_encode(array('error_code' => true, 'msg' => '订单生产失败')));
		} 
	}
	public function smss(){
		$where['token']=$this->token;
		$where['wecha_id']=$this->wecha_id;
		$where['printed']=0;
		$this->product_cart_model=M('product_cart');
		$count      = $this->product_cart_model->where($where)->count();
		$orders=$this->product_cart_model->where($where)->order('time DESC')->limit(0,1)->select();
		$now=time();
		if ($orders){
			$thisOrder=$orders[0];
			switch ($thisOrder['diningtype']){
				case 0:
					$orderType='购物';
					break;
				case 1:
					$orderType='点餐';
					break;
				case 2:
					$orderType='外卖';
					break;
				case 3:
					$orderType='预定餐桌';
					break;
			}
			//订餐信息
			$product_diningtable_model=M('product_diningtable');
			if ($thisOrder['tableid']) {
				$thisTable=$product_diningtable_model->where(array('id'=>$thisOrder['tableid']))->find();
				$thisOrder['tableName']=$thisTable['name'];
			}else{
				$thisOrder['tableName']='未指定';
			}
			$str="您在微信平台有新订单（请查收）：订单类型：".$orderType."订单编号：".$thisOrder['id']."姓名：".$thisOrder['truename']."电话：".$thisOrder['tel']."下单时间：".date('Y-m-d H:i:s',$thisOrder['time'])."订购项目如下：";
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
				$products=$this->product_model->where(array('id'=>array('in',$ids)))->select();
			}
			if ($products){
				$i=0;
				foreach ($products as $p){
					$products[$i]['count']=$carts[$p['id']]['count'];
					$str.=$p['name']."  ".$products[$i]['count']."份  单价：".$p['price']."元";
					$i++;
				}
			}
			$str.="合计：".$thisOrder['price']."元";
			return $str;
		}else {
			return '';
		}
	}
	public function sms(){
		$where['token']=$this->token;
		$where['wecha_id']=$this->wecha_id;
		$where['printed']=0;
		$this->product_cart_model=M('product_cart');
		$count      = $this->product_cart_model->where($where)->count();
		$orders=$this->product_cart_model->where($where)->order('time DESC')->limit(0,1)->select();
		$now=time();
		if ($orders){
			$thisOrder=$orders[0];
			switch ($thisOrder['diningtype']){
				case 0:
					$orderType='购物';
					break;
				case 1:
					$orderType='点餐';
					break;
				case 2:
					$orderType='外卖';
					break;
				case 3:
					$orderType='预定餐桌';
					break;
			}
			//订餐信息
			$product_diningtable_model=M('product_diningtable');
			if ($thisOrder['tableid']) {
				$thisTable=$product_diningtable_model->where(array('id'=>$thisOrder['tableid']))->find();
				$thisOrder['tableName']=$thisTable['name'];
			}else{
				$thisOrder['tableName']='未指定';
			}
			$str="<includetail><div style='border-bottom:3px solid #d9d9d9; background:url(http://exmail.qq.com/zh_CN/htmledition/images/domainmail/bizmail_bg.gif) repeat-x 0 1px;'><div style='border:1px solid #c8cfda; padding:10px;'><p style='margin:0 0 35px;'>亲爱的商户：<br>以下是客户在你在微信平台下的新订单哦：</p>订单类型：".$orderType."\r\n<br>订单编号：".$thisOrder['id']."\r\n<br>姓名：".$thisOrder['truename']."\r\n<br>电话：".$thisOrder['tel']."\r\n<br>地址：".$thisOrder['address']."\r\n<br>桌台：".$thisOrder['tableName']."\r\n<br>下单时间：".date('Y-m-d H:i:s',$thisOrder['time'])."\r\n<h3 style='font-weight:bold;font-size:14px;'>订购项目如下</h3>";
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
				$products=$this->product_model->where(array('id'=>array('in',$ids)))->select();
			}
			if ($products){
				$i=0;
				foreach ($products as $p){
					$products[$i]['count']=$carts[$p['id']]['count'];
					$str.=$p['name']."  ".$products[$i]['count']."份  单价：".$p['price']."元\r\n<br>";
					$i++;
				}
			}
			$str.="合计：<font color='#ff0000'>".$thisOrder['price']."</font>元<div style='color:#666;border-top:1px solid #ccc;padding:10px 0;font-size:12px;margin:20px 0;'>
<div>请尽快登入微信平台进行信息处理</div>
</div></div></div></includetail>";
			return $str;
		}else {
			return '';
		}
	}

	//增加sms内容止//
	//购物车结算页面
	public function orderCart() {
		if (empty($this->wecha_id)) {
			unset($_SESSION[$this->session_cart_name]);
		}
		//查看是否支持货到付款
		$setting = M('Product_setting')->where(array('token' => $this->token))->find();
		$this->assign('setting', $setting);
		//是否要支付
		$alipayConfig = M('Alipay_config')->where(array('token' => $this->token))->find();
		$this->assign('alipayConfig', $alipayConfig);

		$totalCount = $totalFee = 0;
		$data = $this->getCat($this->_getCart());
		if (empty($data[0])) {
			$this->redirect(U('Store/cart', array('token' => $this->token, 'wecha_id' => $this->wecha_id)));
		}
		if (isset($data[1])) {
			foreach ($data[1] as $pid => $row) {
				$totalCount += $row['total'];        //购买总数量
				$totalFee += $row['totalPrice'];     //购买总价
			}
		}
		if (empty($totalCount)) {
			$this->error('没有购买商品!', U('Store/cart', array('token' => $this->token, 'wecha_id' => $this->wecha_id)));
		}
		// 查询当前经纪人拥有的积分
		$jjrinfo=D("jjr")->where(array('Token'=>$this->token,'Wecha_id'=>$this->wecha_id))->field("ID,Token,Wecha_id,credit")->find();
		
		//查询当前经纪人的总佣金
		$where['token']=$this->token;
		$where['wecha_id']=$this->wecha_id;
		$where['rewardstatus']=0;
		$rewardall=D("agent_rewardinfo")->where($where)->sum("rewardamount");
		//查询当前经纪人的不可使用佣金
		$where['rewardstatus']=array("in","-1,1,2");
		$rewardbk=D("agent_rewardinfo")->where($where)->sum("rewardamount");
		$total=floor(($rewardall-$rewardbk)*10)/10;
		$rewardamount=sprintf( "%.1f ",(float)$total);
		$list = $data[0];

		$this->assign('products', $list);
		$this->assign('totalFee', $totalFee);
		$this->assign('totalCount', $totalCount);
		$this->assign('jjrinfo', $jjrinfo);
		$this->assign('rewardamount', $rewardamount);
		$this->assign('mailprice', $data[2]);
		$this->assign('metaTitle', '购物车结算');
		$this->display();
	}
	
	public function my(){
		$offset = 5;
		$page = isset($_GET['page']) ? max(intval($_GET['page']), 1) : 1;
		$start = ($page - 1) * $offset;
		$product_cart_model = M('product_cart');
		$orders = $product_cart_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id, 'groupon' => 0))->limit($start, $offset)->order('time DESC')->select();
		$count = $product_cart_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id, 'groupon' => 0))->count();
		$list = array();
		if ($orders){
			foreach ($orders as $o){
				$products = unserialize($o['info']);
				$pids = array_keys($products);
				$o['productInfo'] = array();
				if ($pids) {
					$o['productInfo'] = M('product')->where(array('id' => array('in', $pids)))->select();
				}
				$list[] = $o;
			}
		}
		$totalpage = ceil($count / $offset);
		$this->assign('orders', $list);
		$this->assign('ordersCount', $count);
		$this->assign('totalpage', $totalpage);
		$this->assign('page', $page);
		$this->assign('metaTitle', '我的订单');
		
		//是否要支付
		$alipayConfig = M('Alipay_config')->where(array('token' => $this->token))->find();
		$this->assign('alipayConfig',$alipayConfig);
		$this->display();
	}
	
	public function myDetail(){
		$cartid = isset($_GET['cartid']) && intval($_GET['cartid'])? intval($_GET['cartid']) : 0;
		$product_cart_model = M('product_cart');

		$list = array();
		if ($cartObj = $product_cart_model->where(array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'id' => $cartid))->find()){
			$products = unserialize($cartObj['info']);
			$data = $this->getCat($products);
			$pids = array_keys($products);
			$cartObj['productInfo'] = array();
			if ($pids) {
				$cartObj['productInfo'] = M('product')->where(array('id' => array('in', $pids)))->select();
			}
			
			$totalCount = $totalFee = 0;
			if (isset($data[1])) {
				foreach ($data[1] as $pid => $row) {
					$totalCount += $row['total'];
					$totalFee += $row['totalPrice'];
				}
			}
			$list = $data[0];
			$this->assign('products', $list);
			$this->assign('totalFee', $totalFee);
			$this->assign('totalCount', $totalCount);
			$this->assign('mailprice', $data[2]);
			$this->assign('cartData', $cartObj);
			$this->assign('cartid', $cartid);
		}
		$this->assign('metaTitle', '我的订单');
		$this->display();
	}
	
	public function cancelCart(){
		$cartid = isset($_GET['cartid']) && intval($_GET['cartid'])? intval($_GET['cartid']) : 0;
		$product_model=M('product');
		$product_cart_model = M('product_cart');
		$product_cart_list_model = M('product_cart_list');
		$thisOrder = $product_cart_model->where(array('id'=> $cartid))->find();
		if (empty($thisOrder)) {
			exit(json_encode(array('error_code' => true, 'msg' => '没有此订单')));
		}
		$id = $thisOrder['id'];
		if (empty($thisOrder['paid'])) {
			//删除佣金明细
			$cart=$product_cart_model->field("rid,xmid")->where(array('id' => $id))->find();
			$rid=intval($cart['rid']);
			$xmid=intval($cart['xmid']);
			if($rid){
				D("agent_rewardinfo")->where(array('id' => $rid))->delete();
			}
			//删除积分明细
			if($xmid){
				$xmfx=D("xmfx")->field("jid,hascredit")->where(array('id' => $xmid))->find();
				$jid=$xmfx['jid'];                //需要退回积分人的id
				$hascredit=$xmfx['hascredit'];   //需要退回的积分
				D("xmfx")->where(array('id' => $xmid))->delete();
				D("jjr")->where(array("ID"=>$jid))->setInc("credit",$hascredit);
			}
			
			//删除订单和订单列表
			$product_cart_model->where(array('id' => $cartid))->delete();
			$product_cart_list_model->where(array('cartid' => $cartid))->delete();
			
			//还原积分
			$userinfo_model = M('Userinfo');
			$thisUser = $userinfo_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
			$userinfo_model->where(array('id' => $thisUser['id']))->setInc('total_score', $thisOrder['score']);
			F('fans_token_wechaid', NULL);
			//商品销量做相应的减少
			$carts = unserialize($thisOrder['info']);
			//还原库存
			foreach ($carts as $pid => $rowset) {
				$total = 0;
				if (is_array($rowset)) {
					foreach ($rowset as $did => $row) {
						M('product_detail')->where(array('id' => $did, 'pid' => $pid))->setInc('num', $row['count']);
						$total += $row['count'];
					}
				} else {
					$total = $rowset;
				}
				$product_model->where(array('id' => $pid))->setInc('num', $total);
				$product_model->where(array('id' => $pid))->setDec('salecount', $total);
			}
			exit(json_encode(array('error_code' => false, 'msg' => '订单取消成功')));
		}
		exit(json_encode(array('error_code' => true, 'msg' => '购买成功的订单不能取消')));
	}
	
	public function updateOrder(){
		$product_cart_model = M('product_cart');
		$thisOrder = $product_cart_model->where(array('id'=>intval($_GET['id'])))->find();
		//检查权限
		if ($thisOrder['wecha_id']!=$this->wecha_id){
			exit();
		}
		$this->assign('thisOrder',$thisOrder);
		$carts = unserialize($thisOrder['info']);
		$totalCount = $totalFee = 0;
		$listNum = array();
		$data = $this->getCat($carts);
		if (isset($data[1])) {
			foreach ($data[1] as $pid => $row) {
				$totalCount += $row['total'];
				$totalFee += $row['totalPrice'];
				$listNum[$pid] = $row['total'];
			}
		}
		$list = $data[0];
		$this->assign('products', $list);
		$this->assign('totalFee', $totalFee);
		$this->assign('listNum', $listNum);
		$this->assign('metaTitle','修改订单');
		//是否要支付
		$alipayConfig = M('Alipay_config')->where(array('token' => $this->token))->find();
		$this->assign('alipayConfig', $alipayConfig);
		$this->display();
	}
	public function deleteOrder(){
		$product_model=M('product');
		$product_cart_model=M('product_cart');
		$product_cart_list_model=M('product_cart_list');
		$thisOrder=$product_cart_model->where(array('id'=>intval($_GET['id'])))->find();
		//检查权限
		$id=$thisOrder['id'];
		if ($thisOrder['wecha_id']!=$this->wecha_id||$thisOrder['handled']==1){
			exit();
		}
		//删除订单和订单列表
		$product_cart_model->where(array('id'=>$id))->delete();
		$product_cart_list_model->where(array('cartid'=>$id))->delete();
		//商品销量做相应的减少
		$carts=unserialize($thisOrder['info']);
		foreach ($carts as $k=>$c){
			if (is_array($c)){
				$productid=$k;
				$price=$c['price'];
				$count=$c['count'];
				$product_model->where(array('id'=>$k))->setDec('salecount',$c['count']);
			}
		}
		$this->redirect(U('Store/my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
	}
	
	/**
	 * 支付成功后的回调函数
	 */
	public function payReturn() {
	   $orderid = $_GET['orderid'];
	   if ($order = M('Product_cart')->where(array('orderid' => $orderid, 'token' => $this->token))->find()) {
			//TODO 发货的短信提醒
			if ($order['paid']) {
				$userInfo = D('Userinfo')->where(array('token' => $this->token, 'wecha_id' => $this->wecha_id))->find();
				Sms::sendSms($this->token, "您的顾客{$userInfo['truename']}刚刚对订单号：{$orderid}的订单进行了支付，请您注意查看并处理");
			}
			$this->redirect(U('Store/my',array('token' => $this->token,'wecha_id' => $this->wecha_id)));
	   }else{
	      exit('订单不存在');
	    }
	}

	//处理分享信息
	public function getToken($url){
        $ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  
		//相当关键，这句话是让curl_exec($ch)返回的结果可以进行赋值给其他的变量进行，json的数据操作，如果没有这句话，则curl返回的数据不可以进行人为的去操作（如json_decode等格式操作）
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
		return curl_exec($ch); 
		//$row=curl_getinfo($ch, CURLINFO_HTTP_CODE);
	}

	public function test(){
		// unset($_SESSION['uniqueinfo']);
		// if(!$_SESSION['uniqueinfo']){
		// 	// $_SESSION['uniqueinfo']=time();
		// 	if(!isset($_GET['state'])){
		// 		$getarr1=strtr($_SERVER['QUERY_STRING'], "&", ",");
		// 		$getarr=strtr($getarr1, "=", "|");
		// 		header("Location:http://weixin.zoyomei.com/index.php?g=Wap&m=Agent&a=storeinfo&storeinfo=$getarr");
		// 	}else{
		// 		//已登录后详情页
		// 		$state=$_GET['state'];  //传递过来的信息
		// 		$statearr=explode(",", $state);
		// 		foreach ($statearr as $val) {
		// 			$valarr=explode("|", $val);
		// 			$_GET[$valarr[0]]=$valarr[1];
		// 		}
		// 		$code=$_GET['code'];
		// 		$appid="wxe9501094aff155d1";
		// 		$secret ="db0b42b92743a3a40f4d6e43697889c9";
		// 		$get_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
		// 		$abc=$this->getToken($get_token_url);
		// 		$json=json_decode($abc);
		// 		if(is_object($json)){
		// 			$json=(array)$json;
		// 		}
		// 		// $_GET['wecha_id']=$_GET['wecha_id']?$_GET['wecha_id']:$json['openid']; //浏览者wecha_id
		// 	$_GET['nowwecha_id']=$json['openid'];
		// 	}
		// }
		// var_dump($_GET);
	}
}

?>