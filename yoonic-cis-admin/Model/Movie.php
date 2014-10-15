<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
App::uses('AppModel', 'Model');
 
/**
 * CakePHP Item
 * @author Teikpiew
 */
class Movie extends AppModel {
 
//use tbale movies
//    public $useTable = 'movies';
    var $name = 'Movie';
    var $useDbConfig = 'yoonic';
    var $useTable = 'Movies';
    var $primaryKey = 'id';
    var $cacheQueries = false; 
    var $belongsTo = array('Channel' => array('className' => 'Channel'));
//    var $name = 'Movie';
//    var $actsAs = array('Searchable');
//    var $validate = array(
//        'title' => array(
//            'rule' => array('minLength', 1)
//        ),
//        'body' => array(
//            'rule' => array('minLength', 1)
//        )
//    );
 
}


