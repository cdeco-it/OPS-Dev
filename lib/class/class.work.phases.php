<?php

	require_once('class.db.php');
	require_once('class.helper.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');
	
	/**
	 * Class handles work phase entry information
	 * Written:2/16/2018
	 * By: S. Mized
	 */
	class WorkPhases extends Db{

		//Common vars
		private $record_id;
		private $parent_id;
		private $phase_id;
		private $status;
		private $status_desc;
		private $percentComplete;
		private $sow;
		private $created;
		private $modified;
		private $retData = array("success" => false , "message" => '' , "info" => '');
		
		//Special vars
		private $fcv;
		

		/**
		 * Parent construction from class.db.php
		 */
		function __construct(){
			parent::__construct();
		}
/***** FLUSH METHOD *****/



/***** GETTER METHODS *****/
		public function getRecordId(){
			return($this->record_id);
		}

		public function getParentId(){
			return($this->parent_id);
		}

		public function getPhaseId(){
			return($this->phase_id);
		}

		public function getStatus(){
			return($this->status);
		}

		public function getStatusDesc(){
			return($this->status_desc);
		}

		public function getPercentComplete(){
			return($this->percentComplete);
		}

		public function getSOW(){
			return($this->sow);
		}

		public function getDateCreated(){
			return($this->created);
		}

		public function getDateModified(){
			return($this->modified);
		}

		public function getFcv(){
			return($this->p_fcv);
		}


/***** SETTER METHODS *****/

		public function setRecordId($value = NULL){
			$this->record_id = $value;
		}

		public function setParentId($value = NULL){
			$this->parent_id = $value;
		}

		public function setPhaseId($value = NULL){
			$this->phase_id = $value;
		}

		public function setStatus($value = NULL){
			if(is_null($value)){
				$this->status = 3;
			}else{
				$this->status = $value;
			}
		}

		public function setStatusDesc($value = NULL){
			$this->status_desc = $value;
		}

		public function setPercentComplete($value = NULL){
			if(is_null($value)){
				$this->percentComplete = 0.0;
			}else{
				$this->percentComplete = $value;
			}
		}

		public function setSOW($value = NULL){
			$this->sow = $value;
		}

		public function setDateCreated($value = NULL){
			$this->created = $value;

		}

		public function setDateModified($value = NULL){
			$this->modified = $value;
		}

		public function setFcv($value = NULL){
			if(is_null($value)){
				$this->p_fcv = 0.0;
			}else{
				if(is_numeric($value)){
					$this->p_fcv = $value;
				}else{
					$this->p_fcv = 0.0;
				}
			}
		}


/***** GENERATOR METHODS *****/
		public function generateNextPhaseId($parent = NULL, $phase = NULL){
			if(is_numeric($parent) && !is_null($phase)){
				switch(strtolower($phase)){
					case "p":
						$query = "SELECT MAX(work_p.work_p_number) AS `max`
									FROM work_p 
									WHERE work_p.work_id = :work_id";
						break;
					case "j":
						$query = "SELECT MAX(work_j.work_j_number) AS `max`
									FROM work_j 
									WHERE work_j.work_id = :work_id";
						break;

					case "c":
						$query = "SELECT MAX(work_c.work_c_number) AS `max`
									FROM work_c 
									WHERE work_c.work_id = :work_id";
						break;

					case "b":
						$query = "SELECT MAX(work_b.work_b_number) AS `max`
									FROM work_b 
									WHERE work_b.work_id = :work_id";
						break;

					case "s":
						$query = "SELECT MAX(work_s.work_s_number) AS `max`
									FROM work_s 
									WHERE work_s.work_id = :work_id";
						break;

					default:
						return(NULL);
						break;
				}

				$this->set($query);
				$this->bindParam(':work_id', $parent);
				$result = $this->returnSingle();
				$next = $result['max']+1;
				return($next);
			}else{
				return(NULL);
			}
		}


/***** FINDER METHODS *****/

		public function findPhaseID($value = NULL, $phase = NULL){
			if(is_numeric($value) && !is_null($phase)){
				switch(strtolower($phase)){
					case "j":
						$query = "SELECT work_j.work_j_id FROM work_j WHERE work_j.work_id = :value";
						break;

					case "p":
						$query = "SELECT work_p.work_p_id FROM work_p WHERE work_p.work_id = :value";
						break;

					case "c":
						$query = "SELECT work_c.work_c_id FROM work_c WHERE work_c.work_id = :value";
						break;

					case "b":
						$query = "SELECT work_b.work_b_id FROM work_b WHERE work_b.work_id = :value";
						break;

					case "s":
						$query = "SELECT work_s.work_s_id FROM work_s WHERE work_s.work_id = :value";
						break;

					default:
						return(NULL);
						break;
				}

				$this->set($query);
				$this->bindParam(':value', $value);
				$result = $this->returnSingle();
				switch(strtolower($phase)){
					case "j":
						return($result['work_j_id']);
						break;
					case "p":
						return($result['work_p_id']);
						break;
					case "c":
						return($result['work_c_id']);
						break;
					case "b":
						return($result['work_b_id']);
						break;
					case "s":
						return($result['work_s_id']);
						break;
					default:
						return(NULL);
						break;
				}
			}else{
				return(NULL);
			}
		}


/***** TRANSACTIONAL METHODS *****/
		public function loadEntry($id = NULL, $phase = NULL){
			//Check the phase and ID for validity
			if(is_numeric($id) && !is_null($phase)){

				//Select query by base.
				switch(strtolower($phase)){
					case "j":
						$query = "SELECT * FROM work_j LEFT JOIN work_status ON work_j.work_status_id = work_status.work_status_id WHERE work_j_id = :id";
						break;

					case "p":
						$query = "SELECT * FROM work_p LEFT JOIN work_status ON work_p.work_status_id = work_status.work_status_id WHERE work_p_id = :id";
						break;

					case "c":
						$query = "SELECT * FROM work_c LEFT JOIN work_status ON work_c.work_status_id = work_status.work_status_id WHERE work_c_id = :id";
						break;

					case "b":
						$query = "SELECT * FROM work_b LEFT JOIN work_status ON work_b.work_status_id = work_status.work_status_id WHERE work_b_id = :id";
						break;

					case "p":
						$query = "SELECT * FROM work_p LEFT JOIN work_status ON work_p.work_status_id = work_status.work_status_id WHERE work_p_id = :id";
						break;

					default:
						//If no valid phase, FAIL and return
						$this->retData['success'] = false;
						$this->retData['message'] = E_INVALID_PHASE;
						return($this->retData);
						break;
				}

				//Process the query
				$this->set($query);
				$this->bindParam(':id', $id);
				$this->execute();
				$result = $this->returnSingle();

				//If there is a valid phase
				if($result){

					//Select actions by phase and proceed
					switch(strtolower($phase)){
						case "j":
							//Process a M
							$this->setRecordId($result['work_j_id']);
							$this->setParentId($result['work_id']);
							$this->setPhaseId($result['work_j_number']);
							$this->setStatus($result['work_status_id']);
							$this->setStatusDesc($result['work_status_desc']);
							$this->setPercentComplete($result['work_j_percentcomp']);
							$this->setSOW($result['work_j_sow']);
							$this->setDateCreated($result['work_j_created']);
							$this->setDateModified($result['work_j_updated']);
							break;

						case "p":
							//Process as P
							$this->setRecordId($result['work_p_id']);
							$this->setParentId($result['work_id']);
							$this->setPhaseId($result['work_p_number']);
							$this->setStatus($result['work_status_id']);
							$this->setStatusDesc($result['work_status_desc']);
							$this->setPercentComplete($result['work_p_percentcomp']);
							$this->setSOW($result['work_p_sow']);
							$this->setDateCreated($result['work_p_created']);
							$this->setDateModified($result['work_p_updated']);
							break;

						case "c":
							//Process as C
							$this->setRecordId($result['work_c_id']);
							$this->setParentId($result['work_id']);
							$this->setPhaseId($result['work_c_number']);
							$this->setStatus($result['work_status_id']);
							$this->setStatusDesc($result['work_status_desc']);
							$this->setPercentComplete($result['work_c_percentcomp']);
							$this->setSOW($result['work_c_sow']);
							$this->setDateCreated($result['work_c_created']);
							$this->setDateModified($result['work_c_modified']);
							break;

						case "b":
							//Process as B
							$this->setRecordId($result['work_b_id']);
							$this->setParentId($result['work_id']);
							$this->setPhaseId($result['work_b_number']);
							$this->setStatus($result['work_status_id']);
							$this->setStatusDesc($result['work_status_desc']);
							$this->setPercentComplete($result['work_b_percentcomp']);
							$this->setSOW($result['work_b_sow']);
							$this->setDateCreated($result['work_b_created']);
							$this->setDateModified($result['work_b_modified']);
							break;

						case "s":
							//Process as S
							$this->setRecordId($result['work_s_id']);
							$this->setParentId($result['work_id']);
							$this->setPhaseId($result['work_s_number']);
							$this->setStatus($result['work_status_id']);
							$this->setStatusDesc($result['work_status_desc']);
							$this->setPercentComplete($result['work_s_percentcomp']);
							$this->setSOW($result['work_s_sow']);
							$this->setDateCreated($result['work_s_created']);
							$this->setDateModified($result['work_s_modified']);
							break;

						default:
							//If phase isn't right...or some how we get past initial check FAIL.
							$this->retData['success'] = false;
							$this->retData['message'] = E_NO_PHASE;
							return($this->retData);
							break;
					}

				}else{
					//If the query fails, report false and return.
					$this->retData['success'] = false;
					$this->retData['message'] = ERROR;
					$this->retData['info'] = var_dump(debug_backtrace());
					return($this->retData);
				}
				
				//If everthing goes right...finish.
				$this->retData['success'] = true;
				$this->retData['message'] = SUCCESS;
				return($this->retData);

			}else{
				//Handle error where ID is NULL or no
				if(is_null($id) || is_numeric($id)){
					$this->retData['success'] = false;
					$this->retData['message'] = E_NO_ID;
				//Handle error if no PHASE is present
				}else if(is_null($phase)){
					$this->retData['success'] = false;
					$this->retData['message'] = E_NO_PHASE;
				//Handle all other anomoly
				}else{
					$this->retData['success'] = false;
					$this->retData['message'] = ERROR;
					$this->retData['info'] = var_dump(debug_backtrace());
				}

				return($this->retData);
			}
		}

		public function addEntry($phase = NULL){
			//Check if a phase exists
			if(!is_null($phase)){

				//Choose the path based on phase
				switch(strtolower($phase)){

					//Process J phase
					case "j":
						$query = "INSERT INTO work_j (
							work_j_id,
							work_id,
							work_j_number,
							work_status_id,
							work_j_percentcomp,
							work_j_sow,
							work_j_created,
							work_j_updated
						) VALUES (
							NULL,
							:work_id,
							:work_number,
							:work_status_id,
							:work_percentcomp,
							NULL,
							NOW(),
							NOW()
						)";
						break;

					//Process C Phase
					case "c":
						$query = "INSERT INTO work_c (
							work_c_id,
							work_id,
							work_c_number,
							work_status_id,
							work_c_percentcomp,
							work_c_sow,
							work_c_created,
							work_c_updated
						) VALUES (
							NULL,
							:work_id,
							:work_number,
							:work_status_id,
							:work_percentcomp,
							NULL,
							NOW(),
							NOW()
						)";
						break;

					//Process P Phase
					case "p":
						$query = "INSERT INTO work_p (
							work_p_id,
							work_id,
							work_p_number,
							work_status_id,
							work_p_fcv,
							work_p_percentcomp,
							work_p_sow,
							work_p_created,
							work_p_updated
						) VALUES (
							NULL,
							:work_id,
							:work_number,
							:work_status_id,
							0,
							:work_percentcomp,
							NULL,
							NOW(),
							NOW()
						)";
						break;

					//Process B phase
					case "b":
						$query = "INSERT INTO work_b (
							work_b_id,
							work_id,
							work_b_number,
							work_status_id,
							work_b_fcv,
							work_b_percentcomp,
							work_b_sow,
							work_b_created,
							work_b_updated
						) VALUES (
							NULL,
							:work_id,
							:work_number,
							:work_status_id,
							0,
							:work_percentcomp,
							NULL,
							NOW(),
							NOW()
						)";
						break;

					//Process S Phase
					case "s":
						$query = "INSERT INTO work_s (
							work_s_id,
							work_id,
							work_s_number,
							work_status_id,
							work_s_percentcomp,
							work_s_sow,
							work_s_created,
							work_s_updated
						) VALUES (
							NULL,
							:work_id,
							:work_number,
							:work_status_id,
							:work_percentcomp,
							NULL,
							NOW(),
							NOW()
						)";
						break;

					default:
						//If no valid phase, FAIL and return
						$this->retData['success'] = false;
						$this->retData['message'] = E_INVALID_PHASE;
						return($this->retData);
						break;
				}

				//Set the query and params.
				$this->set($query);
				$this->bindParam(':work_id', $this->getParentId());
				$this->bindParam(':work_number', $this->getPhaseId());
				$this->bindParam(':work_status_id', $this->getStatus());
				$this->bindParam(':work_percentcomp', $this->getPercentComplete());

				//Start the transaction
				try{
					$this->startTransaction();
					$result = $this->execute();
					if($result){
						$lastId = $this->lastInsertId();
						$this->endTransaction();
						$this->retData['success'] = true;
						$this->retData['message'] = SUCCESS;
						$this->retData['info'] = $lastId;
					}else{
						$this->cancelTransaction();
						$this->retData['success'] = false;
						$this->retData['message'] = FAIL_TRANSACTION;
						$this->retData['info'] = var_dump(debug_backtrace());
					}

					//Return the result of the function.
					return($this->retData);

				}catch(Exception $e){
					//Catch the exception and report.
					$this->cancelTransaction();
					$this->retData['success'] = false;
					$this->retData['message'] = FAIL_TRANSACTION;
					$this->retData['info'] = $e->getMessage();
					return($this->retData);
				}

			}else{
				//If phase is invalid or not set...FAIL and return
				$this->retData['success'] = false;
				$this->retData['message'] = E_INVALID_PHASE;
				return($this->retData);
			}
		}

		public function updateEntry($phase = NULL){
			if(!is_null($phase)){
				switch($phase){
					case "j":
						$query = "UPDATE work_j SET 
							work_j.work_status_id = :work_status,
							work_j.work_j_percentcomp = :work_percentcomp,
							work_j.work_j_sow = :work_sow,
							work_j.work_j_updated = NOW()
							WHERE work_j.work_j_id = :work_number";
						break;

					case "c":
						$query = "UPDATE work_c SET 
							work_c.work_status_id = :work_status,
							work_c.work_c_percentcomp = :work_percentcomp,
							work_c.work_c_sow = :work_sow,
							work_c.work_c_updated = NOW()
							WHERE work_c.work_c_id = :work_number";
						break;
					
					case "b":
						$query = "UPDATE work_b SET 
							work_b.work_status_id = :work_status,
							work_b.work_b_percentcomp = :work_percentcomp,
							work_b.work_b_sow = :work_sow,
							work_b.work_b_updated = NOW()
							WHERE work_b.work_b_id = :work_number";
						break;

					case "p":
						$query = "UPDATE work_p SET 
							work_p.work_status_id = :work_status,
							work_p.work_p_percentcomp = :work_percentcomp,
							work_p.work_p_sow = :work_sow,
							work_p.work_p_updated = NOW()
							WHERE work_p.work_p_id = :work_number";
						break;

					case "s":
						$query = "UPDATE work_s SET 
							work_s.work_status_id = :work_status,
							work_s.work_s_percentcomp = :work_percentcomp,
							work_s.work_s_sow = :work_sow,
							work_s.work_s_updated = NOW()
							WHERE work_s.work_s_id = :work_number";
						break;

					default:
						//If no valid phase, FAIL and return
						$this->retData['success'] = false;
						$this->retData['message'] = E_INVALID_PHASE;
						return($this->retData);
						break;
				}

				$this->set($query);
				$this->bindParam(':work_status', $this->getStatus());
				$this->bindParam(':work_p_percentcomp', $this->getPercentComplete());
				$this->bindParam(':work_number', $this->getPhaseId());

				try{

					$this->beginTransaction();
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

					//Return the result of the function.
					return($this->retData);

				}catch(Exception $e){
					//Catch the exception and report.
					$this->cancelTransaction();
					$this->retData['success'] = false;
					$this->retData['message'] = FAIL_TRANSACTION;
					$this->retData['info'] = $e->getMessage();
					return($this->retData);					
				}

			}else{
				//If phase is invalid or not set...FAIL and return
				$this->retData['success'] = false;
				$this->retData['message'] = E_INVALID_PHASE;
				return($this->retData);
			}
		}
	}
?>