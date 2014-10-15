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
					$next_hour = date("Y-m-d H:i:s", mktime(date("H")+1, date("i"), date("s"), date("m"), date("d"), date("Y")));
					$SessionToken = new SessionToken();
					$SessionToken->create();
					$SessionToken->save(array("session_token"=>$token, "expiry_date"=> $next_hour));
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
	
	
	public function checkAdminPowers() {
		// check the session.
		// is this a super user or a telco user?
		// if telco user, what level? 1 or 2?
		// if 1, he can handle everything for that telco. kinda like a telco admin
		// if 2, he can do everything except add new api user or delete them. when he logs in he just sees himself. he can delete himself.
		// if 0, this is the super user. he can see everything.
		$apiusers = "0";
		$telco_normal="0";
		if($_SESSION["Auth"]["User"]["admin_role_id"]==1) {
			//telco user. can only do for that telco
			$apiusers="1";
		} elseif($_SESSION["Auth"]["User"]["admin_role_id"]==2) {
			//normal user. can only do for that telco and cannot add/edit/delete other users.
			$apiusers="2";
			$telco_normal="1";
		}
		
		$response = array("role"=>$apiusers, "telco_normal"=>$telco_normal);
		
		return $response;
	}
	
	
	public function setDelete() {
		$this->deleted=true;
		$this->date_deleted=date("Y-m-d H:i:s");
		if($this->save($this)) {
			return true;
		} else {
			return false;
		}
	}
	
}
