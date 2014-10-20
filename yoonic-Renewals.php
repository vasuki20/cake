<?php


/// constants
$user = "yoonic-cis";
$pass = "5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8";
$logFile = "";

$telco_id = 1;

/// database parameterrs
$dbhost = "localhost";
$dbuser = "yoonic_cis";
$dbpassword = "syqic2013";
$dbname = "yoonic_cis";

/// subscription
$BAW = "ON BAW";
$PRW = "ON PRW";

$query1 = "SELECT * FROM `subscriptions` WHERE(`keyword`='$BAW' OR `keyword`='$PRW')";

///misc
//$fpath = "/home/yoonic/www/yoonic-cis-utils/logs/";
$fpath = "/var/www/html/yoonic-utils/logs/";


echo "begin \n";

$con = mysqli_connect( $dbhost, $dbuser, $dbpassword, $dbname );


	// Check connection
	if (mysqli_connect_errno())
	  {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	else
	{	
		
		$id_results = mysqli_query( $con, $query1 );
		
		if($id_results->num_rows > 0)
		{
			$record_cnt = 0;
			
			///get session token only once
			$sessionToken = getSessionToken( $user, $pass );
		  
			while ( $row=mysqli_fetch_row($id_results ) )
			{
			
			      if( $sessionToken != 0 )
			      {
				  /// grab subscriber info
				  $subsID = $row[0];
				  $subscriberID = $row[2];
				  $msisdnResult = mysqli_query( $con, "SELECT * FROM `subscribers` WHERE `id` = '$subscriberID' ");
				  $msisdn_row = mysqli_fetch_row( $msisdnResult );			
				  $userMsisdn = $msisdn_row[1];
				  
				  $userKeyword = $row[4];
				  
					  
				  // grab the start date and convert to unix time			
				  $subsStartDate = $row[6];			
				  $subsRealEndDate = addHour( $subsStartDate, 168);			
				  $subsEndDateUnix = convertUnixTime( $subsRealEndDate );			
				  $systemTimeUnix = convertUnixTime( date("Y-m-d H:i:s") );			
				  $timeTest = testTime( $subsEndDateUnix, $systemTimeUnix );
				    
				    if( $timeTest != 0 )
				    {
					  $temp = "";
					  
					  ///if same day or within 24hrs
					  if( $timeTest == 2)
					  {
						$reminderResult = setRenewal2( $sessionToken,  $userMsisdn, $telco_id );
						$temp = "Subscriber renew";
					  }
					  else
					  {
						$temp = "Subscriber flag for reminder";
					  }
					  
					  //$content = date("Y-m-d H:i:s") . " | Processed: " . $userMsisdn . " | " . $timeTest . " | " . $temp;
					  //echo $content . "\n";
					  
					  
					  $content = date("Y-m-d H:i:s") . " | Processed: " . $userMsisdn . " | TimeTest: " . $timeTest . " | Keyword: " .
							    $userKeyword . " | StartDate: " . $subsStartDate . " | Reason: " . $temp;
					  echo $content . "\n";
					  
				    }
				    else{				    
					  //$content = date("Y-m-d H:i:s") . " | Unprocessed: " . $userMsisdn . " | " . $timeTest . " | " . "Record unprocessed";
					  //echo $content . "\n";
					  
					  $content = date("Y-m-d H:i:s") . " | Unprocessed: " . $userMsisdn . " | TimeTest: " . $timeTest .  " | Keyword: " .
							    $userKeyword .  " | StartDate: " . $subsStartDate . " | " . "Record unprocessed";
					  echo $content . "\n";
					  
				    }
			      }
			      else
			      {
				   $content =  date("Y-m-d H:i:s") . " | Unprocessed:  | Connection to session server has encounter an error.";
			      }
						      
			      atomic_put_contents( $fpath . date("m_d_y")."yoonic-Renewals.log", $content. PHP_EOL);
			      
			$record_cnt++;	
			      
			///end of while	
			}
		  
		  
		  
		  
		}
		
		
		
		///get session token
		  $sessionToken = getSessionToken( $user, $pass );
		
		
		
		
		echo "Total records processed: " . $record_cnt . "\n";
		
	// Free result set
	mysqli_free_result( $id_results );
	
	
	///end of else	
	}
		

//===============================   functions =================================================//


function convertUnixTime( $timeconvert )
        {
            list($date2, $time2) = explode(' ', $timeconvert );
            list($year2, $month2, $day2) = explode('-', $date2);
            list($hour2, $minute2, $second2) = explode(':', $time2);
       
            $unixtime = mktime($hour2, $minute2, $second2, $month2, $day2, $year2);
            
            return $unixtime;
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
	
	

function testTime( $endDates, $systemDate )
{
      $unixDay = 86400;
      $unix3day = 259200;
      $unixHour = 3600;
      $unixSecond = 1;
      $unix05day = 129600;
      $unix055day = -129600;
      
      
      $retReminder = 0; // by default is set to renew(failed)
        
      $deltaDTime = $endDates - $systemDate;
      echo "End: " . $endDates . "sys: " . $systemDate . " DT: " . $deltaDTime . "\n";
      
      // on the  7th day renew
      if( $deltaDTime <= $unixDay && $deltaDTime > $unixSecond )
	    $retReminder = 2;
	    
      else
	    $retReminder = 0; ///unprocessed
      
      /*
      if( $systemDate <= $endDates )
      {
	$deltaDTime = $endDates - $systemDate;
	
	
	if( $deltaDTime > $unixSecond  && $deltaDTime < $unixDay )
	    $retReminder = 2; /// renewal
        else if( $deltaDTime > $unixDay && $deltaDTime < $unix3day )
	    $retReminder = 1; /// reminder	
      }
      else 
	    $retReminder = 0;	    
     // echo "End: " . $endDates . " system: " . $systemDate . " Delta: " . $deltaDTime . " - ";      
      */
       
      return $retReminder;      
}

	


		
function getSessionToken( $username, $userpassword)
  {     
      
      $curl = curl_init();
      curl_setopt_array($curl,
			array(
			      CURLOPT_RETURNTRANSFER => 1,
			      CURLOPT_URL => "http://maxis.cs.yoonic.tv/yoonic-cis/api_users/login.xml?username=$username&password=$userpassword",
			      CURLOPT_USERAGENT => "Sample"
			      )
			);
			
      $result = curl_exec($curl);
      
      ///parse xml
      $response = new SimpleXmlElement( $result );
      //echo "response code: " . $response->result_code . "\n";
      //echo "session token: " . $response->session_token . "\n";
      
      $response_code = $response->result_code;
      $session_token = $response->session_token;
        
	  
      if( $response_code == 200 )
	    return $session_token;
      else
	    return 0;
      
	   curl_close($curl);
     
}



 function setRenewal( $stoken, $usernumber, $telcoID )
  {	
	//$st = $stoken;	
	$targetURL = "http://maxis.cs.yoonic.tv/yoonic-cis/subscriptions/renew.xml";
	
	 $curl = curl_init();

      // Set some options - we are passing in a useragent too here
      curl_setopt_array($curl, array(
	  CURLOPT_RETURNTRANSFER => 1,
	  CURLOPT_URL => $targetURL,
	  CURLOPT_USERAGENT => "sample",
	  CURLOPT_POST => 1,
	  CURLOPT_POSTFIELDS => array(
				  "session_token" => $stoken,
				  "telco_id" => $telcoID,
				  "subscriber_id" =>"",
				  "msisdn" => $usernumber
				    )
      ));
      // Send the request & save response to $resp
      $resp = curl_exec($curl);
      
	
	///parse xml
      $response = new SimpleXmlElement( $resp );
      //echo "response code: " . $response->result_code . "\n";
      //echo "message: " . $response->message . "\n";
      
      $response_code = $response->result_code;
      $message = $response->message;
     	 	  
      $reponseResult = $response_code . " | " . $message;
      return $reponseResult;

	// Close request to clear up some resources
      curl_close($curl);
	
  }
  
  
  
  function setRenewal2( $stoken, $usernumber, $telcoID )
  {
      $reponseResult = 200 . " | " . "OK";
      
      return $reponseResult;
  }


function atomic_put_contents($filename, $data)
	{
	    // Copied largely from http://php.net/manual/en/function.flock.php
	    $fp = fopen($filename, "a+");
	    if (flock($fp, LOCK_EX)) {
	        fwrite($fp, $data);
	        flock($fp, LOCK_UN);
	    }
	    fclose($fp);
	}	

 
 
//close the db
mysqli_close( $con );
    
 

?>