<?php
 
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
App::uses('AppModel', 'Model');
 
/**
 * CakePHP VodDetailsTbl
 * @author Teikpiew
 */
class VodDetailsTbl extends AppModel {
    var $useDbConfig = 'moviedata';
    var $useTable = 'vod_details_tbl';
    var $name = 'VodDetailsTbl' ;
}