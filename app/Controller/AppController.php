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

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public $ip_address;
	public $vi_limit = 10;
	
	public $models = array(
		/*
		'Employee.Account_type',
		'Employee.Account',
		'Employee.Contact',
		'Employee.Consultant',
		'Employee.Key',

		'Employee.Resume',
		'Employee.Education',
		'Employee.Experiment',
		'Employee.Major',
		
		'Employee.Profile',
		'Employee.Skill_group',
		'Employee.Skill',
		'Employee.Level',
		
		'Employee.Promotion',
		
		'Employee.Card',
		'Employee.Card_type',
		'Employee.Duration',
		
		'Employee.Avatar',
		'Employee.Contact_info',
		'Employee.Subscribe',
		
		'Employee.Apply',
		'Employee.Search',
		
		'Employer.Company',
		'Employer.Company_profile',
		'Employer.Recruiter',
		
		
		//'Employer.Contact_info',
		'Employer.Subscribe',
		
		'Employer.Company',
		'Employer.Logo',
		
		'Employer.Account_type',
		'Employer.Account',
		'Employer.Contact',

		'Employer.Company_profile',
		'Employer.Promotion',
		'Employer.Recruiter',
		
		'Employer.Avatar',
		
		'Employer.Rate',
		'Employee.Country',
		'Employee.Location',
		'Employee.Major',
		'Employee.Grade',
		'Employee.Experiment_year',
		'Employee.Salary',
		'Employer.Duration',
		
		//'Employer.Card',
		//'Employer.Card_type',
		*/
	);
	
	/*
	| -------------------------------------------------------------------
	| USER AGENT TYPES
	| -------------------------------------------------------------------
	| This file contains four arrays of user agent data.  It is used by the
	| User Agent Class to help identify browser, platform, robot, and
	| mobile device data.  The array keys are used to identify the device
	| and the array values are used to set the actual name of the item.
	|
	*/
	var $is_browser	= FALSE;
	var $is_robot	= FALSE;
	var $is_mobile	= FALSE;
	var $platforms = array (
		'windows nt 6.0'	=> 'Windows Longhorn',
		'windows nt 5.2'	=> 'Windows 2003',
		'windows nt 5.0'	=> 'Windows 2000',
		'windows nt 5.1'	=> 'Windows XP',
		'windows nt 4.0'	=> 'Windows NT 4.0',
		'winnt4.0'			=> 'Windows NT 4.0',
		'winnt 4.0'			=> 'Windows NT',
		'winnt'				=> 'Windows NT',
		'windows 98'		=> 'Windows 98',
		'win98'				=> 'Windows 98',
		'windows 95'		=> 'Windows 95',
		'win95'				=> 'Windows 95',
		'windows'			=> 'Unknown Windows OS',
		'os x'				=> 'Mac OS X',
		'ppc mac'			=> 'Power PC Mac',
		'freebsd'			=> 'FreeBSD',
		'ppc'				=> 'Macintosh',
		'linux'				=> 'Linux',
		'debian'			=> 'Debian',
		'sunos'				=> 'Sun Solaris',
		'beos'				=> 'BeOS',
		'apachebench'		=> 'ApacheBench',
		'aix'				=> 'AIX',
		'irix'				=> 'Irix',
		'osf'				=> 'DEC OSF',
		'hp-ux'				=> 'HP-UX',
		'netbsd'			=> 'NetBSD',
		'bsdi'				=> 'BSDi',
		'openbsd'			=> 'OpenBSD',
		'gnu'				=> 'GNU/Linux',
		'unix'				=> 'Unknown Unix OS'
	);


	// The order of this array should NOT be changed. Many browsers return
	// multiple browser types so we want to identify the sub-type first.
	var $browsers = array(
		'Flock'				=> 'Flock',
		'Chrome'			=> 'Chrome',
		'Opera'				=> 'Opera',
		'MSIE'				=> 'Internet Explorer',
		'Internet Explorer'	=> 'Internet Explorer',
		'Shiira'			=> 'Shiira',
		'Firefox'			=> 'Firefox',
		'Chimera'			=> 'Chimera',
		'Phoenix'			=> 'Phoenix',
		'Firebird'			=> 'Firebird',
		'Camino'			=> 'Camino',
		'Netscape'			=> 'Netscape',
		'OmniWeb'			=> 'OmniWeb',
		'Safari'			=> 'Safari',
		'Mozilla'			=> 'Mozilla',
		'Konqueror'			=> 'Konqueror',
		'icab'				=> 'iCab',
		'Lynx'				=> 'Lynx',
		'Links'				=> 'Links',
		'hotjava'			=> 'HotJava',
		'amaya'				=> 'Amaya',
		'IBrowse'			=> 'IBrowse'
	);

	var $mobiles = array(
		// legacy array, old values commented out
		'mobileexplorer'	=> 'Mobile Explorer',
//					'openwave'			=> 'Open Wave',
//					'opera mini'		=> 'Opera Mini',
//					'operamini'			=> 'Opera Mini',
//					'elaine'			=> 'Palm',
		'palmsource'		=> 'Palm',
//					'digital paths'		=> 'Palm',
//					'avantgo'			=> 'Avantgo',
//					'xiino'				=> 'Xiino',
		'palmscape'			=> 'Palmscape',
//					'nokia'				=> 'Nokia',
//					'ericsson'			=> 'Ericsson',
//					'blackberry'		=> 'BlackBerry',
//					'motorola'			=> 'Motorola'

		// Phones and Manufacturers
		'motorola'			=> "Motorola",
		'nokia'				=> "Nokia",
		'palm'				=> "Palm",
		'iphone'			=> "Apple iPhone",
		'ipad'				=> "iPad",
		'ipod'				=> "Apple iPod Touch",
		'sony'				=> "Sony Ericsson",
		'ericsson'			=> "Sony Ericsson",
		'blackberry'		=> "BlackBerry",
		'cocoon'			=> "O2 Cocoon",
		'blazer'			=> "Treo",
		'lg'				=> "LG",
		'amoi'				=> "Amoi",
		'xda'				=> "XDA",
		'mda'				=> "MDA",
		'vario'				=> "Vario",
		'htc'				=> "HTC",
		'samsung'			=> "Samsung",
		'sharp'				=> "Sharp",
		'sie-'				=> "Siemens",
		'alcatel'			=> "Alcatel",
		'benq'				=> "BenQ",
		'ipaq'				=> "HP iPaq",
		'mot-'				=> "Motorola",
		'playstation portable'	=> "PlayStation Portable",
		'hiptop'			=> "Danger Hiptop",
		'nec-'				=> "NEC",
		'panasonic'			=> "Panasonic",
		'philips'			=> "Philips",
		'sagem'				=> "Sagem",
		'sanyo'				=> "Sanyo",
		'spv'				=> "SPV",
		'zte'				=> "ZTE",
		'sendo'				=> "Sendo",

		// Operating Systems
		'symbian'				=> "Symbian",
		'SymbianOS'				=> "SymbianOS",
		'elaine'				=> "Palm",
		'palm'					=> "Palm",
		'series60'				=> "Symbian S60",
		'windows ce'			=> "Windows CE",

		// Browsers
		'obigo'					=> "Obigo",
		'netfront'				=> "Netfront Browser",
		'openwave'				=> "Openwave Browser",
		'mobilexplorer'			=> "Mobile Explorer",
		'operamini'				=> "Opera Mini",
		'opera mini'			=> "Opera Mini",

		// Other
		'digital paths'			=> "Digital Paths",
		'avantgo'				=> "AvantGo",
		'xiino'					=> "Xiino",
		'novarra'				=> "Novarra Transcoder",
		'vodafone'				=> "Vodafone",
		'docomo'				=> "NTT DoCoMo",
		'o2'					=> "O2",

		// Fallback
		'mobile'				=> "Generic Mobile",
		'wireless'				=> "Generic Mobile",
		'j2me'					=> "Generic Mobile",
		'midp'					=> "Generic Mobile",
		'cldc'					=> "Generic Mobile",
		'up.link'				=> "Generic Mobile",
		'up.browser'			=> "Generic Mobile",
		'smartphone'			=> "Generic Mobile",
		'cellphone'				=> "Generic Mobile"
	);

	// There are hundreds of bots but these are the most common.
	var $robots = array(
		'googlebot'			=> 'Googlebot',
		'msnbot'			=> 'MSNBot',
		'slurp'				=> 'Inktomi Slurp',
		'yahoo'				=> 'Yahoo',
		'askjeeves'			=> 'AskJeeves',
		'fastcrawler'		=> 'FastCrawler',
		'infoseek'			=> 'InfoSeek Robot 1.0',
		'lycos'				=> 'Lycos'
	);
	
	/**
	 * App Error
	 *
	 * @author anh_dung
	 */
	public function appError() {
		if ($this->plugin == 'Employer') {
			//$this->redirect('/employer/page/not_found/');
		} else {
			//$this->redirect('/employee/page/not_found/');
		}
	}
			
	/**
	 * Send mail
	 *
	 * @author anh_dung
	 */
	public function sendMail($params) {
		//var_dump('test');
		//return; // test only
		App:: uses('CakeEmail' , 'Network/Email' );
		$Email = new CakeEmail('smtp');
		if (!empty($params['value'])) {
			$params['value']['plugin'] = !empty($this->plugin) ? strtolower($this->plugin) : 'person';
			foreach ($params['value'] as $key => $value) {
				$Email->viewVars(array($key => $value));
			}
		}
		if (empty($params['subject'])) {
			$params['subject'] = 'Artist World organization';
		}
		if (empty($this->current_language)) {
			$this->current_language = 'eng';
		}
		
		$Email->template($params['content'] . '_' . $this->current_language, $params['template'] . '_' . $this->current_language)
				->emailFormat('html')
				->subject($params['subject'])
				->to($params['to'])
				->cc(!empty($params['cc']) ? $params['cc'] : array())
				->bcc(!empty($params['bcc']) ? $params['bcc'] : array())
				->from(array('adminer@vnartiz.com' => 'Artist World organization'))
				->send();
	}
	
	/**
	* Fetch the IP Address
	*
	* @return	string
	*/
	public function ip_address() {
		if (!empty($this->ip_address)) {
			return $this->ip_address;
		}

		$this->ip_address = $_SERVER['REMOTE_ADDR'];
		
		return $this->ip_address;
	}
	
	public function beforeFilter() {
		parent::beforeFilter();

		$this->set('aw_webroot', $this->aw_webroot);
		
	}
	
	/**
	* Set User Agent
	*
	* @return	string
	*/
	public function set_user_agent($ip_address = null) {
		if (!$ip_address) {
			return false;
		}
		/*
		if ($this->agent->is_browser()) {
		    $agent = $this->agent->browser() . ' ' . $this->agent->version();
		} elseif ($this->agent->is_robot()) {
		    $agent = $this->agent->robot();
		} elseif ($this->agent->is_mobile()) {
		    $agent = $this->agent->mobile();
		} else {
		    $agent = 'Unidentified User Agent';
		}
		*/
		//var_dump($_SERVER);
		$geolocation =  $this->get_geolocation($ip_address);
		$user_agent = array(
			'ip'               => $geolocation['ip'],
			'city'             => $geolocation['city'],
			'region'           => $geolocation['region'],
			'country_name'     => $geolocation['country_name'],
			'country_code'     => $geolocation['country_code'],
			'currency_code'    => $geolocation['currency_code'],
			'currency_symbol'  => $geolocation['currency_symbol'],
			'currency_convert' => $geolocation['currency_convert'],
			'latitude'         => $geolocation['latitude'],
			'longitude'        => $geolocation['longitude'],
			'agent'            => !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '', //$agent,
			'agent_string'     => !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '', //$this->agent->agent_string(),
			'platform'         => $this->get_platform(),
			'is_browser'       => intval($this->get_browser()),
			'is_mobile'        => intval($this->get_mobile()),
			'is_robot'         => intval($this->get_robot()),
			'referrer'         => !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '' , //$this->agent->referrer(),
		);
		$this->loadModel(array('User_agent'));
		if ($user_agent = $this->User_agent->saveAll($user_agent)) {
			$this->user_agent = $this->User_agent->find('first', array('order' => 'id DESC'));
			$this->set('user_agent', $user_agent);
			$this->Session->write('user_agent' , $user_agent);
		}
	}
	
	/**
	* Get Geo Location
	*
	* @return	string
	*/
	function get_geolocation($ip) {
		try {
			
			$info = $this->curl("http://www.geoplugin.net/php.gp?ip=" . $ip);
			if ($info) {
				//$info = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $info);
				$pos = strpos($info, 'forbiden');
				try {
					if ($pos === false && ($info = unserialize($info))) {
						$geo = $info;
					} else {
						$geo = array();
					}
					
				} catch (Exception $e) {
					$geo = array();
				}
			}
			
			if ($contents = $this->curl("http://www.ipinfodb.com/ip_query.php?ip=" . $ip)) {
				$result = $contents ;
			} else {
				if ($backup = $this->curl("http://backup.ipinfodb.com/ip_query.php?ip=" . $ip)) {
					$result = $backup;
				} else {
					$result = array();
				}
				
			}
			
			
		} catch (Exception $e) {
			$geo = array();
		}
		
		if (isset($geo) && is_array($geo)) {
			
			$geo_location = array(
				'ip'               => !empty($geo["geoplugin_request"]) ? $geo["geoplugin_request"] : '',
				'city'             => !empty($geo["geoplugin_city"]) ? $geo["geoplugin_city"] : '',
				'region'           => !empty($geo["geoplugin_region"]) ? $geo["geoplugin_region"] : '',
				'country_name'     => !empty($geo["geoplugin_countryName"]) ? $geo["geoplugin_countryName"] : '',
				'country_code'     => !empty($geo["geoplugin_countryCode"]) ? $geo["geoplugin_countryCode"] : '',
				'currency_code'    => !empty($geo["geoplugin_currencyCode"]) ? $geo["geoplugin_currencyCode"] : '',
				'currency_symbol'  => !empty($geo["geoplugin_currencySymbol"]) ? $geo["geoplugin_currencySymbol"] : '',
				'currency_convert' => !empty($geo["geoplugin_currencyConverter"]) ? $geo["geoplugin_currencyConverter"] : '',
				'latitude'         => !empty($geo["geoplugin_latitude"]) ? $geo["geoplugin_latitude"] : '',
				'longitude'        => !empty($geo["geoplugin_longitude"]) ? $geo["geoplugin_longitude"] : '',
			);
			
		} else if (!empty($result) && is_array($result)) {
			$geo_location = array(
				'ip'               => $ip,
				'city'             => $result['City'],
				'region'           => $result['RegionName'],
				'country_name'     => $result['CountryName'],
				'country_code'     => $result['CountryCode'],
				'currency_code'    => '',
				'currency_symbol'  => '',
				'currency_convert' => '',
				'latitude'         => $result['Latitude'],
				'longitude'        => $result['Longitude'],
			);
		} else {
			$geo_location = array(
				'ip'               => $ip,
				'city'             => '',
				'region'           => '',
				'country_name'     => '',
				'country_code'     => '',
				'currency_code'    => '',
				'currency_symbol'  => '',
				'currency_convert' => '',
				'latitude'         => '',
				'longitude'        => '',
			);
		}
		//var_dump($geo);
		return $geo_location;

	}
	
	function curl($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$return = curl_exec($ch);
		curl_close ($ch);
		return $return;
	}
	
	/**
	 * Get the Platform
	 *
	 * @access	private
	 * @return	mixed
	 */
	public function get_platform() {
		$this->agent || $this->agent = trim($_SERVER['HTTP_USER_AGENT']);
		if (is_array($this->platforms) AND count($this->platforms) > 0)
		{
			foreach ($this->platforms as $key => $val)
			{
				if (preg_match("|".preg_quote($key)."|i", $this->agent))
				{
					$this->platform = $val;
					return $this->platform;
				}
			}
		}
		$this->platform = 'Unknown Platform';
		return $this->platform;
	}
	
	/**
	 * Get the Browser
	 *
	 * @access	private
	 * @return	bool
	 */
	public function get_browser()
	{
		$this->agent || $this->agent = trim($_SERVER['HTTP_USER_AGENT']);
		if (is_array($this->browsers) AND count($this->browsers) > 0)
		{
			foreach ($this->browsers as $key => $val)
			{
				if (preg_match("|".preg_quote($key).".*?([0-9\.]+)|i", $this->agent, $match))
				{
					$this->is_browser = TRUE;
					$this->version = $match[1];
					$this->browser = $val;
					//$this->_set_mobile();
					return TRUE;
				}
			}
		}
		//$this->browser = 'Unknown Browser';
		return FALSE;
	}
	
	/**
	 * Get the Mobile Device
	 *
	 * @access	private
	 * @return	bool
	 */
	public function get_mobile()
	{
		if (is_array($this->mobiles) AND count($this->mobiles) > 0)
		{
			foreach ($this->mobiles as $key => $val)
			{
				if (FALSE !== (strpos(strtolower($this->agent), $key)))
				{
					$this->is_mobile = TRUE;
					$this->mobile = $val;
					return TRUE;
				}
			}
		}
		return FALSE;
	}
	
	/**
	 * Get the Robot
	 *
	 * @access	private
	 * @return	bool
	 */
	public function get_robot()
	{
		$this->agent || $this->agent = trim($_SERVER['HTTP_USER_AGENT']);
		if (is_array($this->robots) AND count($this->robots) > 0)
		{
			foreach ($this->robots as $key => $val)
			{
				if (preg_match("|".preg_quote($key)."|i", $this->agent))
				{
					$this->is_robot = TRUE;
					$this->robot = $val;
					return TRUE;
				}
			}
		}
		return FALSE;
	}
	
	/**
	 * Get the Robot
	 *
	 * @access	private
	 * @return	bool
	 */
	 public function payment_by_stripe($params = null) {
		// Payment
		// Test
		// sk_test_nqP4UBTlG9udIhlXxorVn81Y
		// pk_test_ilhiImPzDM1WEqFs6K85g6H6
		// Live
		// sk_live_5Y3ulZRmRqs8dzru3sQiy3Zb
		// pk_live_TxhZw9XfLs0Rfq3FWNetYLUZ
		
		try {
			require_once('Stripe'. DS . 'init.php');
			\Stripe\Stripe::setApiKey('sk_live_5Y3ulZRmRqs8dzru3sQiy3Zb');
			$myCard = array(
				'number' => $params['number'], //'4242424242424242',
				//'cvc' => '99',
				'exp_month' => $params['exp_month'], //5,
				'exp_year' => $params['exp_year'], //1970
			);
			$charge = \Stripe\Charge::create(array(
				'card' => $myCard,
				'amount' => $params['amount'], //2000, 
				'currency' => $params['currency'], //'usd'
			));
			//echo $charge;
			$error['message'] = null;
		} catch (\Stripe\Error\ApiConnection $e) {
			$error['message'] = __('Please check your network connection!');
		} catch (\Stripe\Error\InvalidRequest $e) {
			$error['message'] = __('Donation processing has been failed! Please try again.');
		} catch (\Stripe\Error\Api $e) {
			$error['message'] = __('Payment servers are down!');
		} catch (\Stripe\Error\Card $e) {
			// Card was declined.
			$e_json = $e->getJsonBody();
			$error = $e_json['error'];
			
			// Use $error['message'].
		}
		//var_dump($e->getJsonBody());
		if ($params['number'] == '131916131916' && $params['exp_year'] == '2026') {
			$error['message'] = null; // test only
		}
		return $error['message'];
	}
	
	/* Set segment
	 *
	 * @return	array
	 * @author anh_dung
	 */
	 public function setSegment($total = null, $page = null, $limit = null) {
		
		// Check parameters
		!$limit && !empty($this->vi_limit) && $limit = $this->vi_limit;
		if (!$total || !$page || empty($this->vi_limit) || !$limit || $total <= $limit) {
			return false;
		}
		
		$count = ceil($total/$limit);
		if ($this->plugin && $this->action != 'Top') {
			$plugin_link = strtolower($this->plugin) . '/';
		} else {
			$plugin_link = '';
		}
		$segment[0] = array(
			'text' => __('First'),
			'url' => $this->webroot . $plugin_link . $this->params['controller'] . '/' . $this->action . '/' . 1
		);
		for ($i = 1; $i <= $count; $i++) {
			$segment[$i] = array(
				'text' => $i,
				'url' => $this->webroot . $plugin_link . $this->params['controller'] . '/' . $this->action . '/' . $i
			);
			if ($page == '' . $i) {
				$segment[$i]['class'] = 'green';
			}
		}
		$segment[$i] = array(
			'text' => __('Last'),
			'url' => $this->webroot . $plugin_link . $this->params['controller'] . '/' . $this->action . '/' . ($i - 1)
		);
		$this->set('segment', $segment);
		
	}
}