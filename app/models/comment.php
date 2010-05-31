<?php

class Comment extends AppModel {

	var $name = 'Comment';
	var $displayField = 'name';
	var $validate = array(
		'name' => array(
			'between' => array(
				'rule' => array('between', 3, 20),
				'message' => 'Name must be between 3 and 20 characters.',
				'required' => true,
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Name must be specified.',
				'required' => true,
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'This does not appear to be a valid email address.',
				'required' => true,
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Email must be specified.',
				'required' => true,
			),
		),
		'content' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Forgot your post content?',
			),
		),
		'ip' => array(
			'ip' => array(
				'rule' => array('ip'),
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);
	var $belongsTo = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => true,
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
		)
	);
	var $actsAs = array('Containable');

	/**
	 * Called before each save operation, after validation. Return a non-true result
	 * to halt the save.
	 *
	 * @return boolean True if the operation should continue, false if it should abort
	 * @access public
	 * @link http://book.cakephp.org/view/1048/Callback-Methods#beforeSave-1052
	 */
	function beforeSave($options = array()) {
		#Trunk the IP address. Just in case.
		if (!isset($this->data['Comment']['ip']))
			$this->data['Comment']['ip'] = $_SERVER['REMOTE_ADDR'];
		return true;
	}

}
?>