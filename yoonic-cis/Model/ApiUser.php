<?php
App::uses('AppModel', 'Model');
App::import('model','SessionToken');
/**
 * ApiUser Model
 *
 */
class ApiUser extends AppModel {
	
	/**
	 * api_response method
	 *
	 * Common function to return a 404 not found.
	 *
	 * @param string $message
	 * @return void
	 *
	 */
	public function api_response($code, $message) {
		$apiUser = array( "ApiUser" => array( "result_code" => $code, "message" => $message) );
		return $apiUser;
	}
	
	
	/**
	 * login method
	 *
	 * Method for the API User to login
	 *
	 * @param void
	 * @return void
	 */
	public function login($request_query) {
		if($request_query) {
			$query = $request_query;
			if($query["username"] and $query["password"]) {
				$conditions = array("username" => $query["username"], "password" => $query["password"]);
				$temp_apiUser = $this->find('first', array('conditions' => $conditions));
				if($temp_apiUser) {
					$token = sha1($temp_apiUser["ApiUser"]["username"] + time());
					$api_user_id = $temp_apiUser["ApiUser"]["id"];
					$next_hour = date("Y-m-d H:i:s", mktime(date("H")+1, date("i"), date("s"), date("m"), date("d"), date("Y")));
					$SessionToken = new SessionToken();
					$SessionToken->create();
					$SessionToken->save(array("session_token"=>$token, "api_user_id"=> $api_user_id, "expiry_date"=> $next_hour));
					$apiUser = array( "ApiUser" => array( "result_code" => "200", "session_token" => $token) );
					return $apiUser;
				} else {
					$apiUser = $this->api_response("404", "Invalid API User");
					return $apiUser;
				}
			}
		} else {
			$apiUser = $this->api_response("500", "Unauthorised");
			return $apiUser;
		}
	}
	
	/**
	 * check_session method
	 *
	 * @param void
	 * @return void
	 */
	public function check_session($request_query) {
		if($request_query) {
			$query = $request_query;
			if(isset($query["session_token"])) {
				$SessionToken = new SessionToken();
				$session_token = $SessionToken->findBySessionToken($query["session_token"]);
				
				if(isset($session_token)) {
					// Check if session is still valid.
					$start_session = $session_token["SessionToken"]["expiry_date"];
					$now = date("Y-m-d H:i:s");
					$d_start = new DateTime($start_session);
					$d_end   = new DateTime($now);
					$diff = $d_start->diff($d_end);
					
					if($diff->invert != 0) {
						$apiUser = $this->api_response("200", "Valid Session");
					} else {
						$apiUser = $this->api_response("403", "Session Expired");
					}
	
				} else {
					$apiUser = $this->api_response("404", "Invalid Session");
				}

				return $apiUser;
			}
		} else {
			$apiUser = $this->api_response("500", "Unauthorised");

			return $apiUser;
		}
	}
	
}
