<?php
App::uses('AppController', 'Controller', 'Configure');

/**
 * Subscribers Controller
 *
 * @property Subscriber $Subscriber
 */
class SubscribersController extends AppController {
     public $components = array('Paginator');
      public $paginate = array(
        'limit' => 10,
        'order' => array(
            'Subscriber.id' => 'asc'
        )
    );
    
 public $helpers = array('Html', 'Form');

    public function index() {
        $this->Paginator->settings = $this->paginate;

        
        if ($this->request->is('post')) {
            $this->log($this->request->data['Subscriber']['SearchParam'], 'debug');
            if ($this->request->data) {
                $searchParam=$this->request->data['Subscriber']['SearchParam'];
                $this->Paginator->settings = array(
                    'conditions' => array('Subscriber.msisdn LIKE' => '%'.$searchParam.'%'),
                    'limit' => 10,
                    'order' => array(
                        'Subscriber.id' => 'asc'
                    )
                );
            } else {
                $this->Session->setFlash(__('Invalid Request'));
            }
        }
        // similar to findAll(), but fetches paged results
        $data = $this->Paginator->paginate('Subscriber');
        $this->log($data, 'debug');
        $this->set('Subscribers', $data);
        //  $this->set('Subscribers', $this->Subscriber->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $Subscribers = $this->Subscriber->findById($id);
        if (!$Subscribers) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('Subscriber', $Subscribers);
        
}

public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $subscriber = $this->Subscriber->findById($id);
        $this->log($subscriber, 'debug');
        if (!$subscriber) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Subscriber->id = $id;
            if ($this->Subscriber->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $subscriber;
        }
    }

}
