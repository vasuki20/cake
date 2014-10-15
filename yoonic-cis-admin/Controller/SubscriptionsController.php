<?php
App::uses('AppController', 'Controller');
/**
 * Subscriptions Controller
 *
 * @property Subscription $Subscription
 * @property RequestHandlerComponent $RequestHandler
 */
class SubscriptionsController extends AppController {

/**
 * Models
 *
 * @var array
 */
	public $uses = array('ApiUser', 'Subscription', 'SessionToken');

/**
 * Components
 *
 * @var array
 */
 	public $components = array('RequestHandler');
	
	public $paginate = array(
			'paramType' => 'querystring'
	);

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if($this->request->query) {
			$query = $this->request->query;
			$subscriptions = $this->Subscription->getAllSubscriptions($query);
		} else {
			$subscriptions = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('subscriptions'));
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view() {
		if($this->request->query) {
			$query = $this->request->query;
			$subscriptions = $this->Subscription->getSubscription($query);
		} else {
			$subscriptions = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('subscriptions'));
	}

/**
 * add method
 *
 * @return void
 */
	public function keyword() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$subscriptions = $this->Subscription->registerSubscription($data);
		} else {
			$subscriptions = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('subscriptions'));
	}

/**
 * renew method
 * @param void
 * @return void
*/
	public function renew() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$subscriptions = $this->Subscription->renewSubscription($data);
		} else {
			$subscriptions = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('subscriptions'));
	}


/**
 * reminder method
 * @param void
 * @return void
*/
	public function reminder() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$subscriptions = $this->Subscription->reminderSubscription($data);
		} else {
			$subscriptions = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('subscriptions'));
	}


/**
 * getExpired method
 * @param void telco_id, limit
 * @return void
*/
	public function get_expired_subscriptions() {
		if($this->request->query) {
			$query = $this->request->query;
			$subscriptions = $this->Subscription->getExpiredSubscriptions($query);
		} else {
			$subscriptions = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('subscriptions'));
	}



}
