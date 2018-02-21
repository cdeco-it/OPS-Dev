<?php 

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.work.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.j.work.php');

ob_start();

//DONT PROCEED IF EMPTY OR IF NOT HAVING PROPER PERMISSIONS
if(!empty($_POST) || $level <= 2){
	
	//Instiantiate new Employee and Helper objects
	$work = new Work();
	$j = new JWork();

	//Create the parent...then the child
	$work->setWorkNumber($_POST['work_number']);
	$work->setYear($_POST['work_year']);
	$work->setTitle($_POST['work_title']);
	$work->setWorkClient($_POST['work_client']);
	$work->setWorkClientRep($_POST['work_poc']);
	$work->setDB($_POST['work_db']);

	//Set to null by default.  Will check flags and process later.
	$work->setPID();
	$work->setJID();
	$work->setCID();
	$work->setBID();
	$work->setSID();
	
	//Process the entry...
	$data = $work->addEntry();

	//If successful insert proceed...
	if($data['success']){

		//Get inserted Work ID
		$workId = $work->findWorkID($work->getYear(), $work->getWorkNumber());
		$work->setId($workId);
		$data['updateInfo'] = $work->findWorkID($work->getYear(), $work->getWorkNumber());
		$test = 'WORKID = '.$workId.' WORK NUM = '.$work->getWorkNumber().'YEAR = '.$work->getYear();
		error_log($test);

		//If J phase is to be created...
		if($_POST['work_j_decision'] == 1){
			
			$nextJID = $j->generateNextJID($workId);
			$j->setWorkID($workId);
			$j->setWorkJNumber($work->getWorkNumber());
			$j->setStatus();
			$j->setPercentComplete();
			$j->setSOW();

			//Process the J Phase entry...
			$dataB = $j->addEntry();
			
			//If not successful...return messages
			if(!$dataB['success']){
				//On fail...
				$data['success'] = $dataB['success'];
				$data['message'] = $dataB['message'];
				ob_end_clean();
			    unset($work, $j);
			    echo json_encode($data);

			//If successful...proceed 
			}else{
			    //Get the newly added master index record id
	 			$work->setJID($j->findJID($workId));
	 			$work->setStatus(2);
	 			
	 			$testx = "GET = ".$j->findJID($workId).'  SET = '.$work->getJID();

	 			error_log($testx);

	 			$dataC = $work->updateEntry();

	 			if(!$dataC['success']){
	 				//On fail...
	 				$data['success'] = $dataB['success'];
					$data['message'] = $dataB['message'];
	 				ob_end_clean();
			    	unset($work, $j);
			   		echo json_encode($data);
	 			}
			}
		}

		//Set the workID
		$data['updateInfo'] = $workId;
		ob_end_clean();
		unset($work, $j);
		echo json_encode($data);

	//Not successful insert.
	}else{
		ob_end_clean();
		echo json_encode($data);
	}
}else{
	if($level > 2){
		$data = array("success" => FALSE, "message" => E_ACL_FAIL);
		ob_end_clean();
		echo json_encode($data);
	}else{
		$data = array("success" => FALSE, "message" => CRITICAL_ERROR.' - The required data has not been passed to the system.');
		ob_end_clean();
		echo json_encode($data);
	}	
}
?>