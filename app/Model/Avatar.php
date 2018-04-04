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
class Avatar extends AppModel {
	public $belongsTo = array(
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id'
		)
	);
	public $validate = array(
		'file_upload' => array(
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
	);
}