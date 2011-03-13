<?php
/**
 * 
 * User controller
 * Contains registration, logging in, viewing, editing, and listing
 * @author Nero
 *
 */
class UsersController extends AppController {
	
	function beforeFilter() {
		parent::beforeFilter();
		
		// Custom auth fields, we use email for username
		$this->Auth->fields = array(
			'username' => 'email',
			'password' => 'password'
		);
		
		$this->Auth->autoRedirect = false;
		$this->Auth->allow(array('register', 'index'));
	}
	
	function login() {
		if($this->Auth->isAuthorized()) {
			$this->redirect($this->webroot);
		}
		
		if($this->Auth->user()) {
			
		} else {
			if(!empty($this->data)) {
				$this->Session->setFlash('Invalid username or password', 'error');
			}
		}
	}
	
	function logout() {
		if($this->Auth->logout())
			$this->redirect($this->webroot);
	}
	
	function register() {
		if($this->Auth->isAuthorized()) {
			$this->redirect($this->webroot);
		}
		
		if(!empty($this->data)) {
			$this->data['User']['password'] = $this->Auth->password($this->data['User']['passwd']);
			$this->User->set($this->data);
			if(!$this->User->validates()) {
				$this->Session->setFlash('Errors ocurred', 'error');
			} else {
				$this->data['User']['role_id'] = 1;
				if($this->User->save($this->data)) {
					$this->Session->setFlash('User created!');
					$this->redirect(array('controller' => 'users', 'action' => 'login'));
				}
			}
			/*if($this->User->save($this->data)) {
				$this->Session->setFlash('User created!');
			} else {
				$this->data['User']['password'] = '';
				$this->Session->setFlash('Errors occurred. Please try again.', 'error');
			}*/
		}
	}
	
	function view($id = null) {
		if($id == null) {
			$this->redirect(array('controller' => 'forums', 'action' => 'index'));
		}
		
		$user = $this->User->findById($id);
		$this->set(compact('user'));
	}
	
	/**
	 * 
	 * List users
	 */
	function index() {
		$users = $this->paginate($this->User);
		$this->set(compact('users'));
	}
	
	/**
	 * 
	 * Edit user information
	 * @param Int $id User ID in database
	 */
	function edit($id = null) {
		
		// Only admins and user itself are allowed to edit
		if($id == null) {
			$this->redirect(array('controller' => 'forums'));
		}
		
		if(($this->Auth->user('id') != $id && !$this->Auth->user('admin'))) {
			$this->redirect(array('action' => 'view', $id));
		}
		
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
		
		if(!empty($this->data)) {
			
			// Make sure that only admins can set user's roles
			if(!$this->Auth->user('admin')) {
				unset($this->data['User']['role_id']);
			}
			
			// Only save password if it was actually set
			if(strlen($this->data['User']['password'])) {
				$this->data['User']['password'] = $this->Auth->password($this->data['User']['password']);
			} else {
				unset($this->data['User']['password']);
			}
			
			$this->User->save($this->data);
			$this->Session->setFlash('User saved');
		}
		
		// Don't need group, it can grow huge
		$this->User->Role->unbindModel(array('hasAndBelongsToMany' => array('Group')), false);
		$this->data = $this->User->findById($id);			
	}
	
	/**
	 * @todo: Forgot password
	 */
	function forgot() {
		
	}
}