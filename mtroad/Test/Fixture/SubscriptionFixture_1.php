<?php
/**
 * SubscriptionFixture
 *
 */
class SubscriptionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'member_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'txnid' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'subscription_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'subscription_start_date' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'subscription_end_date' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'date_created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'created_by' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'date_modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified_by' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'member_id' => 1,
			'txnid' => 'Lorem ipsum dolor sit amet',
			'subscription_name' => 'Lorem ipsum dolor sit amet',
			'subscription_start_date' => '2012-06-21 10:29:18',
			'subscription_end_date' => '2012-06-21 10:29:18',
			'date_created' => '2012-06-21 10:29:18',
			'created_by' => 'Lorem ipsum dolor sit amet',
			'date_modified' => '2012-06-21 10:29:18',
			'modified_by' => 'Lorem ipsum dolor sit amet'
		),
	);
}
