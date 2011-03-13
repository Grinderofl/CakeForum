<?php

class Topic extends AppModel {
	
	var $validate = array(
		'title' => array(
			'rule' => array('minLength', '1'),
			'message' => 'Topic must have a title'
		)
	);
	
	var $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'topic_id'
		)
	);
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'counterCache' => true
		),
		'Forum' => array(
			'className' => 'Forum',
			'foreignKey' => 'forum_id',
			'counterCache' => true
		)
	);
}
