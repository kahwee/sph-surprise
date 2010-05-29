<?php

class AppController extends Controller {

	var $components = array('Acl', 'Session', 'Auth');

	function beforeFilter() {
		$this->Auth->authorize = 'actions';
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
		$this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
		$this->Auth->loginRedirect = array('controller' => 'posts', 'action' => 'add');
	}

}
?>