<?php

App::uses('AppController', 'Controller');

/**
 * Reports Controller
 *
 * @property Report $Report
 */
class MovieInjectorController extends AppController {
    
    var $uses = array('Vod_Tbl', 'Channel_Tbl', 'Channel_Txl_Tbl', 'Movie', 'Vod_Details_Tbl', 'Vod_Xltn_Tbl');

    public function injectMovies() {
        $this->autoRender = false;
        $id_results = $this->getMovieList();
        $this->log('injectMovies', 'debug');
        foreach ($id_results as $id_result) {
            $id = $id_result['Vod_Tbl']['syqic_movie_id'];
//            print_r($id);
            $channelTblArray = $this->getChannelTbl($id);
            print_r("<br>");
//            print_r($channelTblArray);

            if ($channelTblArray[0]['Channel_Tbl']['channel_id']) {
                $vodTblArray = $this->getVodTbl($id);
//            print_r($vodTblArray);
                $vodDetailsTblArray = $this->getVodDetailsTbl($id);
//            print_r($vodDetailsTblArray);

                $vodXltnTblArray = $this->getVodXlTbl($id);
            print_r($vodXltnTblArray);
                $this->Movie->Create();
                $insert_data = array("Movie" => array(
                        "sub_category_id" => $id,
                        "category_id" => $channelTblArray[0]['Channel_Tbl']['category_id'],
                        "bundle_id" => $channelTblArray[0]['Channel_Tbl']['bundle_id'],
                        "channel_id" => $channelTblArray[0]['Channel_Tbl']['channel_id'],
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
                        "description" => $vodXltnTblArray[0]['Vod_Xltn_Tbl']['description'],
                        "language" => $vodXltnTblArray[0]['Vod_Xltn_Tbl']['language'],
                        "credit" => '-',
                        "tag" => '-'
                    )
                );
                echo '<br><br>';
                print_r($insert_data);

                if ($this->Movie->save($insert_data)) {
                    $this->Session->setFlash(__('Your User has been saved.'));
                }
            } 
            else {
                print_r("Empty Channel ID. So Skipping.....");
                print_r($insert_data);
            }
        }
    }

    private function getMovieList() {
        $id_results = $this->Vod_Tbl->find('all', array(
            'fields' => array('syqic_movie_id')
                )
        );
        return $id_results;
    }

    private function getChannelTbl($id) {
        $channel_results = $this->Channel_Tbl->find('all', array(
            'fields' => array('channel_id', 'category_id', 'bundle_id', 'syqic_channel'),
            'conditions' => array(
                array('syqic_channel_id' => $id),
            )
        ));
        return $channel_results;
    }

    private function getVodTbl($id) {
        $vod_results = $this->Vod_Tbl->find('all', array(
            'fields' => array('syqic_movie_id', 'channel_dir', 'movie_title', 'bundle_id',
                'image_thumb', 'abr_url', 'rtsp_low_bitrate', 'rtsp_high_bitrate', 'channel_id'),
            'conditions' => array(
                array('syqic_movie_id' => $id),
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

}

?>