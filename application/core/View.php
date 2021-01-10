<?php

namespace application\core;

class View{

	public $path;
	public $route;
	public $layout = 'default';
	

	public function __construct($route){
		$this->route = $route;
		$this->path = $route['controller'] . '/' . $route['action']; 

	}

	public function render($title, $vars = []){

		extract($vars);
		$layout_path = 'application/views/layouts/' . $this->layout . '.php';
		$view_path = 'application/views/' . $this->path . '.php';

		if(file_exists($view_path)){
			ob_start();
			require $view_path;
			$content = ob_get_clean();
			require $layout_path;
		}else{
			echo 'Вид не найден: ' . $view_path;
		}

	}

	public function redirect($url){
		header('location:' . $url);
		exit;
	}

	public static function errorCode($code){
		http_response_code($code);
		$path_error = 'application/views/errors/' . $code . '.php';

		if(file_exists($path_error)){
			require $path_error;
		}
		
		exit;

	}

	public function message($status, $message){
		exit(json_encode(['status' => $status, 'message' => $message]));
	}

	public function location($url){
		exit(json_encode(['url' => $url]));
	}

}