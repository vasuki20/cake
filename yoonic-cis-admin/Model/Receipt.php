<?php
App::uses('AppModel', 'Model');
App::import('model','ApiUser');
App::import('model','Subscription');
App::import('model','Log');

/**
 * Device Model
 *
 * @property Admin $Admin
 * @property Receipt $Receipt
 */
class Receipt extends AppModel {
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
		'mt_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'request' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'response' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
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
 * chargeRequest method
 *
 * @var array => session_token, telco_id, msisdn, request, response
 * @return array
 */
	public function chargeReceipt($data) {
		$ApiUser = new ApiUser();
    $Log = new Log();
    $Subscription = new Subscription();
		if($data) {
			if($data["session_token"]=="") {
				$receipt = $ApiUser->api_response("500", "No session provided");
				return $receipt;
			}

			if(!isset($data["telco_id"]) or $data["telco_id"]=="") {
				$receipt = $ApiUser->api_response("500", "No telco provided");
				return $receipt;
			}

			if(!isset($data["request"]) or $data["request"]=="") {
				$receipt = $ApiUser->api_response("500", "No request provided");
				return $receipt;
			}

			if(!isset($data["response"]) or $data["response"]=="") {
				$receipt = $ApiUser->api_response("500", "No response provided");
				return $receipt;
			}

			if($data["session_token"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));

				if($isSessionValid["ApiUser"]["result_code"]=="200") {


					if ($this->save($data,false)) {
							$receipt = array("Receipt" => array("result_code" => "200", "message" => "Receipt saved"));

							$content = $this->id
							.' | '.((isset($data['dn_id'])) ? $data['dn_id'] : '')
							.' | '.((isset($data['mt_id'])) ? $data['mt_id'] : '')
							.' | '.((isset($data['telco_id'])) ? $data['telco_id'] : '')
							.' | '.((isset($data['request'])) ? $data['request'] : '')
							.' | '.((isset($data['response'])) ? $data['response'] : '')
							.' | '.date("Y-m-d H:i:s");

							$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'dn.log', $content. PHP_EOL);
					} else {
							$receipt = array("Receipt" => array("result_code" => "500", "message" => "Unable to save receipt"));
					}

          			
        			if (isset($data['mt_id'])) {
          				$mt_id = $data['mt_id'];
          				$affected_record = $Log->findByMtId($mt_id);

						$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'test.log', "mt_id ".$mt_id. PHP_EOL);

          				if ($affected_record) {

							$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'test.log', "subscriber_id ".$affected_record["Log"]["subscriber_id"]. PHP_EOL);

            				$subscriber_id = $affected_record["Log"]["subscriber_id"];
            				$keyword = $affected_record["Log"]["keyword"];
            				$affected_subscription = $Subscription->find('first', array(
              				'conditions' => array('Subscription.subscriber_id' => $subscriber_id, 'Subscription.new_keyword' => $keyword),     //this is to find new charge request
              				'order' => array('Subscription.id DESC'))
            				);

            				if ($affected_subscription) {

								$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'test.log', "subscription_id ".$affected_subscription["Subscription"]['id']. PHP_EOL);

                				$subscription_id = $affected_subscription["Subscription"]['id'];
                				$subscription_start_date = $affected_subscription["Subscription"]["subscription_start_date"];
								$subscription_end_date = $affected_subscription["Subscription"]["subscription_end_date"];
								$subscription_airtime = $affected_subscription["Subscription"]["airtime"];
								$subscription_keyword = $affected_subscription["Subscription"]["keyword"];
								
								/*
                				$new_subscription_start_date = $affected_subscription["Subscription"]["new_subscription_start_date"];
								$new_subscription_end_date = $affected_subscription["Subscription"]["new_subscription_end_date"];
								$new_subscription_airtime = $affected_subscription["Subscription"]["new_airtime"];
								$new_subscription_keyword = $affected_subscription["Subscription"]["new_keyword"];
								*/


								$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'test.log', "1".$affected_subscription["Subscription"]["subscription_start_date"]. PHP_EOL);
								$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'test.log', "2".$affected_subscription["Subscription"]["subscription_end_date"]. PHP_EOL);
								$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'test.log', "3".$affected_subscription["Subscription"]["airtime"]. PHP_EOL);
								$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'test.log', "4".$affected_subscription["Subscription"]["keyword"]. PHP_EOL);
								/*
								$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'test.log', "5".$affected_subscription["Subscription"]["new_subscription_start_date"]. PHP_EOL);
								$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'test.log', "6".$affected_subscription["Subscription"]["new_subscription_end_date"]. PHP_EOL);
								$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'test.log', "7".$affected_subscription["Subscription"]["new_airtime"]. PHP_EOL);
								$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'test.log', "8".$affected_subscription["Subscription"]["new_keyword"]. PHP_EOL);
								*/

								if (isset($data['response']) && intval($data['response']) != 1) { //charging failed

								$response_code = 500;

								$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'test.log', "charging failed". PHP_EOL);
									/*
									$valid_subscription_keyword = $old_subscription_keyword;
									$valid_subscription_airtime = 0;
									$valid_subscription_start_date = $old_subscription_start_date;
									$valid_subscription_end_date = $old_subscription_end_date;
									*/
									if ($valid_subscription_keyword == "ON TP1") { //delete the ON TP1 entry from subscription table, clear the base subscription new expiry date
										$Subscription->delete($subscription_id);
										
										
										$base_subscription = $Subscription->find('first', array(
		                  					'conditions' => array('Subscription.subscriber_id' => $subscriber_id, 'Subscription.keyword !=' => "ON TP1"),
		                  					'order' => array('Subscription.id ASC'))
			               				);
			
										if ($base_subscription) {

											$base_subscription_id = $base_subscription["Subscription"]["id"];

											$Subscription->id = $base_subscription_id;
											$Subscription->saveField("subscription_end_date", $this->addHour($base_subscription["Subscription"]["subscription_end_date"],-2));
										}
									} 


	                				$PARAM = array('id' => $subscription_id,
	                        			'subscriber_id' => $subscriber_id,
	                        			'subscription_start_date' => $subscription_start_date,
	                        			'subscription_end_date' => @DboSource::expression('NOW()'), //$subscription_end_date,
	                        			'airtime' => 0, //$subscription_airtime,
	                        			'keyword' => $subscription_keyword
	                				);

	                				//$Subscription->id = $subscription_id;
	                				//$Subscription->saveField("subscription_end_date", $subscription_start_date); //saving back to DB

	                				unset($curl_result);
	                				$sms_keyword = str_replace(' ', '+', $keyword);
	                				$curl = curl_init();
	                				$mobileserverurl= "http://mobile.e1.sg/yoonic/index.php/subscriber/subscription";

	                				curl_setopt($curl, CURLOPT_URL, $mobileserverurl);
	                				curl_setopt($curl, CURLOPT_POST, 1);
	                				curl_setopt($curl, CURLOPT_POSTFIELDS, $PARAM);
	                				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	                				$curl_result = curl_exec($curl);
	                				curl_close($curl);
	                				if (isset($curl_result)) { //PHPGateway returns a response
	                  					unset($KW_result);
	                  					$KW_result = (string)$curl_result;
	                				} else { // CURL fails
	                  					$KW_result = null;
	                				}
	                				//does nothing
	                				$receipt = array("ApiUser" => array("result_code" => $response_code, "message" => "Charging response".serialize($PARAM)));

									$PARAM['request'] = $mobileserverurl . serialize($PARAM);
									$PARAM['response'] = $receipt["ApiUser"]["message"];
									$PARAM['session_token'] = $data['session_token'];
									unset($PARAM["id"]);
									$log = $Log->recordRequest($PARAM); //save to log


									
								}
            				}
          				}
        			}

				} else {
					$receipt = $ApiUser->api_response("440", "Session Expired");
				}
			} else {
				$receipt = $ApiUser->api_response("500", "Session does not exist");
			}
		} else {
			$receipt = $ApiUser->api_response("500", "Unauthorised");
		}

		return $receipt;
	}


	public function addHour($givendate,$hr=0){
	    $cd = strtotime($givendate);
    	$newdate = date('Y-m-d h:i:s', mktime(date('h',$cd)+$hr,
    	date('i',$cd), date('s',$cd), date('m',$cd),
    	date('d',$cd), date('Y',$cd)));
    	return $newdate;
	}


