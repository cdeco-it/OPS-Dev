<?php

	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');


	/**
	 * Class handles j Work Accounting
	 * Writte: 8/2/2018
	 * By: S. Mized 
	 */
	class j_WorkAccountingMods extends Db{


		private $parentId;
		private $value;
		private $notes;
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
		public function getParentId(){
			return $this->parentId;
		}

		public function getValue(){
			return $this->value;
		}

		public function getNotes(){
			return $this->notes;
		}

		public function getFetchId(){
			return($this->fetchid);
		}

		public function getDateModified(){
			return($this->dateModified);
		}

		public function getDateCreated(){
			return($this->dateCreated);
		}
/***** SETTER METHOD *****/

		public function setParentId($value = NULL){
			$this->parentId = $value;
		}

		public function setValue($value = NULL){
			$this->value = $value;
		}

		public function setNotes($value = NULL){
			$this->notes = $value;
		}

		public function setFetchId($value = NULL){
			$this->fetchid = $value;
		}

		public function setDateCreated($value = NULL){
			$this->dateCreated = $value;
		}

		public function setDateUpdated($value = NULL){
			$this->dateModified = $value;
		}

/***** TRANSACTIONAL METHODS *****/

		public function getEntry($id){
			if(!empty($id) && !is_null($id)){
				$query = "SELECT * FROM work_j_acct_info_mods WHERE work_j_acct_info_mods.work_j_acct_info_mods_id = :id";
				$this->set($query);
				$this->bindParam(":id", $id);
				$result = $this->returnSingle();
				$this->setFetchId($result['work_j_acct_info_mods_id']);
				$this->setParentId($result['work_j_acct_info_id']);
				$this->setValue($result['work_j_acct_info_mods_value']);
				$this->setNotes($result['work_j_acct_info_mods_notes']);
				$this->setDateUpdated($result['work_j_acct_info_mods_updated']);
				$tihs->setDateCreated($result['work_j_acct_info_mods_created']);
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
				$query = "INSERT INTO work_j_acct_info_mods (
							work_j_acct_info_mods_id,
							work_j_acct_info_id,
							work_j_acct_info_mods_value,
							work_j_acct_info_mods_notes,
							work_j_acct_info_mods_created,
							work_j_acct_info_mods_updated)
						VALUES (
							NULL,
							:parentId,
							:value,
							:notes,
							NOW(),
							NOW()
						)";

				$this->set($query);
				$this->bindParam(':parentId', $this->getParentId());
				$this->bindParam(':value', $this->getValue());
				$this->bindParam(':notes', $this->getNotes());
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
				$query = "UPDATE work_j_acct_info_mods SET
					work_j_acct_info_mods_value = :value,
					work_j_acct_info_mods_notes = :notes,
					WHERE work_j_acct_info_mods_id = :id";

				$this->set($query);
				$this->bindParam(':value', $this->getValue());
				$this->bindParam(':notes', $this->getNotes());
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
				$query = "DELETE FROM work_j_acct_info_mods WHERE work_j_acct_info_mods_id =:id";
				$this->set($query);
				$this->bindParam(":id", $id);
				$result = $this->execute();
				if($result){
					$this->endTransaction();
					$this->retData['success'] = TRUE;
					$this->retData['message'] = SUCCESS_DELETE;
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
	}
?>