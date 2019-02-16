<?php
class BrokerageAction extends UserAction{
    public $tokenWhere;
    public function _initialize(){
        parent :: _initialize();
        $this -> canUseFunction('share');
        $this -> tokenWhere = array('token' => $this -> token);
    }
        //经纪公司列表
        public function index(){
            $brokerage=D('brokerage');
            $where=array('token'=>session('token'));
            $count=$brokerage->where($where)->count();
            $page=new Page($count,20);
			$list = $brokerage->join('left join wy_areas as a on a.ID=wy_brokerage.areas_ID')
                ->where("wy_brokerage.Token='$where[token]'")
				->field('wy_brokerage.*,a.areaName')
                ->limit($page->firstRow.','.$page->listRows)
                ->order('wy_brokerage.id desc' )
                ->select();
            $this->assign('page',$page->show());
            $this->assign('list',$list);
            $this -> display();
        }
        //添加经纪公司
        public function add(){
			if($_POST){
				$data['Token']=session('token');
				$data['usersname']=$_POST['usersname'];
				$data['tel']=trim($_POST['tel']);
				$data['address']=trim($_POST['address']);
				$data['contacts']=trim($_POST['contacts']);
				$data['in_area']=trim($_POST['in_area']);
				$data['areas_ID']=trim($_POST['areaName']);
				$id=$_POST['id'];
				if($id>0){
					$data['id']=$id;
					$jjrarr=D('brokerage')->save($data);
				}else{
					$data['mtime']=time();
					$jjrarr=D('brokerage')->add($data);
				}
				if($jjrarr){
					$this->success("保存成功",U('Brokerage/index',array('token'=>$data['Token'])));
				}else{
					$this->error("保存失败",U('Brokerage/index'));
				}

			}else{
				$data=D('areas');
				$list=$data->select();
				$this->assign("list",$list);
				
				$id=$_GET['id'];
				if($id>0){
					$where['id']=$id;
					$brokerage=D('brokerage')->where($where)->find();
					$this->assign("brokerage",$brokerage);
					$this->assign("id",$id);
				}

				$this->display();	
			}
                    
        }
//删除经纪公司
        public function del(){
            $data=D('brokerage');
            $id=$this->_get('id','intval');
            if($id==false) $this->error('非法操作');
            $token=$this->token;
            $back=$data->where(array('Token'=>"$token"))->delete($id);
            if($back==false){
                $this->error('操作失败');
            }else{
                $this->success('操作成功');
            }
        }
        public function addAgent(){
            if($_GET){
                $where['id']=$_GET['id'];
                $where['Token']=$_GET['token'];
                $jjr=D("brokerage");
                $list=$jjr->where($where)->find();

                // echo $jjr->getLastSql();die();
                $this->assign("list",$list);
            }
            $this->display();
        }
        public function addAgentHandle(){
            if($_POST){
                $data['Token']=session('token');
                $data['wecha_id']="";
                $data['usersname']=trim($_POST['usersname']);
                $data['tel']=trim($_POST['tel']);
                $data['address']=trim($_POST['address']);
                $data['contacts']=trim($_POST['contacts']);
				$data['in_area']=trim($_POST['in_area']);
                $data['mtime']=time();
                $data['areas_ID']=trim($_POST['areaName']);
//            var_dump($data);die;
                $id=$_POST['id'];
//                if($id>0){
                    $data['id']=$id;

                    $jjrarr=D('brokerage')->save($data);
//                }else{
//                    $jjrarr=D('brokerage')->add($data);
//                }
                if($jjrarr){
                    $this->success("修改成功",U('Brokerage/index'));
                }else{
                    D('brokerage')->getLastSql();die();
                    $this->error("修改失败",U('Brokerage/index'));
                }

            }
        }
        public function addlist(){
            $data=D('areas');
            $list=$data->select();
            $this->assign("list",$list);
            $this->display('add');
        }
		
