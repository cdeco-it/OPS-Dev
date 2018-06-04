 <?php

	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');


	/**
	 * Class handles j Work Submittals and RFI's
	 * Writte: 6/4/2018
	 * By: S. Mized 
	 */
	class j_WorkSubsRfis extends Db{
		
		private $logtype;
		private $status;
		private $intTrackNum;
		private $extTrackNum;
		private $receivedBy;
		private $receivedByName;
		private $dateReceived;
		private $qtyReceived;
		private $dueDate;
		private $subject;
		private $disposition;
		private $dispositionDescription;
		private $notes;
		private $dateReturned;
		private $qtyReturned;

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

		public function getLogType(){
			return($this->logtype);
		}

		public function getStatus(){
			return($this->status);
		}

		public function getInternalTrackingNUmber(){
			return($this->intTrackNum);
		}

		public function getExternalTrackingNumber(){
			return($this->extTrackNum);
		}

		public function getReceivedBy(){
			return($this->receivedBy);
		}

		public function getReceivedByName(){
			return($this->receivedByName);
		}

		public function getDateReceived(){
			return($this->dateReceived);
		}

		public function getQuantityReceived(){
			return($this->getQuantityReceived);
		}

		public function getDueDate(){
			return($this->dueDate);
		}

		public function getSubject(){
			return($this->subject);
		}

		public function getDisposition(){
			return($this->disposition);
		}

		public function getDispositionDescription(){
			return($this->dispositionDescription);
		}

		public function getNotes(){
			return($this->notes);
		}

		public function getDateReturned(){
			return($this->dateReturned);
		}

		public function getQuantityReturned(){
			return($this->qtyReturned);
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

		public function setInternalTrackingNUmber($value = NULL){
			$this->intTrackNum = $value;
		}

		public function setExternalTrackingNumber($value = NULL){
			$this->extTrackNum = $value;
		}

		public function setReceivedBy($value = NULL){
			$this->receivedBy = $value;
		}

		public function setReceivedByName($value = NULL){
			$this->receivedByName = $value;
		}

		public function setDateReceived($value = NULL){
			$this->dateReceived = $value;
		}

		public function setQuantityReceived($value = NULL){
			$this->getQuantityReceived = $value;
		}

		public function setDueDate($value = NULL){
			$this->dueDate = $value;
		}

		public function setSubject($value = NULL){
			$this->subject = $value;
		}

		public function setDisposition($value = NULL){
			$this->disposition = $value;
		}

		public function setDispositionDescription($value = NULL){
			$this->dispositionDescription = $value;
		}

		public function setNotes($value = NULL){
			$this->notes = $value;
		}

		public function setDateReturned($value = NULL){
			$this->dateReturned = $value;
		}

		public function setQuantityReturned($value = NULL){
			$this->qtyReturned = $value;
		}


/***** TRANSACTIONAL METHODS *****/

		public function getEntry($id){
			if(!empty($id) && !is_null($id)){
				$query = "SELECT * FROM work_j_rfisub_log WHERE work_j_rfisub_log.work_j_rfisub_log_id = :id";
				$this->set($query);
				$this->bindParam(":id", $id);
				$result = $this->returnSingle();

				//Add populators

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
				$query = "INSERT INTO work_j_rfisub_log (
							work_j_rfisub_log_id,
							work_j_id,
							work_id,
							work_j_rfisub_log_type,
							work_j_rfisub_log_status,
							work_j_rfisub_log_internal_track,
							work_j_rfisub_log_external_track,
							work_j_rfisub_log_receivedby,
							work_j_rfisub_log_date_received,
							work_j_rfisub_log_due_date,
							work_j_rfisub_log_subject,
							work_j_rfisub_log_disposition,
							work_j_rfisub_log_notes,
							work_j_rfisub_log_date_returned,
							work_j_rfisub_log_qty_returned,
							work_j_rfisub_log_created,
							work_j_rfisub_log_updated)
						VALUES (
							NULL,
							:work_j_id,
							:work_id,
							:work_j_rfisub_log_type
							:work_j_rfisub_log_status,
							:work_j_rfisub_log_internal_track,
							:work_j_rfisub_log_external_track,
							:work_j_rfisub_log_receivedby,
							:work_j_rfisub_log_date_received,
							:work_j_rfisub_log_due_date,
							:work_j_rfisub_log_subject,
							:work_j_rfisub_log_disposition,
							:work_j_rfisub_log_notes,
							:work_j_rfisub_log_date_returned,
							NOW(),
							NOW()
						)";

				$this->set($query);
				$this->bindParam(':work_j_id', $this->getWorkJID());
				$this->bindParam(':work_id', $this->getWorkID());
				$this->bindParam(':addr_id', $this->getAddrId());
				$this->bindParam(':work_j_rfisub_log_type', $this->getLogType());
				$this->bindParam(':work_j_rfisub_log_status', $this->getStatus());
				$this->bindParam(':work_j_rfisub_log_internal_track', $this->getInternalTrackingNUmber());
				$this->bindParam(':work_j_rfisub_log_external_track', $this->getExternalTrackingNumber());
				$this->bindParam(':work_j_rfisub_log_receivedby', $this->getReceivedBy());
				$this->bindParam(':work_j_rfisub_log_date_received', $this->getDateReceived());
				$this->bindParam(':work_j_rfisub_log_due_date', $this->getDueDate());
				$this->bindParam(':work_j_rfisub_log_subject', $this->getSubject());
				$this->bindParam(':work_j_rfisub_log_disposition', NULL);
				$this->bindParam(':work_j_rfisub_log_notes', NULL);
				$this->bindParam(':work_j_rfisub_log_date_returned', NULL);
				$this->bindParam(':work_j_rfisub_log_qty_returned', NULL)
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
				$query = "UPDATE work_j_subrfi_log SET
						
						




					WHERE :work_j_rfisub_log_id = :id";

				$this->set($query);
				$this->bindParam(':role', $this->getConsultantRole());
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
				$query = "DELETE FROM work_j_consultants WHERE work_j_consultants_id =:id";
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

		public function getActions($value = NULL){
			if(!empty($value) && !is_null($value)){
				$query = 'SELECT	
							work_j_actions.work_j_actions_id AS "ACT_ID",
							work_J_actions.work_j_actions_assignedTo AS "EMP_ID",
							CONCAT_WS(" ", employee.employee_fname, employee.employee_lname) AS "EMP_NAME",
							work_j_actions.work_j_actions_assigned AS "DATE_ASSIGNED",
							work_j_actions.work_j_actions_due AS "DATE_DUE",
							work_j_actions.work_j_actions_date_completed AS "DATE_COMP",
							DATEDIFF(work_j_actions.work_j_actions_due, NOW()) AS "REMAIN",
							work_j_actions.work_j_actions_task AS "TASK",
							work_j_actions.work_j_actions_comments AS "COMMENTS",
							work_j_actions.work_j_actions_is_complete AS "COMPLETE"
							FROM work_j_actions
							LEFT JOIN employee
							ON work_j_actions.work_j_actions_assignedTo = employee.employee_id
							WHERE work_j_actions.work_j_id = :value';
				$this->set($query);
				$this->bindParam(':value', $value);
				$result = $this->returnSet();
				if($this->rowCount() > 0){
					return($result);
				}else{
					return(NULL);
				}
			}
		}
	}
?>