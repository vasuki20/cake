<?php

App::uses('AppController', 'Controller');

/**
 * Reports Controller
 *
 * @property Report $Report
 */
class Ib3ParsersController extends AppController {

    var $uses = array('searchvideos');

    public function index() {
        require_once 'C:\xampp\htdocs\google-api-php-client-master\src\Google\Client.php';
require_once 'C:\xampp\htdocs\google-api-php-client-master\src\Google\Service\YouTube.php';

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
  
        if ($youtube->search->listSearch('post')) {
            if ($this->request->data) {
                
                print_r($this->request->data);
    }
    
    }
    }
}