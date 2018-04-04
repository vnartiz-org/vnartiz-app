<?php
App::uses('Controller', 'Controller');
//Router::url('/', true);
class GuestController extends AppController {

	//public $helpers = array('Session');
	// Other
	public $current_country_id;
	public $current_language;
	
	// Account
	public $genders = array('Male', 'Female');
	
	public $countries;
	public $locations;
	public $majors;
	public $rates;
	
	public $models = array(
		'Account_type',
		'Account',
		'Contact',
		'Avatar',
		
		'Key',
		
		//'Card',
		////'Card_type',

		//'Contact_info',
		//'Search',
		
		'Company',
		'Logo',

		'Company_profile',
		'Rate',
		'Country',
		'Location',
		'Major'
	);
	public $components = array('Cookie');
	public function beforeFilter() {
		parent::beforeFilter();
		
		//$this->set('webroot', 'http://'.$_SERVER['SERVER_NAME'].Router::url('/index.php/'));.

		$this->Cookie->name = 'baker_id';
		$this->Cookie->time = 3600;  // or '1 hour'
		$this->Cookie->path = '/bakers/preferences/';
		$this->Cookie->domain = '.vnartiz.com';
		$this->Cookie->secure = true;  // i.e. only sent if using secure HTTPS
		$this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
		$this->Cookie->httpOnly = true;
		$this->Cookie->type('aes');
		
		session_name('test');
		session_set_cookie_params(24*60*60,'/','.vnartiz.com');
		
		// Load Model
		//$this->loadModel($this->models);

		// Set User agent
		if (!$this->Session->read('user_agent')) {
			if ($user_agent = $this->set_user_agent($this->ip_address())) {
				
			}
		}
		
		// Load Model
		$this->loadModel($this->models);
		/*
		$this->setMember();
		$this->doTemplate();
		if ($this->member) {
			$this->resetMember();
		}
		*/
		
		
		//  Check language
		if (($post = $this->request->data) && isset($post['language']['lang'])) {
			if (!empty($post['language']['lang'])) {
				switch($post['language']['lang']) {
					case 'eng':
					case 'fra':
					case 'zho':
					case 'jap':
					case 'kor':
					case 'rus':
					case 'ara':
					case 'hin':
						$this->Session->write('Config.language' , $post['language']['lang']);
						break;
					default:
						$this->Session->write('Config.language' , 'vie');
				}
			}
		}
		if (!$this->Session->read('Config.language')) {
			if (!empty($this->user_agent['country_code'])) {
				// Get country by user agent
				$param = array(
					'conditions' => array(
						'Country.country_code' => $this->user_agent['country_code'],
						'Country.disable' => 0,
					)
				);
				if ($country = $this->Country->find('all', $params)) {
					$this->Session->write('Config.language' , $country[0]['lang_code']);
				}	
			} else {
				$this->Session->write('Config.language', 'vie');
			}
		}
		if (!$this->current_language = $this->Session->read('Config.language')) {
			$this->current_language = 'vie';
		}
		Configure::write('Config.language', $this->current_language);
		$this->set('current_language', $this->current_language);
		
		// Set language
		$language = array(
			'eng' => array(
				'label' => false,
				'name' => 'language.lang',
				'type' => 'hidden',
				'value' => 'eng'
			),
			'vie' => array(
				'label' => false,
				'name' => 'language.lang',
				'type' => 'hidden',
				'value' => 'vie'
			),
			'fra' => array(
				'label' => false,
				'name' => 'language.lang',
				'type' => 'hidden',
				'value' => 'fra'
			),
			'jap' => array(
				'label' => false,
				'name' => 'language.lang',
				'type' => 'hidden',
				'value' => 'jap'
			),
			'zho' => array(
				'label' => false,
				'name' => 'language.lang',
				'type' => 'hidden',
				'value' => 'zho'
			),
			'kor' => array(
				'label' => false,
				'name' => 'language.lang',
				'type' => 'hidden',
				'value' => 'kor'
			),
			'rus' => array(
				'label' => false,
				'name' => 'language.lang',
				'type' => 'hidden',
				'value' => 'rus'
			),
			'ara' => array(
				'label' => false,
				'name' => 'language.lang',
				'type' => 'hidden',
				'value' => 'ara'
			),
			'hin' => array(
				'label' => false,
				'name' => 'language.lang',
				'type' => 'hidden',
				'value' => 'hin'
			),
		);
		$this->set('language', $language);
		
		if ($this->params['controller'] == 'page') {
			if ($this->current_language) {
				$this->viewPath = $this->viewPath . DS . $this->current_language;
			} else {
				$this->viewPath = $this->viewPath . DS . $this->viewPath;
			}
		}
		
		// Do template
		//$this->layout = 'default_search';
		
		$this->setMember();
		$this->doTemplate();
		
		if ($this->member) {
			$this->resetMember();
			//$this->setManagement();
		}
		
	}
	
