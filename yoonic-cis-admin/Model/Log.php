<?php
App::uses('AppModel', 'Model');
App::import('model','ApiUser');

/**
 * Log Model
 *
 */
class Log extends AppModel {
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
		'mo_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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
			),
		),
		'api_user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'keyword' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'request' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'response' => array(
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
		'Subscriber' => array(
			'className' => 'Subscriber',
			'foreignKey' => 'subscriber_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
/**
 * recordRequest method
 * 
 * @var array => session_token, telco_id, msisdn, keyword, request, response, subscriber_id, api_user_ids
 * @return array
 */
	public function recordRequest($data) {
		$ApiUser = new ApiUser();
		if($data) {/*
			if($data["session_token"]=="") {
				$log = $ApiUser->api_response("501", "No session provided");
				return $log;
			}*/

			unset($data["id"]);
			/*
			if(!isset($data["telco_id"]) or $data["telco_id"]=="") {
				$log = $ApiUser->api_response("500", "No telco provided");
				return $log;
			}
			
			if(!isset($data["msisdn"]) or $data["msisdn"]=="") {
				$log = $ApiUser->api_response("500", "No msisdn provided");
				return $log;
			}
			
			if(!isset($data["keyword"]) or $data["keyword"]=="") {
				$log = $ApiUser->api_response("500", "No keyword provided");
				return $log;
			}
			
			if(!isset($data["request"]) or $data["request"]=="") {
				$log = $ApiUser->api_response("500", "No request provided");
				return $log;
			}
			
			if(!isset($data["response"]) or $data["response"]=="") {
				$log = $ApiUser->api_response("500", "No response provided");
				return $log;
			}
			
			if(!isset($data["subscriber_id"])) {
				$log = $ApiUser->api_response("500", "No subscriber_id provided");
				return $log;
			}
			
			if(!isset($data["api_user_id"]) or $data["api_user_id"]=="") {
				$log = $ApiUser->api_response("500", "No api_user_id provided");
				return $log;
			}
			*/

			$ip_address = $this->get_client_ip();
			$data["ip_address"] = $ip_address;

			$txn_id = $this->get_txn_id($data["keyword"]); //always generate the txn_id
			$data["txn_id"] = $txn_id;

			$data["timestamp"] = @DboSource::expression('NOW()'); //date("Y-m-d H:i:s"); use current_timestamp from mysql
			//unset($data["timestamp"]);
		
			if($data["session_token"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));
				
				if($isSessionValid["ApiUser"]["result_code"]=="200") {
					$this->create();
					if ($this->save($data,false)) {
						$log = array("ApiUser" => array("result_code" => "200", "message" => "Record saved"));


						$content = $this->id.' | '.((isset($data['telco_id'])) ? $data['telco_id'] : '')
						.' | '.((isset($data['subscriber_id'])) ? $data['subscriber_id'] : '')
						.' | '.((isset($data['msisdn'])) ? $data['msisdn'] : '')
						.' | '.((isset($data['mo_id'])) ? $data['mo_id'] : '')
						.' | '.((isset($data['msg_org_lnk_id'])) ? $data['msg_org_lnk_id'] : '')
						.' | '.((isset($data['mt_id'])) ? $data['mt_id'] : '')
						.' | '.((isset($data['api_user_id'])) ? $data['api_user_id'] : '')
						.' | '.((isset($data['txn_id'])) ? $data['txn_id'] : '')
						.' | '.((isset($data['ip_address'])) ? $data['ip_address'] : '')
						.' | '.((isset($data['keyword'])) ? $data['keyword'] : '')
						.' | '.((isset($data['request'])) ? $data['request'] : '')
						.' | '.((isset($data['response'])) ? $data['response'] : '')
						.' | '.date("Y-m-d H:i:s");


						$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'MT_MO.log', $content. PHP_EOL);



					} else {
						$log = array("ApiUser" => array("result_code" => "500", "message" => "Unable to save Record"));
					}

				} else {
					$log = $ApiUser->api_response("440", "Session Expired");
				}
			} else {
				$log = $ApiUser->api_response("400", "Session does not exist");
			}
		} else {
			$log = $ApiUser->api_response("500", "Unauthorised");
		}
		
		return $log;
	}
        
	public function get_client_ip() {
	     $ipaddress = '';
	     if (isset($_SERVER['HTTP_CLIENT_IP']))
	         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	     else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	     else if (isset($_SERVER['HTTP_X_FORWARDED']))
	         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	     else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
	         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	     else if (isset($_SERVER['HTTP_FORWARDED']))
	         $ipaddress = $_SERVER['HTTP_FORWARDED'];
	     else if (isset($_SERVER['REMOTE_ADDR']))
	         $ipaddress = $_SERVER['REMOTE_ADDR'];
	     else
	         $ipaddress = 'UNKNOWN';

	     return $ipaddress; 
	}
	
	public function get_txn_id($keyword) {
	     $txn_id = '';

	     // call api to get txn_id

		$curl = curl_init();
	
		$txn_url= Configure::read('live.txn_counter').$keyword;
		curl_setopt($curl, CURLOPT_URL, $txn_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$curl_result = curl_exec($curl);
		curl_close($curl);

		//$xmlArray = @Xml::toArray(Xml::build($curl_result));

		$piece = explode("txn_id>", $curl_result);
		
		$txn_id = substr($piece[1], 0, -2);

	    return $txn_id;
	}

	public function id_generator() {
		$unixtime = time();
		$random = rand(0,99999);

		unset($random_id);

		if ($random <= 9) {
			$random_id = strval($unixtime) . "0000" . strval($random);
		} else if ($random <= 99) {
			$random_id = strval($unixtime) . "000" . strval($random);
		} else if ($random <= 999) {
			$random_id = strval($unixtime) . "00" . strval($random);
		} else if ($random <= 9999) {
			$random_id = strval($unixtime) . "0" . strval($random);
		} else {
			$random_id = strval($unixtime) . strval($random);
		}

		return $random_id;
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

/**
 * listLog method
 * 
 * @param array => session_token, subscriber_id
 * @return array
 */
	public function listLog($query) {
		$ApiUser = new ApiUser();
		if($query) {
			if($query["session_token"]=="") {
				$logs = $ApiUser->api_response("501", "No session provided");
				return $logs;
			}
						
			if($query["session_token"]!="" and $query["subscriber_id"]!="") {
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$query["session_token"]));
			
				if($isSessionValid["ApiUser"]["result_code"]=="200") {
					
					$conditions = array("Log.subscriber_id" => $query["subscriber_id"]);
					$history = $this->find('all', array('conditions' => $conditions, "recursive" => -1));

					foreach ($history as $item) {
						$history_records["Log"][] = $item["Log"];
					}

					if (!isset($history_records)) $history_records = array();

					$logs = array('Logs' => $history_records);

				} else {
					$logs = $ApiUser->api_response("440", "Session Expired");
				}
			} else {
				$logs = $ApiUser->api_response("500", "No subscriber_id provided");
			}
			
		} else {
			$logs = $ApiUser->api_response("500", "Unauthorised");
		}
		return $logs;
	}
	
}
