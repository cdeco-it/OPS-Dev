 <?php
  	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');

	/**
	 * Class handles j Discussions
	 * Writte: 5/31/2018
	 * By: S. Mized 
	 */
	class j_WorkDiscussions extends Db{

		private $work_j_id;
		private $work_id;
		private $entry;
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

		public function getDiscussion(){
			return($this->entry);
		}

		public function getDateModified(){
			return($this->dateModified);
		}

		public function getDateCreated(){
			return($this->dateCreated);
		}

/***** SETTER METHODS *****/
		public function setFetchId($value = NULL){
			$this->fetchid = $value;
		}

		public function setWorkJID($value = NULL){
			$this->work_j_id = $value;
		}

		public function setWorkID($value = NULL){
			$this->work_id = $value;
		}

		public function setDiscussion($value = NULL){
			$this->entry = $value;
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
				$query = "SELECT * FROM 
				work_j_discussions 
				WHERE work_j_discussions_id = :id";
				$this->set($query);
				$this->bindParam(":id", $id);
				$result = $this->returnSingle();
				$this->setFetchId($result['work_j_discussions_id']);
				$this->setWorkJID($result['work_j_id']);
				$this->setWorkID($result['work_id']);
				$this->setDiscussion($result['work_j_discussions_entry']);
				$this->setDateCreated($result['work_j_discussions_created']);
				$this->setDateModified($result['work_j_discussions_updated']);
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
				$query = "INSERT INTO work_j_discussions (
							work_j_discussions_id,
							work_j_id,
							work_id,
							work_j_discussions_entry,
							work_j_discussions_created,
							work_j_discussions_updated )
							VALUES (
							NULL,
							:work_j_id,
							:work_id,
							:work_j_discussions_entry,
							NOW(),
							NULL
						)";
				$this->set($query);
				$this->bindParam(':work_j_id', $this->getWorkJID());
				$this->bindParam(':work_id', $this->getWorkID());
				$this->bindParam(':work_j_discussions_entry', $this->getDiscussion());

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
				$query = "UPDATE work_j_discussions SET
					work_j_discussions_entry = :work_j_discussions_entry,
					work_j_discussions_updated = NOW()
					WHERE work_j_discussion_id = :id";

				$this->set($query);
				$this->bindParam(':work_j_discussions_entry', $this->getDiscussion());
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
				$query = "DELETE FROM work_j_discussions WHERE work_j_discussions_id =:id";
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

		public function getDiscussions($value = NULL){
			if(!empty($value) && !is_null($value)){
				$query = "SELECT * FROM work_j_discussions WHERE work_j_id = :id ORDER BY work_j_discussions_created DESC";
				$this->set($query);
				$this->bindParam(':id', $value);
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