<?php
class Printer_printAction extends BaseAction{
	public $printer_bind_db;
	public $product_cart_db;
	public $product_db;
	public function _initialize() {
		parent::_initialize();
		$this->printer_bind_db=M('Dining_company');
		$this->product_cart_db=M('Product_cart');
		$this->product_db=M('Dining');
	}
	public function index(){
		//echo ;
		$code = $this->_get('pid');

		if(!$code){
			echo "MSGBEGIN[机器码为空]MSGEND";
			exit;
		}

		$dining_com = $this->printer_bind_db->where(array('code'=>$code))->find();

		if(!$dining_com['token'] || !$dining_com['id']){
			echo 'MSGBEGIN[找不到'.$code.'对应商家]MSGEND';
			exit;
		}

		$token = $dining_com['token'];
		$setid = $dining_com['id'];

		$order = $this->product_cart_db->where(array('token'=>$token,'setid'=>$setid,'printed'=>0))->find();
		
		if (!$order) {
			echo 'NOMSG没有订单';
			exit;
			// $data['print'] = 0;//订单关闭控制字段
	        //$result = M('Product_cart')->where(array('print'=>1))->save($data);//更新字段，关闭订单
		}
	
			$info=unserialize($order['info']);
			$id = array_keys($info);
			$msg='MSGBEGIN产品数量：';

			foreach ($id as $o){
				$products=$this->product_db->where(array('id'=>$o))->find();//产品列表
				$msg=$msg.chr(10).$products['name'].'('.$info[$o]['price'].'x'.$info[$o]['count'].')';
			}


			   if ($order['paid'])
				   $pay = '已支付';
			   else
				   $pay = '未支付';

			   if ($order['diningtype']==1)
				   $type = '点餐';

			   if ($order['diningtype']==2)
				   $type = '外卖';

			   if ($order['diningtype']==3)
				   $type = '预定';

	           $msg=$msg.
				     chr(10).'订单类型：'.$type.
	                 chr(10).'状态：'.$pay.
                     chr(10).'总数：'.$order['total'].
					 chr(10).'总价：'.$order['price'].
                     chr(10).'客户：'.$order['truename'].
                     chr(10).'电话：'.$order['tel'].
                     chr(10).'地址：'.$order['address'].
                     chr(10).'下单时间：'.date('m-d H:i:s',$order['time']).
                     chr(10).'就餐时间：'.$order['buytime'];
					
			   		echo $msg;
	            $data['printed'] = 1;//订单关闭控制字段
	            $result = $this->product_cart_db->where(array('id'=>$order['id']))->save($data);//更新字段，关闭订单
                if ($result) {
		            echo chr(10).'MSGEND';//关闭成功
                } else {
					echo chr(10).'订单处理失败MSGEND';
				}
		

	}
}


?>
