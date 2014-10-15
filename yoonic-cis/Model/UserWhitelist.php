<?php
App::uses('AppModel', 'Model');




class UserWhitelist extends AppModel {


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
		
	);
	
	
	public function addListMsisdn( $msisdn_user )
	{
	    $status;
	    $timestamps = date("Y-m-d H:i:s");    
	    
		/// doesnt exist proceed to save
		if( $this-> save(
			    array(
				'msisdn' => $msisdn_user,
				'timestamp' => $timestamps
			    )
		
		)){
		    $status = 1; //pass
		}	    
		
		else
		    $status = 0; /// failed
				
	    return $status;
	}
	
	
	
	public function isWhiteListed( $msisdn ) 
	{
            $results;            
            $whiteok = $this->find("first", array("conditions" => array("msisdn" => $msisdn ),
                                             "order" => array("id"=>"DESC") ) );
	
            if( !empty($whiteok) )
                $results = 1;
            else
                $results = 0;
                
            return $results;
       }
       
       
	    
	
}


?>