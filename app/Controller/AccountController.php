<?php
App::uses('GuestController', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AccountController extends GuestController {

	var $uses = array();


	public function index() {
		
		// Check member 
		if (empty($this->member)) {
			$this->redirect('/account/signin/');
		}
		
		// Set gender
		$this->set('genders', array(__('Male'), __('Female')));
		
		// Get country
		$country_list = $this->Country->find('all');
		foreach ($country_list as $item) {
			$countries[$item['Country']['id']] = $item['Country']['name'];
		}
		$this->set('countries', $countries);
		
		// Get location
		if (!empty($this->member['Contact']['country_id'])) {
			$params = array(
				'conditions' => array(
					'Location.country_id' => $this->member['Contact']['country_id'],
					'Location.disable' => 0,
				)
			);
			$location_list = $this->Location->find('all', $params);
			foreach ($location_list as $item) {
				$locations[$item['Location']['id']] = $item['Location']['name'];
			}
		}
		$this->set('locations', $locations);
		
		// Set avatar
		$this->set('file', $this->webroot . 'files/img/avatar/' . $this->member['Avatar']['file']);
	}
	
	/**
	 * Signin
	 *
	 * @author anh_dung
	*/
	public function signin() {
		
		// Check member 
		if (!empty($this->member)) {
			$this->redirect('/account/');
		}
		
		// Has any form data been POSTed?
		if (($post = $this->request->data) && isset($post['post']) && $post['post'] == 'account') {
			if (!empty($post['Avatar']['file_upload']['size'])) {
				$target_dir = $_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/files/img/avatar/';
				$target_type = explode('.', $post['Avatar']['file_upload']['name']);
				$target_file = time() . '.' . $target_type[1];
				$temp_file = $post['Avatar']['file_upload']['tmp_name'];
				$post['Avatar']['file'] = $target_file;
				$is_upload = true;
			} else {
				unset($post['Avatar']);
			}
			$post['Account']['account_type_id'] = 1;
			//$post['Subscribe']['email'] = $post['Account']['email'];
			$post['Account']['lock'] = 1;
			$key = md5($post['Account']['username'] . date('Y-m-d H:i:s'));
			$post['Key'][0]['key'] = $key;
			if ($this->Account->saveAll($post)) {
				if (isset($is_upload) && move_uploaded_file($temp_file, $target_dir . $target_file)) {
					//upload success
				}
				
				// Send mail
				$params = array(
					'template' => 'person',
					'content' => 'confirm_signin',
					'subject' => 'Confirm sign in | Artist World organization',
					'value' => array(
						'firstname' => $post['Contact']['firstname'],
						'key' => $key,
					),
					'to' => $post['Account']['email'],
				);
				$this->sendMail($params);
				
				$this->set('signinMessage', __('You signed in success. Please check your email.'));
			} else {
				$this->set('signinError', __('You signed in fail! Please try again.'));
			}
		}
		
		// create form
		$this->_processForm($post);
	}
	
	/**
	 * Create an Account
	 *
	 * @author anh_dung
	*/
	public function enterprise_signin() {
		
		// Check member 
		if (!empty($this->member)) {
			$this->redirect('/account/');
		}
		
		// Has any form data been POSTed?
		if (($post = $this->request->data) && isset($post['post']) && $post['post'] == 'account') {
			if (!empty($post['Avatar']['file_upload']['size'])) {
				$target_dir = $_SERVER['DOCUMENT_ROOT'] . $this->aw_webroot . 'app/webroot/files/img/avatar/';
				$target_type = explode('/', $post['Avatar']['file_upload']['type']);
				$target_file = time() . '.' . $target_type[1];
				$temp_file = $post['Avatar']['file_upload']['tmp_name'];
				$post['Avatar']['file'] = $target_file;
				$is_upload = true;
			} else {
				unset($post['Avatar']);
			}
			if (!empty($post['Company']['Logo']['square_upload']['size'])) {
				$target_dir_square = $_SERVER['DOCUMENT_ROOT'] . $this->aw_webroot . 'app/webroot/files/employer/img/logo/';
				$target_type_square = explode('/', $post['Company']['Logo']['square_upload']['type']);
				$target_file_square = time() . '_square.' . $target_type_square[1];
				$temp_file_square = $post['Company']['Logo']['square_upload']['tmp_name'];
				$post['Company']['Logo']['square'] = $target_file_square;
				$is_upload_square = true;
			} else {
				unset($post['Company']['Logo']['square_upload']);
			}
			$post['Account']['account_type_id'] = 2;
			//$post['Subscribe']['email'] = $post['Account']['email'];
			$post['Account']['lock'] = 1;
			$key = md5($post['Account']['username'] . date('Y-m-d H:i:s'));
			$post['Account']['Key'][0]['key'] = $key;
			if ($this->Account->saveAll($post)) {
				if (isset($is_upload) && move_uploaded_file($temp_file, $target_dir . $target_file)) {
					//upload success
				}
				if (isset($is_upload_square) && move_uploaded_file($temp_file_square, $target_dir_square . $target_file_square)) {
					//upload success
				}
				/*
				if (isset($is_upload_rectangle) && move_uploaded_file($temp_file_rectangle, $target_dir_rectangle . $target_file_rectangle)) {
					//upload success
				}
				*/
				
				// Send mail
				$params = array(
					'template' => 'employer',
					'content' => 'confirm_signin',
					'subject' => 'Confirm Sign In | Artist World organization',
					'value' => array(
						'firstname' => $post['Contact']['firstname'],
						'key' => $key,
					),
					'to' => $post['Account']['email'],
				);
				$this->sendMail($params);
				
				$this->set('signinMessage', __('You signed in success. Please check your email.'));
			} else {
				$this->set('signinError', __('You signed in fail! Please try again.'));
			}
		}
		
		// create form
		$this->_processForm($post);
	}
	
	/**
	 * Confirm sign in
	 *
	 * @author anh_dung
	 */
	public function confirm_signin($key = null) {
		// Check $key
		if (!$key) {
			$this->redirect('/');
		} else {
			$params = array(
				'conditions' => array(
					'Key.key' => $key,
					//'Key.create_datetime' > date('Y-m-d H:i:s', strtotime('-1 day')),
					'Key.disable' => 0,
				)
			);	
			if ($keys = $this->Key->find('all', $params)) {
				// Delete key
				$params = array(
					'id' => $keys[0]['Key']['id'],
				);
				if ($this->Key->saveAll($params, array('disable_field' => true))) {
					// Enable account
					$params = array(
						'id' => $keys[0]['Key']['account_id'],
						'lock' => 0,
					);
					$account = $this->Account->saveAll($params);
					$this->resetMember($this->Account->id);
					
					if ($this->isMemberByID($this->Account->id)) {
						if (empty($this->member)) {
							$this->set('loginError', __('Your account was locked.'));
							$this->Session->destroy();
						} else {
							$this->set('loginMessage', __('You were login success.'));
							if ($referer = $this->Session->read('referer')) {
								$this->redirect($referer);
							}
							$this->redirect('/account/');
							
						}
					} else {
						$this->set('loginError', __('This account was not available!'));
					}
					$this->redirect('/');
					
				}
			} else {
				$this->set('confirmError', __('Your key was not available.'));
			}	
		}
	}
	
	/**
	 * Edit Account
	 *
	 * @author anh_dung
	 */
	public function edit() {
		
		//check is member
		if (!$this->member) {
			$this->redirect('/');
		}
		
		$validator = $this->Avatar->validator();
		$validator['file_upload']['extension']->allowEmpty = true;
		// Has any form data been POSTed?
		if (($post = $this->request->data) && !empty($post['post']) && $post['post'] == 'account') {
			if (!empty($post['Avatar']['file_upload']['size'])) {
				$target_dir = $_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/files/img/avatar/';
				$target_type = explode('/', $post['Avatar']['file_upload']['type']);
				$target_file = time() . '.' . $target_type[1];
				$temp_file = $post['Avatar']['file_upload']['tmp_name'];
				$post['Avatar']['file'] = $target_file;
				$is_upload = true;
			} else {
				unset($post['Avatar']);
			}
			$post['Account']['account_type_id'] = 1;
			
			if ($this->Account->saveAll($post)) {
				if (isset($is_upload) && move_uploaded_file($temp_file, $target_dir . $target_file)) {
					unlink($_SERVER['DOCUMENT_ROOT'] . $this->aw_webroot . 'app/webroot/files/img/avatar/' . $this->member['Avatar']['file']);
				}
				$this->resetMember($this->Account->id);
				$this->redirect('/account/');
			}
		}
		$this->set('file', $this->webroot . 'files/img/avatar/' . $this->member['Avatar']['file']);
		// create form
		$this->_processForm($post ? $post : $this->member);
	}

	/**
	 * Login
	 *
	 * @author anh_dung
	 */
	public function login() {
		// Check member 
		if (!empty($this->member)) {
			$this->redirect('/account/');
		}
	}
	
	/**
	 * Forgot password
	 *
	 * @author anh_dung
	 */
	public function forgot_password() {
		
		if (($post = $this->request->data) && isset($post['post']) && $post['post'] == 'account') {
			$params = array(
				'conditions' => array(
					//'Account.account_type_id' => 1,
					'Account.username' => $post['Account']['username'],
					'Account.email' => $post['Account']['email'],
				),
			);
			if ($accounts = $this->Account->find('all', $params)) {
				// Check key
				$params = array(
					'conditions' => array(
						'Key.account_id' => $accounts[0]['Account']['id'],
						'Key.create_datetime >' => date('Y-m-d H:i:s', strtotime('-1 day')),
						'Key.disable' => 0,
					),
				);
				if (!$keys = $this->Key->find('all', $params)) {
					
					// Create key
					$key = md5($post['Account']['username'] . date('Y-m-d H:i:s'));
					$long_pass = md5($accounts[0]['Account']['id'] . date('Y-m-d H:i:s'));
					$password = substr($long_pass, 0, 8);
					$params = array(
						'account_id' => $accounts[0]['Account']['id'],
						'key' => $key,
						'password' => $password
					);
					if ($this->Key->saveAll($params)) {
						
					}
					
					// Send mail
					$params = array(
						'template' => 'person',
						'content' => 'confirm_reset_password',
						'subject' => 'Confirm Reset Password | Artist World organization',
						'value' => array(
							'firstname' => $post['Account']['username'],
							'password' => $password,
							'key' => $key,
						),
						'to' => $post['Account']['email'],
					);
					$this->sendMail($params);
				
					$this->set('forgotMessage', __('Your request has sent success. Please check your email.'));
				} else {
					$this->set('forgotNote', __('Your key has sent already. Please check your email.'));
				}
			} else {
				$this->set('forgotError', __('Your request has sent failed!'));
			}	
		}
		
		// create form
		$this->_processForm($post);
	}
	
	/**
	 * Confirm reset password
	 *
	 * @author anh_dung
	 */
	public function confirm_reset_password($key = null) {
		if (!$key) {
			$this->redirect('/');
		} else {
			$params = array(
				'conditions' => array(
					'Key.key' => $key,
					'Key.create_datetime' > date('Y-m-d H:i:s', strtotime('-1 day')),
					'Key.disable' => 0,
				)
			);	
			if ($keys = $this->Key->find('all', $params)) {
				// Delete key
				$params = array(
					'id' => $keys[0]['Key']['id'],
				);
				if ($this->Key->saveAll($params, array('disable_field' => true))) {
					// Reset password
					//var_dump($keys);
					$params = array(
						'id' => $keys[0]['Key']['account_id'],
						'password' => $keys[0]['Key']['password'],
					);
					$this->Account->saveAll($params);
				}
				$this->set('forgotMessage', __('Your password has been reset success.'));
			} else {
				$this->set('forgotError', __('Your key was not available or expired.'));
			}	
		}
	}
	
	/**
	 * Create form
	 *
	 * @author anh_dung
	 */
	private function _processForm($data = null) {
		
		// Get country
		$country_list = $this->Country->find('all');
		foreach ($country_list as $item) {
			$countries[$item['Country']['id']] = $item['Country']['name'];
		}
		
		// Get location
		if (!empty($data['Contact']['country_id'])) {
			$params = array(
				'conditions' => array(
					'Location.country_id' => $data['Contact']['country_id'],
					'Location.disable' => 0,
				)
			);
			$location_list = $this->Location->find('all', $params);
			foreach ($location_list as $item) {
				$locations[$item['Location']['id']] = $item['Location']['name'];
			}
		}
		
		// Company Location
		if (!empty($data['Company']['country_id'])) {
			$params = array(
				'conditions' => array(
					'Location.country_id' => $data['Company']['country_id'],
					'Location.disable' => 0,
				)
			);
			$location_list = $this->Location->find('all', $params);
			foreach ($location_list as $item) {
				$company_locations[$item['Location']['id']] = $item['Location']['name'];
			}
		}

		$form = array(
			'enctype' => 'multipart/form-data'
		);
		$account = array(
			'hidden' => array(
				'name' => 'Account.id',
				'type' => 'hidden',
				'value' => isset($data['Account']['id']) ? $data['Account']['id'] : '',
			),
			'username' => array(
				'label' => __('Username'),
				'name' => 'Account.username',
				'type' => 'text',
				'value' => isset($data['Account']['username']) ? $data['Account']['username'] : '',
				'placeholder' => __('Input your username')
			),
			'password' => array(
				'label' => __('Password'),
				'name' => 'Account.password',
				'type' => 'password',
				'value' => isset($data['Account']['password']) ? $data['Account']['password'] : '',
				'placeholder' => __('Input your password')
			),
			'email' => array(
				'label' => __('Email'),
				'name' => 'Account.email',
				'type' => 'text',
				'value' => isset($data['Account']['email']) ? $data['Account']['email'] : '',
				'placeholder' => __('account@domain')
			)
		);
		$avatar = array(
			'hidden' => array(
				'name' => 'Avatar.id',
				'type' => 'hidden',
				'value' => !empty($data['Avatar']['id']) ? $data['Avatar']['id'] : '',
			),
			'avatar' => array(
				'label' => __('Avatar'),
				'name' => 'Avatar.file_upload',
				'type' => 'file',
				'class' => 'avatar m-0-auto',
				'placeholder' => __('Input your file')
			),
		);
		$contact = array(
			'hidden' => array(
				'name' => 'Contact.id',
				'type' => 'hidden',
				'value' => isset($data['Contact']['id']) ? $data['Contact']['id'] : '',
			),
			'firstname' => array(
				'label' => __('First name'),
				'name' => 'Contact.firstname',
				'type' => 'text',
				'value' => isset($data['Contact']['firstname']) ? $data['Contact']['firstname'] : '',
				'placeholder' => __('Input your first name')
			),
			'lastname' => array(
				'label' => __('Last name'),
				'name' => 'Contact.lastname',
				'type' => 'text',
				'value' => isset($data['Contact']['lastname']) ? $data['Contact']['lastname'] : '',
				'placeholder' => __('Input your last name')
			),
			'gender' => array(
				'label' => __('Gender'),
				'name' => 'Contact.gender',
				'type' => 'radio',
				//'empty' => 'Please select',
				'value' => isset($data['Contact']['gender']) ? $data['Contact']['gender'] : 0,
				'options' => array(__('Male'), __('Female'))
			),
			'birthday' => array(
				'label' => __('Birthday'),
				'name' => 'Contact.birthday',
				'class' => 'datepicker birthday',
				'type' => 'text',
				'value' => isset($data['Contact']['birthday']) ? $data['Contact']['birthday'] : date('Y-m-d', strtotime('-16 years')),
				'placeholder' => 'YYYY-MM-DD'
			),
			'identify' => array(
				'label' => __('Identify No.'),
				'name' => 'Contact.identify',
				'type' => 'text',
				'value' => isset($data['Contact']['identify']) ? $data['Contact']['identify'] : '',
				'placeholder' => __('Input your identify number')
			),
			'taxcode' => array(
				'label' => __('Tax code'),
				'name' => 'Contact.taxcode',
				'type' => 'text',
				'value' => isset($data['Contact']['taxcode']) ? $data['Contact']['taxcode'] : '',
				'placeholder' => __('Input your tax code')
			),
			'email' => array(
				'label' => __('Email'),
				'name' => 'Contact.email',
				'type' => 'text',
				'value' => isset($data['Contact']['email']) ? $data['Contact']['email'] : '',
				'placeholder' => __('account@domain')
			),
			'phone' => array(
				'mylabel' => __('Phone'),
				'name' => 'Contact.phone',
				'type' => 'text',
				'value' => isset($data['Contact']['phone']) ? $data['Contact']['phone'] : '',
				'placeholder' => __('Input your phone number')
			),
			'address' => array(
				'label' => __('Address'),
				'name' => 'Contact.address',
				'type' => 'text',
				'value' => isset($data['Contact']['address']) ? $data['Contact']['address'] : '',
				'placeholder' => __('Input your address')
			),
			'country' => array(
				'label' => __('Country'),
				'name' => 'Contact.country_id',
				'class' => 'country',
				'model' => 'Contact',
				'empty' => __('Please select'),
				'selected' => isset($data['Contact']['country_id']) ? $data['Contact']['country_id'] : '',
				'options' => $countries
			),
			'location' => array(
				'label' => __('Location'),
				'name' => 'Contact.location_id',
				'class' => 'location',
				'empty' => __('Please select'),
				'selected' => isset($data['Contact']['location_id']) ? $data['Contact']['location_id'] : '',
				'options' => !empty($data['Contact']['country_id']) ? $locations : array()
			),
		);
		$this->set('form', $form);
		$this->set('account', $account);
		$this->set('avatar', $avatar);
		$this->set('contact', $contact);
		$logo = array(
			'hidden' => array(
				'name' => 'Company.Logo.id',
				'type' => 'hidden',
				'value' => isset($data['Company']['Logo']['id']) ? $data['Company']['Logo']['id'] : '',
			),
			'square' => array(
				'label' => __('Square logo'),
				'name' => 'Company.Logo.square_upload',
				'type' => 'file',
				'class' => 'square m-0-auto',
			),
			/*
			'rectangle' => array(
				'label' => __('Rectangle logo'),
				'name' => 'Company.Logo.rectangle_upload',
				'type' => 'file',
				'class' => 'rectangle',
			),
			*/
		);
		$company = array(
			'hidden' => array(
				'name' => 'Company.id',
				'type' => 'hidden',
				'value' => isset($data['Company']['id']) ? $data['Company']['id'] : '',
			),
			'name' => array(
				'label' => __('Company'),
				'name' => 'Company.name',
				'type' => 'text',
				'value' => isset($data['Company']['name']) ? $data['Company']['name'] : '',
				'placeholder' => __('Input your company name')
			),
			'major' => array(
				'label' => __('Major/Field'),
				'name' => 'Company.major_id',
				'empty' => __('Please select'),
				'selected' => isset($data['Company']['major_id']) ? $data['Company']['major_id'] : '',
				'options' => $this->majors
			),
			'rate' => array(
				'label' => __('Rate'),
				'name' => 'Company.rate_id',
				'empty' => __('Please select'),
				'selected' => isset($data['Company']['rate_id']) ? $data['Company']['rate_id'] : '',
				'options' => $this->rates
			),
			'allowance' => array(
				'label' => __('Allowance No.'),
				'name' => 'Company.allowance',
				'type' => 'text',
				'value' => isset($data['Company']['allowance']) ? $data['Company']['allowance'] : '',
				'placeholder' => __('Input your allowance number')
			),
			'taxcode' => array(
				'label' => __('Tax code'),
				'name' => 'Company.taxcode',
				'type' => 'text',
				'value' => isset($data['Company']['taxcode']) ? $data['Company']['taxcode'] : '',
				'placeholder' => __('Input your tax code')
			),
			'email' => array(
				'label' => __('Email'),
				'name' => 'Company.email',
				'type' => 'text',
				'value' => isset($data['Company']['email']) ? $data['Company']['email'] : '',
				'placeholder' => __('account@domain')
			),
			'phone' => array(
				'label' => __('Phone'),
				'name' => 'Company.phone',
				'type' => 'text',
				'value' => isset($data['Company']['phone']) ? $data['Company']['phone'] : '',
				'placeholder' => __('Input your phone')
			),
			'address' => array(
				'label' => __('Address'),
				'name' => 'Company.address',
				'type' => 'text',
				'value' => isset($data['Company']['address']) ? $data['Company']['address'] : '',
				'placeholder' => __('Input your address')
			),
			'country' => array(
				'label' => __('Country'),
				'name' => 'Company.country_id',
				'class' => 'country',
				'model' => 'Company',
				'empty' => __('Please select'),
				'selected' => isset($data['Company']['country_id']) ? $data['Company']['country_id'] : '',
				'options' => $countries
			),
			'location' => array(
				'label' => __('Location'),
				'name' => 'Company.location_id',
				'class' => 'location',
				'empty' => __('Please select'),
				'selected' => isset($data['Company']['location_id']) ? $data['Company']['location_id'] : '',
				'options' => !empty($data['Company']['country_id']) ? $company_locations : array()
			),
			'website' => array(
				'label' => __('Website'),
				'name' => 'Company.website',
				'type' => 'text',
				'value' => isset($data['Company']['website']) ? $data['Company']['website'] : '',
				'placeholder' => __('Input your company website')
			),
		);
		$this->set('logo', $logo);
		$this->set('company', $company);
		switch($this->action) {
			case 'forgot_password': {
				$forgot_password = array(
					'username' => array(
						'label' => __('Username'),
						'name' => 'Account.username',
						'type' => 'text',
						'value' => isset($data['Account']['username']) ? $data['Account']['username'] : '',
						'placeholder' => __('Input your username')
					),
					'email' => array(
						'label' => __('Email'),
						'name' => 'Account.email',
						'type' => 'text',
						'value' => isset($data['Account']['email']) ? $data['Account']['email'] : '',
						'placeholder' => __('Input your email')
					),
				);
				$this->set('forgot_password', $forgot_password);
				break;
			}
		}
		$button = array(
			'signin' => array(
				'title' => __('Sign in now'),
				'name' => 'post',
				'value' => 'account',
				'class' => 'blue'
			),
			'edit' => array(
				'title' => __('Edit now'),
				'name' => 'post',
				'value' => 'account',
				'class' => 'blue'
			),
			'submit' => array(
				'title' => __('Submit now'),
				'name' => 'post',
				'value' => 'account',
				'class' => 'blue'
			),
		);
		$this->set('button', $button);
		
		$linkEdit = array(
			'cancel' => array(
				'class' => '',
				'title' => __('Cancel'),
				'url'  => '/account/'
			)
		);
		$this->set('linkEdit', $linkEdit);
	}
}