/**
 * reminderRequest method
 *
 * @var array => session_token, telco_id, msisdn, request, response
 * @return array
 */
	public function reminderReceipt($data) {
		$ApiUser = new ApiUser();
		if($data) {
			if($data["session_token"]=="") {
				$receipt = $ApiUser->api_response("500", "No session provided");
				return $receipt;
			}

			if(!isset($data["telco_id"]) or $data["telco_id"]=="") {
				$receipt = $ApiUser->api_response("500", "No telco provided");
				return $receipt;
			}

			if(!isset($data["request"]) or $data["request"]=="") {
				$receipt = $ApiUser->api_response("500", "No request provided");
				return $receipt;
			}

			if(!isset($data["response"]) or $data["response"]=="") {
				$receipt = $ApiUser->api_response("500", "No response provided");
				return $receipt;
			}

			if($data["session_token"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));

				if($isSessionValid["ApiUser"]["result_code"]=="200") {

					if ($this->save($data,false)) {
							$receipt = array("Receipt" => array("result_code" => "200", "message" => "Receipt saved"));

							$content = $this->id
							.' | '.((isset($data['dn_id'])) ? $data['dn_id'] : '')
							.' | '.((isset($data['mt_id'])) ? $data['mt_id'] : '')
							.' | '.((isset($data['telco_id'])) ? $data['telco_id'] : '')
							.' | '.((isset($data['request'])) ? $data['request'] : '')
							.' | '.((isset($data['response'])) ? $data['response'] : '')
							.' | '.date("Y-m-d H:i:s");

							$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'dn.log', $content. PHP_EOL);
					} else {
							$receipt = array("ApiUser" => array("result_code" => "500", "message" => "Unable to save receipt"));
					}

				} else {
					$receipt = $ApiUser->api_response("440", "Session Expired");
				}
			} else {
				$receipt = $ApiUser->api_response("500", "Session does not exist");
			}
		} else {
			$receipt = $ApiUser->api_response("500", "Unauthorised");
		}

		return $receipt;
	}


