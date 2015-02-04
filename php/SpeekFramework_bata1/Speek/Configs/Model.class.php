<?php
class Model{
	//$cont = null;
	function __construct(){
		
	}
	function tiao($url,$str){
			echo '<a href='.$url.'>'.$str.'</a>';
	}
	function Mysql(){
		global $K;
		$cont = mysql_connect($K['dbhost'],$K['dbuser'],$K['dbpass']);
		mysql_select_db($K['dbname'],$cont);
		$this->Query('set name'.$K['dbbian']);
	}
	function Query($sql){
		return mysql_query($sql);
	}
	function Fetch($query){
		return mysql_fetch_array($query);
	}
	function Close(){
		mysql_close();
	}
	function My_md5($md5){
		$md5s = md5($md5.'bjs110');
		return $md5s;
	}
	function Y_cookie($cok,$cok_m,$b){
		$this->Mysql();
		if(isset($cok) && isset($cok_m)){
		
		$query = mysql_query("select * from `$b` where `username`='$cok'");
		$row = $this->Fetch($query);
		if($cok_m == md5($this->My_md5($row['username'].$row['password']))){
			return $row;
		}else{
			//$row = '你无权限访问该页！';
			//return $row;
			echo '你无权限访问该页！';
			exit();
		}
		}else{
			echo '你无权限访问该页！';
			exit();
		}
	}
}
?>
