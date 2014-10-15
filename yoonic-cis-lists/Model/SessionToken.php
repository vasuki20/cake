<?php
App::uses('AppModel', 'Model');
/**
 * SessionToken Model
 *
 */
class SessionToken extends AppModel {
	
	public function purge() {
		return $this->deleteAll(true);
	}
	
}
