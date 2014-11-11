<?php
App::uses('AppModel', 'Model');
class Movie extends AppModel {
    var $name = 'Movie';
    var $useDbConfig = 'injector';
    var $useTable = 'movies';   
}
?>

