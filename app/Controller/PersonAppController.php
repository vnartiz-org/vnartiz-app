<?php
App::uses('AppController', 'Controller');
class PersonAppController extends GuestController {
	
	public $components = array(
		//'DebugKit.Toolbar' => array('panels' => array('history', 'session')),
	);

	public $countries;
	public $locations;
	public $majors;
	public $rates;
	
	public $models = array(
		'Account_type',
		'Account',
		'Contact',
		'Key',
		
		'Card',
		'Card_type',
		
		'Avatar',
		'Contact_info',
		'Search',
		
		'Company',
		'Logo',
		
		'Account_type',
		'Account',

		'Company_profile',
		'Rate',
		'Country',
		'Location',
		'Major'
	);
	
	//public function beforeFilter() {
		/*
		parent::beforeFilter();
		
		// Set User agent
		if (!$this->Session->read('user_agent')) {
			if ($user_agent = $this->set_user_agent($this->ip_address())) {
				
			}
		}

		// Load Model
		$this->loadModel($this->models);
		
		$this->setMember();
		$this->doTemplate();
		if ($this->member) {
			$this->resetMember();
		}
		*/
	//}
	
	public function view_active() {
		//$this->layout = 'default';
	}

	/**
	 * Check member login already
	 *
	 * @author anh_dung
	 */
	public function setMember($member = null) {
		if (!$member) {
			if ($member = $this->Session->read('member')) {
				// Success
			}
		}
		if ($member['Account']['account_type_id'] == 1) {
			$this->member = $member;
			$this->set('member', $this->member);
		}
	}

