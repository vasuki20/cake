<?php

App::uses('AppController', 'Controller');

/**
 * Reports Controller
 *
 * @property Report $Report
 */
class MovieparserController extends AppController {

    public function parse() {
        $this->autoRender = false;
        $url = 'https://54.254.131.243/secureapi/contentLibrary/moviesAndChannels/lastDump';
        //ini_set('max_execution_time', 900);

        $username = 'api-content-uer';
        $password = 'y00n1cc0ntent';

        echo 'hi';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 900);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 900);
        
        $json = curl_exec($ch);
        echo $json;
        $errmsg = curl_error($ch);
        echo $errmsg;
        $cInfo = curl_getinfo($ch);
        echo $cInfo;
        curl_close($ch);

        $data = json_decode($json, true);
        
        
        $arr = array('Channel_Table' => array('Title' => 'Kathi', 'Id' => 'Kathi', 'asvgdh' => 'Kathi'));
        echo '<br>';
        print_r($arr);
        echo '<br>after data';
    }

}
?>

