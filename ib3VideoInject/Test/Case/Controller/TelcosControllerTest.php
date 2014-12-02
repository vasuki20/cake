<?php
App::uses('TelcosController', 'Controller');

/**
 * TestTelcosController *
 */
class TestTelcosController extends TelcosController {
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
 * TelcosController Test Case
 *
 */
class TelcosControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.telco', 'app.admin', 'app.admin_role', 'app.member');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Telcos = new TestTelcosController();
		$this->Telcos->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Telcos);

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
