<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Db;


/**
 * 
 */
class MerchantController extends Controller
{	
	public function perfectmoneyAction(){
		/*
		$_POST['PAYMENT_AMOUNT'] = 3000;
		$_POST['PAYEE_ACCOUNT'] = "";
		$_POST['PAYMENT_BATCH_NUM'] = "";
		$_POST['PAYER_ACCOUNT'] = "";
		$_POST['TIMESTAMPGMT'] = "";
		$_POST['PAYMENT_UNITS'] = "USD";
		$_POST['PAYMENT_ID'] = '2,3';
		*/
		$data = $this->model->validatePerfectMoney($_POST, $this->tariffs);
		if(!$data){
			$this->view->errorCode(403);
		}

		$this->model->createTariff($data, $this->tariffs[$data['tid']]);
		
	}
}