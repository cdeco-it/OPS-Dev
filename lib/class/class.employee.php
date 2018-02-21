<?php

	require_once('class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');
	
	/**
	 * Employee class handles all employee record information.
	 * Written: 8/31/2017
	 * By: S. Mized
	 */
	class Employee extends Db{

		private $firstname;
		private $lastname;
		private $middlename;
		private $prefix;
		private $suffix;
		private $dob;
		private $addr1;
		private $addr2;
		private $city;
		private $state;
		private $postcode;
		private $country;
		private $homephone;
		private $mobilephone;
		private $status;
		private $hiredate;
		private $acl;
		private $subscription;
		private $username;
		private $password;
		private $current_password;
		private $fetchid;
		private $dateModified;
		private $dateCreated;
		private $retData = array("success" => false , "message" => '' , "updateInfo" => '');
	
	/**
	 * Parent construction from class.db.php
	 */
		function __construct(){
			parent::__construct();
		}

/***** GETTER METHODS *****/
		
		/**
		 * getId returns the id
		 * @return int employee id
		 */
		public function getId(){
			return($this->fetchid);
		}

		/**
		 * getDateModified returns the date of last modification
		 * @return string SQL Formatted datestamp
		 */
		public function getDateModified(){
			return($this->dateModified);
		}

		/**
		 * getDateEntered returns the date of the initial record entry
		 * @return string SQL Formatted datestamp
		 */
		public function getDateCreated(){
			return($this->dateCreated);
		}

		/**
		 * getSubscription returns subscription status for an employee
		 * @return int subscrption status
		 */
		public function getSubscription(){
			return($this->subscription);
		}

		/**
		 * getACL returns the ACL level for an employee
		 * @return int ACL level
		 */
		public function getACL(){
			return($this->acl);
		}

		/**
		 * getHireDate returns the hire date for an employee
		 * @return string hire date in SQL format
		 */
		public function getHireDate(){
			return($this->hiredate);
		}

		/**
		 * getStatus returns the status for an employee
		 * @return int status
		 */
		public function getStatus(){
			return($this->status);
		}

		/**
		 * getMobilePhone returns the mobile phone for an employee
		 * @return string phone number
		 */
		public function getMobilePhone(){
			return($this->mobilephone);
		}

		/**
		 * getHomePhone returns the home phone for an employee
		 * @return string phone number
		 */
		public function getHomePhone(){
			return($this->homephone);
		}
		
		/**
		 * getAddress returns the complete address of an emlpoyee
		 * @return Array An array containing all address data
		 */
		public function getAddress(){
			$address = array(
				"addr1" => $this->addr1, 
				"addr2" => $this->addr2,
				"city" => $this->city,
				"state" => $this->state, 
				"postcode" => $this->postcode,
				"country" => $this->country);
			return($address);
		}

		/**
		 * getDob returns the date of birth for an employee
		 * @return string date of birth in SQL format
		 */
		public function getDob(){
			return($this->dob);
		}

		/**
		 * getName Returns all name data of an employee
		 * @return Array An assoc. array containing all name information
		 */
		public function getName(){
			$name = array(
				"prefix" => $this->prefix,
				"first" => $this->firstname,
				"middle" => $this->middlename,
				"last" => $this->lastname,
				"suffix" => $this->suffix);
			return($name);
		}

		/**
		 * getFirstName returns only the first name of an employee
		 * @return string String of the First Name
		 */
		public function getFirstName(){
			return($this->firstname);
		}

		/**
		 * getMiddleName returns only the middle name of an employee
		 * @return string String of the Middle Name
		 */
		public function getMiddleName(){
			return($this->middlename);
		}

		/**
		 * getLastName returns only the last name of an employee
		 * @return string String of the Last Name
		 */
		public function getLastName(){
			return($this->lastname);
		}

		/**
		 * getSuffix returns the associated value for an employee suffix
		 * @return int Int value of suffix found in common_suffix
		 */
		public function getSuffix(){
			return($this->suffix);
		}

		/**
		 * getPrefix returns the associated value for an employee prefix
		 * @return int Int value of prefix found in common_prefix
		 */
		public function getPrefix(){
			return($this->prefix);
		}

		/**
		 * getPassword returns the BCRYPT hash currently held in the database
		 * @return String Bcrypt HASH of password
		 */
		public function getPassword(){
			return($this->password);
		}

		/**
		 * getUsername returns a system username for the employee
		 * @return String String of the username
		 */
		public function getUsername(){
			return($this->username);
		}

/***** SETTER FUNCTIONS *****/ 
		
		/**
		 * setACL sets/changes the ACL value
		 * @param int $value ACL value
		 */
		public function setACL($value = NULL){
			if(is_null($value)){
				$this->acl = 4;
			}else{
				$this->acl = $value;	
			}
		}

		/**
		 * setModified sets the last date of modification to the record for the employee
		 * @param string $value SQL Formatted datestamp
		 */
		public function setDateModified($value = NULL){
			$this->dateModified = $value;
		}

		/**
		 * setDateEntered sets the initial record entry date for an empmloyee
		 * @param string $value SQL Formatted datestamp
		 */
		public function setDateCreated($value = NULL){
			$this->dateCreated = $value;
		}

		/**
		 * setSubscription sets/changes the subscription value
		 * @param int $value subcription value
		 */
		public function setSubscription($value = NULL ){
			$this->subscription = $value;
		}

		/**
		 * setStatus sets/changes the status value
		 * @param int $value status value
		 */
		public function setStatus($value = NULL ){
			$this->status = $value;
		}

		/**
		 * setHireDate sets/changes the hire date
		 * @param string $value hire date in SQL format
		 */
		public function setHireDate($value = NULL){
			if(empty($value) || is_null($value)){
				$this->hiredate = NULL;
			}else{
				$this->hiredate = $value;
			}

		}

		/**
		 * setMobilePhone sets/changes the mobile phone number
		 * @param string $value phone number
		 */
		public function setMobilePhone($value = NULL){
			if(empty($value) || is_null($value)){
				$this->mobilephone = NULL;
			}else{
				$this->mobilephone = $value;
			}
		}

		/**
		 * setHomePhone sets/changes the home phone number
		 * @param string $value phone number
		 */
		public function setHomePhone($value = NULL){
			if(empty($value) || is_null($value)){
				$this->homephone = NULL;
			}else{
				$this->homephone = $value;
			}
		}

		/**
		 * setAddress sets/changes all address data
		 * @param string $a1       Address line 1
		 * @param string $a2       Address line 2
		 * @param string $city     City
		 * @param int $state    State lookup value
		 * @param string $postcode Post code value
		 * @param int $country  Country lookup value
		 */
		public function setAddress($value = NULL){
			if(empty($value['addr1']) || is_null($value['addr1'])){
				$this->addr1 = NULL;
			}else{
				$this->addr1 = ucwords(strtolower($value['addr1']));
			}

			if(empty($value['addr2']) || is_null($value['addr2'])){
				$this->addr2 = NULL;
			}else{
				$this->addr2 = ucwords(strtolower($value['addr2']));
			}

			if(empty($value['city']) || is_null($value['city'])){
				$this->city = NULL;
			}else{
				$this->city = ucwords(strtolower($value['city']));
			}

			if(empty($value['state']) || is_null($value['state'])){
				$this->state = NULL;
			}else{
				$this->state = $value['state'];
			}

			if(empty($value['postcode']) || is_null($value['postcode'])){
				$this->postcode = NULL;
			}else{
				$this->postcode = $value['postcode'];
			}

			if(empty($value['country']) || is_null($value['country'])){
				$this->country = NULL;
			}else{
				$this->country = $value['country'];
			}

		}
		
		/**
		 * setDob sets/changes the date of birth
		 * @param string $value date of birt in SQL format
		 */
		public function setDob($value = NULL){
			if(empty($value) || is_null($value)){
				$this->dob = NULL;
			}else{
				$this->dob = $value;
			}
		}

		/**
		 * setSuffix sets/changes the name suffix
		 * @param int $suffix suffix lookup value
		 */
		public function setSuffix($suffix = NULL){
			if(!empty($suffix) || !is_null($suffix)){
				$this->suffix = $suffix;
			}else{
				$this->suffix = NULL;
			}
		}

		/**
		 * setPrefix sets/changes the name prefix
		 * @param int $prefix prefix lookup value
		 */
		public function setPrefix($prefix = NULL){
			if(!empty($prefix) || !is_null($prefix)){
				$this->prefix = $prefix;
			}else{
				$this->prefix = NULL;
			}
		}

		/**
		 * setName sets/changes all relative name values
		 * @param string $first  First name
		 * @param string $middle Middle name
		 * @param string $last   Last Name
		 */
		public function setName($first, $middle, $last){
			if(empty($first)){
				echo E_NO_FNAME;
				return false;
			}elseif(empty($last)){
				echo E_NO_LNAME;
				return false;
			}

			$this->firstname = ucwords(strtolower($first));
			$this->lastname = ucwords(strtolower($last));

			if((!empty($middle)) || (!is_null($middle))){
				$this->middlename = ucwords(strtolower($middle));
				return true;
			}else{
				$this->middlename = NULL;
				return true;
			}
		}

		/**
		 * setFirstName sets the first name for an employee
		 * @param String $first String representation of the first name
		 */
		public function setFirstName($first){
			if(empty($first)){
				echo E_NO_FNAME;
				return false;
			}
			$this->firstname = ucwords(strtolower($first));
		}

		/**
		 * setMiddleName sets the middle name for an employee
		 * @param String $middle String representation of the middle name
		 */
		public function setMiddleName($middle){
			$this->middlename = ucwords(strtolower($middle));
		}

		/**
		 * setLastName sets the last name for an employee
		 * @param String $last String representation of the last name
		 */
		public function setLastName($last){
			if(empty($last)){
				echo E_NO_FNAME;
				return false;
			}
			$this->lastname = ucwords(strtolower($last));
		}

		/**
		 * setUsername sets the username value for the employee object
		 * if the passed value is null, the username will be set as null
		 * and set as null in the database
		 * @param string $value The username
		 */
		public function setUsername($value = NULL){
			if(!is_null($value) || !empty($value)){
				$this->username = $value;
			}else{
				$this->username = NULL;
			}
		}

		/**
		 * setPassword sets a password for the user
		 * @param String $value String of the password
		 */
		public function setPassword($value = NULL){
			if(!is_null($value) || !empty($value)){
				$this->password = $value;
			}else{
				$this->password = NULL;
			}

		}

		/**
		 * setDefaultPassword sets the password for the employee. If passed values are
		 * null, a random unidentifed password will be created and must be changed
		 * manually by the system administration
		 * @param string $value The password hash
		 */
		public function setDefaultPassword($value = NULL){
			if(!is_null($value) || !empty($value)){
				$this->current_password = $this->password;
				$this->password = $value;
			}else{
				$this->password = bin2hex(random_bytes(30));
			}
		}

		/**
		 * setSecurePassword sets the BCRYPT encoded password for an employee.  This method
		 * should only be called when the updater has the FLAG_password set to 1 in the update
		 * script.
		 * @param string $value An unencrypted password value
		 */
		public function setSecurePassword($value = NULL){
			//Save current existing password before making a change
			$this->current_password = $this->password;

			if(!is_null($value) || !empty($value)){
				$hash = password_hash($value, PASSWORD_BCRYPT);
				$this->password = $hash;
			}
		}


/***** TRANSACTIONAL METHODS *****/
		
		/**
		 * getFormalizedEmployeeById is essentially the same as getEmployeeById
		 * however, instead of reporting back
		 * @param  [type] $id [description]
		 * @return [type]     [description]
		 */
		public function getFormalizedEmployeeById($id){
			if(!empty($id) || !is_null($id)){
				$this->fetchid = $id;
				$query = "SELECT 
							employee.employee_id, 
							employee.employee_fname,
							employee.employee_mname,
							employee.employee_lname,
							common_prefix.common_prefix_abbr,
							common_suffix.common_suffix_abbr,
							employee.employee_dob,
							employee.employee_hiredate,
							employee.employee_addr_1,
							employee.employee_addr_2,
							employee.employee_city,
							common_usstates.common_usstates_full,
							common_countries.common_countries_full,
							employee.employee_postcode,
							employee.employee_home_phone,
							employee.employee_mobile_phone,
							employee_status.employee_status_desc,
							employee.employee_modified,
							security_acl_groups.security_acl_desc
						FROM employee
						LEFT JOIN common_prefix
							ON employee.employee_prefix = common_prefix.common_prefix_id
						LEFT JOIN common_suffix
							ON employee.employee_suffix = common_suffix.common_suffix_id
						LEFT JOIN employee_status 
							ON employee.employee_status = employee_status.employee_status_id
						LEFT JOIN common_usstates 
							ON employee.employee_state = common_usstates.common_usstates_id
						LEFT JOIN common_countries 
							ON employee.employee_country = common_countries.common_countries_id
						LEFT JOIN security_acl_groups
							ON employee.employee_acl = security_acl_groups.security_acl_id
						WHERE employee.employee_id = :id";
				$this->set($query);
				$this->bindParam(':id', $this->fetchid);
				$result = $this->returnSingle();

				$this->setName($result['employee_fname'], $result['employee_mname'] , $result['employee_lname']);
				$this->setPrefix($result['common_prefix_abbr']);
				$this->setSuffix($result['common_suffix_abbr']);
				$this->setDob($result['employee_dob']);
				$this->setHireDate($result['employee_hiredate']);

				$address = array("addr1" => $result['employee_addr_1'], "addr2" => $result['employee_addr_2'],
					"city" => $result['employee_city'], "state" => $result['common_usstates_full'], "postcode" => $result['employee_postcode'],
					"country" => $result['common_countries_full']);
				$this->setAddress($address);

				$this->setHomePhone($result['employee_home_phone']);
				$this->setMobilePhone($result['employee_mobile_phone']);
				$this->setStatus($result['employee_status_desc']);
				$this->setDateModified($result['employee_modified']);
				$this->setACL($result['security_acl_desc']);

				$this->retData['success'] = true;
				$this->retData['message'] = SUCCESS;
				return($this->retData);


			}else{
				$this->retData['success'] = false;
				$this->retData['message'] = E_NO_ID;
				return($this->retData);
			}
		}	

		/**
		 * getEmployeeById loads an single employee and populates a Employee object
		 * @param  int $id Employee record ID number
		 * @return JSON Array    True/False and message
		 */
		public function getEmployeeById($id){
			if(!empty($id) || !is_null($id)){
				
				$this->fetchid = $id;
				$query = "SELECT * FROM employee WHERE employee_id = $id";
				$this->set($query);
				$result = $this->returnSingle();

				$this->setName($result['employee_fname'], $result['employee_mname'] , $result['employee_lname']);
				$this->setPrefix($result['employee_prefix']);
				$this->setSuffix($result['employee_suffix']);
				$this->setDob($result['employee_dob']);

				$address = array("addr1" => $result['employee_addr_1'], "addr2" => $result['employee_addr_2'],
					"city" => $result['employee_city'], "state" => $result['employee_state'], "postcode" => $result['employee_postcode'],
					"country" => $result['employee_country']);
				$this->setAddress($address);

				$this->setHomePhone($result['employee_home_phone']);
				$this->setMobilePhone($result['employee_mobile_phone']);
				$this->setHireDate($result['employee_hiredate']);
				$this->setACL($result['employee_acl']);
				$this->setStatus($result['employee_status']);
				$this->setSubscription($result['employee_subscription']);
				$this->setPassword($result['employee_password']);
				$this->setUsername($result['employee_username']);
				$this->setDateModified($result['employee_modified']);
				$this->setDateCreated($result['employee_created']);
				$this->retData['success'] = true;
				$this->retData['message'] = SUCCESS;
			}else{
				$this->retData['success'] = false;
				$this->retData['message'] = E_NO_ID;
				return($this->retData);
			}
		}

		/**
		 * updateEmployee Updates an employe record in database using Employee class data
		 * @return JSON Array True/False and message
		 */
		public function updateEmployee(){
			// If password is unchanged
			if($this->password == $this->current_password){
				$this->startTransaction();
				try{
					$query = "UPDATE employee SET 
					employee_fname = :firstname,
					employee_lname = :lastname,
					employee_mname = :middlename,
					employee_prefix = :prefix,
					employee_suffix = :suffix,
					employee_dob = :dob,
					employee_addr_1 = :addr1,
					employee_addr_2 = :addr2,
					employee_city = :city,
					employee_state = :state,
					employee_postcode = :postcode,
					employee_country = :country,
					employee_home_phone = :homephone,
					employee_mobile_phone = :mobilephone,
					employee_hiredate = :hiredate,
					employee_acl = :acl,
					employee_status = :status,
					employee_subscription = :subscription
					WHERE employee_id = :fetchid";

					$this->set($query);

					$address = $this->getAddress();
					
					$this->bindParam(':firstname', $this->getFirstName());
					$this->bindParam(':middlename', $this->getMiddleName());
					$this->bindParam(':lastname', $this->getLastName());
					$this->bindParam(':prefix', $this->getPrefix());
					$this->bindParam(':suffix', $this->getSuffix());
					$this->bindParam(':dob', $this->getDob());
					$this->bindParam(':addr1', $address['addr1']);
					$this->bindParam(':addr2', $address['addr2']);
					$this->bindParam(':city', $address['city']);
					$this->bindParam(':state', $address['state']);
					$this->bindParam(':postcode', $address['postcode']);
					$this->bindParam(':country', $address['country']);
					$this->bindParam(':homephone', $this->getHomePhone());
					$this->bindParam(':mobilephone', $this->getMobilePhone());
					$this->bindParam(':hiredate', $this->getHireDate());
					$this->bindParam(':acl', $this->getACL());
					$this->bindParam(':status', $this->getStatus());
					$this->bindParam(':subscription', $this->getSubscription());
					$this->bindParam(':fetchid', $this->getId());
					$result = $this->execute();
					
					if($result){
						$this->endTransaction();
						$this->retData['success'] = true;
						$this->retData['message'] = SUCCESS;
						$this->retData['info'] = var_dump(debug_backtrace());
					}else{
						$this->cancelTransaction();
						$this->retData['success'] = false;
						$this->retData['message'] = FAIL_TRANSACTION;
						$this->retData['info'] = var_dump(debug_backtrace());
					}
					
					return($this->retData);

				}catch(Exception $e){
					$this->cancelTransaction();
					$this->retData['success'] = false;
					$this->retData['message'] = FAIL_TRANSACTION.' '.$e->getMessage();
					$this->retData['info'] = $e->getMessage();
					return($this->retData);
				}
			}else{
			//If password has been changed
				$this->startTransaction();
				try{
					$query = "UPDATE employee SET 
					employee_fname = :firstname,
					employee_lname = :lastname,
					employee_mname = :middlename,
					employee_prefix = :prefix,
					employee_suffix = :suffix,
					employee_dob = :dob,
					employee_addr_1 = :addr1,
					employee_addr_2 = :addr2,
					employee_city = :city,
					employee_state = :state,
					employee_postcode = :postcode,
					employee_country = :country,
					employee_home_phone = :homephone,
					employee_mobile_phone = :mobilephone,
					employee_hiredate = :hiredate,
					employee_acl = :acl,
					employee_status = :status,
					employee_subscription = :subscription,
					employee_password = :password
					WHERE employee_id = :fetchid";

					$this->set($query);
					
					$address = $this->getAddress();
					
					$this->bindParam(':firstname', $this->getFirstName());
					$this->bindParam(':middlename', $this->getMiddleName());
					$this->bindParam(':lastname', $this->getLastName());
					$this->bindParam(':prefix', $this->getPrefix());
					$this->bindParam(':suffix', $this->getSuffix());
					$this->bindParam(':dob', $this->getDob());
					$this->bindParam(':addr1', $address['addr1']);
					$this->bindParam(':addr2', $address['addr2']);
					$this->bindParam(':city', $address['city']);
					$this->bindParam(':state', $address['state']);
					$this->bindParam(':postcode', $address['postcode']);
					$this->bindParam(':country', $address['country']);
					$this->bindParam(':homephone', $this->getHomePhone());
					$this->bindParam(':mobilephone', $this->getMobilePhone());
					$this->bindParam(':hiredate', $this->getHireDate());
					$this->bindParam(':acl', $this->getACL());
					$this->bindParam(':status', $this->getStatus());
					$this->bindParam(':subscription', $this->getSubscription());
					$this->bindParam(':password', $this->getPassword());
					$this->bindParam(':fetchid', $this->getId());

					$result = $this->execute();
					
					if($result){
						$this->endTransaction();
						$this->retData['success'] = true;
						$this->retData['message'] = SUCCESS;
						$this->retData['info'] = var_dump(debug_backtrace());
					}else{
						$this->cancelTransaction();
						$this->retData['success'] = false;
						$this->retData['message'] = FAIL_TRANSACTION;
						$this->retData['info'] = var_dump(debug_backtrace());
					}
					
					return($this->retData);

				}catch(Exception $e){
					$this->cancelTransaction();
					$this->retData['success'] = false;
					$this->retData['message'] = FAIL_TRANSACTION.' '.$e->getMessage();
					$this->retData['info'] = $e->getMessage();
					return($this->retData);
				}
			}
		}

		/**
		 * addEmployee will insert a new employee to the database using the stored values in the
		 * Employee class
		 */
		public function addEmployee(){
			$this->startTransaction();
			try{
				$query = "INSERT INTO employee (
				employee_id, 
				employee_fname,
				employee_lname, 
				employee_mname, 
				employee_prefix,
				employee_suffix, 
				employee_dob, 
				employee_addr_1,
				employee_addr_2, 
				employee_city, 
				employee_state,
				employee_postcode, 
				employee_country, 
				employee_home_phone,
				employee_mobile_phone,
				employee_hiredate, 
				employee_acl, 
				employee_status, 
				employee_subscription,
				employee_username,
				employee_password, 
				employee_created, 
				employee_modified) 
				VALUES (
				NULL, 
				:firstname, 
				:lastname,
				:middlename,
				:prefix,
				:suffix,
				:dob,
				:addr1, 
				:addr2,
				:city,
				:state,
				:postcode,
				:country,
				:homephone,
				:mobilephone,
				:hiredate,
				:acl,
				:status,
				:subscription,
				:username,
				:password,
				NOW(),
				NOW()
				)";

				$this->set($query);

				$address = $this->getAddress();
					
				$this->bindParam(':firstname', $this->getFirstName());
				$this->bindParam(':middlename', $this->getMiddleName());
				$this->bindParam(':lastname', $this->getLastName());
				$this->bindParam(':prefix', $this->getPrefix());
				$this->bindParam(':suffix', $this->getSuffix());
				$this->bindParam(':dob', $this->getDob());
				$this->bindParam(':addr1', $address['addr1']);
				$this->bindParam(':addr2', $address['addr2']);
				$this->bindParam(':city', $address['city']);
				$this->bindParam(':state', $address['state']);
				$this->bindParam(':postcode', $address['postcode']);
				$this->bindParam(':country', $address['country']);
				$this->bindParam(':homephone', $this->getHomePhone());
				$this->bindParam(':mobilephone', $this->getMobilePhone());
				$this->bindParam(':hiredate', $this->getHireDate());
				$this->bindParam(':acl', $this->getACL());
				$this->bindParam(':status', $this->getStatus());
				$this->bindParam(':subscription', $this->getSubscription());
				$this->bindParam(':username', $this->getUsername());
				$this->bindParam(':password', $this->getPassword());

				$result = $this->execute();
				
				if($result){
					$this->endTransaction();
					$this->retData['success'] = true;
					$this->retData['message'] = SUCCESS;
					$this->retData['info'] = var_dump(debug_backtrace());
				}else{
					$this->cancelTransaction();
					$this->retData['success'] = true;
					$this->retData['message'] = FAIL_TRANSACTION;
					$this->retData['info'] = var_dump(debug_backtrace());
				}
				return($this->retData);

			}catch(Exception $e){
				$this->cancelTransaction();
				$this->retData['success'] = false;
				$this->retData['message'] = FAIL_TRANSACTION.' xxx '.$e->getMessage();
				return($this->retData);
			}
		}
	}
?>