<?php
App::uses('Transaction', 'Model');

/**
 * Transaction Test Case
 *
 */
class TransactionTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.transaction', 'app.user', 'app.application', 'app.product', 'app.telco', 'app.admin', 'app.admin_role', 'app.member', 'app.subscription', 'app.vendor_txn');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Transaction = ClassRegistry::init('Transaction');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Transaction);

		parent::tearDown();
	}

}
