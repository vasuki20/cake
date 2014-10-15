<?php
App::uses('ApiUser', 'Model');

/**
 * ApiUser Test Case
 *
 */
class ApiUserTestCase extends CakeTestCase {
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
		$this->ApiUser = ClassRegistry::init('ApiUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ApiUser);

		parent::tearDown();
	}

}
