<?php
App::uses('GuestController', 'Controller');
class SearchController extends GuestController {
	/**
	 * Search result
	 *
	 * @author anh_dung
	 */
	public function index() {
		// Check post
		if(($post = $this->request->data) && !empty($post['template']) && ($post['template'] == 'search')) {
			$params = array(
				'recursive' => 2,
				'conditions' => array(
					'Properties.disable' => 0
				)
			);
			$register = array(
				'title' => ' LIKE',
				'summary' => ' LIKE',
				'description' => ' LIKE',
				'country_id' => '',
				'location_id' => '',
				'properties_type_id' => '',
				'purpose_id' => '',
				'price_from' => ' >=',
				'price_to' => ' <=',
				'currency_id' => '',
				'price_type_id' => '',
				'area_from' => ' >=',
				'area_to' => ' <=',
				'square_id' => '',
			);
			foreach ($register as $key => $item) {
				if (($key == 'title' || $key == 'summary' || $key == 'description') && ($new_key = 'keyword') && !empty($post['Search'][$new_key])) {
					$params['conditions']['OR']['Properties.' . $key . $item] = '%' . $post['Search'][$new_key] . '%';
				} elseif ( ((($key == 'price_from' || $key == 'price_to') && $new_key = 'price') || (($key == 'area_from' || $key == 'area_to')
					&& ($new_key = 'area'))) && (!empty($post['Search'][$key])) ) {
					$params['conditions']['Properties.' . $new_key . $item] = $post['Search'][$key];
				} elseif (!empty($post['Search'][$key])) {
					$params['conditions']['Properties.' . $key . $item] = $post['Search'][$key];
				} else {
					unset($post['Search'][$key]);
				}
			}
			
			// Search properties
			if ($properties = $this->Properties->find('all', $params)) {
				$this->set('properties', $properties);
			} else {
				$this->set('properties', array());
				$this->set('note', __('Property was not found.'));
			}
			
			// Save search data
			!empty($this->member['Account']['id']) && $post['Search']['account_id'] = $this->member['Account']['id'];
			!empty($this->member['Company']['id']) && $post['Search']['company_id'] = $this->member['Company']['id'];
			if ($this->Search->saveAll($post['Search'])) {
				// Success
			}
		} else {
			$this->set('properties', array());
			$this->set('note', __('Please input what you need to find.'));
		}
	}
}