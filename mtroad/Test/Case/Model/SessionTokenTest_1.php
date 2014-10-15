<?php
App::uses('SessionToken', 'Model');

/**
 * SessionToken Test Case
 *
 */
class SessionTokenTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.session_token');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SessionToken = ClassRegistry::init('SessionToken');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SessionToken);

		parent::tearDown();
	}

}
