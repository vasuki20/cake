<?php
App::uses('AppModel', 'Model');
App::import('model','MoTbl');
class MoTblsController  extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {

		$this->set('MoTbls', $this->MoTbl->find('all', array(
    'limit' => 3,
	'recursive' => 1,
    'order' => 'MoTbl.created DESC',
)));
    }

    public function add() {
        if ($this->request->is('post')) {
            $saveData=$this->request->data;
            $telcoId = $saveData['MoTbl']['telcoId'];
            $subscriberId = $saveData['MoTbl']['subscriberId'];
            $msisdn = $saveData['MoTbl']['msisdn'];
            $moId = $saveData['MoTbl']['moId'];
            $moLinkId = $saveData['MoTbl']['moLinkId'];
            $apiUserId = $saveData['MoTbl']['apiUserId'];
            $txnId = $saveData['MoTbl']['txnId'];
            $keyword = $saveData['MoTbl']['keyword'];
            $request = $saveData['MoTbl']['request'];
            $response = $saveData['MoTbl']['response'];
            $this->log($this->request->data, 'debug');

            $status = $this->MoTbl->addMO($telcoId, $subscriberId, $msisdn, $moId, $moLinkId, $apiUserId, $txnId, $keyword, $request, $response);

            if ($status === 1) {
                $this->Session->setFlash(__('Your MoTbl has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Unable to add your MoTbl.'));
            }
        }
        /* if ($this->request->is('post')) {
          $this->MoTbl->create();
          $this->log($this->request->data, 'debug');
          if ($this->MoTbl->save($this->request->data)) {
          $this->Session->setFlash(__('Your MoTbl has been saved.'));
          return $this->redirect(array('action' => 'index'));
          }
          $this->Session->setFlash(__('Unable to add your MoTbl.'));
          } */
    }

    public function edit($id = null) {
    if (!$id) {
        throw new NotFoundException(__('Invalid post'));
    }

    $post = $this->MoTbl->findById($id);
    if (!$post) {
        throw new NotFoundException(__('Invalid post'));
    }

    if ($this->request->is(array('post', 'put'))) {
        $this->MoTbl->id = $id;
        if ($this->MoTbl->save($this->request->data)) {
            $this->Session->setFlash(__('Your post has been updated.'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to update your post.'));
    }

    if (!$this->request->data) {
        $this->request->data = $post;
    }
}
}
?>