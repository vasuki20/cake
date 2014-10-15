<?php
App::uses('AppController', 'Controller');
/**
 * Members Controller
 *
 * @property Member $Member
 */
class MembersController extends AppController {

public $uses = array('Member', 'Subscription', 'ApiUser', 'Telco');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		// apply telco specific logic
		
		$result=$this->ApiUser->checkAdminPowers();
		
		if($result["role"]=="1" or $result["role"]=="2") {
			$this->paginate = array(
				"conditions"=>array(
					"telco_id"=>$_SESSION["Auth"]["User"]["telco_id"],
					"Member.deleted"=>""
				),
				"limit"=>20
			);
			
			$this->Member->recursive = 0;
			$members = $this->paginate('Member');
			$this->set(compact('members'));
		} else {
			$this->paginate = array(
				"conditions"=>array("Member.deleted"=>""),
				"limit"=>20
			);
			
			$this->Member->recursive = 0;
			$this->set('members', $this->paginate());
		}
		
		$this->set('user', $_SESSION["Auth"]["User"]);
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Member->id = $id;
		if (!$this->Member->exists()) {
			throw new NotFoundException(__('Invalid member'));
		}
		$this->set('member', $this->Member->read(null, $id));
		$this->set('user', $_SESSION["Auth"]["User"]);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Member->create();
			if ($this->Member->save($this->request->data)) {
				$this->Session->setFlash(__('The member has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The member could not be saved. Please, try again.'));
			}
		}
		$telcos=$this->Telco->find("list", array("fields"=>array("Telco.id", "Telco.telco_name")));
		$this->set('telcos', $telcos);
		$this->set('user', $_SESSION["Auth"]["User"]);
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Member->id = $id;
		if (!$this->Member->exists()) {
			throw new NotFoundException(__('Invalid member'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Member->save($this->request->data)) {
				$this->Session->setFlash(__('The member has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The member could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Member->read(null, $id);
		}
		$telcos=$this->Telco->find("list", array("fields"=>array("Telco.id", "Telco.telco_name")));
		$this->set('telcos', $telcos);
		$this->set('user', $_SESSION["Auth"]["User"]);
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->set('user', $_SESSION["Auth"]["User"]);
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Member->id = $id;
		if (!$this->Member->exists()) {
			throw new NotFoundException(__('Invalid member'));
		}
		if ($this->Member->setDelete()) {
			$this->Session->setFlash(__('Member deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Member was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
