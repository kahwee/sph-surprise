<?php

class PostsController extends AppController {

	var $name = 'Posts';
	var $helpers = array('Time');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'view');
	}

	function index() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'post'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}

	function backstage_index() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate());
	}

	function backstage_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'post'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}

	function backstage_add() {
		if (!empty($this->data)) {
			$this->Post->create();
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'post'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'post'));
			}
		}
		$users = $this->Post->User->find('list');
		$this->set(compact('users'));
	}

	function backstage_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'post'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'post'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'post'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Post->read(null, $id);
		}
		$users = $this->Post->User->find('list');
		$this->set(compact('users'));
	}

	function backstage_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'post'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Post->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Post'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Post'));
		$this->redirect(array('action' => 'index'));
	}

}
?>