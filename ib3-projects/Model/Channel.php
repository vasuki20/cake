<?php
App::uses('AppModel', 'Model');
class Channel extends AppModel {
    var $name = 'Channel';
    var $useDbConfig = 'video';
    var $useTable = 'vod_details';   
}
?>
