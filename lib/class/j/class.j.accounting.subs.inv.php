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
		private $invoiceNumber;
		private $invAmt;
		private $invDate;
		private $isPaid;
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
				$query = "INSERT INTO work_j_acct_subs_inv (
							work_j_acct_inv_subs_id,
							work_j_acct_subs_id,
							work_j_acct_subs_inv_number,
							work_j_acct_subs_inv_amount,
							work_j_acct_subs_inv_date,
							work_j_acct_subs_inv_ispaid,
							work_j_acct_subs_inv_info_created,
							work_j_acct_subs_inv_info_updated)
						VALUES (
							NULL,
							:parentId,
							:invoiceNumber,
							:invoiceAmount,
							:invoideDate,
							:isPaid,
							NOW(),
							NOW()
						)";

				$this->set($query);
				$this->bindParam(':parentId', $this->getParentId());
				$this->bindParam(':invoiceNumber', $this->getInvoiceNumber());
				$this->bindParam(':invoiceAmount', $this->getInvoiceAmount());
				$this->bindParam(':invoiceDate', $this->getInvoideDate());
				$this->bindParam(':isPaid', $this->getPaidStatus());
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
					work_j_acct_inv_ispaid = :isPaid
					WHERE work_j_acct_inv_id = :id";

				$this->set($query);
				$this->bindParam(':invoiceAmount', $this->getInvoiceAmount());
				$this->bindParam(':invoiceDate', $this->getInvoideDate());
				$this->bindParam(':isPaid', $this->getPaidStatus());
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
	}
?>