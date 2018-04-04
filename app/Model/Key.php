<?php
App::uses('AppModel', 'Model');
class Key extends AppModel {
	public $belongsTo = array(
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id',
		),
	);
}