<?php
App::uses('MembersController', 'Controller');

/**
 * TestMembersController *
 */
class TestMembersController extends MembersController {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect action
 *
 * @param mixed $url
 * @param mixed $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * MembersController Test Case
 *
 */
class MembersControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.member', 'app.telco', 'app.admin', 'app.admin_role');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Members = new TestMembersController();
		$this->Members->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Members);

		parent::tearDown();
	}

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {

	}
/**
 * testView method
 *
 * @return void
 */
	public function testView() {

	}
/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {

	}
/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {

	}
/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {

	}
/**
 * testYoonicAdminIndex method
 *
 * @return void
 */
	public function testYoonicAdminIndex() {

	}
/**
 * testYoonicAdminView method
 *
 * @return void
 */
	public function testYoonicAdminView() {

	}
/**
 * testYoonicAdminAdd method
 *
 * @return void
 */
	public function testYoonicAdminAdd() {

	}
/**
 * testYoonicAdminEdit method
 *
 * @return void
 */
	public function testYoonicAdminEdit() {

	}
/**
 * testYoonicAdminDelete method
 *
 * @return void
 */
	public function testYoonicAdminDelete() {

	}
}
