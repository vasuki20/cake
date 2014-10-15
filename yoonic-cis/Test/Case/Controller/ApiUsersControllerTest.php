<?php
App::uses('ApiUsersController', 'Controller');

/**
 * TestApiUsersController *
 */
class TestApiUsersController extends ApiUsersController {
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
 * ApiUsersController Test Case
 *
 */
class ApiUsersControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.api_user');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ApiUsers = new TestApiUsersController();
		$this->ApiUsers->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ApiUsers);

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
 * testLogin method
 * 
 * @return resource 
 */
	public function testLogin() {
		
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
