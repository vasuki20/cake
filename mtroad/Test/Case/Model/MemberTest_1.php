<?php
App::uses('Member', 'Model');

/**
 * Member Test Case
 *
 */
class MemberTestCase extends CakeTestCase {
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
		$this->Member = ClassRegistry::init('Member');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Member);

		parent::tearDown();
	}

}
