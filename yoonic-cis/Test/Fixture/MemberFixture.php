<?php
/**
 * MemberFixture
 *
 */
class MemberFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'msisdn' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'vcode' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'device_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'device_model' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'language' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'address' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'postal_code' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'telco_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'date_join' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'date_trial_expired' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'wallet_balance' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'date_created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'created_by' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'date_modified' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
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
			'msisdn' => 'Lorem ipsum dolor sit amet',
			'vcode' => 'Lorem ipsum dolor sit amet',
			'device_name' => 'Lorem ipsum dolor sit amet',
			'device_model' => 'Lorem ipsum dolor sit amet',
			'language' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'status' => 'Lorem ipsum dolor sit amet',
			'name' => 'Lorem ipsum dolor sit amet',
			'address' => 'Lorem ipsum dolor sit amet',
			'postal_code' => 'Lorem ipsum dolor sit amet',
			'telco_id' => 1,
			'date_join' => '2012-06-20 10:10:15',
			'date_trial_expired' => '2012-06-20 10:10:15',
			'wallet_balance' => 1,
			'date_created' => '2012-06-20 10:10:15',
			'created_by' => 'Lorem ipsum dolor sit amet',
			'date_modified' => 1340187015,
			'modified_by' => 'Lorem ipsum dolor sit amet'
		),
	);
}
