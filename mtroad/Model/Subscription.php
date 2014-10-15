<?php
App::uses('AppModel', 'Model');
App::import('model','ApiUser');
App::import('model','Subscriber');
App::import('model','Log');
App::import('model','MoTbl');
App::import('model','MtTbl');
App::import('model','UserWhitelist');

/**
 * Subscription Model
 *
 * @property Member $Member
 */
class Subscription extends AppModel {
    
    
    
    
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
		'subscription_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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
		'subscription_start_date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'subscription_end_date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
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

        /*
        
	public function addHour($givendate,$hr=0){
	    $cd = strtotime($givendate);
    	$newdate = date('Y-m-d h:i:s', mktime(date('h',$cd)+$hr,
    	date('i',$cd), date('s',$cd), date('m',$cd),
    	date('d',$cd), date('Y',$cd)));
    	return $newdate;
	}
	*/
        
        
         /// keyword = current subscription keyword
        /// request = new request keyword
        /// expiry = result of the expiry test
        function testSubsLevel( $keyword, $request, $expiry )
        {
            ///test for already - user has an existing subs, and not expired
            //if ($curr_keyword != "ON PRW" && $curr_keyword != "ON BAW" && $curr_keyword != "" && !$this->isExpired($curr_expiry_date,date("Y-m-d H:i:s")))
            //$subscription = $ApiUser->api_response("333", "Subscription Not Allowed. current package: ".$curr_keyword." <16>"); //invalid: cannot downgrade

            $returntestSubs = 109; //uncaught error
            
            // test the subscription weights
            $keyweight = $this->testSubsWeight($keyword);
            $requestweight = $this->testSubsWeight($request);
           
            
            /// test for YOONIC, YNC EMPTY subscriptions
           if( $keyweight > 800 || $requestweight > 800)
           {
                // request is not YOONIC YNC TP1
                if( $keyweight > 800 && $requestweight < 800 && $requestweight != 1 && $expiry == 0)
                    $returntestSubs = 100; /// allowed subscription
                
                else if( $keyweight < 800 && $requestweight > 800 && $expiry == 0 )
                    $returntestSubs = 102; // not allowed
                
                else
                    $returntestSubs = 1999; /// completely failed
                
                //$returntestSubs = 1999;
           }
           
           else {
                
                    /// checks expiry
                    if( $expiry == 1 ) /// valid
                    {
                        /// same subscriptions level
                        if( $keyweight == $requestweight )
                            {
                                if( $keyweight == 40 || $keyweight == 50 ) // checks if it is BAW or PRW
                                    $returntestSubs = 101; // returns already error
                                    else
                                        $returntestSubs = 100;
                            }
                            
                            /// different level
                            else if( $keyweight != $requestweight )
                            {

                                if( $keyweight == 30 && $requestweight == 40 ) //PRD -> BAW
                                    $returntestSubs = 102; //allowed
                                    
                                else if( $keyweight == 30 && $requestweight == 31 ) //PRD->UPD
                                    $returntestSubs = 102;
                                
                                else if( $keyweight == 30 && $requestweight == 51 ) //PRD->UPW
                                    $returntestSubs = 102;
                                    
                                else if( $keyweight == 40 && $requestweight == 31 ) // BAW->UPD
                                    $returntestSubs = 102;
                                
                                else if( $keyweight == 40 && $requestweight == 30 ) // BAW->PRD
                                    $returntestSubs = 102;
                                
                                else if( $requestweight == 1 ) // allow all TP1 topup
                                    {
                                        if( $keyweight == 60 || $keyweight == 61 ) /// failed if YOONIC or YNC is base
                                            $returntestSubs = 102;
                                            else
                                            $returntestSubs = 100;    
                                    }
                                    
                                                                
                                else if( $keyweight > $requestweight )
                                    $returntestSubs = 102; // not allowed
                                
                                else if( $keyweight < $requestweight )
                                    $returntestSubs = 100; // allowed
                            }
                    }
                    
                    else if( $expiry == 0 )
                    {
                        ///expired subscription block
                        if( $requestweight == 1 )
                            $returntestSubs = 102;
                        
                        else if( $requestweight == 51 || $requestweight == 31 )
                            $returntestSubs = 102;
                        
                        else
                            $returntestSubs = 100;
                    }
                    
                    else /// completely failed
                    {
                        $returntestSubs = 1999;
                    }
                
            /// end of if else block
           }
            
           
           
           return $returntestSubs;
            
        }
        
         /// assign subscription weightage
        public function testSubsWeight( $subs_weight )
        {
            $subsWeight = 999; // uncaught error
            
            if( $subs_weight == "ON TP1" )
                $subsWeight = 1;
            
            if( $subs_weight == "ON BAD" )
                $subsWeight = 20;
            
            if( $subs_weight == "ON PRD")
                $subsWeight = 30;
            
            if( $subs_weight == "ON UPD" )
                $subsWeight = 31;
            
            if( $subs_weight == "ON BAW" )
                $subsWeight = 40;
            
            if( $subs_weight == "ON PRW" )
                $subsWeight = 50;
            
            if( $subs_weight == "ON UPW" )
                $subsWeight = 51;
                
            if( $subs_weight == "ON YOONIC" )
                $subsWeight = 60;
            
            if( $subs_weight == "ON YNC" )
                $subsWeight = 61;
            
            
            return $subsWeight;
        }
        
        
        public function checkExpiry( $expiry_date, $curr_date )
        {
            $returnExpiry = 999;  //unprocessed
            
            // test for null or 0
            if( $expiry_date != "" || $expiry_date != 0 && $curr_date != "" || $curr_date != 0 )
            {  
                $giventime = $this->convertUnixTime( $expiry_date );
                $currenttime = $this->convertUnixTime( $curr_date );
                
                $comparedtime = $giventime - $currenttime;
            
                if( $comparedtime > 0 ) 
                    $returnExpiry = 1; ///susbcription still valid
                else
                    $returnExpiry = 0; /// subcription expired
            }
            else
            {
                $returnExpiry = 0;
            }
            
            return $returnExpiry;
        }
        
        
        
        public function sendKeyword( $keycmd, $msisdn, $MT_ID, $MO_ID, $MO_LINK_ID, $extra_params)
        {
            $key_result = "";
            
            unset( $key_result );
            $sendKeyword = str_replace(' ', '+', $keycmd );
            $keycurl = curl_init();
            $target_endpoint = Configure::read(Configure::read('http.mode').'.smsc').'&keyword='.$sendKeyword.
                                '&MSISDN='.$msisdn.'&MT_id='.$MT_ID."&MO_id=".$MO_ID.
                                "&MessageOriginatingLinkID=".$MO_LINK_ID.$extra_params;
            curl_setopt($keycurl, CURLOPT_URL, $target_endpoint);
            curl_setopt($keycurl, CURLOPT_RETURNTRANSFER, true);
            
            $key_result = curl_exec($keycurl);
            curl_close($keycurl);
            
            $resultkey = (string)$key_result;
            
            return $resultkey;
        }
        
        
        public function sendPassword( $msisdnP, $userpass, $pass_MTID, $pass_MOID, $pass_MOLINKID )
        {
            $password_result = "";
            unset( $password_result );            
            $pass_curl = curl_init();
            
            $passgateway = Configure::read(Configure::read('http.mode').'.smsc').
                            '&keyword=YOONIC&MSISDN='.$msisdnP.
                            '&vcode='.$userpass.
                            '&MT_id='.$pass_MTID.
                            "&MO_id=".$pass_MOID.
                            "&MessageOriginatingLinkID=".$pass_MOLINKID;
                            
            curl_setopt($pass_curl, CURLOPT_URL, $passgateway);
            curl_setopt($pass_curl, CURLOPT_RETURNTRANSFER, true);
	    $password_result = curl_exec($pass_curl);
            curl_close( $pass_curl );
            
            $results_pass = (string)$password_result;
            
            return $results_pass;
            
        }
        
        
        public function updateMobile( $m_id, $subs_id, $m_startDate, $m_endDate, $m_airtime, $m_keyword )
        {
            /// write to mobile server
            $PARAM = array('id' => $m_id,
                            'subscriber_id' => $subs_id,
                            'subscription_start_date' => $m_startDate,
                            'subscription_end_date' => $m_endDate,
                            'airtime' => $m_airtime,
                            'keyword' => $m_keyword
                          );
    
            $mobile_endpoint = "http://maxis.ms.yoonic.tv/yoonic/index.php/subscriber/subscription";
            
            $curl_mobile = "";
            $curl_m = curl_init();
            unset( $curl_mobile );
            
            curl_setopt($curl_m, CURLOPT_URL, $mobile_endpoint);
            curl_setopt($curl_m, CURLOPT_POST, 1);
            curl_setopt($curl_m, CURLOPT_POSTFIELDS, $PARAM);
            curl_setopt($curl_m, CURLOPT_RETURNTRANSFER, true);
            
            $curl_mobile = curl_exec( $curl_m );
            curl_close( $curl_m );
            
            $mobile_results = (string)$curl_mobile;
            
            return $mobile_results;
            
        }
        
        
  
        
        function addHour($givendate, $hr)
        {
            ///   delta * 60secs * 60mins = total hrs
            $deltatime = 60 * (60 * $hr);     
        
           list($date, $time) = explode(' ', $givendate);
           list($year, $month, $day) = explode('-', $date);
           list($hour, $minute, $second) = explode(':', $time);
       
           $rawtime = mktime($hour, $minute, $second, $month, $day, $year);
           $newUnixtime = $rawtime + $deltatime;
           
           $newtime = date("Y-m-d H:i:s", $newUnixtime);
           
           return $newtime;
             
        
        }
        
        
        function getairtime( $mode )
        {
            $airtime = 0;
            
            if( $mode == "daily" || $mode == "dailyUPD")
                $airtime = 3600;
            else if( $mode == "weeklyUPW" )
                $airtime = 10800;
            else if( $mode == "weekly" || $mode =="topup" || $mode ==="dailypremium" )
                $airtime = 7200;                     
            else if( $mode == "weeklypremium" )
                $airtime = 18000;
            else
                $airtime = 0;            
            
            return $airtime;
        }
        
        
        function IsNullOrEmptyString($question)
        {
            return ("0" || trim($question)==='');
        }
        
        
        
