<?php


//$sqltime = "2014-05-12 03:54:55";
//$sqltime = "2014-07-10 18:00:00";
//$nst = addHour( $sqltime, 2 );
//$nsd = addDays( $sqltime, 7 ); 
//$nsd = addHour( $sqltime, 168 );
//$curr_date = addHour( $nsd, 168 );
//echo "original time: " . $sqltime . "\n";
//echo "new time: " . $nst . "\n";
//echo "new days: " . $nsd . "\n";
//echo "2nd layer: " . $curr_date . "\n";


//$basesubs = "100";
//$signs = "-";
//$offsets = "70";
//$consets = $signs . $offsets;

//$newvals = $basesubs + $consets;
//echo "Values: " . $newvals . "\n";

$weekhr = 168;
$dayhr = 24;
$topups = 2;


$timenow = date("Y-m-d H:i:s");
//$timedb = "2014-09-01 18:00:00";
$timedb = "0";
echo "System Time: " . $timenow . "\n";
echo "DB Time: " . $timedb . "\n";
//$expirytest = checkExpiry( $timedb, $timenow );
$expirytest = getnewExpiryDate( $timedb, $timenow, $weekhr );
echo "new Expiry test: " . $expirytest . "\n";


//$keyworddb = "ON BAD";
//$keywordnow = "ON PRD";
//$keywordtest = testSubsLevel( $keyworddb, $keywordnow, $expirytest );
//echo "testSubsLevel: " . $keywordtest . "\n";



 /// keyword = current subscription keyword
        /// request = new request keyword
        /// expiry = result of the expiry test
        function testSubsLevel( $keyword, $request, $expiry )
        {
            ///test for already - user has an existing subs, and not expired
            //if ($curr_keyword != "ON PRW" && $curr_keyword != "ON BAW" && $curr_keyword != "" && !$this->isExpired($curr_expiry_date,date("Y-m-d H:i:s")))
            //$subscription = $ApiUser->api_response("333", "Subscription Not Allowed. current package: ".$curr_keyword." <16>"); //invalid: cannot downgrade

            $returntestSubs = 109; //uncaught error
            
            echo "keyword: " . $keyword . " request: " . $request . "\n";
            
            // test the subscription weights
            $keyweight = testSubsWeight($keyword);
            $requestweight = testSubsWeight($request);
            echo "Keyweight: " . $keyweight . " Request weight: " . $requestweight . "\n";
           
           
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
                                echo" hello ";
                                
                                if( $keyweight == 40 || $keyweight == 50 ) // checks if it is BAW or PRW
                                    $returntestSubs = 101; // returns already error
                                    else
                                        $returntestSubs = 100;
                            }
                            
                            /// different level
                            else if( $keyweight != $requestweight )
                            {
                                /// TP1 - all allowed
                                //if( $requestweight == 1 && $keyweight != 51 || $keyweight != 31 )
                                 //   $returntestSubs = 100;
                                
                                if( $keyweight == 30 && $requestweight == 40 ) //PRD -> BAW
                                    $returntestSubs = 102; //allowed
                                    
                                else if( $keyweight == 30 && $requestweight == 31 ) //PRD->UPD
                                    $returntestSubs = 102;
                                
                                else if( $keyweight == 30 && $requestweight == 51 ) //PRD->UPW
                                    $returntestSubs = 102;
                                    
                                else if( $keyweight == 40 && $requestweight == 31 ) // BAW->UPD
                                    $returntestSubs = 102;
                                
                                else if( $keyweight == 40 && $requestweight == 30 ) // BAW->PRD
                                    $returntestSubs = 100;
                                
                                else if( $requestweight == 1 ) // allow all TP1 topup
                                    {
                                        if( $keyweight == 60 || $keyweight == 61 )
                                            $returntestSubs = 1020;
                                            else
                                            $returntestSubs = 1009;    
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
        /// end of function
        }
        
        
        function checkExpiry( $expiry_date, $curr_date )
        {
            $returnExpiry = 999;  //unprocessed
            
            // test for null or 0
            if( $expiry_date != "" || $expiry_date != 0 && $curr_date != "" || $curr_date != 0 )
            {  
                $giventime = convertUnixTime( $expiry_date );
                $currenttime = convertUnixTime( $curr_date );
                
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
        
        
        function convertUnixTime( $timeconvert )
        {
            list($date2, $time2) = explode(' ', $timeconvert );
            list($year2, $month2, $day2) = explode('-', $date2);
            list($hour2, $minute2, $second2) = explode(':', $time2);
       
            $unixtime = mktime($hour2, $minute2, $second2, $month2, $day2, $year2);
            
            return $unixtime;
        }



  /// assign subscription weightage
        function testSubsWeight( $subs_weight )
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



     function getnewExpiryDate( $newexpiry_date, $systemTime, $timeOffset )
        {
            $returnNewExpiry="";  //unprocessed
            
            
            if( $newexpiry_date == "" || $newexpiry_date == 0 )
            {
                $newDates = $systemTime;
            }
            else
            {
                //$expiryDateTest = $this->checkExpiry( $newexpiry_date, $systemTime );
                $expiryDateTest = checkExpiry( $newexpiry_date, $systemTime );
                if( $expiryDateTest == 1 )
                {
                    $newDates = $newexpiry_date;
                }
                else
                {
                    $newDates = $systemTime;
                }
            }
            
            echo"new Dates: " . $newDates . "\n";
            
            //$returnNewExpiry = $this->addHour( $newDates, $timeOffset );
            $returnNewExpiry = addHour( $newDates, $timeOffset );
            
            return $returnNewExpiry;
            
        }



    function addHour($givendate, $hr)
        {
            ///   delta * 60secs * 60mins = total hrs
            $deltatime = 60 * ($hr * 60);     
        
           list($date, $time) = explode(' ', $givendate);
           list($year, $month, $day) = explode('-', $date);
           list($hour, $minute, $second) = explode(':', $time);
       
           $rawtime = mktime($hour, $minute, $second, $month, $day, $year);
           $newUnixtime = $rawtime + $deltatime;
           
           $newtime = date("Y-m-d H:i:s", $newUnixtime);
           
           return $newtime;
             
        
        }
    
    
     function addDays($givendate, $deltaday)
        {
            ///   delta * 60secs * 60mins * 24hrs = total days
            //60 * 60 * 24 * x            
            
            $deltatime = 60 * 60 * (24 * $deltaday);     
        
           list($date, $time) = explode(' ', $givendate);
           list($year, $month, $day) = explode('-', $date);
           list($hour, $minute, $second) = explode(':', $time);
       
           $rawtime = mktime($hour, $minute, $second, $month, $day, $year);
           $newUnixtime = $rawtime + $deltatime;
           
           $newtime = date("Y-m-d H:i:s", $newUnixtime);
           
           return $newtime;
             
        
        }
           




?>