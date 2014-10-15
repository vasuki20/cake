<?php
App::uses('AppController', 'Controller', 'Configure');

/**
 * Members Controller   ***NOT IN USE***
 *
 * @property Member $Member
 */
class MembersController extends AppController {

/**
 * Models
 *
 * @var array
 */
	public $uses = array('ApiUser', 'Member','SessionToken');
	
/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler');

/**
 * verify_member method
 * 
 * @return void
 */
	public function verify_member() {
		if($this->request->query) {
			$query = $this->request->query;
			$member = $this->Member->verifyMember($query);
		} else {
			$member = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('member'));
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		if($this->request->query) {
			$query = $this->request->query;
			$members = $this->Member->listMembers($query);
		} else {
			$members = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('members'));
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
			$member = $this->Member->viewMember($query);
		} else {
			$member = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('member'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$member = $this->Member->addMember($data);
		} else {
			$member = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('member'));
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
			$member = $this->Member->editMember($data);
		} else {
			$member = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('member'));
	}


/**
 * reset_vcode method
 *
 * @param void
 * @return void
*/
	public function reset_vcode() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$member = $this->Member->resetVcode($data);
		} else {
			$member = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('member'));
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
			$member = $this->Member->deleteMember($data);
		} else {
			$member = $this->ApiUser->api_response("500", "Unauthorised");
		}
		$this->set(compact('member'));
	}

}
