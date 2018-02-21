<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.work.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.work.phases.php');
ob_start();

//DONT PROCEED IF EMPTY OR IF NOT HAVING PROPER PERMISSIONS
if(!empty($_POST) || $level <= 2){
	


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