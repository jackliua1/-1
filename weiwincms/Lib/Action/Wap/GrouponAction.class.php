<?php

class GrouponAction extends ProductAction{

	public $token;

	public $wecha_id;

	public $product_model;

	public $product_cat_model;

	public $isDining;

	public $tplid;

	public $pageSize;

	public function __construct(){

		parent::__construct();

		$this->pageSize=8;

		$grouponConfig=F('grouponConfig'.$this->token);

		$grouponDetailConfig=unserialize($grouponConfig['config']);

		$this->tplid=intval($grouponDetailConfig['tplid']);

		$this->assign('pageSize',$this->pageSize);

		$this->assign('wecha_id',$this->_get('wecha_id'));

	}

	

	public function grouponIndex(){

		$where=array('token'=>$this->token,'groupon'=>1);

		$where['endtime']=array('gt',time());

		if (isset($_GET['catid'])){

			$catid=intval($_GET['catid']);

			$where['catid']=$catid;

			

			$thisCat=$this->product_cat_model->where(array('id'=>$catid))->find();

			$this->assign('thisCat',$thisCat);

		}

		if (IS_POST){

			$key = $this->_post('search_name');

            $this->redirect('?g=Wap&m=Groupon&a=grouponIndex&token='.$this->token.'&keyword='.$key);

		}

		if (isset($_GET['keyword'])){

            $where['name|intro|keyword'] = array('like',"%".$_GET['keyword']."%");

            $this->assign('isSearch',1);

		}

		$count = $this->product_model->where($where)->count();

		$this->assign('count',$count); 

		//排序方式

		$method=isset($_GET['method'])&&($_GET['method']=='DESC'||$_GET['method']=='ASC')?$_GET['method']:'DESC';

		$orders=array('time','discount','price','salecount');

		$order=isset($_GET['order'])&&in_array($_GET['order'],$orders)?$_GET['order']:'time';

		$this->assign('order',$order);

		$this->assign('method',$method);

		//

        	

		$products = $this->product_model->where($where)->order($order.' '.$method)->limit($this->pageSize)->select();

		$now=time();

		$i=0;

		if ($products){

			foreach ($products as $p){

				$products[$i]['new']=0;

				if ($now-$p['time']<3*24*3600){

					$products[$i]['new']=1;

				}

				$i++;

			}

		}

		$this->assign('products',$products);

		$this->assign('metaTitle','团购');

		$this->display('grouponIndex_'.$this->tplid);

	}

	public function ajaxGrouponProducts(){

		$where=array('token'=>$this->token,'groupon'=>1);

		$page=isset($_GET['page'])&&intval($_GET['page'])>1?intval($_GET['page']):2;

		$pageSize=isset($_GET['pagesize'])&&intval($_GET['pagesize'])>1?intval($_GET['pagesize']):$this->pageSize;

		$start=($page-1)*$pageSize;

		//排序方式

		$method=isset($_GET['method'])&&($_GET['method']=='DESC'||$_GET['method']=='ASC')?$_GET['method']:'DESC';

		$method=$method=='ASC'?'DESC':'ASC';

		$orders=array('time','discount','price','salecount');

		$order=isset($_GET['order'])&&in_array($_GET['order'],$orders)?$_GET['order']:'time';

		//

		$products = $this->product_model->where($where)->order($order.' '.$method)->limit($start.','.$pageSize)->select();

		/*

		$now=time();

		$i=0;

		if ($products){

			foreach ($products as $p){

				$products[$i]['new']=0;

				if ($now-$p['time']<3*24*3600){

					$products[$i]['new']=1;

				}

				$i++;

			}

		}

		*/

		$str='{"products":[';

		if ($products){

			$comma='';

			foreach ($products as $p){

				$membercount=intval($p['salecount'])+intval($p['fakemembercount']);

				$str.=$comma.'{"id":"'.$p['id'].'","catid":"'.$p['catid'].'","storeid":"'.$p['storeid'].'","name":"'.$p['name'].'","price":"'.$p['price'].'","token":"'.$p['token'].'","keyword":"'.$p['keyword'].'","salecount":"'.$p['salecount'].'","logourl":"'.$p['logourl'].'","time":"'.$p['time'].'","oprice":"'.$p['oprice'].'","fakemembercount":"'.$p['fakemembercount'].'","membercount":"'.$membercount.'","enddate":"'.date('Y-m-d',$p['endtime']).'"}';

				$comma=',';

			}

		}

		$str.=']}';

		$this->show($str);

	}

