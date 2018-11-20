<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.actions.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');


ob_start();

//Do not process if nothing is posted
if(!empty($_POST) || $level > 1){

	//Set the post results
	$id = $_POST['load_id'];
	
	//Create a new class
	$a = new j_WorkActions();
	$helper = new Helper();

	//Load the discussion to class
	$result = $a->getEntry($id);
	if($result['success']){
		if($result['message'] === SUCCESS){
			
			$due = $a->getDueDate();

			if($due != "" || !is_null($due)){
				$due = $helper->date_toStandard($a->getDueDate());
			}

			$assigned = $a->getDateAssigned();
			if($assigned != "" || !is_null($assigned)){
				$assigned = $helper->date_toStandard($a->getDateAssigned());
			}

			$complete = $a->getDateComplete();
			if($complete != "" || !is_null($complete)){
				$complete = $helper->date_toStandard($a->getDateComplete());
			}

			$data = array(
				"id" => $a->getFetchId(),
				"jid" => $a->getWorkJID(),
				"assignedTo" => $a->getAssignedTo(),
				"dueDate" => $due,
				"dateComplete" => $complete,
				"dateAssigned" => $assigned,
				"task" => $a->getTask(),
				"comments" => $a->getComments()
			);
            $aid = '<input type="hidden" name="a_id" id="a_id" value="'.$a->getFetchId().'" />';

			$result['updateInfo'] = $data;
			$result['aid'] = $aid;
			ob_end_clean();
			echo json_encode($result);
		}else{
			ob_end_clean();
			echo json_encode($result);
		}
	}else{
		ob_end_clean();
		echo json_encode($result);
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