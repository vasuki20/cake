<?php
App::uses('AppController', 'Controller', 'Configure');

/**
 * Consumptions Controller
 *
 * @property Consumption $Consumption
 */
class ConsumptionsController extends AppController {

/**
 * Models
 *
 * @var array
 */
	public $uses = array('ApiUser', 'Consumption','SessionToken');
	
/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler');

/**
 * log method
 * 
 * @return void
 */
	public function record() {
		if($this->request->is('post')) {
			$data = $this->request->data;
			$consumption = $this->Consumption->logConsumption($data);
		} else {
			$consumption = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('consumption'));
	}
	
/**
 * index method
 * 
 * @return void
 */
	public function index() {
		if($this->request->query) {
			$query = $this->request->query;
			$consumptions = $this->Consumption->listConsumption($query);
		} else {
			$consumptions = $this->ApiUser->api_response("500", "Unauthorised");
		}
		
		$this->set(compact('consumptions'));
	}
}

