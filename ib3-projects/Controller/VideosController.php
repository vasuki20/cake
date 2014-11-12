<?php

App::uses('AppController', 'Controller');

/**
 * Reports Controller
 *
 * @property Report $Report
 */
class VideosController extends AppController {

    var $uses = array('Searchvideo');

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
        if ($this->request->data['maxResults']) {
//            $searchResponse = $youtube->search->listSearch('id,snippet', array(
//                'q' => $this->request->data['q'],
//                'maxResults' => $this->request->data['maxResults'],
//                'videoDefinition' => $videoDefinition
//                    //  print_r($searchResponse);
//            ));
            $searchResponse = $youtube->videos->listVideos('id,snippet,contentDetails,status,statistics,player,recordingDetails', array(
                'id' => 'Lm8p5rlrSkY'
            ));

            //   $videoFeed = $youtube->getVideoFeed($searchResponse);
            //   $url = 'http://gdata.youtube.com/feeds/standardfeeds/top_rated?time=today';
            //   $videoFeed = $youtube->getVideoFeed($url);
            //   print_r($videoFeed);
                print_r($searchResponse);

        }
        else
        {
            $this->Session->setFlash('Please Enter the KeyWord and Max Results');
        }
    }

}

?>
