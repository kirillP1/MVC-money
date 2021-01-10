<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\lib\Db;


/**
 * 
 */
class DashboardController extends Controller
{
	public function investAction(){

		$vars = [
			'tariff' => $this->tariffs[$this->route['id']],
		];
		$this->view->render('Главная', $vars);
	}

	public function tariffsAction(){
		$pagination = new Pagination($this->route, $this->model->tariffsCount(), 10);
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->tariffsList($this->route),
		];
		$this->view->render('Тарифы', $vars);
	}

	public function historyAction(){
		$pagination = new Pagination($this->route, $this->model->historyCount(), 10);
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->historyList($this->route),
		];
		$this->view->render('История', $vars);
	}

	public function referralsAction(){
		if(!empty($_POST)){
			if($_SESSION['account']['refBalance'] <= 0 ){
				$this->view->message('error', 'Реферальный баланс пуст');
			}
			$this->model->createRefWithdraw();
			$this->view->message('success', 'Заявка на вывод создана');
		};
		$pagination = new Pagination($this->route, $this->model->referralsCount(), 10);
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->referralsList($this->route),
		];
		$this->view->render('Рефералы', $vars);
	}
}