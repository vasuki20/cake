<?php
/**
 * TransactionFixture
 *
 */
class TransactionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'transaction_type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'application_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'product_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'product_type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'amount' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 12),
		'telco_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'vendor_txn_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'response_code' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 4, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created_by' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'date_created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified_by' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'date_modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'transaction_type' => 'Lorem ipsum dolor sit amet',
			'user_id' => 1,
			'application_id' => 'Lorem ipsum dolor sit amet',
			'product_id' => 'Lorem ipsum dolor sit amet',
			'product_type' => 'Lorem ipsum dolor sit amet',
			'amount' => 1,
			'telco_id' => 1,
			'vendor_txn_id' => 'Lorem ipsum dolor sit amet',
			'response_code' => 'Lo',
			'created_by' => 1,
			'date_created' => '2012-08-07 04:55:28',
			'modified_by' => 1,
			'date_modified' => '2012-08-07 04:55:28'
		),
	);
}
