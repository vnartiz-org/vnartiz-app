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
class Contact_info extends AppModel {
	
	// Set relation
	public $belongsTo = array(
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id'
		),
		'Company' => array(
			'className' => 'Company',
			'foreignKey' => 'company_id'
		),
	);
	
	// Set validation
	public $validate = array(
		'firstname' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty.'
			),
			'regex' => array(
				'rule' => '/^[0-9a-zA-Z _-]*$/i',
				'message' => 'Please only fill out: Letter, Number, Space, Underline, Dash.'
			),
		),
		'lastname' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty.'
			),
			'regex' => array(
				'rule' => '/^[0-9a-zA-Z _-]*$/i',
				'message' => 'Please only fill out: Letter, Number, Space, Underline, Dash.'
			),
		),
		'company_name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty.'
			),
			'regex' => array(
				'rule' => '/^[0-9a-zA-Z _-]*$/i',
				'message' => 'Please only fill out: Letter, Number, Space, Underline, Dash.'
			),
		),
		'email' => array(
			'email' => array(
				'rule' => 'email',
				'message' => 'Must be a valid email.'
			),
		),
		'phone' => array(
			/*
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
		),
		'title' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty.'
			),
			'regex' => array(
				'rule' => '/^[0-9a-zA-Z _-]*$/i',
				'message' => 'Please only fill out: Letter, Number, Space, Underline, Dash.'
			),
		),
		'content' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty.'
			),
		),
	);
}