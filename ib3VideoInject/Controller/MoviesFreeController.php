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
    var $uses = array('MoviesFree');
    public $components = array('Paginator', 'Session');
//    public $paginate = array(
//        'limit' => 10,
//        'order' => array(
//            'MoviesFree.id' => 'asc'
//        )
//    ); 
    public function index() {
        $this->autoRender = false;
        print_r("inside index function");        
        //$this->set('movies', $this->MoviesFree->find('all'));
       // $post = $this->MoviesFree->findById($id);
        print_r("before calling MoviesFree");
        try {
             $result = $this->MoviesFree->find('all');
             print_r($result);
             print_r("Success");
        } catch (Exception $e) {
            // do exception handling
            print_r($e);
            print_r("Exception");
        }
       
        
}
}
?>
