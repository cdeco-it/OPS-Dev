<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.work.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.j.work.php');

ob_start();

$work = new Work();

//Do not process if nothing is posted
if(!empty($_POST) || $level > 1){

	//Get the employee record and load it into object
	if(!empty($_POST['work_id'])){

		$editId = $_POST['work_id'];
		$year = $_POST['work_year'];
		$workId = $_POST['work_number'];
		$title = $_POST['work_title'];
		$client = $_POST['work_client'];
		$poc = $_POST['work_poc'];
		$idDB = $_POST['work_db'];
		$setJ = $_POST['work_j_decision'];
		$setP = $_POST['work_p_decision'];
		$setC = $_POST['work_c_decision'];
		$setB = $_POST['work_b_decision'];
		$setS = $_POST['work_s_decision'];

		//Load record that needs to be edited.
		$work->getEntry($editId);

		if(strcasecmp($title, $work->getTitle()) != 0){
			$work->setTitle($title);
		}

		if($client != $work->getClient()){
			$work->setWorkClient($client);
		}

		if($poc != $work->getClientRep()){
			$work->setWorkClientRep($poc);
		}

		if($isDB != $work->getDB()){
			$work->setDB($isDB);
		}

		//Let's deal with PHASES
		if($setJ != 0){
			if(is_null($work->getJID())){
				$j = new JWork();

				//Get the next JID and save
				$JID = $j->generateNewJID($editId);
				$work->setJID($JID);

				//Build the J Phase
				$j->setWorkId($editId);
				$j->setWorkJNumber($JID);
				$j->setPercentComplete();
				$j->setStatus();
				$jResult = $j->addPhase();

				//If, for some reason the J Phase doesn't process
				//report the error back by returning the result
				if(!$jResult['success']){
					ob_end_clean();
					echo json_encode($jResult);
					die();
				}
			}
		}

		if($setP != 0){
			if(is_null($work->getPID())){


			}
		}

		if($setC != 0){
			if(is_null($work->getCID())){
				//
				//
			}
		}

		if($setB != 0){
			if(is_null($work->getBID())){
				//
				//
			}
		}

		if($setS != 0){
			if(is_null($work->getSID())){
				//
			}
		}

		//Process the changes
		$data = $work->updateEntry();


	//If the ID value isn't set...it is a fail.
	}else{
		$data = array("success" => FALSE, "message" => E_NO_ID);
	}

	unset($work);
	unset($helper);
	ob_end_clean();
	echo json_encode($data);

}else{
	if($level > 1){
		$data = array("success" => FALSE, "message" => E_ACL_FAIL);
		unset($work);
		unset($helper);
		ob_end_clean();
		echo json_encode($data);

	}else{
		$data = array("success" => FALSE, "message" => CRITICAL_ERROR.' - No work record data is present.');
		unset($work);
		unset($helper);
		ob_end_clean();
		echo json_encode($data);
	}
}
?>