<?php
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');
App::import('model','ApiUser');
App::import('model','Subscription');
App::import('model','Transaction');
/**
 * Subscriber Model
 *
 * @property Telco $Telco
 */
class Subscriber extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),/*
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'address' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'postal_code' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
		'telco_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),/*
		'date_join' => array(
			'datetime' => array(
				'rule' => array('datetime'),
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
		'incomplete' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date_created' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'created_by' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date_modified' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'modified_by' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)*/
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
	
/**
 * verifySubscriber method
 * 
 * @var array => session_token, telco_id, msisdn, vcode
 * @return array
 */
	public function verifySubscriber($query) {
		$ApiUser = new ApiUser();
		if($query) {
			if($query["session_token"]=="") $subscriber = $ApiUser->api_response("500", "No session provided");		
			if(!isset($query["telco_id"]) or $query["telco_id"]=="") $subscriber = $ApiUser->api_response("500", "No telco provided");
			if(!isset($query["msisdn"]) or $query["msisdn"]=="") $subscriber = $ApiUser->api_response("500", "No msisdn provided");			
			if(!isset($query["password"]) or $query["password"]=="") $subscriber = $ApiUser->api_response("500", "No password provided");
			if (isset($subscriber)) return $subscriber; //exit verifySubscriber function
		
			if($query["session_token"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$query["session_token"]));				
				if($isSessionValid["ApiUser"]["result_code"]=="200") {
					$subscription = new Subscription();
					$conditions = array("Subscriber.telco_id" => $query["telco_id"], "Subscriber.msisdn" => $query["msisdn"], "Subscriber.password" => $query["password"]);
					$member = $this->find('first', array('conditions' => $conditions, 'recursive' => -1));
					
					if($member) {
						$query["subscriber_id"]=$member["Subscriber"]["id"];
						$subscription->updateActiveSubscription($query);             //set expired subscription to inactive?
						if ($this->isActive($query["subscriber_id"])) {

							$this->id = $member["Subscriber"]["id"];
							$this->saveField("last_login", date("Y-m-d H:i:s"));
							
							$subscribers = array("ApiUser" => array("result_code" => "200", "message" => "Subscriber exists and the msisdn and password is matching for this telco", "item" => $member));
						} else {							
							$subscribers = $ApiUser->api_response("500", "Subscriber is inactive");
						}
					} else {
						$subscribers = array("ApiUser" => array("result_code"=>"500", "message" => "No matching MSISDN and password"));
					}
				} else {$subscribers = $ApiUser->api_response("440", "Session Expired");}
			} else {$subscribers = $ApiUser->api_response("403", "Session does not exist");}
		} else {$subscribers = $ApiUser->api_response("500", "Unauthorised");}
		
		return $subscribers;
	}
	
/**
 * listSubscribers method
 *
 * @param array => session_token, telco_id
 * @return array
 */
	public function listSubscribers($query) {
		$ApiUser = new ApiUser();
		if($query) {
			if($query["session_token"]=="") $subscribers = $ApiUser->api_response("501", "No session provided");
			if(!isset($query["telco_id"]) or $query["telco_id"]=="") $subscribers = $ApiUser->api_response("502", "No telco provided");
			if (isset($subscriber)) return $subscriber; //exit listSubscriber function
				
			if($query["session_token"]!="" and $query["telco_id"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$query["session_token"]));
				if($isSessionValid["ApiUser"]["result_code"]=="200") {
					if(array_key_exists("page", $query)) {
						$conditions = array("Subscriber.telco_id" => $query["telco_id"]);
						$all_members = $this->find('all', array('conditions' => $conditions, 'recursive' => -1, "limit" => "50", "page" => $query["page"]));
					} else {$all_members = $this->findAllByTelcoId($query["telco_id"]);}
					
					if($all_members>0) {
						$subscribers = array("Subscribers" => array("item" => $all_members));
					} else {$subscribers = array("Subscribers" => array("result_code"=>"500", "message" => "There are no subscribers"));}
				} else {$subscribers = $ApiUser->api_response("403", "Session Expired");}
			}
		} else {$subscribers = $ApiUser->api_response("500", "Unauthorised");}
		return $subscribers;
	}
	
