<?php
class ShareAction extends UserAction{
     public $tokenWhere;
     public function _initialize(){
         parent :: _initialize();
         $this -> canUseFunction('share');
         $this -> tokenWhere = array('token' => $this -> token);
         }
     public function set(){
         $record = M('Share_set') -> where($this -> tokenWhere) -> find();
         if (IS_POST){
             $row = array();
             $row['score'] = intval($_POST['score']);
             $row['daylimit'] = intval($_POST['daylimit']);
             if ($record){
                 M('Share_set') -> where($this -> tokenWhere) -> save($row);
                 }else{
                 $row['token'] = $this -> token;
                 M('Share_set') -> add($row);
                 }
             $this -> success('设置成功');
             }else{
             if (!$record){
                
                 }
             $this -> assign('record', $record);
             $this -> assign('tab', 'set');
             $this -> display();
             }
         }
     public function records(){
         $db = D('Share');
         $where['token'] = $this -> token;
         $count = $db -> where($where) -> count();
         $page = new Page($count, 25);
         $info = $db -> where($where) -> order('id DESC') -> limit($page -> firstRow . ',' . $page -> listRows) -> select();
         $wecha_ids = array();
         if ($info){
             foreach ($info as $item){
                 if (!in_array($item['wecha_id'], $wecha_ids)){
                     array_push($wecha_ids, $item['wecha_id']);
                     }
                 }
             $users = M('Userinfo') -> where(array('wecha_id' => array('in', $wecha_ids))) -> select();
             if ($users){
                 foreach ($users as $useritem){
                     $users[$useritem['wecha_id']] = $useritem;
                     }
                 }
             $i = 0;
             foreach ($info as $item){
                 $info[$i]['user'] = $users[$item['wecha_id']];
                 $info[$i]['moduleName'] = funcDict :: moduleName($item['module']);
                 $i++;
                 }
             }
        
         $this -> assign('page', $page -> show());
         $this -> assign('info', $info);
         $this -> assign('tab', 'records');
         $this -> display();
         }
     public function index(){
        $jjr=D('jjr');
        $token=$this->token;
		$where['Token'] = $token;
		
		$type=D("brokerage")->where($where)->select();
        $this->assign("type",$type);
			
		if($_REQUEST['Tel'] && !empty($_REQUEST['Tel'])){
			$tel = $_REQUEST['Tel'];
			$where['Tel'] = $tel;
			$where1['a.Tel'] = $tel;
			$this->assign('Tel',$tel);
		}
		if($_REQUEST['brokerage_id'] && !empty($_REQUEST['brokerage_id'])){
			$brokerage_id = $_REQUEST['brokerage_id'];
			$where['brokerage_id'] = $brokerage_id;
			$where1['a.brokerage_id'] = $brokerage_id;
			$this->assign('brokerage_id',$brokerage_id);
		}
		
        $count=$jjr->where($where)->count();
        $page=new Page($count,20);
		
		foreach($where1 as $key=>$val) {
			$page->parameter .= "$key=".urlencode($val)."&";
		}
		
		
		$where1['a.Token'] = $token;
       
         $list = $jjr->table(' wy_jjr a')
             ->join('wy_brokerage c on a.brokerage_id= c.id','left')
             ->limit($page->firstRow.','.$page->listRows)
			 ->where($where1)
             ->order('a.ID desc' )
             ->select();
        
        $this->assign('page',$page->show());
        $this->assign('list',$list);
        $this->assign('token',$token);
        $this -> display();
     }
     //显示添加会员页面
    public function addAgent(){
        $zc=D("zc");
        $TiaoKuan=$zc->order("ID DESC")->limit("1")->getField("TiaoKuan");
        if($_GET){
            $where['Token']=$this->token;
            $type=D("brokerage")->where($where)->select();
            $this->assign("type",$type);
        }
        $this->assign("TiaoKuan",$TiaoKuan);
        $this->display();
    }
    //处理添加会员
    public function addAgentHandle(){
        if($_POST){
            $data['Token']=$this->token;
            $data['Tel']=trim($_POST['Tel']);
			$jjrinfo = D('jjr')->where($data)->find();
			if($jjrinfo){
				$this->error("手机号已存在",U('Share/index',array('token'=>$this->token)));
			}
            $data['Name']=trim($_POST['Name']);
			if($data['Tel']){
				$data['Wecha_id'] = md5($data['Tel']);  //因为不用微信登录了就用手机号的md5作为唯一标识
			}
			if($_POST['password']){
				$data['password']=md5($_POST['password']);
			}
            $data['brokerage_id']=trim($_POST['brokerage_id']);
            $data['Mtime']=time();
            $id=$_POST['ID'];
            if($id>0){
                 $data['ID']=$id;
                $jjrarr=D('jjr')->save($data);
            }else{
                $jjrarr=D('jjr')->add($data);
            }
            if($jjrarr){
                $this->success("添加成功",U('Share/index',array('token'=>$this->token)));
            }else{
                $this->error("添加失败",U('Share/index',array('token'=>$this->token)));
            }
        }
        
    }

