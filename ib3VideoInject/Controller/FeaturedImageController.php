<?php

class FeaturedImageController extends AppController {

    public $components = array('Paginator', 'Session');
    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'FeaturedImage.id' => 'asc'
        )
    );
    var $uses = array('FeaturedImage');

    public function displayfeaturedimage() {
        $this->Paginator->settings = $this->paginate;
// query database and sort results
        //$data = $this->Movie->find('all', array('limit' => 100));
        $data = $this->Paginator->paginate('FeaturedImage');
        // Search Action// 
        $this->set('movies', $data);

// get a count from the database
        $count = $this->FeaturedImage->find('count');
        $this->set('count', $count);
    }

    public function display() {
        if ($this->request->is('post')) {
            if ($this->data['Image']) {
                $image = $this->data['Image']['image'];
                //allowed image types
                $imageTypes = array("image/gif", "image/jpeg", "image/png", "image/pjpeg", "image/x-png");
                //upload folder - make sure to create one in webroot
                $uploadFolder = "uploadimage";
                //full path to upload folder
                $uploadPath = "C:\xampp\htdocs\img" . $uploadFolder;


                //check if image type fits one of allowed types
                foreach ($imageTypes as $type) {
                    if ($type == $image['type']) {
                        //check if there wasn't errors uploading file on serwer
                        if ($image['error'] == 0) {
                            //image file name
                            $imageName = $image['name'];
                            //check if file exists in upload folder
                            if (file_exists($uploadPath . '/' . $imageName)) {
                                //create full filename with timestamp
                                $imageName = date('His') . $imageName;
                            }
                            //create full path with image name
                            $full_image_path = $uploadPath . '/' . $imageName;
                            //upload image to upload folder
                            if (move_uploaded_file($image['tmp_name'], $full_image_path)) {
                                $this->Session->setFlash('File saved successfully');
                                $this->set('imageName', $imageName);
                            } else {
                                $this->Session->setFlash('There was a problem uploading file. Please try again.');
                            }
                        } else {
                            $this->Session->setFlash('Error uploading file.');
                        }
                        break;
                    } else {
                        $this->Session->setFlash('Unacceptable file type');
                    }
                }
            }
        }
        $this->render('display');
    }

    public function delete($id) {
        print_r('Inside delete');
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->FeaturedImage->delete($id)) {
            $this->Session->setFlash(
                    __('The post with id: %s has been deleted.', h($id))
            );
            return $this->redirect(array('controller' => 'MoviesContent', 'action' => 'displaymovies', 'featured_image'));
        }
    }

}

?>