<?php


class MoTbl extends AppModel {
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

        public function addMO($telcoId, $subscriberId, $msisdn, $moId, $moLinkId, $apiUserId, $txnId, $keyword, $request, $response) {
        $status;
        $this->log($telcoId, 'debug');
        /* if($query->insert([ 'telcoId', 'subscriberId', 'msisdn', 'moId', 'moLinkId', 'apiUserId', 'txnId', 'keyword', 'request', 'response'])
          ->values([$telcoId, $subscriberId, $msisdn, $moId, $moLinkId, $apiUserId, $txnId, $keyword, $request, $response])
          ->execute()) */

        if ($this->save(
                        array(
                            'telcoId' => $telcoId,
                            'subscriberId' => $subscriberId,
                            'msisdn' => $msisdn,
                            'moId' => $moId,
                            'moLinkId' => $moLinkId,
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
        return $status;
    }

}


?>