<?php
/* User Fixture generated on: 2010-05-29 19:05:11 : 1275160871 */
class UserFixture extends CakeTestFixture {
	var $name = 'User';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1023),
		'password_hash' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'last_ip' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 63),
		'first_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 127),
		'last_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 127),
		'full_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 511),
		'role_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'email' => 'Lorem ipsum dolor sit amet',
			'password_hash' => 'Lorem ipsum dolor sit amet',
			'last_ip' => 'Lorem ipsum dolor sit amet',
			'first_name' => 'Lorem ipsum dolor sit amet',
			'last_name' => 'Lorem ipsum dolor sit amet',
			'full_name' => 'Lorem ipsum dolor sit amet',
			'role_id' => 1,
			'created' => '2010-05-29 19:21:11',
			'modified' => '2010-05-29 19:21:11'
		),
	);
}
?>