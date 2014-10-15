<?php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class User extends AppModel {

    public $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'Role',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Isactive' => array(
            'className' => 'Isactive',
            'foreignKey' => 'IsActive',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Telconame' => array(
            'className' => 'Telconame',
            'foreignKey' => 'TelcoName',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
    public function beforeSave($options = array()) {
    if (isset($this->data[$this->alias]['password'])) {
        $passwordHasher = new BlowfishPasswordHasher();
        $this->data[$this->alias]['password'] = $passwordHasher->hash(
            $this->data[$this->alias]['password']
        );
    }
    return true;
}

}

?>
