<?php
App::uses('AppController', 'Controller', 'Configure');

/**
 * Receipts Controller
 *
 * @property Receipt $Receipt
 */
class ReceiptsController extends AppController {

/**
 * Models
 *
 * @var array
 */
	public $uses = array('ApiUser', 'Receipt','SessionToken');
	
/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler');

/**
 * charge_receipt method
 * 
 * @return void
 */
	public function charge_receipt() {
		if($this->request->is('post')) {
			$data = $this->request->data;
			$receipt = $this->Receipt->chargeReceipt($data);
		} else {
			$receipt = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('receipt'));
	}
	
/**
 * charge_receipt method
 * 
 * @return void
 */
	public function reminder_receipt() {
		if($this->request->is('post')) {
			$data = $this->request->data;
			$receipt = $this->Receipt->reminderReceipt($data);
		} else {
			$receipt = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('receipt'));
	}

/**
 * charge_receipt method
 * 
 * @return void
 */
	public function terminate_receipt() {
		if($this->request->is('post')) {
			$data = $this->request->data;
			$receipt = $this->Receipt->terminateReceipt($data);
		} else {
			$receipt = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('receipt'));
	}


}
