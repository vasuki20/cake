<?php

App::uses('AppController', 'Controller');
App::uses('CakeLog', 'Log');

/**
 * Reports Controller
 *
 * @property Report $Report
 */
class MoviesController extends AppController {

    public $components = array('Paginator', 'Session');
    public $helpers = array('Html', 'Form');
    var $uses = array('Movie', 'Vod_Detail');

    public function index() {
      //  $videoId = $this->Movie->find('all')->contain(['abr']);
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
                //  echo "value not found";
            }

            $videoID = $video['Movie']['VideoLink']; // retriving oly the video ID 
            $count = $this->isDuplicate($videoID);
            if ($count == 0) {
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
            } else {
                $this->Session->setFlash(__("Duplicate Video ID. Please enter new ID <br>"));
                // print_r("Duplicate Video ID. Please enter new ID <br>");
            }
        }
    }

    public function edit() {
        $this->log('hi', 'debug');
        $this->Paginator->settings = array(
            'limit' => 10
        );
        $data = $this->Paginator->paginate('Movie');
        $this->set('Movies', $data);
        $this->log($data, 'debug');
        if ($this->request->is('post')) {
            print_r($this->request->data);
            if ($this->request->data) {
                //$this->log($this->request->data['Movie']['SearchParam'], 'debug');
                $searchParam = $this->request->data['Movie']['SearchParam'];
                print_r($searchParam);
                $this->Paginator->settings = array(
                    'conditions' => array(
                        'OR' => array('Movie.title LIKE' => '%' . $searchParam . '%',
//                        'Movie.id LIKE' => '%' . $searchParam . '%',
//                        'Channel.name LIKE' => '%' . $searchParam . '%'
                        )
                    ),
                    'limit' => 10
                );
                $data = $this->Paginator->paginate('Movie');
            } else {
                $this->Session->setFlash(__('Invalid Request'));
            }
        }
        $this->set('Movies', $data);
    }

    public function search() {
        if (!isset($this->request->query['title'])) {
            throw new BadRequestException();
        }

        $results = $this->Location->findByKeywords($this->request->query['keywords']);

        $this->set('results', $results);
    }

    public function editmovie($id = null) {
        // $this->set('Title',$this->Movie->find('list', array('fields' => array('title'))));
       // print_r($id);
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        $movie = $this->Movie->findById($id);
       // print_r($post);
        if (!$movie) {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->Movie->id = $id;
            
            print_r("hi");
            print_r($this->request->data);
            
            if ($this->Movie->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'add'));
            }
            $this->Session->setFlash(__('Unable to update your post.'));
        }
        print_r($this->request->data);
        if (!$this->request->data) {
            $this->request->data = $movie;
        }
    }

    private function isDuplicate($videoId) { // Checking Duplicate using video ID
// print_r($channelId);
// print_r($title);
        $count = $this->Movie->find('count', array(
            'conditions' => array(
                array('abr' => $videoId),
            //  array('published' => '0'),
            )
        ));
        return $count;
    }

}
