<?php
/**
 * @置业顾问操作模块
 */
class Wechat_zhiyeAction extends UserAction{
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
    //置业顾问显示页
    public function index(){
        $zy=D('zy');
        $where=array('Token'=>$this->token);
		
		$lp=D("lpinfo")->where(array('token'=>$this->token))->field('ID,LouPanTitle')->order("ID desc")->select();
        $this->assign("lp",$lp);
		
		if($_REQUEST['Tel'] && !empty($_REQUEST['Tel'])){
			$tel = $_REQUEST['Tel'];
			$where['Tel'] = $tel;
			$this->assign('Tel',$tel);
		}
		if($_REQUEST['lpid'] && !empty($_REQUEST['lpid'])){
			$lpid = $_REQUEST['lpid'];
			$where['_string']="FIND_IN_SET('$lpid', Uid)";
			$this->assign('lpid',$lpid);
		}
		
        $count=$zy->where($where)->count();
        $page=new Page($count,20);
		
		foreach($where1 as $key=>$val) {
			$page->parameter .= "$key=".urlencode($val)."&";
		}
		
        $firstRow=$page->firstRow;
        $listRows=$page->listRows;
        // $sql="select zy.ID,zy.Token,zy.Name,zy.Tel,lp.LouPanTitle,zy.addTime,zy.BDTime 
                // from wy_zy as zy,wy_lpinfo as lp 
                // where zy.Token='{$token}' and zy.Uid=lp.id 
                // order by zy.ID DESC limit {$firstRow},{$listRows}";
        
        // $list=$zy->query($sql);
		$list = $zy->where($where)->limit($firstRow,$listRows)->order('id desc')->select();
		
        $this->assign('page',$page->show());
        $this->assign('list',$list);
        $this->display();
    }
    //新增置业顾问
    public function addzhiye(){
        if(IS_POST){
            $zy=D('zy');
            $arr=array();
            $arr['Tel']=trim($this->_post('Tel'));
            $arr['Token']=$this->token;
			$zyinfo = $zy->where($arr)->find();
			if($zyinfo){
				$this->error("手机号已存在");
			}
            $arr['Name']=trim($this->_post('Name'));
            $arr['Uid']=implode(',',$this->_post('Uid'));
			
			if($arr['Tel']){
				$arr['Wecha_id'] = md5($arr['Tel']);  //因为不用微信登录了就用手机号的md5作为唯一标识
			}
			if($this->_post('password')){
				$arr['password']=md5($this->_post('password'));
			}
            $arr['addTime']=time();
            if($zy->add($arr)){
                $this->success("添加成功",U("Wechat_zhiye/index",array('token'=>$this->token)));
            }else{
                $this->error("添加失败");
            }
        }else{
            $token=session("token");
            $lp=D("lpinfo")->where("Token='$token'")->field('ID,LouPanTitle')->order("ID desc")->select();
            $this->assign("lp",$lp);
            $this->display();  
        }
        
    }
    //显示与处理修改置业顾问
    public function edit(){
        
       $zy=D('zy');
        if(IS_POST){
            $arr=array();
            $arr['Token']=$this->token;
            $arr['Tel']=trim($this->_post('Tel'));
			$zyinfo = $zy->where($arr)->find();
			
            $arr['ID']=intval($this->_post("ID"));
			if($zyinfo && $zyinfo['ID'] != $arr['ID']){
				$this->error("手机号修改后存在冲突");
			}
			
            $arr['Name']=trim($this->_post('Name'));
            if($arr['Tel']){
				$arr['Wecha_id'] = md5($arr['Tel']);  //因为不用微信登录了就用手机号的md5作为唯一标识
			}
			if($this->_post('password')){
				$arr['password']=md5($this->_post('password'));
			}
			$arr['Uid']=implode(',',$this->_post('Uid'));//楼盘id
            if($zy->save($arr)){
                $this->success("修改成功",U("Wechat_zhiye/index",array('token'=>session('token'))));
            }else{
                $this->error("修改失败",U("Wechat_zhiye/edit"));
            }
        }else{
            $id=intval($_GET['id']);
            $token=session("token");
            //显示所有楼盘
            $lp=D("lpinfo")->where("Token='$token'")->field('ID,LouPanTitle')->order("ID desc")->select();
            // $sql="select zy.ID,zy.Token,zy.Name,zy.Tel,zy.Uid,lp.LouPanTitle,zy.addTime,zy.BDTime 
            //         from wy_zy as zy,wy_lpinfo as lp 
            //         where zy.Token='{$token}' and zy.Uid=lp.id and zy.ID={$id} limit 1";
            // $list=$zy->query($sql);
            $list=D("zy")->where("Token='$Token'")->find($id);
			$lps = explode(',',$list['Uid']);
            $this->assign("list",$list);
            $this->assign("lp",$lp);
			$this->assign("lps",$lps);
            $this->display();
        }
        
    }
    //删除置业顾问
    public function del(){
        $data=D('zy');
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

    //置业顾问导入
    public function excinzhiye(){
         /*--------------下面是对mysql数据库的连接----------*/
         // @session_start();
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
                $rt[0] = iconv("GB2312","UTF-8",$rt[0]);           //置业顾问姓名
                $rt[1] = iconv("GB2312","UTF-8",$rt[1]);           //置业顾问电话
                $rt[2] = iconv("GB2312","UTF-8",$rt[2]);           //置业顾问类型
                $rt[3] = iconv("GB2312","UTF-8",$rt[3]);           //置业顾问注册时间
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
                                                        
        /*--------------------------------------------------------------------------------------------------*/
                       if($r[0]=="" || $r[1]=="" || $r[2]==""){
                            $array[]="第".$j."条失败，原因：数据不完整！";
                        }else{
                        //通过楼盘名称查找楼盘id
                            $where['LouPanTitle']=$r[2];
                            $lpinfo=D("lpinfo")->where($where)->find();
                            if($lpinfo==false){
                               $array[]="第".$j."行失败，原因：该楼盘不存在！"; 
                            }else{
                                $Uid=intval($lpinfo['id']);
                                $data=D("zy");
                                $mtime=strtotime($r[3]);
                                $token=session('token');
                                $sql="insert into wy_zy (`Token`,`Name`,`Tel`,`Uid`,`addTime`) values ('$token','$r[0]','$r[1]',$Uid,$mtime)";
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
                        echo "<a href='?g=User&m=Wechat_zhiye&a=index'>返回</a><br/>";              
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
             echo "<a href='?g=User&m=Wechat_zhiye&a=index'>返回</a><br/>";
             exit();
           }
           return $msg;
        }
    } 

    //意向客户分配显示页
    public function custom(){
        $this->display();
    }
    //意向客户分配修改页
    public function customOfModule(){
        $this->display();
    }
}
?>