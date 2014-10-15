<?php
class Post extends AppModel {
 public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
 public function isOwnedBy($post, $customer) {
    return $this->field('id', array('id' => $customer, 'user_id' => $customer)) !== false;
}
}

?>