/**
 * terminateRequest method
 *
 * @var array => session_token, telco_id, msisdn, request, response
 * @return array
 */
	public function terminateReceipt($data) {
		$ApiUser = new ApiUser();
		if($data) {
			if($data["session_token"]=="") {
				$receipt = $ApiUser->api_response("500", "No session provided");
				return $receipt;
			}

			if(!isset($data["telco_id"]) or $data["telco_id"]=="") {
				$receipt = $ApiUser->api_response("500", "No telco provided");
				return $receipt;
			}

			if(!isset($data["request"]) or $data["request"]=="") {
				$receipt = $ApiUser->api_response("500", "No request provided");
				return $receipt;
			}

			if(!isset($data["response"]) or $data["response"]=="") {
				$receipt = $ApiUser->api_response("500", "No response provided");
				return $receipt;
			}

			if($data["session_token"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));

				if($isSessionValid["ApiUser"]["result_code"]=="200") {

					if ($this->save($data,false)) {
							$receipt = array("Receipt" => array("result_code" => "200", "message" => "Receipt saved"));

							$content = $this->id
							.' | '.((isset($data['dn_id'])) ? $data['dn_id'] : '')
							.' | '.((isset($data['mt_id'])) ? $data['mt_id'] : '')
							.' | '.((isset($data['telco_id'])) ? $data['telco_id'] : '')
							.' | '.((isset($data['request'])) ? $data['request'] : '')
							.' | '.((isset($data['response'])) ? $data['response'] : '')
							.' | '.date("Y-m-d H:i:s");

							$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'dn.log', $content. PHP_EOL);
					} else {
							$receipt = array("ApiUser" => array("result_code" => "500", "message" => "Unable to save receipt"));
					}
				} else {
					$receipt = $ApiUser->api_response("440", "Session Expired");
				}
			} else {
				$receipt = $ApiUser->api_response("500", "Session does not exist");
			}
		} else {
			$receipt = $ApiUser->api_response("500", "Unauthorised");
		}

		return $receipt;
	}


	public	function atomic_put_contents($filename, $data)
	{
	    // Copied largely from http://php.net/manual/en/function.flock.php
	    $fp = fopen($filename, "a+");
	    if (flock($fp, LOCK_EX)) {
	        fwrite($fp, $data);
	        flock($fp, LOCK_UN);
	    }
	    fclose($fp);
	}

}
