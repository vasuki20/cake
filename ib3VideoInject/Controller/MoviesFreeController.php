<?php

//ini_set('max_execution_time', 300);
//ini_set('memory_limit', '-1');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

class MoviesFreeController extends AppController {

    public $components = array('Paginator', 'Session');
    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'MoviesFree.id' => 'asc'
        )
    );
    var $uses = array('MoviesFree');

    public function displaymoviesfree() {
        $this->Paginator->settings = $this->paginate;
// query database and sort results
        //$data = $this->Movie->find('all', array('limit' => 100));
        $data = $this->Paginator->paginate('MoviesFree');
        // Search Action// 
        $this->set('movies', $data);

// get a count from the database
        $count = $this->MoviesFree->find('count');
        $this->set('count', $count);
    }

}

?>
