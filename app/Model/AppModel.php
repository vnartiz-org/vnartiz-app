<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	
	/**
	 * Compare date
	 *
	 * @author anh_dung
	 */
	public static function comparison_date($check, $operator, $compare = null) {
		if (!$compare || $compare == 'today' || $compare == 'now') {
			$compare = date('Y-m-d');
		}
		foreach ($check as $val) {
			$value = $val;
		}
		switch ($operator) {
			case '>':
				return $value > $compare;
			case '>=':
				return $value >= $compare;
			case '=':
				return $value == $compare;
			case '<=':
				return $value <= $compare;
			case '<':
				return $value < $compare;
			default;
				return false;
		}
		return false;
	}
	
	/**
	 * Check is exist
	 *
	 * @author anh_dung
	 */
	public function exist($check, $db = null) {
		//var_dump($_POST['data']);return false;
		foreach ($check as $key => $val) {
			$value = $val;
			if (!$db) {
				$db = ucfirst($key);
				list($table, $field) = explode('_', $db);
				$db = $table . '.' . $field;
			} else {
				$db = ucfirst($db);
				list($table, $field) = explode('.', $db);
			}
		}
		//var_dump($table);return false;
		Controller::loadModel($table);
		return (bool)$count = $this->$table->find('count' , array(
			'conditions' => array(
				$db => $value,
			),
			'recursive' => -1
		));
	}
	
	/**
	 * Check is exist
	 *
	 * @author anh_dung
	 */
	public function exist_multi($check, $db = null) {
		//var_dump($_POST['data']);return false;
		foreach ($check as $key => $val) {
			$value = $val;
			if (!$db) {
				return false;
			} else {
				$db = explode('.', $db);
				$table = $db[0];
				$conditions[$db[1]] = $value; 
				//var_dump($_POST['data']);return false;
				for ($i = 2; $i < count($db); $i += 2) {
					$post{$i} = $db[$i];
					$field{$i} = $db[$i + 1];
					$val = $_POST['data'][$post{$i}][$field{$i}];
					$conditions[$table . '.' . $field{$i}] = $val;
				}
			}
		}
		
		Controller::loadModel($table);
		return (bool)$count = $this->$table->find('count' , array(
			'conditions' => $conditions,
			'recursive' => -1
		));
	}

}
