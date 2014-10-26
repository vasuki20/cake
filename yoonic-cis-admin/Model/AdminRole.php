<?php
App::uses('AppModel', 'Model');
/**
 * AdminRole Model
 *
 * @property Admin $Admin
 */
class AdminRole extends AppModel {

	public $useTable = false;
	
	public $_schema = array(
		'id' => array('type'=>'numeric')
	);

}
?>
