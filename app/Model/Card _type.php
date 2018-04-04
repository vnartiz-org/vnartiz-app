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
class Card_type extends AppModel {
	
	// Set relation
	public $hasMany = array(
		/*
		'Card' => array(
			'className' => 'Card',
			'conditions' => array(
				'Card.disable' => 0
			)
		)
		*/
	);

}