		//经纪公司导出
    public function excout(){
        include('ExcelExport.class.php');
        $token=$this->token;
        $arr[] = array(
                array('val'=>'经纪公司列表', 'align'=>'center','font-size'=>18,'colspan'=>5),
        );
        $arr[] = array(
				array('val'=>'经纪公司名称','align'=>'center','width'=>20),
                array('val'=>'联系人','align'=>'center','width'=>10),
                array('val'=>'经纪公司电话','align'=>'center','width'=>40),
                array('val'=>'经纪公司地址','align'=>'center','width'=>40),
				array('val'=>'所在区域','align'=>'center','width'=>40),
                array('val'=>'片区经理','align'=>'center','width'=>40)
        );
        $brokerage=D('brokerage');
		$list = $brokerage->join('left join wy_areas as a on a.ID=wy_brokerage.areas_ID')
			->where("wy_brokerage.Token='$token'")
			->field('wy_brokerage.*,a.areaName')
			->order('wy_brokerage.id desc' )
			->select();
        foreach ($list as $key => $value) {
            $arr[] = array(
                array('val'=>$value['usersname']),
                array('val'=>$value['contacts']),
                array('val'=>$value['tel']),
                array('val'=>$value['address']),
				array('val'=>$value['in_area']),
                array('val'=>$value['areaName'])
            );
        }
			
        $excel = new ExcelExport('excel');
        foreach($arr as $val){
            $excel->setCells($val);
        }
        $excel->save();
    }

    //会员导入
    public function excin(){
          /*--------------下面是对mysql数据库的连接----------*/
         // @session_start();
         error_reporting(0);
         $Token=$this->token;
        //会员导入的一些操作
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
                $rt[0] = iconv("GB2312","UTF-8",$rt[0]);           //经纪公司名称
                $rt[1] = iconv("GB2312","UTF-8",$rt[1]);           //联系人名称
                $rt[2] = iconv("GB2312","UTF-8",$rt[2]);           //经纪公司电话
                $rt[3] = iconv("GB2312","UTF-8",$rt[3]);           //经纪公司地址
				$rt[4] = iconv("GB2312","UTF-8",$rt[4]);           //所在区域
				$rt[5] = iconv("GB2312","UTF-8",$rt[5]);           //片区经理
        /*------------------------------------------------如果成功导入-----------------------------*/ 
	
               if(trim($rt[0])=="经纪公司名称"  ){ 
                    
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
						$r[4] = iconv("gbk","UTF-8",$strs[4]);
						$r[5] = iconv("gbk","UTF-8",$strs[5]);
                                                        
        /*--------------------------------------------------------------------------------------------------*/
                       if($r[0]==""){
                            $array[]="第".$j."条失败，原因：经纪公司名称未填写！";
                        }else{
                        //查找会员所属类别
							if($r[5]==''){
								 $areas_ID=0;
							}else{
								$where['areaName']=$r[5];
								$where['Token']=$this->token;
								$areas=D("areas")->where($where)->find();
								if($areas==false){
								   $areas_ID=0;
								}else{
									$areas_ID=intval($areas['ID']);
								}
							}
							
							$brokerage=D("brokerage");
							$token=$this->token;
							$usersname = $r[0];
							unset($data);//避免循环造成的参数错误
							$data['Token'] = $token;
							$data['usersname'] = $usersname;
							$brokerageinfo = $brokerage->where($data)->find();
							$data['contacts'] = $r[1];
							$data['tel'] = $r[2];
							$data['address'] = $r[3];
							$data['in_area'] = $r[4];
							$data['areas_ID'] = $areas_ID; 
							
							if($brokerageinfo){
								$data['id'] = $brokerageinfo['id'];
								$brokerage->save($data);
							}else{
								$brokerage->add($data);
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
                        echo "<a href='?g=User&m=Brokerage&a=index'>返回</a><br/>";              
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
             echo "<a href='?g=User&m=Brokerage&a=index'>返回</a><br/>";
             exit();
           }
           return $msg;
        }
        
    }


}



















