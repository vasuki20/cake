<?php
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');
App::import('model','ApiUser');
App::import('model','Subscription');
App::import('model','Transaction');
/**
 * Member Model
 *
 * @property Telco $Telco
 */
class Member extends AppModel {
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
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'vcode' => array(
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
		),
		'device_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'device_model' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'password' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
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
		),
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
		'date_trial_expired' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'wallet_balance' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
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
		),
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
					'foreignKey' => 'member_id',
					'dependent' => false,
					'conditions' => array("Subscription.status"=>"active"),
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
 * verifyMember method
 * 
 * @var array => session_token, telco_id, msisdn, vcode
 * @return array
 */
	public function verifyMember($query) {
		$ApiUser = new ApiUser();
		if($query) {
			if($query["session_token"]=="") {
				$members = $ApiUser->api_response("501", "No session provided");
				return $members;
			}
		
			if(!isset($query["telco_id"]) or $query["telco_id"]=="") {
				$members = $ApiUser->api_response("502", "No telco provided");
				return $members;
			}
			
			if(!isset($query["msisdn"]) or $query["msisdn"]=="") {
				$members = $ApiUser->api_response("504", "No msisdn provided");
				return $members;
			}
			
			if(!isset($query["vcode"]) or $query["vcode"]=="") {
				$members = $ApiUser->api_response("505", "No vcode provided");
				return $members;
			}
		
			if($query["session_token"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$query["session_token"]));
				
				if($isSessionValid["ApiUser"]["result_code"]=="200") {
					$subscription = new Subscription();
					$conditions = array("Member.telco_id" => $query["telco_id"], "Member.msisdn" => $query["msisdn"], "Member.vcode" => $query["vcode"]);
					$member = $this->find('first', array('conditions' => $conditions));
					$query["member_id"]=$member["Member"]["id"];
					$subscription->updateActiveSubscription($query);
					
					$conditions = array("Member.telco_id" => $query["telco_id"], "Member.msisdn" => $query["msisdn"], "Member.vcode" => $query["vcode"]);
					$member = $this->find('first', array('conditions' => $conditions));
					
					if($member>0) {
						$members = array("Members" => array("result_code" => "200", "message" => "Member exists and the msisdn and vcode is matching for this telco", "item" => $member));
					} else {
						$members = array("Members" => array("result_code"=>"404", "message" => "Member does not exist for this telco"));
					}
				} else {
					$members = $ApiUser->api_response("403", "Session Expired");
				}
			} else {
				$members = $ApiUser->api_response("404", "Session does not exist");
			}
		} else {
			$members = $ApiUser->api_response("500", "Unauthorised");
		}
		
		return $members;
	}
	
/**
 * listMembers method
 *
 * @param array => session_token, telco_id
 * @return array
 */
	public function listMembers($query) {
		$ApiUser = new ApiUser();
		if($query) {
			if($query["session_token"]=="") {
				$members = $ApiUser->api_response("501", "No session provided");
				return $members;
			}
				
			if(!isset($query["telco_id"]) or $query["telco_id"]=="") {
				$members = $ApiUser->api_response("502", "No telco provided");
				return $members;
			}
				
			if($query["session_token"]!="" and $query["telco_id"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$query["session_token"]));
	
				if($isSessionValid["ApiUser"]["result_code"]=="200") {
					if(array_key_exists("page", $query)) {
						$conditions = array("Member.telco_id" => $query["telco_id"]);
						$all_members = $this->find('all', array('conditions' => $conditions, "limit" => "50", "page" => $query["page"]));
					} else {
						$all_members = $this->findAllByTelcoId($query["telco_id"]);
					}
					
					if($all_members>0) {
						$members = array("Members" => array("item" => $all_members));
					} else {
						$members = array("Members" => array("result_code"=>"404", "message" => "There are no members"));
					}
				} else {
					$members = $ApiUser->api_response("403", "Session Expired");
				}
			}
		} else {
			$members = $ApiUser->api_response("500", "Unauthorised");
		}
	
		return $members;
	}
	
