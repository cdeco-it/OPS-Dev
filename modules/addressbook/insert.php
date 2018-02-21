<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.address.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.google.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');

ob_start();

//DONT PROCEED IF EMPTY OR IF NOT HAVING PROPER PERMISSIONS
if(!empty($_POST) || $level <= 2){
	
	//Instiantiate new Employee and Helper objects
	$addr = new Address();
	$google = new googleTools();
	$helper = new Helper();

	$name = array(
		"fname"=>$_POST['fname'], 
		"mname"=>$_POST['mname'], 
		"lname"=>$_POST['lname'], 
		"nname"=>$_POST['nname']
	);

	$addr->setName($name);

	$addr->setPrefix($_POST['prefix']);
	$addr->setSuffix($_POST['suffix']);
	
	//Set Organziation MUST GO FIRST!!!
	$addr->setOrganization($_POST['org']);
	$addr->setOrganizationId($_POST['org_id']);
	
	$addr->setTitle($_POST['title']);

	$address = array(
		"addr1"=>$_POST['address1'],
		"addr2"=>$_POST['address2'],
		"city"=>$_POST['city'],
		"state"=>$_POST['state'],
		"postcode"=>$_POST['postcode'],
		"country"=>$_POST['country']
	);
	$addr->setAddress($address);
	$coords = $google->getGeoCode($address);

	//Used to allow Google API to respond
	sleep(5);
	$addr->setGeoCode($coords);
	
	if(is_null($_POST['orgphoneext']) || empty($_POST['orgphoneext'])){
		$ext = null;
	}else{
		$ext = $_POST['orgphoneext'];
	}

	$contact = array(
		"org"=>$helper->format_PhoneNumber($_POST['orgphone'], $address['country']),
		//"ext"=>$_POST['orgphoneext'],
		"ext"=>$ext,
		"fax"=>$helper->format_PhoneNumber($_POST['orgfax'], $address['country']),
		"direct"=>$helper->format_PhoneNumber($_POST['directphone'], $address['country']),
		"mobile"=>$helper->format_PhoneNumber($_POST['mobilephone'], $address['country']),
		"email"=>$_POST['email'],
		"url"=>$_POST['url']
	);

	$addr->setContactInfo($contact);

	$addr->setGetNewsletter($_POST['newsletter']);
	$addr->setGetCalendar($_POST['calendars']);
	$addr->setGetGifts($_POST['gifts']);
	$addr->setIsVendor($_POST['isvendor']);
	$addr->setIsConsultant($_POST['isconsultant']);
	$addr->setIsClient($_POST['isclient']);

	//Insert the record...
	$data = $addr->addEntry();

	ob_end_clean();

	//Unset the classes and terminate.
	unset($addr);

	//Set, encode, and return JSON data to main
	echo json_encode($data);

}else{
	if($level > 2){
		$data = array("success" => FALSE, "message" => E_ACL_FAIL);
		ob_end_clean();
		echo json_encode($data);
	}else{
		$data = array("success" => FALSE, "message" => CRITICAL_ERROR.' - The required data has not been passed to the system.');
		ob_end_clean();
		echo json_encode($data);
	}	
}
?>