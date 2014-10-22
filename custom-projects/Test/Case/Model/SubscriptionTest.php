<?php
App::uses('Subscription', 'Model');

/**
 * Subscription Test Case
 *
 */
class SubscriptionTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.subscription', 'app.member', 'app.telco', 'app.admin', 'app.admin_role');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Subscription = ClassRegistry::init('Subscription');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Subscription);

		parent::tearDown();
	}

}
