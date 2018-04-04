<?php
App::uses('AppModel', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class Account_type extends AppModel {
	public $hasMany = array(
		'Account' => array(
			'className' => 'Account',
			'conditions' => array(
				'Account.disable' => 0,
			)
		),
		/*
		'Consultant' => array(
			'className' => 'Consultant',
			'conditions' => array(
				'Consultant.account_type_id' => 1,
				'Consultant.disable' => 0,
			)
		)
		*/
	);
}