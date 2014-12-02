<?php
App::uses('AppModel', 'Model');
class Movie extends AppModel {
    var $name = 'Movie';
    var $useDbConfig = 'default';
    var $useTable = 'movies';   
}
?>

