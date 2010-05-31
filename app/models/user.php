<?php

class User extends AppModel {

	var $name = 'User';
	var $displayField = 'email';
	var $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Email does not appear to be valid.',
				'required' => true,
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'This email exists in the system. Lost your password?',
				'required' => true,
			),
		),
		'password_confirm1' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
			'maxlength' => array(
				'rule' => array('between', 8, 20),
				'message' => 'Passwords must be between 8 and 20 characters.',
				'required' => true,
			),
		),
		'password_confirm2' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
			'between' => array(
				'rule' => array('between', 8, 20),
				'message' => 'Passwords must be between 8 and 20 characters.',
				'required' => true,
			),
			'isEqualTo' => array(
				'rule' => array('equalTo', 'password_confirm1'), // password is hashed
				'message' => 'Passwords do not match.'
			),
		),
		'password_hash' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'name' => array(
			'between' => array(
				'rule' => array('between', 3, 20),
				'message' => 'Name must be between 3 and 20 characters.',
				'required' => true,
			),
		),
		'role_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);
	var $belongsTo = array(
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	var $hasMany = array(
		'post' => array(
			'className' => 'Post',
			'foreignKey' => 'id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	/**
	 * Called before each save operation, after validation. Return a non-true result
	 * to halt the save.
	 *
	 * @return boolean True if the operation should continue, false if it should abort
	 * @access public
	 * @link http://book.cakephp.org/view/1048/Callback-Methods#beforeSave-1052
	 */
	function beforeSave($options = array()) {
		#To track the previously used IP address.
		if (!isset($this->data['User']['last_ip']))
			$this->data['User']['last_ip'] = $_SERVER['REMOTE_ADDR'];
		return true;
	}

}
?>