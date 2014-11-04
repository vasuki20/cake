


<?php

App::uses('AppController', 'Controller', 'Configure');

/**
 * Consumptions Controller
 *
 * @property Consumption $Consumption
 */
class SearchvideosController extends AppController {

    public function injectMovies() {
        $this->Searchvideo->create();
        $this->Searchvideo->save(
                array(
                    'kind' => 'youtube#searchResult',
                    'etag' => 'PSjn-HSKiX6orvNhGZvglLI2lvk/XYsEWKreS5KNfLVLEzu_gvCTGBk',
                    'id_kind' => 'youtube#channel',
                    'videoId' => 'UCvrhwpnp2DHYQ1CbXby9ypQ',
                    'publishedAt' => '',
                    'channelId' => 'UCvrhwpnp2DHYQ1CbXby9ypQ',
                    'title' => 'Vijay Television',
                    'description' => 'is a leading tamil language entertainment channel broadcasting innovative shows & programs from India. Vijay TV is part of the STAR .',
                    'thumbnails_default' => 'https://lh5.googleusercontent.com/-CIlMsfFi4d4/AAAAAAAAAAI/AAAAAAAAAAA/zRGI_ZReTq4/photo.jpg',
                    'thumbnails_medium' => 'https://lh5.googleusercontent.com/-CIlMsfFi4d4/AAAAAAAAAAI/AAAAAAAAAAA/zRGI_ZReTq4/photo.jpg',
                    'thumbnails_high' => 'https://lh5.googleusercontent.com/-CIlMsfFi4d4/AAAAAAAAAAI/AAAAAAAAAAA/zRGI_ZReTq4/photo.jpg',
                    'channelTitle' => 'STARVIJAY',
                    'liveBroadcastContent' => 'none'
                )
        );
    }

}
?>