/**
 * viewMember method
 *
 * @param array => session_token, telco_id, id
 * @return array
 */
	public function viewMember($query) {
		$ApiUser = new ApiUser();
		if($query) {
			if($query["session_token"]=="") {
				$members = $ApiUser->api_response("501", "No session provided");
				return $members;
			}
				
			if(!isset($query["telco_id"]) or $query["telco_id"]=="") {
				$members = $ApiUser->api_response("502", "No telco provided");
				return $members;
			}
	
			if(!isset($query["id"]) or $query["id"]=="") {
				$members = $ApiUser->api_response("503", "No member provided");
				return $members;
			}
				
			if($query["session_token"]!="" and $query["id"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$query["session_token"]));
	
				if($isSessionValid["ApiUser"]["result_code"]=="200") {
					$this->id = $query["id"];
					if (!$this->exists()) {
						$members = array( "Members" => array( "result_code" => "404", "message" => "Invalid Member"));
					} else {
						$conditions = array("Member.id" => $query["id"], "Member.telco_id" => $query["telco_id"]);
						$member = $this->find('first', array('conditions' => $conditions));
	
						if($member>0) {
							$members = array("Members" => array("item" => $member));
						} else {
							$members = array("Members" => array("result_code"=>"404", "message" => "Member does not exist for this telco"));
						}
					}
				} else {
					$members = $ApiUser->api_response("403", "Session Expired");
				}
			}
		} else {
			$members = $ApiUser->api_response("500", "Unauthorised");
		}
	
		return $members;
	}


/**
* generateVcode method
* 
* @param none
* @return string
*/
	public function generateVcode() {
		return rand(1000, 9999);
	}

	
