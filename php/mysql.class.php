<?php
	class Mysql{
		public function connect($host,$user,$pass,$db){
			$con = mysql_connect($host,$user,$pass);
			if(!$con){
				die('Could not connect: '.mysql_error());
			}else{
				$reust = mysql_select_db($db);
				if($reust){
					mysql_query("set names utf-8");
				}else{
					die('Could not select db '.$db.' '.mysql_error());
				}
			}
		}
	}
?>