        function runDel( $subids )
        {
            $subscriber_id = $subids;
            $subs_start_date = "0000-00-00 00:00:00";
            $subs_end_date = "0000-00-00 00:00:00";
            $keyword_del = "STOP ALL";
            $airtime = 0;

            $KW_del = "";
            
            $PARAM = array('id' => 3,
			    'subscriber_id' => $subscriber_id,
                            'subscription_start_date' => $subs_start_date,
                            'subscription_end_date' => $subs_end_date,
                            'airtime' => $airtime,
                            'keyword' => $keyword_del
			);
            $mobileserverurl= "http://maxis.ms.yoonic.tv/yoonic/index.php/subscriber/subscription";
            
            /// update mobile server
            $curl_delResult = $this->updateMobile( $this->id, $subscriber_id, $subs_start_date, $subs_end_date, $airtime, $keyword_del );
                    
                if (isset($curl_delResult)) { //PHPGateway returns a response
		    unset($KW_result);
                    $KW_result = $curl_delResult;
		} else { // CURL fails
                    	$KW_result = null;
		}	


		//$subscription = $ApiUser->api_response("200", "Subscription saved. Mobile Server response = ".$KW_del);
		$PARAM['request'] = $mobileserverurl . serialize($PARAM);
		$PARAM['response'] = $subscription["ApiUser"]["message"];
		$PARAM['session_token'] = $data['session_token'];
		unset($PARAM["id"]);
		$log = $Log->recordRequest($PARAM); //save to log
        }
	
/**
 * getAllSubscriptions method
 * 
 * @param array => session_token, telco_id, subscriber_id
 * @return array
 */
	public function getAllSubscriptions($query) {
		$ApiUser = new ApiUser();
		$Subscriber = new Subscriber();
		if($query) {
			if($query["session_token"]=="") $subscriptions = $ApiUser->api_response("500", "No session provided");			
			if(!isset($query["telco_id"]) or $query["telco_id"]=="") $subscriptions = $ApiUser->api_response("500", "No telco provided");			
			if(!isset($query["subscriber_id"]) or $query["subscriber_id"]=="") {
				$subscriptions = $ApiUser->api_response("500", "No subscriber ID provided");
			} else {
				if (!$Subscriber->isActive($query["subscriber_id"])) $subscriptions = $ApiUser->api_response("500", "Subscriber is inactive");
			}

			if (isset($subscriptions)) return $subscriptions; //exit subscriptions/getAllSubscription function if there are error up to this point			
			
			$isSessionValid = $ApiUser->check_session(array("session_token"=>$query["session_token"]));
			
			if($isSessionValid["ApiUser"]["result_code"]=="200") {
				$this->updateActiveSubscription($query); //check if subscription is still active
				$conditions = array("Subscription.telco_id" => $query["telco_id"], "Subscription.subscriber_id" => $query["subscriber_id"]);
				if(array_key_exists("page", $query)) {
					$subs = $this->find('all', array('conditions' => $conditions, "limit" => "50", "page" => $query["page"], 'recursive' => -1));
				} else {$subs = $this->find('all', array('conditions' => $conditions, 'recursive' => -1));}
				if($subs>0) {
					$subscriptions = array("Subscriptions" => array("item" => $subs));
				} else {$subscriptions = array("Subscriptions" => array("result_code"=>"500", "message" => "Subscriptions does not exist for this telco"));}
			} else {$subscriptions = $ApiUser->api_response("440", "Session Expired");}			
		} else {$subscriptions = $ApiUser->api_response("403", "Unauthorised");}
		return $subscriptions;
	}

	public function isExpired($expiry_date,$curr_date) {
		$expiry_date_value = new DateTime($expiry_date);
		$curr_date_value = new DateTime($curr_date);
		return $curr_date_value > $expiry_date_value;
	}
        
        
        public function convertUnixTime( $timeconvert )
        {
            list($date2, $time2) = explode(' ', $timeconvert );
            list($year2, $month2, $day2) = explode('-', $date2);
            list($hour2, $minute2, $second2) = explode(':', $time2);
       
            $unixtime = mktime($hour2, $minute2, $second2, $month2, $day2, $year2);
            
            return $unixtime;
        }
        
        
        ///decide which new expiry dates to be set
        function getnewExpiryDate( $newexpiry_date, $systemTime)//, $timeOffset )
        {
            $returnNewExpiry="";  //unprocessed
            
            
            if( $newexpiry_date == "" || $newexpiry_date == 0 )
            {
                $newDates = $systemTime;
            }
            else
            {
                $expiryDateTest = $this->checkExpiry( $newexpiry_date, $systemTime );
                //$expiryDateTest = checkExpiry( $newexpiry_date, $systemTime );
                if( $expiryDateTest == 1 )
                {
                    $newDates = $newexpiry_date;
                }
                else
                {
                    $newDates = $systemTime;
                }
            }
            
            $returnNewExpiry = $newDates;
            
            //$returnNewExpiry = $this->addHour( $newDates, $timeOffset );
            //$returnNewExpiry = addHour( $newDates, $timeOffset );
            
            return $returnNewExpiry;
            
        }
        
        

