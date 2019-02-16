<?php
function isAndroid(){
	if(strstr($_SERVER['HTTP_USER_AGENT'],'Android')) {
		return 1;
	}
	return 0;
}

function out_execle($file_name = 'execle',$title,$content){
	header('Content-Type: text/html; charset=utf-8');
	header('Content-type:application/vnd.ms-execl');
	header('Content-Disposition:filename='.$file_name.'.xls');
	$row_arr = substr('ABCDEFGHIJKLMNOPQRSTUVWXYZ',0,count($title));
	$row = explode('',$row_arr);
	$i=0;
	$fieldCount=count($title);
	$s=0;
	foreach($title as $f){
		if ($s<$fieldCount-1){
			echo iconv('utf-8','gbk',$f['cn'])."\t";
		}else {
			echo iconv('utf-8','gbk',$f['cn'])."\n";
		}
		$s++;
	}
	foreach ($content as $value1){
		$i = 1;
		foreach ($title as $t){
			echo iconv('utf-8','gbk',$value1[$t['en']]);
			if($i < count($title)){
				echo "\t";
			}else{
				echo "\n";
			}
			$i ++;
		}
	}
	exit;
}
?>