<?php
class TopicsController extends AppController {
	var $uses = array('Topic', 'Post', 'Forum');
	var $helpers = array('Paginator', 'Time', 'Bbcode');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('view'));
	}
	
	/**
	 * Create a new topic
	 */
	function create() {
		
		// Check if user is authorized and forum id is set
		// @todo: Check if user has rights to create anything in a forum
		if(!strlen($this->data['Topic']['forum_id']) || !$this->Auth->isAuthorized()) {
			$this->redirect(array('controller' => 'forums'));
		}
		
		if(isset($this->params['form']['submit'])) {
			
			// Set necessary variables, partially security reasons
			$this->data['Topic']['user_id'] = $this->Auth->user('id');
			$this->data['Post'][0]['user_id'] = $this->Auth->user('id');
			$this->data['Post'][0]['forum_id'] = $this->data['Topic']['forum_id'];
			
			if(!$this->Topic->saveAll($this->data, array('validate' => 'only'))) {
				$this->Session->setFlash('Validation errors', 'error');				
			} else {
				if($this->Topic->saveAll($this->data))
					$this->Session->setFlash('Topic created');
					$this->redirect(array('controller' => 'topics', 'action' => 'view', $this->Topic->id));
			}
		}
		$this->set('forum', $this->Forum->findById($this->data['Topic']['forum_id']));
	}
	
	/**
	 * View a topic
	 * @param Int $topic  Topic's ID
	 */
	function view($topic = null) {
		if($topic == null) {
			if(strlen($_SERVER['HTTP_REFERER'])) {
				$this->redirect($_SERVER['HTTP_REFERER']);
			} else {
				$this->redirect(array('controller' => 'forums'));
			}
		}
		
		$this->Topic->id = $topic;
		$this->Post->recursive = 2;
		
		// @todo Custom limit on posts per page
		$this->paginate = array(
			'conditions' => array('Post.topic_id' => $topic),
			'limit' => 20
		);
		$conditions = array('Post.topic_id' => $topic);
		
		$posts = $this->paginate('Post', $conditions);		
		$this->set(compact('posts'));
		$this->set('forum', $this->Forum->findById($this->Topic->field('forum_id')));
		$this->Topic->recursive = 0;
		$this->set('topic', $this->Topic->findById($topic));
	}
}