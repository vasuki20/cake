<?php

App::uses('AppController', 'Controller');
// We need to load the class

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ListsController extends AppController {

    public $components = array('Paginator', 'Session');
    public $helpers = array('Html', 'Form');
    public $uses = array('WhiteList','BlackList'); // use this when model and controller name are different
  
    public function whitelist() {

     //  $this->log('hi', 'debug');
        $this->Paginator->settings = array(
            'limit' => 10
        );
        $data = $this->Paginator->paginate('WhiteList');
        $this->set('Lists', $data);
        //$data=$this->WhiteList->find('all');
     //   $this->log($data, 'debug');
        $this-> whitelistfilter();
       
    }
    
    public function blacklist() {    

   //     $this->log('hi', 'debug');
        $this->Paginator->settings = array(
            'limit' => 10
        );
        $data = $this->Paginator->paginate('BlackList');
        $this->set('Lists', $data);
     //   $this->log($data, 'debug');

    }
      
    public function whitelistedit($id = null) {
        $data = $this->WhiteList->findById($id);
        if (!$data) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->WhiteList->id = $id;
            if ($this->WhiteList->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'whitelist'));
            }
            $this->Session->setFlash(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $data;
        }
    }

    public function whitelistdelete($id) {
    //    print_r('Inside delete');
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->WhiteList->delete($id)) {
            $this->Session->setFlash(
                    __('The post with id: %s has been deleted.', h($id))
            );
            return $this->redirect(array('action' => 'whitelist'));
        }
    }
    
    public function whitelistadd() {
        if ($this->request->is('post')) {
            $this->WhiteList->create();
            
           
        //    $this->log($this->request->data['WhiteList']['value'], 'debug');
            $blackListIdCount=$this->BlackList->find('count',
                    array('conditions' => array('value' => $this->request->data['WhiteList']['value']))
                    );
           // $this->log($blackListIdCount, 'debug');
            if ($blackListIdCount!=1) {
                if ($this->WhiteList->save($this->request->data)) {
                    $this->Session->setFlash(__('Your User has been saved.'));
                    return $this->redirect(array('action' => 'whitelist'));
                }
            }
            else
            {
                $this->Session->setFlash(__('This ID already exists in Black List.'));
                return;
            }

            $this->Session->setFlash(__('Unable to add your User.'));
        }
    }
    
    public function blacklistedit($id = null) {
        $data = $this->BlackList->findById($id);
        if (!$data) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->BlackList->id = $id;
            if ($this->BlackList->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'blacklist'));
            }
            $this->Session->setFlash(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $data;
        }
    }

    public function blacklistdelete($id) {
        print_r('Inside delete');
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->BlackList->delete($id)) {
            $this->Session->setFlash(
                    __('The post with id: %s has been deleted.', h($id))
            );
            return $this->redirect(array('action' => 'blacklist'));
        }
    }
    public function blacklistadd() {
        if ($this->request->is('post')) {
            $this->BlackList->create();
          //  $this->log($this->request->data, 'debug');
            if ($this->BlackList->save($this->request->data)) {
                $this->Session->setFlash(__('Your User has been saved.'));
                return $this->redirect(array('action' => 'blacklist'));
            }
            $this->Session->setFlash(__('Unable to add your User.'));
        }
    } 
    public function whitelistfilter(){
       $blackListIdCount=$this->BlackList->find('count',
                    array('conditions' => array('value' => $this->request->data['WhiteList']['value']))
                    );
        $this->log($blackListIdCount, 'debug');
       if ($blackListIdCount!=1) {
                
                    return 0;
                }
            
            else
            {
                return 1;
            }   
       
    }
    
}

?>
