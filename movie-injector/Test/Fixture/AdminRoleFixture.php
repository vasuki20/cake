<?php
/**
 * AdminRoleFixture
 *
 */
class AdminRoleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'role' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'access' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'role' => 'Lorem ipsum dolor sit amet',
			'access' => 'Lorem ipsum dolor sit amet',
			'date_created' => '2012-06-13 10:58:33',
			'created_by' => 'Lorem ipsum dolor sit amet',
			'date_modified' => 1339556313,
			'modified_by' => 'Lorem ipsum dolor sit amet'
		),
	);
}
