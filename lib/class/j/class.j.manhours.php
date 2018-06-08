 <?php

	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');


	/**
	 * Class handles j Work Manhours
	 * Writte: 6/8/2018
	 * By: S. Mized 
	 */
	class j_WorkManHours extends Db{


		private $role;
		private $est;
		private $act;
		private $work_j_id;
		private $work_id;
		private $dateCreated;
		private $dateModified;
		private $fetchid;
		private $retData = array("success" => false , "message" => '' , "updateInfo" => '');

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

		public function getDateModified(){
			return($this->dateModified);
		}

		public function getDateCreated(){
			return($this->dateCreated);
		}

		public function getWorkJID(){
			return($this->work_j_id);
		}

		public function getWorkID(){
			return($this->work_id);
		}

		public function getRole(){
			return($this->role);
		}
		
		public function getEstimated(){
			return($this->est);
		}

		public function getActual(){
			return($this->act);
		}	

/***** SETTER METHODS *****/
		public function setFetchId($value = NULL){
			$this->fetchid = $value;
		}

		public function setDateCreated($value = NULL){
			$this->dateCreated = $value;
		}

		public function setDateUpdated($value = NULL){
			$this->dateModified = $value;
		}

		public function setWorkJID($value = NULL){
			$this->work_j_id = $value;
		}

		public function setWorkID($value = NULL){
			$this->work_id = $value;
		}

		public function setRole($value = NULL){
			$this->role = $value;
		}

		public function setActual($value = NULL){
			$this->act = $value;
		}

		public function setEstimated($value = NULL){
			$this->est = $value;
		}
	

/***** TRANSACTIONAL METHODS *****/

		public function getEntry($id){
			if(!empty($id) && !is_null($id)){
				$query = "SELECT * FROM work_j_manhours WHERE work_j_manhours.work_j_manhours_id = :id";
				
				$this->set($query);
				$this->bindParam(":id", $id);
				$result = $this->returnSingle();
				$this->retData['success'] = true;
				$this->retData['message'] = SUCCESS;
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
				$query = "INSERT INTO work_j_manhours (
							work_j_manhours_id,
							work_j_id,
							work_id,
							common_roles_id,
							work_j_manhours_est,
							work_j_manhours_act,
							work_j_delays_created,
							work_j_delays_updated)
						VALUES (
							NULL,
							:work_j_id,
							:work_id,
							:role,
							:est,
							:act,
							NOW(),
							NOW()
						)";

				$this->set($query);
				$this->bindParam(':work_j_id', $this->getWorkJID());
				$this->bindParam(':work_id', $this->getWorkID());
				$this->bindParam(':role', $this->getRole());
				$this->bindParam(':est', $this->getEstimated());
				$this->bindParam(':act', $this->getActual());
				$result = $this->execute();

				if($result){
					$this->endTransaction();
					$this->retData['success'] = TRUE;
					$this->retData['message'] = SUCCESS;
					return($this->retData);
				}else{
					$this->cancelTransaction();
					$this->retData['success'] = FALSE;
					$this->retData['message'] = FAIL_TRANSACTION.' - '.$this->getError();
					$this->retData['updateInfo'] = $this->getError();
					return($this->retData);
				}

			}catch(Exception $e){
				$this->cancelTransaction();
				$this->retData['success'] = FALSE;
				$this->retData['message'] = FAIL_TRANSACTION.' *** '.$e->getMessage();
				return($this->retData);
			}
		}

		public function updateEntry(){
			$this->startTransaction();
			try{
				$query = "UPDATE work_j_manhours SET
					common_roles_id = :role,
					work_j_manhours_est = :est,
					work_j_manhours_act = :act
					WHERE work_j_manhours_id = :id";

				$this->set($query);
				$$this->bindParam(':role', $this->getRole());
				$this->bindParam(':est', $this->getEstimated());
				$this->bindParam(':act', $this->getActual());
				$this->bindParam(':id', $this->getFetchId());
				$result = $this->execute();
				if($result){
					$this->endTransaction();
					$this->retData['success'] = true;
					$this->retData['message'] = SUCCESS;
					return($this->retData);
				}else{
					$this->cancelTransaction();
					$this->retData['success'] = FALSE;
					$this->retData['message'] = FAIL_TRANSACTION.' - '.$this->getError();
					$this->retData['updateInfo'] = $this->getError();
					return($this->retData);
				}
			}catch(Exception $e){
				$this->cancelTransaction();
				$this->retData['success'] = false;
				$this->retData['message'] = FAIL_TRANSACTION.' '.$e->getMessage();
				return($this->retData);
			}
		}

		public function deleteEntry($id){
			$this->startTransaction();
			try{
				$query = "DELETE FROM work_j_manhours WHERE work_j_manhours_id =:id";
				$this->set($query);
				$this->bindParam(":id", $id);
				$result = $this->execute();
				if($result){
					$this->endTransaction();
					$this->retData['success'] = TRUE;
					$this->retData['message'] = SUCCESS;
					return($this->retData);
				}else{
					$this->cancelTransaction();
					$this->retData['success'] = FALSE;
					$this->retData['message'] = FAIL_TRANSACTION.' - '.$this->getError();
					$this->retData['updateInfo'] = $this->getError();
					return($this->retData);
				}
			}catch(Exception $e){
				$this->cancelTransaction();
				$this->retData['success'] = false;
				$this->retData['message'] = CRITICAL_ERROR.' '.$e->getMessage();
				return($this->retData);
			}
		}

		public function getManHours($value = NULL){
			if(!empty($value) && !is_null($value)){
				$query = "SELECT
							work_j_manhours.work_j_manhours_id AS 'MANHOUR_ID',
							work_j_manhours.common_roles_id AS 'ROLE',
							common_roles.common_roles_desc AS 'DESC',
							work_j_manhours.work_j_manhours_est AS 'EST',
							work_j_manhours.work_j_manhours_act AS 'ACT'
							FROM work_j_manhours
							LEFT JOIN common_roles
							ON work_j_manhours.common_roles_id = common_roles.common_roles_id
							WHERE work_j_manhours.work_j_id = :value
							ORDER BY work_j_manhours.work_j_manhours_id ASC";
				$this->set($query);
				$this->bindParam(':value', $value);
				$result = $this->execute();
				if($result){
					if($this->rowCount() > 0){
						$this->retData['success'] = true;
						$this->retData['message'] = SUCCESS;
						$this->retData['updateInfo'] = $this->returnSet();
						return($this->retData);
					}else{
						$this->retData['success'] = true;
						$this->retData['message'] = NO_RECORD;
						$this->retData['updateInfo'] = NO_RECORD;
						return($this->retData);
					}
				}else{
					$this->retData['success'] = FALSE;
					$this->retData['message'] = FAIL_TRANSACTION.' - '.$this->getError();
					$this->retData['updateInfo'] = $this->getError();
					return($this->retData);
				}
			}else{
				$this->retData['success'] = FALSE;
				$this->retData['message'] = E_NO_ID;
				$this->retData['updateInfo'] = NULL;
				return($this->retData);
			}
		}
	}
?>