	public function getExpiredSubscriptions($query) {
		$ApiUser = new ApiUser();
		if($query) {
			
                        if($query["session_token"]=="")
                            $subscriptions = $ApiUser->api_response("500", "No session provided");
			
                        if(!isset($query["telco_id"]) or $query["telco_id"]=="")
                            $subscriptions = $ApiUser->api_response("500", "No telco provided");				
			
                        if (isset($subscriptions))
                            return $subscriptions; //exit subscriptions/getExpiredSubscription function if there are error up to this point	

			$expiry_date = 	date("Y-m-d H:i:s");
			if(array_key_exists("expiry_date", $query)) $expiry_date = $query["expiry_date"];

			$limit = 50;
			if(array_key_exists("limit", $query)) $limit = $query["limit"];
			$isSessionValid = $ApiUser->check_session(array("session_token"=>$query["session_token"]));
			
			if($isSessionValid["ApiUser"]["result_code"]=="200") {					
				$this->updateActiveSubscription($query); //check if subscription is still active					
				$conditions = array("Subscription.telco_id" => $query["telco_id"], "Subscription.subscription_end_date <" => $expiry_date);
				$subs = $this->find('all', array('conditions' => $conditions, "limit" => $limit, "recursive" => -1));
				if($subs>0) {
					$subscriptions = array("Subscriptions" => array("item" => $subs));
				} else {$subscriptions = array("Subscriptions" => array("result_code"=>"500", "message" => "Subscriptions does not exist for this telco"));}
			} else {$subscriptions = $ApiUser->api_response("440", "Session Expired");}			
		} else {$subscriptions = $ApiUser->api_response("500", "Unauthorised");}
		return $subscriptions;
	}	
	
/**
 * getSubscriptons method
 * @param array $query => session_token, telco_id, subscriber_id, subscription_id
 * @return array $subscriptions
 */
	public function getSubscription($query) {
		$ApiUser = new ApiUser();
		$Subscriber = new Subscriber();
		if($query) {
			if($query["session_token"]=="") $subscriptions = $ApiUser->api_response("500", "No session provided");
			if(!isset($query["telco_id"]) or $query["telco_id"]=="") $subscriptions = $ApiUser->api_response("500", "No telco provided");
			if(!isset($query["id"]) or $query["id"]=="") $subscription = $ApiUser->api_response("500", "No Subscription ID provided");
			if(!isset($query["subscriber_id"]) or $query["subscriber_id"]=="") {
				$subscriptions = $ApiUser->api_response("500", "No subscriber ID provided");
			} else {
				if (!$Subscriber->isActive($query["subscriber_id"])) $subscriptions = $ApiUser->api_response("500", "Subscriber is inactive");
			}
							
			if (isset($subscriptions)) return $subscriptions; //exit subscriptions/getSubscription function if there are error up to this point	

			$isSessionValid = $ApiUser->check_session(array("session_token"=>$query["session_token"]));
					
			if($isSessionValid["ApiUser"]["result_code"]=="200") {
				$conditions = array("Subscription.id" => $query["id"]);
				if(array_key_exists("page", $query)) {
					$subs = $this->find('all', array('conditions' => $conditions, "limit" => "50", "page" => $query["page"], 'recursive' => -1));
				} else {$subs = $this->find('all', array('conditions' => $conditions, 'recursive' => -1));}

				if($subs>0) {
					$subscriptions = array("Subscriptions" => array("item" => $subs));
				} else {$subscriptions = array("Subscriptions" => array("result_code"=>"500", "message" => "Subscriptions does not exist for this telco"));}
			} else {$subscriptions = $ApiUser->api_response("440", "Session Expired");}
		} else {$subscriptions = $ApiUser->api_response("500", "Unauthorised");}
		return $subscriptions;
	}
	
/**
 * registerSubscription method
 * 
 * @param array $data => session_token, telco_id, msisdn/subscriber_id, keyword
 * @return array 
 */
	public function registerSubscription($data) {
		$ApiUser = new ApiUser();
		$Subscriber = new Subscriber();
		$Log = new Log();
		//$Subscriber = new Subscriber();
		$new_subscriber_flag = 0;
                $MoTbl = new MoTbl();
                $MtTbl = new MtTbl();
                
                
                
                
		unset($subscription);
		
                //constants
                $weekhr = 168;
                $dayhr = 24;
                $topups = 2;
                $daily_reqfreq = "daily";
                $weekly_reqfreq = "weekly";
                $monthly_reqfreq = "monthly";
                $daily_reqfreq_pr = "dailypremium";
                $weekly_reqfreq_pr = "weeklypremium";
                $daily_upg = "dailyUPD";
                $weekly_upg = "weeklyUPW";
                $topups_req = "topup";
                $none_reqfreq = "none";
                
                $subs_test = 0;
                
                
                //$log = $Log->recordRequest($data); //saving to log
                //$log = $Log->recordRaw($data);
                
                
               //$tfx = $MtTbl->findByMtId( "140852721011504" );//$Log->findByMtId( "140852721011504" );
               //$tsnd = $tfx["MtTbl"]["msisdn"];
               //$Log->updateLog( "test.log" ,  $tsnd );
                
                
                
                
                                
                /// write to the MO log table
                $txnID = 0;
                $apiuserID = 0;
                $mo_id2 = 555;
                $msg_org_lnk_id2 = 554;
                
                if(!isset($data["subscriber_id"]) or $data["subscriber_id"]=="")
                    $subscriber_id = 0;
                
                $mo_id = 000;
                $msg_org_lnk_id = 000;
                
                ///generate the MO_id                
                if (!isset($data["mo_id"]) || empty($data["mo_id"])) {//mo_id should be provided from PHPGateway if not this is an Mobile server request #WARNING mo_id can be set to empty and this will be assumed to be from PHPGATEWAY
                    
		    $data["msg_org_lnk_id"] = $Log->id_generator();
                    $msg_org_lnk_id = $data["msg_org_lnk_id"];
		} else {
			$mo_id = $data["mo_id"];
			
			}
                
                /// MO log will be written regardless
                $mo_add = $MoTbl->addMO( $data["telco_id"],
                                         $subscriber_id,
                                         $data["msisdn"],
                                         $mo_id,
                                         $msg_org_lnk_id,
                                         $apiuserID,
                                         $txnID,
                                         $data["keyword"],
                                         0,
                                         0 );
                
                                       //$telcoId, $subscriberId, $msisdn, $moId, $moLinkId, $apiUserId, $txnId, $keyword, $request, $response
                
                
                
		if($data) { //if post data is set
			if(array_key_exists("session_token", $data)) { //session token provided
				if($data["session_token"]=="") $subscription = $ApiUser->api_response("500", "No session provided <1>"); // session token is empty
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));
				if($isSessionValid["ApiUser"]["result_code"]!="200") $subscription = $ApiUser->api_response("403", "Unauthorised <2>");  // if session token is invalid
			} else { $subscription = $ApiUser->api_response("500", "No session provided <3>");} //session token not provided
		
			if(!isset($data["telco_id"]) or $data["telco_id"]=="") $subscription = $ApiUser->api_response("500", "No telco provided <4>"); //telco_id not provided

			if(!isset($data["msisdn"]) or $data["msisdn"]=="")
                        { //No MSISDN is provided
				if(!isset($data["subscriber_id"]) or $data["subscriber_id"]=="") { //NO subscriber_id provided
					$subscription = $ApiUser->api_response("500", "No subscriber ID/msisdn provided <5>");
				} else {
					unset($result);
					$result = $Subscriber->find("first", array("conditions" => array('Subscriber.id' => $data["subscriber_id"]), 'recursive' => -1));
					if ($result)
                                        { // subscriber_id is valid
						$data["old_passwd"] = $result['Subscriber']["password"];
						$data["msisdn"] = $result['Subscriber']["msisdn"];
						if (!$Subscriber->isActive($data["subscriber_id"])) {// subscriber is inactive
							if (isset($data["keyword"]) && ($data["keyword"] == "YNC" || $data["keyword"] == "YOONIC")) {
								$Subscriber->id = $data["subscriber_id"];
								$Subscriber->status = "active";
								if ($Subscriber->saveField("status","active")) {
									// Activate Subscriber
								} else {
									$subscription = $ApiUser->api_response("500", "Unable to activate Subscriber <6>");
								}
							} else {
								$subscription = $ApiUser->api_response("500", "Subscriber is inactive <7>");
							}
						}
					} else {
						$subscription = $ApiUser->api_response("500", "No matching msisdn for subscriber ID provided <8>");
					}
				}
			}

			if(!isset($data["subscriber_id"]) or $data["subscriber_id"]=="")
                        {	//No subscriber_id provided
				if(!isset($data["msisdn"]) or $data["msisdn"]=="") { //NO MSISDN provided
					$subscription = $ApiUser->api_response("500", "No subscriber ID/msisdn provided <9>");
				} else {
					unset($result);
					$result = $Subscriber->find("first",array("conditions" => array('Subscriber.msisdn' => $data["msisdn"]), 'recursive' => -1));
					if ($result) {	//Supplied MSISDN is already a registered subscriber
						$data["old_passwd"] = $result['Subscriber']["password"];
						$data["subscriber_id"] = $result['Subscriber']["id"];
						if (!$Subscriber->isActive($data["subscriber_id"]))
                                                {// subscriber is inactive
							if (isset($data["keyword"]) && ($data["keyword"] == "YNC" || $data["keyword"] == "YOONIC")) {
								$Subscriber->id = $data["subscriber_id"];
								$Subscriber->status = "active";
								if ($Subscriber->saveField("status","active")) {
									// Activate Subscriber
								} else {
									$subscription = $ApiUser->api_response("500", "Unable to activate Subscriber <10>");
								}
							} else {
								$subscription = $ApiUser->api_response("500", "Subscriber is inactive <11>");
							}
						}
					} else {$new_subscriber_flag = 1;} //msisdn not found in Subscribers Table means user is new, set new_subscriber_flag = 1
				}
			}

			if (isset($data["msisdn"]) && isset($data["subscriber_id"])) {
				unset($result);
				$result = $Subscriber->find("first", array("conditions" => array('Subscriber.id' => $data["subscriber_id"], 'Subscriber.msisdn' => $data["msisdn"]), 'recursive' => -1));
				if ($result) {
					if (!$Subscriber->isActive($data["subscriber_id"])){// subscriber is inactive
						if (isset($data["keyword"]) && ($data["keyword"] == "YNC" || $data["keyword"] == "YOONIC")) {
							$Subscriber->id = $data["subscriber_id"];
							$Subscriber->status = "active";
							if ($Subscriber->saveField("status","active")) {
								// Activate Subscriber
							} else {
								$subscription = $ApiUser->api_response("500", "Unable to activate Subscriber <39>");
							}
						} else {
							$subscription = $ApiUser->api_response("500", "Subscriber is inactive <40>");
						}
					}
				} else {
					$subscription = $ApiUser->api_response("500", "MSISDN and Subscriber Id do not match <41>");
				}
			}
			
			if (isset($subscription)) return $subscription; //exit subscriptions/registerSubscription function if there are error up to this point

			$curr_keyword = "";
			$curr_status = "";
			$operative = "";
			$descriptor = "";
			$curr_subscription_id = 0;
				
			$SessionToken = new SessionToken();
			$session_token = $SessionToken->findBySessionToken($data["session_token"]);		
			$api_user_id = $session_token["SessionToken"]["api_user_id"]; 
			$data["api_user_id"] = $api_user_id;
			$data["modified_by"] = $session_token["SessionToken"]["api_user_id"];
			$data["date_created"] = date("Y-m-d H:i:s");
			$data["date_modified"] = date("Y-m-d H:i:s");

			if(!isset($data["keyword"]) or $data["keyword"]=="")
                        { //No Keyword provided
				$subscription = $ApiUser->api_response("500", "No keyword provided <12>");
			}
                        
