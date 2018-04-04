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
class Company extends AppModel {
	
	// Set relation
	public $hasOne = array(
		'Logo' => array(
			'className' => 'Logo',
			'conditions' => array(
				'Logo.disable' => 0
			)
		),
		
	);
	public $hasMany = array(
		'Account' => array(
			'className' => 'Account',
			'conditions' => array(
				'Account.account_type_id' => 2,
				'Account.disable' => 0
			)
		),
		'Contact_info' => array(
			'className' => 'Contact_info',
			'conditions' => array(
				'Contact_info.disable' => 0
			)
		),
		'Company_profile' => array(
			'className' => 'Company_profile',
			'conditions' => array(
				'Company_profile.disable' => 0
			)
		),
		/*
		'Promotion' => array(
			'className' => 'Promotion',
			'conditions' => array(
				'Promotion.disable' => 0
			)
		),
		'Recruiter' => array(
			'className' => 'Recruiter',
			'conditions' => array(
				'Recruiter.disable' => 0
			)
		),
		
		'Card' => array(
			'className' => 'Card',
			'conditions' => array(
				'Card.disable' => 0
			)
		),
		*/
	);
	
	// Set validation
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			'maxLength' => array(
				'rule' => array('maxLength', 120),
				'message' => 'Maximum length is 120 characters.'
			),
			/*
			'regex' => array(
				'rule' => '/^[0-9a-zA-Z _-]*$/i',
				'message' => 'Please only fill out: Letters, Number, Space, Underline, Dash.'
			),
			*/
		),
		'major_id' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty.'
			),
			/*
			'exist' => array(
				'rule' => array('exist', null),
				'message' => 'Invalid value.'
			)
			*/
		),
		'rate_id' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			'exist' => array(
				'rule' => array('exist', 'Rate.id'),
				'message' => 'Wrong value.'
			),
		),
		'allowance' => array(
			/*
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			*/
			'regex' => array(
				'allowEmpty' => true,
				'rule' => '/^[0-9]*$/i',
				'message' => 'Please only fill out: Number.'
			),
		),
		'taxcode' => array(
			'regex' => array(
				'allowEmpty' => true,
				'rule' => '/^[0-9]*$/i',
				'message' => 'Please only fill out: Number or Let\'s it empty.'
			),
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
		'phone' => array(
			/*
			'phone' => array(
				'rule' => 'phone',
				'message' => 'Phone is invalid number.'
			),
			'regex' => array(
				'rule' => '/^[0-9]*$/i',
				'message' => 'Please only fill out: Number.'
			),
			*/
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
		),
		'address' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			'maxLength' => array(
				'rule' => array('maxLength', 120),
				'message' => 'Maximum length is 120 characters.'
			)
		),
		'country_id' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			'exist' => array(
				'rule' => array('exist', 'Country.id'),
				'message' => 'Invalid value.'
			)
		),
		'location_id' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			'exist' => array(
				'rule' => array('exist', 'Location.id'),
				'message' => 'Invalid value.'
			),
		),
		'website' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			'maxLength' => array(
				'rule' => array('maxLength', 120),
				'message' => 'Maximum length is 120 characters.'
			)
			/*
			'regex' => array(
				'rule' => '/^[0-9a-zA-Z _-]*$/i',
				'message' => 'Please only fill out: Letters, Number, Space, Underline, Dash.'
			),
			*/
		),
	);
}