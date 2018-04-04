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
class Account extends AppModel {
	
	// Set relation
	public $hasOne = array(
		'Avatar',
		'Contact',
		//'Subscribe'
	);
	public $hasMany = array(
		'Search' => array(
			'className' => 'Search',
			'conditions' => array(
				'Search.disable' => 0
			)
		),
		'Contact_info' => array(
			'className' => 'Contact_info',
			'conditions' => array(
				'Contact_info.company_id' => 0,
				'Contact_info.disable' => 0
			)
		),
		/*
		'Resume' => array(
			'className' => 'Resume',
			'conditions' => array(
				'Resume.disable' => 0
			)
		),
		*/
		'Profile' => array(
			'className' => 'Profile',
			'conditions' => array(
				'Profile.disable' => 0
			)
		),
		/*
		'Skill' => array(
			'className' => 'Skill',
			'conditions' => array(
				'Skill.disable' => 0
			)
		),
		'Promotion' => array(
			'className' => 'Promotion',
			'conditions' => array(
				'Promotion.disable' => 0
			)
		),
		*/
		'Card' => array(
			'className' => 'Card',
			'conditions' => array(
				'Card.disable' => 0
			)
		),
		/*
		'Apply' => array(
			'className' => 'Apply',
			'conditions' => array(
				'Apply.disable' => 0
			)
		),
		*/
		'Key' => array(
			'className' => 'Key',
			'conditions' => array(
				'Key.disable' => 0
			)
		),
	);
	public $belongsTo = array(
		'Account_type' => array(
			'className' => 'Account_type',
			'foreignKey' => 'account_type_id'
		),
		'Company' => array(
			'className' => 'Company',
			'foreignKey' => 'company_id'
		),
		
	);
	
	// Set validation
	public $validate = array(
		'username' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty.'
			),
			'regex' => array(
				'rule' => '/^[0-9a-zA-Z_-]*$/i',
				'message' => 'Please only fill out: Letter, Number, Underline, Dash.'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This username registry already.'
			),
			'lengthBetween' => array(
				'rule' => array('lengthBetween', 8, 25),
				'message' => 'Length must between 8 and 25 characters.'
			)
		),
		'password' => array(
			'regex' => array(
				'rule' => '/^[0-9a-zA-Z_-]{8,16}$/i',
				'message' => 'Please only fill out: Letter, Number, Underline, Dash and Length from 8 to 16.'
			),
			'lengthBetween' => array(
				'rule' => array('lengthBetween', 8, 25),
				'message' => 'Length must between 8 and 25 characters.'
			)
		),
		'email' => array(
			'email' => array(
				'rule' => 'email',
				'message' => 'Must be a valid email.'
			),
			/*
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This email registry already.'
			)
			*/
		),
	);
}