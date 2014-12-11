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
class MoviesHot extends AppModel {
 
    var $useDbConfig = 'default';
    var $useTable = 'movies_hot';
    var $primaryKey = 'id';
 
}


