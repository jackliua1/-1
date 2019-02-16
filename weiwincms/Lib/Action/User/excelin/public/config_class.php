<?php 
	class Config
	{
		public $hostName;
		public $dbName;
		public $userName;
		public $dbPwd;
		
		function __construct($xmlPath)
		{
			$xml = simplexml_load_file($xmlPath);  //载入xml文件
			$this->hostName = $xml->hostName; //获取节点的值
			$this->dbName = $xml->dbName;
			$this->userName = $xml->userName;
			$this->dbPwd = $xml->pwd;
		}
	}
?>