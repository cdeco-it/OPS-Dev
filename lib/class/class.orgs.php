<?php

require_once('class.db.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');

class Orgs extends Db{

	private $org_id;
	private $org_name;

/**
 * Parent construction from class.db.php
 */
	function __construct(){
		parent::__construct();
	}

/***** GETTER METHODS *****/
	
	/**
	 * getOrgId returns the Organization ID
	 * @return int Organizatin ID
	 */
	public function getOrgId(){
		return($this->org_id);
	}

	/**
	 * getOrganizationName returns the Organization Name
	 * @return String Organization name
	 */
	public function getOrgName(){
		return($this->org_name);
	}

/***** FLUSH *****/

	/**
	 * flush simply clears all stored values
	 */
	public function flush(){
		$this->setOrgId = NULL;
		$this->setOrgName = NULL;
	}

/***** SETTER METHODS *****/

	/**
	 * setOrgId sets the Organization ID
	 * @param int $value Organization ID
	 */
	public function setOrgId($value = NULL){
		$this->org_id = $value;
	}

	/**
	 * setOrgName sets the Organization Name
	 * @param String $value Organization name
	 */
	public function setOrgName($value = NULL){
		$this->org_name = $value;
	}

/***** FIND METHODS *****/

	/**
	 * findMatchById looks up Organization records by associated ID
	 * This is simply a method to verify a match.
	 * @param  int $value Organization ID
	 * @return Boolean        True/False if a record is found
	 */
	public function findMatchById($value = NULL){
		$query = "SELECT COUNT(*) AS 'count' FROM addr_orgs WHERE addr_orgs_id = :value";
		$this->set($query);
		$this->bindParam(":value", $value);
		$result = $this->returnSingle();
		if($result['count'] > 0){
			return(true);
		}else{
			return(false);
		}
	}

	/**
	 * findMatchByName looks up Organization records by associated name.
	 * This is simply a method to verify a match
	 * @param  String $value Organization name
	 * @return Boolean        True/False if a record is found
	 */
	public function findMatchByName($value = NULL){
		$query = "SELECT COUNT(*) AS 'count' FROM addr_orgs WHERE addr_orgs_name LIKE %".$value."%";
		$this->set($query);
		$result = $this->returnSingle();
		if($result['count'] > 0){
			return(true);
		}else{
			return(false);
		}
	}

/***** TRANSACTIONAL METHODS *****/

	/**
	 * getEntryById retrieves and loads an organization entry by ID
	 * @param  int $id Organization ID
	 * @return Array[]     Success boolean and any associated messages
	 */
	public function getEntryById($id){
		if(!empty($id) || !is_null($id)){
			$query = "SELECT * FROM addr_orgs WHERE addr_orgs_id = :id";
			$this->set($query);
			$this->bindParam(":id", $id);
			$result = $this->returnSingle();
			$this->setOrgId($result['addr_orgs_id']);
			$this->setOrgName($result['addr_orgs_name']);
			$this->retData['success'] = true;
			$this->retData['message'] = SUCCESS;
		}else{
			$this->retData['success'] = false;
			$this->retData['message'] = E_NO_ID;
			return($this->retData);
		}
	}

	/**
	 * getEntryByName retrieves and loads an organization entry by Name
	 * @param  String $value Organization Name
	 * @return Array[]        Success boolean and any associated message
	 */
	public function getEntryByName($value){
		if(!empty($value) || !is_null($value)){
			$query = "SELECT * FROM addr_orgs WHERE addr_orgs_name LIKE :value";
			$this->set($query);
			$this->bindParam(":value", $value);
			$result = $this->returnSingle();
			$this->setOrgId($result['addr_orgs_id']);
			$this->setOrgName($result['addr_orgs_name']);
			$this->retData['success'] = true;
			$this->retData['message'] = SUCCESS;
		}else{
			$this->retData['success'] = false;
			$this->retData['message'] = E_NO_ID;
			return($this->retData);
		}
	}

	/**
	 * addEntry adds a new record to the DB
	 * @return Array[]        Success boolean and any associated message
	 */
	public function addEntry(){
		$this->startTransaction();
		try{
			$query = "INSERT INTO addr_orgs (
					addr_orgs_id,
					addr_orgs_name)
					VALUES (
					NULL,
					:addr_orgs_name
					)";

					//echo "<br>".$query;
			$this->set($query);
			$this->bindParam(':addr_orgs_name', $this->getOrgName());
			
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

	/**
	 * updateEntry updates an existing record
	 * @param  int $id Organization ID
	 * @return Array[]        Success boolean and any associated message
	 */
	public function updateEntry($id){
		$this->startTransaction();
		try{
			$query = "UPDATE addr_orgs SET
				addr_orgs_name = :addr_orgs_name
				WHERE addr_orgs_id = :addr_orgs_id";	

			$this->set($query);
			$this->bindParam(':addr_orgs_name', $this->getOrgName());
			$this->bindParam(':addr_orgs_id', $this->getOrgId());

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

	/**
	 * Delete entry is used to delete a record (However, it is not publically integrated as of yet)
	 * @param  int $id Organization ID
	 * @return Array[]        Success boolean and any associated message
	 */
	public function deleteEntry($id){
		$this->startTransaction();
		try{
			$query = "DELETE FROM addr_orgs WHERE addr_orgs_id = :id";
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