/**
 * viewSubscriber method
 *
 * @param array => session_token, telco_id, id
 * @return array
 */
	public function viewSubscriber($query) {
		$ApiUser = new ApiUser();
		if($query) {
			if($query["session_token"]=="") $subscriber = $ApiUser->api_response("500", "No session provided");
			if(!isset($query["telco_id"]) or $query["telco_id"]=="") $subscriber = $ApiUser->api_response("500", "No telco provided");
			if(!isset($query["id"]) or $query["id"]=="") {
				$subscriber = $ApiUser->api_response("500", "No subscriber ID provided");
			} else {
				if (!$this->isActive($query["id"])) $subscriber = $ApiUser->api_response("500", "Subscriber is inactive");
			}
			if (isset($subscriber)) return $subscriber; //exit listSubscriber function

			if($query["session_token"]!="" and $query["id"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$query["session_token"]));
				if($isSessionValid["ApiUser"]["result_code"]=="200") {
					$this->id = $query["id"];
					if (!$this->exists()) {
						$subscriber = array( "Subscribers" => array( "result_code" => "500", "message" => "Invalid Subscriber"));
					} else {
						$conditions = array("Subscriber.id" => $query["id"], "Subscriber.telco_id" => $query["telco_id"]);
						$member = $this->find('first', array('conditions' => $conditions,'recursive' => -1));
						if($member>0) {
							$subscriber = array("Subscriber" => array("item" => $member));
						} else {$subscriber = array("Subscriber" => array("result_code"=>"500", "message" => "Subscriber does not exist for this telco"));}
					}
				} else {$subscriber = $ApiUser->api_response("440", "Session Expired");}
			}
		} else {$subscriber = $ApiUser->api_response("500", "Unauthorised");}
		return $subscriber;
	}


/**
* generatePassword method
* 
* @param none
* @return string
*/
	public function generatePassword() {
		return rand(1000, 9999);
	}


	public function isActive($id) {
		$subscriber = $this->findById($id);
		if ($subscriber["Subscriber"]["status"] == "active") {
			return true;
		} 
		return false;
	}

	public function activate($id) {
		$this->id = $id;
		$this->status = "active";
		if ($this->saveField("status","active")) {
			return true;
		}
		return false;
	}
	
