<?php
App::uses('AppModel', 'Model');
App::import('model','ApiUser');
App::import('model','Subscription');
/**
 * Consumption Model
 *
 * @property Admin $Admin
 * @property Consumption $Consumption
 */
class Consumption extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'telco_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'msisdn' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'tittle' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'url' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'duration' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
 * logConsumption method
 * 
 * @var array => session_token, telco_id, subscriber_id, msisdn, tittle, url, duration
 * @return array
 */
	public function logConsumption($data) {
		$ApiUser = new ApiUser();
		if($data) {
			if($data["session_token"]=="") {
				$consumption = $ApiUser->api_response("500", "No session provided");
				return $consumption;
			}
		
			if(!isset($data["telco_id"]) or $data["telco_id"]=="") {
				$consumption = $ApiUser->api_response("500", "No telco provided");
				return $consumption;
			}
		
			if(!isset($data["subscriber_id"]) or $data["subscriber_id"]=="") {
				$consumption = $ApiUser->api_response("500", "No subscriber provided");
				return $consumption;
			}
			
			if(!isset($data["msisdn"]) or $data["msisdn"]=="") {
				$consumption = $ApiUser->api_response("500", "No msisdn provided");
				return $consumption;
			}
			
			if(!isset($data["tittle"]) or $data["tittle"]=="") {
				$consumption = $ApiUser->api_response("500", "No tittle provided");
				return $consumption;
			}
			
			if(!isset($data["url"]) or $data["url"]=="") {
				$consumption = $ApiUser->api_response("500", "No url provided");
				return $consumption;
			}
			
			if(!isset($data["duration"]) or $data["duration"]=="") {
				$consumption = $ApiUser->api_response("500", "No duration provided");
				return $consumption;
			}
		
			if($data["session_token"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));
				
				if($isSessionValid["ApiUser"]["result_code"]=="200") {
					
					if ($this->save($data)) {
							unset($total_available_airtime);
							$total_available_airtime = 0;
							$curr_expiry_date = '';
							$Subscription = new Subscription();
							$conditions = array("Subscription.subscriber_id"=>$data["subscriber_id"],"Subscription.subscription_end_date >"=> date("Y-m-d H:i:s"),"Subscription.status"=>'active');
							$subscriptions = $Subscription->find("all",array('conditions' => $conditions,"recursive" => -1));
							foreach ($subscriptions as $airtime) {
								$curr_expiry_date = $airtime["Subscription"]["subscription_end_date"];
								$total_available_airtime += $airtime["Subscription"]["airtime"];
							}
							$consumption = array("ApiUser" => array("result_code" => "200", "message" => "Consumption Log saved", "total_available_airtime" => $total_available_airtime, "subscription_expiry" => $curr_expiry_date));
					}

				} else {
					$consumption = $ApiUser->api_response("440", "Session Expired");
				}
			} else {
				$consumption = $ApiUser->api_response("500", "Session does not exist");
			}
		} else {
			$consumption = $ApiUser->api_response("500", "Unauthorised");
		}
		
		return $consumption;
	}
	
/**
 * listConsumption method
 * 
 * @param array => session_token, subscriber_id
 * @return array
 */
	public function listConsumption($query) {
		$ApiUser = new ApiUser();
		if($query) {
			if($query["session_token"]=="") {
				$consumptions = $ApiUser->api_response("501", "No session provided");
				return $consumptions;
			}
						
			if($query["session_token"]!="" and $query["subscriber_id"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$query["session_token"]));
			
				if($isSessionValid["ApiUser"]["result_code"]=="200") {
					
					$conditions = array("Consumption.subscriber_id" => $query["subscriber_id"]);
					$history = $this->find('all', array('conditions' => $conditions,"recursive" => -1));

					foreach ($history as $item) {
						$consumption_history[] = $item["Consumption"];
					}

					if(!isset($consumption_history)) $consumption_history = array();

					$consumptions = array("Consumptions" => array('Consumption' => $consumption_history));
				} else {
					$consumptions = $ApiUser->api_response("440", "Session Expired");
				}
			} else {
				$consumptions = $ApiUser->api_response("500", "No subscriber provided");
			}
			
		} else {
			$consumptions = $ApiUser->api_response("500", "Unauthorised");
		}
		return $consumptions;
	}
	
}

