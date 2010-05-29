<?php

class AppController extends Controller {

	var $components = array('Session', 'Auth');

	function beforeFilter() {
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
		$this->Auth->logoutRedirect = array('controller' => 'posts', 'action' => 'index');
		$this->Auth->loginRedirect = array('controller' => 'posts', 'action' => 'add');
	}

}
?>