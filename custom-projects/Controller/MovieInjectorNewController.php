<?php

App::uses('AppController', 'Controller');

/**
 * Reports Controller
 *
 * @property Report $Report
 */
class MovieInjectorNewController extends AppController {

    var $uses = array('Vod_Tbl', 'Channel_Tbl', 'Channel_Txl_Tbl', 'Movie', 'Vod_Details_Tbl', 'Vod_Xltn_Tbl', 'Channel');

    public function injectMovies() {
        $this->autoRender = false;
        $channel_dtl_results = $this->getChannelsDetails();
        //  print_r($channel_dtl_results);
        $count1 = 0;
        $count2 = 0;
        foreach ($channel_dtl_results as $channel_dtl_result) {
            $count1++;
            $m_syqic_id = $channel_dtl_result['Channel']['syqic_channel'];
            $m_bundle_id = $channel_dtl_result['Channel']['bundleid'];
            $m_cp = "JJJ";
            $m_telcoregion = "Maxis";
            $m_catid = $channel_dtl_result['Channel']['category_id'];
            $m_channelid = $channel_dtl_result['Channel']['id'];


            $vod_id_results = $this->getVodTbl($m_syqic_id);
        //    print_r($vodTblId);
            foreach ($vod_id_results as $vod_id_result) {
                
                $vod_contents = $this->getVodContent($m_channelid);
                 print_r($vod_contents);	

                $m_syqicmovieid = $vod_contents['Vod_Tbl']['syqic_movie_id'];

                $m_title = $vod_contents['Vod_Tbl']['movie_title'];
                
                $duplicate_results = $this->getDuplicate($m_channelid,$m_title);
                
                 foreach ($duplicate_results as $duplicate_result) {
                     if($duplicate_results[0]==0){
                         echo "<br>---Not Duplicate &#2433; ----$$duplicate_results[0]";
						//$m_bundleid = 		$vod_result[3];
						$count2++;
						
                     }
                 }
                 
            }
        }
    }

    private function getChannelsDetails() {
        $channel_results = $this->Channel->find('all', array(
            'fields' => array('id', 'category_id', 'bundleid', 'syqic_channel')
                )
        );
        return $channel_results;
    }

    private function getVodTbl($id) {
        $vod_results = $this->Vod_Tbl->find('all', array(
            'fields' => array('syqic_movie_id'),
            'conditions' => array(
                array('channel_dir' => $id),
            )
        ));
        return $vod_results;
    }

    private function getVodContent($id) {
        $vod_content = $this->Vod_Tbl->find('all', array(
            'fields' => array('syqic_movie_id', 'channel_dir', 'movie_title', 'bundle_id',
                'image_thumb', 'abr_url', 'rtsp_low_bitrate', 'rtsp_high_bitrate', 'channel_id'),
            'conditions' => array(
                array('syqic_movie_id' => $id),
            )
        ));
        return $vod_content;
    }
    
     private function getDuplicate($channelId,$title) {
        $vod_content = $this->Movie->find('count', array(
            'conditions' => array(
                array('channel_id' => $channelId),
                array('$m_title' => $title),
                array('published' => '0'),
            )
        ));
        return $vod_content;
    }

}

?>
