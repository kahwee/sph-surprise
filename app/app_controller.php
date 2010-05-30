<?php

class AppController extends Controller {

	var $components = array('Session', 'Auth');

	function beforeFilter() {
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login', 'backstage' => false);
		$this->Auth->logoutRedirect = array('controller' => 'posts', 'action' => 'index', 'backstage' => false);
		$this->Auth->loginRedirect = array('controller' => 'posts', 'action' => 'add', 'backstage' => false);
	}

}
?>