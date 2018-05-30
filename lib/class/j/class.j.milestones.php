 <?php
  	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');

	/**
	 * Class handles j Milestones
	 * Writte: 5/15/2018
	 * By: S. Mized 
	 */
	class j_WorkMilestones extends Db{

		private $work_j_id;
		private $work_id;
		private $milestone_id;
		private $milestone_name;
		private $milestone_value;
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

		public function getWorkJID(){
			return($this->work_j_id);
		}

		public function getWorkID(){	
			return($this->work_id);
		}

		public function getMilestone(){
			return($this->milestone_id);
		}

		public function getFormalMilestone(){
			return($this->milestone_name);
		}

		public function getMilestoneValue(){
			return($this->milestone_value);
		}

		public function getDateCreated(){
			return($this->dateCreated);
		}

		public function getDateModified(){
			return($this->dateModified);
		}


/***** SETTER METHODS *****/
		public function setFetchId($value = NULL){
			$this->fetchid = $value;
		}

		public function setWorkJMilestoneId($value = NULL){
			$this->milestone_id = $value;
		}

		public function setWorkJID($value = NULL){
			$this->work_j_id = $value;
		}

		public function setWorkID($value = NULL){
			$this->work_id = $value;
		}

		public function setMilestone($value = NULL){
			$this->milestone_id = $value;
		}

		public function setFormalMilestone($value = NULL){
			$this->milestone_name = $value;
		}

		public function setMilestoneValue($value = NULL){
			$this->milestone_value = $value;
		}

		public function setDateCreated($value = NULL){
			$this->dateCreated = $value;
		}

		public function setDateModified($value = NULL){
			$this->dateModified = $value;
		}


/***** TRANSACTIONAL METHODS *****/

		public function getEntry($id){
			if(!empty($id) && !is_null($id)){
				$query = "SELECT 
							work_j_milestones.work_j_milestones_id,
							work_j_milestones.work_j_id,
							work_j_milestones.work_id,
							work_j_milestones.work_j_common_milestones_id,
							common_eng_milestones.common_eng_milestones_desc,
							work_j_milestones.work_j_milestones_value,
							work_j_milestones.work_j_milestones_created,
							work_j_milestones.work_j_milestones_updated 
						FROM work_j_milestones 
						LEFT JOIN common_eng_milestones
							ON work_j_milestones.work_j_common_milestones_id = common_eng_milestones.common_eng_milestones_id
						WHERE work_j_milestones_id = :id";
				$this->set($query);
				$this->bindParam(":id", $id);
				$result = $this->returnSingle();
				$this->setFetchId($result['work_j_milestones_id']);
				$this->setWorkJID($result['work_j_id']);
				$this->setWorkID($result['work_id']);
				$this->setMilestone($result['work_j_common_milestones_id']);
				$this->setFormalMilestone($result['common_eng_milestones_desc']);
				$this->setMilestoneValue($result['work_j_milestones_value']);
				$this->setDateCreated($result['work_j_milestones_created']);
				$this->setDateModified($result['work_j_milestones_updated']);
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
				$query = "INSERT INTO work_j_milestones (
							work_j_milestones_id,
							work_j_id,
							work_id,
							work_j_common_milestones_id,
							work_j_milestones_value,
							work_j_milestones_created,
							work_j_milestones_updated )
							VALUES (
							NULL,
							:work_j_id,
							:work_id,
							:work_j_milestones_id,
							:work_j_milestones_value,
							NOW(),
							NOW()
						)";
				$this->set($query);
				$this->bindParam(':work_j_id', $this->getWorkJID());
				$this->bindParam(':work_id', $this->getWorkID());
				$this->bindParam(':work_j_milestones_id', $this->getMilestone());
				$this->bindParam(':work_j_milestones_value', $this->getMilestoneValue());

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
				$query = "UPDATE work_j_milestones SET
					work_j_common_milestones_id = :work_j_common_milestones_id,
					work_j_milestones_value = :work_j_milestones_value
					WHERE work_j_milestones_id = :id";

				$this->set($query);
				$this->bindParam(':work_j_common_milestones_id', $this->getMilestone());
				$this->bindParam(':work_j_milestones_value', $this->getMilestoneValue());
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
				$query = "DELETE FROM work_j_milestones WHERE work_j_milestones_id =:id";
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

		public function getMilestones($value = NULL){
			if(!empty($value) && !is_null($value)){
				$query = "SELECT 
							work_j_milestones.work_j_milestones_id AS 'UID',
							common_eng_milestones.common_eng_milestones_desc AS 'DESCRIPTION',
							common_eng_milestones.common_eng_milestones_group AS 'GROUPING',
							work_j_milestones.work_j_milestones_value AS 'VALUE',
							work_j_milestones.work_j_milestones_created AS 'CREATED',
							work_j_milestones.work_j_milestones_updated AS ' UPDATED'
						FROM work_j_milestones 
						LEFT JOIN common_eng_milestones
							ON work_j_milestones.work_j_common_milestones_id = common_eng_milestones.common_eng_milestones_id
						WHERE work_j_id = :value ORDER BY common_eng_milestones.common_eng_milestones_group, common_eng_milestones.common_eng_milestones_desc ASC";
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