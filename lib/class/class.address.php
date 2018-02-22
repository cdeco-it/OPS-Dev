<?php

require_once('class.db.php');
require_once('class.orgs.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');

class Address extends Db{

	private $firstname; 	
	private $middlename;	
	private $lastname;	
	private $nickname;		
	private $prefix;		
	private $suffix;		
	private $title;			
	private $org;
	private $org_id;
	private $prev_org_id;	
	private $addr1;	
	private $addr2;			
	private $city;	
	private $state;			
	private $postcode;		
	private $country;		
	private $lat;
	private $lng;			
	private $phone_org;		
	private $phone_org_ext;	
	private $phone_org_fax;	
	private $phone_direct;	
	private $phone_mobile;	
	private $email;		
	private $url;			
	private $newsletter;	
	private $calendar;		
	private $gifts;			
	private $isvendor;		
	private $isconsultant;	
	private $isclient;		
	private $dateModified;	
	private $dateCreated;	
	private $fetchid;
	private $retData = array("success" => false , "message" => '' , "updateInfo" => '');

	//private $orgs = new Orgs();

/**
 * Parent construction from class.db.php
 */
	function __construct(){
		parent::__construct();
	}

/***** GETTER METHODS *****/
	
	public function getFetchId(){
		return($this->fetchid);
	}

	/**
	 * getName Returns all name data of an entry
	 * @return Array An assoc. array containing all name information
	 */
	public function getName(){
		$name = array(
			"prefix" => $this->getPrefix(),
			"first" => $this->getFirstName(),
			"middle" => $this->getMiddleName(),
			"last" => $this->getLastName(),
			"nickname" => $this->getNickName(),
			"suffix" => $this->getSuffix()
		);
		return($name);
	}

	/**
	 * getFirstName returns only the first name of an entry
	 * @return string String of the First Name
	 */
	public function getFirstName(){
		return($this->firstname);
	}

	/**
	 * getMiddleName returns only the middle name of an entry
	 * @return string String of the Middle Name
	 */
	public function getMiddleName(){
		return($this->middlename);
	}

	/**
	 * getLastName returns only the last name of an entry
	 * @return string String of the Last Name
	 */
	public function getLastName(){
		return($this->lastname);
	}

	/**
	 * getNickName return onlt the nick name of an entry
	 * @return String String of the nickname
	 */
	public function getNickName(){
		return($this->nickname);
	}

	/**
	 * getSuffix returns the associated value for an entry suffix
	 * @return int Int value of suffix found in common_suffix
	 */
	public function getSuffix(){
		return($this->suffix);
	}

	/**
	 * getPrefix returns the associated value for an entry prefix
	 * @return int Int value of prefix found in common_prefix
	 */
	public function getPrefix(){
		return($this->prefix);
	}

	/**
	 * getOrganization returs the associated value for an entry prefix
	 * @return [type] [description]
	 */
	public function getOrganization(){
		return($this->org);
	}

	/**
	 * getOrganiationId returns the associated value for an organization ID
	 * @return int Int value of the Organization ID held in addr_work table
	 */
	public function getOrganizationId(){
		return($this->org_id);
	}

	public function getPreviousOrganizationId(){
		return($this->prev_org_id);
	}

