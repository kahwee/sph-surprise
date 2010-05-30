<?php

class PostsController extends AppController {

	var $name = 'Posts';
	var $helpers = array('Rss', 'Text', 'Time', 'Wysiwyg');
	var $components = array('RequestHandler');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'view');
	}

	function index() {
		if ($this->RequestHandler->isRss()) {
			$posts = $this->Post->find('all',
					array(
						'fields' => array('Post.id', 'Post.title', 'Post.comment_count', 'Post.content', 'Post.scheduled', 'Post.slug', 'Post.scheduled', 'User.id', 'User.name'),
						'limit' => 20,
						'order' => 'Post.scheduled DESC'
					));
			$this->set(compact('posts'));
		} else {
			$this->Post->recursive = 0;
			$this->set('posts', $this->paginate());
		}
	}

	function view() {
		if (isset($this->params['slug'])) {
			$post = $this->Post->find('first', array(
					'conditions' => array('slug' => $this->params['slug']),
					'fields' => array('Post.id', 'Post.title', 'Post.comment_count', 'Post.content', 'Post.scheduled', 'Post.slug', 'Post.scheduled', 'User.id', 'User.name'),
				));
			$this->set('post', $post);
		} else {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'post'));
			$this->redirect(array('action' => 'index'));
		}
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
			#Only owners can edit their own posts.
			if (!$this->is_user($this->data['Post']['user_id'])) {
				$this->Session->setFlash("You do not have permission to edit this post.");
				$this->redirect(array('action' => 'index'));
			}
		}
		$users = $this->Post->User->find('list');
		$this->set(compact('users'));
	}

	function backstage_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'post'));
			$this->redirect(array('action' => 'index'));
		}
		#Only owners can delete their own posts.
		$this->data = $this->Post->read(array('user_id', 'id'), $id);
		if (!$this->is_user($this->data['Post']['user_id'])) {
			$this->Session->setFlash("You do not have permission to delete this post.");
			$this->redirect(array('action' => 'index'));
		}
		#Normal deletion operations, ignored.
		if ($this->Post->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Post'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Post'));
		$this->redirect(array('action' => 'index'));
	}

}
?>