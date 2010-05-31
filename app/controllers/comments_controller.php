<?php

class CommentsController extends AppController {

	var $name = 'Comments';

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add');
	}

	function add() {
		if (!empty($this->data)) {
			$this->Comment->create();
			$this->Comment->whitelist = array('name', 'email', 'content', 'ip');
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'comment'));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'comment'));
			}
		}
	}

}
?>