	/**
	 * getTitle returns the associate value for an entry title
	 * @return String Title
	 */
	public function getTitle(){
		return($this->title);
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

	public function getGetCode(){
		$coords = array("lan" => $this->getLat(), "lng" => $this->getLng());
		return($coords);
	}

	/**
	 * getLat returns the geocoded Latitute coordinates for an entry
	 * @return float Geocoded latitude coordinate
	 */
	public function getLat(){
		return($this->lat);
	}

	/**
	 * getLng returns the geocoded Longitutde coordinates for an entry
	 * @return float Geocoded longitude coordinates
	 */
	public function getLng(){
		return($this->lng);
	}

	public function getPhoneOrg(){
		return($this->phone_org);
	}

	public function getPhoneOrgExt(){
		return($this->phone_org_ext);
	}

	public function getPhoneOrgFax(){
		return($this->phone_org_fax);
	}

	public function getPhoneDirect(){
		return($this->phone_direct);
	}

	public function getPhoneMobile(){
		return($this->phone_mobile);
	}

	public function getEmail(){
		return($this->email);
	}

	public function getUrl(){
		return($this->url);
	}

	public function getContactInfo(){
		$contact = array(
			"org" => $this->getPhoneOrg(),
			"ext" => $this->getPhoneOrgExt(),
			"fax" => $this->getPhoneOrgFax(),
			"direct" => $this->getPhoneDirect(),
			"mobile" => $this->getPhoneMobile(),
			"email" => $this->getEmail(),
			"url" => $this->getUrl()
		);
		return($contact);
	}

	public function getNewsletter(){
		return($this->newsletter);
	}

	public function getCalendar(){
		return($this->calendar);
	}

	public function getGifts(){
		return($this->gifts);
	}

	public function getIsVendor(){
		return($this->isvendor);
	}

	public function getIsConsultant(){
		return($this->isconsultant);
	}

	public function getIsClient(){
		return($this->isclient);
	}

	public function getDateModified(){
		return($this->dateModified);
	}

	public function getDateCreated(){
		return($this->dateCreated);
	}

/***** SETTER METHODS *****/
	
	public function setFetchId($value = NULL){
		$this->fetchid = $value;
	}

	/**
	 * setName sets/changes all relative name values
	 * @param string $first  First name
	 * @param string $middle Middle name
	 * @param string $last   Last Name
	 */
	public function setName($value = NULL){
		if(!empty($value['prefix'])){
			$this->setPrefix($value['prefix']);
		}
		if(!empty($value['first']) && !empty($value['last'])){
			$this->setFirstName($value['first']);
			$this->setLastName($value['last']);
		}

		if(!empty($value['middle']) || !is_null($value['middle'])){
			$this->setMiddleName($value['middle']);
		}else{
			$this->setMiddleName(NULL);
		}

		if(!empty($value['nickname']) || !is_null($value['nickname'])){
			$this->setNickName($value['nickname']);
		}else{
			$this->setNickName(NULL);
		}

		if(!empty($value['suffix'])){
			$this->setSuffix($value['suffix']);
		}
	}

	public function setSuffix($value = NULL){
		$this->suffix = $value;
	}

	public function setPrefix($value = NULL){
		$this->prefix = $value;
	}

	/**
	 * setFirstName sets the first name for an entry
	 * @param String $first String representation of the first name
	 */
	public function setFirstName($first){
		$this->firstname = ucwords(strtolower($first));
	}

	/**
	 * setMiddleName sets the middle name for an entry
	 * @param String $middle String representation of the middle name
	 */
	public function setMiddleName($middle){
		$this->middlename = ucwords(strtolower($middle));
	}

	/**
	 * setLastName sets the last name for an entry
	 * @param String $last String representation of the last name
	 */
	public function setLastName($last){
		$this->lastname = ucwords(strtolower($last));
	}

	/**
	 * setNickName sets the nickname for an enrty
	 * @param [type] $nick [description]
	 */
	public function setNickName($nick){
		$this->nickname = ucwords(strtolower($nick));
	}

	/**
	 * setTitle sets the job title for an indivudal
	 * @param String $value Job title
	 */
	public function setTitle($value = NULL){
		if(is_null($value)){
			$this->title = $value;
		}else{
			$this->title = ucwords(strtolower($value));
		}
	}
	
	/**
	 * setOrganization sets a string representation of a name
	 * of the organzation stored in addr_orgs table.
	 * @param String $value String representation of the name of an org.
	 */
	public function setOrganization($value = NULL){
		if(empty($value) || is_null($value)){
			$this->org = NULL;
		}else{
			$this->org = $value;
		}

	}

	public function setOrganizationId($value = NULL){	
		if(is_null($value) || empty($value)){
			$orgs = new Orgs();
			$orgs->setOrgName($this->getOrganization());
			$orgs->addEntry();
			$orgs->flush();

			//Now get the new ID
			$orgs->getEntryByName($this->getOrganization());

			//Set the name and new id into ADDR
			$this->setOrganization = $orgs->getOrgName();
			$this->org_id = $orgs->getOrgId();
			$orgs->flush();

			//Unset orgs
			unset($orgs);
		}else{
			$this->org_id = $value;
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

	public function setGeoCode($value = NULL){
		if(!empty($value) || !is_null($value)){
			$this->setLat($value['lat']);
			$this->setLng($value['lng']);
		}else{
			$this->setLat();
			$this->setLng();
		}
	}

	public function setLat($value = NULL){
		$this->lat = $value;
	}

	public function setLng($value = NULL){
		$this->lng = $value;
	}

	/**
	 * setContactInfo takes in an array containing relevant contact information
	 * containing organization phohe, extension, fax, direct dial, mobile,
	 * email, and url
	 * @param String[] $value An array of contact information 
	 */
	public function setContactInfo($value = NULL){
		if(!is_null($value)){
			if(!is_null($value['org'])){
				$this->setPhoneOrg($value['org']);
			}else{
				$this->setPhoneOrg();
			}

			if(!is_null($value['ext']) || !empty($value['ext'])){
				$this->setPhoneOrgExt($value['ext']);
			}else{
				$this->setPhoneOrgExt();
			}

			if(!is_null($value['fax'])){
				$this->setPhoneOrgFax($value['fax']);
			}else{
				$this->setPhoneOrgFax();
			}

			if(!is_null($value['direct'])){
				$this->setPhoneDirect($value['direct']);
			}else{
				$this->setPhoneDirect();
			}

			if(!is_null($value['mobile'])){
				$this->setPhoneMobile($value['mobile']);
			}else{
				$this->setPhoneMobile();
			}

			if(!is_null($value['email'])){
				$this->setEmail($value['email']);
			}else{
				$this->setEmail();
			}

			if(!is_null($value['url'])){
				$this->setUrl($value['url']);
			}else{
				$this->setUrl();
			}
		}
	}

	public function setPhoneOrg($value = NULL){
		$this->phone_org = $value;
	}

	public function setPhoneOrgExt($value = NULL){
		$this->phone_org_ext = $value;
	}

	public function setPhoneOrgFax($value = NULL){
		$this->phone_org_fax = $value;
	}

	public function setPhoneDirect($value = NULL){
		$this->phone_direct = $value;
	}

	public function setPhoneMobile($value = NULL){
		$this->phone_mobile = $value;
	}

	public function setEmail($value = NULL){
		$this->email = $value;
	}

	public function setUrl($value = NULL){
		$this->url = $value;
	}

	public function setGetNewsletter($value = NULL){
		if(empty($value) || is_null($value) || $value == 0){
			$this->newsletter = false;
		}else{
			$this->newsletter = true;
		}
	}

	public function setGetCalendar($value = NULL){
		if(empty($value) || is_null($value) || $value == 0){
			$this->calendar = false;
		}else{
			$this->calendar = true;
		}
	}

	public function setGetGifts($value = NULL){
		if(empty($value) || is_null($value) || $value == 0){
			$this->gifts = false;
		}else{
			$this->gifts = true;
		}
	}

	public function setIsVendor($value = NULL){
		if(empty($value) || is_null($value) || $value == 0){
			$this->isvendor = false;
		}else{
			$this->isvendor = true;
		}
	}

	public function setIsConsultant($value = NULL){
		if(empty($value) || is_null($value) || $value == 0){
			$this->isconsultant = false;
		}else{
			$this->isconsultant = true;
		}
	}

	public function setIsClient($value = NULL){
		if(empty($value) || is_null($value) || $value == 0){
			$this->isclient = false;
		}else{
			$this->isclient = true;
		}
	}

	/**
	 * setModified sets the last date of modification to the record for the entry
	 * @param string $value SQL Formatted datestamp
	 */
	public function setDateModified($value = NULL){
		$this->dateModified = $value;
	}

	/**
	 * setDateEntered sets the initial record entry date for an entry
	 * @param string $value SQL Formatted datestamp
	 */
	public function setDateCreated($value = NULL){
		$this->dateCreated = $value;
	}

/***** TRANSACTIONAL METHODS *****/

	public function getEntry($id){
		if(!empty($id) || !is_null($id)){
			$query = "SELECT * FROM addr WHERE addr_id = :id";
			$this->set($query);
			$this->bindParam(":id", $id);
			$result = $this->returnSingle();
			$this->setFetchId($result['addr_id']);
			$name = array(
				"prefix" => $result['addr_prefix'],
				"first" => $result['addr_fname'], 
				"middle" => $result['addr_mname'], 
				"last" => $result['addr_lname'], 
				"nickname" => $result['addr_nname'],
				"suffix" => $result['addr_suffix']);
			$this->setName($name);
			// $this->setPrefix($result['addr_prefix']);
			// $this->setSuffix($result['addr_suffix']);
			$this->setTitle($result['addr_title']);

			//Now get the associated information from the addr_orgs table
			$this->setOrganizationId($result['addr_org_id']);
			$orgs = new Orgs();
			$orgs->getEntryById($this->getOrganizationId());
			$this->setOrganization($orgs->getOrgName());
			
			$addr = array(
				"addr1"=>$result['addr_address_1'], 
				"addr2"=>$result['addr_address_2'], 
				"city"=>$result['addr_city'],
				"state"=>$result['addr_state'],
				"postcode"=>$result['addr_postcode'],
				"country"=>$result['addr_country']);
			$this->setAddress($addr);
			$this->setLat($result['addr_lat']);
			$this->setLng($result['addr_lng']);
			$contact = array(
				"org"=>$result['addr_org_phone'],
				"ext"=>$result['addr_org_phone_ext'],
				"fax"=>$result['addr_org_fax'],
				"direct"=>$result['addr_direct'],
				"mobile"=>$result['addr_mobile'],
				"email"=>$result['addr_email'],
				"url"=>$result['addr_url']
			);
			$this->setContactInfo($contact);
			$this->setGetNewsletter($result['addr_admin_newsletter']);
			$this->setGetCalendar($result['addr_admin_calendars']);
			$this->setGetGifts($result['addr_admin_gifts']);
			$this->setIsClient($result['addr_type_client']);
			$this->setIsVendor($result['addr_type_vendor']);
			$this->setIsConsultant($result['addr_type_consultant']);
			$this->setDateCreated($result['addr_date_created']);
			$this->setDateModified($result['addr_date_updated']);
			unset($orgs);
			$this->retData['success'] = true;
			$this->retData['message'] = SUCCESS;
			return($this->retData);
		}else{
			$this->retData['success'] = false;
			$this->retData['message'] = E_NO_ID;
			unset($orgs);
			return($this->retData);
		}
	}

	public function getFormalizedEntry($id){
		if(!empty($id) || !is_null($id)){
			$this->setFetchId($id);
			
			$query = "SELECT
						addr.addr_id,
						common_prefix.common_prefix_abbr,
						addr.addr_fname,
						addr.addr_mname,
						addr.addr_lname,
						addr.addr_nname,
						common_suffix.common_suffix_abbr,
						addr.addr_title,
						addr.addr_org_id,
						addr_orgs.addr_orgs_name AS addr_org,
						addr.addr_address_1,
						addr.addr_address_2,
						addr.addr_city,
						common_usstates.common_usstates_full,
						addr.addr_postcode,
						common_countries.common_countries_full,
						addr.addr_country,
						addr.addr_lat,
						addr.addr_lng,
						addr.addr_org_phone,
						addr.addr_org_phone_ext,
						addr.addr_org_fax,
						addr.addr_direct,
						addr.addr_mobile,
						addr.addr_email,
						addr.addr_url,
						addr.addr_admin_newsletter,
						addr.addr_admin_calendars,
						addr.addr_admin_gifts,
						addr.addr_type_vendor,
						addr.addr_type_consultant,
						addr.addr_type_client,
						addr.addr_date_created,
						addr.addr_date_updated
					FROM addr
					LEFT JOIN common_prefix
						ON addr.addr_prefix = common_prefix.common_prefix_id
					LEFT JOIN common_suffix
						ON addr.addr_suffix = common_suffix.common_suffix_id
					LEFT JOIN common_usstates
						ON addr.addr_state = common_usstates.common_usstates_id
					LEFT JOIN common_countries
						ON addr.addr_country = common_countries.common_countries_id
					LEFT JOIN addr_orgs
						ON addr.addr_org_id = addr_orgs.addr_orgs_id
					WHERE addr.addr_id = :id";
			$this->set($query);
			$this->bindParam(':id', $this->fetchid);
			$result = $this->returnSingle();

			//If there is a valid set...let's set it up
			if($this->rowCount() >= 1){
				$name = array(
					"prefix"=>$result['common_prefix_abbr'],
					"first"=>$result['addr_fname'],
					"middle"=>$result['addr_mname'],
					"last"=>$result['addr_lname'],
					"nickname"=>$result['addr_nname'],
					"suffix"=>$result['common_suffix_abbr']
				);

				$contact = array(
					"org" => $result['addr_org_phone'],
					"ext" => $result['addr_org_phone_ext'],
					"fax" => $result['addr_org_fax'],
					"direct" => $result['addr_direct'],
					"mobile" => $result['addr_mobile'],
					"email" => $result['addr_email'],
					"url" => $result['addr_url']
				);

				$address = array(
					"addr1" => $result['addr_address_1'],
					"addr2" => $result['addr_address_2'],
					"city" => $result['addr_city'],
					"state" => $result['common_usstates_full'],
					"postcode" => $result['addr_postcode'],
					"country" => $result['common_countries_full'],
				);

				$this->setName($name);
				$this->setAddress($address);
				$this->setContactInfo($contact);
				$this->setOrganization($result['addr_org']);
				$this->setTitle($result['addr_title']);
				// $this->setPrefix($result['common_prefix_abbr']);
				// $this->setSuffix($result['common_suffix_abbr']);
				$this->setGetCalendar($result['addr_admin_calendars']);
				$this->setGetGifts($result['addr_admin_gifts']);
				$this->setGetNewsletter($result['addr_admin_newsletter']);
				$this->setIsClient($result['addr_type_client']);
				$this->setIsVendor($result['addr_type_vendor']);
				$this->setIsConsultant($result['addr_type_consultant']);
				$this->setDateCreated($result['addr_date_created']);
				$this->setDateModified($result['addr_date_updated']);
				$this->setLat($result['addr_lat']);
				$this->setLng($result['addr_lng']);

				$this->retData['success'] = true;
				$this->retData['message'] = SUCCESS;
				return($this->retData);

			}else{
				$this->retData['success'] = false;
				$this->retData['message'] = NO_RECORD;
				return($this->retData);
			}
		}else{
			$this->retData['success'] = false;
			$this->retData['message'] = E_NO_ID;
			return($this->retData);
		}
	}

	public function addEntry(){
		$this->startTransaction();
		try{
			$query = "INSERT INTO addr (
					addr_id,
					addr_prefix,
					addr_fname,
					addr_lname,
					addr_mname,
					addr_nname,
					addr_suffix,
					addr_title,
					addr_org_id,
					addr_address_1,
					addr_address_2,
					addr_city,
					addr_state,
					addr_postcode,
					addr_country,
					addr_lat,
					addr_lng,
					addr_org_phone,
					addr_org_phone_ext,
					addr_org_fax,
					addr_direct,
					addr_mobile,
					addr_email,
					addr_url,
					addr_admin_newsletter,
					addr_admin_calendars,
					addr_admin_gifts,
					addr_type_vendor,
					addr_type_client,
					addr_type_consultant,
					addr_date_created,
					addr_date_updated)
					VALUES (
					NULL,
					:addr_prefix,
					:addr_fname,
					:addr_lname,
					:addr_mname,
					:addr_nname,
					:addr_suffix,
					:addr_title,
					:addr_org_id,
					:addr_address_1,
					:addr_address_2,
					:addr_city,
					:addr_state,
					:addr_postcode,
					:addr_country,
					:addr_lat,
					:addr_lng,
					:addr_org_phone,
					:addr_org_phone_ext,
					:addr_org_fax,
					:addr_direct,
					:addr_mobile,
					:addr_email,
					:addr_url,
					:addr_admin_newsletter,
					:addr_admin_calendars,
					:addr_admin_gifts,
					:addr_type_vendor,
					:addr_type_client,
					:addr_type_consultant,
					NOW(),
					NOW()
					)";
			$this->set($query);
			$this->bindParam(':addr_prefix', $this->getPrefix());
			$this->bindParam(':addr_fname', $this->getFirstName());
			$this->bindParam(':addr_lname', $this->getLastName());
			$this->bindParam(':addr_mname', $this->getMiddleName());
			$this->bindParam(':addr_nname', $this->getNickName());
			$this->bindParam(':addr_suffix', $this->getSuffix());
			$this->bindParam(':addr_title', $this->getTitle());
			$this->bindParam(':addr_org_id', $this->getOrganizationId());

			$addrIn = $this->getAddress();
			$this->bindParam(':addr_address_1', $addrIn['addr1']);
			$this->bindParam(':addr_address_2', $addrIn['addr2']);
			$this->bindParam(':addr_city', $addrIn['city']);
			$this->bindParam(':addr_state', $addrIn['state']);
			$this->bindParam(':addr_postcode', $addrIn['postcode']);
			$this->bindParam(':addr_country', $addrIn['country']);
			$this->bindParam(':addr_lat', $this->getLat());
			$this->bindParam(':addr_lng', $this->getLng());
			$this->bindParam(':addr_org_phone', $this->getPhoneOrg());
			$this->bindParam(':addr_org_phone_ext', $this->getPhoneOrgExt());
			$this->bindParam(':addr_org_fax', $this->getPhoneOrgFax());
			$this->bindParam(':addr_direct', $this->getPhoneDirect());
			$this->bindParam(':addr_mobile', $this->getPhoneMobile());
			$this->bindParam(':addr_email', $this->getEmail());
			$this->bindParam(':addr_url', $this->getUrl());
			$this->bindParam(':addr_admin_newsletter', $this->getNewsletter());
			$this->bindParam(':addr_admin_calendars', $this->getCalendar());
			$this->bindParam(':addr_admin_gifts', $this->getGifts());
			$this->bindParam(':addr_type_vendor', $this->getIsVendor());
			$this->bindParam(':addr_type_client', $this->getIsClient());
			$this->bindParam(':addr_type_consultant', $this->getIsConsultant());
			$result = $this->execute();
			
			if($result){
				$this->endTransaction();
				$this->retData['success'] = true;
				$this->retData['message'] = SUCCESS;
				$this->retData['updateInfo'] = var_dump(debug_backtrace());
				return($this->retData);
			}else{
				$this->cancelTransaction();
				$this->retData['success'] = false;
				$this->retData['message'] = FAIL_TRANSACTION.' '.$e->getMessage();
				$this->retData['updateInfo'] = var_dump(debug_backtrace());
				return($this->retData);
			}
		}catch(Exception $e){
			$this->cancelTransaction();
			$this->retData['success'] = false;
			$this->retData['message'] = FAIL_TRANSACTION.' '.$e->getMessage();
			return($this->retData);
		}
	}

	public function updateEntry(){
		$this->startTransaction();
		try{
			$query = "UPDATE addr SET
				addr_prefix = :addr_prefix,
				addr_fname = :addr_fname,
				addr_mname = :addr_mname,
				addr_lname = :addr_lname,
				addr_nname = :addr_nname,
				addr_suffix = :addr_suffix,
				addr_title = :addr_title,
				addr_org_id = :addr_org_id,
				addr_address_1 = :addr_address_1,
				addr_address_2 = :addr_address_2,
				addr_city = :addr_city,
				addr_state = :addr_state,	
				addr_postcode = :addr_postcode,
				addr_country = :addr_country,
				addr_lat = :addr_lat,
				addr_lng = :addr_lng,
				addr_org_phone = :addr_org_phone,
				addr_org_phone_ext = :addr_org_phone_ext,
				addr_org_fax = :addr_org_fax,
				addr_direct = :addr_direct,
				addr_mobile = :addr_mobile,
				addr_email = :addr_email,
				addr_url = :addr_url,
				addr_admin_newsletter = :addr_admin_newsletter,
				addr_admin_calendars = :addr_admin_calendars,
				addr_admin_gifts = :addr_admin_gifts,
				addr_type_vendor = :addr_type_vendor,
				addr_type_consultant = :addr_type_consultant,
				addr_type_client = :addr_type_client	
				WHERE addr_id = :addr_id";	

			$this->set($query);

			$this->bindParam(':addr_prefix', $this->getPrefix());
			$this->bindParam(':addr_fname', $this->getFirstName());
			$this->bindParam(':addr_lname', $this->getLastName());
			$this->bindParam(':addr_mname', $this->getMiddleName());
			$this->bindParam(':addr_nname', $this->getNickName());
			$this->bindParam(':addr_suffix', $this->getSuffix());
			$this->bindParam(':addr_title', $this->getTitle());
			$this->bindParam(':addr_org_id', $this->getOrganizationId());

			$addrIn = $this->getAddress();
				$this->bindParam(':addr_address_1', $addrIn['addr1']);
				$this->bindParam(':addr_address_2', $addrIn['addr2']);
				$this->bindParam(':addr_city', $addrIn['city']);
				$this->bindParam(':addr_state', $addrIn['state']);
				$this->bindParam(':addr_postcode', $addrIn['postcode']);
				$this->bindParam(':addr_country', $addrIn['country']);

			$this->bindParam(':addr_lat', $this->getLat());
			$this->bindParam(':addr_lng', $this->getLng());
			$this->bindParam(':addr_org_phone', $this->getPhoneOrg());
			$this->bindParam(':addr_org_phone_ext', $this->getPhoneOrgExt());
			$this->bindParam(':addr_org_fax', $this->getPhoneOrgFax());
			$this->bindParam(':addr_direct', $this->getPhoneDirect());
			$this->bindParam(':addr_mobile', $this->getPhoneMobile());
			$this->bindParam(':addr_email', $this->getEmail());
			$this->bindParam(':addr_url', $this->getUrl());
			$this->bindParam(':addr_admin_newsletter', $this->getNewsletter());
			$this->bindParam(':addr_admin_calendars', $this->getCalendar());
			$this->bindParam(':addr_admin_gifts', $this->getGifts());
			$this->bindParam(':addr_type_vendor', $this->getIsVendor());
			$this->bindParam(':addr_type_client', $this->getIsClient());
			$this->bindParam(':addr_type_consultant', $this->getIsConsultant());
			$this->bindParam(':addr_id', $this->getFetchId());

			$result = $this->execute();
			if($result){
				$this->endTransaction();
				$this->retData['success'] = true;
				$this->retData['message'] = SUCCESS;
				$this->retData['updateInfo'] = var_dump(debug_backtrace());
				return($this->retData);
			}else{
				$this->cancelTransaction();
				$this->retData['success'] = false;
				$this->retData['message'] = FAIL_TRANSACTION.' '.$e->getMessage();
				$this->retData['updateInfo'] = var_dump(debug_backtrace());
				return($this->retData);
			}
		}catch(Exception $e){
			$this->cancelTransaction();
			$this->retData['success'] = false;
			$this->retData['message'] = FAIL_TRANSACTION.' '.$e->getMessage();
			$this->retData['updateInfo'] = var_dump(debug_backtrace());
			return($this->retData);
		}
	}

	public function deleteEntry($id){
		$this->startTransaction();
		try{
			$query = "DELETE FROM addr WHERE addr_id = :id";
			$this->set($query);
			$this->bindParam(':id', $id);
			$result = $this->execute();
			if($result){
				$this->endTransaction();
				$this->retData['success'] = true;
				$this->retData['message'] = SUCCESS;
				$this->retData['updateInfo'] = var_dump(debug_backtrace());
				return($this->retData);
			}else{
				$this->cancelTransaction();
				$this->retData['success'] = false;
				$this->retData['message'] = FAIL_TRANSACTION.' '.$e->getMessage();
				$this->retData['updateInfo'] = var_dump(debug_backtrace());
				return($this->retData);
			}
		}catch(Exception $e){
			$this->cancelTransaction();
			$this->retData['success'] = false;
			$this->retData['message'] = CRITICAL_ERROR.' '.$e->getMessage();
			$this->retData['updateInfo'] = var_dump(debug_backtrace());
			return($this->retData);

		}
	}
}

?>