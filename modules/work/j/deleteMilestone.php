<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.milestones.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');

ob_start();

//Do not process if nothing is posted
if(!empty($_POST) || $level > 1){

	//Instantiate the objects
	$m = new j_WorkMilestones();
	$helper = new Helper();

	echo $_POST['mid'];
	error_log('MID ='.$_POST['mid']);
	error_log('JID ='.$_POST['jid']);

	//Delete the entry
	$result = $m->deleteEntry($_POST['mid']);
	if($result['success']){
		//Get reload data
		$update = $m->getMilestones($_POST['jid']);
		
		//If we get valid data, process results
		if($update['success']){
			if($update['message'] === SUCCESS){
				$output = '<table class="table table-sm table-hover">';
				foreach($update['updateInfo'] as $row){
					$output .= '<tr>
					        		<td width="60%" class="align-middle">'.$row['DESCRIPTION'].'</td>
									<td width="30%"  class="align-middle"  title="'.$row['REMAINING'].' days remain">'.$helper->date_toStandard($row['VALUE']).'</td>';
					if($level <= 1){
						$output .= '<td width="10%" class="align-middle"">
						<button class="deleteMilestone btn btn-danger btn-xs" name="mid" value="'.$row['UID'].'" jid="'.$_POST['jid'].'">
							<i class="fas fa-ban"></i>
						</button>
						</td>';
					}
					$output .= '</tr>';
				}
				$output .= '</table>';
			}else{
				$output = '<div class="col">'.$update['message'].'</div>';
			}

		}else{
			$output = '<div class="col">'.$update['message'].'</div>';
		}
	}else{
		$output = '<div class="col">'.$result['message'].'</div>';
	}
	
	$retData = array("success" => TRUE, "message" => SUCCESS, 'updateInfo' => $output);

	//Passback the result
	ob_end_clean();
	unset($m);
	unset($helper);
	echo json_encode($retData);

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