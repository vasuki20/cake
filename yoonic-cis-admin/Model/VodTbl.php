<?php
 
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
App::uses('AppModel', 'Model');
 
/**
 * CakePHP MovieData
 * @author Teikpiew
 */
class VodTbl extends AppModel {
 
    // table information
    var $name = 'VodTbl';
// define which database driver the model 
// needs to look upon   
    var $useDbConfig = 'moviedata';
// Table Name   
    var $useTable = 'vod_tbl';
    var $primaryKey = 'syqic_movie_id';
    var $cacheQueries = false;
    //one vod only has one vod_detail
    public $hasOne = array(
        'VodDetailsTbl' => array(
            'className' => 'VodDetailsTbl',
            'foreignKey' => 'syqic_movie_id'
        )
    );
     //one vod only has one or many vod_detail
    public $hasMany = array(
        'VodXltnTbl' => array(
            'className' => 'VodXltnTbl',
            'foreignKey' => 'syqic_movie_id'
        )
    );
}