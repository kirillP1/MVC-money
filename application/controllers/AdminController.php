<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Db;
use application\lib\Pagination;


/**
 * 
 */
class AdminController extends Controller
{
	public function __construct($route){
		parent::__construct($route);
		$this->view->layout = 'admin';
		if(isset($_SESSION['admin'])){
			return true;
		}else{
			$_SESSION['admin'] = false;
		}
	}

	public function loginAction(){
		if(!$_SESSION['admin']){
			if(!empty($_POST)){
				if($this->model->loginValidate($_POST)){
					$_SESSION['admin'] = true;
					$this->view->location('../admin/withdraw/1');
				}else{
					$error = $this->model->loginValidate($_POST);
					$this->view->message('Error', $error);
				}
					
			}else{
				$this->view->render('Вход');
			}
		}else{
			$this->view->redirect('../admin/withdraw/1');
		}
	}

	public function indexAction(){
		if(!$_SESSION['admin']){
		 	$this->view->redirect('../admin/login');
		}else{
			$this->view->redirect('../admin/withdraw/1');
		}
		
	}

	public function logoutAction(){
		unset($_SESSION['admin']);
		$this->view->redirect('../admin/login');
	}

	public function withdrawAction(){
		if(!empty($_POST)){
			if($_POST['type'] == 'ref'){
				$result = $this->model->withdrawRefComplete($_POST['id']);
				if($result){
					$this->view->location('../admin/withdraw');
				}else{
					$this->view->message('error', 'Нет такого');
				}
			}
			elseif($_POST['type'] == 'tariff'){
				$result = $this->model->withdrawTariffsComplete($_POST['id']);
				if($result){
					$this->view->location('../admin/withdraw');
				}else{
					$this->view->message('error', 'Нет такого');
				}
			}
		};
		$vars = [
			'listRef' => $this->model->withdrawRefList($this->route),
			'listTariffs' => $this->model->withdrawTariffsList($this->route),
		];
		$this->view->render('Заказы на вывод средств', $vars);
	}

	public function historyAction(){
		$pagination = new Pagination($this->route, $this->model->historyCount(), 10);
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->historyList($this->route),
		];
		$this->view->render('История', $vars);
	}

	public function tariffsAction(){
		$pagination = new Pagination($this->route, $this->model->tariffsCount(), 10);
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->tariffsList($this->route),
		];
		$this->view->render('Список тарифов', $vars);
	}

	
}