<?php

class Newest extends AppModel {
	var $useTable = 'posts';
	
	var $order = 'Newest.id DESC';
	//var $limit = '1';
	
	var $belongsTo = array(
		'Topic' => array(
			'className' => 'Topic',
			'foreignKey' => 'topic_id'
		)
	);
}