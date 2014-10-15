<?php
App::uses('AppController', 'Controller');
/**
 * ApiUsers Controller
 *
 * @property ApiUser $ApiUser
 */
class ApiUsersController extends AppController {

public $uses = array('ApiUser', 'SessionToken', 'Telco');
 
public $helpers = array('Form', 'Html', 'Js', 'Time');


public function beforeFilter() {
	// Basic setup
	$this->Auth->authenticate = array('Form');
	
	// Pass settings in
	$this->Auth->authenticate = array(
	    'Form' => array('userModel' => 'ApiUser')
	);
}

/**
 * login method
 *
 * @param string username, password
 * @return string session key
 *
 */

 public function login() {
 	if ($this->request->is('post')) {
 		$username=$this->request->data["ApiUser"]["username"];
 		$password=sha1($this->request->data["ApiUser"]["password"]);
 		
 		if($this->Auth->login()) {
 			//return $this->redirect($this->Auth->redirect());
 			return $this->redirect(array("action"=>"index"));
 		} else {
 			$this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');
 		}
 		
 	}
 }
 
/**
 * logout method
 *
 * @param void
 * @return void
 *
 */
 public function logout() {
 	$this->redirect($this->Auth->logout());
 }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		// check the session.
		// is this a super user or a telco user?
		// if telco user, what level? 1 or 2?
		// if 1, he can handle everything for that telco. kinda like a telco admin
		// if 2, he can do everything except add new api user or delete them. when he logs in he just sees himself. he can delete himself.
		// if 0, this is the super user. he can see everything.
		
		//print_r($_SESSION["Auth"]["User"]);
		
		$result=$this->ApiUser->checkAdminPowers();
		
		if($result["role"]=="1" or $result["role"]=="2") {
			$this->paginate = array(
				"conditions"=>array(
					"telco_id"=>$_SESSION["Auth"]["User"]["telco_id"],
					"deleted"=>""
				),
				"limit"=>20
			);
			
			$this->ApiUser->recursive = 0;
			$apiUsers = $this->paginate('ApiUser');
			$this->set(compact('apiUsers'));
		} else {
			$this->paginate = array(
				"conditions"=>array(
					"deleted"=>""
				),
				"limit"=>20
			);
			$this->ApiUser->recursive = 0;
			$this->set('apiUsers', $this->paginate());
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
		$this->ApiUser->id = $id;
		if (!$this->ApiUser->exists()) {
			throw new NotFoundException(__('Invalid api user'));
		}
		$this->set('apiUser', $this->ApiUser->read(null, $id));
		$this->set('user', $_SESSION["Auth"]["User"]);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('user', $_SESSION["Auth"]["User"]);
		$telcos=$this->Telco->find("list", array("fields"=>array("Telco.id", "Telco.telco_name")));
		$this->set('telco', $telcos);
		if ($this->request->is('post')) {
			$user_exists = $this->ApiUser->find("first", array("conditions"=>array("username"=>$this->request->data["ApiUser"]["username"])));
			if(!is_null($this->request->data["ApiUser"]["username"]) and $this->request->data["ApiUser"]["username"]!=""):
				if(!$user_exists):	
					$this->ApiUser->create();
					$this->request->data["ApiUser"]["password"] = sha1($this->request->data["ApiUser"]["password"]);
					if ($this->ApiUser->save($this->request->data)) {
						$this->Session->setFlash(__('The api user has been saved'));
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The api user could not be saved. Please, try again.'));
					}
				else:
					$this->Session->setFlash(__('The api user could not be saved. Please, try again.'));
				endif;
			else:
				$this->Session->setFlash(__('The api user could not be saved. Please, try again.'));
			endif;
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('user', $_SESSION["Auth"]["User"]);
		$this->ApiUser->id = $id;
		$telcos=$this->Telco->find("list", array("fields"=>array("Telco.id", "Telco.telco_name")));
		$this->set('telco', $telcos);
		if (!$this->ApiUser->exists()) {
			throw new NotFoundException(__('Invalid api user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ApiUser->save($this->request->data)) {
				$this->Session->setFlash(__('The api user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The api user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ApiUser->read(null, $id);
		}
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
		$this->ApiUser->id = $id;
		if (!$this->ApiUser->exists()) {
			throw new NotFoundException(__('Invalid api user'));
		}
		if ($this->ApiUser->setDelete()) {
			$this->Session->setFlash(__('Api user deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Api user was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
