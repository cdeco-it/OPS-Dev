<?php

	require_once('class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');
	
	/**
	 * Employee class handles work entry information
	 * Written:2/19/2018
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
		private $work_status_desc;
		private $work_j_id;
		private $work_c_id;
		private $work_p_id;
		private $work_b_id;
		private $work_s_id;
		private $modified;
		private $created;
		private $retData = array("success" => false , "message" => '' , "info" => '');
	
	/**
	 * Parent construction from class.db.php
	 */
		function __construct(){
			parent::__construct();
		}

/***** GETTER METHODS *****/

		public function getId(){
			return($this->work_id);
		}

		public function getYear(){
			return($this->work_year);
		}

		public function getWorkNumber(){
			return($this->work_number);
		}

		public function getTitle(){
			return($this->work_title);
		}

		public function getClient(){
			return($this->work_client);
		}

		public function getClientRep(){
			return($this->work_client_rep);
		}

		public function getDb(){
			return($this->work_db);
		}

		public function getStatus(){
			return($this->work_status);
		}

		public function getStatusDesc(){
			return($this->work_status_desc);
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

		public function getDateCreated(){
			return($this->created);
		}

		public function getDateModified(){
			return($this->modified);
		}

/***** SETTER METHODS *****/

		public function setId($value = NULL){
			if(is_numeric($value)){
				$this->work_id = $value;
			}
		}

		public function setYear($value = NULL){
			if(is_numeric($value)){
				if($value > 1000 && $value <= 9999){
					$this->work_year = $value;
				}else{
					$this->work_year = date('Y');
				}
			}else{
				$this->work_year = date('Y');
			}		
		}

		public function setWorkNumber($value = NULL){
			if(is_numeric($value)){
				$this->work_number = $value;
			}
		}

		public function setTitle($value = NULL){
			$this->work_title = $value;
		}

		public function setClient($value = NULL){
			if(is_numeric($value)){
				$this->work_client = $value;
			}else{
				$this->work_client = NULL;
			}
		}

		public function setClientRep($value = NULL){
			if(is_numeric($value)){
				$this->work_client_rep = $value;
			}else{
				$this->work_client_rep = NULL;
			}
		}

		public function setDb($value = NULL){
			if(!is_null($value)){
				if(is_numeric($value)){
					if($value <= 1){
						$this->work_db = $value;
					}
				}else{
					$this->work_db = 0;
				}
			}else{
				$this->work_db = 0;
			}
		}

		public function setStatus($value = NULL){
			if(is_numeric($value)){
				$this->work_status = $value;
			}else{
				$this->work_status = 3;
			}
		}

		public function setStatusDesc($value = NULL){
			$this->work_status_desc = $value;
		}

		public function setJID($value = NULL){
			if(is_numeric($value)){
				$this->work_j_id = $value;
			}else{
				$this->work_j_id = NULL;
			}
		}

		public function setCID($value = NULL){
			if(is_numeric($value)){
				$this->work_c_id = $value;
			}else{
				$this->work_c_id = NULL;
			}
		}

		public function setPID($value = NULL){
			if(is_numeric($value)){
				$this->work_p_id = $value;
			}else{
				$this->work_p_id = NULL;
			}
		}

		public function setBID($value = NULL){
			if(is_numeric($value)){
				$this->work_b_id = $value;
			}else{
				$this->work_b_id = NULL;
			}
		}

		public function setSID($value = NULL){
			if(is_numeric($value)){
				$this->work_s_id = $value;
			}else{
				$this->work_s_id = NULL;
			}
		}

		public function setDateCreated($value = NULL){
			$this->created = $value;
		}

		public function setDateModified($value = NULL){
			$this->modified = $value;
		}

/***** TRANSACTIONAL METHODS *****/

		public function loadEntry($id = NULL){
			if(is_numeric($id)){
				$query = "SELECT * FROM work LEFT JOIN work_status ON work.work_status = work_status.work_status_id WHERE work.work_id = :id";
				$this->set($query);
				$this->bindParam(':id', $id);
				$result = $this->returnSingle();
				if($result){
					//Load results in...
					$this->setId($result['work_id']);
					$this->setYear($result['work_year']);
					$this->setWorkNumber($result['work_number']);
					$this->setTitle($result['work_title']);
					$this->setClient($result['work_client']);
					$this->setClientRep($result['work_client_rep']);
					$this->setDb($result['work_db']);
					$this->setStatus($result['work_status']);
					$this->setStatusDesc($result['work_status_desc']);
					$this->setJID($result['work_j_id']);
					$this->setPID($result['work_p_id']);
					$this->setBID($result['work_b_id']);
					$this->setCID($result['work_c_id']);
					$this->setSID($result['work_s_id']);
					$this->setDateCreated($result['work_created']);
					$this->setDateModified($result['work_updated']);
					$this->retData['success'] = TRUE;
					$this->retData['message'] = SUCCESS;
					return($this->retData);
				}else{
					$this->retData['success'] = FALSE;
					$this->retData['message'] = ERROR;
					$this->retData['info'] = var_dump(debug_backtrace());
					return($this->retData);
				}
			}else{
				$this->retData['success'] = FALSE;
				$this->retData['message'] = E_NO_ID;
				return($this->retData);
			}
		}

		public function updateEntry(){

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
					WHERE work.work_id = :id";
			$this->set($query);
			
			$this->bindParam(':work_year', $this->getYear());
			$this->bindParam(':work_number', $this->getWorkNumber());
			$this->bindParam(':work_title', $this->getTitle());
			$this->bindParam(':work_client', $this->getClient());
			$this->bindParam(':work_client_rep', $this->getClientRep());
			$this->bindParam(':work_db', $this->getDb());
			$this->bindParam(':work_status', $this->getStatus());
			$this->bindParam(':work_j_id', $this->getJID());
			$this->bindParam(':work_c_id', $this->getCID());
			$this->bindParam(':work_p_id', $this->getPID());
			$this->bindParam(':work_b_id', $this->getBID());
			$this->bindParam(':work_s_id', $this->getSID());
			$this->bindParam(':id', $this->getId());

			try{
				$this->startTransaction();
				$result = $this->execute();
				if($result){
					$this->endTransaction();
					$this->retData['success'] = TRUE;
					$this->retData['message'] = SUCCESS;
					$this->retData['info'] = var_dump(debug_backtrace());
					return($this->retData);
				}else{
					$this->cancelTransaction();
					$this->retData['success'] = FALSE;
					$this->retData['message'] = FAIL_TRANSACTION;
					$this->retData['info'] = var_dump(debug_backtrace());
					return($this->retData);
				}
			}catch(Exception $e){
				$this->cancelTransaction();
				$this->retData['success'] = FALSE;
				$this->retData['message'] = ERROR;
				$this->retData['info'] = $e->getMessage();
				return($this->retData);
			}
		}

		public function addEntry(){
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
			$this->bindParam(":work_db", $this->getDb());
			$this->bindParam(":work_status", $this->getStatus());
			$this->bindParam(":work_j_id", $this->getJID());
			$this->bindParam(":work_c_id", $this->getCID());
			$this->bindParam(":work_p_id", $this->getPID());
			$this->bindParam(":work_b_id", $this->getBID());
			$this->bindParam(":work_s_id", $this->getSID());

			try{
				$this->startTransaction();
				$result = $this->execute();
				if($result){
					$lastId = $this->lastInsertId();
					$this->endTransaction();
					$this->retData['success'] = TRUE;
					$this->retData['message'] = SUCCESS;
					$this->retData['info'] = $lastId;
					return($this->retData);
				}else{
					$this->cancelTransaction();
					$this->retData['success'] = FALSE;
					$this->retData['message'] = FAIL_TRANSACTION;
					$this->retData['info'] = var_dump(debug_backtrace());
					return($this->retData);
				}
			}catch(Exception $e){
				$this->cancelTransaction();
				$this->retData['success'] = FALSE;
				$this->retData['message'] = ERROR;
				$this->retData['info'] = $e->getMessage();
				return($this->retData);
			}
		}

/***** FINDER & GENERATOR METHODS *****/

		public function findWorkId($year = NULL, $number = NULL){
			if(is_numeric($year) && is_numeric($number)){
				$query = "SELECT work.work_id FROM work WHERE work.work_year = :year AND work.work_number = :number";
				$this->set($query);
				$this->bindParam(':year', $year);
				$this->bindParam(':number', $number);
				$result = $this->returnSingle();
				if($result){
					return($result['work_id']);
				}else{
					return(NULL);
				}
			}else{
				return(NULL);
			}
		}


		public function generateNewWorkId($year = NULL){
			if(is_null($year)){
				$y = date('Y');
			}else{
				if($year >= 1000 && $year <= 9999){
					$y = $year;
				}else{
					$y = date('Y');
				}
			}
			$query = "SELECT COUNT(work.work_number) AS 'next' FROM work WHERE work.work_year = :year";
			$this->set($query);
			$this->bindParam(':year', $y);
			$result = $this->returnSingle();
			$next = $result['next']+1;
			return($next);
		}

		public function generateFormalNumber($year, $id){
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
	}
?>