/**
 * addMember method
 *
 * @param array
 * @return array
 */
	public function addMember($data) {
		$ApiUser = new ApiUser();
		if($data) {
			if(!isset($data["session_token"]) or $data["session_token"]=="") {
				$members = $ApiUser->api_response("501", "No session provided");
				return $members;
			}
	
			if(!isset($data["telco_id"]) or $data["telco_id"]=="") {
				$members = $ApiUser->api_response("502", "No telco provided");
				return $members;
			}
			
			if(!isset($data["msisdn"]) or $data["msisdn"]=="") {
				$members = $ApiUser->api_response("503", "No msisdn provided");
				return $members;
			}
			
			if(!isset($data["device_name"]) or $data["device_name"]=="") {
				$members = $ApiUser->api_response("504", "No device name provided");
				return $members;
			}
			
			if(!isset($data["device_model"]) or $data["device_model"]=="") {
				$members = $ApiUser->api_response("505", "No device model provided");
				return $members;
			}
			
			if(!isset($data["status"]) or $data["status"]=="") {
				$members = $ApiUser->api_response("506", "No status  provided");
				return $members;
			}
			
			if(!isset($data["date_join"]) or $data["date_join"]=="") {
				$members = $ApiUser->api_response("507", "No date join  provided");
				return $members;
			}
			
			if(!isset($data["wallet_balance"]) or $data["wallet_balance"]=="") {
				$members = $ApiUser->api_response("508", "No wallet balance  provided");
				return $members;
			}
			
			if(!isset($data["created_by"]) or $data["created_by"]=="") {
				$members = $ApiUser->api_response("509", "No creator ID provided");
				return $members;
			}
			
			if(!isset($data["modified_by"]) or $data["modified_by"]=="") {
				$members = $ApiUser->api_response("510", "No modifier ID provided");
				return $members;
			}
			
			$data["date_created"] = date("Y-m-d H:i:s");
			$data["date_modified"] = date("Y-m-d H:i:s");
			
			if($data["session_token"]!="" and $data["telco_id"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));
					
				if($isSessionValid["ApiUser"]["result_code"]=="200") {
					$data["vcode"] = $this->generateVcode();
					
					if(array_key_exists("email", $data)) {
						if(isset($data["email"]) and $data["email"]!="") {
							$memb3 = $this->findByEmail($data["email"]);
								
							if($memb3) {
								$member = $ApiUser->api_response("402", "Member profile cannot be saved. Member email already exists.");
								
								return $member;
							}
						}
					}
					
					$this->create();
					
					$memb = $this->findByMsisdn($data["msisdn"]);
					
					
					if(!$memb) {
						
						$Transactions = new Transaction();
						
						$data["UserID"] = "0";
						$data["ApplicationID"] = "0";
						$data["TransactionID"] = "100000000000";
						$data["TransactionType"] = "CHECKMSISDN";
						$data["ProductID"] = "0";
						$data["ProductType"] = "0";
						$data["SourceID"] = "0";
						$data["DestinationID"] = "0";
						$data["Amount"] = "0";
						$data["VendorID"] = "0";
						
						$transaction = $Transactions->addTransaction($data);
						
						if($transaction["Transactions"]["item"]["ResponseCode"]=="000") {
							if ($this->save($data)) {
								
								
								// send email
								$memb2 = $this->findByMsisdn($data["msisdn"]);
								
								if($memb2) {
									if(isset($memb2["Member"]["email"]) and $memb2["Member"]["email"]!="") {
										
										$email = new CakeEmail('default');
										
										$email->from(array(Configure::read('reg.email') => 'Yoonic Admin'));
										$email->to($memb2["Member"]["email"]);
										$email->subject('Yoonic account');
										$email->send('Your password is '.$data["vcode"]);
									}
								}
								
								// for testing
								if(Configure::read('http.mode') == "dev") {
									$email = new CakeEmail('default');
									
									$email->from(array(Configure::read('reg.email') => 'Yoonic Admin'));
									$email->to('terry_v16@yahoo.co.id');
									$email->subject('Yoonic account');
									$email->send('Your msisdn is '.$memb2["Member"]["msisdn"].' Your password is '.$data["vcode"]);
								}
								
								
								// send sms
								$curl = curl_init();
								
								$smsurl= Configure::read(Configure::read('http.mode').'.smsc').'username=test&password=testpass&to='.$memb2["Member"]["msisdn"].'&text=Your password is '.$memb2["Member"]["vcode"];
								
								curl_setopt($curl, CURLOPT_URL, $smsurl);
								curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
								$curl_result = curl_exec($curl);
								curl_close($curl);
								
								$member = array("Members" => array("result_code" => "200", "message" => "Member profile saved", "item" => $memb2));
							} else {
								$member = $ApiUser->api_response("400", "Member profile cannot be saved. Maybe some validation failed.");
							}
						} else {
							$member = array("Members" => array("result_code" => "401", "message" => "Member profile cannot be saved. Member MSISDN already exists.", "item" => $transaction));
						}
					} else {
						$member = $ApiUser->api_response("401", "Member profile cannot be saved. Member MSISDN already exists.");
					}

					return $member;
				} else {
					$members = $ApiUser->api_response("500", "Unauthorised");
					
					return $members;
				}
			}
		} else {
			$members = $ApiUser->api_response("500", "Unauthorised");

			return $members;
		}
	}
	
	
