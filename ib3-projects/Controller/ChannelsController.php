<?php

App::uses('AppController', 'Controller');

/**
 * Reports Controller
 *
 * @property Report $Report
 */
class ChannelsController extends AppController {

    var $uses = array('Searchvideo');

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

        //print_r($youtube);
        // Call the search.list method to retrieve results matching the specified
        // query term.
//        $videoDefinition="high";
        if ($this->request->data && $this->request->data['q'] && $this->request->data['maxResults']) {

            $channelsResponse = $youtube->channels->listChannels('id,snippet', array(
                'forUsername' => $this->request->data['q'],
                'maxResults' => $this->request->data['maxResults'],
            ));

            //  print_r($channelsResponse);
            //  print_r("<br><br>");
            //  print_r($channelsResponse[0]['id']);


            $channelId = $channelsResponse[0]['id'];
            $playResults = $this->playList($channelId);

            foreach ($playResults as $playResult) {
                // print_r($playResult);
                $playListId = $playResult['id'];
                //  print_r($playListId);
                $playListResults = $this->playListItem($playListId);
                //   print_r($playListResults);

                foreach ($playListResults as $playListResult) {
                    $videoId = $playListResult['snippet']['resourceId']['videoId'];
                   //  print_r($videoId);
                    //   print_r($videoId);
                    //   $channelId = $channelsResponse['id'];
                    //   print_r($channelId);
                }
                $videoListResults = $this->videoListItem($videoId);
                foreach ($videoListResults as $videoListResult) {
                //    print_r($videoListResult);
                }
            }
        } else {
            $this->Session->setFlash('Please Enter the KeyWord and Max Results');
        }
    }

    private function playList($channelId) {
        //   print_r($videoID);
//        print_r($channelId);
//        print_r($channelTitle);
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

        $playListResponse = $youtube->playlists->listPlaylists('id,snippet', array(
            'channelId' => $channelId
//            'channelTitle'=> $channelId,
//            'channelId'=> $channelTitle
        ));
        //   print_r($searchResponse);

        return $playListResponse;
    }

    private function playListItem($playListId) {
        //   print_r($videoID);
//        print_r($channelId);
//        print_r($channelTitle);
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

        $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems('id,snippet', array(
            'playlistId' => $playListId
//            'channelTitle'=> $channelId,
//            'channelId'=> $channelTitle
        ));
        //   print_r($searchResponse);

        return $playlistItemsResponse;
    }

    private function videoListItem($videoId) {
        //   print_r($videoID);
//        print_r($channelId);
//        print_r($channelTitle);
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

        $videoListResponse = $youtube->videos->listVideos('id,snippet', array(
            'id' => $videoId
//            'channelTitle'=> $channelId,
//            'channelId'=> $channelTitle
        ));
        //   print_r($searchResponse);

        return $videoListResponse;
    }

}

?>
