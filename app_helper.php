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

	/**
	 * Gets the logged in user from the session. 
	 *
	 * @return mixed false if not logged in, else the logged in user.
	 */
	function get_logged_in() {
		$user = $this->Session->read('Auth.User');
		if (empty($user))
			return false;
		else
			return $user;
	}

}
?>
