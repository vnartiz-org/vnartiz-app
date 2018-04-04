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
class Logo extends AppModel {
	public $belongsTo = array(
		'Company' => array(
			'className' => 'Company',
			'foreignKey' => 'company_id'
		)
	);
	public $validate = array(
		'square_upload' => array(
			'extension' => array(
				//'allowEmpty' => true,
				'rule' => array('extension', array('jpeg', 'jpg', 'gif', 'png')),
				'message' => 'Wrong image file format.'
			),
			'size' => array(
				'rule' => array('fileSize', '<=', '1MB'),
				'message' => 'File size nust be less than or equal 1MB.'
			)
		),
		/*
		'rectangle_upload' => array(
			'extension' => array(
				//'allowEmpty' => true,
				'rule' => array('extension', array('jpeg', 'jpg', 'gif', 'png')),
				'message' => 'Wrong image file format.'
			),
			'size' => array(
				'rule' => array('fileSize', '<=', '1MB'),
				'message' => 'File size nust be less than or equal 1MB.'
			)
		),
		*/
	);
}