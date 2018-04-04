<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('FormHelper', 'View');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class GeneralController extends AppController {
	public $post;
	public $models = array(
		'Country',
		'Location',
		'Duration',
	);
	
	/**
	 * Set before call a controller
	 *
	 * @author anh_dung
	 */
	public function beforeFilter() {
		// Load Model
		$this->loadModel($this->models);
		
		// Get post
		if (!$this->post = $this->request->data) {
			$this->redirect('/');
		}
	}
	
	/**
	 * Set after call a controller
	 *
	 * @author anh_dung
	 */
	public function afterFilter() {
		//exit;
	}
	
	/**
	 * Get location by country
	 *
	 * @author anh_dung
	 */
	public function get_location_by_country() {

		// Check post
		if (empty($this->post['country_id']) || empty($this->post['model'])) {
			$this->redirect('/');
		}
		
		//$this->post['country_id'] = 2; $this->post['model'] = 'Contact'; // test
		// Get location
		$params = array(
			'order' => array('sequence DESC', 'name ASC'),
			'conditions' => array(
				'Location.country_id' => $this->post['country_id'],
				'Location.disable' => 0,
			)
		);
		$location_list = $this->Location->find('all', $params);
		foreach ($location_list as $item) {
			$locations[$item['Location']['id']] = $item['Location']['name'];
		}

		$elements = array(
			'location' => array(
				'div' => false,
				'label' => __('Location'),
				'name' => $this->post['model'] . '.location_id',
				'class' => 'location',
				'empty' => __('Please select'),
				'options' => $locations
			),
		);
		$view = new View();
		echo $view->Form->input($elements['location']);
		
		exit;
	}
	
	/**
	 * Get amount
	 *
	 * @author anh_dung
	 */
	public function get_amount() {

		// Check post
		if (empty($this->post['duration_id']) || empty($this->post['currency'])) {
			$this->redirect('/');
		}
		//$this->post['duration_id'] = 1; $this->post['currency'] = 'vnd'; // test only
		// Get duration amount
		$duration_list = $this->Duration->find('all');
		if ($this->post['currency'] == 'vnd') {
			foreach ($duration_list as $item) {
				$duration_amounts[$item['Duration']['id']] = $item['Duration']['amount_vnd'];
			}	
		} else {
			foreach ($duration_list as $item) {
				$duration_amounts[$item['Duration']['id']] = $item['Duration']['amount_usd'];
			}
		}
		$amount = $duration_amounts[$this->post['duration_id']];
		echo $amount;
		exit;
	}
}