<?php
App::uses('AppController', 'Controller');
// We need to load the class

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MovieparserController extends AppController {
    
    public function parse(){
         $this->autoRender = false;
         ini_set('max_execution_time', 900);
 $url = 'https://54.254.131.243/secureapi/contentLibrary/moviesAndChannels/lastDump';

$username = 'api-content-user';
$password = 'y00n1cc0ntent';


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$json = curl_exec($ch);
if(curl_errno($ch)){
    echo 'Request Error:' . curl_error($ch);
}
curl_close($ch);

$data = json_decode($json, true);
    }
}
?>


