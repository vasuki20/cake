<?php
App::uses('Telco', 'Model');

/**
 * Telco Test Case
 *
 */
class TelcoTestCase extends CakeTestCase {
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
		$this->Telco = ClassRegistry::init('Telco');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Telco);

		parent::tearDown();
	}

}
