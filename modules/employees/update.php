<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.employee.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');

ob_start();

//Do not process if nothing is posted
if(!empty($_POST) || $level > 1){

	//Get the employee record and load it into object
	if(!empty($_POST['id'])){

		$getId = $_POST['id'];
		$employee = new Employee();
		$helper = new Helper();
		$employee->getEmployeeById($getId);

		//Get all imported vars...18 total...
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$mname = $_POST['mname'];
		$prefix = $_POST['prefix'];
		$suffix = $_POST['suffix'];
		$dob = $_POST['dob'];
		$addr1 = $_POST['addr1'];
		$addr2 = $_POST['addr2'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$postcode = $_POST['postcode'];
		$country = $_POST['country'];
		$home_phone = $_POST['homephone'];
		$mobile_phone = $_POST['mobilephone'];
		$hiredate = $_POST['hiredate'];
		$acl = $_POST['acl'];
		$status = $_POST['status'];
		$subscription = $_POST['subscription'];
		$FLAG_password = 0;

		//Only set if there is a new password set!
		if(!empty($_POST['password']) || $_POST['password'] != ""){
			$FLAG_password = 1;
			$newpassword = $_POST['password'];
		}
			
		//Name Checks
		if(strcasecmp($fname, $employee->getFirstName()) !=0 ){
			$employee->setFirstName($fname);
		}

		if(strcasecmp($lname, $employee->getLastName()) !=0 ){
			$employee->setLastName($lname);
		}

		if(strcasecmp($mname, $employee->getMiddleName()) !=0 ){
			$employee->setMiddleName($mname);
		}

		if($suffix != $employee->getSuffix()){
			$employee->setSuffix($suffix);
		}

		if($prefix != $employee->getPrefix()){
			$employee->setPrefix($prefix);
		}

		//Address Checks
		$address = $employee->getAddress();

		if(strcasecmp($addr1, $address['addr1']) !=0 ){
			$address['addr1'] = $addr1;
		}

		if(strcasecmp($addr2, $address['addr2']) !=0 ){
			$address['addr2'] = $addr2;
		}

		if(strcasecmp($city, $address['city']) !=0 ){
			$address['city'] = $city;
		}

		if(strcasecmp($postcode, $address['postcode']) !=0 ){
			$address['postcode'] = $postcode;
		}

		if($country != $address['country']){
			$address['country'] = $country;
		}

		if($state != $address['state']){
			$address['state'] = $state;
		}

		$employee->setAddress($address);

		//Phone Numbers
		if((strcasecmp($home_phone, $employee->getHomePhone()) != 0) || (is_null($employee->getHomePhone()))){
			$employee->setHomePhone($helper->format_PhoneNumber($home_phone, $address['country']));
		}

		if((strcasecmp($mobile_phone, $employee->getMobilePhone()) != 0) || (is_null($employee->getMobilePhone()))){
			$employee->setMobilePhone($helper->format_PhoneNumber($mobile_phone, $address['country']));
		}

		//Check subscription and status flags
		if($status != $employee->getStatus()){
			$employee->setStatus($status);
		}

		if($subscription != $employee->getSubscription()){
			$employee->setSubscription($subscription);
		}

		if($acl != $employee->getACL()){
			$employee->setACL($acl);
		}
		
		//Check password for update
		if(!$FLAG_password == 1 && isset($newpassword)){
			$employee->setSecurePassword($newpassword);
		}

		//Process the changes
		$data = $employee->updateEmployee();


	//If the ID value isn't set...it is a fail.
	}else{
		$data = array("success" => FALSE, "message" => E_NO_ID);
	}
	unset($employee);
	unset($helper);
	ob_end_clean();
	echo json_encode($data);

}else{
	if($level > 1){
		$data = array("success" => FALSE, "message" => E_ACL_FAIL);
		unset($employee);
		unset($helper);
		ob_end_clean();
		echo json_encode($data);

	}else{
		$data = array("success" => FALSE, "message" => CRITICAL_ERROR.' - No employee data is present.');
		unset($employee);
		unset($helper);
		ob_end_clean();
		echo json_encode($data);
	}
}
?>