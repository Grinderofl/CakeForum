<?php 

class ForumsController extends AppController {
	var $uses = array('Topic', 'Forum');
	var $helpers = array('Time', 'Bbcode', 'ForumFunctions');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('news', 'view', 'index'));
	}
	
	/**
	 * List forums
	 */
	function index() {
		$forums = $this->paginate($this->Forum);
		$this->set(compact('forums'));
	}
	
	/**
	 * Front page news
	 */
	function news() {
		//$this->Topic->recursive = 2;
		$this->Topic->unbindModel(array('hasMany' => array('Post'), 'belongsTo' => array('Forum')), false);
		$this->Topic->bindModel(array('hasMany' => array(
			'Post' => array(
				'foreignKey' => 'topic_id',
				'limit' => 1,
				'order' => 'Post.created ASC'
			)
		)), false);
		
		$conditions = array(
			'Topic.forum_id' => 1,
		);
		
		$this->paginate = array(
			'order' => 'Topic.id DESC',
			'limit' => 5,
		);
		$news = $this->paginate($this->Topic, $conditions);
		
		$this->set('news', $news);
	}
	
	function view($id = null) {
		if($id == null) {
			$this->redirect(array('action' => 'index'));
		}
		$this->Topic->recursive = 2;
		$this->Topic->unBindModel(array('hasMany' => array('Post')), false);
		$this->Topic->bindModel(array('hasMany' => array(
			'Post' => array(
				'foreignKey' => 'topic_id',
				'limit' => 1,
				'order' => 'Post.created DESC'
			)
		)), false);
		//$this->Topic->User->unbindModel(array('belongsTo' => array('Role')), false);
		$this->Topic->Post->unbindModel(array('belongsTo' => array('Topic', 'Forum')), false);
		$this->Topic->unBindModel(array('belongsTo' => array('Forum')), false);
		$this->paginate = array(
			'order' => 'Topic.id DESC',
			'limit' => 20
		);
		$topics = $this->paginate($this->Topic, array('Topic.forum_id' => $id));
		//$topics = $this->Topic->find('all', array('conditions' => array('Topic.forum_id' => $id), 'order' => 'Topic.id DESC'));//$this->paginate($this->Topic, array('Topic.forum_id' => $id));
		$this->set(compact('topics'));
		$this->set('forum', $this->Forum->findById($id));
	}
}