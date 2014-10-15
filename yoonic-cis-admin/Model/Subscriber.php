<?php
App::uses('AppModel', 'Model');
App::import('model','Subscription');
App::import('model','Transaction');
/**
 * Subscriber Model
 *
 * @property Telco $Telco
 */
class Subscriber extends AppModel {
    
 /**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Telco' => array(
			'className' => 'Telco',
			'foreignKey' => 'telco_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
		
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
			'Subscription' => array(
					'className' => 'Subscription',
					'foreignKey' => 'subscriber_id',
					'dependent' => false,
					'conditions' => array("Subscription.status"=>"active"), // only retreive the active one
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
			),
			'Device' => array(
					'className' => 'Device',
					'foreignKey' => 'subscriber_id',
					'dependent' => false,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
			),
			'Consumption' => array(
					'className' => 'Consumption',
					'foreignKey' => 'subscriber_id',
					'dependent' => false,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
			),
			'Log' => array(
					'className' => 'Log' ,
					'foreignKey' => 'subscriber_id',
					'dependent' => false,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
			)
	);
}
