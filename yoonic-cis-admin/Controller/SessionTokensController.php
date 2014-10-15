<?php
App::uses('AppController', 'Controller');
/**
 * SessionTokens Controller
 *
 * @property SessionToken $SessionToken
 */
class SessionTokensController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->SessionToken->recursive = 0;
		$this->set('sessionTokens', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->SessionToken->id = $id;
		if (!$this->SessionToken->exists()) {
			throw new NotFoundException(__('Invalid session token'));
		}
		$this->set('sessionToken', $this->SessionToken->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SessionToken->create();
			if ($this->SessionToken->save($this->request->data)) {
				$this->Session->setFlash(__('The session token has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The session token could not be saved. Please, try again.'));
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
		$this->SessionToken->id = $id;
		if (!$this->SessionToken->exists()) {
			throw new NotFoundException(__('Invalid session token'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SessionToken->save($this->request->data)) {
				$this->Session->setFlash(__('The session token has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The session token could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->SessionToken->read(null, $id);
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
		$this->SessionToken->id = $id;
		if (!$this->SessionToken->exists()) {
			throw new NotFoundException(__('Invalid session token'));
		}
		if ($this->SessionToken->delete()) {
			$this->Session->setFlash(__('Session token deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Session token was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * purge method
 *
 * @param void
 * @return void
 */
 	public function purge() {
 		if($this->request->is('post')) {
 			$response = $this->SessionToken->purge();
 			$this->set('response', $response);
 		}	
 	}
}
