<?php 	class Mysql	{		private $host;		//主机名		private $user;		//用户名		private $pwd;		//密码		private $dbase;		//数据库		private $coding;	//编码方式				function __construct($host,$user,$pwd,$dbase,$coding)		{			$this->host = $host;			$this->user = $user;			$this->pwd = $pwd;			$this->dbase = $dbase;			$this->coding = $coding;			$this->db_connect();		}		//连接数据库 		function db_connect()		{			$link = mysql_connect($this->host,$this->user,$this->pwd) or die (mysql_error());			@mysql_select_db($this->dbase,$link) or die ("连接数据库失败");			@mysql_query("set names '$this->coding'");		}				//执行sql语句		function query($sql)		{			if(!($result = mysql_query($sql)))				$this->show('Say',$sql);			return $result;		}					}?>