                        else
                        {
				$curr_subscription = false; //default to no subscription
                                
                                ///shum - set the date to latest system time as means of initialization, workaround the null var issue
                                $curr_expiry_date = date("Y-m-d H:i:s", strtotime("+0 day"));
                                
                                
				if ($new_subscriber_flag == 0)
                                {//perform search only if it is an existing subscriber
					$conditions = array("Subscription.telco_id"=>$data["telco_id"], "Subscription.subscriber_id"=>$data["subscriber_id"], "Subscription.keyword !="=>"ON TP1");
					$curr_subscription = $this->find("first",array('conditions' => $conditions, 'recursive' => -1));
				}
                                
				if($curr_subscription)
                                {
					$curr_keyword = $curr_subscription["Subscription"]["keyword"]; // current existing subscription keyword
					$curr_expiry_date = $curr_subscription["Subscription"]["subscription_end_date"];
					$curr_status = $curr_subscription["Subscription"]["status"];
					$curr_subscription_id = $curr_subscription["Subscription"]["id"];					
					$existing_keyword = $curr_subscription["Subscription"]["keyword"];
					$existing_subscription_start_date = $curr_subscription["Subscription"]["subscription_start_date"];
					$existing_subscription_end_date = $curr_subscription["Subscription"]["subscription_end_date"];
					$existing_airtime = $curr_subscription["Subscription"]["airtime"];					
				}
                                
                                

				$keyword_old = $data["keyword"]; //requested keyword
				$piece = explode(' ', $data["keyword"]);
				$operative = $piece[0];
				$descriptor = (count($piece) > 1) ? $piece[1]: '';
				$delete_flag = 0;
				$other_flag = 0;
				$extra_parameter = "";
				unset($data["id"]); //make sure there isn't any subscription id provided

				$data["subscription_start_date"] = date("Y-m-d H:i:s");
                                $data["recurring"] = 1;
                                $newSubs_start_date = $this->getnewExpiryDate( $curr_expiry_date, date("Y-m-d H:i:s") ); //$data["subscription_start_date"];
				
                               
				if ($operative == "ON")
                                {
                                    
                                    /// check for expiry first
                                    $expiry_result = $this->checkExpiry($curr_expiry_date, date("Y-m-d H:i:s") );
                                    
                                    /// test for existing subscription level
                                    $subs_test = $this->testSubsLevel( $curr_keyword , $keyword_old, $expiry_result );
                                    
                                    /// grab the request subscription weight
                                    $new_keyword_subs = $this->testSubsWeight( $curr_keyword );
                                    
                                    
                                    if( $subs_test == 100 )
                                    {
                                        /// success
                                        if( $descriptor == "BAD" )
                                        {
                                              $curr_expiry_date = $this->addHour($newSubs_start_date, $dayhr);
                                                $data["subscription_end_date"] = $curr_expiry_date;                                            
						$data["recurring_frequency"] = $daily_reqfreq;
                                                $data["airtime"] = $this->getairtime( $daily_reqfreq );
						//$data["airtime"] = '3600';
                                                
                                        } else if( $descriptor == "PRD" )
                                            {
                                                $curr_expiry_date = $this->addHour($newSubs_start_date, $dayhr);
                                                $data["subscription_end_date"] = $curr_expiry_date;
                                                //$data["subscription_end_date"] = date("Y-m-d H:i:s", strtotime("+1 day"));
						$data["recurring_frequency"] = $daily_reqfreq;
						$data["airtime"] = $this->getairtime($daily_reqfreq_pr);//'7200';
                                                
                                            } else if( $descriptor == "BAW" )
                                                {
                                                    $curr_expiry_date = $this->addHour($newSubs_start_date, $weekhr);
                                                    $data["subscription_end_date"] = $curr_expiry_date;                                                
                                                    $data["recurring_frequency"] = $weekly_reqfreq;
                                                    $data["airtime"] = $this->getairtime($weekly_reqfreq);
                                                    //'7200';
                                                
                                                } else if( $descriptor == "PRW" || $descriptor == "ALL" )
                                                    {
                                                        $curr_expiry_date = $this->addHour($newSubs_start_date, $weekhr);
                                                        $data["subscription_end_date"] = $curr_expiry_date;                                                        
                                                        $data["recurring_frequency"] = $weekly_reqfreq;
                                                        $data["airtime"] = $this->getairtime($weekly_reqfreq_pr);
                                                        //'18000';
                                                        
                                                    } else if( $descriptor == "TP1" )
                                                        {
                                                            $data["keyword"] = "ON TP1"; //prefix it with "ON"
                                                            $data["subscription_end_date"] = $this->addHour($newSubs_start_date, $topups );
                                                            $data["recurring"] =  0;
                                                            $data["recurring_frequency"] = $none_reqfreq;
                                                            $data["airtime"] = $this->getairtime($topups_req); //'7200';
                                                            
                                                        } else if( $descriptor == "UPD" )
                                                            {
                                                                $curr_expiry_date = $this->addHour($newSubs_start_date, $dayhr);
                                                                $data["subscription_end_date"] = $curr_expiry_date;
                                                                //$data["subscription_end_date"] = date("Y-m-d H:i:s", strtotime("+1 day"));
                                                                $data["recurring_frequency"] = $daily_reqfreq;
                                                                $data["airtime"] = $this->getairtime( $daily_upg );//'7200';
                                                                $data["keyword"] = "ON PRD"; //prefix it with "ON"
                                                                $keyword_old = "ON UPD";
                                                                $extra_parameter = "&expiry_date=".$data["subscription_end_date"];
                                                
                                                            } else if( $descriptor == "UPW" )
                                                                {
                                                                    $curr_expiry_date = $this->addHour($newSubs_start_date, $weekhr);
                                                                    $data["subscription_end_date"] = $curr_expiry_date;
                                                                    //$data["subscription_end_date"] = date("Y-m-d H:i:s", strtotime("+1 week"));
                                                                    $data["recurring_frequency"] = $weekly_reqfreq;
                                                                    $data["airtime"] = $this->getairtime( $weekly_upg );//'18000';
                                                                    $data["keyword"] = "ON PRW"; //prefix it with "ON"
                                                                    $keyword_old = "ON UPW";
                                                                    $extra_parameter = "&expiry_date=".$data["subscription_end_date"];
                                                                    
                                                                }
                                                        
                                                        else
                                                            {
                                                                 /// set the data block to invalid
                                                                $keyword_old = "INVALID";
                                                                $data["keyword"] = $curr_keyword;
                                                                //$data["keyword"] = $keyword_old;
                                                                $data["subscription_end_date"] = $curr_expiry_date;
                                                                $data["recurring"] =  0;
                                                                $data["recurring_frequency"] = $none_reqfreq;
                                                                $data["airtime"] = $this->getairtime("none"); //'7200';
                                                                $subscription = $ApiUser->api_response("360", "Error in charge transaction <13a>"); 
                                                            }
                                        
                                        
                                    }else if( $subs_test == 101 )
                                        {
                                            /// already error
                                            //$funtest = "ALREADY ". $descriptor;
                                            //$subscription = $ApiUser->api_response("350", "Subscription already on current package: ".$curr_keyword. " " . $keyword_old . $funtest." <350>.");
                                            
                                            /// set the data block to already
                                            //$curr_keyword = "ALREADY ".$descriptor;
                                            $keyword_old = "ALREADY ".$descriptor;
                                            $data["keyword"] = $curr_keyword; ///retain the current keyword
                                            $data["subscription_end_date"] = $curr_expiry_date;
                                            $data["recurring"] =  0;
                                            $data["recurring_frequency"] = $none_reqfreq;
                                            $data["airtime"] = $this->getairtime("none"); //'7200';
                                            
                                            
                                        }else if( $subs_test == 102 )
                                            {
                                                //invalid: cannot downgrade
                                                //
                                                
                                                /// set the data block to invalid
                                                $keyword_old = "INVALID";
                                                //$data["keyword"] = $keyword_old;
                                                $data["subscription_end_date"] = $curr_expiry_date;
                                                $data["recurring"] =  0;
                                                $data["recurring_frequency"] = $none_reqfreq;
                                                $data["airtime"] = $this->getairtime("none"); //'7200';
                                                //$subscription = $ApiUser->api_response("351", "Subscription Not Allowed. current package: ".$curr_keyword. " " . $keyword_old . " <13>");
                                                
                                                
                                            }else if( $subs_test == 106 )
                                                {
                                                    /// yoonic ync stuff
                                                    //invalid: cannot downgrade
                                                    /// set the data block to invalid
                                                    $keyword_old = "INVALID";
                                                    //$data["keyword"] = $keyword_old;
                                                    $data["subscription_end_date"] = $curr_expiry_date;
                                                    $data["recurring"] =  0;
                                                    $data["recurring_frequency"] = $none_reqfreq;
                                                    $data["airtime"] = $this->getairtime("none"); //'7200';
                                                    //$subscription = $ApiUser->api_response("352", "Wrong keyword used: ".$curr_keyword. " " . $keyword_old . " <14>"); 
                                                    
                                                } else
                                                    {
                                                        /// uncaught all
                                                        /// set the data block to already
                                                        $keyword_old = "INVALID";
                                                        //$data["keyword"] = $keyword_old;
                                                        $data["subscription_end_date"] = $curr_expiry_date;
                                                        $data["recurring"] =  0;
                                                        $data["recurring_frequency"] = $none_reqfreq;
                                                        $data["airtime"] = $this->getairtime("none"); //'7200';
                                                        //$subscription = $ApiUser->api_response("359", "Error in charge transaction <13>, Error code" . $subs_test ); 
                                                    }
                                                

					//exit subscriptions/registerSubscription function if there are error up to this point
					if (isset($subscription)) return $subscription; 
					$extra_parameter = "&expiry_date=".$data["subscription_end_date"];

				/// end of operator "ON"
                                } else if ($operative == "OFF" || $operative == "STOP" || $operative == "BATAL")
                                    { //Stop Subscription
					//if ($descriptor != "BAD" && $descriptor != "BAW" && $descriptor != "PRD" && $descriptor != "PRW" && $descriptor != "ALL" && $descriptor != "YOONIC") $subscription = $ApiUser->api_response("500", "Wrong keyword provided <26>"); //wrong Keyword
					
                                        //change the subscriptions to ALL
                                        if( $descriptor == "SEMUA")
                                            $descriptor = "ALL";
                                        
                                        //if ($curr_keyword != "ON ".$descriptor && $descriptor != "ALL" &&  $descriptor != "SEMUA" &&  $descriptor != "YOONIC")
                                         //   $subscription = $ApiUser->api_response("500", "Wrong keyword(descriptor) provided <30>"); //wrong Keyword
				          
                                        if ( $descriptor == "YNC" )
                                               $subscription = $ApiUser->api_response("500", "Wrong keyword(descriptor) provided <30a>"); //wrong Keyword                             
                                                                                
                                        if ($new_subscriber_flag == 1 || !$curr_subscription)
                                            $subscription = $ApiUser->api_response("500", "Not a valid operation <31>");
					
                                        $data["keyword"] = "STOP ".$descriptor; //formating Keyword to PHPGateway
					$delete_flag = 1; //delete_flag is set to 1, signal to remove existing subscription entry
                                        /*} else if ($operative == "BATAL") {
					if ($descriptor != "" && $descriptor != "SEMUA") $subscription = $ApiUser->api_response("500", "Wrong keyword provided <28>");// wrong keyword
					if ($new_subscriber_flag == 1 || !$curr_subscription) $subscription = $ApiUser->api_response("500", "Not a valid operation <29>");
					$data["keyword"] = "STOP ALL"; //formatting keyword to PHPGateway
					$delete_flag = 1; //delete_flag is set to 1, signal to remove existing subscription entry*/
                                    }
                                else if ($operative == "YNC" || $operative == "HELP" || $operative == "YOONIC")
                                {
					if ($operative == "YOONIC") { 
						$data["keyword"] = "YOONIC";
						if ($new_subscriber_flag == 0) {
							$subscription = $ApiUser->api_response("500","Subscriber Profile exists for this MSISDN");
						} else {
							$extra_parameter = "&vcode=".$Subscriber->generatePassword();
						}
					}
					if ($operative == "YNC") {
						$data["keyword"] = "YNC";
						if ($new_subscriber_flag == 1) {
							$subscription = $ApiUser->api_response("500","Subscriber Profile does not exist, unable to recover password");
						} else {
							$extra_parameter = "&vcode=".$data["old_passwd"];
						}
					}
					// forward the request to Payment Gateway
					// record the request in Log and skip
					$other_flag = 1; //other_flag is set to 1, signal that either "HELP", "YNC" or "YOONIC" keyword is supplied
				}
                                else
                                    {$subscription = $ApiUser->api_response("500", "Wrong keyword provided <32>");} //wrong password
			}
			
