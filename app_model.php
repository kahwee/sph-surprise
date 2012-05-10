<?php

class AppModel extends Model {

	/**
	 * Returns the current time in MySQL data format
	 *
	 * @access public
	 * @return string datetime in format for MySQL
	 */
	function now() {
		return $this->datetime(time());
	}

	/**
	 * Returns the current time in MySQL data format
	 *
	 * @access public
	 * @return string datetime in format for MySQL
	 */
	function today() {
		return $this->datetime(time());
	}

	/**
	 * Returns the yesterday's datetime in MySQL data format
	 *
	 * @access public
	 * @return string datetime in format for MySQL
	 */
	function yesterday() {
		return $this->datetime(strtotime("-1 day"));
	}

	/**
	 * Converts UNIX time to MySQL compatible time.
	 *
	 * @param string $time specified in UNIX time
	 * @access public
	 * @return string datetime in format for MySQL
	 */
	function datetime($time) {
		if (is_string($time))
			$time = strtotime($time);
		return date('Y-m-d H:i:s', $time);
	}

	/**
	 * Overrides core equalTo() to verify that two form fields are equal
	 *
	 * @param array $field contains the name of the primary field and the value of that field
	 * @param string $compare_field contains the name of the field to compare the primary field to
	 * @access public
	 * @return boolean FALSE if the fields do not match TRUE if they do
	 */
	function equalTo($field=array(), $compare_field=null) {
		foreach ($field as $key => $value) {
			if ($value !== $this->data[$this->name][$compare_field])
				return false;
		}
		return true;
	}

	function isInArray($data, $array=array()) {
		return in_array(array_pop($data), $array);
	}

}
?>