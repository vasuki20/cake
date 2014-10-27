<?php
App::uses('AppController', 'Controller');
App::import('model','Channel');
// We need to load the class

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MovieinjectorController extends AppController {
    var $uses = array('Channel');
    public function inject(){  
        $this->Channel->useDbConfig = 'yoonic';
         $this->request->Channel->useDbConfig = 'yoonic';
         
       
      //   $this->autoRender = false;
        
          $count = $this->Channel->find('count');
         echo $query;
         print_r($query);
       
       //$allArticles = $this->Article->find('all');
        // $query-> select(['id','bundleid','category_id','syqic_channel']);
//   
    }
}
?>

      


