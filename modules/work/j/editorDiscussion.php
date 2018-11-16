<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.discussions.php');

ob_start();

//Do not process if nothing is posted
if(!empty($_POST) || $level > 1){

	//Set the post results
	$id = $_POST['load_id'];
	
	//Create a new class
	$d = new j_WorkDiscussions();

	//Load the discussion to class
	$result = $d->getEntry($id);
	if($result['success']){
		if($result['message'] === SUCCESS){
            $hid = '<input type="hidden" name="d_id" id="d_id" value="'.$d->getFetchId().'" />';
			$result['updateInfo'] = $d->getDiscussion();
			$result['did'] = $hid;
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