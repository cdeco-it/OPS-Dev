<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.actions.php');

ob_start();

//Do not process if nothing is posted
if(!empty($_POST) || $level > 1){

	//Set the post results
	$assignedTo = $_POST['j_action_assignedto'];
	$dateAssigned = $_POST['j_action_date_assigned'];
	$dateDue = $_POST['j_action_date_due'];
	$task = $_POST['j_action_task'];
	$comments = $_POST['j_action_comments'];
	$jid = $_POST['j_id'];
	$pid = $_POST['p_id'];

	
	//Create a new class
	$a = new j_WorkActions();

	//Set the values
	$a->setWorkJID($jid);
	$a->setWorkID($pid);
	$a->setAssignedTo($assignedTo);
	$a->setAssignedDate($dateAssigned);
	$a->setDueDate($dateDue);
	$a->setTask($task);
	$a->setComments($comments);

	//Add the entry
	$result = $a->addEntry();
	if($result['success']){
		if($result['message'] === SUCCESS){
			//If we get success, let's process the new addition and add it to the ret data
			$x = $a->getActions($jid);
			if($x['success']){
				if($x['message'] === SUCCESS){
					$output = '<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr>
							                  	<th width="15%">To</th>
							                   	<th width="5%">Assigned</th>
							                   	<th width="5%">Due</th>
							                   	<th width="30%">Task</th>
							                   	<th width="30%">Comments</th>
							                   	<th width="5%">Done</th>';
					if($level > 1){
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
		$aata = array("success" => FALSE, "message" => E_ACL_FAIL);
		ob_end_clean();
		echo json_encode($aata);
	}else{
		$aata = array("success" => FALSE, "message" => CRITICAL_ERROR.' - The required data has not been passed to the system.');
		ob_end_clean();
		echo json_encode($aata);
	}	
}

?>