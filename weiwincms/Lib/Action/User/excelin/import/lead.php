<?php
/*--------------下面是对mysql数据库的连接----------*/
 @session_start();
 error_reporting(0);
 deltree('./upfile');
function deltree($pathdir)  
{  
  //echo $pathdir.'<br/>';//我调试时用的   
  //否则读这个目录，除了.和..外   
 $d=dir($pathdir);  
  while($a=$d->read())   //下只删除$pathdir下
	  {  
			 if(is_file($pathdir.'/'.$a) && ($a!='.') && ($a!='..'))
			 {
			  unlink($pathdir.'/'.$a); //如果是文件就直接删除 
			 }
			  
	  }  
	  $d->close();            
	  
} 
 @require('../public/mysql_class.php');
 include "../public/config_class.php";
 $config = new Config('../config/config.xml');
 $mysql = new Mysql($config->hostName,$config->userName,$config->dbPwd,$config->dbName,'utf8');              //连接数据库

 if($_POST['leadExcel'] == "true")
 {  

 $filename = $_FILES['inputExcel']['name']; 
 $tmp_name = $_FILES['inputExcel']['tmp_name'];
 $msg = uploadFile($filename,$tmp_name);   

 }
	
//导入Excel文件
function uploadFile($file,$filetempname)
{
		 mysql_query("delete from wd_info where pid=17");
//自己设置的上传文件存放路径
$filePath = 'upFile/';
$str = "";

//下面的路径按照你PHPExcel的路径来修改

require_once '../public/phpexcel/PHPExcel.php';
require_once '../public/phpexcel/PHPExcel.php';
require_once '../public/phpexcel/PHPExcel\IOFactory.php';
require_once '../public/phpexcel/PHPExcel\Reader\Excel5.php';
$filename=explode(".",$file);//把上传的文件名以“.”好为准做一个数组。
$time=date("y-m-d-H-i-s");//去当前上传的时间
$filename[0]=$time;//取文件名t替换
$name=implode(".",$filename); //上传后的文件名
$uploadfile=$filePath.$name;//上传后的文件名地址
//move_uploaded_file() 函数将上传的文件移动到新位置。若成功，则返回 true，否则返回 false。
$result=move_uploaded_file($filetempname,$uploadfile);//假如上传到当前目录下
// exit();
  if($result) //如果上传文件成功，就执行导入excel操作
  {
	$objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format
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
    	$rt[0] = iconv("GB2312","UTF-8",$rt[0]);
		$rt[1] = iconv("GB2312","UTF-8",$rt[1]);
		$rt[2] = iconv("GB2312","UTF-8",$rt[2]);
		$rt[3] = iconv("GB2312","UTF-8",$rt[3]);
/*------------------------------------------------如果成功导入-----------------------------*/		
	   if(trim($rt[0])=="产品编号"  )
        { 
			
			for($j=2;$j<=$highestRow;$j++)
			{
				for($k='A';$k<=$highestColumn;$k++)
				{
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
							$r[6] = iconv("gbk","UTF-8",$strs[6]);
								$r[7] = iconv("gbk","UTF-8",$strs[7]);
									$r[8] = iconv("gbk","UTF-8",$strs[8]);
										$r[9] = iconv("gbk","UTF-8",$strs[9]);
											$r[10] = iconv("gbk","UTF-8",$strs[10]);
												$r[11] = iconv("gbk","UTF-8",$strs[11]);
													$r[12] = iconv("gbk","UTF-8",$strs[12]);
														$r[13] = iconv("gbk","UTF-8",$strs[13]);
															$r[14] = iconv("gbk","UTF-8",$strs[14]);
																$r[15] = iconv("gbk","UTF-8",$strs[15]);
																	$r[16] = iconv("gbk","UTF-8",$strs[16]);
																$r[17] = iconv("gbk","UTF-8",$strs[17]);
																			$r[18] = iconv("gbk","UTF-8",$strs[18]);
																				$r[19] = iconv("gbk","UTF-8",$strs[19]);
																					$r[20] = iconv("gbk","UTF-8",$strs[20]);
												
								
				
/*--------------------------------------------------------------------------------------------------*/
			   if($r[0]=="" || $r[1]=="" || $r[3]=="")
				  {
					$array[]="第".$j."条失败，原因：数据不完整！";
				  }
			  else
			  {
			 //$sql="insert into class (a,b,c,d) values ('$r[0]','$r[1]','$r[2]','$r[3]')";	
	
			 	
			$sql="insert into wd_n (`bh`,`name`,`fg`,`kc`,`dj`,`yhjg`,`bz`,`hmgg`,`zzgg`,`ms`,`lx`,`hkcz`,`kkd`,`khd`,`hkys`,`hkwz`,`hkgg`,`qm`,`kxwz`,`hxgg`) values ('$r[0]','$r[1]','$r[2]','$r[3]','$r[4]','$r[5]','$r[6]','$r[7]','$r[8]','$r[9]','$r[10]','$r[11]','$r[12]','$r[13]','$r[14]','$r[15]','$r[16]','$r[17]','$r[18]','$r[19]')";
	
			mysql_query($sql);
			  }
				$str = "";
			 }
				unlink($uploadfile); //删除上传的excel文件
				$one=1;
			    $all_data=$highestRow-$one;
				echo "共".$all_data."条数据<br/>";
			    $success_date=$all_data-count($array);
				echo "成功导入".$success_date."条数据<br/>";
				echo "失败".count($array)."条数据<br/>";	
					echo "<a href='../import/import.php'>返回</a><br/>";				
				//如果有失败的，显示哪一条失败
				if(count($array)>0)
				{
					foreach ($array as $value)
					{  
					   echo $value."<br/>";  
					 }
				}
			    exit();
		 }
      else
          {
		    echo "文件格式不正确，请下载模板！";
		    
		  }	  
				
				
  }
else
  {
     $msg = "上传失败！";
	 echo $msg;
	 exit();
   }
   return $msg;
}
?>