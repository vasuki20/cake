<?php

App::uses('AppController', 'Controller');

// We need to load the class

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AddChannelsController extends AppController {

    public $components = array('Paginator', 'Session');
    public $helpers = array('Html', 'Form');
    public $uses = array('AddChannel'); // use this when model and controller name are different

    public function index() {

        require_once 'C:\xampp\php\google-api-php-client-master\src\Google\Client.php';
        require_once 'C:\xampp\php\google-api-php-client-master\src\Google\Service\YouTube.php';
        /*
         * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
         * Google Developers Console <https://console.developers.google.com/>
         * Please ensure that you have enabled the YouTube Data API for your project.
         */
        $DEVELOPER_KEY = 'AIzaSyAcWCerpP1AerBZmGKF13_-qNPX_QOWK34';

        $client = new Google_Client();
        $client->setDeveloperKey($DEVELOPER_KEY);

        // Define an object that will be used to make all API requests.
        $youtube = new Google_Service_YouTube($client);

        //print_r($youtube);
        // Call the search.list method to retrieve results matching the specified
        // query term.
//        $videoDefinition="high";
        if ($this->request->data && $this->request->data['q']) {

            $channelsResponse = $youtube->channels->listChannels('id,snippet', array(
                'forUsername' => $this->request->data['q'],
                    //  'maxResults' => $this->request->data['maxResults'],
            ));
            // print_r($channelsResponse);
            $channelId = $channelsResponse[0]['id'];
            //rint_r($channelId);
            $channelTitle = $channelsResponse[0]['snippet']['title'];
            // print_r($channelTitle);
            $this->set('channelsResponses', $channelsResponse);        
            $this->channelTable(); 
        }
    }
    public function add($id = null, $title = null) {
        $id = $this->request->query('id');
        $title = $this->request->query('title');
        /* checks duplication using channel id */
        $count = $this->isDuplicate($id);
        echo"hello";
        if ($count == 0) {
            $this->AddChannel->create();
            $insert_data = array("AddChannel" => array(
                    "channelId" => $id,
                    "channelTitle" => $title,
                )
            );
        } else {
            $this->Session->setFlash(__('Channel name already exist.'));
            return $this->redirect(array('action' => 'index'));
        }
        /* save values into DB */
        if ($this->AddChannel->save($insert_data)) {
            $this->Session->setFlash(__('Your channel has been saved.'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to add your channel name.'));
        
        //  $this->log('hi', 'debug');
          
    }    
        public function channelTable() {    
        $this->Paginator->settings = array(
            'limit' => 10
        );
       // $data = $this->Paginator->paginate('AddChannel'); 
       $model= $this->AddChannel->recursive = 0;
       print_r($model);
       $data1 = $this->set('posts', $this->AddChannel->find('all'));      
       print_r($data1);  
       
    }
    private function isDuplicate($id) { // Checking Duplicate using Channel ID
        $count = $this->AddChannel->find('count', array(
            'conditions' => array(
                array('channelId' => $id),
            //  array('published' => '0'),
            )
        ));
        return $count;
    }
}

?>