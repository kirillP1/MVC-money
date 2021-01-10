<?php

namespace application\core;

use application\core\View;
abstract class Controller{

	public $route;
	public $view;
	public $model;
	public $acl;
	public $tariffs;

	public function __construct($route){
		$this->route = $route;
		if(!$this->checkAcl()){
			View::errorCode('403');
		}

		$this->view = new View($this->route);
		$this->model = $this->loadModel($this->route['controller']);
		$this->tariffs = require 'application/config/tariffs.php';
	}

	public function loadModel($name){
		$path = 'application\models\\'.ucfirst($name);
		if(class_exists($path)){
			return new $path();		
		}

	}

	public function checkAcl(){
		$acl_path = 'application/acl/' . $this->route['controller'] . '.php' ;

		if(file_exists($acl_path)){
			$this->acl = require $acl_path;
		}else{
			exit('fuckl');
		}
		
		
		if($this->isAcl('all')){
			return true;
		}else if(isset($_SESSION['account']['id']) and $this->isAcl('authorize')){
			return true;
		}else if(!isset($_SESSION['account']['id']) and $this->isAcl('guest')){
			return true;
		}else if(isset($_SESSION['admin']) and $this->isAcl('admin')){
			return true;
		}else{
			return false;
		}
	}

	public function isAcl($key = []){
		if(empty($key)){
			return false;
		}else{
			return in_array($this->route['action'], $this->acl[$key]);	
		}
	}

	public function before(){
		//Замена layout
	}
}