<?php

/// starts the db
//$con = mysqli_connect("localhost","root","19mcnair","yoonic_cis");


/// constants
$user = "yoonic-cis";
$pass = "5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8";
$logFile = "";

$telco_id = 1;

/// database parameters
$dbhost = "localhost";
$dbuser = "yoonic_cis";
$dbpassword = "syqic2013";
$dbname = "yoonic_cis";

/// subscription
$BAW = "ON BAW";
$PRW = "ON PRW";
$hourWeek = 168;

$query1 = "SELECT * FROM `subscriptions` WHERE(`keyword`='$BAW' OR `keyword`='$PRW')";

///misc
//$fpath = "/home/yoonic/www/yoonic-cis-utils/logs/";
$fpath = "/var/www/html/yoonic-utils/logs/";


$con = mysqli_connect( $dbhost, $dbuser, $dbpassword, $dbname );

echo "begin \n";


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
				    $subsID = $row[0];			
				    $subscriberID = $row[2];
				    $msisdnResult = mysqli_query( $con, "SELECT * FROM `subscribers` WHERE `id` = '$subscriberID' ");
				    $msisdn_row = mysqli_fetch_row( $msisdnResult );			    
				    $userMsisdn = $msisdn_row[1];
					  
				    // grab the start date			
				    $subsStartDate = $row[6];			
				    $subsRealEndDate = addHour( $subsStartDate, $hourWeek );				    
				    $subsEndDateUnix = convertUnixTime( $subsRealEndDate );			
				    $systemTimeUnix = convertUnixTime( date("Y-m-d H:i:s") );
					  
				    $timeTest = testTime( $subsEndDateUnix, $systemTimeUnix );
				    
				    $userKeyword = $row[4];
			      
				    
				    
				    if( $timeTest != 0 )
				    {
					  $temp = "";
					  
					  
					  
					  ///if less than 3 days
					  if( $timeTest == 1)
					  {
						$reminderResult = setReminder2( $sessionToken,  $userMsisdn );
						$temp = "Reminder sms sent";
					  }
					  else
					  {
						$temp = "Subscriber due for renewal";
					  }
					  
					  $content = date("Y-m-d H:i:s") . " | Processed: " . $userMsisdn . " | TimeTest: " . $timeTest . " | Keyword: " . $userKeyword . " | StartDate: " . $subsStartDate . " | Reason: " . $temp;
					  echo $content . "\n";
				    
					  
				    }
				    else{
					  
					  $content = date("Y-m-d H:i:s") . " | Unprocessed: " . $userMsisdn . " | TimeTest: " . $timeTest .  " | Keyword: " . $userKeyword .  " | StartDate: " . $subsStartDate . " | " . "Record unprocessed";
					  echo $content . "\n";
				    }
			      }
			      else
			      {
				   $content =  date("Y-m-d H:i:s") . " | Unprocessed: Connection to session server has encounter an error.";
			      }
						      
			      atomic_put_contents( $fpath . date("m_d_y")."yoonic-Reminder.log", $content. PHP_EOL);
      
			      
			$record_cnt++;	
			      
			///end of while	
			}
		      
		      echo "Total records processed: " . $record_cnt . "\n";
		}
		else
		{
		  $content = "No results found";
		  echo $content;
		  atomic_put_contents( $fpath . date("m_d_y")."yoonic-Reminder.log", $content. PHP_EOL);
		}
		
		
		
	// Free result set	
	mysqli_free_result( $id_results );
	
	
	///end of else	
	}
		
	
//close the db
mysqli_close( $con );	
		
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
      $unix05day = 129600;
      $unix2day = 172800;
      $unix3day = 259200;
      $unixHour = 3600;
      $retReminder = 0; // by default is set to renew(failed)
      
            
      //echo "End: " . $endDates . " system: " . $systemDate . " - ";
      
      if( $systemDate < $endDates )
      {
	$deltaDTime = $endDates - $systemDate;
	
	/// within 1.5 to 1 days will send reminder
	if( $deltaDTime > $unixDay && $deltaDTime < $unix05day )
	    $retReminder = 1; /// reminder
        else if( $deltaDTime > $unix3day )
	    $retReminder = 2; /// renewal	
      }
      else
	    $retReminder = 0;
      
          
      return $retReminder;
      
}

	


		
function getSessionToken( $username, $userpassword)
  {     
      
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => "http://maxis.cs.yoonic.tv/yoonic-cis/api_users/login.xml?username=$username&password=$userpassword",
      CURLOPT_USERAGENT => "Sample"
      ));
			
      $result = curl_exec($curl);
      //echo "Result: " . $result . "\n";
      
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

/*
function setRenewal( $stoken, $subsnumber )
  {
	echo "renewals \n";
	
	$st = $stoken;
	$telco = "1";
	$subsid2 = $subsnumber;
	
      $curl = curl_init();
      // Set some options - we are passing in a useragent too here
      curl_setopt_array($curl, array(
			      CURLOPT_RETURNTRANSFER => 1,
			      CURLOPT_URL => "http://cis.e1.sg/yoonic-cis/subscriptions/renew.xml",
			      CURLOPT_USERAGENT => "sample",
			      CURLOPT_POST => 1,
			      CURLOPT_POSTFIELDS => array(
				  "session_token" => $st,
				  "telco_id" => $telco,
				  "subscriber_id" =>"",
				  "msisdn" => $subsid2
				    )
			      )
			);
      // Send the request & save response to $resp
      $resp = curl_exec($curl);
      
	
	///parse xml
      $response = new SimpleXmlElement( $resp );
      echo "response code: " . $response->result_code . "\n";
      echo "message: " . $response->message . "\n";
      
      $response_code = $response->result_code;
      $message = $response->message;
     	 	  
      $reponseResult = $response_code . " | " . $message;
      return $reponseResult;
	
	// Close request to clear up some resources
      curl_close($curl);
	
  }
*/


 function setReminder( $stoken, $usernumber )
  {
	//echo "reminder \n";
	
	$st = $stoken;
	$telco = "1";
	$subsid2 = $usernumber;
	$targetURL = "http://maxis.cs.yoonic.tv/yoonic-cis/subscriptions/reminder.xml";
	
	
	 $curl = curl_init();

      // Set some options - we are passing in a useragent too here
      curl_setopt_array($curl, array(
	  CURLOPT_RETURNTRANSFER => 1,
	  CURLOPT_URL => $targetURL,
	  CURLOPT_USERAGENT => "sample",
	  CURLOPT_POST => 1,
	  CURLOPT_POSTFIELDS => array(
				  "session_token" => $st,
				  "telco_id" => $telco,
				  "subscriber_id" =>"",
				  "msisdn" => $subsid2
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
  
  
function setReminder2( $stoken, $usernumber )
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

 
 
    
 

?>