	public function product(){

		$where=array('token'=>$this->token);

		if (isset($_GET['id'])){

			$id=intval($_GET['id']);

			$where['id']=$id;

		}

		$product=$this->product_model->where($where)->find();

		$this->assign('product',$product);

		if ($product['endtime']){

			$leftSeconds=intval($product['endtime']-time());

			$this->assign('leftSeconds',$leftSeconds);

		}

		$this->assign('metaTitle',$product['name']);

		$product['intro'] = str_replace(array('&lt;','&gt;','&quot;','&amp;nbsp;'),array('<','>','"',' '), $product['intro']);
		$intro =$product['intro'];
		//$intro = mb_substr($intro, 0, 30,'utf-8');
		$this->assign('intro',$intro);

		//店铺信息

		$company_model=M('Company');

		$where=array('token'=>$this->token);

		$thisCompany=$company_model->where($where)->find();

		$this->assign('thisCompany',$thisCompany);

		//分店信息

		$branchStoreCount=$company_model->where(array('token'=>$this->token,'isbranch'=>1))->count();

		$this->assign('branchStoreCount',$branchStoreCount);

		//销量最高的商品

		$sameCompanyProductWhere=array('token'=>$this->token,'id'=>array('neq',$product['id']));

		if ($product['dining']){

			$sameCompanyProductWhere['dining']=1;

		}

		if ($product['groupon']){

			$sameCompanyProductWhere['groupon']=1;

		}

		if (!$product['groupon']&&!$product['dining']){

			$sameCompanyProductWhere['groupon']=array('neq',1);

			$sameCompanyProductWhere['dining']=array('neq',1);

		}

		$products=$this->product_model->where($sameCompanyProductWhere)->limit('salecount DESC')->limit('0,5')->select();

		$this->assign('products',$products);

		$this->display('product_'.$this->tplid);

	}

	public function my(){

		$product_cart_model=M('product_cart');

		//$this->wecha_id

		$orders=$product_cart_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->order('time DESC')->select();

		$unpaidCount=0;

		$unusedCount=0;

		if ($orders){

			foreach ($orders as $o){

				$products=unserialize($o['info']);

				//$firstProductID=$products

				if (!$o['paid']){

					$unpaidCount++;

				}

				if (!$o['used']){

					$unusedCount++;

				}

			}

		}

		$this->assign('orders',$orders);

		$this->assign('unpaidCount',$unpaidCount);

		$this->assign('unusedCount',$unusedCount);

		$this->assign('ordersCount',count($orders));

		$this->assign('metaTitle','我的订单');

		//

		//是否要支付

		$alipay_config_db=M('Alipay_config');

		$alipayConfig=$alipay_config_db->where(array('token'=>$this->token))->find();

		$this->assign('alipayConfig',$alipayConfig);

		//

		$this->assign('hideTopButton',1);

		$this->display('my_'.$this->tplid);

	}

	public function myOrders(){

		//是否要支付

		$alipay_config_db=M('Alipay_config');

		$alipayConfig=$alipay_config_db->where(array('token'=>$this->token))->find();

		$this->assign('alipayConfig',$alipayConfig);

		//

		$where=array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'groupon'=>1);

		if (isset($_GET['used'])){

			if (intval($_GET['used'])==1){

				$title='已使用团购';

			}else {

				$title='未使用团购';

			}

			$where['handled']=intval($_GET['used']);

		}elseif (isset($_GET['paid'])){

			$title='待付款订单';

			$where['paid']=intval($_GET['paid']);

		}else{

			$title='全部订单';

		}

		$this->assign('title',$title);

		$product_cart_model=M('product_cart');

		//$this->wecha_id

		$orders=$product_cart_model->where($where)->order('time DESC')->select();

		//

		$productsIDs=array();

