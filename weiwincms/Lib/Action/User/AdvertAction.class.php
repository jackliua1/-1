<?php
//广告管理模块
class AdvertAction extends UserAction{
	public $token;
	public $school_province;
	public $school_city;
	public $school_area;
	public $school_name;
	
	public function _initialize() {
		
		parent::_initialize();
 	// 	$token_open=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();
		
		// if(!strpos($token_open['queryname'],'Education')){
  //           	$this->error('您还开启该模块的使用权,请到功能模块中添加',U('Function/index',array('token'=>session('token'),'id'=>session('wxid'))));
		// } 
		// $this->school_province=M('school_province');
		// $this->school_city=M('school_city');
		// $this->school_area=M('school_area');
		// $this->school_name=M('school_name');
		$this->token=session('token');
		$this->assign('token',$this->token);
	}

	//===========广告设置页列表================================
	public function index(){

		//三表联查,查询该token帐号下的教师对应的班级信息及校区
		$fix = C("DB_PREFIX");
		$product = $fix . "product";
		$advert = $fix."advert";
		$where = array('token'=>$this->token);
				
		$page_size = 15; //每页显示记录数
		$record_sum = count(M("advert")-> where($where) -> select() );//记录总数
				
		$Page = new Page($record_sum, $page_size, 5);
		$list = M("product") -> field( "$product.name as pname,$advert.id,$advert.advertname,$advert.sort" )->join("inner join $advert on $product.id=$advert.pid" )->where("$product.token='$this->token'")->order("$advert.sort") ->limit($Page->firstRow.",".$Page->listRows) ->select();
		$show = $Page -> show();
		$this -> assign( "page", $show); //输出分页
		$this->assign('list',$list);
		$this->display();
	}
	public function advertAdd(){ 
		if(IS_POST){

			$this->insert('advert','/index?token='.$this->token);
		}else{
			$products=M("product_cat")->where(array("token"=>$this->token,'parentid'=>0))->field("id,name")->select();
			$this->assign('products',$products);
			$this->assign('token',$this->token);
			$this->display('advertSet');
		}
	}

	
	
	public function advertSet(){
        $id = intval($this->_get('id')); 
		$checkdata = M('advert')->where(array('id'=>$id))->find();
		if(empty($checkdata)){
            $this->error("没有相应记录.您现在可以添加.",U('Advert/advertAdd'));
        }
		if(IS_POST){
            $where=array('id'=>$this->_post('id'));
            $thisInput=M("advert")->where($where)->find();
            
			if(M("advert")->create()){
			$rt=M("advert")->where($where)->save($_POST);
				if($rt){
					$this->success('修改成功',U('Advert/index',array('token'=>$this->token)));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error(M("advert")->getError());
			}
		}else{
			$this->assign('isUpdate',1);
			
			$this->assign('set',$checkdata);
			//查找商品信息；
			$products=M("product_cat")->where(array("token"=>$this->token,'parentid'=>0))->field("id,name")->select();
			$this->assign('products',$products);
			$catid=$checkdata['pcid'];
			$product=M("product")->where(array("token"=>$this->token,'parentid'=>0,'catid'=>$catid))->field("id,name")->select();
			$this->assign('product',$product);
			
			$this->display("advertSet");	
		
		}
	}
	public function advertDelete(){
		$id = intval($this->_get('id'));
		$where=array('id'=>$id);
		$thisInput=M("advert")->where($where)->find();

		if ($thisInput['token']!=$this->token){
			exit();
		}
		$back=M("advert")->where($where)->delete();
		if($back==true){
			$this->success('操作成功',U('Advert/index',array('token'=>$this->token)));
		}else{
			$this->error('服务器繁忙,请稍后再试',U('Advert/index',array('token'=>$this->token)));
		}
	}
	//==================省份选项========================
	public function provincechoose($province=''){
		$where=array('token'=>$this->token);
		//查找省份信息；
		$provinceinfo = $this->school_province -> where($where)->select();

		$empty = array(array('id'=>'','token'=>'','proname'=>'请选择'));
		$options = array_merge($empty,$provinceinfo);
		
		$str='';
	
		foreach ($options as $o){
			$selectedStr='';
			if ($province==$o['id']){
				$selectedStr=' selected';
			}
			$str.='<option value="'.$o['id'].'"'.$selectedStr.'>'.$o['proname'].'</option>';
		}
	return $str;
	
	}
//==================城市选项========================	
	public function citychoose($province='',$city=''){
		if($province){
			$where=array('token'=>$this->token,'pid'=>$province);
		}else{
			$where=array('token'=>$this->token);
		}

		//查找城市信息；
		$cityinfo = $this->school_city -> where($where)->select();

		$empty = array(array('id'=>'','token'=>'','citname'=>'请选择'));
		$options = array_merge($empty,$cityinfo);
		
		$str='';
		
		foreach ($options as $o){
			$selectedStr='';
			if ($city==$o['id']){
				$selectedStr=' selected';
			}
			$str.='<option value="'.$o['id'].'"'.$selectedStr.'>'.$o['citname'].'</option>';
		}
		
	return $str;
	
	}
	//==================通过类别选择商品========================	
	public function productChange($pcid=''){
		if($pcid){
			$where=array('token'=>$this->token,'catid'=>$pcid);
		}else{
			$where=array('token'=>$this->token);
		}

		//查找城市信息；
		$pinfo = M("product")-> where($where)->select();
		//print_r($classinfo);die;
		$this -> ajaxReturn($pinfo, 'JSON');
	
	}
	
}
?>