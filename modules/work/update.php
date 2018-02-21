<?php 

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.work.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.work.phases.php');
	
ob_start();

//DONT PROCEED IF EMPTY OR IF NOT HAVING PROPER PERMISSIONS
if(!empty($_POST) || $level <= 2){

	if(isset($_POST['work_id'])){
		$id = $_POST['work_id'];
		$year = $_POST['work_year'];
		$number = $_POST['work_number'];
		$title = $_POST['work_title'];
		$client = $_POST['work_client'];
		$rep = $_POST['work_poc'];
		$db = $_POST['work_db'];
		$status = $_POST['status'];
		$flagP = $_POST['work_p_decision'];
		$flagJ = $_POST['work_j_decision'];
		$flagB = $_POST['work_b_decision'];
		$flagC = $_POST['work_c_decision'];
		$flagS = $_POST['work_s_decision'];

		$work = new Work();

		$result = $work->loadEntry($id);

		if($result['success']){

			if(strcmp($title, $work->getTitle()) !== 0 ){
				$work->setTitle($title);
			}

			if($client != $work->getClient()){
				$work->setClient($client);
			}

			if($rep != $work->getClientRep()){
				$work->setClientRep($rep);
			}

			if($db != $work->getDb()){
				$work->setDb($db);
			}

			if($status != $work->getStatus()){
				$work->setStatus($status);
			}

			$WID = $work->getId();

			//Handle the phases...
			if($flagP){
				//If the setting is null, then there is no predefined phase established...proceed.
				if(is_null($work->getPID())){
					$phase = new WorkPhases();
					//Set parent ID
					$phase->setParentId($work->getId());
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
			}

			if($flagJ){
				//If the setting is null, then there is no predefined phase established...proceed.
				if(is_null($work->getJID())){
					$phase = new WorkPhases();
					//Set parent ID
					$phase->setParentId($work->getId());
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
			}

			if($flagB){
				//If the setting is null, then there is no predefined phase established...proceed.
				if(is_null($work->getBID())){
					$phase = new WorkPhases();
					//Set parent ID
					$phase->setParentId($work->getId());
					$phase->setStatus();
					$phase->setPercentComplete();
					$phase->setSOW();
					$phase->setPhaseId($phase->generateNextPhaseId($WID, 'b'));
					$b = $phase->addEntry('b');
					$phase->setFcv();
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
			}

			if($flagC){
				//If the setting is null, then there is no predefined phase established...proceed.
				if(is_null($work->getCID())){
					$phase = new WorkPhases();
					//Set parent ID
					$phase->setParentId($work->getId());
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
			}

			if($flagS){
				//If the setting is null, then there is no predefined phase established...proceed.
				if(is_null($work->getSID())){
					$phase = new WorkPhases();
					//Set parent ID
					$phase->setParentId($work->getId());
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
			}

			$final = $work->updateEntry();
			unset($work);
			ob_end_clean();
			echo json_encode($final);

		}else{
			ob_end_clean();
			echo json_encode($result);
		}

	}else{
		$data = array("success" => FALSE, "message" => E_NO_ID);
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