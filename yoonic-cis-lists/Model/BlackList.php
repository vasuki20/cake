<?php

App::uses('AppModel', 'Model');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class BlackList extends AppModel {
    
    public function isValueExists($value){
     $blackListIdCount=$this->find('count',
         array('conditions' => array('value' => $value))
                    ); 
     return $blackListIdCount;
    }
   
}

?>