			if (isset($subscription)) return $subscription; //exit subscriptions/registerSubscription function if there are error up to this point
			
			/*****************************/
			/* CREATING A NEW SUBSCRIBER */
			/*****************************/
			unset($KW_result1);
			if ($new_subscriber_flag == 1) { //register for a new user
				$data["mt_id"] = $Log->id_generator(); //Generate new MT_id to be send to PHPGateway
				//unset($curl_result);
				//$curl = curl_init();

                                /*
				///generate the MO_id                
                                if (!isset($data["mo_id"]) || empty($data["mo_id"])) {//mo_id should be provided from PHPGateway if not this is an Mobile server request #WARNING mo_id can be set to empty and this will be assumed to be from PHPGATEWAY
					$mo_id = "";
					$data["msg_org_lnk_id"] = $Log->id_generator();
					$msg_org_lnk_id = $data["msg_org_lnk_id"];
				} else {
					$mo_id = $data["mo_id"];
					$msg_org_lnk_id ="";
				}
				*/

				$Subscriber = new Subscriber();
				$data["password"] = $Subscriber->generatePassword(); //Generate new password
				/*  Send Password to new subscriber MSISDN */
				/*$gatewayurl= Configure::read(Configure::read('http.mode').'.smsc').'&keyword=YOONIC&MSISDN='.$data["msisdn"].'&vcode='.$data["password"].'&MT_id='.$data["mt_id"]."&MO_id=".$mo_id."&MessageOriginatingLinkID=".$msg_org_lnk_id;
				curl_setopt($curl, CURLOPT_URL, $gatewayurl);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				$curl_result = curl_exec($curl);
				curl_close($curl);
				*/
                                
                                $curl_result = $this->sendPassword( $data["msisdn"], $data["password"], $data["mt_id"], $mo_id, $msg_org_lnk_id);
                                
                                $gatewayurl= Configure::read(Configure::read('http.mode').'.smsc').'&keyword=YOONIC&MSISDN='.$data["msisdn"].'&vcode='.$data["password"].'&MT_id='.$data["mt_id"]."&MO_id=".$mo_id."&MessageOriginatingLinkID=".$msg_org_lnk_id;
                                
                                
                                if (isset($curl_result)) { //PHPGate returns a response
					$KW_result1 = (string)$curl_result;
				} else { //CURL fails 
					$KW_result1 = null;
				}
				
				/* Logs Table
				+----------------+------------------+------+-----+-------------------+-----------------------------+
				| Field          | Type             | Null | Key | Default           | Extra                       |
				+----------------+------------------+------+-----+-------------------+-----------------------------+
				| id             | int(11) unsigned | NO   | PRI | NULL              | auto_increment              | Auto generated
				| telco_id       | int(11) unsigned | NO   |     | NULL              |                             | Provided
				| subscriber_id  | int(11) unsigned | NO   |     | NULL              |                             | To be Generated by Saving
				| msisdn         | varchar(255)     | NO   |     | NULL              |                             | Provided
				| mo_id          | varchar(255)     | NO   |     | NULL              |                             | Provided by PHPGateway
				| msg_org_lnk_id | varchar(255)     | NO   |     | NULL              |                             | To be generated if Callee is Mobile Server
				| mt_id          | varchar(255)     | NO   |     | NULL              |                             | To be generated
				| api_user_id    | int(11) unsigned | NO   |     | NULL              |                             | Retrieve from session token table (see above)
				| txn_id         | varchar(255)     | NO   |     | NULL              |                             | To be generated by $Log->recordRequest()
				| ip_address     | varchar(255)     | NO   |     | NULL              |                             | To be retrieved by $Log->recordRequest() 
				| keyword        | varchar(255)     | NO   |     | NULL              |                             | Provided
				| request        | text             | NO   |     | NULL              |                             | To be retrieved
				| response       | text             | NO   |     | NULL              |                             | To be retrieved
				| timestamp      | timestamp        | NO   |     | CURRENT_TIMESTAMP | on update CURRENT_TIMESTAMP | Auto generated
				+----------------+------------------+------+-----+-------------------+-----------------------------+
				*/
                                
                                
                                


				//if ($data["keyword"] != "YOONIC") $data["request"] = $gatewayurl; // do not use the original request if creating new subscriber is not the intention
				if ($KW_result1 === "0") {	//successful in sending password to new subscriber
					$data["status"] = "active"; //set new subscriber status to active
					$data["incomplete"] = 1; //set the subscriber registration to incomplete
					if ($Subscriber->save($data)) { //if saving new subscriber is successful
						//successful allow the charge request to go through
						$data["subscriber_id"] = $Subscriber->id;
						$data["msg_org_lnk_id"] = ""; //mo_id should be provided from PHPGateway
						if ($data["keyword"] == "YOONIC") $subscription = $ApiUser->api_response("200", "Subscriber registration successful."); //Create an exit point if it is an new subscriber and keyword is also "YOONIC"
						$data["response"] = $KW_result1."+ Subscriber registration successful."; 
					} else { 	//if saving new subscriber is not successful
						$data["subscriber_id"] = 0;
						$data["msg_org_lnk_id"] = ""; //mo_id should be provided from PHPGateway
						$subscription = $ApiUser->api_response("500", "Subscription cannot be saved to DB. <33>");
						$data["response"] = $KW_result1."+ Subscription cannot be saved to DB. <33>"; 
					}
				} else {	//not successful in sending password to new subscriber
					$data["subscriber_id"] = 0;
					$data["msg_org_lnk_id"] = ""; //mo_id should be provided from PHPGateway
					$data["response"] = $KW_result1."+ Unable to send Password to MSISDN[".$data["msisdn"]."] <34>";
					$subscription = $ApiUser->api_response("500", "Unable to send Password to MSISDN[".$data["msisdn"]."] <34>");
				}
				unset($data["api_user_id"]);
				$temp = $data["keyword"];
				$data["keyword"] = "YOONIC";
				$data["request"] = $gatewayurl;
				$log = $Log->recordRequest($data); //saving to log

				$data["api_user_id"] = $api_user_id;
				$data["keyword"] = $temp;
			} 
			