/**
 * addSubscriber method
 *
 * @param array
 * @return array
 */
	public function addSubscriber($data) {
		$ApiUser = new ApiUser();
		$Log = new Log();
		if($data) {
			if(!isset($data["session_token"]) or $data["session_token"]=="") $subscriber = $ApiUser->api_response("501", "No session provided");
			$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));
			if($isSessionValid["ApiUser"]["result_code"]!="200") $subscriber = $ApiUser->api_response("500", "Unauthorised");
			if(!isset($data["telco_id"]) or $data["telco_id"]=="") $subscriber = $ApiUser->api_response("502", "No telco provided");
			if(!isset($data["msisdn"]) or $data["msisdn"]=="") $subscriber = $ApiUser->api_response("503", "No msisdn provided");
			if (isset($subscriber)) return $subscriber; //exit listSubscriber function

			$SessionToken = new SessionToken();
			$session_token = $SessionToken->findBySessionToken($data["session_token"]);		
			$api_user_id = $session_token["SessionToken"]["api_user_id"];
			$data["created_by"] = $api_user_id;
			$data["modified_by"] = $api_user_id;
			$data["date_join"] = date("Y-m-d H:i:s");
			$data["date_created"] = date("Y-m-d H:i:s");
			$data["date_modified"] = date("Y-m-d H:i:s");
			$data["password"] = $this->generatePassword();
			$data["status"] = "active";
			
			/*
			if(array_key_exists("email", $data)) {             //check for duplicated email address 
				if(isset($data["email"]) and $data["email"]!="") {
					$memb3 = $this->findByEmail($data["email"]);
					if($memb3) {
						$subscriber = $ApiUser->api_response("402", "Subscriber profile cannot be saved. Subscriber email already exists.");
						return $subscriber;
					}
				}
			}*/
			
			$memb = $this->find('first',array('conditions' => array('Subscriber.msisdn'=>$data["msisdn"]),'recursive' => -1)); // check if msisdn exist

			if ($memb) {
				if ($this->isActive($memb["Subscriber"]["id"])) {
					$subscriber = $ApiUser->api_response("500", "Subscriber profile cannot be saved. Subscriber MSISDN already exists.");
				} else {
					if ($this->activate($memb["Subscriber"]["id"])) {
						$data["id"] = $memb["Subscriber"]["id"];
						$memb = false;
					} else {
						$subscriber = $ApiUser->api_response("500", "Subscriber MSISDN already exists, unable to activate subscriber");
					}
				}
			}
			
			if(!$memb) {
				$data["keyword"] = "YOONIC";
				$data["mt_id"] = $Log->id_generator(); //Generate new MT_id to be send to PHPGateway
				if (!isset($data["mo_id"]) || empty($data["mo_id"])) {//mo_id should be provided from PHPGateway if not this is an Mobile server request #WARNING mo_id can be set to empty and this will be assumed to be from PHPGATEWAY
					$mo_id = "";
					$data["msg_org_lnk_id"] = $Log->id_generator();
					$msg_org_lnk_id = $data["msg_org_lnk_id"];
				} else {
					$mo_id = $data["mo_id"];
					$msg_org_lnk_id ="";
				}

				// send vcode
				$curl = curl_init();
				$gatewayurl= Configure::read(Configure::read('http.mode').'.smsc').'&keyword=YOONIC&MSISDN='.$data["msisdn"].'&vcode='.$data["password"].'&MT_id='.$data["mt_id"]."&MO_id=".$mo_id."&MessageOriginatingLinkID=".$msg_org_lnk_id;
				curl_setopt($curl, CURLOPT_URL, $gatewayurl);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				$curl_result = curl_exec($curl);
				curl_close($curl);

				if (isset($curl_result)) { //PHPGateway returns a response
					unset($KW_result);
					$KW_result = (string)$curl_result;
				} else { // CURL fails
					$KW_result = null;
				}
				$data["api_user_id"] = 0;
				$data["subscriber_id"] = 0;
				$data["request"] = $gatewayurl;
				$data["response"] = $KW_result;
				$log = $Log->recordRequest($data);

				$data["api_user_id"] = $api_user_id;

				$data["request"] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?post=".serialize($_POST);
				$data["api_user_id"] = $api_user_id;

				if($KW_result === "0") {   
					if ($this->save($data)) {						
						$curr_subscriber = $data;
						unset($curr_subscriber["session_token"]);
						unset($curr_subscriber["mo_id"]);
						unset($curr_subscriber["mt_id"]);
						unset($curr_subscriber["msg_org_lnk_id"]);
						unset($curr_subscriber["api_user_id"]);
						unset($curr_subscriber["request"]);
						unset($curr_subscriber["response"]);						
						unset($curr_subscriber["keyword"]);
						unset($curr_subscriber["subscriber_id"]);
						$subscriber = array("ApiUser" => array("result_code" => "200", "message" => "Subscriber profile saved", "id" => $this->id, "subscriber"=>$curr_subscriber));
						$data["subscriber_id"] = $this->id;
					} else {
						$subscriber = $ApiUser->api_response("500", "Subscriber profile cannot be saved. Maybe some validation failed.");
					}
				} else {
					$subscriber = $ApiUser->api_response("500", "Unable to send Password to MSISDN.");
				}
				$data["response"] = $KW_result." + ".$subscriber["ApiUser"]["message"];
				$log = $Log->recordRequest($data);
			} 
		} else {$subscriber = $ApiUser->api_response("500", "Unauthorised");}
		return $subscriber;
	}
	
	
