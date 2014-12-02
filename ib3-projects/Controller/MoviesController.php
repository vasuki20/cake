<?php

App::uses('AppController', 'Controller');
App::uses('CakeLog', 'Log');

/**
 * Reports Controller
 *
 * @property Report $Report
 */
class MoviesController extends AppController {

    public $helpers = array('Html', 'Form');
    var $uses = array('Movie', 'Vod_Detail');

    public function index() {

        $this->autoRender = false;
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Movie->create();
            //  print_r($this->request->data);
            $video = $this->request->data;
            // print_r($video);

            /* assigned channel id to the channels */
            if ($video['Movie']['Channel Id'] == "IB3Media") {
                $video['Movie']['Channel Id'] = 22;
                print_r($video['Movie']['Channel Id']);
            } elseif ($video['Movie']['Channel Id'] == "IB3 Xclusive") {
                $video['Movie']['Channel Id'] = 24;
                print_r($video['Movie']['Channel Id']);
            } elseif ($video['Movie']['Channel Id'] == "IB3 Trailers") {
                $video['Movie']['Channel Id'] = 25;
                print_r($video['Movie']['Channel Id']);
            } elseif ($video['Movie']['Channel Id'] == "IB3 Presents: STAR WARS VII") {
                $video['Movie']['Channel Id'] = 27;
                print_r($video['Movie']['Channel Id']);
            } elseif ($video['Movie']['Channel Id'] == "The Automotive Channel") {
                $video['Movie']['Channel Id'] = 28;
                print_r($video['Movie']['Channel Id']);
            } else {
                echo "value not found";
            }

            $videoID = $video['Movie']['VideoLink']; // retriving oly the video ID 
//            $url = 'https://www.youtube.com/watch?v=';
//            $videoURL = $url . $videoID;
//             print_r($videoURL);
            /* Retriving the value from the array */
            $insert_data = array("Movie" => array(
                    "category_id" => 7,
                    "channel_id" => $video['Movie']['Channel Id'],
                    "title" => $video['Movie']['Title'],
                    "type" => $video['Movie']['Type'],
                    "description" => $video['Movie']['Description'],
                    "image_thumb" => $video['Movie']['image_thumb'],
                    "director" => $video['Movie']['Director'],
                    "cast" => $video['Movie']['Cast'],
                    "genre" => $video['Movie']['Genre'],
                    "tag" => '-',
                    "language" => 'English',
                    "subtitle" => '-',
                    "duration" => $video['Movie']['Duration'],
                    "credit" => '-',
                    "cp" => 'JJJ',
                    "telco_region" => 'ib3 media',
                    "abr" => $videoID,
                    "rtsp_1" => $videoID,
                    "rtsp_2" => $videoID,
                    "rtsp_3" => $videoID,
                    "bundle_id" => 1,
                    "published" => 0
                )
            );
            /* save values into DB */
            if ($this->Movie->save($insert_data)) {
                $this->Session->setFlash(__('Your datas has been saved.'));
                return $this->redirect(array('action' => 'add'));
            }
            $this->Session->setFlash(__('Unable to add your data.'));
        }
    }

}
