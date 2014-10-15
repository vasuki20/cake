<?php
App::uses('AppController', 'Controller');
/**
 * ApiUsers Controller
 *
 * @property ApiUser $ApiUser
 * @property RequestHandlerComponent $RequestHandler
 */
class ApiUsersController extends AppController {

/**
 * Models
 * 
 * @var array
 */
	public $uses = array('ApiUser','SessionToken');
	
/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler');


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
		$apiUser = $this->ApiUser->api_response($code, $message);
		$this->set(compact('apiUser'));
	}
	
/**
 * login method
 * 
 * Method for the API User to login
 * 
 * @param void
 * @return void
 */
	public function login() {
		if($this->request->query) {
			$apiUser = $this->ApiUser->login($this->request->query);
			$this->set(compact('apiUser'));
		} else {
			$this->api_response("500", "Unauthorised");
		}
	}
	
/**
 * check_session method
 * 
 * @param void
 * @return void
 */
	public function check_session() {
		if($this->request->query) {
			$apiUser = $this->ApiUser->check_session($this->request->query);
			$this->set(compact('apiUser'));
		} else {
			$this->api_response("500", "Unauthorised");
		}
	}
	
}
