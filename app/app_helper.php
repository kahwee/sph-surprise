<?php

class AppHelper extends Helper {

	var $helpers = array('Session');

	/**
	 * Checks if the given user id is the current user.
	 *
	 * @param integer $user_id
	 * @return boolean True if it is the same, else false.
	 */
	function is_user($user_id) {
		return $user_id == $this->Session->read('Auth.User.id');
	}

}
?>
