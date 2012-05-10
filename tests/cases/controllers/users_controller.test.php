<?php
/* Users Test cases generated on: 2010-05-29 19:05:02 : 1275161402*/
App::import('Controller', 'Users');

class TestUsersController extends UsersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class UsersControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.user', 'app.role', 'app.post');

	function startTest() {
		$this->Users =& new TestUsersController();
		$this->Users->constructClasses();
	}

	function endTest() {
		unset($this->Users);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

	function testBackstageIndex() {

	}

	function testBackstageView() {

	}

	function testBackstageAdd() {

	}

	function testBackstageEdit() {

	}

	function testBackstageDelete() {

	}

}
?>