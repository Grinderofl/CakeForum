<?php
class AppController extends Controller {
	var $components = array('Auth', 'Session');
	var $helpers = array('Time', 'Html', 'Session', 'Form', 'Paginator');
	var $uses = array('User');
	
	function beforeRender() {
		
		/**
		 * Do multiple checks for user permissions if user has logged in 
		 */
		if($this->Auth->isAuthorized()) {
			
			$this->User->recursive = 2;
			
			// We don't want user included twice, for speed purposes
			$this->User->Role->unbindModel(array('hasMany' => array('User')));
			$auth = $this->User->findById($this->Auth->user('id'));
			$this->set('auth', $auth);
			
			$allowed = array();
			
			// All forums are allowed to admin by default
			if($auth['Role']['admin']) {
				
				// Set session admin
				$this->Session->write('Auth.User.admin', true);
				// Unbind unneeded models
				$this->User->Role->Group->unbindModel(array('hasAndBelongsToMany' => array('Role'), 'hasMany' => array('Forum')));
				$groups = $this->User->Role->Group->find('all', array('fields' => 'Group.id'));
				foreach($groups as $group) {
					$allowed[] = $group['Group']['id'];
				}
			} else {
				
				//Get the groups user's role is allowed to do anything with 
				if(count($auth['Role']['Group'])) {
					$allowed = array();
					foreach($auth['Role']['Group'] as $group) {
						$allowed[] = $group['GroupsRole']['group_id'];
					}
					
				}
			}
			$this->set('allowed', $allowed);
			
		} else {
			$this->set('auth', false);
		}
	}
	
	
	function beforeFilter() {
		//$this->Auth->allow('*');
	}
	
}