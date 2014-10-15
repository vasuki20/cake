<?php
App::uses('AppModel', 'Model');
App::import('model','MtTbl');
class MtTblsController  extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {

		$this->set('MtTbls', $this->MtTbl->find('all', array(
    'limit' => 3,
	'recursive' => 1,
    'order' => 'MtTbl.created DESC',
)));
    }

    
    public function add() {
        if ($this->request->is('post')) {
            $saveData=$this->request->data;
            $telcoId = $saveData['MtTbl']['telcoId'];
            $subscriberId = $saveData['MtTbl']['subscriberId'];
            $msisdn = $saveData['MtTbl']['msisdn'];
            $mtId = $saveData['MtTbl']['mtId'];
            $moId = $saveData['MtTbl']['moId'];
            $moLinkId = $saveData['MtTbl']['moLinkId'];
            $dnId = $saveData['MtTbl']['dnId'];
            $apiUserId = $saveData['MtTbl']['apiUserId'];
            $txnId = $saveData['MtTbl']['txnId'];
            $keyword = $saveData['MtTbl']['keyword'];
            $request = $saveData['MtTbl']['request'];
            $response = $saveData['MtTbl']['response'];
            $this->log($this->request->data, 'debug');

            $status = $this->MtTbl->addMT($telcoId, $subscriberId, $msisdn, $mtId, $moId, $moLinkId, $dnId, $apiUserId, $txnId, $keyword, $request, $response);

            if ($status === 1) {
                $this->Session->setFlash(__('Your MtTbl has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Unable to add your MtTbl.'));
            }
        }
    }
    /*
	public function add() {
        if ($this->request->is('post')) {
            $this->MtTbl->create();
			$this->log($this->request->data, 'debug');
            if ($this->MtTbl->save($this->request->data)) {
                $this->Session->setFlash(__('Your MtTbl has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your MtTbl.'));
        }
    }
	*/
	public function edit($id = null) {
    if (!$id) {
        throw new NotFoundException(__('Invalid post'));
    }

    $post = $this->MtTbl->findById($id);
    if (!$post) {
        throw new NotFoundException(__('Invalid post'));
    }

    if ($this->request->is(array('post', 'put'))) {
        $this->MtTbl->id = $id;
        if ($this->MtTbl->save($this->request->data)) {
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