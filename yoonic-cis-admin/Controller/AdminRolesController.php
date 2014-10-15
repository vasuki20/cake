<?php
App::uses('AppController', 'Controller');
/**
 * AdminRoles Controller
 *
 * @property AdminRole $AdminRole
 */
class AdminRolesController extends AppController {


/**
 * index method
 *
 * @return void //
 */
	public function index() {
		$this->AdminRole->recursive = 0;
		$this->set('adminRoles', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->AdminRole->id = $id;
		if (!$this->AdminRole->exists()) {
			throw new NotFoundException(__('Invalid admin role'));
		}
		$this->set('adminRole', $this->AdminRole->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AdminRole->create();
			if ($this->AdminRole->save($this->request->data)) {
				$this->Session->setFlash(__('The admin role has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The admin role could not be saved. Please, try again.'));
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
		$this->AdminRole->id = $id;
		if (!$this->AdminRole->exists()) {
			throw new NotFoundException(__('Invalid admin role'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AdminRole->save($this->request->data)) {
				$this->Session->setFlash(__('The admin role has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The admin role could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->AdminRole->read(null, $id);
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
		$this->AdminRole->id = $id;
		if (!$this->AdminRole->exists()) {
			throw new NotFoundException(__('Invalid admin role'));
		}
		if ($this->AdminRole->delete()) {
			$this->Session->setFlash(__('Admin role deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Admin role was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
