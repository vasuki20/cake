<?php

App::uses('AppController', 'Controller');

/**
 * Reports Controller
 *
 * @property Report $Report
 */
class Ib3ParsersController extends AppController {

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

        $searchResponse = $youtube->search->listSearch('id,snippet', array(
            'q' => $this->request->data['q'],
            'maxResults' => $this->request->data['maxResults'],
            
          //  print_r($searchResponse);
    
        ));
       
     //   $videoFeed = $youtube->getVideoFeed($searchResponse);
        
     //   $url = 'http://gdata.youtube.com/feeds/standardfeeds/top_rated?time=today';
     //   $videoFeed = $youtube->getVideoFeed($url);
              
     //   print_r($videoFeed);

   //    print_r($searchResponse);
        
        
        $videos = '';
        $channels = '';
        $playlists = '';
       
        
        // Add each result to the appropriate list, and then display the lists of
        // matching videos, channels, and playlists.
        foreach ($searchResponse as $searchResult) {
            
             $url = 'https://www.youtube.com/watch?v=';
//            print_r($searchResult['kind']);
//            echo '<br>';
//            print_r($searchResult['etag']);
//            echo '<br>';
//            print_r($searchResult['id']['videoId']);
//            echo '<br>';
//            print_r($searchResult['snippet']['default']['url']);
//            echo '<br>';
//            print_r($searchResult['snippet']['medium']['url']);
//            echo '<br>';
//            print_r($searchResult['snippet']['high']['url']);
//            echo '<br>';
//            print_r($searchResult['snippet']['channelId']);
//            echo '<br>';
//            print_r($searchResult['snippet']['title']);
//            echo '<br>';
//            print_r($searchResult['snippet']['description']);
//            echo '<br>';
//            print_r($searchResult['snippet']['publishedAt']);
//            echo '<br>';
//            print_r($searchResult['snippet']['channelTitle']);
//            echo '<br>';
//            echo '<br>';
//            echo '<br>';
//            echo '<br>';
//            echo '<br>';
//            echo '<br>';
//            echo '<br>';
//            echo '<br>';
//            echo '<br>';
//            echo '<br>';
//            echo '<br>';
            $videoId = $searchResult['id']['videoId'];
             $videoURL = ($url);
             //print_r($videoId);
             $constructURL = $videoURL . $videoId; 
         //    print_r($constructURL);
           //  print_r($videoURL);
            $this->Searchvideo->Create();
            $insert_data = array("Searchvideo" => array(
                    "kind" => $searchResult['kind'],
                    "etag" => $searchResult['etag'],                   
                    "id_videoId" => $searchResult['id']['videoId'],
                    "channelId" => $searchResult['snippet']['channelId'],
                    "title" => $searchResult['snippet']['title'],
                    "description" => $searchResult['snippet']['description'],
                    "thumbnails_default" => $searchResult['snippet']['thumbnails']['default']['url'],
                    "thumbnails_medium" => $searchResult['snippet']['thumbnails']['medium']['url'],
                    "thumbnails_high" => $searchResult['snippet']['thumbnails']['high']['url'],
                  //"publishedAt" => $searchResult['snippet']['publishedAt'],
                    "channelTitle" => $searchResult['snippet']['channelTitle'],
                    "video_url" => $constructURL
                )
            );
            if ($this->Searchvideo->save($insert_data)) {
                print_r("Inserted Succesfully<br>");
            } else {
                print_r("Insert failed<br>");
            }
        }
    }

}

?>
