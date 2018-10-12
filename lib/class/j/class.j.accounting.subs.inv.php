 <?php

	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');


	/**
	 * Class handles j Work Accounting Invoincing
	 * Writte: 10/11/2018
	 * By: S. Mized 
	 */
	
	class j_WorkAccountingSubsInv extends Db{


		private $parentId;
		private $subId;
		private $invoiceNumber;
		private $invAmt;
		private $invDate;
		private $isPaid;
		private $paidDate;
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
		return $this->fetchid;
	}

	public function getParentId(){
		return $this->parentId;
	}

	public function getSubId(){
		return $this->subId;
	}

	public function getInvoiceNumber(){
		return $this->invoiceNumber;
	}

	public function getInvoideDate(){
		return $this->invDate;
	}

	public function getInvoiceAmount(){
		return $this->invAmt;
	}

	public function getPaidStatus(){
		return $this->isPaid;
	}

	public function getPaidDate(){
		return $this->paidDate;
	}

	public function getDateModified(){
		return $this->dateModified;
	}

	public function getDateCreated(){
		return $this->dateCreated;
	}

/***** SETTER METHODS *****/
	public function setFetchId($value = NULL){
		$this->fetchid = $value;
	}

	public function setParentId($value = NULL){
		$this->parentId = $value;
	}

	public function setSubId($value= NULL){
		$this->subId = $value;
	}

	public function setInoviceNumber($value = NULL){
		$this->invoiceNumber = $value;
	}

	public function setInvoiceDate($value = NULL){
		$this->invDate = $value;
	}

	public function setInvoiceAmount($value = NULL){
		$this->$invAmt = $value;
	}

	public function setPaidStatus($value = NULL){
		$this->isPaid = $value;
	}

	public function setPaidDate($value = NULL){
		$this->paidDate = $value;
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
				$query = "SELECT * FROM work_j_acct_inv WHERE work_j_acct_subs_inv.work_j_acct_subs_info_id = :id";
				
				$this->set($query);
				$this->bindParam(":id", $id);
				$result = $this->returnSingle();
				if($result){
					$this->setFetchId($id);
					$this->setParentId($result['work_j_acct_info_id']);
					$this->setSubId($result['work_j_acct_subs_id']);
					$this->setInoviceNumber($result['work_j_acct_subs_inv_number']);
					$this->setInvoiceAmount($result['work_j_acct_subs_inv_amount']);
					$this->setInvoiceDate($result['work_j_acct_subs_inv_date']);
					$this->setPaidStatus($result['work_j_acct_subs_inv_ispaid']);
					$this->setPaidDate($result['work_j_acct_subs_inv_date_paid']);
					$this->setDateUpdated($result['work_j_acct_subs_inv_updated']);
					$this->setDateCreated($result['work_j_acct_subs_inv_created']);
					$this->retData['success'] = true;
					$this->retData['message'] = SUCCESS;
					return($this->retData);
				}else{
					$this->retData['success'] = FALSE;
					$this->retData['message'] = FAIL_TRANSACTION.' - '.$this->getError();
					$this->retData['updateInfo'] = $this->getError();
					return($this->retData);
				}
			}else{
				$this->retData['success'] = false;
				$this->retData['message'] = E_NO_ID;
				return($this->retData);
			}	
		}

		public function addEntry(){
			$this->startTransaction();
			try{
				$query = "INSERT INTO work_j_acct_subs_inv (
							work_j_acct_subs_inv_id,
							work_j_acct_info_id,
							work_j_acct_subs_id,
							work_j_acct_subs_inv_number,
							work_j_acct_subs_inv_amount,
							work_j_acct_subs_inv_date,
							work_j_acct_subs_inv_ispaid,
							work_j_acct_subs_inv_date_paid,
							work_j_acct_subs_inv_info_created,
							work_j_acct_subs_inv_info_updated)
						VALUES (
							NULL,
							:parentId,
							:subId,
							:invoiceNumber,
							:invoiceAmount,
							:invoideDate,
							:isPaid,
							:datePaid,
							NOW(),
							NOW()
						)";

				$this->set($query);
				$this->bindParam(':parentId', $this->getParentId());
				$this->bindParam(':subId', $this->getSubId());
				$this->bindParam(':invoiceNumber', $this->getInvoiceNumber());
				$this->bindParam(':invoiceAmount', $this->getInvoiceAmount());
				$this->bindParam(':invoiceDate', $this->getInvoideDate());
				$this->bindParam(':isPaid', $this->getPaidStatus());
				$this->bindParam(':datePaid', $this->getPaidDate());
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
				$query = "UPDATE work_j_acct_inv SET
					work_j_acct_inv_amount = :invoiceAmount,
					work_j_acct_inv_date = :invoiceDate,
					work_j_acct_inv_ispaid = :isPaid,
					work_j_acct_inv_date_paid = :datePaid,
					WHERE work_j_acct_inv_id = :id";

				$this->set($query);
				$this->bindParam(':invoiceAmount', $this->getInvoiceAmount());
				$this->bindParam(':invoiceDate', $this->getInvoideDate());
				$this->bindParam(':isPaid', $this->getPaidStatus());
				$this->bindParam(':datePaid', $this->getPaidDate());
				$this->bindParam(':id', $this->getFetchId()).
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
				$query = "DELETE FROM work_j_acct_inv WHERE work_j_acct_inv_id = :id";
				$this->set($query);
				$this->bindParam(':id', $id);
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

		public function getAllInvoices($value = NULL){
			/*if(!empty($value) && !is_null($value)){
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
			}*/
		}
	}
?>