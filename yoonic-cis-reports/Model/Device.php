<?php
App::uses('AppModel', 'Model');
App::import('model','ApiUser');

/**
 * Device Model
 *
 * @property Admin $Admin
 * @property Device $Device
 */
class Device extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'subscriber_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'device_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'device_model' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'language' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'mac_address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ip_address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_login' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Subscriber' => array(
			'className' => 'Subscriber',
			'foreignKey' => 'subscriber_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * recordDevice method
 * 
 * @var array => session_token, telco_id, msisdn, keyword, request, response, subscriber_id, api_user_ids
 * @return array
 */
	public function recordDevice($data) {
		$ApiUser = new ApiUser();
		if($data) {
			
			if($data["session_token"]=="") {
				$device = $ApiUser->api_response("501", "No session provided");
				return $device;
			}
			if(!isset($data["subscriber_id"]) or $data["subscriber_id"]=="") {
				$device = $ApiUser->api_response("500", "No subscriber_id provided");
				return $device;
			}
		
			if(!isset($data["device_name"]) or $data["device_name"]=="") {
				$device = $ApiUser->api_response("500", "No Device Name provided");
				return $device;
			}
			
			if(!isset($data["device_model"]) or $data["device_model"]=="") {
				$device = $ApiUser->api_response("500", "No Device Model provided");
				return $device;
			}
			
			if(!isset($data["language"]) or $data["language"]=="") {
				$device = $ApiUser->api_response("500", "No language provided");
				return $device;
			}
			
			if(!isset($data["mac_address"]) or $data["mac_address"]=="") {
				$device = $ApiUser->api_response("500", "No mac_address provided");
				return $device;
			}
			
			if(!isset($data["ip_address"]) or $data["ip_address"]=="") {
				$device = $ApiUser->api_response("500", "No ip_address provided");
				return $device;
			}
			
			if(!isset($data["last_login"]) or $data["last_login"]=="") {
				$device = $ApiUser->api_response("500", "No last_login provided");
				return $device;
			}
		
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));
				
				if($isSessionValid["ApiUser"]["result_code"]=="200") {
					if ($this->save($data)) {
							$device = array("Device" => array("result_code" => "200", "message" => "Device Information saved"));
					} else {
						$device = array("Device" => array("result_code" => "400", "message" => "Device Information not saved"));
					}

				} else {
					$device = $ApiUser->api_response("440", "Session Expired");
				}
		
		} else {
			$device = $ApiUser->api_response("500", "Unauthorised");
		}
		
		return $device;
	}

	
/**
 * listDevice method
 * 
 * @param array => session_token, subscriber_id
 * @return array
 */
	public function listDevice($query) {
		$ApiUser = new ApiUser();
		if($query) {
			if($query["session_token"]=="") {
				$devices = $ApiUser->api_response("500", "No session provided");
				return $devices;
			}

			if(!isset($query["subscriber_id"]) or $query["subscriber_id"]=="") {
				$devices = $ApiUser->api_response("500", "No subscriber_id provided");
				return $devices;
			}
						
			if($query["session_token"]!="" and $query["subscriber_id"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$query["session_token"]));
			
				if($isSessionValid["ApiUser"]["result_code"]=="200") {
					
					$conditions = array("Device.subscriber_id" => $query["subscriber_id"]);
					$history = $this->find('all', array('conditions' => $conditions,"recursive" => -1));

					foreach ($history as $item) {
						$device_history[] = $item["Device"];
					}

					if (!isset($device_history)) $device_history = array();

					$devices = array("Devices" => array('Device' => $device_history));


				} else {
					$devices = $ApiUser->api_response("440", "Session Expired");
				}
			} else {
				$devices = $ApiUser->api_response("500", "No subscriber_id provided");
			}
			
		} else {
			$devices = $ApiUser->api_response("500", "Unauthorised");
		}
		return $devices;
	}
	
}
