<?php
class Post extends AppModel {
	
	var $belongsTo = array(
		'Topic' => array(
			'className' => 'Topic', 
			'foreignKey' => 'topic_id',
			'counterCache' => true,
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'counterCache' => true
		),
		'Forum' => array(
			'className' => 'Forum',
			'foreignKey' => 'forum_id'
		)
	);
	
}