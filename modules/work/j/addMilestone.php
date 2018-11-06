<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.milestones.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');

ob_start();

//Do not process if nothing is posted
if(!empty($_POST) || $level > 1){

	//Instantiate the objects
	$helper = new Helper();
	$m = new j_WorkMilestones();

	//Set all parameters
	$m->setWorkID($_POST['p_id']);
	$m->setWorkJID($_POST['j_id']);
	$m->setMilestone($_POST['j_milestone']);
	$m->setMilestoneValue($helper->date_toSQL($_POST['j_milestone_date']));

	//Add the entry
	$result = $m->addEntry();

	//Passback the result
	ob_end_clean();
	unset($m);
	unset($helper);
	echo json_encode($result);

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