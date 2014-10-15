<?php
App::uses('AppModel', 'Model');
App::import('model','ApiUser');
App::import('model','Subscription');
App::Import('Helper', 'Xml');
/**
 * Transaction Model
 *
 * @property User $User
 * @property Application $Application
 * @property Product $Product
 * @property Telco $Telco
 * @property VendorTxn $VendorTxn
 */
class Transaction extends AppModel {
	
	//public $useTable = false;
	
	public function addTransaction($data) {
		$ApiUser = new ApiUser();
		if($data) {
			if(array_key_exists("session_token", $data)) {
				if($data["session_token"]=="") {
					$transaction = $ApiUser->api_response("501", "No session provided");
					return $transaction;
				}
				
				$api_user=$ApiUser->check_session(array("session_token"=>$data["session_token"]));
				if($api_user['ApiUser']['result_code']=='403') {
					$transaction = $ApiUser->api_response("403", "Session expired");
					return $transaction;
				}
			} else {
				$transaction = $ApiUser->api_response("501", "No session provided");
				return $transaction;
			}
			
			if(array_key_exists("created_by", $data)) {
				if($data["created_by"]=="") {
					$transaction = $ApiUser->api_response("502", "No creator ID");
					return $transaction;
				}
			} else {
				$transaction = $ApiUser->api_response("502", "No creator ID");
				return $transaction;
			}
			
			if(array_key_exists("modified_by", $data)) {
				if($data["modified_by"]=="") {
					$transaction = $ApiUser->api_response("503", "No modifier ID");
					return $transaction;
				}
			} else {
				$transaction = $ApiUser->api_response("503", "No modifier ID");
				return $transaction;
			}
			
			if(array_key_exists("UserID", $data)) {
				if($data["UserID"]=="") {
					$transaction = $ApiUser->api_response("504", "No User ID");
					return $transaction;
				}
			} else {
				$transaction = $ApiUser->api_response("504", "No User ID");
				return $transaction;
			}
			
			if(array_key_exists("ApplicationID", $data)) {
				if($data["ApplicationID"]=="") {
					$transaction = $ApiUser->api_response("505", "No Application ID");
					return $transaction;
				}
			} else {
				$transaction = $ApiUser->api_response("505", "No Application ID");
				return $transaction;
			}
			
			if(array_key_exists("TransactionType", $data)) {
				if($data["TransactionType"]=="") {
					$transaction = $ApiUser->api_response("506", "No Transaction Type");
					return $transaction;
				}
			} else {
				$transaction = $ApiUser->api_response("506", "No Transaction Type");
				return $transaction;
			}
			
			if(array_key_exists("ProductID", $data)) {
				if($data["ProductID"]=="") {
					$transaction = $ApiUser->api_response("507", "No ProductID");
					return $transaction;
				}
			} else {
				$transaction = $ApiUser->api_response("507", "No ProductID");
				return $transaction;
			}
			
			if(array_key_exists("ProductType", $data)) {
				if($data["ProductType"]=="") {
					$transaction = $ApiUser->api_response("508", "No ProductType");
					return $transaction;
				}
			} else {
				$transaction = $ApiUser->api_response("508", "No ProductType");
				return $transaction;
			}
			
			if(array_key_exists("SourceID", $data)) {
				if($data["SourceID"]=="") {
					$transaction = $ApiUser->api_response("509", "No SourceID");
					return $transaction;
				}
			} else {
				$transaction = $ApiUser->api_response("509", "No SourceID");
				return $transaction;
			}
			
			if(array_key_exists("DestinationID", $data)) {
				if($data["DestinationID"]=="") {
					$transaction = $ApiUser->api_response("510", "No DestinationID");
					return $transaction;
				}
			} else {
				$transaction = $ApiUser->api_response("510", "No DestinationID");
				return $transaction;
			}
			
			if(array_key_exists("Amount", $data)) {
				if($data["Amount"]=="") {
					$transaction = $ApiUser->api_response("511", "No Amount");
					return $transaction;
				}
			} else {
				$transaction = $ApiUser->api_response("511", "No Amount");
				return $transaction;
			}
			
			if(array_key_exists("VendorID", $data)) {
				if($data["VendorID"]=="") {
					$transaction = $ApiUser->api_response("512", "No VendorID");
					return $transaction;
				}
			} else {
				$transaction = $ApiUser->api_response("512", "No VendorID");
				return $transaction;
			}
			
			$data["date_created"] = date("Y-m-d H:i:s");
			$data["date_modified"] = date("Y-m-d H:i:s");
			$data["Timestamp"] = $data["date_modified"];
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, Configure::read(Configure::read('http.mode').'.txn'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, true);
			
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			$output = curl_exec($ch);
			$info = curl_getinfo($ch);
			curl_close($ch);
			
			$transactions = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $output);
			
			$xml = Xml::build($transactions);
			
			$transaction = Xml::toArray($xml);
			
			$data["VendorTransactionID"] = $transaction['Transactions']['item']['VendorTransactionID'];
			
			$data["ResponseCode"] = $transaction['Transactions']['item']['ResponseCode'];
			
			$data["date_modified"] = date("Y-m-d H:i:s");
			
		}else {
			$transaction = $ApiUser->api_response("500", "Unauthorised");
		}
		
		return $transaction;
	}
}
