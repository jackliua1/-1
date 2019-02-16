<!DOCTYPE html>
<html>
<head>
    <title>导出数据</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript">     
        function countDown(secs,surl){     
         //alert(surl);     
         var jumpTo = document.getElementById('jumpTo');
         jumpTo.innerHTML=secs;  
         if(--secs>0){     
             setTimeout("countDown("+secs+",'"+surl+"')",1000);     
             }     
         else{       
             location.href=surl;     
             }     
         }     
    </script> 
</head>
<?php 
// 导出数据库
if(isset($_GET['type'])){
  header("Content-Type:text/html;   charset=utf-8");
    $host = "localhost";
    $user = "root"; //数据库账号
    $password = ""; //数据库密码
    $dbname = "tpblog"; //数据库名称
    $tabname=array("tp_url","tp_user","tp_attr");    //表名

    @mysql_connect($host,$user,$password) or die("MYSQL连接失败");
    @mysql_select_db($dbname) or die("指定数据库不存在");
    mysql_query("set names 'utf8'");
    $mysql = "set charset utf8;\r\n";
    $q1 = mysql_query("show tables");
    // while ($t = mysql_fetch_array($q1))
    // {
    //     $table = $t[0];
        // $q2 = mysql_query("show create table `$table`");
        // $sql = mysql_fetch_array($q2);
        // $mysql .= $sql['Create Table'] . ";\r\n";
    foreach ($tabname as $key => $val) {
        $q3 = mysql_query("select * from `$val`");
        while ($data = mysql_fetch_assoc($q3))
        {
            $keys = array_keys($data);
            $keys = array_map('addslashes', $keys);
            $keys = join('`,`', $keys);
            $keys = "`" . $keys . "`";
            $vals = array_values($data);
            $vals = array_map('addslashes', $vals);
            $vals = join("','", $vals);
            $vals = "'" . $vals . "'";
            $mysql .= "insert into `$val`($keys) values($vals);\r\n";
        }
    }
         
    // } 
     
    $filename = $dbname . date('Ymjgi') . ".sql"; //存放路径，默认存放到项目最外层
    $fp = fopen($filename, 'w');
    fputs($fp, $mysql);
    fclose($fp);
    echo "数据导出成功,<span id='jumpTo'>5</span>秒后自动跳转 <a href=''>返回</a><script type='text/javascript'>countDown(5,'1.php');</script>";exit;  
}

?>

<body>
<a href="?type=download">导出数据</a>
</body>
</html>