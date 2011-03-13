<?php
class Forum extends AppModel {
	var $order = 'Forum.order ASC';
	
	var $hasMany = array (
		'Topic' => array(
			'className' => 'Topic',
			'foreignKey' => 'forum_id',
		)
	);
	
	var $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id'
		)
	);
}