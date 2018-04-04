<?php
App::uses('Controller', 'Controller');
class CronController extends AppController {
	
	public $salaries;
	public $countries;
	public $locations;
	public $majors;
	public $rates;
	public $vi_consultants;
	
	public $limit = 2;
	public $models = array(
		'Auto_subscribe',
		'Account_type',
		'Auto_subscribes_type',
		'Auto_subscribes_employee',
		'Auto_subscribes_employer',
		
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
	);
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout=null;
		$this->loadModel($this->models);
		$this->doTemplate();
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
			$this->rates[$item['Rate']['id']] = $item['Rate']['name'];
		}
		$this->set('rates', $this->rates);
		
		// Get major
		$major_list = $this->Major->find('all');
		foreach ($major_list as $item) {
			$this->majors[$item['Major']['id']] = $item['Major']['name'];
		}
		$this->set('majors', $this->majors);
		
		// Get salaries
		$salary_list = $this->Salary->find('all');
		foreach ($salary_list as $item) {
			$this->salaries[$item['Salary']['id']] = $item['Salary']['mount'];
		}
		$this->set('salaries', $this->salaries);
		
		// Get country
		$country_list = $this->Country->find('all');
		foreach ($country_list as $item) {
			$this->countries[$item['Country']['id']] = $item['Country']['name'];
		}
		$this->set('countries', $this->countries);
		
		// Get location
		$location_list = $this->Location->find('all');
		foreach ($location_list as $item) {
			$this->locations[$item['Location']['id']] = $item['Location']['name'];
		}
		$this->set('locations', $this->locations);
		
		// Consultant
		$params = array(
			'limit' => 3,
			'order' => 'Consultant.id DESC',
			'conditions' => array(
				'Consultant.account_type_id' => 1,
				'Consultant.disable' => 0,
			)
		);
		$this->vi_consultants = $this->Consultant->find('all', $params);
		//$this->set('vi_consultants', $vi_consultants);
	}
	
	public function auto_subscribe_employer() {
		
		// Check the action is being invoked by the cron dispatcher 
		//if (!defined('CRON_DISPATCHER')) { $this->redirect('/'); exit(); } 

		//no view
		$this->autoRender = false;
		
		// Account type
		$params = array(
			'conditions' => array(
				'name' => 'Employer',
				'disable' => 0,
			)
		);
		$account_type = $this->Account_type->find('first', $params);
		$current_subscribe = (int)$account_type['Account_type']['current_subscribe'];
		
		// Employer
		$params = array(
			'limit' => 2,
			'page' => $current_subscribe,
			'conditions' => array(
				'is_employee' => 0,
				'disable' => 0,
			)
		);
		if ($employers = $this->Auto_subscribe->find('all', $params)) {
			foreach($employers as $key => $employer) {
				// Check mail is availability
				if (!$isSend = $this->verifyEmail($employer['Auto_subscribe']['email'])) {
					var_dump($isSend);
					$params = array(
						'Auto_subscribe' => array(
							'id' => $employer['Auto_subscribe']['id'],
							'disable' => 1
						)
					);
					$this->Auto_subscribe->saveAll($params);
				} else {
					$params = array(
						'template' => 'employer',
						'content' => 'auto_subscribe_employer',
						'subject' => 'Welcome | Employer | ViRecruitment',
						'to' => $employer['Auto_subscribe']['email'],
					);
					$this->sendMail($params);
				}
			}
		}

		if (!empty($employers)) {
			$current_subscribe += 1;
		} else {
			$current_subscribe = 0;
		}
		
		// Update auto subscribe
		$params = array(
			'Account_type' => array(
				'id' => $account_type['Account_type']['id'],
				'current_subscribe' => $current_subscribe
			)
		);
		$this->Account_type->saveAll($params);
		if (!empty($cc)) {
			//var_dump($cc);
			// Send mail
		}
		if (!$employers) {
			//$this->auto_subscribe_employer();
		}
		exit;
	}
	
	/* Auto subscribe employee */
	public function auto_subscribe_employee() {
		
		$this->doTemplate();
		
		// Check the action is being invoked by the cron dispatcher 
		//if (!defined('CRON_DISPATCHER')) { $this->redirect('/'); exit(); } 

		//no view
		$this->autoRender = false;
		
		// Account type
		$params = array(
			'conditions' => array(
				'name' => 'Employee',
				'disable' => 0,
			)
		);
		$account_type = $this->Account_type->find('first', $params);
		$current_subscribe = (int)$account_type['Account_type']['current_subscribe'];
		
		// Employer
		$params = array(
			'limit' => 50,
			'page' => $current_subscribe,
			'conditions' => array(
				'is_employee' => 1,
				'disable' => 0,
			)
		);

		// Get recruiter no offer
		$no_offer_params = array(
			'recursive' => 2,
			'limit' => 10,
			'page' => 1,
			'order' => 'Recruiter.id DESC',
			'conditions' => array(
				'Recruiter.offer' => 0,
				'Recruiter.start <=' => date('Y-m-d'),
				'Recruiter.expire_date >=' => date('Y-m-d'),
				'Recruiter.disable' => 0
			)
		);
		if (!$no_offer_recruiters = $this->Recruiter->find('all', $no_offer_params)) {
			$no_offer_recruiters = __('Job was not available.');
		}
		//var_dump($no_offer_recruiters);
		
		if ($employees = $this->Auto_subscribe->find('all', $params)) {
			foreach($employees as $key => $employee) {
				// Check mail is availability
				if (!$isSend = $this->verifyEmail($employee['Auto_subscribe']['email'])) {
					var_dump($isSend);
					$params = array(
						'Auto_subscribe' => array(
							'id' => $employee['Auto_subscribe']['id'],
							'disable' => 1
						)
					);
					$this->Auto_subscribe->saveAll($params);
				} else {
					$params = array(
						'template' => 'employee_auto_subscribe',
						'content' => 'auto_subscribe_employee',
						'subject' => 'Welcome | Employee | ViRecruitment',
						'to' => $employee['Auto_subscribe']['email'],
					);
					$params['value']['webroot'] = 'http://recruit.vnartistworld.com/';
					$params['value']['majors'] = $this->majors;
					$params['value']['rates'] = $this->rates;
					$params['value']['salaries'] = $this->salaries;
					$params['value']['recruiters'] = $this->recruiters;
					$params['value']['locations'] = $this->locations;
					$params['value']['countries'] = $this->countries;
					$params['value']['jobs'] = $no_offer_recruiters;
					$params['value']['vi_consultants'] = $this->vi_consultants;
					$this->sendMail($params);
				}
			}
		}

		if (count($employees)) {
			$current_subscribe += 1;
		} else {
			$current_subscribe = 0;
		}
		
		// Update auto subscribe
		$params = array(
			'Account_type' => array(
				'id' => $account_type['Account_type']['id'],
				'current_subscribe' => $current_subscribe
			)
		);
		$this->Account_type->saveAll($params);
		
		if (!empty($cc)) {
			// var_dump($cc);
			// Send mail
		}
		if (!$employees) {
			//$this->auto_subscribe_employee();
		}
		exit;
	}
	
	/* Auto subscribes test Thu Suong */
	public function auto_subscribe_employee_test_thusuong() {
		
		$this->doTemplate();
		
		// Check the action is being invoked by the cron dispatcher 
		//if (!defined('CRON_DISPATCHER')) { $this->redirect('/'); exit(); } 

		//no view
		$this->autoRender = false;
		
		// Account type
		$params = array(
			'conditions' => array(
				'subscribes_name' => 'test_thusuong',
				'account_type_id' => 1,
				'disable' => 0,
			)
		);
		$subscribes_type = $this->Subscribes_type->find('first', $params);
		$current_subscribe = (int)$subscribes_type['Subscribes_type']['current_subscribe'];
		
		// Employee
		$params = array(
			'limit' => 50,
			'page' => $current_subscribe,
			'conditions' => array(
				'subscribes_type_id' => 1, // test_thusuong
				'disable' => 0,
			)
		);
		
		// Get recruiter no offer
		$no_offer_params = array(
			'recursive' => 2,
			'limit' => 10,
			'page' => 1,
			'order' => 'Recruiter.id DESC',
			'conditions' => array(
				'Recruiter.offer' => 0,
				'Recruiter.start <=' => date('Y-m-d'),
				'Recruiter.expire_date >=' => date('Y-m-d'),
				'Recruiter.disable' => 0
			)
		);
		if (!$no_offer_recruiters = $this->Recruiter->find('all', $no_offer_params)) {
			$no_offer_recruiters = __('Job was not available.');
		}
		//var_dump($no_offer_recruiters);
		
		if ($employees = $this->Auto_subscribes_employee->find('all', $params)) {
			foreach($employees as $key => $employee) {
				// Check mail is unique
				$params = array(
					'conditions' => array(
						'email' => $employee['Auto_subscribes_employee']['email'],
						'subscribes_type_id' => 1, // test_thusuong
						'disable' => 0,
					)
				);
				$count_employees = $this->Auto_subscribes_employee->find('count', $params);
				var_dump($count_employees);
				var_dump($employee['Auto_subscribes_employee']['email']);
				var_dump('<br/>');
				if ($count_employees >= 2) {
					$params = array(
						'Auto_subscribes_employee' => array(
							'id' => $employee['Auto_subscribes_employee']['id'],
							'hidden' => 1
						)
					);
					$this->Auto_subscribes_employee->saveAll($params);
				}
				
				// Check mail is availability
				if (!$isSend = $this->verifyEmail($employee['Auto_subscribes_employee']['email'])) {
					
					$params = array(
						'Auto_subscribes_employee' => array(
							'id' => $employee['Auto_subscribes_employee']['id'],
							'disable' => 1
						)
					);
					$this->Auto_subscribes_employee->saveAll($params);
				} else {
					$params = array(
						'template' => 'employee_auto_subscribe',
						'content' => 'auto_subscribe_employee',
						'subject' => 'Welcome | Employee extension| ViRecruitment',
						'to' => $employee['Auto_subscribes_employee']['email'],
					);
					$params['value']['webroot'] = 'http://recruit.vnartistworld.com/';
					$params['value']['majors'] = $this->majors;
					$params['value']['rates'] = $this->rates;
					$params['value']['salaries'] = $this->salaries;
					$params['value']['recruiters'] = $this->recruiters;
					$params['value']['locations'] = $this->locations;
					$params['value']['countries'] = $this->countries;
					$params['value']['jobs'] = $no_offer_recruiters;
					$params['value']['vi_consultants'] = $this->vi_consultants;
					$this->sendMail($params);
				}
			}
		}
		
		if (!empty($employees)) {
			$current_subscribe += 1;
		} else {
			$current_subscribe = 0;
		}
		
		// Update subscribes types
		$params = array(
			'Subscribes_type' => array(
				'id' => $subscribes_type['Subscribes_type']['id'],
				'current_subscribe' => $current_subscribe
			)
		);
		$this->Subscribes_type->saveAll($params);
		
		if (!empty($cc)) {
			//var_dump($cc);
			// Send mail
		}
		if (empty($employees)) {
			//$this->auto_subscribe_employer();
			var_dump($employees);
		}
		exit;
	}
	
	/* Auto subscribes employer test Thu Suong */
	public function auto_subscribe_employer_test_thusuong() {

		$this->doTemplate();

		// Check the action is being invoked by the cron dispatcher 
		//if (!defined('CRON_DISPATCHER')) { $this->redirect('/'); exit(); } 

		//no view
		$this->autoRender = false;

		// Account type
		$params = array(
			'conditions' => array(
				'subscribes_name' => 'employer_test_thusuong',
				'account_type_id' => 2,
				'disable' => 0,
			)
		);
		var_dump('giug');
		$auto_subscribes_type = $this->Auto_subscribes_type->find('first', $params);
		$current_subscribe = (int)$auto_subscribes_type['Auto_subscribes_type']['current_subscribe'];
		var_dump($current_subscribe);
		// Employer
		$params = array(
			'limit' => 1,
			'page' => 1,//$current_subscribe,
			'conditions' => array(
				'subscribes_type_id' => 2, // test_thusuong
				'disable' => 0,
			)
		);

		// Get recruiter no offer
		/*
		$no_offer_params = array(
			'recursive' => 2,
			'limit' => 10,
			'page' => 1,
			'order' => 'Recruiter.id DESC',
			'conditions' => array(
				'Recruiter.offer' => 0,
				'Recruiter.start <=' => date('Y-m-d'),
				'Recruiter.expire_date >=' => date('Y-m-d'),
				'Recruiter.disable' => 0
			)
		);
		if (!$no_offer_recruiters = $this->Recruiter->find('all', $no_offer_params)) {
			$no_offer_recruiters = __('Job was not available.');
		}
		//var_dump($no_offer_recruiters);
		*/
		
		if ($employers = $this->Auto_subscribes_employer->find('all', $params)) {
			var_dump($employers);
			foreach($employers as $key => $employer) {
				// Check mail is unique
				$params = array(
					'conditions' => array(
						'email' => $employer['Auto_subscribes_employer']['email'],
						'subscribes_type_id' => 2, //employer test_thusuong
						'disable' => 0,
					)
				);
				$count_employers = $this->Auto_subscribes_employer->find('count', $params);
				var_dump($count_employers);
				var_dump($employer['Auto_subscribes_employer']['email']);
				var_dump('<br/>');
				if ($count_employers >= 2) {
					$params = array(
						'Auto_subscribes_employer' => array(
							'id' => $employer['Auto_subscribes_employer']['id'],
							'hidden' => 1
						)
					);
					$this->Auto_subscribes_employer->saveAll($params);
				}
				
				// Check mail is availability
				if (!$isSend = $this->verifyEmail($employer['Auto_subscribes_employer']['email'])) {
					$params = array(
						'Auto_subscribes_employer' => array(
							'id' => $employer['Auto_subscribes_employer']['id'],
							'disable' => 1
						)
					);
					$this->Auto_subscribes_employer->saveAll($params);
				} else {
					$params = array(
						'template' => 'employer',
						'content' => 'auto_subscribe_employer',
						'subject' => 'Welcome | Employer extension| ViRecruitment',
						'to' => $employer['Auto_subscribes_employer']['email'],
					);
					$params['value']['webroot'] = 'http://recruit.vnartistworld.com/';
					$params['value']['majors'] = $this->majors;
					$params['value']['rates'] = $this->rates;
					$params['value']['salaries'] = $this->salaries;
					$params['value']['recruiters'] = $this->recruiters;
					$params['value']['locations'] = $this->locations;
					$params['value']['countries'] = $this->countries;
					//$params['value']['jobs'] = $no_offer_recruiters;
					$params['value']['vi_consultants'] = $this->vi_consultants;
					$this->sendMail($params);
				}
			}
		}
		
		if (!empty($employers)) {
			$current_subscribe += 1;
		} else {
			$current_subscribe = 0;
		}
		
		// Update subscribes types
		$params = array(
			'Subscribes_type' => array(
				'id' => $subscribes_type['Subscribes_type']['id'],
				'current_subscribe' => $current_subscribe
			)
		);
		$this->Auto_subscribes_type->saveAll($params);
		
		if (!empty($cc)) {
			//var_dump($cc);
			// Send mail
		}
		if (empty($employers)) {
			//$this->auto_subscribe_employer();
			var_dump('finish');
		}
		exit;
	}
	
	/* Check email is living or availability */
	function verifyEmail($toemail, $fromemail = '', $getdetails = false){
		$details = '';
		$result= false;
		$email_arr = explode("@", $toemail);
		$domain = array_slice($email_arr, -1);
		$domain = $domain[0];
		// Trim [ and ] from beginning and end of domain string, respectively
		$domain = ltrim($domain, "[");
		$domain = rtrim($domain, "]");
		if( "IPv6:" == substr($domain, 0, strlen("IPv6:")) ) {
			$domain = substr($domain, strlen("IPv6") + 1);
		}
		$mxhosts = array();
		if( filter_var($domain, FILTER_VALIDATE_IP) )
			$mx_ip = $domain;
		else
			getmxrr($domain, $mxhosts, $mxweight);
		if(!empty($mxhosts) )
			$mx_ip = $mxhosts[array_search(min($mxweight), $mxhosts)];
		else {
			if( filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ) {
				$record_a = dns_get_record($domain, DNS_A);
			}
			elseif( filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ) {
				$record_a = dns_get_record($domain, DNS_AAAA);
			}
			if( !empty($record_a) )
				$mx_ip = $record_a[0]['ip'];
			else {
				$result   = false;
				$details .= "No suitable MX records found.";
				return ( (true == $getdetails) ? array($result, $details) : $result );
			}
		}
		
		$connect = @fsockopen($mx_ip, 25); 
		if($connect){ 
			if(preg_match("/^220/i", $out = fgets($connect, 1024))){
				fputs ($connect , "HELO $mx_ip\r\n"); 
				$out = fgets ($connect, 1024);
				$details .= $out."\n";
	 
				fputs ($connect , "MAIL FROM: <$fromemail>\r\n"); 
				$from = fgets ($connect, 1024); 
				$details .= $from."\n";
				fputs ($connect , "RCPT TO: <$toemail>\r\n"); 
				$to = fgets ($connect, 1024);
				$details .= $to."\n";
				fputs ($connect , "QUIT"); 
				fclose($connect);
				if(!preg_match("/^250/i", $from) || !preg_match("/^250/i", $to)){
					$result = false; 
				}
				else{
					$result = "valid";
				}
			} 
		}
		else{
			$result = false;
			if (!empty($details)) {
				$details .= "Could not connect to server";
			} else {
				$details = "Could not connect to server";
			}
		}
		if($getdetails){
			return array($result, $details);
		}
		else{
			return $result;
		}
	}
}