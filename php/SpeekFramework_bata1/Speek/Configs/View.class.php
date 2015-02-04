<?php
class View extends Smarty{
	function __construct(){
		global $K;
		$this->caching = $K['cach'];
		$this->template_dir = $K['template'];
		$this->compile_dir = $K['compile'];
		$this->cache_dir = $K['cache'];
		$this->left_delimiter = $K['s_left'];
		$this->right_delimiter = $K['s_right'];
	}
}
?>