<?php
App::uses('AppController', 'Controller');

/**
 * Reports Controller
 *
 * @property Report $Report
 */
class InjectMoviesController extends AppController {

    var $uses = array('Vod_Tbl', 'Channel_Tbl', 'Channel_Txl_Tbl', 'Movie', 'Vod_Details_Tbl', 'Vod_Xltn_Tbl', 'Channel');

    public function injectMovies() {
        
    }

}