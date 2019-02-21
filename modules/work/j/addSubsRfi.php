<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.subsrfi.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');

ob_start();

//Do not process if nothing is posted
if(!empty($_POST) || $level > 1){

	//Set the post results
	$jid = $_POST['j_id'];
	$pid = $_POST['p_id'];
	$type = $_POST['j_add_subrfi_type'];
	$int = $_POST['j_add_subrfi_int_track'];
	$ext = $_POST['j_add_subrfi_ext_track'];
	$subject = $_POST['j_add_subrfi_subject'];
	$rcvdBy = $_POST['j_add_subrfi_rcvd_by'];
	$dateRcvd = $_POST['j_add_subrfi_rcvd_date'];
	$qtyRcvd = $_POST['j_add_subrfi_qty_rcvd'];
	$dateDue = $_POST['j_add_subrfi_due_date'];
	$comments = $_POST['j_add_subrfi_comments'];

	$intReviewers = $_POST['j_add_subrfi_int_reviewer'];
	$extReviewers = $_POST['j_add_subrfi_ext_reviewer'];

	//Create a new class
	$sr = new j_WorkSubsRfis();
	$helper = new Helper();

	//Set the values
	$sr->setLogType($type);
	$sr->setInternalTrackingNUmber($int);
	$sr->setExternalTrackingNumber($ext);
	$sr->setSubject($subject);
	$sr->setReceivedBy($rcvdBy);
	$sr->setDateReceived($dateRcvd);
	$sr->setQuantityReceived($qtyRcvd);
	$sr->setDueDate($dateDue);
	$sr->setNotes($comments);	

	//Add the entry
	$result = $sr->addEntry();
	if($result['success']){
		$logId = $this->lastInsertId();
		//Before we produce the return results, we need to handle the int and ext reivewers.  Deal with internal first
		$intCount = count($intReviewers);
		
		$q = 0;
		for($i = 0; $i < $intCount; $i++){
			$x = array('emp' => $intReviewers[$i], 'con' => NULL);
			$iResult = $sr->addReviewer($logId, $x);
			if($iResult['message'] != SUCCESS){
				//Kill process if we fail on insert!
				die("");
			}
			$q++;
		}

		$r = 0;
		$extCount = count($extReviewers);
		for($i = 0; $i < $extCount; $i++){
			$x = array('con' => $extReviewers[$i], 'emp' => NULL);
			$eResult = $sr->addReviewer($logId, $x);
			if($eResult['message'] != SUCCESS){
				//Kill process if we fail on insert!
				die("");
			}
			$r++;
		}

		/******* START HERE ))))))= *****/
	
		//END INT/EXT REVIEWER INSERTION BEGIN RETURN
		if($result['message'] === SUCCESS){
			
			//If we get success, let's process the new addition and add it to the ret data
			$x = $a->getActions($jid);
			if($x['success']){
				if($x['message'] === SUCCESS){
					$output = '<div class="table-responsive">
									<table class="table table-sm table-hover">
										<thead>
											<tr>
							                  	<th width="15%">To</th>
							                   	<th width="5%">Assigned</th>
							                   	<th width="5%">Due</th>
							                   	<th width="30%">Task</th>
							                   	<th width="30%">Comments</th>
							                   	<th width="5%">Done</th>';
					if($level <= 1){
						$output .= '<th width="10%"></th>';
					}

					$output .= '</tr>
		              		</thead>
		              	<tbody>';

					// $i = count($x['updateInfo']);
					foreach($x['updateInfo'] as $row){
						$output .= '<tr>
										<td>'.$row['EMP_NAME'].'</td>
										<td>'.$row['DATE_ASSIGNED'].'</td>
										<td title="'.$row['REMAIN'].' days remain">'.$row['DATE_DUE'].'</td>
										<td>'.$row['TASK'].'</td>
										<td>'.$row['COMMENTS'].'</td>
										<td>';
											if($row['COMPLETE'] == 1){
												$output .= '<i class="fas fa-check"></i>';
											}
						$output .=		'</td>';

						if($level <= 1){
							$output .= '
							<td class="align-middle" align="right">
								<button type="button" class="editAction btn btn-info btn-xs" value='.$row['ACT_ID'].'>
									<i class="fas fa-edit"></i>
								</button> 

								<button type="button" class="deleteAction btn btn-danger btn-xs" value='.$row['ACT_ID'].' jid="'.$jid.'"><i class="fas fa-trash-alt"></i></i></button>
							</td>';
						}

						$output .= '</tr>';
						// $i--;
					}

					$output .= '</tbody>
							</table>
						</div>';

					$result['updateInfo'] = $output;
					ob_end_clean();
					unset($a);
					echo json_encode($result);

				}else{
					ob_end_clean();
					unset($a);
					echo json_encode($x);
				}
			}else{
				ob_end_clean();
				unset($a);
				echo json_encode($x);
			}

		}else{
			ob_end_clean();
			unset($a);
			echo json_encode($result);
			die();
		}
	}else{
		ob_end_clean();
		unset($a);
		echo json_encode($result);
		die();
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