	/**
	 * Check member login already
	 *
	 * @author anh_dung
	 */
	public function setMember($member = null) {
		if(!empty($_COOKIE['username']) && ($username = $_COOKIE['username'])) {
			$this->createMemberByUserName($username);
			$member = $this->Session->read('member');
			$this->member = $member;
			$this->set('member', $member);
			
		} elseif ($member = $this->Session->read('member')) {
			//var_dump($member);exit;
			$this->member = null;
			$this->set('member', null);
			setcookie('username', null, -1, '/', '.vnartiz.com');
			$this->Session->destroy();
			$this->redirect('/');
			
			//$member = $this->Session->read('member');
			//var_dump($member);exit;
			//$this->User_agent->saveAll($profile[0], array('disable_field' => true));
		}
		if (!$member) {
			//if ($member = $this->Session->read('member')) {
				// Success
				// $this->Cookie->write('username', $member);
			//}
		}
		
		
	}

	/**
	 * Check member login already
	 *
	 * @author anh_dung
	 */
	public function resetMember($id = null) {
		
		$params = array(
			'recursive' => 2,
			'conditions' => array(
				'Account.id' => $id ? $id : (isset($this->member['Account']['id']) ? $this->member['Account']['id'] : 0),
				//'Account.account_type_id' => 1,
				//'Resume.disable' => 0,
			),
			//'fields' => array('username', 'password')
		);
		if ($member = $this->Account->find('all', $params)) {
			$member = $member[0];
			$this->Session->write('member', $member);
			$this->member = $this->Session->read('member');
			$this->set('member', $this->member);
			//var_dump($this->member);
		}
	}
	
	/**
	 * Check member login already
	 *
	 * @author anh_dung
	 */
	public function createMemberByUserName($username = null) {
		
		$params = array(
			'recursive' => 3,
			'conditions' => array(
				'Account.username' => $username ? $username : (isset($this->member['Account']['username']) ? $this->member['Account']['username'] : ''),
				//'Account.account_type_id' => 1
			),
		);
		if ($member = $this->Account->find('all', $params)) {
			$this->Session->write('member', $member[0]);
			$this->member = $this->Session->read('member');
			$this->set('member', $this->member);
			//var_dump($this->member);
		}
	}
	
	/**
	 * Check is member
	 *
	 * @author anh_dung
	 */
	public function isMember($username = null, $password = null) {
		if (!$username || !$password) {
			return false;
		}
		$params = array(
			'recursive' => 2,
			'conditions' => array(
				'Account.username' => $username,
				'Account.password' => $password,
				//'Account.hidden' => 0,
				//'Account.disable' => 0,
			),
		);
		if ($member = $this->Account->find('all', $params)) {
			if (!$member[0]['Account']['lock']) {
				//$this->Cookie->write('member', $member[0]['Account'], false, 3600, '.vnartiz.com');
				setcookie('username', $member[0]['Account']['username'], time() + (86400 * 30), "/", '.vnartiz.com');
				
				$this->Session->write('member', $member[0]);
				$this->member = $this->Session->read('member');
				$this->set('member', $this->member);
			}
			return true;
		} 
		return false;
	}
	
