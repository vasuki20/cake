<?php

App::uses('AppController', 'Controller');

/**
 * Reports Controller
 *
 * @property Report $Report
 */
class Ib3ParsersController extends AppController {

    public $helpers = array('Html', 'Form');
    var $uses = array('Vod_Detail');

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
        $tableData=[];
// Call the search.list method to retrieve results matching the specified
// query term.
      //  print_r($this->request->data['maxResults']);
        if ($this->request->data && $this->request->data['q'] && $this->request->data['maxResults']) {
            $searchResponse = $youtube->search->listSearch('id,snippet', array(
                'q' => $this->request->data['q'],
                'maxResults' => $this->request->data['maxResults'],
                    //  'c' => $this->request->data['c'],
//                'videoDefinition' => 'standard'
            ));
           //     print_r($searchResponse);

            $videos = '';
            $channels = '';
            $playlists = '';
            $arrayIndex=0;
// Add each result to the appropriate list, and then display the lists of
// matching videos, channels, and playlists.
            foreach ($searchResponse as $searchResult) {               
               // print_r($searchResult); 
                $publishedDate = $searchResult['snippet']['publishedAt'];
               $dateObject = new DateTime($publishedDate);
               $publishedAt=($dateObject->format('Y-m-d H:i:s')); //converting the ISO datetime to UTC
                $videoID = $searchResult['id']['videoId'];
                //  $channelId = $searchResult['snippet']['channelId'];
                $channelTitle = $searchResult['snippet']['channelTitle'];
                //    print_r($channelTitle);
                //  print_r($videoID);
                $videoResults = $this->videoList($videoID); // extracting duration from Video API
                $videoResult = $videoResults[0];
              
                    $convertMin = $videoResult['contentDetails']['duration'];
                    $convertMins = $this->covtime($convertMin);
                    //  print_r($convertMins);
                    // print_r($durationResults);
                    
                    $count = $this->isDuplicate($searchResult['id']['videoId']);
                    if ($count == 0) {

                        $url = 'https://www.youtube.com/watch?v=';

                        $videoId = $searchResult['id']['videoId'];
                        $videoURL = ($url);
                        $constructURL = $videoURL . $videoId;

                        $this->Vod_Detail->Create(); // inserting the dump into ib3master(parser)
                        $insert_data = array("Vod_Detail" => array(
                                "kind" => $searchResult['kind'],
                                "etag" => $searchResult['etag'],
                                "id_videoId" => $searchResult['id']['videoId'],
                                "channelId" => $searchResult['snippet']['channelId'],
                                "title" => $searchResult['snippet']['title'],
                                "description" => $searchResult['snippet']['description'],
                                "thumbnails_default" => $searchResult['snippet']['thumbnails']['default']['url'],
                                "thumbnails_medium" => $searchResult['snippet']['thumbnails']['medium']['url'],
                                "thumbnails_high" => $searchResult['snippet']['thumbnails']['high']['url'],
                                "publishedAt" =>$publishedAt,
                                "channelTitle" => $searchResult['snippet']['channelTitle'],
                                "video_url" => $constructURL,
                                "duration" => $convertMins
                         )
                        );
                        $tableData[$arrayIndex]=$insert_data;
                        $arrayIndex++;
                        if ($this->Vod_Detail->save($insert_data)) {
                            print_r("Inserted Succesfully<br>");
                        } else {
                            print_r("Insert failed<br>");
                        }
                    } else {
                        print_r("Duplicate Video ID. So Skipping.....<br>");
                    }
                }
            
                    $this->set('tableDatas', $tableData);
                    //print_r($tableDatas);

        } else {
            $this->Session->setFlash('Please Enter the KeyWord and Max Results');
        }
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Vod_Detail->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
         $this->set('tableDatas', $tableData);
    }
    
    public function delete($videoID) {
        print_r('Inside delete');
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Vod_Detail->delete($videoID)) {
            $this->Session->setFlash(
                    __('The post with id: %s has been deleted.', h($videoID))
            );
            return $this->redirect(array('action' => 'index'));
        }
    }

    private function videoList($videoID) {
        //   print_r($videoID);
//        print_r($channelId);
//        print_r($channelTitle);
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

        $searchResponse = $youtube->videos->listVideos('id,snippet,contentDetails', array(
            'id' => $videoID
//            'channelTitle'=> $channelId,
//            'channelId'=> $channelTitle
        ));
        //   print_r($searchResponse);
        return $searchResponse;
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

    private function isDuplicate($videoId) { // Checking Duplicate using video ID
// print_r($channelId);
// print_r($title);
        $count = $this->Vod_Detail->find('count', array(
            'conditions' => array(
                array('id_videoId' => $videoId),
            //  array('published' => '0'),
            )
        ));
        return $count;
    }

}

?>
