<?php

class googleTools{

	//private $apikey = "AIzaSyDUSBUVBjQj75kQ8P6kNVQi8iSxcGphYP8";
	private $apikey = "AIzaSyARqjTlbbzCLTq2equWgoqM2gCDQDivktg";
	private $host = "maps.googleapis.com";
	private $values = array("lat" => 0, "lng" => 0);
	private $epicenter = array("lat" => 28.356256, "lng" => -80.688272);
	private $helper;

	function __construct(){
		require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');
		$this->helper = new Helper();
	}

	public function getGeoCode($value = NULL){
		if(!empty($value) || !is_null($value)){
			$encAddr = urlencode(
				$value['addr1'].', '.$value['city'].', '.$this->helper->defineStateAbbr($value['state']).' '.$value['postcode'].' '.$this->helper->defineCountryAbbr($value['country'])
			);
			echo $encAddr;
			$url = 'https://'.$this->host.'/maps/api/geocode/json?sensor=false&address='.$encAddr;
			$json = json_decode(file_get_contents($url), true);
			$status = $json['status'];

			if(strcmp($status, "OK") == 0){
				$coords = array(
					"lat" => $json['results'][0]['geometry']['location']['lat'],
					"lng" => $json['results'][0]['geometry']['location']['lng']
				);
				return($coords);
			}else{
				print_r($status);
				$coords = array(
					"lat" => 0,
					"lng" => 0
				);
				return($coords);
			}

			/* THIS IS FOR XML OUTPUT...JSON is preferred
			$url = 'https://'.$this->host.'/maps/api/geocode/xml?sensor=false&address='.$encAddr;
			$xml = simplexml_load_file($url) or die('ERROR: Google API Geocoder module fail');
			$status = $xml->status;

			if(strcmp($status, "OK") == 0){
				$coord = array(
					"lat" => $xml->result->geometry->location->lat->__toString(), 
					"lng" => $xml->result->geometry->location->lng->__toString()
				);
				return($coord);
			}else{
				print_r($status);
			}*/
		}else{
			return(NULL);
		}
	}

}

?>