<?php
class Group extends AppModel {
	var $hasMany = array(
		'Forum' => array(
			'className' => 'Forum',
			'foreignKey' => 'group_id'
		)
	);
	
	var $hasAndBelongsToMany = array(
		'Role' => array(
			'className' => 'Role',
			'joinTable' => 'groups_roles',
			'foreignKey' => 'role_id',
			'associationForeignKey' => 'group_id'
		)
	);
}