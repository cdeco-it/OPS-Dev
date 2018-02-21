<?php 

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.work.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.work.phases.php');

ob_start();

//DONT PROCEED IF EMPTY OR IF NOT HAVING PROPER PERMISSIONS
if(!empty($_POST) || $level <= 2){
	
	//Instiantiate new Employee and Helper objects
	$work = new Work();
	
	//Set the flags for the PHASES
	$flagP = $_POST['work_p_decision'];
	$flagJ = $_POST['work_j_decision'];
	$flagC = $_POST['work_c_decision'];
	$flagB = $_POST['work_b_decision'];
	$flagS = $_POST['work_s_decision'];

	//Set the basics up...set all Phases to null by default 
	$work->setWorkNumber($_POST['work_number']);
	$work->setYear($_POST['work_year']);
	$work->setTitle($_POST['work_title']);
	$work->setClient($_POST['work_client']);
	$work->setClientRep($_POST['work_poc']);
	$work->setDb($_POST['work_db']);
	$work->setStatus($_POST['status']);
	$work->setJID();
	$work->setPID();
	$work->setBID();
	$work->setSID();
	$work->setCID();

	$w = $work->addEntry();

	//If the insert succeeds
	if($w['success']){
		
		//This should be the last insert ID passed back
		$WID = $w['info']; 

		//Update work with new entry
		$work->setId($WID);

		//At this point, we need to check each phase flag and activate them as needed.
		if($flagP){
			$phase = new WorkPhases();
			//Set parent ID
			$phase->setParentId($WID);
			$phase->setStatus();
			$phase->setPercentComplete();
			$phase->setSOW();
			$phase->setPhaseId($phase->generateNextPhaseId($WID, 'p'));
			$p = $phase->addEntry('p');
			$phase->setFcv();
			if($p['success']){
				$PID = $p['info'];
				$work->setPID($PID);
				unset($phase);
			}else{
				ob_end_clean();
				echo json_encode($p);
				die();
			}
		}

		if($flagJ){
			$phase = new WorkPhases();
			//Set parent ID
			$phase->setParentId($WID);
			$phase->setStatus();
			$phase->setPercentComplete();
			$phase->setSOW();
			$phase->setPhaseId($phase->generateNextPhaseId($WID, 'j'));
			$j = $phase->addEntry('j');
			if($j['success']){
				$JID = $j['info'];
				$work->setJID($JID);
				unset($phase);
			}else{
				ob_end_clean();
				echo json_encode($j);
				die();
			}
		}

		if($flagC){
			$phase = new WorkPhases();
			//Set parent ID
			$phase->setParentId($WID);
			$phase->setStatus();
			$phase->setPercentComplete();
			$phase->setSOW();
			$phase->setPhaseId($phase->generateNextPhaseId($WID, 'c'));
			$c = $phase->addEntry('c');
			if($c['success']){
				$CID = $c['info'];
				$work->setCID($CID);
				unset($phase);
			}else{
				ob_end_clean();
				echo json_encode($c);
				die();
			}
		}

		if($flagB){
			$phase = new WorkPhases();
			//Set parent ID
			$phase->setParentId($WID);
			$phase->setStatus();
			$phase->setPercentComplete();
			$phase->setSOW();
			$phase->setPhaseId($phase->generateNextPhaseId($WID, 'b'));
			$phase->setFcv();
			$b = $phase->addEntry('b');
			if($b['success']){
				$BID = $b['info'];
				$work->setBID($BID);
				unset($phase);
			}else{
				ob_end_clean();
				echo json_encode($b);
				die();
			}
		}

		if($flagS){
			$phase = new WorkPhases();
			//Set parent ID
			$phase->setParentId($WID);
			$phase->setStatus();
			$phase->setPercentComplete();
			$phase->setSOW();
			$phase->setPhaseId($phase->generateNextPhaseId($WID, 's'));
			$s = $phase->addEntry('s');
			if($s['success']){
				$SID = $s['info'];
				$work->setSID($SID);
				unset($phase);
			}else{
				ob_end_clean();
				echo json_encode($s);
				die();
			}
		}

		//Let's process the changes...
		$final = $work->updateEntry();
		unset($work);
		ob_end_clean();
		echo json_encode($final);

	}else{
		//If no successful, return error information 
		ob_end_clean();
		echo json_encode($w);
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