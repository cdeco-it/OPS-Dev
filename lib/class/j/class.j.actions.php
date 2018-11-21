 <?php

	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');



	/**
	 * Class handles j Work Actions
	 * Writte: 6/1/2018
	 * By: S. Mized 
	 */
	class j_WorkActions extends Db{
		
		private $assignedTo;
		private $assignedToName;
		private $assignedDate;
		private $dueDate;
		private $dateComplete;
		private $task;
		private $comments;
		private $isComplete;
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

		public function getAssignedTo(){
			return($this->assignedTo);
		}

		public function getAssignedToName(){
			return($this->assignedToName);
		}

		public function getDueDate(){
			return($this->dueDate);
		}

		public function getDateAssigned(){
			return($this->assignedDate);
		}

		public function getDateComplete(){
			return($this->dateComplete);
		}

		public function getTask(){
			return($this->task);
		}

		public function getComments(){
			return($this->comments);
		}

		public function getIsComplete(){
			return($this->isComplete);
		}


/***** SETTER METHODS *****/
		public function setFetchId($value = NULL){
			$this->fetchid = $value;
		}

		public function setDateCreated($value = NULL){
			$this->dateCreated = $value;
		}

		public function setDateModified($value = NULL){
			$this->dateModified = $value;
		}

		public function setWorkJID($value = NULL){
			$this->work_j_id = $value;
		}

		public function setWorkID($value = NULL){
			$this->work_id = $value;
		}

		public function setAssignedTo($value = NULL){
			$this->assignedTo = $value;
		}

		public function setAssignedToName($value = NULL){
			$this->assignedToName = $value;
		}

		public function setDueDate($value = NULL){
			$this->dueDate = $value;
		}

		public function setDateAssigned($value = NULL){
			$this->assignedDate = $value;
		}

		public function setDateComplete($value = NULL){
			$this->dateComplete = $value;
		}

		public function setTask($value = NULL){
			$this->task = $value;
		}

		public function setComments($value = NULL){
			$this->comments = $value;
		}

		public function setIsComplete($value = NULL){
			$this->isComplete = $value;
		}


/***** TRANSACTIONAL METHODS *****/

		public function getEntry($id){
			if(!empty($id) && !is_null($id)){
				$query = "SELECT * FROM work_j_actions WHERE work_j_actions.work_j_actions_id = :id";
				$this->set($query);
				$this->bindParam(":id", $id);
				$result = $this->returnSingle();

				$this->setFetchId($result['work_j_actions_id']);
				$this->setWorkID($result['work_id']);
				$this->setWorkJID($result['work_j_id']);
 				$this->setAssignedTo($result['work_j_actions_assignedto']);
 				$this->setDateAssigned($result['work_j_actions_assigned']);
 				$this->setDueDate($result['work_j_actions_due']);
 				$this->setDateComplete($result['work_j_actions_date_completed']);
 				$this->setTask($result['work_j_actions_task']);
 				$this->setComments($result['work_j_actions_comments']);
 				$this->setIsComplete($result['work_j_actions_is_complete']);
 				$this->setDateModified($result['work_j_actions_updated']);
 				$this->setDateCreated($result['work_j_actions_created']);
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
				$query = "INSERT INTO work_j_actions (
							work_j_actions_id,
							work_j_id,
							work_id,
							work_j_actions_assignedTo,
							work_j_actions_assigned,
							work_j_actions_due,
							work_j_actions_date_completed,
							work_j_actions_task,
							work_j_actions_comments,
							work_j_actions_is_complete,
							work_j_actions_created,
							work_j_actions_updated)
						VALUES (
							NULL,
							:work_j_id,
							:work_id,
							:assignedTo,
							:dateAssigned,
							:dateDue,
							:dateCompleted,
							:task,
							:comments,
							NULL,
							NOW(),
							NOW()
						)";

				$this->set($query);
				$this->bindParam(':work_j_id', $this->getWorkJID());
				$this->bindParam(':work_id', $this->getWorkID());
				$this->bindParam(':assignedTo', $this->getAssignedTo());
				$this->bindParam(':dateAssigned', $this->getDateAssigned());
				$this->bindParam(':dateDue', $this->getDueDate());
				$this->bindParam(':dateCompleted', $this->getDateComplete());
				$this->bindParam(':task', $this->getTask());
				$this->bindParam(':comments', $this->getComments());

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
				$query = "UPDATE work_j_actions SET
					work_j_actions_assignedto = :assignedTo,
					work_j_actions_assigned = :dateAssigned,
					work_j_actions_due = :dateDue,
					work_j_actions_date_completed = :dateCompleted,
					work_j_actions_task = :task,
					work_j_actions_comments = :comments,
					work_j_actions_is_complete = :isComplete
					WHERE work_j_actions_id = :id";

				$this->set($query);
				$this->bindParam(':assignedTo', $this->getAssignedTo());
				$this->bindParam(':dateAssigned', $this->getDateAssigned());
				$this->bindParam(':dateDue', $this->getDueDate());
				$this->bindParam(':dateCompleted', $this->getDateComplete());
				$this->bindParam(':task', $this->getTask());
				$this->bindParam(':comments', $this->getComments());
				$this->bindParam(':isComplete', $this->getIsComplete());
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
				$query = "DELETE FROM work_j_actions WHERE work_j_actions_id =:id";
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