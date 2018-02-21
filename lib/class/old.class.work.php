<?php

	require_once('class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');
	
	/**
	 * Employee class handles work entry information
	 * Written:1/31/2018
	 * By: S. Mized
	 */
	class Work extends Db{

		private $work_id;
		private $work_year;
		private $work_number;
		private $work_title;
		private $work_client;
		private $work_client_rep;
		private $work_db;
		private $work_status;
		private $work_j_id;
		private $work_c_id;
		private $work_p_id;
		private $work_b_id;
		private $work_s_id;
		private $dateModified;
		private $dateCreated;
		private $retData = array("success" => false , "message" => '' , "info" => '');
	
	/**
	 * Parent construction from class.db.php
	 */
		function __construct(){
			parent::__construct();
		}

/***** FINDER METHODS *****/
		public function findWorkID($year, $number){
			if(!is_null($year) || !is_null($number) || !empty($year) || !empty($number)){
				$query = "SELECT work.work_id FROM work WHERE work.work_year = :year AND work.work_number = :number";
				$this->set($query);
				$this->bindParam(':year', $year);
				$this->bindParam(':number', $number);
				$result = $this->returnSingle();
				return($result['work_id']);
			}else{
				return(NULL);
			}
		}

/***** GENERATOR METHODS *****/
		public function generateNextWorkId($value = NULL){
			if(is_null($value) || empty($value)){
				$year = date("Y");
			}else{
				if($value >= 1000 && $value <= 9999){
					$year = $value;
				}else{
					$year = date("Y");
				}
			}

			$query = "SELECT MAX(work.work_id) as 'next' FROM work";
			$this->set($query);
			$result = $this->returnSingle();
			$next = $result['next']+1;

			return($next);
		}

		public function generateNewWorkNumber($value = NULL){
			if(is_null($value) || empty($value)){
				$year = date("Y");
			}else{
				if($value >= 1000 && $value <= 9999){
					$year = $value;
				}else{
					$year = date("Y");
				}
			}

			$query = "SELECT COUNT(work.work_number) AS 'next' FROM work WHERE work.work_year = :year";
			$this->set($query);
			$this->bindParam(':year', $year);
			$result = $this->returnSingle();
			$next = $result['next']+1;
			
			return($next);
		}

		public function generateFormalWorkNumber($year, $id){
			//Convert to 2 digit year if 4 digit
			if(strlen($year) > 2){
				$year = substr($year, 2);
			}

			//Add leading zeros
			$id = str_pad($id, 3, "0", STR_PAD_LEFT);

			//Combine & return
			$value = $year.'-'.$id;
			return($value);
		}

/***** GETTER METHODS *****/

		public function getId(){
			return($this->work_id);
		}

		public function getYear(){
			return($this->work_year);
		}

		public function getTitle(){
			return($this->work_title);
		}

		public function getWorkNumber(){
			return($this->work_number);
		}

		public function getClient(){
			return($this->work_client);
		}

		public function getClientRep(){
			return($this->work_client_rep);
		}

		public function getDB(){
			return($this->work_db);
		}

		public function getStatus(){
			return($this->work_status);
		}

		public function getJID(){
			return($this->work_j_id);
		}

		public function getCID(){
			return($this->work_c_id);
		}

		public function getPID(){
			return($this->work_p_id);
		}

		public function getBID(){
			return($this->work_b_id);
		}

		public function getSID(){
			return($this->work_s_id);
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

/***** SETTER METHODS *****/
	
		/**
		 * setId sets the value for primary key Work ID
		 * @param int $value Work ID value
		 */
		public function setId($value = NULL){
			if(!is_null($value) || !empty($value)){
				$this->work_id = $value;
			}else{
				$this->work_id = NULL;
			}
		}

		/**
		 * setYear sets the value for the year of a work project entry.  Defaults to current year
		 * if no value is passed.
		 * @param int $value Year of Work entry
		 */
		public function setYear($value = NULL){
			if(!is_null($value) || !empty($value)){
				//Check if the year is corret
				if($value >= 1000 && $value <= 9999){
					$this->work_year = $value;
				}else{
					$this->work_year = date("Y");
				}
			}else{
				$this->work_year = date("Y");
			}
		}

		/**
		 * setWorkNumber sets the actual project number of a work entry.
		 * @param int $value Value of Work Number
		 */
		public function setWorkNumber($value = NULL){
			if(!is_null($value) || !empty($value)){
				$this->work_number = $value;
			}
		}

		/**
		 * setTitle sets the master title for a project
		 * @param String $value Title
		 */
		public function setTitle($value = NULL){
			if(!is_null($value) || !empty($value)){
				$this->work_title = $value;
			}
		}

		/**
		 * setWorkClient sets the master client.  This is a FK reference to addr_orgs.
		 * @param int $value addr_orgs_id value
		 */
		public function setWorkClient($value = NULL){
			if(!is_null($value) || !empty($value)){
				$this->work_client = $value;
			}
		}

		/**
		 * setWorkClientRep sets the mast client representative.  This is a FK references to addr.
		 * @param int $value addr_id value
		 */
		public function setWorkClientRep($value = NULL){
			if(!is_null($value) || !empty($value)){
				$this->work_client_rep = $value;
			}
		}

		/**
		 * setDB flags if a project is design/build or not.
		 * @param int $value 0=FALSE,1=TRUE
		 */
		public function setDB($value = NULL){
			if(!is_null($value) || !empty($value)){
				$this->work_db = $value;
			}else{
				$this->work_db = 0;
			}
		}

		/**
		 * setStatus stes the master status of the work entry.  This is a FK reference to work_status.
		 * @param int $value work_status_id value
		 */
		public function setStatus($value = NULL){
			if(!is_null($value) || !empty($value)){
				if(is_int($value)){
					$this->work_client = $value;
				}else{
					$this->work_client = 3;
				}
			}else{
				$this->work_client = 3;
			}
		}

		/**
		 * setJID sets the master value of the J Phase entry.   This is a FK reference to work_j.
		 * @param int $value work_j_id value
		 */
		public function setJID($value = NULL){
			if(is_numeric($value)){
				$this->work_j_id = $value;
			}else{
				$this->work_j_id = NULL;
			}
		}

		/**
		 * setSID sets the master value of the S Phase entry.  This is a FK reference to work_s.
		 * @param int $value work_s_id value
		 */
		public function setSID($value = NULL){
			if(is_numeric($value)){
				$this->work_s_id = $value;
			}else{
				$this->work_s_id = NULL;
			}
		}

		/**
		 * setBID sets the master value of the B Phase entry.  This is a FK reference to work_b.
		 * @param int $value work_b_id value
		 */
		public function setBID($value = NULL){
			if(is_numeric($value)){
				$this->work_b_id = $value;
			}else{
				$this->work_b_id = NULL;
			}
		}

		/**
		 * setPID sets the master value of the P Phase entry.  This is a FK reference to work_p
		 * @param int $value work_p_id value
		 */
		public function setPID($value = NULL){
			if(is_numeric($value)){
				$this->work_p_id = $value;
			}else{
				$this->work_p_id = NULL;
			}
		}

		/**
		 * setCID sets the master value of the C Phase entry.  This is a FK reference to work_c.
		 * @param [type] $value [description]
		 */
		public function setCID($value = NULL){
			if(is_numeric($value)){
				$this->work_c_id = $value;
			}else{
				$this->work_c_id = NULL;
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
		 * setDateCreated sets the initial record entry date for an entry
		 * @param string $value SQL Formatted datestamp
		 */
		public function setDateCreated($value = NULL){
			$this->dateCreated = $value;
		}

/***** TRANSACTION METHODS *****/

		/**
		 * loadEntry loads all information for a specific record in the work table.  Look up is by work_id value.  Returns standard
		 * @param  int $id work_id value
		 * @return Array     SQL diagnostics
		 */
		public function loadEntry($id = NULL){
			if(!is_null($id)){
				$query = "SELECT * FROM work WHERE work_id = :id";
				$this->set($query);
				$this->bindParam(":id", $id);
				$result = $this->returnSingle();
				if($result){
					$this->setId($result['work_id']);
					$this->setWorkNumber($result['work_number']);
					$this->setYear($result['work_year']);
					$this->setTitle($result['work_title']);
					$this->setWorkClient($result['work_client']);
					$this->setWorkClientRep($result['work_client_rep']);
					$this->setDB($result['work_db']);
					$this->setStatus($result['work_status']);
					$this->setJID($result['work_j_id']);
					$this->setCID($result['work_c_id']);
					$this->setPID($result['work_p_id']);
					$this->setBID($result['work_b_id']);
					$this->setSID($result['work_s_id']);
					$this->setDateCreated($result['work_created']);
					$this->setDateModified($result['work_updated']);
					$this->retData['success'] = true;
					$this->retData['message'] = SUCCESS;
				}else{
					$this->retData['success'] = false;
					$this->retData['message'] = ERROR;
					$this->retData['info'] = var_dump(debug_backtrace());
				}

				return($this->retData);

			}else{
				$this->retData['success'] = false;
				$this->retData['message'] = E_NO_ID;
				return($this->retData);
			}
		}


		public function addEntry(){
			$this->startTransaction();
			try{
				$query = "INSERT INTO work (
								work_id,
								work_year,
								work_number,
								work_title,
								work_client,
								work_client_rep,
								work_db,
								work_status,
								work_j_id,
								work_c_id,
								work_p_id,
								work_b_id, 
								work_s_id,
								work_created,
								work_updated)
							VALUES (
								NULL,
								:work_year,
								:work_number,
								:work_title,
								:work_client,
								:work_client_rep,
								:work_db,
								:work_status,
								:work_j_id,
								:work_c_id,
								:work_p_id,
								:work_b_id,
								:work_s_id,
								NOW(),
								NOW()
							)";

				$this->set($query);
				$this->bindParam(":work_year", $this->getYear());
				$this->bindParam(":work_number", $this->getWorkNumber());
				$this->bindParam(":work_title", $this->getTitle());
				$this->bindParam(":work_client", $this->getClient());
				$this->bindParam(":work_client_rep", $this->getClientRep());
				$this->bindParam(":work_db", $this->getDB());
				$this->bindParam(":work_status", $this->getStatus());
				$this->bindParam(":work_j_id", $this->getJID());
				$this->bindParam(":work_c_id", $this->getCID());
				$this->bindParam(":work_p_id", $this->getPID());
				$this->bindParam(":work_b_id", $this->getBID());
				$this->bindParam(":work_s_id", $this->getSID());

				$result = $this->execute();

				if($result){
					$this->endTransaction();
					$this->retData['success'] = true;
					$this->retData['message'] = SUCCESS;
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
				$this->retData['message'] = FAIL_TRANSACTION;
				$this->retData['info'] = $e->getMessage();
				return($this->retData);
			}
		}


		public function updateEntry(){
			$this->startTransaction();
			try{
				$query = "UPDATE work SET 
							work.work_year = :work_year,
							work.work_number = :work_number,
							work.work_title = :work_title,
							work.work_client = :work_client,
							work.work_client_rep = :work_client_rep,
							work.work_db = :work_db,
							work.work_status = :work_status,
							work.work_j_id = :work_j_id,
							work.work_c_id = :work_c_id,
							work.work_p_id = :work_p_id,
							work.work_b_id = :work_b_id,
							work.work_s_id = :work_s_id,
							work.work_updated = NOW()
						WHERE work.work_id = :work_id";

				$this->set($query);
				$this->bindParam(":work_year", $this->getYear());
				$this->bindParam(":work_number", $this->getWorkNumber());
				$this->bindParam(":work_title", $this->getTitle());
				$this->bindParam(":work_client", $this->getClient());
				$this->bindParam(":work_client_rep", $this->getClientRep());
				$this->bindParam(":work_db", $this->getDB());
				$this->bindParam(":work_status", $this->getStatus());
				$this->bindParam(":work_j_id", $this->getJID());
				$this->bindParam(":work_c_id", $this->getCID());
				$this->bindParam(":work_p_id", $this->getPID());
				$this->bindParam(":work_b_id", $this->getBID());
				$this->bindParam(":work_s_id", $this->getSID());
				$this->bindParam(":work_id", $this->getId());

				$result = $this->execute();
					
				if($result){
					$this->endTransaction();
					$this->retData['success'] = true;
					$this->retData['message'] = SUCCESS;
					;
				}else{
					$this->cancelTransaction();
					$this->retData['success'] = false;
					$this->retData['message'] = FAIL_TRANSACTION.' '.$e->getMessage();
					$this->retData['info'] = var_dump(debug_backtrace());
				}

				return($this->retData);

			}catch(Exception $e){
				$this->cancelTransaction();
				$this->retData['success'] = false;
				$this->retData['message'] = FAIL_TRANSACTION.' '.$e->getMessage();
				return($this->retData);
			}
		}
	}
?>