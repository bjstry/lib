<?php
	session_start();
	include_once('mysql.class.php');
	include_once('common.php');
	$config = array(
		'host'   =>  'localhost',
		'user'   =>  'root',
		'pass'   =>  'gentai',
		'db'     =>  'gentai'
	);
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	$mysql = new Mysql();
	$mysql->connect($config['host'],$config['user'],$config['pass'],$config['db']);
?>
