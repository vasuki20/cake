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
            /* image storage part */
            $folderToSaveFiles = 'C:\xampp\htdocs\cake\cake';
            //  print_r($folderToSaveFiles);
            if (!empty($video['Movie']['image_thumb'])) {
                $file = $video['Movie']['image_thumb']; //put the data into a var for easy use
              //  print_r($file);
                // print_r($file);
         //       $fp = fopen($file, "rw");
        //$this->log($this->request->$fp, 'debug');
//        if (flock($fp, LOCK_EX)) {
//            fwrite($fp, $data);
//            flock($fp, LOCK_UN);
//        }
     //   fclose($fp);
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                // print_r($ext);
                $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions
                // print_r($arr_ext);
                //only process if the extension is valid
                if (in_array($ext, $arr_ext)) {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is 
                    //where we are putting it
                    $newFilename = $file['name']; // edit/add here as you like your new filename to be.
                   // print_r($newFilename);
                    $result = move_uploaded_file($file['tmp_name'], $folderToSaveFiles . $newFilename);
                  //  print_r($file['tmp_name']);

                  //  print_r($result);
                }
            }
            //  print_r($video);
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
            } elseif ($video['Movie']['Channel Id'] == "LifeHacks") {
                $video['Movie']['Channel Id'] = 29;
                print_r($video['Movie']['Channel Id']);
            } else {
                //  echo "value not found";
            }
            $videoID = $video['Movie']['VideoLink']; // retriving oly the video ID 
           // $image = $video['Movie']['image_thumb'];
           // print_r($image);
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
                        "image_thumb" => $file['name'],
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
            'limit' => 25
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
                    'limit' => 25
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
            // print_r($this->request->data);
            $insertdata = $this->request->data;
            /* assigned channel id to the channels */
            if ($insertdata['Movie']['channelId'] == "IB3Media") {
                $insertdata['Movie']['channelId'] = 22;
                print_r($insertdata['Movie']['channelId']);
            } elseif ($insertdata['Movie']['channelId'] == "IB3 Xclusive") {
                $insertdata['Movie']['channelId'] = 24;
                print_r($insertdata['Movie']['channelId']);
            } elseif ($insertdata['Movie']['channelId'] == "IB3 Trailers") {
                $insertdata['Movie']['channelId'] = 25;
                print_r($insertdata['Movie']['channelId']);
            } elseif ($insertdata['Movie']['channelId'] == "IB3 Presents: STAR WARS VII") {
                $insertdata['Movie']['channelId'] = 27;
                print_r($insertdata['Movie']['channelId']);
            } elseif ($insertdata['Movie']['channelId'] == "The Automotive Channel") {
                $insertdata['Movie']['channelId'] = 28;
                print_r($insertdata['Movie']['channelId']);
            } elseif ($insertdata['Movie']['channelId'] == "LifeHacks") {
                $insertdata['Movie']['channelId'] = 29;
                print_r($insertdata['Movie']['channelId']);
            } else {
                //  echo "value not found";
            }
            $editVideoID = $insertdata['Movie']['abr'];
            $count = $this->isEditDuplicate($editVideoID);
            if ($count == 0) {
//            $url = 'https://www.youtube.com/watch?v=';
//            $videoURL = $url . $videoID;
//             print_r($videoURL);
                /* Retriving the value from the array */
                $edit_data = array("Movie" => array(
                        "category_id" => 7,
                        "channel_id" => $insertdata['Movie']['channelId'],
                        "title" => $insertdata['Movie']['title'],
                        "type" => $insertdata['Movie']['type'],
                        "description" => $insertdata['Movie']['description'],
                        "image_thumb" => $insertdata['Movie']['image_thumb'],
                        "director" => $insertdata['Movie']['director'],
                        "cast" => $insertdata['Movie']['cast'],
                        "genre" => $insertdata['Movie']['genre'],
                        "tag" => '-',
                        "language" => 'English',
                        "subtitle" => '-',
                        "duration" => $insertdata['Movie']['duration'],
                        "credit" => '-',
                        "cp" => 'JJJ',
                        "telco_region" => 'ib3 media',
                        "abr" => $editVideoID,
                        "rtsp_1" => $editVideoID,
                        "rtsp_2" => $editVideoID,
                        "rtsp_3" => $editVideoID,
                        "bundle_id" => 1,
                        "published" => 0
                    )
                );
                /* save values into DB */
                if ($this->Movie->save($edit_data)) {
                    $this->Session->setFlash(__('Your datas has been saved.'));
                    return $this->redirect(array('action' => 'add'));
                }
                $this->Session->setFlash(__('Unable to add your data.'));
            } else {
                $this->Session->setFlash(__("Duplicate Video ID. Please enter new ID <br>"));
                // print_r("Duplicate Video ID. Please enter new ID <br>");
            }
        }

        if (!$this->request->data) {
            $this->request->data = $movie;
        }
    }

    public function delete($id) {
        print_r('Inside delete');
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Movie->delete($id)) {
            $this->Session->setFlash(
                    __('The post with id: %s has been deleted.', h($id))
            );
            return $this->redirect(array('action' => 'edit'));
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

    private function isEditDuplicate($editVideoID) { // Checking Duplicate using video ID
        $count = $this->Movie->find('count', array(
            'conditions' => array(
                array('abr' => $editVideoID),
            //  array('published' => '0'),
            )
        ));
        return $count;
    }

}
