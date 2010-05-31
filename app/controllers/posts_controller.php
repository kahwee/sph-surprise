<?php

class PostsController extends AppController {

	var $name = 'Posts';
	var $helpers = array('Rss', 'Text', 'Time', 'Wysiwyg');
	var $components = array('RequestHandler');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'view');
	}

	/**
	 * Handles RSS feed, the index page and the search results
	 */
	function index() {
		if ($this->RequestHandler->isRss()) {
			$posts = $this->Post->find('all',
					array(
						'fields' => array('Post.id', 'Post.title', 'Post.comment_count', 'Post.content', 'Post.scheduled', 'Post.slug', 'Post.scheduled', 'User.id', 'User.name'),
						'conditions' => array('scheduled <= ' => $this->Post->today()),
						'limit' => 20,
						'order' => 'Post.scheduled DESC'
				));
			$this->set(compact('posts'));
		} else {
			$common_post_fields = "Post.content, Post.title, Post.slug, Post.user_id, User.name, User.id, Post.comment_count, Post.scheduled";
			$this->Post->recursive = 0;
			if (isset($this->params['url']['q'])) {
				#When there's a search query string 'q':
				$q = $this->params['url']['q'];
				#Snippet from http://codesnippets.joyent.com/posts/show/2119
				#This appears not to be working as intended.
				$this->paginate = array(
					'fields' => "$common_post_fields, (MATCH (content) AGAINST ('$q' IN BOOLEAN MODE)*10) + (MATCH (title) AGAINST ('$q' IN BOOLEAN MODE)*10) AS rating",
					'conditions' => "MATCH (title,content) AGAINST ('$q' IN BOOLEAN MODE)",
					'order' => 'rating DESC', #Sort by rating not working?
					'limit' => 7
				);
			} else {
				#When normal index is requested:
				$this->paginate = array(
					'fields' => $common_post_fields,
					'conditions' => array('scheduled <= ' => $this->Post->today()),
					'order' => 'scheduled DESC',
					'limit' => 7
				);
			}
			$posts = $this->paginate('Post');
			$this->set('posts', $posts);
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
			#Quick replaces to neaten pasted text, could've been more intelligent.
			$this->data['Post']['content'] = str_replace('<p>&nbsp;</p>', '', $this->data['Post']['content']);
			$this->data['Post']['content'] = str_replace('<p></p>', '', $this->data['Post']['content']);
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
			#Quick replaces to neaten pasted text, could've been more intelligent.
			$this->data['Post']['content'] = str_replace('<p>&nbsp;</p>', '', $this->data['Post']['content']);
			$this->data['Post']['content'] = str_replace('<p></p>', '', $this->data['Post']['content']);
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