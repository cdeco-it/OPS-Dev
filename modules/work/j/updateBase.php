<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.work.phases.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');

ob_start();

//Do not process if nothing is posted
if(!empty($_POST) || $level > 1){

	//Get the record and load it into object
	if(!empty($_POST['j_id'])){

		$id = $_POST['j_id'];
		$pid = $_POST['p_id'];
		
		//Get all imported vars...4 total...
		$status = $_POST['j_status'];
		$assocNum = $_POST['j_assocNum'];
		$percentComp = $_POST['j_percentComp'];
		$sow = $_POST['j_sow'];

		//Instantiate the record and start the review.
		$phaseRecord = new WorkPhases();
		$phaseRecord->loadEntry($id, 'j');

		if($status != $phaseRecord->getStatus()){
			$phaseRecord->setStatus($status);
		}

		if($assocNum != $phaseRecord->getAssocNum()){
			$phaseRecord->setAssocNum($assocNum);
		}

		if($percentComp != $phaseRecord->getPercentComplete()){
			$phaseRecord->setPercentComplete($percentComp);
		}

		if(strcasecmp($sow, $phaseRecord->getSow()) !=0 ){
			$phaseRecord->setSOW($sow);
		}

		//Process the changes
		$data = $phaseRecord->updateEntry('j');

	//If the ID value isn't set...it is a fail.
	}else{
		$data = array("success" => FALSE, "message" => E_NO_ID);
	}
	unset($phaseRecord);
	unset($helper);
	ob_end_clean();
	echo json_encode($data);

}else{
	if($level > 1){
		$data = array("success" => FALSE, "message" => E_ACL_FAIL);
		unset($phaseRecord);
		unset($helper);
		ob_end_clean();
		echo json_encode($data);

	}else{
		$data = array("success" => FALSE, "message" => CRITICAL_ERROR.' - No phase id number is present.');
		unset($phaseRecord);
		unset($helper);
		ob_end_clean();
		echo json_encode($data);
	}
}
?>