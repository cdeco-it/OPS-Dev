<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.address.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.google.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');

//Setup our class objects
$addr = new Address();
$google = new googleTools();
$helper = new Helper();

ob_start();

//DONT PROCEED IF EMPTY OR IF NOT HAVING PROPER PERMISSIONS
if(!empty($_POST) || $level <= 2){
	
	//Get the posted vars
	$updateId = $_POST['updateId'];
	$prefix = $_POST['prefix'];
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$nname = $_POST['nname'];
	$suffix = $_POST['suffix'];
	$orgName = $_POST['org'];
	$orgId = $_POST['org_id'];
	$title = $_POST['title'];
	$isClient = $_POST['isclient'];
	$isVendor = $_POST['isvendor'];
	$isConsultant = $_POST['isconsultant'];
	$newsletter = $_POST['newsletter'];
	$calendar = $_POST['calendars'];
	$gifts = $_POST['gifts'];
	$addr1 = $_POST['address1'];
	$addr2 = $_POST['address2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$postcode = $_POST['postcode'];
	$country = $_POST['country'];
	$email = $_POST['email'];
	$url = $_POST['url'];
	$orgphone = $_POST['orgphone'];
	$orgphoneext = $_POST['orgphoneext'];
	$fax = $_POST['orgfax'];
	$direct = $_POST['directphone'];
	$mobile = $_POST['mobilephone'];

	//Load the record and proceed if is succeeds
	$result = $addr->getEntry($updateId);
	if($result['success']){
		echo '<h1>OK C</h1><br />';

		//Deal with the name
		$name = $addr->getName();
			if($name['prefix'] != $prefix){
				$name['prefix'] = $prefix;
			}
			if(strcasecmp($name['first'], $fname) != 0){
				$name['first'] = $fname;
			}
			if(strcasecmp($name['middle'], $mname) != 0){
				$name['middle'] = $mname;
			}
			if(strcasecmp($name['last'], $lname) != 0){
				$name['last'] = $mname;
			}
			if(strcasecmp($name['nickname'], $nname) != 0){
				$name['nickname'] = $mname;
			}
			if($name['suffix'] != $suffix){
				$name['suffix'] = $suffix;
			}
		$addr->setName($name);

		//Deal with the organization
		if($addr->getOrganizationId() != $orgId){
			$addr->setOrganization($orgName);
			$addr->setOrganizationId(NULL);
		}

		//Deal with title
		if(strcasecmp($addr->getTitle(), $title) != 0){
			$addr->setTitle($title);
		}

		//Deal with isClient
		if($addr->getIsClient() != $isClient){
			$addr->setIsClient($isClient);
		}

		//Deal with isVendor
		if($addr->getIsVendor() != $isVendor){
			$addr->setIsVendor($isVendor);
		}

		//Deal with isConsultant
		if($addr->getIsConsultant() != $isConsultant){
			$addr->setIsConsultant($isConsultant);
		}

		//Deal with newletter
		if($addr->getNewsletter() != $newsletter){
			$addr->setGetNewsletter($newsletter);
		}

		//Deal with gifts
		if($addr->getCalendar() != $calendar){
			$addr->setGetCalendar($calendar);
		}

		//Deal with calendars
		if($addr->getGifts() != $gifts){
			$addr->setGetGifts($gifts);
		}

		//Deal with address
		$address = $addr->getAddress();
			if(strcasecmp($address['addr1'], $addr1) != 0){
				$address['addr1'] = $addr1;
			}
			if(strcasecmp($address['addr2'], $addr2) != 0){
				$address['addr2'] = $addr2;
			}
			if(strcasecmp($address['city'], $city) != 0){
				$address['city'] = $city;
			}
			if($address['state'] != $state){
				$address['state'] = $state;
			}
			if(strcasecmp($address['postcode'], $postcode) != 0){
				$address['postcode'] = $postcode;
			}
			if($address['country'] != $country){
				$address['country'] = $country;
			}
		$addr->setAddress($address);

		//Deal with geocoding
		$coords = $google->getGeoCode($address);
			if($addr->getLat() !== $coords['lat']){
				$addr->setLat($coords['lat']);
			}

			if($addr->getLng() !== $coords['lng']){
				$addr->setLng($coords['lng']);
			}

		//Deal with contact info
		$contact = $addr->getContactInfo();
			if(strcasecmp($contact['org'], $helper->format_PhoneNumber($orgphone, $country) != 0 )){
				$contact['org'] = $helper->format_PhoneNumber($orgphone, $country);
			}
			

			if(strcasecmp($contact['ext'], $orgphoneext) != 0){
				$contact['ext'] = $orgphoneext;
			}

			if(strcasecmp($contact['fax'], $helper->format_PhoneNumber($fax, $country) != 0 )){
				$contact['org'] = $helper->format_PhoneNumber($fax, $country);

			}

			if(strcasecmp($contact['direct'], $helper->format_PhoneNumber($direct, $country) != 0 )){
				$contact['org'] = $helper->format_PhoneNumber($direct, $country);

			}

			if(strcasecmp($contact['email'], $email) != 0){
				$contact['email'] = $email;
			}

			if(strcasecmp($contact['url'], $url) != 0){
				$contact['url'] = $url;
			}
		$addr->setContactInfo($contact);

		$final = $addr->updateEntry();
		ob_end_clean();
		echo json_encode($final);
	}else{
		ob_end_clean();
		echo json_encode($result);
	}

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