/**
 * editSubscriber method
 * 
 * @param array
 * @return array
 */
	public function editSubscriber($data) {
		$ApiUser = new ApiUser();
		if($data) {
			if(array_key_exists("session_token", $data)) {
				if($data["session_token"]=="") $subscriber = $ApiUser->api_response("500", "No session provided");
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));
				if($isSessionValid["ApiUser"]["result_code"]!="200") $subscriber = $ApiUser->api_response("500", "Unauthorised");
			} else {$subscriber = $ApiUser->api_response("500", "No session provided");}			
			if(!isset($data["telco_id"]) or $data["telco_id"]=="") $subscriber = $ApiUser->api_response("500", "No telco provided");
			if(!isset($data["id"]) or $data["id"]=="") {
				$subscriber = $ApiUser->api_response("500", "No subscriber ID provided");
			} else {
				if (!$this->isActive($data["id"])) $subscriber = $ApiUser->api_response("500", "Subscriber is inactive");
			}
			$this->id = $data["id"];
			if (!$this->exists()) $subscriber = $ApiUser->api_response("500", "Invalid subscriber ID");
		
			
			if(array_key_exists("password", $data)) {       //method allows for changing of vcode
				if(!isset($data["password"]) or $data["password"]=="") {$subscriber = $ApiUser->api_response("500", "No password provided when password is declared in the key.");}
			}

			if (isset($subscriber)) return $subscriber; //exit editSubscriber function
			$SessionToken = new SessionToken();
			$session_token = $SessionToken->findBySessionToken($data["session_token"]);		
			$api_user_id = $session_token["SessionToken"]["api_user_id"];
			$data["modified_by"] = $api_user_id;			
			$data["date_modified"] = date("Y-m-d H:i:s");
			
			// check if msisdn exists
			if(isset($data["msisdn"]) and $data["msisdn"]!="") {
				$memb = $this->findByMsisdn($data["msisdn"]);
				if($memb) {
					if($memb["Subscriber"]["id"]!=$data["id"]) $subscriber = $ApiUser->api_response("500", "Msisdn already exists.");   //when msisdn & id doesn't match}
				}
			} else {$subscriber = $ApiUser->api_response("500", "No Msisdn provided");}

			// check if email exists
			/*
			if(array_key_exists("email", $data)) {
				if(isset($data["email"]) and $data["email"]!="") {
					$memb = $this->findByEmail($data["email"]);		
					if($memb) $subscribers = $ApiUser->api_response("500", "Email already exists.");
				}
			}*/
			
			if (isset($subscriber)) return $subscriber; //exit editSubscriber function
			if ($this->save($data)) {                // save data to members
				$subscriber = $ApiUser->api_response("200", "Subscriber profile saved");
			} else {$subscriber = $ApiUser->api_response("400", "Subscriber profile cannot be saved. Maybe some validation failed.");}		
		} else {$subscriber = $ApiUser->api_response("500", "Unauthorised");}
		return $subscriber;
	}

/**
 * resetPassword method
 * 
 * @params array
 * @return array
 */
 	public function resetPassword($data) { 
 		$ApiUser = new ApiUser();
		$Log = new Log();
 		if($data) { 			
 			if(array_key_exists("session_token", $data)) {
 				if($data["session_token"]=="") $subscriber = $ApiUser->api_response("500", "No session provided <1>");
 			} else {$subscriber = $ApiUser->api_response("500", "No session provided <2>");}

			if(!isset($data["telco_id"]) or $data["telco_id"]=="") $subscriber = $ApiUser->api_response("500", "No telco provided <3>");

			if(!isset($data["msisdn"]) or $data["msisdn"]=="") {		
				if(!isset($data["id"]) or $data["id"]=="") {
					$subscriber = $ApiUser->api_response("500", "No subscriber ID/msisdn provided <4>");
				} else {
					unset($result);
					$result = $this->findById($data["id"]);
					if ($result) {			
						$data["msisdn"] = $result['Subscriber']['msisdn'];
						$data["password"] = $result['Subscriber']['password'];
						if ($result["Subscriber"]["status"] == "inactive") $ApiUser->api_response("500", "Subscriber is inactive <5>");
					} else {
						$subscriber = $ApiUser->api_response("500", "No matching msisdn for the subscriber ID provided <6>");
					}
				}
			}

			if(!isset($data["id"]) or $data["id"]=="") {	
				if(!isset($data["msisdn"]) or $data["msisdn"]=="") {
					$subscriber = $ApiUser->api_response("500", "No subscriber ID/msisdn provided <7>");
				} else {
					$result = $this->findByMsisdn($data["msisdn"]);		
					if ($result) {
						$data["id"] = $result['Subscriber']['id'];
						$data["password"] = $result['Subscriber']['password'];
					} else {$subscriber = $ApiUser->api_response("500", "No matching subscriber ID for the msisdn provided <8>");}
				}
			} else {
				unset($result);
				if ($this->findById($data["id"])) {
					if (!$this->isActive($data["id"])) $subscriber = $ApiUser->api_response("500", "Subscriber is inactive <9>");
				} else {
					$subscriber = $ApiUser->api_response("500", "Subscriber id is invalid <10>");
				}
			}

			if (isset($subscriber)) return $subscriber; //exit resetPassword function
			$SessionToken = new SessionToken();
			$session_token = $SessionToken->findBySessionToken($data["session_token"]);		
			$api_user_id = $session_token["SessionToken"]["api_user_id"];
 		
 			if($data["session_token"]!="" and $data["msisdn"]!="") {
 				$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));
 				if($isSessionValid["ApiUser"]["result_code"]=="200") {
 					$password = (isset($data["password"])) ? $data["password"]:$this->generatePassword();
					$data["keyword"] = "YOONIC";
					$data["mt_id"] = $Log->id_generator(); //Generate new MT_id to be send to PHPGateway
					if (!isset($data["mo_id"])) {//mo_id should be provided from PHPGateway if not this is an Mobile server request #WARNING mo_id can be set to empty and this will be assumed to be from PHPGATEWAY
						$mo_id = "";
						$data["msg_org_lnk_id"] = $Log->id_generator();
						$msg_org_lnk_id = $data["msg_org_lnk_id"];
					} else {
						$mo_id = $data["mo_id"];
						$msg_org_lnk_id ="";
					}

					/* recover password no need to save
					$this->id = $data["id"];
					$this->password = $password;
					$this->saveField("password", $password);
					*/
					
					$curl = curl_init(); 						
					$smsurl= Configure::read(Configure::read('http.mode').'.smsc').'&keyword=YNC&MSISDN='.$data["msisdn"].'&vcode='.$password.'&MT_id='.$data["mt_id"]."&MO_id=".$mo_id."&MessageOriginatingLinkID=".$msg_org_lnk_id;
					curl_setopt($curl, CURLOPT_URL, $smsurl);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					$curl_result = curl_exec($curl);
					curl_close($curl);
					
	 				if (isset($curl_result)) { //PHPGateway returns a response
						unset($KW_result);
						$KW_result = (string)$curl_result;
					} else { // CURL fails
						$KW_result = null;
					}

					$subscriber_id = $data["id"];
					unset($data["id"]);
					$data["api_user_id"] = 0;
					$data["subscriber_id"] = $subscriber_id;
					$data["request"] = $smsurl;
					$data["response"] = $KW_result;
					$data['keyword'] = "YNC";
					$log = $Log->recordRequest($data);

					$data["api_user_id"] = $api_user_id;

					$data["request"] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?post=".serialize($_POST);
					$data["api_user_id"] = $api_user_id;
					
					if($KW_result === "0") {   					
 						$subscriber = array("ApiUser" => array("result_code" => "200", "message" => "Password generated and sent sms", "password" => $password));
 					} else {
 						$subscriber = $ApiUser->api_response("500", "Unable to send Password to MSISDN <11>");
 					}
 				} else {$subscriber = $ApiUser->api_response("500", "Unauthorised <12>");}
 			}
 		} else {$subscriber = $ApiUser->api_response("500", "Unauthorised <13>");}
 		$data["response"] = $KW_result."+ ".$subscriber["ApiUser"]["message"];
		$log = $Log->recordRequest($data);
		return $subscriber;
 	}
	
