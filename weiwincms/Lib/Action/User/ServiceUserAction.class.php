<?php
class ServiceUserAction extends UserAction{
    public $token;
    private $data;
    private $openid;
    public function _initialize(){
        parent :: _initialize();
        $this -> openid = $this -> _get('openid', 'htmlspecialchars');
        if($this -> openid == false){
        }
        $this -> token = session('token');
        $this -> data = D('Service_user');
    }
    public function wechatService(){
        if (IS_POST){
            D('Wxuser') -> where(array('token' => $this -> token)) -> save(array('transfer_customer_service' => intval($_POST['transfer_customer_service'])));
            S('wxuser_' . $this -> token, NULL);
            $this -> success('设置成功');
        }else{
            $this -> wxuser = S('wxuser_' . $this -> token);
            if (!$this -> wxuser){
                $this -> wxuser = D('Wxuser') -> where(array('token' => $this -> token)) -> find();
                S('wxuser_' . $this -> token, $this -> wxuser);
            }
            $this -> assign('info', $this -> wxuser);
            $this -> display();
        }
    }

    //查询非导入客户的信息
    public function index(){
        $kh=D('kh');
        $token=session('token');
        $where['Token']=$token;
		$lp=D("lpinfo")->where(array('token'=>$this->token))->field('ID,LouPanTitle')->order("ID desc")->select();
        $this->assign("lp",$lp);
		
		$where1 = '';
		if($_REQUEST['Tel'] && !empty($_REQUEST['Tel'])){
			$tel = $_REQUEST['Tel'];
			$where['Tel'] = $tel;
			$where1= " and kh.Tel='$tel'";
			$this->assign('Tel',$tel);
		}
		if($_REQUEST['lpid'] && !empty($_REQUEST['lpid'])){
			$lpid = $_REQUEST['lpid'];
			$where['LouPanTitle']=$lpid;
			$where1= " and kh.LouPanTitle='$lpid'";
			$this->assign('lpid',$lpid);
		}
		
        //$where['JJ_id']=array("not in","0");  //经纪人存在
        $count=$kh->where($where)->count();
        $page=new Page($count,15);
		
		foreach($where1 as $key=>$val) {
			$page->parameter .= "$key=".urlencode($val)."&";
		}
		
        $firstRow=$page->firstRow;
        $listRows=$page->listRows;
        $sql="select kh.*,lp.LouPanTitle,br.usersname as zjgs,
                jjr.`Name` as jjr_name,jjr.`Tel` as jjrtel,zy.Name as zy_name,status.salesstatus  
                from wy_kh as kh LEFT JOIN wy_jjr as jjr ON kh.JJ_id=jjr.ID 
				LEFT JOIN wy_brokerage as br ON br.id=jjr.brokerage_id 
                LEFT JOIN wy_lpinfo as lp ON kh.LouPanTitle=lp.id 
                LEFT JOIN wy_zy as zy on kh.zy_id=zy.ID 
                LEFT JOIN wy_agent_status as status on kh.Stutas=status.id 
                where 1=1 and kh.Token='$token' ".$where1." 
                ORDER BY kh.ID DESC 
                LIMIT $firstRow,$listRows";
        $list=$kh->query($sql);
        $this->assign('page',$page->show());
        $this -> assign('list', $list);
        $this -> display();
    }
    //查询导入客户的信息
    public function index1(){

        $kh=D('kh');
        $token=session('token');
        $where['Token']=$token;
        $where['JJ_id']=array("in","0");    //经纪人不存在
        $count=$kh->where($where)->count();
        $page=new Page($count,20);
        $firstRow=$page->firstRow;
        $listRows=$page->listRows;
        $sql="select kh.ID,kh.Token,kh.Wecha_id,kh.`Name`,kh.Tel,lp.LouPanTitle,
                jjr.`Name` as jjr_name,zy.Name as zy_name, kh.Stutas,kh.SrTime,
                kh.yxTime,kh.DcTime,kh.RcTime,kh.RgTime,kh.QyTime,kh.HkTime,status.salesstatus  
                from wy_kh as kh LEFT JOIN wy_jjr as jjr ON kh.JJ_id=jjr.ID 
                LEFT JOIN wy_lpinfo as lp ON kh.LouPanTitle=lp.id 
                LEFT JOIN wy_zy as zy on kh.zy_id=zy.ID 
                LEFT JOIN wy_agent_status as status on kh.Stutas=status.id 
                where 1=1 and kh.Token='$token' and kh.JJ_id in (0) 
                ORDER BY kh.ID DESC 
                LIMIT $firstRow,$listRows";
        $list=$kh->query($sql);
        $this->assign('page',$page->show());
        $this -> assign('list', $list);
        $this -> display();
    }
    //显示新增意向客户页面
    public function add(){
            $Token=session("token");
            $lp=D("lpinfo")->where("Token='$Token'")->field('ID,LouPanTitle')->order("ID desc")->select();
            $jjr=D("jjr")->where("Token='$Token'")->field('ID,Name')->order("ID desc")->select();
            $this->assign("jjr",$jjr);
            $this->assign("lp",$lp);
            $this -> display();
        
    }
    //新增或修改客户页面处理
    public function addHandle(){
        if(IS_POST){
            $ku=D('kh');
            $data['Name']=trim($_POST['Name']);
            $data['Tel']=trim($_POST['Tel']);
            $data['LouPanTitle']=trim($_POST['Uid']);
            $data['JJ_id']=trim($_POST['JJ_id']);
            $data['Stutas']=trim($_POST['Stutas']);
            $data['SrTime']=time();
            // $data['DcTime']=strtotime(($_POST['DcTime']));
            // $data['RcTime']=strtotime(($_POST['RcTime']));
            // $data['SrTime']=strtotime(($_POST['SrTime']));
            // $data['SrTime']=strtotime(($_POST['SrTime']));
            // $data['SrTime']=strtotime(($_POST['SrTime']));
            // $data['SrTime']=strtotime(($_POST['SrTime']));
            $data['Token']=session('token');
            if($ku->add($data)){
                $this->success("添加成功",U('ServiceUser/index'));
            }else{
                $this->error("添加失败");
            }
        }else{
            $this->error("非法进入",U('ServiceUser/index'));
        }
    }
    //客户导出
    public function outexc(){
        include('ExcelExport.class.php');
        $token=$_GET['token'];
        $language=$_GET['language'];
        $arr[] = array(
                array('val'=>'意向客户', 'align'=>'center','font-size'=>18,'colspan'=>52),
        );
        $arr[] = array(
                array('val'=>'客户姓名','align'=>'center','width'=>15),
                array('val'=>'客户电话','align'=>'center','width'=>15),
                array('val'=>'项目名称','align'=>'center','width'=>20),
				array('val'=>'驻场经理','align'=>'center','width'=>15),
                array('val'=>'现场接待人','align'=>'center','width'=>15),
				array('val'=>'接待人电话','align'=>'center','width'=>15),
                array('val'=>'经纪公司','align'=>'center','width'=>20),
                array('val'=>'经纪人','align'=>'center','width'=>15),
                array('val'=>'经纪人电话','align'=>'center','width'=>15),
                array('val'=>'状态','align'=>'center','width'=>10),
				
                array('val'=>'产品','align'=>'center','width'=>15),
                array('val'=>'楼栋号','align'=>'center','width'=>15),
                array('val'=>'房号','align'=>'center','width'=>15),
                array('val'=>'合同面积(平方)','align'=>'center','width'=>15),
                array('val'=>'合同总价','align'=>'center','width'=>15),
                array('val'=>'预约日期','align'=>'center','width'=>15),
				array('val'=>'认购日期','align'=>'center','width'=>15),
                array('val'=>'签约日期','align'=>'center','width'=>15),
                array('val'=>'应收金额','align'=>'center','width'=>15),
                array('val'=>'实收金额','align'=>'center','width'=>15),
                array('val'=>'收款金额1','align'=>'center','width'=>15),
                array('val'=>'收款日期1','align'=>'center','width'=>15),
				array('val'=>'收款方式1','align'=>'center','width'=>15),
                array('val'=>'客户卡号1','align'=>'center','width'=>20),
                array('val'=>'POS单凭证号1','align'=>'center','width'=>20),
                array('val'=>'收据编号1','align'=>'center','width'=>20),
				array('val'=>'收款金额2','align'=>'center','width'=>15),
                array('val'=>'收款日期2','align'=>'center','width'=>15),
				array('val'=>'收款方式2','align'=>'center','width'=>15),
                array('val'=>'客户卡号2','align'=>'center','width'=>20),
                array('val'=>'POS单凭证号2','align'=>'center','width'=>20),
                array('val'=>'收据编号2','align'=>'center','width'=>20),
				array('val'=>'收款金额3','align'=>'center','width'=>15),
                array('val'=>'收款日期3','align'=>'center','width'=>15),
				array('val'=>'收款方式3','align'=>'center','width'=>15),
                array('val'=>'客户卡号3','align'=>'center','width'=>20),
                array('val'=>'POS单凭证号3','align'=>'center','width'=>20),
                array('val'=>'收据编号3','align'=>'center','width'=>20),
				
				array('val'=>'应付金额','align'=>'center','width'=>15),
				array('val'=>'中介奖励','align'=>'center','width'=>15),
                array('val'=>'请佣金额1','align'=>'center','width'=>15),
                array('val'=>'请佣日期1','align'=>'center','width'=>15),
                array('val'=>'打款日期1','align'=>'center','width'=>15),
				array('val'=>'请佣金额2','align'=>'center','width'=>15),
                array('val'=>'请佣日期2','align'=>'center','width'=>15),
                array('val'=>'打款日期2','align'=>'center','width'=>15),
				array('val'=>'总付款','align'=>'center','width'=>15),
				
				array('val'=>'是否已付','align'=>'center','width'=>15),
                array('val'=>'是否退房','align'=>'center','width'=>15),
				array('val'=>'备注','align'=>'center','width'=>20),
                array('val'=>'输入时间','align'=>'center','width'=>15),
                array('val'=>'有效时间','align'=>'center','width'=>15)
                
        );
        $kh=D('kh');
        $sql="select kh.*,lp.LouPanTitle,br.usersname as zjgs,
                jjr.`Name` as jjr_name,jjr.`Tel` as jjrtel,zy.Name as zy_name,status.salesstatus  
                from wy_kh as kh LEFT JOIN wy_jjr as jjr ON kh.JJ_id=jjr.ID 
				LEFT JOIN wy_brokerage as br ON br.id=jjr.brokerage_id 
                LEFT JOIN wy_lpinfo as lp ON kh.LouPanTitle=lp.id 
                LEFT JOIN wy_zy as zy on kh.zy_id=zy.ID 
                LEFT JOIN wy_agent_status as status on kh.Stutas=status.id 
                where 1=1 and kh.Token='$token' 
                ORDER BY kh.ID DESC";
        $ru=$kh->query($sql);
        foreach ($ru as $key => $value) {
            $arr[] = array(
                array('val'=>$value['Name']),
                array('val'=>$value['Tel']),
                array('val'=>$value['LouPanTitle']),
                array('val'=>$value['zy_name']?$value['zy_name']:""),
                array('val'=>$value['jdname']),
				array('val'=>$value['jdtel']),
                array('val'=>$value['zjgs']),
				array('val'=>$value['jjr_name']),
                array('val'=>$value['jjrtel']),
                array('val'=>$value['salesstatus']),
                array('val'=>$value['products']),
                array('val'=>$value['ldh']),
				array('val'=>$value['houseno']),
                array('val'=>$value['htmj']),
                array('val'=>$value['htzj']),
                array('val'=>$value['yydate']),
                array('val'=>$value['rgdate']),
				array('val'=>$value['qydate']),
                array('val'=>$value['ysje']),
                array('val'=>$value['ssje']),
                array('val'=>$value['skje1']),
                array('val'=>$value['skrq1']),
				array('val'=>$value['skfs1']),
                array('val'=>$value['khcard1']),
                array('val'=>$value['pos_pzh1']),
                array('val'=>$value['sjnum1']),
				array('val'=>$value['skje2']),
                array('val'=>$value['skrq2']),
				array('val'=>$value['skfs2']),
                array('val'=>$value['khcard2']),
                array('val'=>$value['pos_pzh2']),
                array('val'=>$value['sjnum2']),
				array('val'=>$value['skje3']),
                array('val'=>$value['skrq3']),
				array('val'=>$value['skfs3']),
                array('val'=>$value['khcard3']),
                array('val'=>$value['pos_pzh3']),
                array('val'=>$value['sjnum3']),
				array('val'=>$value['yfje']),
                array('val'=>$value['jjrjl']),
				array('val'=>$value['qyje1']),
                array('val'=>$value['qyrq1']),
                array('val'=>$value['dkrq1']),
				array('val'=>$value['qyje2']),
                array('val'=>$value['qyrq2']),
                array('val'=>$value['dkrq2']),
                array('val'=>$value['zfk']),
                array('val'=>$value['isfk']==1?"否":"是"),
                array('val'=>$value['istf']==1?"否":"是"),
                array('val'=>$value['remark']),
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
    //客户导入
    public function excinkh(){
        // echo "功能暂未开放<br>";
        // echo "<a href='?g=User&m=ServiceUser&a=index'>返回</a>";exit();
         error_reporting(0);
         $Token=$_GET['token'];
        //经纪人导入的一些操作
        function deltree($pathdir)  
            {  
              //echo $pathdir.'<br/>';//我调试时用的   
              //否则读这个目录，除了.和..外   
             $d=opendir($pathdir);  
              while($a=readdir($d)){ 
                //下只删除$pathdir下 
                if(is_file($pathdir.'/'.$a) && ($a!='.') && ($a!='..')){
                    unlink($pathdir.'/'.$a); //如果是文件就直接删除 
                }
                          
            } 
            closedir($d);            
         }
         deltree('upFile');
        //导入Excel文件
        if($_POST['leadExcel'] == "true"){  
        
            $str = "";
        //下面的路径按照你PHPExcel的路径来修改

        require_once 'excelin/public/phpexcel/PHPExcel.php';
        require_once 'excelin/public/phpexcel/PHPExcel\IOFactory.php';
        require_once 'excelin/public/phpexcel/PHPExcel\Reader\Excel5.php';
        require_once 'excelin/public/phpexcel/PHPExcel\Reader\Excel2007.php'; // 用于 excel-2007 格式

        import("ORG.Net.UploadFile");
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 10*1024*1024 ;// 设置附件上传大小
        $upload->allowExts  = array('xls');// 设置附件上传类型
        $upload->saveRule = uniqid;//这里的时间是根据上传的图片的多少来自动改变图片的名称的（并且时间都不同，所以上传的图片的名称就不会相同）
        $upload->savePath =  'upFile/';// 设置附件上传目录
          if($upload->upload()) //如果上传文件成功，就执行导入excel操作
          {
            $info =  $upload->getUploadFileInfo();
            $uploadfile=$info[0]['savepath'].$info[0]['savename'];//上传后的文件名地址
            $objReader = PHPExcel_IOFactory::createReader('Excel5');//用于其他低版本xls
            // $objReader= PHPExcel_IOFactory::createReader('Excel2007');//用于 excel-2007 格式
            $objPHPExcel = $objReader->load($uploadfile);
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow(); // 取得总行数

            $highestColumn = $sheet->getHighestColumn(); // 取得总列数
            /*--------------------------------读取第一行判断模板是否正确------------------------------*/ 
                $one=1; 
                $j=1;
                for($k='A';$k<=$highestColumn;$k++)
                    {
                      $string .= iconv('utf-8','gbk',$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue()).'\\';//读取单元格
                    }
                $rt = explode("\\",$string);    
                $rt[0] = iconv("GB2312","UTF-8",$rt[0]);        //客户姓名
                $rt[1] = iconv("GB2312","UTF-8",$rt[1]);        //客户电话
                $rt[2] = iconv("GB2312","UTF-8",$rt[2]);        //意向楼盘
                // $rt[3] = iconv("GB2312","UTF-8",$rt[3]);        //推荐人
                $rt[3] = iconv("GB2312","UTF-8",$rt[3]);        //输入时间
                // $rt[5] = iconv("GB2312","UTF-8",$rt[5]);        //输入时间
        /*------------------------------------------------如果成功导入-----------------------------*/     
               if(trim($rt[0])=="姓名"  ){ 
                    
                    for($j=2;$j<=$highestRow;$j++){
                        for($k='A';$k<=$highestColumn;$k++){
                          $str .= iconv('utf-8','gbk',$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue()).'\\';//读取单元格
                        }
                    
                        //explode:函数把字符串分割为数组。
                        $strs = explode("\\",$str);
                        $r[0] = iconv("gbk","UTF-8",$strs[0]);
                        $r[1] = iconv("gbk","UTF-8",$strs[1]);
                        $r[2] = iconv("gbk","UTF-8",$strs[2]);
                        $r[3] = iconv("gbk","UTF-8",$strs[3]);
                        // $r[4] = iconv("gbk","UTF-8",$strs[4]);
                        // $r[5] = iconv("gbk","UTF-8",$strs[5]);
                                                        
        /*--------------------------------------------------------------------------------------------------*/
                       if($r[0]=="" || $r[1]=="" || $r[2]=="" || $r[3]==""){
                            $array[]="第".$j."行失败，原因：数据不完整！";
                        }else{
                            $token=session('token');
                            //通过电话去除重复的客户
                            $tel=$r[1];
                            $LouPanTitle=$r[2];
                            
                            //查询意向楼盘信息并判断是否存在
                            $lpinfo=D("lpinfo")->where("LouPanTitle='$LouPanTitle' and token='$token'")->find();
                            //根据楼盘名称查询楼盘id
                            $lpid=intval($lpinfo['id']);
                            $khinfo=D('kh')->where("Tel='$tel' and token='$token' and LouPanTitle=$lpid")->find();
                            
                            
                            //判断时间的有效性
                            $mtime=strtotime($r[3]);
                            if($khinfo){
                                $array[]="第".$j."行失败，原因：客户已存在！";
                            }elseif($lpinfo==false){
                                $array[]="第".$j."行失败，原因：消费需求不存在！"; 
                            }elseif($mtime==false){
                               $array[]="第".$j."行失败，原因：输入时间错误$mtime！"; 
                            }else{
                                $data=D("kh");
                                
                                $lpid=intval($lpinfo['id']);
                                $JJ_id=intval($jjr['ID']);
                                //在销售状态中查找新客户的id
                                $status=D("agent_status")->order("sort asc")->limit(1)->find();
                                $Stutas=$status['id'];
                                // $sql="insert into wy_kh (`Token`,`Name`,`Tel`,`LouPanTitle`,`JJ_id`,`Stutas`,`SrTime`) values ('$token','$r[0]','$r[1]',$lpid,$JJ_id,$Stutas,$mtime)";
                                $sql="insert into wy_kh (`Token`,`Name`,`Tel`,`LouPanTitle`,`Stutas`,`SrTime`) values ('$token','$r[0]','$r[1]',$lpid,$Stutas,$mtime)";
                                $data->execute($sql);
                            }
                            $str = ""; 
                        }
                        
                     }
                        unlink($uploadfile); //删除上传的excel文件
                        $one=1;
                        $all_data=$highestRow-$one;
                        echo "共".$all_data."条数据<br/>";
                        $success_date=$all_data-count($array);
                        echo "成功导入".$success_date."条数据<br/>";
                        echo "失败".count($array)."条数据<br/>"; 
                        echo "<a href='?g=User&m=ServiceUser&a=index'>返回</a><br/>";              
                        //如果有失败的，显示哪一条失败
                        if(count($array)>0)
                        {
                            foreach ($array as $value)
                            {  
                               echo $value."<br/>";  
                             }
                        }
                        exit();
              }else{
                echo "文件格式不正确，请下载模板！";
              }   
                        
                        
          }else{
             $msg = "导入失败！请下载模板！";
             echo $msg;
             echo "<a href='?g=User&m=ServiceUser&a=index'>返回</a><br/>";
             exit();
           }
           return $msg;
        }
        
    }

    public function closeService(){
        $where['token'] = session('token');
        $endTime = time()-60 * 600;
        $rt = M('Service_user') -> where($where) -> save(array('endJoinDate' => $endTime));
        $this -> success('操作成功');
    }

    //修改客户信息
    public function edit(){
        $kh=D('kh');
        if(IS_POST){
            $arr=$_POST;var_dump($arr);
			$arr['SrTime']=strtotime($this->_post('SrTime'));
			$arr['yxTime']=strtotime($this->_post('yxTime'));
			//var_dump($arr);die;
           // $arr['ID']=intval($this->_post("ID"));
           // $arr['Name']=trim($this->_post('Name'));
           // $arr['Tel']=trim($this->_post('Tel'));
           // $arr['zy_id']=trim($this->_post('zy_id'));
           // $arr['Stutas']=trim($this->_post('Stutas'));
            // $arr['addTime']=strtotime($this->_post('addTime'));
           // $arr['yxTime']=strtotime($this->_post('yxTime'));
           // $arr['Token']=$this->token;
            if($kh->save($arr)){
                $this->success("修改成功",U("ServiceUser/index",array('token'=>session('token'))));
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
            //查询楼盘信息
            $lp=D("lpinfo")->where("Token='$token'")->field('ID,LouPanTitle')->order("ID desc")->select();
            //查询客户信息
            $list=D("kh")->where("Token='$token'")->find($id);
			//查询经纪公司信息
			$brokarr['Token'] = $token;
            $jjgs=D("brokerage")->where($brokarr)->select();
			$list['jjgs_id'] = 0;
			$jjr = array();
			if($list['JJ_id']){
				//经纪人关联的经纪公司id
				$list['jjgs_id'] = D("jjr")->where(array('ID'=>$list['JJ_id']))->getField('brokerage_id');
				//查询经纪人信息
				$jjr=D("jjr")->where(array("brokerage_id"=>$list['jjgs_id']))->select();
			}
            //查询置业顾问信息
			$zy = array();
			if($list['LouPanTitle']){
				$lpid = $list['LouPanTitle'];
				$zy = D("zy")->where(array("_string"=>"FIND_IN_SET('$lpid', Uid)"))->select();
			}
            
            //查询出比其sort要大的sort
            $stawhere['token']=$token;
            $status=D("agent_status")->where($stawhere)->order("sort")->select();
            $this->assign("lp",$lp);
            $this->assign("jjr",$jjr);
			$this->assign("jjgs",$jjgs);
            $this->assign("zy",$zy);
            $this->assign("list",$list);
            $this->assign("status",$status);
            $this->display();
        }
       
    }
	
	//ajax获取经纪人
	public function ajax_zy(){
		$lpid = intval($_POST['lpid']);
		$zylist = D("zy")->where(array("_string"=>"FIND_IN_SET('$lpid', Uid)"))->select();
		$this->ajaxReturn($zylist,'',1);
	}
	
	//ajax获取经纪人
	public function ajax_jjr(){
		$brokerage_id = intval($_POST['brokerage_id']);
		$jjrlist = D("jjr")->where(array("brokerage_id"=>$brokerage_id))->select();
		$this->ajaxReturn($jjrlist,'',1);
	}


    //修改客户信息
    public function edit1(){
        $kh=D('kh');
        if(IS_POST){
            $arr=$_POST;
			var_dump($arr);die;
            $arr['ID']=intval($this->_post("ID"));
            $arr['Name']=trim($this->_post('Name'));
            $arr['Tel']=trim($this->_post('Tel'));
            $arr['Stutas']=trim($this->_post('Stutas'));
            $arr['Token']=$this->token;
            if($kh->save($arr)){
                $this->success("修改成功",U("ServiceUser/index1",array('token'=>session('token'))));
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
            //查询楼盘信息
            $lp=D("lpinfo")->where("Token='$token'")->field('ID,LouPanTitle')->order("ID desc")->select();
            //查询客户信息
            $list=D("kh")->where("Token='$token'")->find($id);
            //查询楼盘销售状态表的id
            $statusid=intval($list['Stutas']);
            //通过statusid查询出它的sort
            $sort=D("agent_status")->where("Token='$token'")->field('sort')->find($statusid);
            //查询出比其sort要大的sort
            $where['token']=$token;
            $where['sort']=array("EGT",intval($sort['sort']));
            $status=D("agent_status")->where($where)->order("sort")->select();
            $this->assign("lp",$lp);
            $this->assign("list",$list);
            $this->assign("status",$status);
            $this->display();
        }
       
    }


    public function chat_log(){
        $data = M('service_logs');
        $where['token'] = session('token');
        $count = $data -> where($where) -> count();
        $page = new Page($count, 25);
        $list = $data -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('id desc') -> select();
        foreach($list as $key => $vo){
            $list[$key]['name'] = D('Service_user') -> getServiceUser($vo['pid']);
        }
        $this -> assign('page', $page -> show());
        $this -> assign('list', $list);
        $this -> assign('type', 'list');
        $this -> display();
    }
    public function del (){
        $data=D('kh');
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
    public function chat_log_del (){
        $this -> del_id('service_logs', 'Service/chat_log');
    }
}
?>