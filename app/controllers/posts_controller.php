<?php
class PostsController extends AppController {
	
	function create() {
		if(!$this->Auth->isAuthorized()) {
			$this->redirect(array('controller' => 'forums'));
		}
		if(!empty($this->data) && strlen($this->data['Post']['post'])) {
			$this->set('data', $this->data);
			if(!strlen($this->data['Post']['topic_id']) || !strlen($this->data['Post']['forum_id'])) {
				$this->redirect(array('controller' => 'forums'));
			}
			
			$this->data['Post']['user_id'] = $this->Auth->user('id');
			
			if($this->Post->validates($this->data)) {
				if($this->Post->save($this->data)) {
					$id = $this->Post->id;
					$this->Session->setFlash('Reply posted');
					$this->redirect(array('controller' => 'topics', 'action' => 'view', $this->data['topic_id']."#{$id}"));
				}
				
			}
		} else {
			$this->redirect(array('controller' => 'forums'));
		}
	}
	
	function edit($id = null) {
		if($id == null || !$this->Auth->isAuthorized()) {
			$this->redirect(array('controller' => 'forums'));
		}
		
		$this->Post->id = $id;
		if($this->Post->field('user_id') != $this->Auth->user('id')) {
			$this->redirect(array('controller' => 'forums'));
		}
		
		if(!empty($this->data)) {
			if($this->Post->save($this->data, array('validate' => 'only'))) {
				$this->Post->save($this->data);
				$this->Session->setFlash('Post saved');
				$this->redirect(array('controller' => 'topics', 'action' => 'view', $this->Post->field('topic_id')));
			}
		}
		
		$this->data = $this->Post->findById($id);
	}
}