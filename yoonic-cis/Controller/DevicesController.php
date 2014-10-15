<?php
App::uses('AppController', 'Controller', 'Configure');

/**
 * Devices Controller  -> this Controller is to record the metadate of devices used to access yoonic
 *
 * @property Device $Device
 */
class DevicesController extends AppController {

/**
 * Models
 *
 * @var array
 */
	public $uses = array('ApiUser', 'Device','SessionToken');
	
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
 */
	public function record() {
		if($this->request->is('post')) {
			$data = $this->request->data;
			$device = $this->Device->recordDevice($data);
		} else {
			$device = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('device'));
	}
	

/**
 * index method
 * 
 * @return void
 */
	public function index() {
		if($this->request->query) {
			$query = $this->request->query;
			$devices = $this->Device->listDevice($query);
		} else {
			$devices = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('devices'));
	}

}