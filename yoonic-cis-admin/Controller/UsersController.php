<?php

App::uses('AppController', 'Controller');
App::import('Controller', 'Reports'); // mention at top
// We need to load the class
$Reports = new ReportsController;

// If we want the model associations, components, etc to be loaded
$Reports->constructClasses();

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UsersController extends AppController {

    public $components = array('Paginator', 'Session');
    public $helpers = array('Html', 'Form');

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->set('authUser', $this->Auth->user());
                return $this->redirect(
                                array('controller' => 'users', 'action' => 'index')
                );
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function index() {
        $Role = AuthComponent::user('Role');
        $this->log($Role, 'debug');

        $Id = AuthComponent::user('id');
        //$Role['Role'] => 'Admin'   ---  this is not working
        $orCondition;
        if ($Role['Role'] == 'Admin') {
            $orCondition = array(
                "OR" => array(
                    1 => 1,
                    'User.id' => $Id,
                )
            );
        } else {
            $orCondition = array(
                'User.id' => $Id
            );
        }

        $this->Paginator->settings = array(
            'conditions' => $orCondition,
            'limit' => 10,
            'order' => array('User.id' => 'DESC')
        );

        $this->set('Role', $Role);


        //$data=$this->User->find('all', $options);
        $data = $this->Paginator->paginate('User');


        if ($this->request->is('post')) {
            if ($this->request->data) {
                $this->log($this->request->data['User']['SearchParam'], 'debug');
                $searchParam = $this->request->data['User']['SearchParam'];

                $searchParamCondition = array(
                    "OR" => array(
                        'User.id LIKE' => "%$searchParam%",
                        'User.FirstName LIKE' => "%$searchParam%",
                        'User.lastname LIKE' => "%$searchParam%",
                        'User.emailid LIKE' => "%$searchParam%",
                        'Telconame.telconame LIKE' => "%$searchParam%",
                        'Isactive.isActive LIKE' => "%$searchParam%",
                        'Role.role LIKE' => "%$searchParam%",
                    )
                );
                $this->Paginator->settings = array(
                    'conditions' => array($orCondition, $searchParamCondition),
                    'limit' => 10,
                    'order' => array('User.id' => 'DESC')
                );
                $data = $this->Paginator->paginate('User');
            } else {
                $this->Session->setFlash(__('Invalid Request'));
            }
        }
        $this->set('Users', $data);
        $this->log($data, 'debug');
    }

    public function add() {
        $message = "Notification: New report submitted!";
        $this->set('Telconame', $this->User->Telconame->find('list', array('fields' => array('Telconame'))));
        $this->set('Role', $this->User->Role->find('list', array('fields' => array('Role'))));
        $this->set('Isactive', $this->User->Isactive->find('list', array('fields' => array('Isactive'))));
        if ($this->request->is('post')) {
            $this->User->create();
            $this->log($this->request->data, 'debug');
            if ($this->User->save($this->request->data)) {
                echo '$this->request->data';
                $this->Session->setFlash(__('Your User has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your User.'));
        }
//        $adminRoles = $this->Role->find('all');
//        $isactives = $this->Isactive->find('all');
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $User = $this->User->findById($id);
        if (!$User) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('User', $User);
    }

    public function edit($id = null) {
        $Role = AuthComponent::user('Role');
        $this->log($Role['Role'], 'debug');

        $this->set('CurrentRole', $Role);
        $this->set('Telconame', $this->User->Telconame->find('list', array('fields' => array('Telconame'))));
        $this->set('Role', $this->User->Role->find('list', array('fields' => array('Role'))));
        $this->set('Isactive', $this->User->Isactive->find('list', array('fields' => array('Isactive'))));
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $user;
        }
    }

    public function delete($id) {
        print_r('Inside delete');
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->User->delete($id)) {
            $this->Session->setFlash(
                    __('The post with id: %s has been deleted.', h($id))
            );
            return $this->redirect(array('action' => 'index'));
        }
    }

}

?>
