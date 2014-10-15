<?php
App::uses('AppModel', 'Model');
App::import('model','Log');
 
class MtTbl extends AppModel
{
    
    
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
		
		'moId' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'mtId' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'apiUserId' => array(
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

	
	
	public function getLastMT( $msisdn )
	{
	    $result_get = $this->find(
					"all",
					array(
						"conditions" => array("msisdn" => $msisdn ),
						"limit"=>1,
						"recursive"=>1,
						"order" => array("id"=>"DESC")
					)				      
				      );
	
	    return $result_get;
	}




    public function updateDN( $mtID, $dnID )
    {
	$Log = new Log();	
	$status = 1;
	
	$this->updateAll(    
		    array( "dnId" => $dnID, ),        
		    array( "mtId" => $mtID )
		    );
	
	$contents = $mtID . " | " . $dnID;
	
	/*
	$mtrecord = $this->find("first", array("conditions" => array("mt_id" => $mtID ),
                                             "order" => array("id"=>"DESC") ) );
	
	if( $mtrecord != "" || $mtrecord != 0 )
	{
	    
	    
	    $status = 1; //success
	}
	else{
	    
	    $contents = "Error Record not found: " . $mtID;	    
	    $status = 0;
	}
	*/
	
	
	$Log->updateLog( "yoonic-DN.log", $contents );	
	
	return $status;
	
    }


public function addMT($telcoId, $subscriberId, $msisdn, $mtId, $moId, $moLinkId, $dnId, $apiUserId, $txnId, $keyword, $request, $response)
{
    $Log = new Log();
        $status;
        //$this->log($telcoId, 'debug');
        /* if($query->insert([ 'telcoId', 'subscriberId', 'msisdn', 'moId', 'moLinkId', 'apiUserId', 'txnId', 'keyword', 'request', 'response'])
          ->values([$telcoId, $subscriberId, $msisdn, $moId, $moLinkId, $apiUserId, $txnId, $keyword, $request, $response])
          ->execute()) */
	
	
	
        if ($this->save(
                        array(
                            'telcoId' => $telcoId,
                            'subscriberId' => $subscriberId,
                            'msisdn' => $msisdn,
                            'mtId' => $mtId,
                            'moId' => $moId,
                            'moLinkId' => $moLinkId,
                            'dnId' => $dnId,
                            'apiUserId' => $apiUserId,
                            'txnId' => $txnId,
                            'keyword' => $keyword,
                            'request' => $request,
                            'response' => $response
                        )
                )) {
	    
            $status = 1;
        } 
        else {
            $status = 0;
        }
	
	
	$contents = $telcoId . " | " .
			$subscriberId . " | " .
			$msisdn . " | " .
			$mtId . " | " .
			$moId . " | " .
			$moLinkId . " | " .
			$dnId . " | " .
			$apiUserId . " | " .
			$txnId . " | " .
			$keyword . " | " .
			$request . " | " .
			$response;
	
	$Log->updateLog( "yoonic-MT.log", $contents );
	//$this->atomic_put_contents( $_SERVER['DOCUMENT_ROOT'].'/log/'.date("m_d_y").'yoonic-MT.log' , $contents. PHP_EOL);
	
        return $status;
    }



public function findByMtId( $mt_id )
        {
            
            $mtrecord = $this->find("first", array("conditions" => array("Log.mt_id" => $mt_id ),
                                             "order" => array("Log.id"=>"DESC") ) );
            
            
            return $mtrecord;
        }



/// end of class	
}
?>