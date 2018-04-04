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
class Company_profile extends AppModel {
	
	// Set relation
	/*
	public $hasOne = array(
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
		)
	);
	*/
	public $belongsTo = array(
		'Company' => array(
			'className' => 'Company',
			'foreignKey' => 'company_id'
		),
		
	);
	public $hasMany = array(

	);
	
	// Set validation
	public $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			/*
			'regex' => array(
				'rule' => '/^[0-9a-zA-Z _-]*$/i',
				'message' => 'Please only fill out: Letter, Number, Space, Underline, Dash.'
			),
			*/
			'maxlength' => array(
				'rule' => array('maxLength', 120),
				'message' => 'Maximum length is 120 characters.'
			),
		),
		'description' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			'maxlength' => array(
				'rule' => array('maxLength', 5000),
				'message' => 'Maximum length is 5000 characters.'
			),
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
		'vision' => array(
			/*
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			*/
			'maxlength' => array(
				'allowEmpty' => 'true',
				'rule' => array('maxLength', 5000),
				'message' => 'Maximum length is 5000 characters.'
			),
		),
		'mission' => array(
			/*
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			*/
			'maxlength' => array(
				'allowEmpty' => 'true',
				'rule' => array('maxLength', 5000),
				'message' => 'Maximum length is 5000 characters.'
			),
		),
		'summary' => array(
			/*
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			*/
			'maxlength' => array(
				'allowEmpty' => 'true',
				'rule' => array('maxLength', 5000),
				'message' => 'Maximum length is 5000 characters.'
			),
		),
		'introduction' => array(
			/*
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Must be not empty'
			),
			*/
			'maxlength' => array(
				'allowEmpty' => 'true',
				'rule' => array('maxLength', 5000),
				'message' => 'Maximum length is 5000 characters.'
			),
		)
	);
}