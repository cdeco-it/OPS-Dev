<?php
echo '<html><head></head><body>';
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.google.php');

$google = new googleTools();

$address = array(
			'addr1' => '505 Canal St.',
			'city' => 'New Smyrna Beach',
			'state'=> 9,
			'postcode' => 32168,
			'country' => 237
			);


print_r($address);
echo '<br />';

$coords = $google->getGeoCode($address);
echo '<pre>';
print_r($coords);
echo '</pre>';

?>