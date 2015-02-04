<?php

class Control {
    protected $view = NULL;
	protected $model = NULL;
    public function __construct()
    {
		
        $this->view = new View();
		$this->model = new Model();
	}
    public function assign($var, $value)
    {
       $this->view->assign($var, $value);
    }
    //public function display($file)
   // {
   //     $this->view->display($file);
   // }
    public function Run() {
		global $K;
		if(!file_exists($K['template'])){
			mkdir($K['template']);
		}
		if(!file_exists($K['compile'])){
			mkdir($K['compile']);
		}
		if(!file_exists($K['cache'])){
			mkdir($K['cache']);
		}
		if(!file_exists($K['template'].'/'.$K['DEFAULT_VIEW'])){
			mkdir($K['template'].'/'.$K['DEFAULT_VIEW']);
		}
    	$this->Getcm();
    	$control = $_GET['a'];
    	$method  = $_GET['b'];
    	if(!$control){
    		echo '控制器:'.$control.'未定义！';
    		exit();
    	}else{
    		$controlfile = SPEEK_PATH.'/Controls/'.$control.'Control.class.php';
    		include($controlfile);
    	}		
    	$class = ucwords($control).'Control';
    	if(!class_exists($class)){
			echo '控制器:'.$control.'未定义！';
			exit();
    	}
    	$pram = new $class;
    	if(!method_exists($pram,$method)){
			echo '方法'.$method.'未定义！';
			exit();
    	}
		$modelfile = SPEEK_PATH.'/Models/'.ucwords($control).'Model.class.php';
		if(!file_exists($modelfile)){
			copy(SPEEK_PATH.'/Configs/file.class.php',SPEEK_PATH.'/Models/'.ucwords($control).'Model.class.php');
			$con = '<?php
	class '.ucwords($control).'Model extends Model{
	}
?>';
			file_put_contents(SPEEK_PATH.'/Models/'.ucwords($control).'Model.class.php',$con);
			include($modelfile);
		}else{
			include($modelfile);
		}
		$viewfile = SPEEK_PATH.'/templates/'.$K['DEFAULT_VIEW'].'/'.ucwords($control).'_'.$method.'.html';
		if(!file_exists($viewfile)){
			copy(SPEEK_PATH.'/Configs/file.class.php',SPEEK_PATH.'/templates/'.$K['DEFAULT_VIEW'].'/'.ucwords($control).'_'.$method.'.html');
			$con = '<!DOCTYPE html>
<head><title>'.$K['s_left'].'$title'.$K['s_right'].'</title>
</head>
<body>
</body>
</html>';
			file_put_contents(SPEEK_PATH.'/templates/'.$K['DEFAULT_VIEW'].'/'.ucwords($control).'_'.$method.'.html',$con);
		}
    	$pram->$method();
    }
    protected function Getcm(){

		global $K;
		if($K['URL_MODE'] == 1){
			$control = !empty($_GET['a']) ? trim($_GET['a']) : '';
			$method  = !empty($_GET['b']) ? trim($_GET['b']) : '';
		}
		if($K['URL_MODE'] == 2){
			if(isset($_SERVER['PATH_INFO']))
			{
				$path    = trim($_SERVER['PATH_INFO'], '/');
				$paths   = explode('/', $path);
				$control = array_shift($paths);
				$method  = array_shift($paths);
			}
		}
		if($K['URL_MODE']==3){
			$control = !empty($_GET['a']) ? trim($_GET['a']) : '';
			$method  = !empty($_GET['b']) ? trim($_GET['b']) : ''; 
			if(isset($_SERVER['PATH_INFO']))
			{
				$path    = trim($_SERVER['PATH_INFO'], '/');
				$paths   = explode('/', $path);
				$control = array_shift($paths);
				$method  = array_shift($paths);
			}
		}
		$_GET['a'] = $control = !empty($control) ? $control : $K['DEFAULT_CONTROL'];
		$_GET['b'] = $method  = !empty($method)  ? $method  : $K['DEFAULT_METHOD'];
    }
	public function display()
    {
		global $K;
        $this->view->display($K['DEFAULT_VIEW'].'/'.ucwords($_GET['a']).'_'.$_GET['b'].'.html');
    }
}
?>
