<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.discussions.php');

ob_start();

//Do not process if nothing is posted
if(!empty($_POST) || $level > 1){

	//Set the post results
	$jid = $_POST['j_id'];
	$did = $_POST['d_id'];

	//Create a new class
	$d = new j_WorkDiscussions();

	//Delete the entry
	$result = $d->deleteEntry($did);
	if($result['success']){
		if($result['message'] === SUCCESS){
			//If we get success, let's process the new addition and add it to the ret data
			$x = $d->getDiscussions($jid);
			if($x['success']){
				if($x['message'] === SUCCESS){
					$output = '<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr>
							                  	<th width="5%">#</th>
							                  	<th width="5%">Date Entered</th>
							                  	<th width="5%">Last Updated</td>
							                  	<th width="70%">Discussion</th>';
					if($level > 1){
						$output .= '<th width="15%"></th>';
					}

					$output .= '</tr>
		              		</thead>
		              	<tbody>';

					$i = count($x['updateInfo']);
					foreach($x['updateInfo'] as $row){
						$output .= '<tr>
										<td>'.$i.'</td>
										<td>'.$row['work_j_discussions_created'].'</td>
										<td>'.$row['work_j_discussions_updated'].'</td>
										<td>'.$row['work_j_discussions_entry'].'</td>
										';
						if($level <= 1){
							$output .= '
							<td class="align-middle" align="right">
								<button type="button" class="editDiscussion btn btn-info btn-xs" value='.$row['work_j_discussions_id'].'>
									<i class="fas fa-edit"></i>
								</button> 

								<button type="button" class="deleteDiscussion btn btn-danger btn-xs" value='.$row['work_j_discussions_id'].' jid="'.$jid.'"><i class="fas fa-trash-alt"></i></i></button>
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
					unset($d);
					echo json_encode($result);

				}else{
					ob_end_clean();
					unset($d);
					echo json_encode($x);
				}
			}else{
				ob_end_clean();
				unset($d);
				echo json_encode($x);
			}

		}else{
			ob_end_clean();
			unset($d);
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