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
        ));

        $result = $searchResponse . getModelData();


        print_r($result);


        $videos = '';
        $channels = '';
        $playlists = '';


        // Add each result to the appropriate list, and then display the lists of
        // matching videos, channels, and playlists.
        foreach ($searchResponse as $searchResult) {

            $model = $searchResult['modelData:protected'];


            print_r($model);
//       $this->Searchvideo->create();
//        $this->Searchvideo->save(
//                array(
//                    'kind' => $searchResult['kind'],
//                    'etag' => $searchResult['etag'],
//                    'id_kind' => 'youtube#channel',
//                    'videoId' => $searchResult['id'][videoId],
//                    
//                )
//        );
            //   print_r($kind);

            $result = $searchResult['snippet']['title'];





            switch ($searchResult['snippet']['title']) {
                case 'youtube#video':
                    $videos .= sprintf('<li>%s (%s)</li>', $searchResult['snippet']['title'], $searchResult['id']['videoId']);
                    break;


                //print_r(youtube#video);


                case 'youtube#channel':
                    $channels .= sprintf('<li>%s (%s)</li>', $searchResult['snippet']['title'], $searchResult['id']['channelId']);
                    break;
                case 'youtube#playlist':
                    $playlists .= sprintf('<li>%s (%s)</li>', $searchResult['snippet']['title'], $searchResult['id']['playlistId']);
                    break;
            }
        }
    }

}

?>
