<?php

class AppController extends Controller {

	var $components = array('Session', 'Auth');

	function beforeFilter() {
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login', 'backstage' => false);
		$this->Auth->logoutRedirect = array('controller' => 'posts', 'action' => 'index', 'backstage' => false);
		$this->Auth->loginRedirect = array('controller' => 'posts', 'action' => 'add', 'backstage' => false);
	}

	/**
	 * Checks if the given user id is the current user.
	 *
	 * @param integer $user_id
	 * @return boolean True if it is the same, else false.
	 */
	function is_user($user_id) {
		return $user_id == $this->Session->read('Auth.User.id');
	}

}
?>