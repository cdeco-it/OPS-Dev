<?php

	require_once('class.db.php');
	require_once('class.helper.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');
	
	/**
	 * Employee class handles work B Phase entry information
	 * Written:2/7/2018
	 * By: S. Mized
	 */
	class BWork extends Db{

		// Base J variables
		private $work_b_id;
		private $work_id;
		private $work_b_number;
		private $work_status_id;
		private $work_b_percentcomp;
		private $work_b_sow;
		private $work_b_created;
		private $work_b_updated;
		private $retData = array("success" => false , "message" => '' , "info" => '');

		/**
		 * Parent construction from class.db.php
		 */
		function __construct(){
			parent::__construct();
		}

/***** GETTER METHODS *****/
		
		public function getId(){
			return($this->work_b_id);
		}

		public function getWorkId(){
			return($this->work_id);
		}

		public function getWorkBNumber(){
			return($this->work_b_number);
		}

		public function getStatus(){
			return($this->work_status_id);
		}

		public function getPercentComplete(){
			return($this->work_b_percentcomp);
		}

		public function getSOW(){
			return($this->work_b_sow);
		}

		public function getDateModified(){
			return($this->work_b_updated);
		}

		public function getDateCreated(){
			return($this->work_b_updated);
		}


/***** SETTER METHODS *****/

		public function setId($value = NULL){
			$this->work_b_id = $value;
		}

		public function setWorkId($value = NULL){
			$this->work_id = $value;
		}

		public function setWorkBNumber($value = NULL){
			$this->work_b_number = $value;
		}

		public function setStatus($value = NULL){
			if(is_null($value)){
				$this->work_status_id = 3;
			}else{
				$this->work_status_id = $value;
			}
		}

		public function setPercentComplete($value = NULL){
			if(is_null($value)){
				$this->work_b_percentcomp = 0.0;
			}else{
				$this->work_b_percentcomp = $value;
			}
		}

		public function setSOW($value = NULL){
			$this->work_b_sow = $value;
		}

		public function setDateModified($value = NULL){
			$this->work_b_updated = $value;
		}

		public function setDateCreated($value = NULL){
			$this->work_b_created = $value;
		}

/***** GENERATOR METHODS *****/
		/**
		 * generateNewBID finds the next B Phase id for use that is
		 * attached to a particular Work_ID.
		 * @param  int $value Work ID value
		 * @return int        Next BID
		 */
		public function generateNextBID($value = NULL){
			if(is_numeric($value)){
				$query = "SELECT MAX(work_b.work_b_number) AS `max`
						FROM work_b 
						WHERE work_b.work_id = :work_id";
				$this->set($query);
				$this->bindParam(':work_id', $value);
				$result = $this->returnSingle();
				$next = $result['max']+1;
				return($next);
			}else{
				return(NULL);
			}
		}

/***** FINDER METHODS *****/

		public function findBID($value = NULL){
			if(is_numeric($value)){
				$query = "SELECT work_b.work_b_id FROM work_b WHERE work_b.work_id = :value";
				$this->set($query);
				$this->bindParam(":value", $value);
				$result = $this->returnSingle();
				$BID = $result['work_b_id'];
				return($BID);
			}else{
				return(NULL);
			}
		}
/***** TRANSACTIONAL METHODS *****/

		public function loadEntry($id = NULL){
			if(!is_null($id)){

				$query = "SELECT * FROM work_b WHERE work_b_id = :id";
				$this->set($query);
				$this->bindParam(":id", $id);
				$this->execute();
				$result = $this->returnSingle();
				if($result){
					$this->setId($result['work_b_id']);
					$this->setWorkId($result['work_id']);
					$this->setWorkBNumber($result['work_b_number']);
					$this->setStatus($result['work_status_id']);
					$this->setPercentComplete($result['work_b_percentcomp']);
					$this->setSOW($result['work_b_sow']);
					$this->setDateCreated($result['work_b_created']);
					$this->setDateModified($result['work_b_updated']);
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
				$query = "INSERT INTO work_b (
					work_b_id,
					work_id,
					work_b_number,
					work_status_id,
					work_b_percentcomp,
					work_b_sow,
					work_b_created,
					work_b_updated
				) VALUES (
					NULL,
					:work_id,
					:work_b_number,
					:work_status_id,
					:work_b_percentcomp,
					NULL,
					NOW(),
					NOW()
				)";

				echo '<pre>'.$query.'</pre><br /><br /><br />';

				$this->set($query);

				$this->bindParam(":work_id", $this->getWorkID());
				$this->bindParam(":work_b_number", $this->getWorkBNumber());
				$this->bindParam(":work_status_id", $this->getStatus());
				$this->bindParam(":work_b_percentcomp", $this->getPercentComplete());

				$result = $this->execute();

				if($result){
					$this->endTransaction();
					$this->retData['success'] = true;
					$this->retData['message'] = SUCCESS;
					$this->retData['info'] = var_dump(debug_backtrace());
					return($this->retData);
				}else{
					$this->cancelTransaction();
					$this->retData['success'] = false;
					$this->retData['message'] = FAIL_TRANSACTION.' '.$e->getMessage();
					$this->retData['info'] = var_dump(debug_backtrace());
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
				$query = "UPDATE work_b SET 
							work_b.work_status_id = :work_status,
							work_b.work_b_percentcomp = :work_b_percentcomp,
							work_b.work_b_sow = :work_b_sow,
							work_b.work_b_updated = NOW()
							WHERE work_b.work_b_id = :work_b_id";

				$this->set($query);
				$this->bindParam(":work_status", $this->getStatus());
				$this->bindParam(":work_b_percentcomp", $this->getPercentComplete());
				$this->bindParam(":work_b_sow", $this->getSOW());
				$this->bindParam(":work_b_id", $this->getId());

				$result = $this->execute();

				if($result){
					$this->endTransaction();
					$this->retData['success'] = true;
					$this->retData['message'] = SUCCESS;
					return($this->retData);
				}else{
					$this->cancelTransaction();
					$this->retData['success'] = false;
					$this->retData['message'] = FAIL_TRANSACTION.' '.$e->getMessage();
					$this->retData['info'] = var_dump(debug_backtrace());
					return($this->retData);
				}
			}catch(Exception $e){
				$this->cancelTransaction();
				$this->retData['success'] = false;
				$this->retData['message'] = FAIL_TRANSACTION;
				$this->retData['info'] = $e->getMessage();
				return($this->retData);
			}
		}
	}
?>