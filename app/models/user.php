<?php
class User extends AppModel {
	var $validate = array(
		'email' => array(
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'E-mail is already in use'
			),
			'email' => array(
				'rule' => 'email',
				'message' => 'E-mail doesn\'t validate'
			)
		),
		'passwd' => array(
			'rule' => array('minLength', '3'),
			'message' => 'Minimum 3 characters long'
		),
		'handle' => array(
			'rule' => '/^[a-z]{2,}$/i',
			'message' => 'Only letters allowed, min 2 characters'
		)
	);
	
	var $belongsTo = array(
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id'
		)
	);
	

}