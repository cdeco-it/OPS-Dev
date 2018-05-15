 <?php

	require_once('class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');


	/**
	 * Class handles j Milestones
	 * Writte: 5/15/2018
	 * By: S. Mized 
	 */
	class j_WorkMilestones extends Db{

		private $work_j_milestone_id;
		private $work_j_id;
		private $work_id;
		private $milestone_id;
		private $milestone_value;
		private $dateCreated;
		private $dateModified;
		private $fetchId;

		/**
		 * Parent construction from class.db.php
		 */
		function __construct(){
			parent::__construct();
		}
/***** GETTER METHODS *****/
		public function getFetchId(){

		}

		public function getWorkJMilestoneId(){

		}

		public function getWorkJID(){

		}

		public function getWorkID(){

		}

		public function getMilestone(){

		}

		public function getMilestoneValue(){

		}

		public function getDateCreated(){

		}

		public function getDateModified(){

		}


/***** SETTER METHODS *****/
		public function setFetchId($value = NULL){

		}

		public function setWorkJMilestoneId($value = NULL){

		}

		public function setWorkJID($value = NULL){

		}

		public function setWorkID($value = NULL){

		}

		public function setMilestone($value = NULL){

		}

		public function setMilestoneValue($value = NULL){

		}

		public function setDateCreated($value = NULL){

		}

		public function setDateModified($value = NULL){

		}


/***** TRANSACTIONAL METHODS *****/

	public function getEntry($id){
	
	}

	public function addEntry(){

	}

	public function updateEntry($id){

	}

	public function deleteEntry($id){
		
	}
}
?>