    //修改会员
    public function modifyAgent(){
        if($_POST){
            $data['Token']=$this->token;
            $data['Tel']=trim($_POST['Tel']);
			$jjrinfo = D('jjr')->where($data)->find();
			
			$data['ID']=intval($_POST['ID']);
            $data['Name']=trim($_POST['Name']);
			if($jjrinfo && $jjrinfo['ID'] != $data['ID']){
				$this->error("手机号修改后存在冲突",U('Share/index',array('token'=>$this->token)));
			}
			
			if($data['Tel']){
				$data['Wecha_id'] = md5($data['Tel']);  //因为不用微信登录了就用手机号的md5作为唯一标识
			}
			if($_POST['password']){
				$data['password']=md5($_POST['password']);
			}
			$data['brokerage_id']=intval($_POST['brokerage_id']);

            $jjrarr=D('jjr')->save($data);
            if($jjrarr){
                $this->success("修改成功",U('Share/index',array('token'=>session('token'))));
            }else{
                $this->error("修改失败");
            }
        }else{
             $where['ID']=$_GET['id'];
            $where['Token']=$this->token;
            $jjr=D("jjr");
            $list=$jjr->where($where)->find();
            $type=D("brokerage")->where(array('token'=>$this->token))->select();
            // echo $jjr->getLastSql();die();
            $this->assign("list",$list);
            $this->assign("type",$type);
            $this->display();
        }
       
    }

