<?php
 
ini_set('memory_limit', '-1');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
App::uses('AppController', 'Controller');
 
/**
 * CakePHP MovieDatasController
 * @author Teikpiew
 */
class VodTblsController extends AppController {
 
    public function index() {
        // query database and sort results
        $data = $this->VodTbl->find('all');
        $this->set('movies', $data);
 
// get a count from the database
        $count = $this->VodTbl->find('count');
        $this->set('count', $count);
    }
 
    public function view($syqic_movie_id = NULL) {
        $this->VodTbl->recursive = 2;
        if (!$syqic_movie_id) {
            throw new NotFoundException(__("ID was not set."));
        }
 
        // search the database based on the id (primary key) of the item 
        $data = $this->VodTbl->findBySyqicMovieId($syqic_movie_id);
//        $users = $this->User->find('all', array('condition'=>array('my_id'=>$id)));
//$numUsers = sizeof($users);
//        $tblid = $this->VodXltn->findByTblId($syqic_movie_id);
//        
//        $count = $this->Vodtbl->find('count', 
//                array('conditions' => array('syqic_movie_id' => 4)));
//        $data = $this->VodTbl->findbySyqicMovieId($syqic_movie_id);
//        array('condition'=>array('my_id'=>$id)
 
        if (!$data) {
            throw new NotFoundException(__("ID was not in the Database."));
        }
 
        // set the variable to display the query results
        $this->set('movies', $data);
//        $this->set('count', $count);
//        $this->set('syqic_movie_id', $syqic_movie_id);
    }
 
}