			if (isset($subscription)) return $subscription; //exit subscriptions/registerSubscription function if there are error up to this point

			//Valid MSISDN to TEST 60127702565

                        /*
                        ///generate the MO_id                
                        if (!isset($data["mo_id"]) || empty($data["mo_id"])) {//mo_id should be provided from PHPGateway if not this is an Mobile server request #WARNING mo_id can be set to empty and this will be assumed to be from PHPGATEWAY
					$mo_id = "";
					$data["msg_org_lnk_id"] = $Log->id_generator();
					$msg_org_lnk_id = $data["msg_org_lnk_id"];
				} else {
					$mo_id = $data["mo_id"];
					$msg_org_lnk_id ="";
				}
			*/

			$data["mt_id"] = $Log->id_generator(); //Generate new MT_id to be send to PHPGateway
			/**********************************************/
			/* Sending the Original KEYWORD TO PHPGATEWAY */
			/**********************************************/
			/*
                        unset($curl_result);	
			$sms_keyword = str_replace(' ', '+', $data["keyword"]);
			$curl = curl_init();
			$gatewayurl= Configure::read(Configure::read('http.mode').'.smsc').'&keyword='.$sms_keyword.'&MSISDN='.$data["msisdn"].'&MT_id='.$data["mt_id"].
                                    "&MO_id=".$mo_id."&MessageOriginatingLinkID=".$msg_org_lnk_id.$extra_parameter;
			curl_setopt($curl, CURLOPT_URL, $gatewayurl);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$curl_result = curl_exec($curl);
			curl_close($curl);
                        */
                        
                        
                        //keyword_old = request
                        //curr_keyword = existing
                        
                                                
                        /// set the request output
                        $gatewayurl= Configure::read(Configure::read('http.mode').'.smsc').'&keyword='.$data["keyword"].'&MSISDN='.$data["msisdn"].'&MT_id='.$data["mt_id"].
                                    "&MO_id=".$mo_id."&MessageOriginatingLinkID=".$msg_org_lnk_id.$extra_parameter;
                        
                        ///sends the keyword out
                        $curl_result = $this->sendKeyword( $keyword_old, $data["msisdn"], $data["mt_id"], $mo_id, $msg_org_lnk_id, $extra_parameter );
                        //$curl_result = $this->sendKeyword( "ALREADY BAW", $data["msisdn"], $data["mt_id"], $mo_id, $msg_org_lnk_id, $extra_parameter );

			if (isset($curl_result)) { //PHPGateway returns a response
				unset($KW_result2);
				//$KW_result2 = (string)$curl_result;
                                $KW_result2 = $curl_result;
			} else { // CURL fails
				$KW_result2 = null;
			}			
			
			$data["api_user_id"] = 0;
			$data["request"] = $gatewayurl;
			$data["response"] = $KW_result2;
                        
                        /// transfer the request to current subscripotion
                        
                        if( $subs_test == 100 )
                            $data["keyword"] = $keyword_old;
                            
                            else
                                $data["keyword"] = $curr_keyword;
                                
                        /// resets the keyword
                         if( $data["keyword"] == "ON UPD" )
                                $data["keyword"] = "ON PRD";
                                                        
                        if( $data["keyword"] == "ON UPW" )
                                $data["keyword"] = "ON PRW";

			$log = $Log->recordRequest($data); //save to log
                        //$log = $Log->recordRequest();
			$data["api_user_id"] = $api_user_id;
			
			
			if ($KW_result2 === '0') { // successful in sending KEYWORD to PHPGATEWAY
				if ($delete_flag == 1&& $new_subscriber_flag == 0 && $curr_subscription) { // Keyword was to cancel current subscription
					if ($this->deleteAll(array("Subscription.telco_id"=>$data["telco_id"], "Subscription.subscriber_id"=>$data["subscriber_id"]), false))
                                        { //try deleting subscriptions
                                            
                                       
                                        
                                            $subscriber_id = $data["subscriber_id"];//$subids;
                                            $subs_start_date = "0000-00-00 00:00:00";
                                            $subs_end_date = "0000-00-00 00:00:00";
                                            $keyword_del = "STOP ALL";
                                            $airtime = "0";
                                
                                            $KW_del = "";
                                                
                                            $PARAMZ = array('id' => 3,
                                                            'subscriber_id' => $subscriber_id,
                                                            'subscription_start_date' => $subs_start_date,
                                                            'subscription_end_date' => $subs_end_date,
                                                            'airtime' => $airtime,
                                                            'keyword' => $keyword_del
                                                        );
                                
                                                unset($curl_del);	
                                                $curl = curl_init();
                                                $mobileserverurl= "http://maxis.ms.yoonic.tv/yoonic/index.php/subscriber/subscription";
                                                curl_setopt($curl, CURLOPT_URL, $mobileserverurl);
                                                curl_setopt($curl, CURLOPT_POST, 1);
                                                curl_setopt($curl, CURLOPT_POSTFIELDS, $PARAMZ);
                                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                
                                                $curl_del = curl_exec($curl);
                                                curl_close($curl);
                                                if (isset($curl_del))
                                                { //PHPGateway returns a response
                                                    unset($KW_del);
                                                    $KW_del = (string)$curl_del;
                                                } else
                                                    { // CURL fails
                                                        $KW_dell = null;
                                                    }	
                                
                                                $subscription = $ApiUser->api_response("200", "Subscription Delete. Mobile Server response = ".$KW_del);
                                                $PARAMZ['request'] = $mobileserverurl . serialize($PARAMZ);
                                                $PARAMZ['response'] = $subscription["ApiUser"]["message"];
                                                $PARAMZ['session_token'] = $data['session_token'];
                                                unset($PARAMZ["id"]);
                                                $log = $Log->recordRequest($PARAMZ); //save to log
                                            
                                            
					} else
                                        {
						$subscription = $ApiUser->api_response("500", "Subscription cannot be deleted. Maybe some validation failed.(CIS) <35>");//unable to delete existing subscription
					} 
				} else if ($other_flag) { // just save the log
					$subscription = $ApiUser->api_response("200", "deliverKWMessage success");	
					//do nothing
				} else { //SUBSCRIPTION, TOPUP & UPGRADE
					
					/*                   NOT IN USE LOGIC, reversed on 14/4/2014
					//new temp status to be recorded awaiting confirmation from DN
					$data['new_keyword'] = $data["keyword"];
					$data['new_airtime'] =	$data['airtime'];
					$data['new_subscription_start_date'] = $data['subscription_start_date'];
					$data['new_subscription_end_date'] = $data['subscription_end_date'];
					
					$existing_subscription_start_date = $data['subscription_start_date'];
					$existing_subscription_end_date = $data['subscription_end_date'];
					$existing_keyword = $data["keyword"];
					*/


					if ($curr_subscription_id) $data["id"] = $curr_subscription_id; //Existing Subscription found


					$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'test1.log', "subscription_id->".$curr_subscription_id. PHP_EOL);

					if ($data["keyword"] == "ON TP1" || $data["keyword"] == "TP1") {
						$data["keyword"] = "ON TP1";
						
						
						
						$this->id = $data["id"];
						$this->saveField("subscription_end_date", $data["subscription_end_date"]);    //to extend existing subscription expiry date in CIS, temporary update in new_subscription_end_date

						unset($data["id"]); //ALL TOPUP is to append
						unset($this->id);

					} /*else {
						// unset following fields to prevent overwriting of existing status without confirmation
						unset($data['airtime']); 
						if ($curr_keyword != "") unset($data["keyword"]);
						unset($data['subscription_start_date']);
						unset($data['subscription_end_date']);
					}*/
					
					$data["status"] = "active"; // Set subscription status to active	
					if ($this->save($data))
                                        {

						/// write to mobile server
                                                
                                                $PARAM = array('id' => $this->id,
								'subscriber_id' => $data["subscriber_id"],
								'subscription_start_date' => $data['subscription_start_date'],
								'subscription_end_date' => $data['subscription_end_date'],
								'airtime' => $data["airtime"],
								'keyword' => $data["keyword"]
						);
                                                
                                                $mobileserverurl= "http://maxis.ms.yoonic.tv/yoonic/index.php/subscriber/subscription";
                                                
                                                /// additional conditional update to mobile server based on keyword
                                                //$keytest = $data["keyword"];
                                                
                                                if( $subs_test == 101 )
                                                {
                                                    $subscription = $ApiUser->api_response("309", "Already keyword is enforced: ". $this->id .
                                                                                           " Subs id: " . $data["subscriber_id"] . " keyword: " . $data["keyword"] );
                                                    
                                                } else if( $subs_test == 102 )
                                                    {
                                                        $subscription = $ApiUser->api_response("351", "Invalid keyword occurred: ". $this->id .
                                                                                           " Subs id: " . $data["subscriber_id"] . " keyword: " . $data["keyword"] );
                                                    }
                                                else if( $subs_test == 100 )
                                                    {
                                                        
                                                        if( $data["keyword"] == "ON UPD" )
                                                            $data["keyword"] = "ON PRD";
                                                        
                                                        if( $data["keyword"] == "ON UPW" )
                                                            $data["keyword"] = "ON PRW";
                                                                                        
                                                        
                                                        /// all success -> write to server
                                                        $curl_result3 = $this->updateMobile( $this->id, $data["subscriber_id"], $data['subscription_start_date'],
                                                                                            $data['subscription_end_date'], $data["airtime"], $data["keyword"] );
                                                
                                                
                                                        if (isset($curl_result3)) { //PHPGateway returns a response
                                                                unset($KW_result3);
                                                                $KW_result3 = (string)$curl_result3;
                                                        } else { // CURL fails
                                                                $KW_result3 = null;
                                                        }	
        
                                                        $subscription = $ApiUser->api_response("200", "Subscription saved. Mobile Server response: ".$KW_result3 .
                                                                                               " Subs id: " . $data["subscriber_id"] . " keyword: " . $data["keyword"] . " req: " . $keyword_old);
        
                                                        $PARAM['request'] = $mobileserverurl . serialize($PARAM);
                                                        $PARAM['response'] = $subscription["ApiUser"]["message"];
                                                        $PARAM['session_token'] = $data['session_token'];
                                                        unset($PARAM["id"]);
                                                        $log = $Log->recordRequest($PARAM); //save to log
                                                    }
                                                

					} else {
						$subscription = $ApiUser->api_response("500", "Subscription cannot be saved. Maybe some validation failed. <36>"); //Saving of Subscription fails
					}
				}
			} else {
				$subscription = $ApiUser->api_response("500", "deliverKWMessage error. <37>");				
			}
                        
                        
                        
                        /// resets the keyword
                         if( $data["keyword"] == "ON UPD" )
                                $data["keyword"] = "ON PRD";
                                                        
                        if( $data["keyword"] == "ON UPW" )
                                $data["keyword"] = "ON PRW";
                        
                        
			$data["request"] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?post=".serialize($_POST);
			$data['response'] = $KW_result2."+ ".$subscription["ApiUser"]["message"];
			$log = $Log->recordRequest($data); //save to log
                        
                        
                        
                        /// awaiting receipt to update the DN id field
                        $DN_id = 0;
                        
                        /// write MT record                        
                        $mt_add = $MtTbl->addMT( $data["telco_id"],
                                                 $data["subscriber_id"],
                                                 $data["msisdn"],
                                                 $data["mt_id"],
                                                 $mo_id,
                                                 $msg_org_lnk_id,
                                                 $DN_id,
                                                 $data["api_user_id"],
                                                 $txnID,
                                                 $data["keyword"],
                                                 $data["request"],
                                                 $data['response'] );
                        //$telcoId, $subscriberId, $msisdn, $mtId, $moId, $moLinkId, $dnId, $apiUserId, $txnId, $keyword, $request, $response
                        
                        
		} else {$subscription = $ApiUser->api_response("500", "No POST data <38>");}

                
                
		return $subscription; //exit subscriptions/registerSubscription function
	}
	
        
        
        
        
        
