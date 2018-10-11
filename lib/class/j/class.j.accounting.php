 <?php

	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');


	/**
	 * Class handles j Work Accounting
	 * Writte: 8/2/2018
	 * By: S. Mized 
	 */
	class j_WorkAccounting extends Db{


		private $istm;
		private $contract_value;
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

		public function getTimeMaterials(){
			return($this->istm);
		}

		public function getContractValue(){
			return($this->contract_value);
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

		public function setTimeMaterials($value = NULL){
			$this->istm = $value;
		}

		public function setContractValue($value = NULL){
			$this->contract_value = $value;
		}

	

/***** TRANSACTIONAL METHODS *****/

		public function getEntry($id){
			if(!empty($id) && !is_null($id)){
				$query = "SELECT * FROM work_j_acct_info WHERE work_j_acct_info.work_j_acct_info_id = :id";
				
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
				$query = "INSERT INTO work_j_acct_info (
							work_j_acct_info_id,
							work_j_id,
							work_id,
							work_j_acct_info_istm,
							work_j_acct_info_contract_value,
							work_j_acct_info_created,
							work_j_acct_info_updated)
						VALUES (
							NULL,
							:work_j_id,
							:work_id,
							:istm,
							:contract_value,
							NOW(),
							NOW()
						)";

				$this->set($query);
				$this->bindParam(':work_j_id', $this->getWorkJID());
				$this->bindParam(':work_id', $this->getWorkID());
				$this->bindParam(':istm', $this->getTimeMaterials());
				$this->bindParam(':contract_value', $this->getContractValue());
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
				$query = "UPDATE work_j_acct_info SET
					work_j_acct_info_istm = :istm,
					work_j_acct_info_contract_value = :contract_value,
					WHERE work_j_acct_info_id = :id";

				$this->set($query);
				$$this->bindParam(':istm', $this->getTimeMaterials());
				$this->bindParam(':contract_value', $this->getContractValue());
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
				$query = "DELETE FROM work_j_acct_info WHERE work_j_acct_info_id =:id";
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

		public function getAccountingInfo($value = NULL){
			if(!empty($value) && !is_null($value)){
				$query = "SELECT
							work_j_acct_info.work_j_acct_info_id AS 'ID',
							work_j_acct_info.work_j_id AS 'PARENT_ID',
							work_j_acct_info.work_j_acct_info_istm AS 'ISTM',
							work_j_acct_info.work_j_acct_infor_contract_value AS 'CONTRACT_VALUE'
							FROM work_j_acct_info
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