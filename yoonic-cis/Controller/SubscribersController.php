<?php
App::uses('AppController', 'Controller', 'Configure');

/**
 * Subscribers Controller
 *
 * @property Subscriber $Subscriber
 */
class SubscribersController extends AppController {

/**
 * Models
 *
 * @var array
 */
	public $uses = array('ApiUser', 'Subscriber','SessionToken');
	
/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler');

/**
 * verify_subscriber method
 * 
 * @return void
 */
	public function verify_subscriber() {
		if($this->request->query) {
			$query = $this->request->query;
			$subscriber = $this->Subscriber->verifysubscriber($query);
		} else {
			$subscriber = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('subscriber'));
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		if($this->request->query) {
			$query = $this->request->query;
			$subscribers = $this->Subscriber->listSubscribers($query);
		} else {
			$subscribers = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('subscribers'));
	}

/**
 * view method
 *
 * @param void
 * @return void
 */
	public function view() {
		if($this->request->query) {
			$query = $this->request->query;
			$subscriber = $this->Subscriber->viewSubscriber($query);
		} else {
			$subscriber = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('subscriber'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$subscriber = $this->Subscriber->addSubscriber($data);
		} else {
			$subscriber = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('subscriber'));
	}

/**
 * edit method
 *
 * @param void
 * @return void
 */
	public function edit() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$subscriber = $this->Subscriber->editSubscriber($data);
		} else {
			$subscriber = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('subscriber'));
	}


/**
 * reset_vcode method
 *
 * @param void
 * @return void
*/
	public function reset_password() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$subscriber = $this->Subscriber->resetPassword($data);
		} else {
			$subscriber = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('subscriber'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$subscriber = $this->Subscriber->deleteSubscriber($data);
		} else {
			$subscriber = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('subscriber'));
	}

}
