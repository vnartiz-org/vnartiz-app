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
class Contact extends AppModel {

	// Set relation
	public $belongsTo = array(
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id'
		)
	);
	
	// Set validation
	public $validate = array(
		'firstname' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			'lengthBetween' => array(
				'rule' => array('lengthBetween', 1, 36),
				'message' => 'Length must between 1 and 36 characters.'
			),
			/*
			'regex' => array(
				'rule' => '/^[a-z A-Z]*$/i',
				'message' => 'Please only fill out: Letters, Space.'
			),
			*/
		),
		'lastname' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			'lengthBetween' => array(
				'rule' => array('lengthBetween', 1, 36),
				'message' => 'Length must between 1 and 36 characters.'
			),
			/*
			'regex' => array(
				'rule' => '/^[a-z A-Z]*$/i',
				'message' => 'Please only fill out: Letters, Space.'
			),
			*/
		),
		'gender' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			'range' => array(
				'rule' => array('range', -1, 2),
				'message' => 'Invalid value.'
			),
		),
		'birthday' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			'date' => array(
				'rule' => array('date', 'ymd'),
				'message' => 'Wrong Date Format YYYY-MM-DD.'
			),
			'regex' => array(
				'rule' => '/^[0-9-]{10,10}$/i',
				'message' => 'Please only fill out: Date Format YYYY-MM-DD.'
			),
			'comparison_date' => array(
				'rule' => array('comparison_date', '<', 'now'),
				'message' => 'Must before today.'
			)
		),
		'identify' => array(
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
			'rule' => 'notEmpty',
			'message' => 'Must be not empty'
		),
		'address' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
		),
		'country_id' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			'exist' => array(
				'rule' => array('exist', null),
				'message' => 'Invalid value.'
			)
		),
		'location_id' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			'exist' => array(
				'rule' => array('exist', null),
				'message' => 'Invalid value.'
			),
			'exist_multi' => array(
				'rule' => array('exist_multi', 'Location.id.Contact.country_id'),
				'message' => 'Invalid value.'
			),
		),
	);
	
}