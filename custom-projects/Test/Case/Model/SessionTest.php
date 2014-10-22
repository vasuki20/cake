<?php
App::uses('Session', 'Model');

/**
 * Session Test Case
 *
 */
class SessionTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.session');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Session = ClassRegistry::init('Session');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Session);

		parent::tearDown();
	}

}
