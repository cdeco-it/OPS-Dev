<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.address.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.google.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.orgs.php');

$google = new googleTools();

$address = array(
	"addr1"=>"1150 St. George Rd.",
	"addr2"=>NULL,
	"city"=>"Merritt Island",
	"state"=>9,
	"postcode"=>32952,
	"country"=>237
);

$coords = $google->getGeoCode($address);


//$addr = new Address();
/*
$addr->setOrganization("Test Kappa");
$addr->setOrganizationId(NULL);*/
/*
$orgs = new Orgs();
$orgs->setOrgName("Alphax");

$result = $orgs->addEntry();
$orgs->flush();

$orgs->getEntryByName("Alphax");
echo $orgs->getOrgName();
echo "<br />".$orgs->getOrgId();

//print_r($result);
*/

/*

$addr = new Address();
//$addr->getEntry(2);

$testdata = array(
	"prefix" => 1,
	"fname"=>"Test",
	"mname"=>"Pooper",
	"lname"=>"Alpha",
	"nname"=>"Dolly",
	"suffix" => 13,
	"title"=>"Director",
	"org_id"=>NULL,
	"org_name"=>"ACME",
	"addr1"=>"1150 St. George Rd.",
	"addr2"=>"Suite 201",
	"city"=>"Merritt Island",
	"state"=>9,
	"postcode"=>"32952",
	"country"=>237,
	"lat"=>NULL,
	"lng"=>NULL,
	"phone"=>"123-456-7890",
	"ext"=>NULL,
	"fax"=>"987-654-3210",
	"direct"=>"123-456-8892",
	"mobile"=>"876-263-2378",
	"email"=>"no@no.com",
	"url"=>"no.com",
	"newsletter"=>1,
	"calendars"=>1,
	"gifts"=>0,
	"vendor"=>0,
	"client"=>1,
	"consultant"=>1
);

//$addr->setNickName("Albert");
//$addr->setSuffix(9);
//$addr->updateEntry();

$helper = new Helper();

//echo $helper->format_PhoneNumber($testdata['phone'], );

$name = array(
	"fname"=>$testdata['fname'],
	"mname"=>$testdata['mname'],
	"lname"=>$testdata['lname'],
	"nname"=>$testdata['nname']
);

$addr->setName($name);

$x = $addr->getName();

echo 'POST<pre>';
print_r($x);
echo '</pre><br /><br />';

$addr->setPrefix($testdata['prefix']);
$addr->setSuffix($testdata['suffix']);

$x = $addr->getName();

echo '<pre>';
print_r($x);
echo '</pre><br /><br />';

$addr->setTitle($testdata['title']);
echo $addr->getTitle().'<br />';

$addr->setOrganization($testdata['org_name']);
echo $addr->getOrganization().'<br />';

$addr->setOrganizationId($testdata['org_id']);
echo $addr->getOrganizationId().'<br />';


$address = array(
	"addr1"=>$testdata['addr1'],
	"addr2"=>$testdata['addr2'],
	"city"=>$testdata['city'],
	"state"=>$testdata['state'],
	"postcode"=>$testdata['postcode'],
	"country"=>$testdata['country']
);

$addr->setAddress($address);

$y = $addr->getAddress();

echo '<pre>';
print_r($y);
echo '</pre><br /><br />';

$google = new googleTools();

$coords = $google->getGeoCode($address);

echo '<pre>';
print_r($coords);
echo '</pre><br /><br />';

$addr->setGeoCode($coords);

echo $addr->getLat();
echo '<br />';
echo $addr->getLng();


$contact = array(
	"org" => $testdata['phone'],
	"ext" => $testdata['ext'],
	"fax" => $testdata['fax'],
	"direct" => $testdata['direct'],
	"mobile" => $testdata['mobile'],
	"email" => $testdata['email'],
	"url" => $testdata['url']
);

$addr->setContactInfo($contact);

$z = $addr->getContactInfo();

echo '<pre>';
print_r($z);
echo '</pre><br /><br />';

$addr->setIsClient($testdata['client']);
echo $addr->getIsClient().'<br />';

$addr->setIsConsultant($testdata['consultant']);
echo $addr->getIsConsultant().'<br />';

$addr->setIsVendor($testdata['vendor']);
echo $addr->getIsVendor().'<br />';

$addr->setGetNewsletter($testdata['newsletter']);
echo $addr->getNewsletter().'<br />';

$addr->setGetGifts($testdata['gifts']);
echo $addr->getGifts().'<br />';

$addr->setGetCalendar($testdata['calendars']);
echo $addr->getCalendar().'<br />';

$a = $addr->addEntry();

echo '<pre>';
print_r($a);
echo '</pre><br /><br />';
*/
?>