<?php

//ini_set('max_execution_time', 300);
//ini_set('memory_limit', '-1');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP ItemsController
 * @author Teikpiew
 */
class MoviesController extends AppController {

    public $components = array('Paginator','Session');

    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'Movie.Title' => 'asc'
        )
    );
    
    
// include the session componenet
    //public $components = array('Session');
    var $uses = array('Movie');

    //$this->Movie->useDbConfig = 'admin';
//    public $components = array('Paginator');
    //pagination method
//    $this ->set()
//    public $paginate = array(
//        'limit' => 50,
//        'order' => array(
//            'Movie.id' => 'asc'
//        )
//    );

    public function index() {
        $this->Paginator->settings = $this->paginate;
        $this->Movie->useDbConfig = 'yoonic';
// query database and sort results

        //$data = $this->Movie->find('all', array('limit' => 100));
        $data = $this->Paginator->paginate('Movie');
        // Search Action// 
        if ($this->request->is('post')) {
            if ($this->request->data) {
                $this->log($this->request->data['Movie']['SearchParam'], 'debug');
                $searchParam=$this->request->data['Movie']['SearchParam'];
                $this->Paginator->settings = array(
                    'conditions' => array(
                        'OR' =>array('Movie.title LIKE' => '%' . $searchParam . '%',
                        'Movie.id LIKE' => '%' . $searchParam . '%',
                        'Channel.name LIKE' => '%' . $searchParam . '%')
                        ),
                    'limit' => 10
                );
                $data = $this->Paginator->paginate('Movie');
            } else {
                $this->Session->setFlash(__('Invalid Request'));
            }
        }

        $this->set('movies', $data);

// get a count from the database
        $count = $this->Movie->find('count');
        $this->set('count', $count);

        // Search Action//       
//        $this->set('Movies', $this->Movie->query($data));
//        if ($this->request->is('post')) {
//            $this->log($this->request->data['Movie']['SearchParam'], 'debug');
//            if ($this->request->data) {
//                $searchParam = $this->request->data['Movie']['SearchParam'];
//                $searchQuery = "select * from movies and (id like '%$searchParam%' or title like '%$searchParam%' or channel like '%$searchParam%' )" . 'and ("' . $Role['Role'] . '"="Admin" or u.id=' . AuthComponent::user('id') . ') ORDER BY created DESC';
//                $this->log($data, 'debug');
//                $this->set('Users', $this->User->query($data));
//            } else {
//                $this->Session->setFlash(__('Invalid Request'));
//            }
//        }
//       
    }

// Search Action
    public function search() {
        if (!isset($this->request->query['title'])) {
            throw new BadRequestException();
        }

        $results = $this->Location->findByKeywords($this->request->query['keywords']);

        $this->set('results', $results);
    }

//         $this->set('results',$this->Post->search($this->data['Movie']['title'])); 
//        if (!$search) {
//            // query database and sort results
//            $data = $this->Movie->find('all', array('order' => 'id'));
//        } else {
//            $data = $this->Movie->find('all',
//                    array('order' => 'id',
//                        'conditions' => array('title LIKE' => '%'.$search.'%')));
//        }
//        $this->set('movies', $data);
//
//// get a count from the database
//        $count = count($data);
//        $this->set('count', $count);
//
//        $this->render('index');

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = NULL) {
        if (!$id) {
            throw new NotFoundException(__("ID was not set."));
        }

        // search the database based on the id (primary key) of the item 
        $data = $this->Movie->findById($id);
        // set the variable to display the query results
        $this->set('movie', $data);

        if (!$data) {
            throw new NotFoundException(__("ID was not in the Database."));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            // prepare the model to insert a new item in the database

            if ($this->Movie->save($this->request->data)) {
                $this->Session->setFlash(__('The movie ID: ' . $id . ' was updated.'));
                $this->redirect('index');
            } else {
                $this->Session->setFlash(__('The movie ID: ' . $id . 'was not updated.'));
            }
        }

        $this->request->data = $data;
    }

    public function delete($id) {
        print_r('Inside delete');
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Movie->delete($id)) {
            $this->Session->setFlash(
                    __('The movie has been deleted.', h($id))
                    
            );
            return $this->redirect(array('controller' => 'movies', 'action' => 'index'));
            
              
        }
    }

    public function view($id = NULL) {
        if (!$id) {
            throw new NotFoundException(__("ID was not set."));
        }

        // search the database based on the id (primary key) of the item 
        $data = $this->Movie->findById($id);

        if (!$data) {
            throw new NotFoundException(__("ID was not in the Database."));
        }

        // set the variable to display the query results
        $this->set('movie', $data);
    }

}