/**
 * renewSubscription method
 * 
 * @param array $data
 * $return $array
 */
	public function renewSubscription($data) { //need to purge old TP1 // wait for shum
		$ApiUser = new ApiUser();
		$Log = new Log();
		$Subscriber = new Subscriber();
		unset($result);
                
                
                $log = $Log->recordRaw($data); 
                
		if($data) {
			if(array_key_exists("session_token", $data)) {
				if($data["session_token"]=="") $subscription = $ApiUser->api_response("500", "No session provided <1>");
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));
				if($isSessionValid["ApiUser"]["result_code"]!="200") $subscription = $ApiUser->api_response("500", "Unauthorised <2>");
			} else {$subscription = $ApiUser->api_response("500", "No session provided <3>");}
		
			if(!isset($data["telco_id"]) or $data["telco_id"]=="") $subscription = $ApiUser->api_response("500", "No telco provided <4>");

			if(!isset($data["msisdn"]) or $data["msisdn"]=="") {		
				if(!isset($data["subscriber_id"]) or $data["subscriber_id"]=="") {
					$subscription = $ApiUser->api_response("500", "No subscriber ID/msisdn provided <5>");
				} else {
					$result = $Subscriber->find("first", array("conditions" => array('Subscriber.id' => $data["subscriber_id"]), 'recursive' => -1));
					if ($result) {				
						$data["msisdn"] = $result['Subscriber']["msisdn"];
						if (!$Subscriber->isActive($data["subscriber_id"])) { // subscriber is inactive 
							$subscription = $ApiUser->api_response("500", "Subscriber is inactive <6>");
						}
					} else {$subscription = $ApiUser->api_response("500", "No matching msisdn for subscriber ID provided <7>");}
				}
			}

			if(!isset($data["subscriber_id"]) or $data["subscriber_id"]=="") {	
				if(!isset($data["msisdn"]) or $data["msisdn"]=="") {
					$subscription = $ApiUser->api_response("500", "No subscriber ID/msisdn provided <8>");
				} else {
					$result = $Subscriber->find("first",array("conditions" => array('Subscriber.msisdn' => $data["msisdn"]), 'recursive' => -1));
					if ($result) {				
						$data["subscriber_id"] = $result['Subscriber']["id"];
						if (!$Subscriber->isActive($data["subscriber_id"])) { // subscriber is inactive 
							$subscription = $ApiUser->api_response("500", "Subscriber is inactive <9>");
						}
					} else { $subscription = $ApiUser->api_response("500", "No matching subscriber ID for msisdn provided <10>");}//msisdn not found in Subscribers Table means user is new
				}
			}
			
			if (isset($subscription)) return $subscription; //exit subscriptions/renewSubscription function if there are error up to this point	

			$SessionToken = new SessionToken();
			$session_token = $SessionToken->findBySessionToken($data["session_token"]);		
			$api_user_id = $session_token["SessionToken"]["api_user_id"];
			$data["api_user_id"] = $api_user_id;


			$conditions = array("Subscription.telco_id"=>$data["telco_id"], "Subscription.subscriber_id"=>$data["subscriber_id"], "Subscription.keyword !="=>"ON TP1");
			$curr_subscription = $this->find("first",array('conditions' => $conditions, 'recursive' => -1));

			$curr_subscription_id = 0;

			if($curr_subscription) {
				$curr_keyword = $curr_subscription["Subscription"]["keyword"];
				$curr_status = $curr_subscription["Subscription"]["status"];
				$curr_subscription_id = $curr_subscription["Subscription"]["id"];

				if ($curr_keyword == "ON BAW" || $curr_keyword == "ON PRW") {
					$piece = explode(" ", $curr_keyword);
					$descriptor = $piece[1];
					$data["keyword"] = "RENEW ".$descriptor;                                        
					$data["subscription_end_date"] = date("Y-m-d H:i:s", strtotime("+1 week"));
                                        
				} else { 
					$subscription = $ApiUser->api_response("400", "No valid subscription found. <11>");
					return $subscription; //exit subscriptions/renewSubscription function
				} // no subscription found

				if (!isset($data["mo_id"])) {//mo_id should be provided from PHPGateway if not this is an Mobile server request #WARNING mo_id can be set to empty and this will be assumed to be from PHPGATEWAY
					$mo_id = "";
					$data["msg_org_lnk_id"] = $Log->id_generator();
					$msg_org_lnk_id = $data["msg_org_lnk_id"];
				} else {
					$mo_id = $data["mo_id"];
					$msg_org_lnk_id ="";
				}

				$data["mt_id"] = $Log->id_generator(); //Generate new MT_id to be send to PHPGateway

				$curl = curl_init();
				$sms_keyword = str_replace(' ', '+', $data["keyword"]);
				$gatewayurl= Configure::read(Configure::read('http.mode').'.smsc').'&keyword='.$sms_keyword.'&MSISDN='.$data["msisdn"].'&MT_id='.$data["mt_id"]."&MO_id=".$mo_id."&MessageOriginatingLinkID=".$msg_org_lnk_id.'&expiry_date='.$data["subscription_end_date"];
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
				$data["request"] = $gatewayurl;
				$data["response"] = $KW_result;
				$log = $Log->recordRequest($data);

				$data["api_user_id"] = $api_user_id;

			} else { // no subscription
				$subscription = $ApiUser->api_response("400", "No valid subscription found. <12>");
				return $subscription; //exit subscriptions/renewSubscription function
			}

			if ($KW_result === "0") {
				$this->id = $curr_subscription_id;						
				if ($this->saveField('Subscription.subscription_end_date',$data["subscription_end_date"])) {
					if ($this->deleteAll(array('Subscription.subscriber_id' => $data["subscriber_id"], "Subscription.keyword"=>"ON TP1"),false)) {//remove all TP1 
						$subscription = $ApiUser->api_response("200", "Subscription renewed, existing Top up cleared(".$curr_subscription_id.") <13>");
					} else {
						$subscription = $ApiUser->api_response("200", "Subscription renewed, existing Top up not cleared(".$curr_subscription_id.") <14>");
					}
				} else {$subscription = $ApiUser->api_response("500", "Subscription cannot be renewed. Maybe some validation failed. <15>");}							
			} else {$subscription = $ApiUser->api_response("500", "Subscription cannot be renewed. Gateway error. <14>");}

			$data['response'] = $KW_result."+ ".$subscription["ApiUser"]["message"];
			$data["request"] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?post=".serialize($_POST);
			$log = $Log->recordRequest($data);	
		} else {$subscription = $ApiUser->api_response("403", "Unauthorised <16>");}
		return $subscription;
	}
	

