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
class Card extends AppModel {
	
	// Set relation
	public $belongsTo = array(
		'Company' => array(
			'className' => 'Company',
			'foreingKey' => 'company_id'
		),
	);
	public $hasOne = array(
	/*
		'Promotion' => array(
			'className' => 'Promotion',
			'condition' => array(
				'Promotion.disable' => 0
			)
		),
		'Recruiter' => array(
			'className' => 'Recruiter',
			'condition' => array(
				'Recruiter.disable' => 0
			)
		)*/
	);
	
	// set validation
	public $validate = array(
		'card_type_id' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty.'
			),
			/*
			'range' => array(
				'rule' => array('range', 0, 5),
				'message' => 'Wrong value.'
			)
			*/
		),
		'number' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty.'
			),
			'regex' => array(
				'rule' => '/^[0-9-]*$/i',
				'message' => 'Please only fill out: Number, Dash.'
			),
		),
		'amount' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty.'
			),
			'regex' => array(
				'rule' => '/^[0-9-]*$/i',
				'message' => 'Please only fill out: Number, Dash.'
			),
			'range' => array(
				'rule' => array('range', 0 , 900001),
				'message' => 'Invalid value.'
			)
		),
		'expire_year' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty.'
			),
			'regex' => array(
				'rule' => '/^[0-9]*$/i',
				'message' => 'Please only fill out: Number.'
			),
			'range' => array(
				'rule' => array('range', 0 , 2051),
				'message' => 'Invalid value.'
			)
		),
		'expire_month' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty.'
			),
			'regex' => array(
				'rule' => '/^[0-9]*$/i',
				'message' => 'Please only fill out: Number.'
			),
			'range' => array(
				'rule' => array('range', 0 , 13),
				'message' => 'Invalid value.'
			)
		),
		/*
		'expired_date' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty.'
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
				'rule' => array('comparison_date', '>=', 'now'),
				'message' => 'Must after or equal today.'
			)
		),
		*/
	);

}