/**
 * deleteSubscriber method
 * 
 * @params array
 * @return array
 */
	public function deleteSubscriber($data) {
		$ApiUser = new ApiUser();
		$Subscription = new Subscription();
		if($data) {
			if($data["session_token"]=="") $subscriber = $ApiUser->api_response("500", "No session provided");
			$this->id = $data["id"];
			if (!$this->exists()) $subscriber = $ApiUser->api_response("500", "Invalid subscriber ID");
			if(!isset($data["id"]) or $data["id"]=="") {
				$subscriber = $ApiUser->api_response("500", "No subscriber ID provided");
			} else {
				if (!$this->isActive($data["id"])) $subscriber = $ApiUser->api_response("500", "Subscriber is inactive");
			}
			if(!isset($data["telco_id"]) or $data["telco_id"]=="") $subscriber = $ApiUser->api_response("500", "No telco provided");
		
			if (isset($subscriber)) return $subscriber; //exit deletePassword function
			if($data["session_token"]!="" and $data["telco_id"]!="" and $data["id"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));
				$this->status = "inactive";
				if($isSessionValid["ApiUser"]["result_code"]=="200") {
					if ($this->saveField("status", "inactive")) {
						if ($Subscription->deleteAll(array("Subscription.telco_id"=>$data["telco_id"], "Subscription.subscriber_id"=>$data["id"]), false)) { //try deleting subscriptions
							$subscriber = $ApiUser->api_response("200", "Subscriber is deactivated, all subscriptions deleted");
						} else {
							$subscriber = $ApiUser->api_response("200", "Subscriber is deactivated, unable to delete existing subscriptions");
						}
					} else {
						$subscriber = $ApiUser->api_response("500", "Subscriber profile cannot be deactivated. Maybe some validation failed.");
					}
				} else {$subscriber = $ApiUser->api_response("500", "Unauthorised");}
			}
		} else {$subscriber = $ApiUser->api_response("500", "Unauthorised");}
		return $subscriber;
	}
	
}