    //删除会员
    public function del(){
        $data=D('jjr');
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

    //积分明细
    public function creditdetail(){
      $jid=$_GET['id'];       //会员id（分享人id）
      $token=$this->token;  //会员token
      $xmfx=D("xmfx");
      $count=$xmfx->where("token='$token' and jid=$jid")->count();
      $page=new Page($count,20);
      $firstRow=$page->firstRow;
      $listRows=$page->listRows;
      $sql="select jjr.Name, lp.LouPanTitle,xmfx.id,xmfx.views,xmfx.hascredit,xmfx.type 
              from wy_xmfx as xmfx left join wy_jjr as jjr on xmfx.jid=jjr.ID 
              left join wy_lpinfo as lp on xmfx.uid=lp.id 
              where xmfx.token='$token' and xmfx.jid=$jid 
              order by xmfx.id desc limit $firstRow , $listRows";
      $list=$xmfx->query($sql);
      $this->assign("list",$list);
      $this->assign('page',$page->show());
      $this->display();
    }

    //佣金奖励信息列表页
    public function reward(){
        $token=$this->token;
        if(isset($_GET['jjrname'])||isset($_GET['rewardstatus'])){
            $jjrname=trim($_GET['jjrname']);
            if($_GET['rewardstatus']==''){
                $rewardstatus='-99,-1,0,1,2';
            }else{
                $rewardstatus=intval($_GET['rewardstatus']);
            }
            //查询佣金奖励总数
            $reward=D("agent_rewardinfo");
            $sql="SELECT count('reward.id') as count 
                from wy_agent_rewardinfo as reward, wy_jjr as jjr 
                where reward.wecha_id=jjr.Wecha_id and jjr.Token=reward.token 
                and reward.token='$token' and reward.rewardstatus in ($rewardstatus) and jjr.`Name` like '%$jjrname%'";
            $count=$reward->query($sql);
            $count=intval($count[0]['count']);
            // var_dump($count);die();
            // echo D("agent_rewardinfo")->getLastSql();
            // var_dump($count);die();
            // $count=$reward->where("token='$token'")->count();
            $page=new Page($count,20);
            // 传入分页变量
            $map['jjrname'] = $_GET['jjrname']; 
            $map['rewardstatus'] = $_GET['rewardstatus']; 
            foreach($map as $key=>$val) { 
                $page->parameter .= "$key=".urlencode($val)."&"; 
            }
            $firstRow=$page->firstRow;
            $listRows=$page->listRows;
            $sql1="SELECT jjr.`Name` ,reward.id,reward.token, reward.loupanname,reward.customname,reward.statusname,
                    reward.rewardname,reward.rewardamount,reward.rewardstatus,reward.srtime  
                    from wy_agent_rewardinfo as reward, wy_jjr as jjr 
                    where reward.wecha_id=jjr.Wecha_id and jjr.Token=reward.token 
                    and reward.token='$token' and jjr.`Name` like '%$jjrname%' and reward.rewardstatus in ($rewardstatus) 
                    order by reward.rewardstatus desc,reward.srtime desc limit $firstRow,$listRows";
            $list=$reward->query($sql1);
            $this->assign("jjrname",$jjrname);
            $this->assign('rewardstatus',$rewardstatus);
        }else{
            //查询佣金奖励总数
            $reward=D("agent_rewardinfo");
            $count=$reward->where("token='$token'")->count();
            $page=new Page($count,20);
            $firstRow=$page->firstRow;
            $listRows=$page->listRows;
            $sql="SELECT jjr.`Name` ,reward.id,reward.token, reward.loupanname,reward.customname,reward.statusname,
                    reward.rewardname,reward.rewardamount,reward.rewardstatus,reward.srtime  
                    from wy_agent_rewardinfo as reward , wy_jjr as jjr 
                    where jjr.Wecha_id=reward.wecha_id and reward.token=jjr.Token AND reward.token='$token' 
                    order by reward.rewardstatus desc,reward.srtime desc limit $firstRow,$listRows";
            $list=$reward->query($sql);  
        }
        $this->assign("list",$list);
        $this->assign('page',$page->show());
        $this->assign('token',$token);
        $this->display();
    }

    //佣金奖励信息详情页
    public function rewardOfModule(){
      $token=$this->token;
      $reward=D("agent_rewardinfo");
      if($_POST){
        $data['id']=intval($_POST['id']);
        $data['rewardstatus']=intval($_POST['rewardstatus']);
        if($reward->save($data)){
          $this->success("修改成功",U('Share/reward',array('token'=>$token)));
        }else{
          $this->error("修改失败");
        }
      }else{
        $id=intval($_GET['id']);
        //查询佣金奖励总数
        $sql="SELECT jjr.`Name` ,reward.id,reward.token, reward.loupanname,reward.customname,
                    reward.statusname,reward.rewardname,reward.rewardamount,
                    reward.rewardstatus,reward.srtime  
                from wy_agent_rewardinfo as reward , wy_jjr as jjr 
                where jjr.Wecha_id=reward.wecha_id and reward.token=jjr.Token 
                      AND reward.token='$token' and reward.id=$id";
        $list=$reward->query($sql);
        if(!$list){
          $this->error("该记录不存在请重新操作");
        }
        $this->assign("list",$list[0]);
        $this->assign('token',$token);
        $this->display();
      }
      
    }

    //会员导出
    public function agentoutexc(){
        include('ExcelExport.class.php');
        // $where['Token']=$_GET['token'];
        $token=$this->token;
        $language=$_GET['language'];
        $arr[] = array(
                array('val'=>'经纪人列表', 'align'=>'center','font-size'=>18,'colspan'=>4),
        );
        $arr[] = array(
                array('val'=>'姓名','align'=>'center','width'=>10),
                array('val'=>'手机号','align'=>'center','width'=>40),
                array('val'=>'所属公司','align'=>'center','width'=>40),
                array('val'=>'注册时间','align'=>'center','width'=>40)
                
        );
        $data=D("jjr");
        $where['a.Token'] = $token;
		if($_GET['Tel']){
			$where['a.Tel'] = $_GET['Tel'];
		}
		if($_GET['brokerage_id']){
			$where['a.brokerage_id'] = $_GET['brokerage_id'];
		}
       
		 $list = $data->table(' wy_jjr a')
			 ->join('wy_brokerage c on a.brokerage_id= c.id','left')
			 ->where($where)
			 ->order('a.ID desc' )
			 ->select();
        foreach ($list as $key => $value) {
            $arr[] = array(
                array('val'=>$value['Name']),
                array('val'=>$value['Tel']),
                array('val'=>$value['usersname']),
                array('val'=>date('Y-m-d',$value['Mtime']))
               
            );
        }
        $excel = new ExcelExport('excel');
        foreach($arr as $val){
            $excel->setCells($val);
        }
        $excel->save();
    }

    //会员导入
    public function excinagent(){
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
                $rt[0] = iconv("GB2312","UTF-8",$rt[0]);           //会员姓名
                $rt[1] = iconv("GB2312","UTF-8",$rt[1]);           //会员电话
                $rt[2] = iconv("GB2312","UTF-8",$rt[2]);           //会员密码
                $rt[3] = iconv("GB2312","UTF-8",$rt[3]);           //会员所属公司
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
                        //查找会员所属类别
							if($r[3]==''){
								 $array[]="第".$j."行失败，原因：公司名称未填写！";
							}else{
								$where['usersname']=$r[3];
								$brokerage=D("brokerage")->where($where)->find();
								if($brokerage==false){
								   $array[]="第".$j."行失败，原因：公司不存在！"; 
								}else{
									$brokerage_id=intval($brokerage['id']);
									$jjr=D("jjr");
									$mtime=time();
									$token=$this->token;
									$tel = $r[1];
									$password = md5($r[2]);
									unset($data);//避免循环造成的参数错误
									$data['Token'] = $token;
									$data['Tel'] = $tel;
									$jjrinfo = $jjr->where($data)->find();
									$data['Name'] = $r[0];
									$data['password'] = $password;
									$data['brokerage_id'] = $brokerage_id;
									$data['Mtime'] = $mtime;
									$data['Wecha_id'] = md5($tel);  //因为不用微信登录了就用手机号的md5作为唯一标识
									
									if($jjrinfo){
										$data['ID'] = $jjrinfo['ID'];
										$jjr->save($data);
									}else{
										$jjr->add($data);
									}
									$str = "";    
								}
							}
                        }    
                     }
                        unlink($uploadfile); //删除上传的excel文件
                        $one=1;
                        $all_data=$highestRow-$one;
                        echo "共".$all_data."条数据<br/>";
                        $success_date=$all_data-count($array);
                        echo "成功导入".$success_date."条数据<br/>";
                        echo "失败".count($array)."条数据<br/>"; 
                        echo "<a href='?g=User&m=Share&a=index'>返回</a><br/>";              
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
             echo "<a href='?g=User&m=Share&a=index'>返回</a><br/>";
             exit();
           }
           return $msg;
        }
        
    }

    //单个领取佣金的操作
    public function lqone(){
	$token=$this->token;
       $where['id']=intval($_GET['id']);
       $where['token']=$this->token;
	   //查询领取金额是否大于剩余资金总额
	   $rewardinfo=D('agent_rewardinfo')->where($where)->find();
	   $lpname=$rewardinfo['loupanname'];
	   $rewardamount=$rewardinfo['rewardamount'];   //需要领取的佣金数
	   //通过项目名称查询项目id
	   $lpinfo=D('lpinfo')->where("token='$token' and LouPanTitle='$lpname'")->find();
	   if(!$lpinfo){
			$this->error("楼盘不存在");
	   }
	   $lpid=intval($lpinfo['id']);      //查询出的lpid
	   //通过楼盘id查询该项目所充值的总佣金
		$allmoney=D('Capital')->where("token='$token' and lpid=$lpid")->sum("money");
        if (!$allmoney) {
            $this->error("请先给该项目充值佣金");
        }
	   //查询已领取总佣金
	   $ylmoney=D("agent_rewardinfo")->where("token='$token' and loupanname='$lpname' and rewardstatus=1")->sum("rewardamount");
	   $symoney=intval($allmoney)-intval($ylmoney); //剩余的佣金数
	   if($symoney<$rewardamount){
			$this->error("金额不足领取失败");
	   }
       //将状态改变为1表示已领取
       $data['rewardstatus']=1;
       if(D('agent_rewardinfo')->where($where)->save($data)){
        $this->success("领取成功",U('Share/reward',array('token'=>$where['token'])));
       }else{
        $this->error("领取失败");
       }
    }

    //多个领取佣金的操作
    public function lqall(){
        $where['token']=$this->token;
        $where['id']=array("in",$_GET['allid']);
        $token=$this->token;
        //将相同的项目进行分类并计算出每个项目的总领取额
        $rewards=D("agent_rewardinfo")->where($where)->field("loupanname,sum(rewardamount) as rewardamount")->group("loupanname")->select();
        $rewardslength=count($rewards);
        for($i=0;$i<$rewardslength;$i++){
            $LouPanTitle=$rewards[$i]['loupanname'];
            //查询当前项目的所有佣金
            $sql="select sum(cap.money) as allmoney 
                    from wy_Capital as cap,wy_lpinfo as lp 
                    where cap.token='$token' and cap.token=lp.token and cap.lpid=lp.id and lp.LouPanTitle='$LouPanTitle' 
                    group by cap.lpid";
            $Capital=D("Capital")->query($sql);
            $allmoney=intval($Capital[0]['allmoney']);   //当前项目的所有佣金
            if(!$allmoney){
                $this->error("请先给'$LouPanTitle'项目充值");
            }
            //查询当前项目已发佣金
            $rewardinfo=D("agent_rewardinfo")->field("loupanname,sum(rewardamount) as yrewardamount")->where("token='$token' and rewardstatus=1 and loupanname='$LouPanTitle'")->find();
            $ylmoney=intval($rewardinfo['yrewardamount']);
            //剩余佣金
            $symoney=$allmoney-$ylmoney;
            if($rewards[$i]['rewardamount']>$symoney){
                $this->error("'$LouPanTitle'项目佣金不足请充值");
            }
        }        

        //未判断佣金余额是否足够
        //通过楼盘id查询该项目所充值的总佣金
        // $allmoney=D('Capital')->where("token='$token' and lpid=$lpid")->sum("money");
        // if (!$allmoney) {
        //     $this->error("请先给该项目充值");
        // }

        
		
        //将状态改变为1表示已领取
        $data['rewardstatus']=1;
        $reward=D("agent_rewardinfo");
        if($reward->where($where)->save($data)){
         $this->success("领取成功",U('Share/reward',array('token'=>$where['token'])));
       }else{
        $this->error("领取失败");
       }
        
    }

    //佣金信息搜索
    public function search(){
        // var_dump($_POST);die();
        $token=$this->token;
        $jjrname=trim($_POST['jjrname']);
        if($_POST['rewardstatus']==''){
            $rewardstatus='';
        }else{
            $rewardstatus=intval($_POST['rewardstatus']);
        }
        
        //查询佣金奖励总数
        $reward=D("agent_rewardinfo");
        $sql="SELECT count('id') as count 
            from wy_agent_rewardinfo as reward, wy_jjr as jjr 
            where reward.wecha_id=jjr.Wecha_id and jjr.Token=reward.token 
            and reward.token='$token' and jjr.`Name` like '%$jjrname%' and reward.rewardstatus like '%$rewardstatus%'";
        $count=$reward->query($sql);
        $count=intval($count);
        // echo D("agent_rewardinfo")->getLastSql();
        // var_dump($count);die();
        // $count=$reward->where("token='$token'")->count();
        $page=new Page($count,20);
        //传入分页变量
        // $map['jjrname'] = $_GET['jjrname']; 
        // $map['rewardstatus'] = $_GET['rewardstatus']; 
        // foreach($map as $key=>$val) { 
        //     $p->parameter .= "$key=".urlencode($val)."&"; 
        // }
        $firstRow=$page->firstRow;
        $listRows=$page->listRows;
        $sql1="SELECT jjr.`Name` ,reward.id,reward.token, reward.loupanname,reward.customname,reward.statusname,
                reward.rewardname,reward.rewardamount,reward.rewardstatus,reward.srtime  
                from wy_agent_rewardinfo as reward, wy_jjr as jjr 
                where reward.wecha_id=jjr.Wecha_id and jjr.Token=reward.token 
                and reward.token='$token' and jjr.`Name` like '%$jjrname%' and reward.rewardstatus like '%$rewardstatus%' 
                order by reward.rewardstatus,jjr.Name desc limit $firstRow,$listRows";
        $list=$reward->query($sql1);
        $this->assign('token',$token);
        $this->assign("list",$list);
        $this->assign('page',$page->show());
        $this->display();
    }

}




?>