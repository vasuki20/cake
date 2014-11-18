<?php

App::uses('AppController', 'Controller');

/**
 * Reports Controller
 *
 * @property Report $Report
 */
class ChannelsController extends AppController {

    var $uses = array('Searchvideo','Vod_Detail');

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
             echo "heloooooo";
            foreach ($playResults as $playResult) {
                // print_r($playResult);
                $playListId = $playResult['id'];
                //  print_r($playListId);
                $playListResults = $this->playListItem($playListId);
                //   print_r($playListResults);
                 echo "hiii....................";
                foreach ($playListResults as $playListResult) {
                    $videoId = $playListResult['snippet']['resourceId']['videoId'];
                     print_r($videoId);
                    //   print_r($videoId);
                    //   $channelId = $channelsResponse['id'];
                    //   print_r($channelId);
                
                $videoListResults = $this->videoListItem($videoId);
                foreach ($videoListResults as $videoListResult) {
                //    print_r($videoListResult);
                    
                      $convertMin = $videoListResult['contentDetails']['duration'];
                      print_r($convertMin);
                    $convertMins = $this->covtime($convertMin);
                    //  print_r($convertMins);
                    // print_r($durationResults);
                    $count = $this->isDuplicate($videoId);
                    print_r($count);
                    
                    if ($count == 0) {

                        $url = 'https://www.youtube.com/watch?v=';

                        $videoURL = ($url);
                        $constructURL = $videoURL . $videoId;

                        $this->Vod_Detail->Create(); // inserting the dump into ib3master(parser)
                        $insert_data = array("Vod_Detail" => array(
                               // "kind" => $searchResult['kind'],
                               // "etag" => $searchResult['etag'],
                                "id_videoId" => $videoId,
                                "channelId" => $videoListResult['snippet']['channelId'],
                                "title" => $videoListResult['snippet']['title'],
                                "description" => $videoListResult['snippet']['description'],
                                "thumbnails_default" => $videoListResult['snippet']['thumbnails']['default']['url'],
                                "thumbnails_medium" => $videoListResult['snippet']['thumbnails']['medium']['url'],
                                "thumbnails_high" => $videoListResult['snippet']['thumbnails']['high']['url'],
                                //"publishedAt" => $searchResult['snippet']['publishedAt'],
                                "channelTitle" => $videoListResult['snippet']['channelTitle'],
                                "video_url" => $constructURL,
                                "duration" => $convertMins,
                               "playlist"=> $playListId
                                
                            )
                        );

                        if ($this->Vod_Detail->save($insert_data)) {
                            print_r("Inserted Succesfully<br>");
                        } else {
                            print_r("Insert failed<br>");
                        }
                    } else {
                        print_r("Duplicate Video ID. So Skipping.....<br>");
                    }
                }
                }               
        }
        }else {
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

        $videoListResponse = $youtube->videos->listVideos('id,snippet,contentDetails', array(
            'id' => $videoId
//            'channelTitle'=> $channelId,
//            'channelId'=> $channelTitle
        ));
        //   print_r($searchResponse);

        return $videoListResponse;
    }

    
    private function isDuplicate($videoId) { // Checking Duplicate using video ID
     //   print_r($videoId);
        $count = $this->Vod_Detail->find('count', array(
            'conditions' => array(
                array('id_videoId' => $videoId),
            //  array('published' => '0'),
            )
        ));
        return $count;
    }
    
    
    private function covtime($time) {
        //     print_r($time);
        preg_match_all('/(\d+)/', $time, $parts);

        // Put in zeros if we have less than 3 numbers.
        if (count($parts[0]) == 1) {
            array_unshift($parts[0], "0", "0");
        } elseif (count($parts[0]) == 2) {
            array_unshift($parts[0], "0");
        }

        $sec_init = $parts[0][2];
        $seconds = $sec_init % 60;
        $seconds_overflow = floor($sec_init / 60);

        $min_init = $parts[0][1] + $seconds_overflow;
        $minutes = ($min_init) % 60;
        $minutes_overflow = floor(($min_init) / 60);

        $hours = $parts[0][0] + $minutes_overflow;

        if ($hours != 0)
            return $hours . ':' . $minutes . ':' . $seconds;
        else
            return $minutes . ':' . $seconds;
    }


}

?>
