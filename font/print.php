<?php
$id = $_REQUEST['id'];
if ($id)
{ 
	//header("Location:index.php?g=User&m=Printer_print&a=index&pid=".$id);
	 $url = $_SERVER['HTTP_HOST']."/index.php?g=User&m=Printer_print&a=index&pid=".$id;
	 //echo $url;exit;
	 $ch = curl_init(); 
	 curl_setopt ($ch, CURLOPT_URL, $url); 
	 curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
	 curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,10); 
	 $content = curl_exec($ch); 
	 echo $content; 
}
else
{
    echo "MSGBEGIN[商家ID为空]MSGEND";
}
