<?php

class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Time');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->fields = array(
			'username' => 'email',
			'password' => 'password_hash'
		);
		$this->Auth->allow('login', 'logout', 'register');
	}

	/**
	 * Custom handler in order to tell user the email and password do not match.
	 */
	function login() {
		if ($this->data) {
			$login = $this->Auth->login($this->data);
			if (empty($login)) {
				$this->Session->setFlash("The email and password combination does not match. Lost your password?");
			}
		}
	}

	/**
	 * User logout. Handled for Auth component.
	 */
	function logout() {
		$this->redirect($this->Auth->logout());
	}

	/**
	 * For user registration.
	 */
	function register() {
		if (!empty($this->data)) {
			$this->User->create();
			#Hash the password for saving.
			$this->data['User']['password_hash'] = $this->Auth->password($this->data['User']['password_confirm2']);
			if ($this->User->save($this->data)) {
				#Time to send an email?
				$this->Auth->login($this->data);
				$this->redirect(array('controller' => 'posts', 'action' => 'index'));
			}
		}
	}

	function backstage_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function backstage_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'user'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function backstage_add() {
		if (!empty($this->data)) {
			$this->User->create();
			#Hash the password for saving.
			$this->data['User']['password_hash'] = $this->Auth->password($this->data['User']['password_confirm2']);
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'user'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'user'));
			}
		}
	}

	function backstage_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'user'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			#Hash the password for saving.
			if (empty($this->data['User']['password_confirm1'])) {
				unset($this->data['User']['password_confirm1']);
				unset($this->data['User']['password_confirm2']);
			} else {
				$this->data['User']['password_hash'] = $this->Auth->password($this->data['User']['password_confirm2']);
			}
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'user'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'user'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function backstage_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'user'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'User'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'User'));
		$this->redirect(array('action' => 'index'));
	}

}
?>