/**
 * editMember method
 * 
 * @param array
 * @return array
 */
	public function editMember($data) {
		$ApiUser = new ApiUser();
		if($data) {
			if(array_key_exists("session_token", $data)) {
				if($data["session_token"]=="") {
					$members = $ApiUser->api_response("501", "No session provided");
					return $members;
				}
			} else {
				$members = $ApiUser->api_response("501", "No session provided");
				return $members;
			}
			
			if(!isset($data["id"]) or $data["id"]=="") {
				$members = $ApiUser->api_response("503", "No member provided");
				return $members;
			}
			
			$this->id = $data["id"];
			
			if (!$this->exists()) {
				$members = $ApiUser->api_response("404", "Invalid member");
				return $members;
			}
			
			
		
			if(!isset($data["telco_id"]) or $data["telco_id"]=="") {
				$members = $ApiUser->api_response("502", "No telco provided");
				return $members;
			}
			
			
			if(array_key_exists("vcode", $data)) {
				if(!isset($data["vcode"]) or $data["vcode"]=="") {
					$members = $ApiUser->api_response("511", "No vcode provided when vcode is declared in the key.");
					return $members;
				}
			}
			
			if(array_key_exists("created_by", $data)) {
				unset($data["created_by"]);
			}
			
			if(array_key_exists("date_created", $data)) {
				unset($data["date_created"]);
			}
			
			if(!isset($data["modified_by"]) or $data["modified_by"]=="") {
				$members = $ApiUser->api_response("510", "No modifier ID provided");
				return $members;
			}
			
			$data["date_modified"] = date("Y-m-d H:i:s");
			
			
			// check if msisdn exists
			if(isset($data["msisdn"]) and $data["msisdn"]!="") {
				$memb = $this->findByMsisdn($data["msisdn"]);
				
				if($memb) {
					if($memb["Member"]["id"]!=$data["id"]) {
						$members = $ApiUser->api_response("504", "Msisdn already exists.");
						return $members;
					}
				}
			} else {
				$members = $ApiUser->api_response("514", "No Msisdn provided");
				return $members;
			}
			
			// check if email exists
			if(array_key_exists("email", $data)) {
				if(isset($data["email"]) and $data["email"]!="") {
					$memb = $this->findByEmail($data["email"]);
					
					if($memb) {
						$members = $ApiUser->api_response("505", "Email already exists.");
						return $members;
					}
				}
			}
			
		
			if($data["session_token"]!="" and $data["telco_id"]!="" and $data["id"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));
					
				if($isSessionValid["ApiUser"]["result_code"]=="200") {
					if ($this->save($data)) {
						
						
						$memb = $this->findByMsisdn($data["msisdn"]);
						
						if(!$memb) {
							if ($this->save($data)) {
								
								if(isset($data["vcode"]) and $data["vcode"]!="") {
									// send email
									$memb2 = $this->findByMsisdn($data["msisdn"]);
									
									if($memb2) {
										if(isset($memb2["Member"]["email"]) and $memb2["Member"]["email"]!="") {
											
											$email = new CakeEmail('default');
											
											$email->from(array(Configure::read('reg.email') => 'Yoonic Admin'));
											$email->to($memb2["Member"]["email"]);
											$email->subject('Yoonic account');
											$email->send('Your password is '.$data["vcode"]);
										}
									}
									
									// for testing
									if(Configure::read('http.mode') == "dev") {
										$email = new CakeEmail('default');
										
										$email->from(array(Configure::read('reg.email') => 'Yoonic Admin'));
										$email->to('terry_v16@yahoo.co.id');
										$email->subject('Yoonic account');
										$email->send('Your password is '.$data["vcode"]);
									}
									
									
									// send sms
									$curl = curl_init();
									
									$smsurl= Configure::read(Configure::read('http.mode').'.smsc').'username=test&password=testpass&to='.$memb2["Member"]["msisdn"].'&text=Your password is '.$memb2["Member"]["vcode"];
									
									curl_setopt($curl, CURLOPT_URL, $smsurl);
									curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
									$curl_result = curl_exec($curl);
									curl_close($curl);
								}
								
								$member = array("Members" => array("result_code" => "200", "message" => "Member profile saved", "item" => $memb2));
							} else {
								$member = $ApiUser->api_response("400", "Member profile cannot be saved. Maybe some validation failed.");
							}
						}
					
						$member = $ApiUser->api_response("200", "Member profile saved");
					} else {
						$member = $ApiUser->api_response("400", "Member profile cannot be saved. Maybe some validation failed.");
					}
		
					return $member;
				} else {
					$members = $ApiUser->api_response("500", "Unauthorised");
						
					return $members;
				}
			}
		} else {
			$members = $ApiUser->api_response("500", "Unauthorised");
		
			return $members;
		}
	}

