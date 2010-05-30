<?php

class Post extends AppModel {

	var $name = 'Post';
	var $displayField = 'title';
	var $actsAs = array('Sluggable' => array('overwrite' => true,));
	var $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Title must be specified.',
			),
			'maxlength' => array(
				'rule' => array('maxlength', 255),
				'message' => 'Title must be less than 255 characters.',
				'required' => true,
			),
		),
		'content' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Forgot your post content?',
			),
		),
		'scheduled' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => true,
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
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
	function beforeSave($options) {
		return true;
	}

}
?>