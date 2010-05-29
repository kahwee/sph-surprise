<?php

class User extends AppModel {

	var $name = 'User';
	var $displayField = 'full_name';
	var $virtualFields = array('full_name' => 'CONCAT(User.first_name, " ", User.last_name)');
	var $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Email does not appear to be valid.',
				'required' => true,
			),
		),
		'password_hash' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			//'message' => 'Your custom message here',
			//'allowEmpty' => false,
			//'required' => false,
			//'last' => false, // Stop validation after this rule
			//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'first_name' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 127),
				'message' => 'First names must be less than 127 characters.',
				'required' => true,
			),
			'minlength' => array(
				'rule' => array('minlength', 1),
				'message' => 'First names must be more than 1 character.',
				'required' => true,
			),
		),
		'last_name' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 127),
				'message' => 'Last names must be less than 127 characters.',
				'required' => true,
			),
			'minlength' => array(
				'rule' => array('minlength', 1),
				'message' => 'Last names must be more than 1 character.',
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

	function parentNode() {
		if (!$this->id && empty($this->data)) {
			return null;
		}
		$data = $this->data;
		if (empty($this->data)) {
			$data = $this->read();
		}
		if (empty($data['User']['role_id'])) {
			return null;
		} else {
			return array('Role' => array('id' => $data['User']['role_id']));
		}
	}

	/**
	 * Called before each save operation, after validation. Return a non-true result
	 * to halt the save.
	 *
	 * @return boolean True if the operation should continue, false if it should abort
	 * @access public
	 * @link http://book.cakephp.org/view/1048/Callback-Methods#beforeSave-1052
	 */
	function beforeSave($options = array()) {
		if (!isset($this->data['User']['last_ip']))
			$this->data['User']['last_ip'] = $_SERVER['REMOTE_ADDR'];
		return true;
	}

}
?>