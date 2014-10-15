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
	public function chargeReceipt($data)
	{
		$ApiUser = new ApiUser();
		$Log = new Log();
		$Subscription = new Subscription();
		if($data)
		{
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

			
			
			/// session token is not null
			if($data["session_token"]!="")
			{
			
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));
			
			
				/// write to the table Receipt
				if ($this->save($data,false)) {
					$receipt = array("Receipt" => array("result_code" => "200", "message" => "Receipt saved"));
	
					$content = $this->id
						.' | '.((isset($data['dn_id'])) ? $data['dn_id'] : '')
						.' | '.((isset($data['mt_id'])) ? $data['mt_id'] : '')
						.' | '.((isset($data['telco_id'])) ? $data['telco_id'] : '')
						.' | '.((isset($data['request'])) ? $data['request'] : '')
						.' | '.((isset($data['response'])) ? $data['response'] : '')
						.' | '.date("Y-m-d H:i:s");
	
						$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'dn-general.log', $content. PHP_EOL);
					} else {
						$receipt = array("Receipt" => array("result_code" => "500", "message" => "Unable to save receipt"));
						$this->atomic_put_contents( $_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'dn-error.log', $content. PHP_EOL);
					}
			
			
				/// valid session token
				if($isSessionValid["ApiUser"]["result_code"]=="200")
				{
					
					/// check response code	
					if ( intval($data['response']) > 1)
					{						
						/// extract the MT ID from the log table to extract the MO id
						$mt_id = $data['mt_id'];
						$affected_record = $Log->findByMtId($mt_id);
						
						//$results = $this->Order->query("select * from orders order by date");
						//$affected_record = 
						
						
						$subscriber_id = $affected_record["Log"]["subscriber_id"];
						$keyword = $affected_record["Log"]["keyword"];
						$affected_subscription = $Subscription->find('first', array(
						'conditions' => array('Subscription.subscriber_id' => $subscriber_id, 'Subscription.new_keyword' => $keyword),     //this is to find new charge request
						'order' => array('Subscription.id DESC'))
						);
						
						$select_all_from_subscription = $Subscription->find('all',array( 'conditions' => array('Subscription.subscriber_id' => $subscriber_id) ));
						unset($entry);
						foreach ($select_all_from_subscription as $item)
						{
							$entry = $item['Subscription']['subscriber_id']
							. ' | ' . $item['Subscription']['keyword']
							. ' | ' . $item['Subscription']['subscription_start_date']
							. ' | ' . $item['Subscription']['subscription_end_date']
							. ' | ' . $item['Subscription']['status']
							. ' | ' . $item['Subscription']['recurring']
							. ' | ' . $item['Subscription']['recurring_frequency']
							. ' | ' . $item['Subscription']['airtime']
							. ' | ' . $item['Subscription']['date_created']
							. ' | ' . $item['Subscription']['date_modified'];
							
							$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'dn-debug.log', "subscription : ".$entry. PHP_EOL);
						}
						
					
						$subscription_id = $affected_subscription["Subscription"]['id'];
						$subscription_start_date = $affected_subscription["Subscription"]["subscription_start_date"];
						$subscription_end_date = $affected_subscription["Subscription"]["subscription_end_date"];
						$subscription_airtime = $affected_subscription["Subscription"]["airtime"];
						$subscription_keyword = $affected_subscription["Subscription"]["keyword"];
						
						$putaffected = $subscription_id . " " . $subscription_airtime . " " . $subscription_keyword . " " . $subscription_start_date . " " . $subscription_end_date;
						
						$mtidentify = $mt_id;
						$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'dn-debug.log', "MT affected : ". $mtidentify . PHP_EOL);
						$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'dn-debug.log', "affected : ". $putaffected . PHP_EOL);
						
						
						if ($subscription_keyword == "ON TP1")
						{ //delete the ON TP1 entry from subscription table, clear the base subscription new expiry date
							$Subscription->delete($subscription_id);
						}
						
						
						///set the response code to 500
						$response_code = 500;
	
						$PARAM = array('id' => $subscription_id,
									'subscriber_id' => $subscriber_id,
									'subscription_start_date' => $subscription_start_date,
									'subscription_end_date' => $subscription_end_date, //@DboSource::expression('NOW()'), //$subscription_end_date,
									'airtime' => '-'.$subscription_airtime,
									'keyword' => $subscription_keyword
									);
					
						/// write to log
						$error_output = $subscriber_id . "|" . $subscription_airtime . "|" . $subscription_start_date . "|" . $subscription_end_date;
						
						$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'dn-failed.log', "Failed : ". $error_output . PHP_EOL);
						$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'dn-debug.log', "Failed : ". $error_output . PHP_EOL);
						
						unset($curl_result);
						$sms_keyword = str_replace(' ', '+', $keyword);
						$curl = curl_init();
			
						//$mobileserverurl= "http://mobile.e1.sg/yoonic/index.php/subscriber/subscription";
						$mobileserverurl= "http://maxis.ms.yoonic.tv/yoonic/index.php/subscriber/subscription";
			
						curl_setopt($curl, CURLOPT_URL, $mobileserverurl);
						curl_setopt($curl, CURLOPT_POST, 1);
						curl_setopt($curl, CURLOPT_POSTFIELDS, $PARAM);
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			
						$curl_result = curl_exec($curl);
						curl_close($curl);
						if (isset($curl_result))
						{ //PHPGateway returns a response
							unset($KW_result);
							$KW_result = (string)$curl_result;
						}
						else
						{ // CURL fails
							$KW_result = null;
						}
									//does nothing
						$receipt = array("ApiUser" => array("result_code" => $response_code, "message" => "Charging response".serialize($PARAM)));
						$PARAM['request'] = $mobileserverurl . serialize($PARAM);
						$PARAM['response'] = $receipt["ApiUser"]["message"];
						$PARAM['session_token'] = $data['session_token'];
						unset($PARAM["id"]);
						$log = $Log->recordRequest($PARAM); //save to log
						
		
					
				
						
					/// end of response > 1	
					}
					else if ( intval($data['response']) == 1)
					{  /// write success
						$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'dn-success.log', $content. PHP_EOL);
						
						
					}
					else{  /// put under unprocessed
						$this->atomic_put_contents( $_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'dn-unprocessed.log', $content. PHP_EOL);
					}
			
			
				/// end of valid session token	
				} else {
					$receipt = $ApiUser->api_response("440", "Session Expired");				
					}
		
			/// end of session token not null
			} else {
				$receipt = $ApiUser->api_response("500", "Unauthorised");
				}	
		
		///end of data block
		} else {
				$receipt = $ApiUser->api_response("500", "Unauthorised");			
			}
	   
	   /// final return
	   return $receipt;
	}
			


	

public function addHour($givendate,$hr=0)
{
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
		}
		else {
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
