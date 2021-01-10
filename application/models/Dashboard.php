<?php 

namespace application\models;

use application\core\Model;

/**
 * 
 */
class Dashboard extends Model{
	
	public function historyCount() {
		$params = [
			'uid' => $_SESSION['account']['id'],
		];
		return $this->db->column('SELECT COUNT(id) FROM history WHERE uid = :uid', $params);
	}

	public function historyList($route) {
		if(isset($route['page'])){ $pag = $route['page']; } else{ $pag = 1; }  $max = 10;
	  	$params = [
	   		'max' => $max,
	   		'start' => (($pag)-1)*$max,
	   		'id' => $_SESSION['account']['id'],
	  	];
	  
	  	return $this->db->row('SELECT * FROM history WHERE uid = :id ORDER BY id DESC LIMIT :start, :max', $params);
	}

	public function referralsCount() {
		$params = [
			'uid' => $_SESSION['account']['id'],
		];
		return $this->db->column('SELECT COUNT(id) FROM accounts WHERE ref = :uid', $params);
	}

	public function referralsList($route) {
		if(isset($route['page'])){ $pag = $route['page']; } else{ $pag = 1; }  $max = 10;
	  	$params = [
	   		'max' => $max,
	   		'start' => (($pag)-1)*$max,
	   		'id' => $_SESSION['account']['id'],
	  	];
	  
	  	return $this->db->row('SELECT login, email FROM accounts WHERE ref = :id ORDER BY id DESC LIMIT :start, :max', $params);
	}

	public function tariffsCount() {
		$params = [
			'uid' => $_SESSION['account']['id'],
		];
		return $this->db->column('SELECT COUNT(id) FROM tariffs WHERE uid = :uid', $params);
	}

	public function tariffsList($route) {
		if(isset($route['page'])){ $pag = $route['page']; } else{ $pag = 1; }  $max = 10;
	  	$params = [
	   		'max' => $max,
	   		'start' => (($pag)-1)*$max,
	   		'id' => $_SESSION['account']['id'],
	  	];
	  
	  	return $this->db->row('SELECT * FROM tariffs WHERE uid = :id ORDER BY id DESC LIMIT :start, :max', $params);
	}

	public function createRefWithdraw(){
		$amount = $_SESSION['account']['refBalance'];
		$_SESSION['account']['refBalance'] = 0;

		$vars = [
			'id' => $_SESSION['account']['id'],
		];
		$this->db->query('UPDATE accounts SET refBalance = 0 WHERE id = :id', $vars);

		$vars = [
			'id' => '',
			'uid' => $_SESSION['account']['id'],
			'unixTime' => time(),
			'amount' => $amount,
		];
		$this->db->query('INSERT INTO ref_withdraw VALUES (:id, :uid, :unixTime, :amount)', $vars);

		$vars = [
			'id' => '',
			'uid' => $_SESSION['account']['id'],
			'unixTime' => time(),
			'description' => 'Вывод реферального вознаграждения, сумма ' . $amount . ' $',
		];
		$this->db->query('INSERT INTO history VALUES (:id, :uid, :unixTime, :description)', $vars);
	}
}