/**
 * resetVcode method
 * 
 * @params array
 * @return array
 */
 	public function resetVcode($data) {
 		$ApiUser = new ApiUser();
 		if($data) {
 			
 			if(array_key_exists("session_token", $data)) {
 				if($data["session_token"]=="") {
 					$members = $ApiUser->api_response("501", "No session provided");
 					return $members;
 				}
 			} else {
 				$members = $ApiUser->api_response("501", "No session provided");
 				return $members;
 			}
 			
 			
 				
 			if(!array_key_exists("username", $data)) {
 				$members = $ApiUser->api_response("502", "No username provided");
 				return $members;
 			}
 		
 			if($data["session_token"]!="" and $data["username"]!="") {
 				$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));
 					
 				if($isSessionValid["ApiUser"]["result_code"]=="200") {
 					$vcode = $this->generateVcode();
 					
 					if(Validation::email($data["username"])) {
 						
 						// send email
 						$memb2 = $this->findByEmail($data["username"]);
 						
 						if($memb2) {
 							
 							$this->id = $memb2["Member"]["id"];
 							$this->vcode = $vcode;
 							$this->saveField("vcode", $this->vcode);
 							
 							$email = new CakeEmail('default');
 							
 							$email->from(array(Configure::read('reg.email') => 'Yoonic Admin'));
 							$email->to($memb2["Member"]["email"]);
 							$email->subject('Yoonic account');
 							$email->send('Your password is '.$vcode);
 							
 							
 							// for testing
 							if(Configure::read('http.mode') == "dev") {
 								$email = new CakeEmail('default');
 								
 								$email->from(array(Configure::read('reg.email') => 'Yoonic Admin'));
 								$email->to('terry_v16@yahoo.co.id');
 								$email->subject('Yoonic account');
 								$email->send('Your msisdn is '.$memb2["Member"]["msisdn"].' Your password is '.$vcode);
 							}
 						}
 					} else {
 					
 						// send sms
 						$memb2 = $this->findByMsisdn($data["username"]);
 						
 						$this->id = $memb2["Member"]["id"];
 						$this->vcode = $vcode;
 						$this->saveField("vcode", $this->vcode);
 						
 						$curl = curl_init();
 						
 						$smsurl= Configure::read(Configure::read('http.mode').'.smsc').'username=test&password=testpass&to='.$memb2["Member"]["msisdn"].'&text=Your password is '.$vcode;
 						
 						curl_setopt($curl, CURLOPT_URL, $smsurl);
 						curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 						$curl_result = curl_exec($curl);
 						curl_close($curl);
 						
 						
 					
 					}
 					
 					$member = array("Members" => array("result_code" => "200", "message" => "Password generated and sent via email or sms", "item" => $vcode));
 		
 					return $member;
 				} else {
 					$members = $ApiUser->api_response("500", "Unauthorised");
 		
 					return $members;
 				}
 			}
 		} else {
 			$members = $ApiUser->api_response("500", "Unauthorised");
 		
 			return $members;
 		}
 	}
	
/**
 * deleteMember method
 * 
 * @params array
 * @return array
 */
	public function deleteMember($data) {
		$ApiUser = new ApiUser();
		if($data) {
			if($data["session_token"]=="") {
				$members = $ApiUser->api_response("501", "No session provided");
				return $members;
			}
				
			$this->id = $data["id"];
			if (!$this->exists()) {
				$members = $ApiUser->api_response("404", "Invalid member");
				return $members;
			}
				
			if(!isset($data["id"]) or $data["id"]=="") {
				$members = $ApiUser->api_response("503", "No member provided");
				return $members;
			}
		
			if(!isset($data["telco_id"]) or $data["telco_id"]=="") {
				$members = $ApiUser->api_response("502", "No telco provided");
				return $members;
			}
		
			if($data["session_token"]!="" and $data["telco_id"]!="" and $data["id"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));
					
				if($isSessionValid["ApiUser"]["result_code"]=="200") {
					if ($this->setDelete()) {
						$member = $ApiUser->api_response("200", "Member profile deleted");
					} else {
						$member = $ApiUser->api_response("400", "Member profile cannot be deleted. Maybe some validation failed.");
					}
		
					return $member;
				} else {
					$members = $ApiUser->api_response("500", "Unauthorised");
		
					return $members;
				}
			}
		} else {
			$members = $ApiUser->api_response("500", "Unauthorised");
		
			return $members;
		}
	}
	
	public function setDelete() {
		$this->deleted=true;
		$this->date_deleted=date("Y-m-d H:i:s");
		if($this->save($this)) {
			return true;
		} else {
			return false;
		}
	}
	
}
