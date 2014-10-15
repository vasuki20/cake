<?php
App::uses('AppController', 'Controller');
/**
 * Transactions Controller
 *
 * @property Transaction $Transaction
 */
class TransactionsController extends AppController {

/**
 * Models
 *
 * @var array
 */
	public $uses = array('ApiUser', 'Transaction', 'SessionToken');

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
		$this->Transaction->recursive = 0;
		$this->set('transactions', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Transaction->id = $id;
		if (!$this->Transaction->exists()) {
			throw new NotFoundException(__('Invalid transaction'));
		}
		$this->set('transaction', $this->Transaction->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$transactions = $this->Transaction->addTransaction($data);
		} else {
			$transactions = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('transactions'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Transaction->id = $id;
		if (!$this->Transaction->exists()) {
			throw new NotFoundException(__('Invalid transaction'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Transaction->save($this->request->data)) {
				$this->Session->setFlash(__('The transaction has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The transaction could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Transaction->read(null, $id);
		}
		$users = $this->Transaction->User->find('list');
		$applications = $this->Transaction->Application->find('list');
		$products = $this->Transaction->Product->find('list');
		$telcos = $this->Transaction->Telco->find('list');
		$vendorTxns = $this->Transaction->VendorTxn->find('list');
		$this->set(compact('users', 'applications', 'products', 'telcos', 'vendorTxns'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Transaction->id = $id;
		if (!$this->Transaction->exists()) {
			throw new NotFoundException(__('Invalid transaction'));
		}
		if ($this->Transaction->delete()) {
			$this->Session->setFlash(__('Transaction deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Transaction was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