/**
 * reminderSubscription method
 * 
 * @param array $data
 * $return $array
 */
	public function reminderSubscription($data) { //need to purge old TP1 // wait for shum
		$ApiUser = new ApiUser();
		$Log = new Log();
		$Subscriber = new Subscriber();
		unset($result);
                
                $log = $Log->recordRaw($data); 
                
                
		if($data) {
			if(array_key_exists("session_token", $data)) {
				if($data["session_token"]=="") {$subscription = $ApiUser->api_response("500", "No session provided <1>");}
				$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));
				if($isSessionValid["ApiUser"]["result_code"]!="200") {$subscription = $ApiUser->api_response("500", "Unauthorised <2>");}
			} else {$subscription = $ApiUser->api_response("500", "No session provided <3>");}
		
			if(!isset($data["telco_id"]) or $data["telco_id"]=="") {$subscription = $ApiUser->api_response("500", "No telco provided <4>");}

			if(!isset($data["msisdn"]) or $data["msisdn"]=="") {		
				if(!isset($data["subscriber_id"]) or $data["subscriber_id"]=="") {
					$subscription = $ApiUser->api_response("500", "No subscriber ID/msisdn provided <5>");
				} else {
					$result = $Subscriber->find("first", array("conditions" => array('Subscriber.id' => $data["subscriber_id"]), 'recursive' => -1));
					if ($result) {				
						$data["msisdn"] = $result['Subscriber']["msisdn"];
						if (!$Subscriber->isActive($data["subscriber_id"])) { // subscriber is inactive 
							$subscription = $ApiUser->api_response("500", "Subscriber is inactive <6>");
						}
					} else {$subscription = $ApiUser->api_response("500", "No matching msisdn for subscriber ID provided <7>");}
				}
			}

			if(!isset($data["subscriber_id"]) or $data["subscriber_id"]=="") {	
				if(!isset($data["msisdn"]) or $data["msisdn"]=="") {
					$subscription = $ApiUser->api_response("500", "No subscriber ID/msisdn provided <8>");
				} else {
					$result = $Subscriber->find("first",array("conditions" => array('Subscriber.msisdn' => $data["msisdn"]), 'recursive' => -1));
					if ($result) {				
						$data["subscriber_id"] = $result['Subscriber']["id"];
						if (!$Subscriber->isActive($data["subscriber_id"])) { // subscriber is inactive 
							$subscription = $ApiUser->api_response("500", "Subscriber is inactive <9>");
						}
					} else {$subscription = $ApiUser->api_response("500", "No matching subscriber ID for msisdn provided <10>");} //msisdn not found in Subscribers Table means user is new
				}
			}

			if (isset($subscription)) return $subscription; //exit subscriptions/reminderSubscription function if there are error up to this point	

			$SessionToken = new SessionToken();
			$session_token = $SessionToken->findBySessionToken($data["session_token"]);		
			$api_user_id = $session_token["SessionToken"]["api_user_id"];
			$data["api_user_id"] = $api_user_id;

			$conditions = array("Subscription.telco_id"=>$data["telco_id"], "Subscription.subscriber_id"=>$data["subscriber_id"], "Subscription.keyword !="=>"ON TP1");
			$curr_subscription = $this->find("first",array('conditions' => $conditions, 'recursive' => -1));
			
			if($curr_subscription) {
				$curr_keyword = $curr_subscription["Subscription"]["keyword"]; 
				
				if ($curr_keyword == "ON BAW" || $curr_keyword == "ON PRW") {
					$piece = explode(" ", $curr_keyword);
					$descriptor = $piece[1];
					$data["keyword"] = "REMINDER ".$descriptor;
					$data["subscription_end_date"] = date("Y-m-d H:i:s", strtotime("+1 week"));
				} else { 
					$subscription = $ApiUser->api_response("500", "No valid subscription found. <11>");
					return $subscription; //exit subscriptions/reminderSubscription function
				} // no subscription found
						
				if (!isset($data["mo_id"])) {//mo_id should be provided from PHPGateway if not this is an Mobile server request #WARNING mo_id can be set to empty and this will be assumed to be from PHPGATEWAY
					$mo_id = "";
					$data["msg_org_lnk_id"] = $Log->id_generator();
					$msg_org_lnk_id = $data["msg_org_lnk_id"];
				} else {
					$mo_id = $data["mo_id"];
					$msg_org_lnk_id ="";
				}

				$data["mt_id"] = $Log->id_generator(); //Generate new MT_id to be send to PHPGateway

				$curl = curl_init();
				$sms_keyword = str_replace(' ', '+', $data["keyword"]);
				$gatewayurl= Configure::read(Configure::read('http.mode').'.smsc').'&keyword='.$sms_keyword.'&MSISDN='.$data["msisdn"].'&MT_id='.$data["mt_id"]."&MO_id=".$mo_id."&MessageOriginatingLinkID=".$msg_org_lnk_id;
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
				$data["request"] = $gatewayurl;
				$data["response"] = $KW_result;
				$log = $Log->recordRequest($data);

				$data["api_user_id"] = $api_user_id;

				if ($KW_result === '0') {
					$subscription = $ApiUser->api_response("200", "Subscription Reminder Sent <12>");
				} else {$subscription = $ApiUser->api_response("500", "Subscription Reminder Sending Failed <13>");}

				$data["request"] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?post=".serialize($_POST);
				$data['response'] = $KW_result."+ ".$subscription["ApiUser"]["message"];
				$log = $Log->recordRequest($data);
			} else {$subscription = $ApiUser->api_response("500", "No valid subscription found. <14>");} // no valid subscription
		}
                else {
                        $subscription = $ApiUser->api_response("500", "Unauthorised <15>");
                        }
                       
                
                $reminder_msg = $subscription["ApiUser"]["message"];
                $reminder_log = "Reminder: " .  $data["msisdn"] . " | " . $mo_id . " | " . $data["mt_id"] . " | " . $data["keyword"] . " | " . $reminder_msg;
                $this->atomic_put_contents( $_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'yoonic-DN.log' , $reminder_log. PHP_EOL);
                
		return $subscription;
	}

	public function updateActiveSubscription($data) {
		$ApiUser = new ApiUser();
		$Subscriber = new Subscriber();
		if($data) {
			if(array_key_exists("session_token", $data)) {
				if($data["session_token"]=="") $subscription = $ApiUser->api_response("500", "No session provided");
			} else {$subscription = $ApiUser->api_response("500", "No session provided");}
		
			if(!isset($data["telco_id"]) or $data["telco_id"]=="") $subscription = $ApiUser->api_response("500", "No telco provided");
			if(!isset($data["subscriber_id"]) or $data["subscriber_id"]=="") $subscription = $ApiUser->api_response("500", "No Subscriber ID provided");
			
			if (isset($subscription)) return $subscription; //exit updateActiveSubscription function	
			$isSessionValid = $ApiUser->check_session(array("session_token"=>$data["session_token"]));
			
			if($isSessionValid) {
				$is_updated = $this->updateAll(  //set all expired to inactive?
					array("status"=>"'inactive'"),
					array(
						"Subscription.telco_id"=>$data["telco_id"],
						"Subscription.subscriber_id"=>$data["subscriber_id"],
						"Subscription.status"=>"active",
						"Subscription.subscription_end_date <"=>date("Y-m-d H:i:s")  //conditional by date.
					)
				);
				$is_cleared = $this->deleteAll(array('Subscription.subscriber_id' => $data["subscriber_id"], "Subscription.keyword"=>"ON TP1", "Subscription.subscription_end_date <"=>date("Y-m-d H:i:s"),false));
				$extra_string = ($is_cleared) ? " Expired top up entry deleted" : " Unable to delete Expired top up entry";
				if($is_updated) {
					$subscription = $ApiUser->api_response("200", "Subscription updated.".$extra_string);
				} else {$subscription = $ApiUser->api_response("500", "Problem updating subscription.".$extra_string);}
			} else {$subscription = $ApiUser->api_response("403", "Unauthorised");}
		} else {$subscription = $ApiUser->api_response("500", "Unauthorised");}
		return $subscription;
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