	/**
	 * Check member login already
	 *
	 * @author anh_dung
	 */
	public function resetMember($id = null) {
		
		$params = array(
			'recursive' => 3,
			'conditions' => array(
				'Account.id' => $id ? $id : (isset($this->member['Account']['id']) ? $this->member['Account']['id'] : 0),
				'Account.account_type_id' => 1,
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
	 * Check is member
	 *
	 * @author anh_dung
	 */
	public function isMember($username = null, $password = null) {
		if (!$username || !$password) {
			return false;
		}
		$params = array(
			'recursive' => 3,
			'conditions' => array(
				'Account.username' => $username,
				'Account.password' => $password,
				'Account.account_type_id' => 1,
			),
		);
		if ($member = $this->Account->find('all', $params)) {		
			$this->Session->write('member', $member[0]);
			$this->member = $this->Session->read('member');
			$this->set('member', $this->member);
			return true;
		} 
		return false;
	}
	
	/**
	 * Change load view by local on page controller
	 *
	 * @author anh_dung
	 */
	public function pageBeforeFilter() {
		$locale = $this->current_language;
		if ($locale) {
			// e.g. use /app/View/fra/Pages/tos.ctp instead of /app/View/Pages/tos.ctp
			$this->viewPath = $locale . DS . $this->viewPath;
			
		}
	}
	
	/**
	 * Process form for template
	 *
	 * @author anh_dung
	 */
	public function doTemplate() {
		/*
		// Get rate
		$rate_list = $this->Rate->find('all');
		foreach ($rate_list as $item) {
			$this->rates[$item['Rate']['id']] = $item['Rate']['name'];
		}
		$this->set('rates', $this->rates);
		
		// Get major
		$params = array(
			'order' => array('name ASC'),
			'conditions' => array(
				'Major.disable' => 0,
			)
		);
		$major_list = $this->Major->find('all', $params);
		foreach ($major_list as $item) {
			$this->majors[$item['Major']['id']] = __($item['Major']['name']);
		}
		$this->set('majors', $this->majors);
		*/
		// Get salaries
		/*
		$salary_list = $this->Salary->find('all');
		foreach ($salary_list as $item) {
			$this->salaries[$item['Salary']['id']] = __($item['Salary']['mount']);
		}
		$this->set('salaries', $this->salaries);
		*/
		
		// Get country
		/*
		$country_list = $this->Country->find('all');
		foreach ($country_list as $item) {
			$this->countries[$item['Country']['id']] = $item['Country']['name'];
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
		*/
		// Get durations
		/*
		$duration_list = $this->Duration->find('all');
		foreach ($duration_list as $item) {
			$this->durations[$item['Duration']['id']] = __($item['Duration']['title']);
		}
		$this->set('durations', $this->durations);
		*/
		
		if (($post = $this->request->data) && isset($post['template'])) {
			switch ($post['template']) {
				/*
				// Check login post
				case 'login': {
					if ($this->isMember($post['Account']['username'], $post['Account']['password'])) {
						$this->set('loginMessage', __('You were login success.'));
					} else {
						$this->set('loginError', __('This account was not available!'));
					}
					break;
				}
				
				// Check logout post
				case 'logout': {
					$this->Session->destroy();
					$this->redirect('/');
				}
				
				// Check subscribe post
				
				case 'subscribe': {
					if ($subscribe = $this->Subscribe->saveAll($post)) {
						$this->set('subscribeMessage', __('Subscribe success.'));
					} else {
						$this->set('subscribeError', __('Subscribe fail.'));
					}
					break;
				}
				*/
				// Check contact us post
				/*
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
		
		//  Check language
		/*
		if (($post = $this->request->data) && isset($post['language']['lang'])) {
			switch($post['language']['lang']) {
				case 'vie':
				case 'jap':
					$this->Session->write('Config.language' , $post['language']['lang']);
					break;
				default:
					$this->Session->write('Config.language' , 'eng');
			}
		}
		if (!$this->current_language = $this->Session->read('Config.language')) {
			$this->current_language = 'eng';
		}
		Configure::write('Config.language', $this->current_language);
		$this->set('current_language', $this->current_language);
		//Configure::read('Config.language');
		if ($this->params['controller'] == 'page') {
			$this->pageBeforeFilter();
		}
		*/
		
		// Login Form
		/*
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
			'create_an_account' => array(
				'class' => 'login pl-0',
				'title' => __('Create an account'),
				'url'  => '/account/signin'
			),
			'forgot_password' => array(
				'class' => 'forgot_password',
				'title' => __('Forgot password'),
				'url'  => '/account/forgot_password'
			),
			'preview_account' => array(
				'class' => 'preview_account',
				'title' => __('Hello') . ' ' . $this->member['Contact']['firstname'],
				'url'  => '/account/'
			),
			'edit_account' => array(
				'class' => 'edit_account',
				'title' => __('Edit'),
				'url'  => '/account/edit'
			),
		);
		$this->set('linkLogin', $linkLogin);
		$loginButton = array(
			'login' => array(
				'title' => __('Login now'),
				'name' => 'template',
				'class' => 'button green',
				'value' => 'login'
			)
		);
		$this->set('loginButton', $loginButton);
		
		
		// Logout Form
		$logoutButton = array(
			'logout' => array(
				'title' => __('Logout'),
				'name' => 'template',
				'class' => 'button green m-0-5',
				'value' => 'logout'
			)
		);
		$this->set('logoutButton', $logoutButton);
		*/
		// Sponsor
		/*
		$params = array(
			'recursive' => 2,
			'order' => 'Promotion.id DESC',
			'conditions' => array(
				'Promotion.company_id <>' => 0,
				'Promotion.start <=' => date('Y-m-d'),
				'Promotion.expire_date >=' => date('Y-m-d'),
				'Promotion.disable' => 0,
			)
		);
		$sponsors = $this->Promotion->find('all', $params);
		$this->set('sponsors', $sponsors);
		*/
		// Consultant
		/*
		$params = array(
			'limit' => 6,
			'order' => 'Consultant.id DESC',
			'conditions' => array(
				'Consultant.account_type_id' => 1,
				'Consultant.disable' => 0,
			)
		);
		$vi_consultants = $this->Consultant->find('all', $params);
		$this->set('vi_consultants', $vi_consultants);
		*/
		
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
		
		// Get major
		$params = array(
			'conditions' => array(
				'Major.disable' => 0,
			)
		);
		
		
		// Get country
		$country_list = $this->Country->find('all');
		foreach ($country_list as $item) {
			$countries[$item['Country']['id']] = $item['Country']['name'];
		}
		
		// Get location
		$locations = array();
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
		}
		
		// Search form
		if ($this->params['controller'] != 'company') {
			$searchForm = array(
				'method' => 'get',
				'accept-charset' => 'UTF-8',
				'url' => '/search/job/',
			);
		} else {
			$searchForm = array(
				'method' => 'get',
				'url' => '/company/',
			);
		}
		$this->set('searchForm', $searchForm);
		$search = array(
			'keyword' => array(
				'label' => false,
				'name' => 'Search.keyword',
				'type' => 'text',
				'placeholder' => __('Keyword')
			),
			'major' => array(
				'label' => false,
				'name' => 'Search.major_id',
				'class' => 'major',
				'empty' => __('All majors'),
				'selected' => isset($post['Search']['major_id']) ? $post['Search']['major_id'] : '',
				'options' => $this->majors
			),
			'country' => array(
				'label' => false,
				'name' => 'Search.country_id',
				'class' => 'country',
				'model' => 'Search',
				'empty' => __('All countries'),
				'selected' => isset($post['Search']['country_id']) ? $post['Search']['country_id'] : '',
				'options' => $countries
			),
			'location' => array(
				'label' => false,
				'name' => 'Search.location_id',
				'class' => 'location',
				'empty' => __('All locations'),
				'selected' => isset($post['Search']['location_id']) ? $post['Search']['location_id'] : '',
				'options' => $locations
			),
		);
		$this->set('search', $search);
		$searchButton= array(
			'search' => array(
				'title' => __('Search now'),
				'name' => 'template',
				'value' => 'search',
				'class' => 'width-medium green'
			)
		);
		$this->set('searchButton', $searchButton);
		
		//  Check language
		if (($post = $this->request->data) && isset($post['language']['lang'])) {
			if (!empty($post['language']['lang'])) {
				switch($post['language']['lang']) {
					case 'eng':
					case 'jap':
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
			'jap' => array(
				'label' => false,
				'name' => 'language.lang',
				'type' => 'hidden',
				'value' => 'jap'
			),
		);
		$this->set('language', $language);
	}
}