	/**
	 * Check is member by id
	 *
	 * @author anh_dung
	 */
	public function isMemberByID($id = null) {
		if (!$id) {
			return false;
		}
		$params = array(
			'recursive' => 2,
			'conditions' => array(
				'Account.id' => $id,
				'Account.disable' => 0
			),
		);
		if ($member = $this->Account->find('all', $params)) {
			if (!$member[0]['Account']['lock']) {
				setcookie('username', $member[0]['Account']['username'], time() + (86400 * 30), "/", '.vnartiz.com');
				
				$this->Session->write('member', $member[0]);
				$this->member = $this->Session->read('member');
				$this->set('member', $this->member);
			}
			return true;
		} 
		return false;
	}
	
	/**
	 * Process form for template
	 *
	 * @author anh_dung
	 */
	public function doTemplate() {
		
		// Get rate
		$rate_list = $this->Rate->find('all');
		foreach ($rate_list as $item) {
			$this->rates[$item['Rate']['id']] = __($item['Rate']['name']);
		}
		$this->set('rates', $this->rates);
		
		// Get major
		$major_list = $this->Major->find('all');
		foreach ($major_list as $item) {
			$this->majors[$item['Major']['id']] = __($item['Major']['name']);
		}
		$this->set('majors', $this->majors);
		
		// Get country
		$country_list = $this->Country->find('all');
		foreach ($country_list as $item) {
			$this->countries[$item['Country']['id']] = __($item['Country']['name']);
		}
		$this->set('countries', $this->countries);
		
		// Get location
		$params = array(
			'order' => array('sequence DESC', 'name ASC'),
			'conditions' => array(
				'Location.disable' => 0,
			)
		);
		$location_list = $this->Location->find('all', $params);
		foreach ($location_list as $item) {
			$this->locations[$item['Location']['id']] = $item['Location']['name'];
		}
		$this->set('locations', $this->locations);
		
		// Set gender
		$this->set('genders', $this->genders);
		
		
		if (empty($this->request->data)) {
			$referer = $this->referer();
			//$this->Flash->referer($referer);
			$this->Session->write('referer', $referer);
		}
		if (($post = $this->request->data) && !empty($post['template'])) {
			
			// Get location
			$locations = array();
			/*
			if (!empty($post['Search']['country_id'])) {
				$params = array(
					'conditions' => array(
						'Location.country_id' => $post['Search']['country_id'],
						'Location.disable' => 0,
					)
				);
				$location_list = $this->Location->find('all', $params);
				foreach ($location_list as $item) {
					$locations[$item['Location']['id']] = $item['Location']['name'];
				}
			//}
			*/
			switch ($post['template']) {
				// Check login post
				case 'login': {
					
					if ($this->isMember($post['Account']['username'], $post['Account']['password'])) {
						if (empty($this->member)) {
							$this->set('loginError', __('Your account was locked.'));
							$this->Session->destroy();
						} else {
							$this->set('loginMessage', __('You were login success.'));
							if ($referer = $this->Session->read('referer')) {
								$this->redirect($referer);
							}
							$this->redirect('/');
						}
					} else {
						$this->set('loginError', __('This account was not available!'));
					}
					break;
				}
				
				// Check logout post
				case 'logout': {
					setcookie('username', null, -1, '/', '.vnartiz.com');
					$this->Session->destroy();
					$this->redirect('/');
				}
				
				// Check subscribe post
				/*
				case 'subscribe': {
					if ($subscribe = $this->Subscribe->saveAll($post)) {
						$this->set('subscribeMessage', __('Subscribe success.'));
					} else {
						$this->set('subscribeError', __('Subscribe fail.'));
					}
					break;
				}
				
				// Check contact us post
				case 'contact_info': {
					if ($this->member) {
						$post['Contact_info']['account_id'] = $this->member['Account']['id'];
					}
					//var_dump($post);
					if ($this->Contact_info->saveAll($post['Contact_info'])) {
						$this->set('contactUsMessage', __('Contact us success.'));
					} else {
						$this->set('contactUsError', __('Contact us fail.'));
					}
					break;
				}
				*/
			}	
		}
		
		// Login Form
		$loginForm = array(
			'username' => array(
				'mylabel' => __('Username'),
				'name' => 'Account.username',
				'type' => 'text',
				'placeholder' => __('Input your username')
			),
			'password' => array(
				'mylabel' => __('Password'),
				'name' => 'Account.password',
				'type' => 'password',
				'placeholder' => __('Input your password')
			)
		);
		$this->set('loginForm', $loginForm);
		$linkLogin = array(
			'create_a_personal_account' => array(
				'class' => 'login',
				'title' => __('Create a personal account'),
				'url'  => '/account/signin'
			),
			'create_an_enterprise_account' => array(
				'class' => 'login',
				'title' => __('Create an enterprise account'),
				'url'  => '/account/enterprise_signin'
			),
			'forgot_password' => array(
				'class' => 'forgot_password',
				'title' => __('Forgot password'),
				'url'  => '/account/forgot_password'
			),
			'preview_account' => array(
				'class' => 'preview_account',
				'title' => __('Preview Account'),
				'url'  => '/account/'
			),
			'edit_account' => array(
				'class' => 'edit_account',
				'title' => __('Edit Account'),
				'url'  => '/account/edit'
			),
		);
		$this->set('linkLogin', $linkLogin);
		$loginButton = array(
			'login' => array(
				'title' => __('Login'),
				'name' => 'template',
				'class' => 'btn-default',
				'value' => 'login'
			)
		);
		$this->set('loginButton', $loginButton);
		
		// Logout Form
		$logoutButton = array(
			'logout' => array(
				'title' => __('Logout'),
				'name' => 'template',
				'class' => 'btn-default',
				'value' => 'logout'
			)
		);
		$this->set('logoutButton', $logoutButton);
		
		// Subscribe Form
		/*
		$subscribeForm = array(
			'name' => array(
				'label' => __('Name'),
				'name' => 'Subscribe.name',
				'type' => 'text',
				'placeholder' => __('Input your name')
			),
			'email' => array(
				'label' => __('Email'),
				'name' => 'Subscribe.email',
				'type' => 'text',
				'placeholder' => __('account@domain')
			)
		);
		$this->set('subscribeForm', $subscribeForm);
		$subscribeButton= array(
			'subscribe' => array(
				'title' => __('Subscribe now'),
				'name' => 'template',
				'value' => 'subscribe'
				//'class' => 'width-medium green'
			)
		);
		$this->set('subscribeButton', $subscribeButton);
		*/
		
		// Contact us Form
		/*
		$contactUsForm = array(
			'firstname' => array(
				'label' => __('First name'),
				'name' => 'Contact_info.firstname',
				'type' => 'text',
				'placeholder' => __('Input your first name')
			),
			'lastname' => array(
				'label' => __('Last name'),
				'name' => 'Contact_info.lastname',
				'type' => 'text',
				'placeholder' => __('Input your last name')
			),
			'email' => array(
				'label' => __('Email'),
				'name' => 'Contact_info.email',
				'type' => 'text',
				'placeholder' => __('account@domain')
			),
			'phone' => array(
				'label' => __('Phone'),
				'name' => 'Contact_info.phone',
				'type' => 'text',
				'placeholder' => __('Input your phone number')
			),
			'address' => array(
				'label' => __('Address'),
				'name' => 'Contact_info.address',
				'type' => 'text',
				'placeholder' => __('Input your address')
			),
			'title' => array(
				'label' => __('Title'),
				'name' => 'Contact_info.title',
				'type' => 'text',
				'placeholder' => __('Input your title')
			),
			'content' => array(
				'label' => __('Content'),
				'name' => 'Contact_info.content',
				'type' => 'textarea',
				'placeholder' => __('Input your content')
			)
		);
		$this->set('contactUsForm', $contactUsForm);
		
		$contactUsLink = array(
			'registration' => array(
				'class' => 'fr',
				'title' => __('Registry to get more features'),
				'url'  => '/account/signin'
			)
		);
		$this->set('contactUsLink', $contactUsLink);
		$contactUsButton= array(
			'contact' => array(
				'title' => __('Contact now'),
				'name' => 'template',
				'value' => 'contact_info',
				'class' => 'width-small green m0'
			)
		);
		$this->set('contactUsButton', $contactUsButton);
		*/
		
		// Search form
		/*
		$search = array(
			'form' => array(
				//'type' => 'get',
				'url' => '/search/'
			),
			'keyword' => array(
				'div' => false,
				'label' => __('Keyword'),
				'name' => 'Search.keyword',
				'class' => '',
				'type' => 'text',
				'placeholder' => __('Keyword')
			),
			'country' => array(
				'div' => false,
				'label' => false,
				'name' => 'Search.country_id',
				'class' => 'country',
				'model' => 'Search',
				'empty' => __('All countries'),
				'selected' => isset($post['Search']['country_id']) ? $post['Search']['country_id'] : $this->current_country_id,
				'options' => $this->countries
			),
			'location' => array(
				'div' => false,
				'label' => false,
				'name' => 'Search.location_id',
				'class' => 'location',
				'empty' => __('All locations'),
				'selected' => isset($post['Search']['location_id']) ? $post['Search']['location_id'] : '',
				'options' => !empty($this->locations) ? $this->locations : array()
			),
			'properties_type' => array(
				'div' => false,
				'label' => false,
				'name' => 'Search.properties_type_id',
				'empty' => __('Properties types'),
				'selected' => isset($post['Search']['properties_type_id']) ? $post['Search']['properties_type_id'] : '',
				'options' => $this->properties_types
			),
			'purpose' => array(
				'div' => false,
				'label' => false,
				'name' => 'Search.purpose_id',
				'empty' => __('Purposes'),
				'selected' => isset($post['Search']['purpose_id']) ? $post['Search']['purpose_id'] : '',
				'options' => $this->purposes
			),
			'price_from' => array(
				'div' => false,
				'label' => false,
				'name' => 'Search.price_from',
				'class' => 'width-small',
				'type' => 'text',
				'placeholder' => __('From')
			),
			'price_to' => array(
				'div' => false,
				'label' => false,
				'name' => 'Search.price_to',
				'class' => 'width-small',
				'type' => 'text',
				'placeholder' => __('To')
			),
			'area_from' => array(
				'div' => false,
				'label' => false,
				'name' => 'Search.area_from',
				'class' => 'width-small',
				'type' => 'text',
				'placeholder' => __('From')
			),
			'area_to' => array(
				'div' => false,
				'label' => false,
				'name' => 'Search.area_to',
				'class' => 'width-small',
				'type' => 'text',
				'placeholder' => __('To')
			),
			'currency' => array(
				'div' => false,
				'label' => false,
				'name' => 'Search.currency_id',
				'class' => 'black-bt',
				'empty' => __('All currencies'),
				'selected' => isset($post['Search']['currency_id']) ? $post['Search']['currency_id'] : 0,
				'options' => $this->currencies
			),
			'price_type' => array(
				'div' => false,
				'label' => false,
				'name' => 'Search.price_type_id',
				'class' => 'black-bt',
				'empty' => __('All price types'),
				'selected' => isset($post['Search']['price_type_id']) ? $post['Search']['price_type_id'] : 0,
				'options' => $this->price_types
			),
			'square' => array(
				'div' => false,
				'label' => false,
				'name' => 'Search.square_id',
				'class' => 'black-bt',
				'empty' => __('All squares'),
				'selected' => isset($post['Search']['square_id']) ? $post['Search']['square_id'] : 0,
				'options' => $this->squares
			),
		);
		$this->set('search', $search);
		
		$searchButton = array(
			'search' => array(
				'title' => '<i class="icon_search"></i>' . __('Search now'),
				'name' => 'template',
				'value' => 'search',
				'class' => 'black-bt m-0'
			)
		);
		$this->set('searchButton', $searchButton);
		*/
	}
}