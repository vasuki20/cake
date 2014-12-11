<?php

//ini_set('max_execution_time', 300);
//ini_set('memory_limit', '-1');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppController', 'Controller');
App::import('Controller', 'FeaturedImage');

class MoviesContentController extends AppController {

    public $components = array('Paginator', 'Session');
    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'MoviesContent.Title' => 'asc'
        )
    );
    var $uses = array('MoviesContent', 'MoviesFree', 'MoviesNew', 'MoviesHot', 'FeaturedImage');

    public function displaymovies($fromtablename) {
        // $this->render('FeaturedImage/displayfeaturedimage');
        $this->Paginator->settings = $this->paginate;
// query database and sort results
        //$data = $this->Movie->find('all', array('limit' => 100));
        $data = $this->Paginator->paginate('MoviesContent');
        // Search Action//       
        if ($this->request->is('post')) {
            if ($this->request->data) {
                $this->log($this->request->data['MoviesContent']['SearchParam'], 'debug');
                $searchParam = $this->request->data['MoviesContent']['SearchParam'];
                $this->Paginator->settings = array(
                    'conditions' => array('MoviesContent.title LIKE' => '%' . $searchParam . '%'),
                    'limit' => 10);
                $data = $this->Paginator->paginate('MoviesContent');
            } else {
                $this->Session->setFlash(__('Invalid Request'));
            }
        }

        $this->set('movies', $data);

// get a count from the database
        $count = $this->MoviesContent->find('count');
        $this->set('count', $count);
        $this->set('fromtablename', $fromtablename);
    }

    public function select($id = NULL, $fromtablename = NULL) {
        $error = 0;
        if (!$id) {
            throw new NotFoundException(__("ID was not set."));
        }
        // search the database based on the id (primary key) of the item 
        $data = $this->MoviesContent->findById($id);
        if (!$data) {
            throw new NotFoundException(__("ID was not in the Database."));
        }
        if ($this->request->is('post')) {
            //print_r($this->request->data);
            $redirectController;
            $redirectAction;
            $redirectMsg;
            $movieData;
            $this->log($this->request->data, 'debug');
            $movieData = array(
                'movie_id' => $this->request->data['MoviesContent']['id']
            );
            if ($this->request->data['MoviesContent']['target'] == "movies_free") {
                $this->MoviesFree->create();
                $this->MoviesFree->save($movieData);
                $redirectController = 'MoviesFree';
                $redirectAction = 'displaymoviesfree';
                $redirectMsg = 'Movie added succefully to MovieFree table';
            } else if ($this->request->data['MoviesContent']['target'] == "movies_hot") {
                $this->MoviesHot->create();
                $this->MoviesHot->save($movieData);
                $redirectController = 'MoviesHot';
                $redirectAction = 'displaymovieshot';
                $redirectMsg = 'Movie added succefully to MovieHot table';
            } else if ($this->request->data['MoviesContent']['target'] == "movies_new") {
                $this->MoviesNew->create();
                $this->MoviesNew->save($movieData);
                $redirectController = 'MoviesNew';
                $redirectAction = 'displaymoviesnew';
                $redirectMsg = 'Movie added succefully to MovieNew table';
            } else if ($this->request->data['MoviesContent']['target'] == "featured_image") {
                /*
                 * Uploading image to the server 
                 */

                if ($this->data['MoviesContent']['image']) {
                    $image = $this->data['MoviesContent']['image'];
                    //  print_r($image);
                    //allowed image types
                    // $imageTypes = array("image/gif", "image/jpeg", "image/png", "image/pjpeg", "image/x-png", "image/jpg");
                    $imageTypes = array("image/jpg");
                    //upload folder - make sure to create one in webroot
                    $uploadFolder = 'C:\xampp\htdocs\img\\';
                    //full path to upload folder
                    //  $uploadPath = 'http://mobile.e1.sg/' . $uploadFolder;
                    //check if image type fits one of allowed types
                    foreach ($imageTypes as $type) {
                        //check if there wasn't errors uploading file on serwer
                        if ($image['error'] == 0) {
                            //image file name
                            $imageName = $image['name'];
                            //check if file exists in upload folder
                            // print_r($imageName);
//                            if (file_exists($uploadPath . '/' . $imageName)) {
//                                //create full filename with timestamp
//                                $imageName = date('His') . $imageName;
//                                print_r($imageName);
//                            }
                            //create full path with image name
                            $full_image_path = $uploadFolder . $imageName;
                            print_r($full_image_path);
                            $this->log($full_image_path, 'debug');
                            $this->log($imageName, 'debug');
                            $full_image_url = "http://mobile.e1.sg/" . $imageName;
                            //upload image to upload folder
                            if (move_uploaded_file($image['tmp_name'], $full_image_path)) {
                                $this->Session->setFlash('File saved successfully');
                                $this->set('imageName', $imageName);
                            } else {
                                $redirectMsg = 'There was a problem uploading file. Please try again.';
                                $error = 1;
                            }
                        } else {
                            $redirectMsg = 'Error uploading file.';
                            $error = 1;
                        }
                        break;
                    }
                } else {
                    $redirectMsg = 'Please select a file';
                    $error = 1;
                }

                /*
                 * End of image upload
                 */

                if ($error != 1) {
                    $movieData = array(
                        'movie_id' => $this->request->data['MoviesContent']['id'],
                        'img_url' => $full_image_url,
                    );
                    $this->FeaturedImage->create();
                    $this->FeaturedImage->save($movieData);
                    $redirectMsg = 'Image added succefully to FeaturedImage table';
                    $this->Session->setFlash(__($redirectMsg));
                }
                $redirectController = 'FeaturedImage';
                $redirectAction = 'displayfeaturedimage';
            }
            $this->Session->setFlash(__($redirectMsg));
            return $this->redirect(array('controller' => 'MoviesContent', 'action' => 'displaymovies', 'featured_image'));
        }

        // set the variable to display the query results
        $this->set('movie', $data);
        $this->set('fromtablename', $fromtablename);
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->MoviesContent->findById($id);
        if (!$moviescontent) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('moviescontent', $moviescontent);
    }

}

?>
