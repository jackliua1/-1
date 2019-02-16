<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
//从数据库中读取
 @session_start();
  @require('public/mysql_class.php');
  include "public/config_class.php";
  $config = new Config('config/config.xml'); 
  /*$conn=mysql_connect($config->hostName,$config->userName,$config->dbPwd) or die ("不能连接数据库服务器:" .mysql_error());
  mysql_select_db("test1",$conn) or die ("不能连接数据库:" .mysql_error());
  mysql_query(" set names 'utf8'");
  $sql="select * from class ";
  $result=mysql_query($sql);*/
 
 
  $mysql = new Mysql($config->hostName,$config->userName,$config->dbPwd,$config->dbName,'utf8');
   mysql_query(" set names 'utf8'");
   $sql="select * from class ";
   $result=$mysql->query($sql);

?> 
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>基本信息</title>
		<meta http-equiv="Content-Type" content="type=text/html; charset=utf-8" />
		<link rel="stylesheet" href="./css/tb.css" ></link>
		<script type="text/javascript" src="./js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="./js/tb.js"></script>
		<script type="text/javascript" src="./js/export.js"></script>
	</head>
	<body >
	   <div id="execl">
		<div id="btn_import"><input id="import" type="button" value="导入" /></div>
		<div id="btn_export"><input id="export" type="button" value="导出" /></div>
	  </div>
		<center>
	 <table border="1" class="tbCmn" >
		 <thead>
			  <th style="width:150px">编号</th>
			  <th style="width:150px">姓名</th>
			  <th style="width:150px">院系</th>
			  <th style="width:150px">专业</th>
			  <th style="width:150px">专业类别</th>		  
		 </thead>
		 <tbody>
		 <?php			 		  
		while($user=mysql_fetch_array($result))
		   	{	   
			 echo "<tr>";
			 echo"<td>$user[id]</td>";	  
			 echo"<td>$user[name]</td>";  
			 echo"<td>$user[major]</td>";  
			 echo"<td>$user[collage]</td>";  
			 echo"<td>$user[sort]</td>";  
			 echo "</tr>";
			}
		 ?>	  
			 
		 </tbody>
	 </table>
	 </center>
	 <!--导入-->
       <div id="showDiv">
			 <div id="show_top">
				 <div id="menu">输入当前的学分</div>
				 <div id="rig" ><a href="#" id="close" ><img id="delete" src="img/delete.jpg" width="12px" height="12px"></img></a></div>
			      
			 </div>
			 <div class="imtem" style="width:300px;">
				<a href="import/学生基本信息.xls"><button class="btuFile"  id="" >下载模板</button></a>
		    </div>
			 <iframe src="import/import.php" width="100%" height="100%"  frameborder=0 marginheight=0px marginwidth=0px></iframe>				
		</div>    
	</body>
</html>