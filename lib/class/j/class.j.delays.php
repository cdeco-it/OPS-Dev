 <?php

	require_once('class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');


	/**
	 * Class handles j Work Delays
	 * Writte: 5/29/2018
	 * By: S. Mized 
	 */
	class j_WorkDelays extends Db{


		private $work_j_id;
		private $work_id;
		private $parentMilestone;
		private $reasonText;
		private $finalizedDate;
		private $cause;
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

		public function getReason(){
			return($this->reasonText);
		}

		public function getFinalizedDate(){
			return($this->finalizedDate);
		}

		public function getCause(){
			return($this->cause);
		}

		public function getParentMilestone(){
			return($this->parentMilestone);
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

		public function setReason($value = NULL){
			$this->reasonText = $value;
		}

		public function setFinalizedDate($value = NULL){
			$this->finalizedDate = $value;
		}

		public function setCause($value = NULL){
			$this->cause = $value;
		}

		public function setParentMilestone($value = NULL){
			$this->parentMilestone = $value;
		}

/***** TRANSACTIONAL METHODS *****/

		public function getEntry($id){
			if(!empty($id) && !is_null($id)){
				$query = "SELECT * FROM work_j_delays WHERE work_j_delays.work_j_delays_id = :id";
				
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
				$query = "INSERT INTO work_j_delays (
							work_j_delays_id,
							work_j_id,
							work_j_milestones_id,
							work_j_delays_reason,
							work_j_delays_finalized_date,
							work_j_delays_cause,
							work_j_delays_created,
							work_j_delays_updated)
						VALUES (
							NULL,
							:work_j_id,
							:work_j_milesteone_id,
							:work_j_delays_reason,
							:work_j_delays_finalized_date,
							:work_j_delays_cause,
							NOW(),
							NOW()
						)";

				$this->set($query);
				$this->bindParam(':work_j_id', $this->getWorkJID());
				$this->bindParam(':work_j_milestones_id', $this->getParentMilestone());
				$this->bindParam(':work_j_delays_reason', $this->getReason());
				$this->bindParam(':work_j_delays_finalized_date', $this->getFinalizedDate());
				$this->bindParam(':work_j_delays_cause', $this->getCause());
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
				$query = "UPDATE work_j_delays SET
					work_j_milestones_id = :milestone,
					work_j_delays_reason = :reason,
					work_j_delays_finalized_date = :finalized,
					work_j_delays_cause = :cause,
					work_j_delays_updated = NOW()
					WHERE work_j_delays_id = :id";

				$this->set($query);
				$this->bindParam(':milestone', $this->getParentMilestone());
				$this->bindParam(':reasons', $this->getReason());
				$this->bindParam(':finalized', $this->getFinalizedDate());
				$this->bindParam(':cause', $this->getCause());
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
				$query = "DELETE FROM work_j_delays WHERE work_j_delays_id =:id";
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
//@TODO - Finalize the delay show....
		public function getDelays($value = NULL){
			if(!empty($value) && !is_null($value)){
				$query = "SELECT 
							work_j_delays.work_j_delays_id AS 'UID',
							work_j_delays.work_j_milestones_id AS 'PARENT',
							work_j_delays.work_j_delays_reasons AS 'VALUE',
							work_j_delays.work_j_delays_finazlied_date AS 'FINALIZED',
							work_j_delays.work_j_delays_cause AS ' CAUSE'
						FROM work_j_delays
						LEFT JOIN common_eng_milestones
							ON work_j_delays.work_j_milestones_id = work_j_milestones.work_j_milestones_id
						WHERE work_j_id = :value ORDER BY work_j_delays.work_j_delays_updated DESC";
				$this->set($query);
				$this->bindParam(':value', $value);
				$result = $this->returnSet();
				if($this->rowCount() > 0){
					return($result);
				}else{
					return('No milestones set.');
				}
			}
		}
	}
?>