		if ($orders){

			foreach ($orders as $o){

				array_push($productsIDs,$o['productid']);

			}

		}

		if ($productsIDs){

		$products=M('Product')->where(array('id'=>array('in',$productsIDs)))->select();

		}

		//

		$productsByID=array();

		if ($products){

			foreach ($products as $p){

				$productsByID[$p['id']]=$p;

			}

		}

		if ($orders){

			$i=0;

			foreach ($orders as $o){

				$orders[$i]['logourl']=$productsByID[$o['productid']]['logourl'];

				$orders[$i]['productName']=$productsByID[$o['productid']]['name'];

				//$orders[$i]['productPrice']=$productsByID[$o['productid']]['price'];

				if (!$o['paid']&&$alipayConfig&&!$o['handled']){

					$orders[$i]['needPay']=1;

				}else {

					$orders[$i]['needPay']=0;

				}

				$i++;

			}

		}

		//

		$this->assign('orders',$orders);

		$this->assign('unpaidCount',$unpaidCount);

		$this->assign('unusedCount',$unusedCount);

		$this->assign('ordersCount',count($orders));

		$this->assign('metaTitle','我的订单');

		//

		

		//

		$this->assign('hideTopButton',1);

		$this->display('myOrders_'.$this->tplid);

	}

	public function search(){

		$this->display('search_'.$this->tplid);

	}

	public function orderCart(){

		$userinfo_model=M('Userinfo');

		$thisUser=$userinfo_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();

		$this->assign('thisUser',$thisUser);

		//是否要支付

		$alipay_config_db=M('Alipay_config');

		$alipayConfig=$alipay_config_db->where(array('token'=>$this->token))->find();

		$this->assign('alipayConfig',$alipayConfig);

		//

		if (IS_POST){

			$row=array();



			$orderid=$this->wecha_id.time();

			$row['orderid']=$orderid;

			$orderid=$row['orderid'];

			//

			$row['truename']=$this->_post('truename');

			$row['tel']=$this->_post('tel');

			$row['address']=$this->_post('address');





			$row['token']=$this->token;

			$row['wecha_id']=$this->wecha_id;

			if (!$row['wecha_id']){

				$row['wecha_id']='null';

			}

			$time=time();

			$row['time']=$time;

			//分别加入3类订单

			$product_cart_model=M('product_cart');

			$row['total']=intval($_POST['quantity']);

			$row['price']=$row['total']*intval($_POST['price']);

			$row['diningtype']=0;

			$row['productid']=intval($_POST['productid']);

			$row['code']=substr($row['wecha_id'],0,6).$time;

			$row['tableid']=0;

			$row['info']=serialize(array(intval($_POST['productid'])=>array('count'=>$row['total'],'price'=>intval($_POST['price']))));

			$row['groupon']=1;

			$row['dining']=0;

			$product_cart_model->add($row);

			//。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。



			$product_model=M('product');

			$product_cart_list_model=M('product_cart_list');

			$product_model->where(array('id'=>intval($_POST['productid'])))->setInc('salecount',$_POST['quantity']);

			//保存个人信息

			if ($_POST['saveinfo']){

				$userRow=array('tel'=>$row['tel'],'truename'=>$row['truename'],'address'=>$row['address']);

				if ($thisUser){

					$userinfo_model->where(array('id'=>$thisUser['id']))->save($userRow);

				}else {

					$userRow['token']=$this->token;

					$userRow['wecha_id']=$this->wecha_id;

					$userRow['wechaname']='';

					$userRow['qq']=0;

					$userRow['sex']=-1;

					$userRow['age']=0;

					$userRow['birthday']='';

					$userRow['info']='';

					//

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

			if ($alipayConfig['open']){

				$this->redirect(U('Alipay/pay',array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'success'=>1,'price'=>$row['price'],'orderName'=>$orderName,'orderid'=>$orderid)));

			}else {

				$this->redirect(U('Groupon/my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'success'=>1)));

			}

		}else {

			$where=array('token'=>$this->token);

			if (isset($_GET['id'])){

				$id=intval($_GET['id']);

				$where['id']=$id;

			}

			$product=$this->product_model->where($where)->find();

			$this->assign('product',$product);

			$this->display('orderCart_'.$this->tplid);

		}

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

		//

		//删除订单和订单列表

		$product_cart_model->where(array('id'=>$id))->delete();

		$product_cart_list_model->where(array('cartid'=>$id))->delete();

		//商品销量做相应的减少

		$product_model->where(array('id'=>$k))->setDec('salecount',$thisOrder['total']);

		$this->redirect($_SERVER['HTTP_REFERER']);

	}

	public function orderDetail(){

		//是否要支付

		$alipay_config_db=M('Alipay_config');

		$alipayConfig=$alipay_config_db->where(array('token'=>$this->token))->find();

		$this->assign('alipayConfig',$alipayConfig);

		//

		$product_cart_model=M('product_cart');

		$thisOrder=$product_cart_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'id'=>intval($_GET['id'])))->find();



		//

		$product_model=M('product');

		$thisProduct=$product_model->where(array('id'=>$thisOrder['productid']))->find();

		$this->assign('thisProduct',$thisProduct);

		//

		if (!$thisOrder['paid']&&$alipayConfig&&!$thisOrder['handled']){

			$thisOrder['needPay']=1;

		}else {

			$thisOrder['needPay']=0;

		}

		$this->assign('thisOrder',$thisOrder);

		$this->assign('hideTopButton',1);

		//

		$this->display('orderDetail_'.$this->tplid);

	}

	public function company($display=1){

		//店铺信息

		$company_model=M('Company');

		$where=array('token'=>$this->token);

		if (isset($_GET['companyid'])){

			$where['id']=intval($_GET['companyid']);

		}

		

		$thisCompany=$company_model->where($where)->find();

		$this->assign('thisCompany',$thisCompany);

		//分店信息

		$branchStores=$company_model->where(array('token'=>$this->token,'isbranch'=>1))->order('taxis ASC')->select();

		$branchStoreCount=count($branchStores);

		$this->assign('branchStoreCount',$branchStoreCount);

		$this->assign('branchStores',$branchStores);

		$this->assign('metaTitle','公司信息');

		if($display){

			$this->display('company_'.$this->tplid);

		}

	}

	public function companyMap(){

		$this->apikey=C('baidu_map_api');

		$this->assign('apikey',$this->apikey);

		$this->company(0);

		$this->assign('hideTopButton',1);

		$this->display('companyMap_'.$this->tplid);

	}

	public function handle(){

		$product_cart_model=M('product_cart');

		if (IS_POST){

			$staff_db=M('Company_staff');

			$thisStaff=$staff_db->where(array('username'=>$this->_post('username'),'token'=>$this->_get('token')))->find();

			if (!$thisStaff){

				echo'{"success":-4,"msg":"用户名和密码不匹配"}';

				exit();

			}else {

				if (md5($this->_post('password'))!=$thisStaff['password']){

					echo'{"success":-4,"msg":"用户名和密码不匹配"}';

					exit();

				}else {

					$now=time();

					$arr['handleduid']=$thisStaff['id'];

					$arr['handledtime']=$time;

					$arr['handled']=1;

					$arr['sent']=1;

					//

					$product_cart_model->where(array('id'=>intval($_POST['id'])))->save($arr);

					echo'{"success":1,"msg":"处理成功"}';

					exit();

				}

			}

			//

		}else{

			//是否要支付

			$alipay_config_db=M('Alipay_config');

			$alipayConfig=$alipay_config_db->where(array('token'=>$this->token))->find();

			$this->assign('alipayConfig',$alipayConfig);

			//

			

			$thisOrder=$product_cart_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'id'=>intval($_GET['id'])))->find();



			//

			$product_model=M('product');

			$thisProduct=$product_model->where(array('id'=>$thisOrder['productid']))->find();

			$this->assign('thisProduct',$thisProduct);

			//

			if (!$thisOrder['paid']&&$alipayConfig&&!$thisOrder['handled']){

				$thisOrder['needPay']=1;

			}else {

				$thisOrder['needPay']=0;

			}

			$this->assign('thisOrder',$thisOrder);

			$this->assign('hideTopButton',1);

			$this->display('handle_'.$this->tplid);

		}

	}

}

	

?>