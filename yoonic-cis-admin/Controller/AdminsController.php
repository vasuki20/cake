<?php
App::uses('AppController', 'Controller');
/**
 * Admins Controller
 *
 * @property Admin $Admin
 */
class AdminsController extends AppController {

public $helpers = array('Form', 'Html', 'Js', 'Time');

/*
public function beforeFilter() {
	// Basic setup
	$this->Auth->authenticate = array('Form');
	
	// Pass settings in
	$this->Auth->authenticate = array(
	    'Form' => array('userModel' => 'Admin')
	);
}
*/
/**
 * login method
 *
 * @param string username, password
 * @return string session key
 *
 */
 public function login() {
 	if ($this->request->is('post')) {
 		$username=$this->request->data["Admin"]["username"];
 		$password=sha1($this->request->data["Admin"]["password"]);
 		
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
		$this->Admin->recursive = 0;
		$this->set('admins', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Admin->id = $id;
		if (!$this->Admin->exists()) {
			throw new NotFoundException(__('Invalid admin'));
		}
		$this->set('admin', $this->Admin->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->request->data["Admin"]["password"]=sha1($this->request->data["Admin"]["password"]);
			$this->Admin->create();
			if ($this->Admin->save($this->request->data)) {
				$this->Session->setFlash(__('The admin has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The admin could not be saved. Please, try again.'));
			}
		}
		$adminRoles = $this->Admin->AdminRole->find('list');
		$telcos = $this->Admin->Telco->find('list');
		$this->set(compact('adminRoles', 'telcos'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Admin->id = $id;
		if (!$this->Admin->exists()) {
			throw new NotFoundException(__('Invalid admin'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data["Admin"]["password"]=sha1($this->request->data["Admin"]["password"]);
			if ($this->Admin->save($this->request->data)) {
				$this->Session->setFlash(__('The admin has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The admin could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Admin->read(null, $id);
		}
		$adminRoles = $this->Admin->AdminRole->find('list');
		$telcos = $this->Admin->Telco->find('list');
		$this->set(compact('adminRoles', 'telcos'));
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
		$this->Admin->id = $id;
		if (!$this->Admin->exists()) {
			throw new NotFoundException(__('Invalid admin'));
		}
		if ($this->Admin->delete()) {
			$this->Session->setFlash(__('Admin deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Admin was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
