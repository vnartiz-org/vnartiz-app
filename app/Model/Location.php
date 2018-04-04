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
class Location extends AppModel {
	
	// Set relation
	public $hasMany = array(
	/*
		'Properties' => array(
			'className' => 'Properties',
			'conditions' => array(
				'Properties.disable' => 0
			)
		),
		*/
		'Company' => array(
			'className' => 'Company',
			'conditions' => array(
				'Company.disable' => 0
			)
		)
	);
}