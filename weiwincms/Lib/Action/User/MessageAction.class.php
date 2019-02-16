<?php
class MessageAction extends UserAction{
    public $thisWxUser;
    public function _initialize(){
        parent :: _initialize();
        $where = array('token' => $this -> token);
        $this -> thisWxUser = M('Wxuser') -> where($where) -> find();
        $this -> canUseFunction('message');
        if (!$this -> thisWxUser['appid'] || !$this -> thisWxUser['appsecret']){
            $diyApiConfig = M('Diymen_set') -> where($where) -> find();
            if (!$diyApiConfig['appid'] || !$diyApiConfig['appsecret']){
                $this -> error('请先设置AppID和AppSecret再使用本功能，谢谢', '?g=User&m=Index&a=edit&id=' . $this -> thisWxUser['id']);
            }else{
                $this -> thisWxUser['appid'] = $diyApiConfig['appid'];
                $this -> thisWxUser['appsecret'] = $diyApiConfig['appsecret'];
            }
        }
    }
    public function sendHistory(){
        $db = D('Send_message');
        $where['token'] = $this -> token;
        $count = $db -> where($where) -> count();
        $page = new Page($count, 25);
        $info = $db -> where($where) -> order('id DESC') -> limit($page -> firstRow . ',' . $page -> listRows) -> select();
        $this -> assign('page', $page -> show());
        $this -> assign('info', $info);
        $this -> display();
    }
    public function index(){
        $ac=D('ac');
        $token=session('token');
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
		
        $count=$ac->where($where)->count();
        $page=new Page($count,20);
		foreach($where1 as $key=>$val) {
			$page->parameter .= "$key=".urlencode($val)."&";
		}
        $firstRow=$page->firstRow;
        $listRows=$page->listRows;
        // $sql="select ac.ID,ac.Token,ac.Name,ac.Tel,lp.LouPanTitle,ac.addTime 
                // from wy_ac as ac,wy_lpinfo as lp 
                // where ac.Token='{$token}' and ac.Uid=lp.id 
                // order by ac.ID DESC limit {$firstRow},{$listRows}";
        
        // $list=$ac->query($sql);
		$list = $ac->where($where)->limit($firstRow,$listRows)->order('id desc')->select();
        $this->assign('page',$page->show());
        $this->assign('list',$list);
        $this->display();
    }
    public function sendAll(){
        if (IS_POST){
            $imgids = $this -> _post('imgids');
            $wechatgroupid = $_POST['wechatgroupid'];
            $imgidsArr = explode(',', $imgids);
            $imgids = array();
            $imgID = 0;
            if ($imgidsArr){
                foreach ($imgidsArr as $ii){
                    if (intval($ii)){
                        array_push($imgids, $ii);
                    }
                }
            }
            if (count($imgids)){
                $imgs = M('Img') -> where(array('id' => array('in', $imgids))) -> select();
            }
            if ($imgs){
            }else{
                $this -> error('请选择图文消息', U('Message/index'));
            }
            $url_get = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $this -> thisWxUser['appid'] . '&secret=' . $this -> thisWxUser['appsecret'];
            $json = json_decode($this -> curlGet($url_get));
            $mediaids = '';
            if (!$json -> errmsg){
                $postMedia = array();
                $postMedia['access_token'] = $json -> access_token;
                $postMedia['type'] = 'image';
                foreach ($imgs as $img){
                    $postMedia['media'] = $_SERVER['DOCUMENT_ROOT'] . str_replace('http://' . $_SERVER['HTTP_HOST'], '', $img['pic']);
                    $rt = $this -> curlPost('http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=' . $postMedia['access_token'] . '&type=' . $postMedia['type'], array('media' => '@' . $postMedia['media']));
                    if($rt['rt'] == false){
                        $this -> error('操作失败,curl_error:' . $rt['errorno']);
                    }else{
                        $mediaids .= $comma . $rt['media_id'];
                        $comma = ',';
                    }
                }
            }else{
                $this -> error('获取access_token发生错误：错误代码' . $json -> errcode . ',微信返回错误信息：' . $json -> errmsg);
            }
            $this -> success('图片素材上传完毕，现在开始发送信息', U('Message/tosendAll', array('imgids' => $this -> _post('imgids'), 'wechatgroupid' => $wechatgroupid, 'mediaids' => $mediaids)));
        }
    }
    public function tosendAll(){
        //if (IS_POST){
            $row = array();
            $row['msgtype'] = 'news';
            $row['imgids'] = $this -> _get('imgids');
            $row['token'] = $this -> token;
            $row['time'] = time();
            $mediaids = explode(',', $_GET['mediaids']);
            $url_get = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $this -> thisWxUser['appid'] . '&secret=' . $this -> thisWxUser['appsecret'];
            $json = json_decode($this -> curlGet($url_get));
            if (!$json -> errmsg){
                $postMedia = array();
                $postMedia['access_token'] = $json -> access_token;
                $imgidsArr = explode(',', $row['imgids']);
                $imgids = array();
                $imgID = 0;
                if ($imgidsArr){
                    foreach ($imgidsArr as $ii){
                        if (intval($ii)){
                            array_push($imgids, $ii);
                        }
                    }
                }
                if (count($imgids)){
                    $imgs = M('Img') -> where(array('id' => array('in', $imgids))) -> select();
                }
                if ($imgs){
                    $str = '{"articles": [';
                    $comma = '';
                    $i = 0;
                    foreach ($imgs as $img){
                        if ($img['url']){
                        }else{
                        }
                        $str .= $comma . '{"thumb_media_id":"' . $mediaids[$i] . '","author":"","title":"' . $img['title'] . '","content_source_url":"","content":"' . $img['info'] . '","digest":"' . $img['text'] . '"}';
                        $comma = ',';
                        $i++;
                    }
                    $str .= ']}';
                }else{
                    $this -> error('请选择图文消息', U('Message/index'));
                }
                $rt = $this -> curlPost('https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=' . $postMedia['access_token'], $str);
                if($rt['rt'] == false){
                    $this -> error('操作失败,curl_error:' . $rt['errorno']);
                }else{
                    $media_id = $rt['media_id'];
                    $row['mediaid'] = $media_id;
                }
            }else{
                $this -> error('获取access_token发生错误：错误代码' . $json -> errcode . ',微信返回错误信息：' . $json -> errmsg);
            }
            $id = M('Send_message') -> add($row);
            $sendrt = $this -> curlPost('https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=' . $postMedia['access_token'], '{"filter":{"group_id":"' . $this -> _get('wechatgroupid') . '"},"mpnews":{"media_id":"' . $row['mediaid'] . '"},"msgtype":"mpnews"}');
            if($sendrt['rt'] == false){
                $this -> error('操作失败,curl_error:' . $sendrt['errorno']);
            }else{
                $msg_id = $rt['msg_id'];
                M('Send_message') -> where(array('id' => $id)) -> save(array('msg_id' => $msg_id));
                $this -> success('发送任务已经启动，群发可能会在20分钟左右完成，您可以关闭该页面了', U('Message/sendHistory'));
            }
      //  }
    }
    public function item(){
        if (isset($_GET['id'])){
            $info = M('Send_message') -> where(array('token' => $this -> token, 'id' => intval($_GET['id']))) -> find();
            $this -> assign('info', $info);
        }
        if ($info['msgtype'] == 'news'){
            $imgids = explode(',', $info['imgids']);
            $imgID = 0;
            if ($imgids){
                foreach ($imgids as $ii){
                    if (intval($ii)){
                        $imgID = $ii;
                    }
                }
            }
            $thisNews = M('Img') -> where(array('id' => $imgID)) -> find();
            $this -> assign('img', $thisNews);
        }
        $this -> display();
    }
    public function send(){
        $fans = M('Wechat_group_list') -> where(array('token' => $this -> token)) -> order('id ASC') -> select();
        $i = intval($_GET['i']);
        $count = count($fans);
        $thisMessage = M('Send_message') -> where(array('id' => intval($_GET['id']))) -> find();
        if ($i < $count){
            $fan = $fans[$i];
            $url_get = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $this -> thisWxUser['appid'] . '&secret=' . $this -> thisWxUser['appsecret'];
            $json = json_decode($this -> curlGet($url_get));
            if (!$json -> errmsg){
                switch ($thisMessage['msgtype']){
                case 'text': $data = '{"touser":"' . $fan['openid'] . '","msgtype":"text","text":{"content":"' . $thisMessage['text'] . '"}}';
                    break;
                case 'image': case 'voice': $data = '{"touser":"' . $fan['openid'] . '","msgtype":"' . $thisMessage['msgtype'] . '","' . $thisMessage['msgtype'] . '":{"media_id":"' . $thisMessage['mediaid'] . '"}}';
                    break;
                case 'video': $data = '{"touser":"' . $fan['openid'] . '","msgtype":"' . $thisMessage['msgtype'] . '","' . $thisMessage['msgtype'] . '":{"media_id":"' . $thisMessage['mediaid'] . '","description":"' . $thisMessage['text'] . '","title":"' . $thisMessage['title'] . '"}}';
                    break;
                case 'music': $data = '{"touser":"' . $fan['openid'] . '","msgtype":"' . $thisMessage['msgtype'] . '","' . $thisMessage['msgtype'] . '":{"media_id":"' . $thisMessage['mediaid'] . '"}}';
                    break;
                case 'news': $imgids = explode(',', $thisMessage['imgids']);
                    $imgID = 0;
                    if ($imgids){
                        foreach ($imgids as $ii){
                            if (intval($ii)){
                                $imgID = $ii;
                            }
                        }
                    }
                    $thisNews = M('Img') -> where(array('id' => $imgID)) -> find();
                    if ($thisNews['url']){
                        $url = str_replace(array('{wechat_id}', '{siteUrl}', '&amp;'), array($fan['openid'], C('site_url'), '&'), $thisNews['url']);
                    }else{
                        $url = C('site_url') . U('Wap/Index/content', array('token' => $this -> token, 'wecha_id' => $fan['openid'], 'id' => $thisNews['id']));
                    }
                    $data = '{"touser":"' . $fan['openid'] . '","msgtype":"' . $thisMessage['msgtype'] . '","news":{"articles":[{"title":"' . $thisNews['title'] . '","description":"' . $thisNews['text'] . '","url":"' . $url . '","picurl":"' . $thisNews['pic'] . '"}]}}';
                    break;
                }
                $rt = $this -> curlPost('https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=' . $json -> access_token, $data, 0);
                if($rt['rt'] == false){
            }else{
                M('Send_message') -> where(array('id' => intval($thisMessage['id']))) -> setInc('reachcount');
            }
            $i++;
            $this -> success('发送中:' . $i . '/' . $count, U('Message/send', array('id' => $thisMessage['id'], 'i' => $i)));
        }else{
            $this -> error('获取access_token发生错误：错误代码' . $json -> errcode . ',微信返回错误信息：' . $json -> errmsg);
        }
    }else{
        $this -> success('发送完成，发送成功' . $thisMessage['reachcount'] . '条', U('Message/sendHistory'));
    }
}
public function img(){
    $db = M('Img');
    $where = array('token' => $this -> token);
    $count = $db -> where($where) -> count();
    $Page = new Page($count, 5);
    $show = $Page -> show();
    $list = $db -> where($where) -> limit($Page -> firstRow . ',' . $Page -> listRows) -> order('id DESC') -> select();
    $items = array();
    if ($list){
        foreach ($list as $item){
            array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'pic' => $item['pic'], 'info' => $item['text'], 'linkcode' => '{siteUrl}/index.php?g=Wap&m=Index&a=content&token=' . $this -> token . '&wecha_id={wechat_id}&id=' . $item['id'], 'linkurl' => '', 'keyword' => $item['keyword']));
        }
    }
    $this -> assign('list', $items);
    $this -> assign('page', $show);
    $this -> display();
}
function curlPost($url, $data, $showError = 1){
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
    $errorno = curl_errno($ch);
    if ($errorno){
        return array('rt' => false, 'errorno' => $errorno);
    }else{
        $js = json_decode($tmpInfo, 1);
        if (intval($js['errcode'] == 0)){
            return array('rt' => true, 'errorno' => 0, 'media_id' => $js['media_id'], 'msg_id' => $js['msg_id']);
        }else{
            if ($showError){
                $this -> error('发生了Post错误：错误代码' . $js['errcode'] . ',微信返回错误信息：' . $js['errmsg']);
            }
        }
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

//新增案场经理
public function addanchang(){
    $lpinfo=D("lpinfo");
    if(IS_POST){
        $arr=array();
        $arr["Token"]=session("token");
        $arr['Tel']=trim($_POST['Tel']);
		
		$acinfo = D("ac")->where($arr)->find();
		if($acinfo){
			$this->error("手机号已存在");
		}
		
        $arr['Name']=trim($_POST['Name']);
		$arr['password']=trim($this->_post('password'));
			
		if($arr['Tel']){
			$arr['Wecha_id'] = md5($arr['Tel']);  //因为不用微信登录了就用手机号的md5作为唯一标识
		}
		if($arr['password']){
			$arr['password']=md5($arr['password']);
		}
			
        $arr['Uid']=implode(',',$this->_post('Uid'));
        $arr['addTime']=time();
        if(D("ac")->add($arr)){
            $this->success("添加成功",U("Message/index",array('token'=>$this->token)));
        }else{
            $this->error("添加失败",U("Message/addanchang",array('token'=>$this->token)));
        }
    }else{
        $where['token']=session("token");
        $lp=$lpinfo->where($where)->field('ID,LouPanTitle')->order("ID desc")->select();
        $this->assign("lp",$lp);
        $this->display();
    }
    
}
//修改案场经理
public function edit(){
    
   $id=$_GET['id'];
        if(IS_POST){
            $arr=array();
            $arr["Token"]=$this->token;
            $arr['Tel']=trim($_POST['Tel']);
			$acinfo = D('ac')->where($arr)->find();
			
            $arr['ID']=$_POST['ID'];
			if($acinfo && $acinfo['ID'] != $arr['ID']){
				$this->error("手机号修改后存在冲突");
			}
			
			if($arr['Tel']){
				$arr['Wecha_id'] = md5($arr['Tel']);  //因为不用微信登录了就用手机号的md5作为唯一标识
			}
			if($_POST['password']){
				$arr['password']=md5($_POST['password']);
			}
			
            $arr['Name']=trim($_POST['Name']);
            $arr['Uid']=implode(',',$this->_post('Uid'));
            
            if(D("ac")->save($arr)){
                $this->success("修改成功",U("Message/index",array('token'=>$this->token)));
            }else{
                $this->error("修改失败");
            }
        }else{
            $Token=session("token");
            // $sql="select ac.ID,ac.Token,ac.Name,ac.Tel,lp.LouPanTitle,ac.addTime 
            //             from wy_ac as ac,wy_lpinfo as lp 
            //             where ac.Token='{$token}' and ac.Uid=lp.id and ac.ID=$id limit 1";
            // $list=D("ac")->query($sql);
            $lp=D("lpinfo")->where("Token='$Token'")->field('ID,LouPanTitle')->order("ID desc")->select();
            $list=D("ac")->where("Token='$Token'")->find($id);
			$lps = explode(',',$list['Uid']);
            $this->assign("lp",$lp);
            $this->assign("list",$list);
			$this->assign("lps",$lps);
            $this->display();
        }
    
}
//删除案场经理
public function del(){
    $data=D('ac');
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

//导入案场经理
public function excinac(){
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
                $rt[0] = iconv("GB2312","UTF-8",$rt[0]);           //案场经理姓名
                $rt[1] = iconv("GB2312","UTF-8",$rt[1]);           //案场经理电话
                $rt[2] = iconv("GB2312","UTF-8",$rt[2]);           //案场经理所属楼盘
                $rt[3] = iconv("GB2312","UTF-8",$rt[3]);           //案场经理注册时间
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
                                $data=D("ac");
                                $mtime=strtotime($r[3]);
                                $token=session('token');
                                $sql="insert into wy_ac (`Token`,`Name`,`Tel`,`Uid`,`addTime`) values ('$token','$r[0]','$r[1]',$Uid,$mtime)";
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
                        echo "<a href='?g=User&m=Message&a=index'>返回</a><br/>";              
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
             echo "<a href='?g=User&m=Message&a=index'>返回</a><br/>";
             exit();
           }
           return $msg;
        }

}


//意向客户分配列表显示页
public function index2(){
    $kh=D('kh');
        $token=session('token');
        $where=array('Token'=>"$token");
        $count=$kh->where($where)->count();
        $page=new Page($count,20);
        $firstRow=$page->firstRow;
        $listRows=$page->listRows;
        $sql="select kh.ID,kh.Token,kh.Wecha_id,kh.`Name`,kh.Tel,lp.LouPanTitle,jjr.`Name` as jjr_name,zy.Name as zy_name, 
                kh.Stutas,kh.SrTime,kh.yxTime,kh.DcTime,kh.RcTime,kh.RgTime,kh.QyTime,kh.HkTime,status.salesstatus  
                from wy_kh as kh LEFT JOIN wy_jjr as jjr ON kh.JJ_id=jjr.ID 
                LEFT JOIN wy_lpinfo as lp ON kh.LouPanTitle=lp.id LEFT JOIN wy_zy as zy on kh.zy_id=zy.ID 
                LEFT JOIN wy_agent_status as status on status.id=kh.Stutas 
                where 1=1 and kh.Token='$token' 
                ORDER BY kh.ID DESC 
                LIMIT $firstRow,$listRows";
        $list=$kh->query($sql);
        $this->assign('page',$page->show());
        $this -> assign('list', $list);
        $this -> display();
}
//意向客户分配内容页
public function customOfModule(){
     $kh=D('kh');
        if(IS_POST){
            $arr=array();
            $arr['ID']=intval($this->_post("ID"));
            $arr['Name']=trim($this->_post('Name'));
            $arr['Tel']=trim($this->_post('Tel'));
            $arr['zy_id']=trim($this->_post('zy_id'));
            $arr['Stutas']=trim($this->_post('Stutas'));
            // $arr['addTime']=strtotime($this->_post('addTime'));
            $arr['yxTime']=strtotime($this->_post('yxTime'));
            $arr['Token']=$this->token;
            if($kh->save($arr)){
                $this->success("修改成功",U("Message/index2"));
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
            //查询所有楼盘信息
            $lp=D("lpinfo")->where("Token='$token'")->field('ID,LouPanTitle')->order("ID desc")->select();
            //查询该客户的信息
            $list=D("kh")->where("Token='$token'")->find($id);
            //通过销售状态id查询对应的销售状态排名
            $statusid=intval($list['Stutas']);
            $sort=D("agent_status")->find($statusid);
            $sort=intval($sort['sort']);
            $status=D("agent_status")->where("Token='$token' and sort>=$sort")->order("sort")->select();
            //查询经纪人信息
            $jjr=D("jjr")->where("Token='$token'")->field('ID,Name')->order("ID desc")->select();
            //查询置业顾问信息
            $zy=D("zy")->where("Token='$token'")->field('ID,Name')->order("ID desc")->select();
            // var_dump($lp);die();
            $this->assign("lp",$lp);
            $this->assign("jjr",$jjr);
            $this->assign("zy",$zy);
            $this->assign("list",$list);
            $this->assign("status",$status);
            $this->display();  
        }
        
}
//删除意向客户
public function customdel(){
    $data=D('kh');
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
}
?>