<?php

App::uses('AppController', 'Controller');

/**
 * Reports Controller
 *
 * @property Report $Report
 */
class MovieInjectorController extends AppController {

    var $uses = array('Vod_Tbl', 'Channel_Tbl', 'Channel_Txl_Tbl', 'Movie', 'Vod_Details_Tbl', 'Vod_Xltn_Tbl', 'Channel');

    public function injectMovies() {
        $this->autoRender = false;
        $channel_results = $this->getChannels();
//        print_r($channel_results);
        foreach ($channel_results as $channel_result) {
            echo '<br>';
//            print_r($channel_result);
            if ($channel_result['Channel']['id']) {
                $id_results = $this->getMovieList($channel_result['Channel']['syqic_channel']);
                $this->log('injectMovies', 'debug');
                foreach ($id_results as $id_result) {
                    $id = $id_result['Vod_Tbl']['syqic_movie_id'];
                    echo '<br>';
                    echo $id;
                    $vodTblArray = $this->getVodTbl($id);
                    print_r($vodTblArray);
                    $count = $this->isDuplicate($channel_result['Channel']['id'], $vodTblArray[0]['Vod_Tbl']['movie_title']);
                    if ($count == 0) {
                        $vodDetailsTblArray = $this->getVodDetailsTbl($id);
                        $vodXltnTblArray = $this->getVodXlTbl($id);
                        $description = '-';
                        $language = '-';
                        if ($vodXltnTblArray[0]['Vod_Xltn_Tbl']['description'])
                            $description = $vodXltnTblArray[0]['Vod_Xltn_Tbl']['description'];
                        if ($vodXltnTblArray[0]['Vod_Xltn_Tbl']['language'])
                            $language = $vodXltnTblArray[0]['Vod_Xltn_Tbl']['language'];

                        $this->Movie->Create();
                        $insert_data = array("Movie" => array(
                                "sub_category_id" => $id,
                                "category_id" => $channel_result['Channel']['category_id'],
                                "bundle_id" => $channel_result['Channel']['bundleid'],
                                "channel_id" => $channel_result['Channel']['id'],
                                "published" => 0,
                                "cp" => "JJJ",
                                "telco_region" => "Maxis",
                                "title" => $vodTblArray[0]['Vod_Tbl']['movie_title'],
                                "image_thumb" => $vodTblArray[0]['Vod_Tbl']['image_thumb'],
                                "abr" => $vodTblArray[0]['Vod_Tbl']['abr_url'],
                                "rtsp_1" => $vodTblArray[0]['Vod_Tbl']['rtsp_low_bitrate'],
                                "rtsp_2" => $vodTblArray[0]['Vod_Tbl']['rtsp_high_bitrate'],
                                "type" => $vodDetailsTblArray[0]['Vod_Details_Tbl']['category'],
                                "director" => $vodDetailsTblArray[0]['Vod_Details_Tbl']['director'],
                                "cast" => $vodDetailsTblArray[0]['Vod_Details_Tbl']['cast'],
                                "genre" => $vodDetailsTblArray[0]['Vod_Details_Tbl']['genre'],
                                "subtitle" => $vodDetailsTblArray[0]['Vod_Details_Tbl']['subtitle'],
                                "duration" => $vodDetailsTblArray[0]['Vod_Details_Tbl']['duration'],
                                "description" => $description,
                                "language" => $language,
                                "credit" => '-',
                                "tag" => '-'
                            )
                        );
                        echo '<br><br>';
                        // print_r($insert_data);

                        if ($this->Movie->save($insert_data)) {
                            print_r("Inserted Succesfully<br>");
                        } else {
                            print_r("Insert failed<br>");
                        }
                    } else {
                        print_r("Duplicate Channel ID. So Skipping.....<br>");
                    }
                }
            } else {
                print_r("Empty Channel ID. So Skipping.....<br>");
            }
        }
    }

    private function getChannels() {
        $channel_results = $this->Channel->find('all', array(
            'fields' => array('id', 'bundleid', 'category_id', 'syqic_channel')
                )
        );
        return $channel_results;
    }

    private function getMovieList($channelDir) {
        $id_results = $this->Vod_Tbl->find('all', array(
            'fields' => array('syqic_movie_id'),
            'conditions' => array(
                array('channel_dir' => $channelDir),
                array('published' => 0)
            )
                )
        );
        return $id_results;
    }

    private function getVodTbl($id) {
        $vod_results = $this->Vod_Tbl->find('all', array(
            'fields' => array('syqic_movie_id', 'channel_dir', 'movie_title', 'bundle_id',
                'image_thumb', 'abr_url', 'rtsp_low_bitrate', 'rtsp_high_bitrate', 'channel_id'),
            'conditions' => array(
                array('syqic_movie_id' => $id)
            )
        ));
        return $vod_results;
    }

    private function getVodDetailsTbl($id) {
        $vod_details_results = $this->Vod_Details_Tbl->find('all', array(
            'fields' => array('director', 'cast', 'genre', 'subtitle', 'category', 'duration'),
            'conditions' => array(
                array('syqic_movie_id' => $id),
            )
        ));
        return $vod_details_results;
    }

    private function getVodXlTbl($id) {
        $vod_xltn_results = $this->Vod_Xltn_Tbl->find('all', array(
            'fields' => array('language', 'description'),
            'conditions' => array(
                array('syqic_movie_id' => $id),
                array('language' => 'en')
            )
        ));
        return $vod_xltn_results;
    }

    private function isDuplicate($channelId, $title) {
        echo '<br><br> Channel Id and Title<br>';
        print_r($channelId);
        print_r($title);
        $count = $this->Movie->find('count', array(
            'conditions' => array(
                array('channel_id' => $channelId),
                array('title' => $title),
                array('published' => '0'),
            )
        ));
        return $count;
    }

}

?>