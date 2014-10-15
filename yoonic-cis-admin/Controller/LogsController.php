<?php
App::uses('AppController', 'Controller', 'Configure');

/**
 * Logs Controller
 *
 * @property Log $Log
 */
class LogsController extends AppController {

/**
 * Models
 *
 * @var array
 */
	public $uses = array('ApiUser', 'Log','SessionToken');
	
/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler');

/**
 * record method
 * 
 * @return void
 *//*
	public function record() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$log = $this->Log->recordRequest($data);
		} else {
			$log = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('Log'));
	}
	
*/

/**
 * index method
 * 
 * @return void
 */


	public function index() {
		if($this->request->query) {
			$query = $this->request->query;
			$logs = $this->Log->listLog($query);
		} else {
			$logs = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('logs'));
	}

}