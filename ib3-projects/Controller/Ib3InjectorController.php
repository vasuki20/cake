<?php

App::uses('AppController', 'Controller');
App::uses('CakeLog', 'Log');

/**
 * Reports Controller
 *
 * @property Report $Report
 */
class Ib3InjectorController extends AppController {

    var $uses = array('Movie', 'Vod_Detail');

    public function injectMovies() {
        $this->autoRender = false;
        $id_results = $this->getVodDetailsTbl(); //retriving video details from vod_detail tbl
        $count1 = 0;
        $count2 = 0;
        $filePath='C:\xampp\htdocs\injector_log\log.txt';
        $file=fopen($filePath, "a");
        foreach ($id_results as $id_result) {
            $count1++;
            $id = $id_result['Vod_Detail']['id_videoId'];
            //  print_r($id);
            $count = $this->isDuplicate($id); //checking duplication with videoId
            if ($count == 0) {
                // print_r("inner circel");
                $count2++;
                $this->Movie->Create(); //inserting the video details into movies tbl
                $insert_data = array("Movie" => array(
                        "source_video_id" => $id,
                        "sub_category_id" => $id_result['Vod_Detail']['channelId'],
                        "category_id" => 7,
                        "bundle_id" => '1',
                        "channel_id" => 22,
                        "published" => 0,
                        "cp" => 'JJJ',
                        "telco_region" => 'ib3',
                        "title" => $id_result['Vod_Detail']['title'],
                        "image_thumb" => $id_result['Vod_Detail']['thumbnails_medium'],
                        "abr" => $id_result['Vod_Detail']['video_url'],
                        "rtsp_1" => '-',
                        "rtsp_2" => '-',
                        "type" => '-',
                        "director" => '-',
                        "cast" => '-',
                        "genre" => '-',
                        "subtitle" => '-',
                        "duration" => '-',
                        "description" => $id_result['Vod_Detail']['description'],
                        "language" => 'english',
                        "credit" => '-',
                        "tag" => '-'
                    )
                );
                echo '<br><br>';
// print_r($insert_data);

                if ($this->Movie->save($insert_data)) {
                    print_r("Inserted Succesfully<br>");
                    $this->injectorLog($file, "Inserted Succesfully<br>");
                } else {
                    print_r("Insert failed<br>");
                }
            } else {
                print_r("Duplicate Channel ID. So Skipping.....<br>");

                $this->injectorLog($file, "Duplicate Channel ID. So Skipping.....<br>");
            }
        }


        print_r('<br>Inner Count->' . $count1);
        print_r('<br>Outer Count->' . $count2);
    }

    private function getVodDetailsTbl() {
        $vod_details_results = $this->Vod_Detail->find('all', array(
            'fields' => array('id_videoId', 'channelId', 'title', 'description', 'thumbnails_medium', 'channelTitle', 'video_url', 'published'),
        ));
        return $vod_details_results;
    }

    private function isDuplicate($id) { // Checking Duplicate using video ID
// print_r($channelId);
// print_r($title);
        $count = $this->Movie->find('count', array(
            'conditions' => array(
                array('source_video_id' => $id),
            //  array('published' => '0'),
            )
        ));
        return $count;
    }

    public function injectorLog($file, $data) {
        // Copied largely from http://php.net/manual/en/function.flock.php
        //$this->log($this->request->$fp, 'debug');
        fwrite($file, $data);
        fclose($file);
    }

}

?>