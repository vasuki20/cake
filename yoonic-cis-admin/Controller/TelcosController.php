<?php
App::uses('AppController', 'Controller');
/**
 * Telcos Controller
 *
 * @property Telco $Telco
 */
class TelcosController extends AppController {

public $uses = array('Telco', 'Subscription', 'Member', 'ApiUser');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$result=$this->ApiUser->checkAdminPowers();
		
		if($result["role"]=="1" or $result["role"]=="2") {
			$this->redirect(array("controller"=>"api_users", "action"=>"login"));
		} else {
			$this->paginate = array(
				"conditions"=>array(
					"deleted"=>""
				),
				"limit"=>20
			);
			$this->Telco->recursive = 0;
			$this->set('telcos', $this->paginate());
		}
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Telco->id = $id;
		if (!$this->Telco->exists()) {
			throw new NotFoundException(__('Invalid telco'));
		}
		$this->set('telco', $this->Telco->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Telco->create();
			if ($this->Telco->save($this->request->data)) {
				$this->Session->setFlash(__('The telco has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The telco could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Telco->id = $id;
		if (!$this->Telco->exists()) {
			throw new NotFoundException(__('Invalid telco'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Telco->save($this->request->data)) {
				$this->Session->setFlash(__('The telco has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The telco could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Telco->read(null, $id);
		}
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
		$this->Telco->id = $id;
		if (!$this->Telco->exists()) {
			throw new NotFoundException(__('Invalid telco'));
		}
		if ($this->Telco->setDelete()) {
			$this->Session->setFlash(__('Telco deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Telco was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
