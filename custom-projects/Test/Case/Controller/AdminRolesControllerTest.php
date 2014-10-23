<?php
App::uses('AdminRolesController', 'Controller');

/**
 * TestAdminRolesController *
 */
class TestAdminRolesController extends AdminRolesController {
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
 * AdminRolesController Test Case
 *
 */
class AdminRolesControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.admin_role', 'app.admin', 'app.telco', 'app.member');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AdminRoles = new TestAdminRolesController();
		$this->AdminRoles->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AdminRoles);

		parent::tearDown();
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
