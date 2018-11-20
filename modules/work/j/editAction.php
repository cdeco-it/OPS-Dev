<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.actions.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');

ob_start();

//Do not process if nothing is posted
if(!empty($_POST) || $level > 1){

	//Set the post results

	$jid = $_POST['j_id'];
	$pid = $_POST['p_id'];
	$aid = $_POST['a_id'];
	$assignedTo = $_POST['j_edit_action_assignedto'];

	$dateAssigned = $_POST['j_edit_action_date_assigned'];
	// error_log("DA PRE=".$dateAssigned);

	$dateDue = $_POST['j_edit_action_date_due'];
	// error_log("DD PRE=".$dateDue);

	$dateComplete = $_POST['j_edit_action_date_complete'];
	// error_log("DC PRE=".$dateComplete);

	$task = $_POST['j_edit_action_task'];
	$comments = $_POST['j_edit_action_comments'];

	//Create a new class
	$a = new j_WorkActions();
	$helper = new Helper();

	//Load existing record
	$a->getEntry($aid);

	//Update changes
	$a->setAssignedTo($assignedTo);
	$a->setDateAssigned($helper->date_toSQL($dateAssigned));
	// error_log("DA POST=".$a->getDateAssigned());
	$a->setDueDate($helper->date_toSQL($dateDue));
	// error_log("DD POST=".$a->getDueDate());
	$a->setTask($task);
	$a->setComments($comments);

	if(!is_null($dateComplete) && !empty($dateComplete)){
		$a->setDateComplete($helper->date_toSQL($dateComplete));
		// error_log("DC POST=".$a->getDateComplete());
		$a->setIsComplete(1);
	}else{
		$a->setIsComplete(NULL);
		$a->setDateComplete(NULL);
	}

	//Update the entry
	$result = $a->updateEntry();

	if($result['success']){
		if($result['message'] === SUCCESS){
			//If we get success, let's process the new addition and add it to the ret data
			error_log("SUCCESS...now update tables");
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

					$i = count($x['updateInfo']);
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
						$output .= '</td>';
						if($level <= 1){
							$output .= '
							<td class="align-middle" align="right">
								<button type="button" class="editAction btn btn-info btn-xs" value='.$row['ACT_ID'].'>
									<i class="fas fa-edit"></i>
								</button> 

								<button type="button" class="deleteAction btn btn-danger btn-xs" value='.$row['ACT_ID'].' jid="'.$jid.'">
								<i class="fas fa-trash-alt"></i>
								</button>
							</td>';
						}

						$output .= '</tr>';
						$i--;
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
		unset($d);
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