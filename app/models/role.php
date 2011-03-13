<?php
class Role extends AppModel {
	var $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'role_id'
		)
	);
	
	var $hasAndBelongsToMany = array(
		'Group' => array(
			'className' => 'Group',
			'joinTable' => 'groups_roles',
			'foreignKey' => 'role_id',
			'associationForeignKey' => 'group_id'
		)
	);
}