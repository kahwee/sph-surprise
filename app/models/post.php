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
			//'message' => 'Your custom message here',
			//'allowEmpty' => false,
			//'required' => false,
			//'last' => false, // Stop validation after this rule
			//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>