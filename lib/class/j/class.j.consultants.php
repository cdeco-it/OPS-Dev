 <?php

	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');


	/**
	 * Class handles j Work Consultants
	 * Writte: 6/1/2018
	 * By: S. Mized 
	 */
	class j_WorkConsultants extends Db{

		private $work_j_id;
		private $work_id;
		private $addr_id;
		private $consultant_name;
		private $consultant_firm;
		private $consultant_role;
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

		public function getAddrId(){
			return($this->addr_id);
		}

		public function getConsultantName(){
			return($this->consultant_name);
		}

		public function getConsultantFirm(){
			return($this->consultant_firm);
		}

		public function getConsultantRole(){
			reutrn($this->consultant_role);
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

		public function setAddrId($value = NULL){
			$this->addr_id = $value;
		}

		public function setConsultantName($value = NULL){
			$this->consultant_name = $value;
		}

		public function setConsultantFirm($value = NULL){
			$this->consultant_firm = $value;
		}

		public function setConsultantRole($value = NULL){
			$this->consultant_role = $value;
		}

		


/***** TRANSACTIONAL METHODS *****/

		public function getEntry($id){
			if(!empty($id) && !is_null($id)){
				$query = "SELECT * FROM work_j_consultants WHERE work_j_consultants.work_j_consultants_id = :id";
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
				$query = "INSERT INTO work_j_consultants (
							work_j_consultants_id,
							work_j_id,
							work_id,
							addr_id,
							work_j_consultants_role,
							work_j_team_created,
							work_j_team_updated)
						VALUES (
							NULL,
							:work_j_id,
							:work_id,
							:addr_id,
							:work_j_consultants_role,
							NOW(),
							NOW()
						)";

				$this->set($query);
				$this->bindParam(':work_j_id', $this->getWorkJID());
				$this->bindParam(':work_id', $this->getWorkID());
				$this->bindParam(':addr_id', $this->getAddrId());
				$this->bindParam(':work_j_consultants_role', $this->getConsultantRole());
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
				$query = "UPDATE work_j_consultants SET
					work_j_consultants_role = :role
					WHERE work_j_consultants_id = :id";

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

		public function getConsultants($value = NULL){
			if(!empty($value) && !is_null($value)){
				$query = 'SELECT	
							work_j_consultants.work_j_consultants_id AS "ID",
							work_j_consultants.addr_id AS "ADDR_ID",
							CONCAT_WS(" ", view_addr_formal.addr_fname, view_addr_formal.addr_lname) AS "NAME",
							view_addr_formal.addr_org AS "ORG",
							work_j_consultants.work_j_consultants_role AS "ROLE"
							FROM work_j_consultants
							LEFT JOIN view_addr_formal
								ON work_j_consultants.addr_id = view_addr_formal.addr_id
							WHERE work_j_consultants.work_j_id = :value';
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