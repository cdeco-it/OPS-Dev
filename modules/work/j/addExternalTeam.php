<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.consultants.php');

ob_start();

//Do not process if nothing is posted
if(!empty($_POST) || $level > 1){

	//Set the post results
	$addr_id = $_POST['j_ext_member_name_id'];
	$role_id = $_POST['j_ext_role'];
	$jid = $_POST['j_id'];
	$pid = $_POST['p_id'];

	
	//Create a new class
	$t = new j_WorkConsultants();

	//Set the values
	$t->setWorkJID($jid);
	$t->setWorkID($pid);
	$t->setAddrId($addr_id);
	$t->setConsultantRole($role_id);

	//Add the entry
	$result = $t->addEntry();
	if($result['success']){
		if($result['message'] === SUCCESS){
			//If we get success, let's process the new addition and add it to the ret data
			$x = $t->getConsultants($jid);
			if($x['success']){
				if($x['message'] === SUCCESS){
					$output = '<div class="table-responsive">
									<table class="table table-sm table-hover">
										<thead>
											<tr>
												<th width="30%">Firm</th>
												<th width="30%">Name</th>
												<th width="20%">Role</th>
												<th width="20%"></th>
											</tr>
										</thead>
										<tbody>';
					$i = 1;
					foreach($x['updateInfo'] as $row){
						$output .= '<tr>
										<td>'.$row['ORG'].'</td>
										<td>'.$row['NAME'].'</td>
										<td>'.$row['ROLE'].'</td>
										<td  class="align-middle" align="right">
											<button type="button" id="ext_team_view" class="btn btn-info btn-xs" value='.$row['ADDR_ID'].'>
												<i class="far fa-address-card"></i>
											</button> ';
						if($level <= 1){
							$output .= '<button type="button" id="ext_team_del_button'.$i.'" class="deleteExternalTeam btn btn-danger btn-xs" value='.$row['ID'].' jid="'.$jid.'"><i class="fas fa-ban"></i></button>';
						}

						$output .= '</td>
								</tr>';
						$i++;
					}

					$output .= '</tbody>
							</table>
						</div>';

					$result['updateInfo'] = $output;
					ob_end_clean();
					echo json_encode($result);

				}else{
					ob_end_clean();
					echo json_encode($x);
				}
			}else{
				ob_end_clean();
				echo json_encode($x);
			}


			
			
			unset($t);
			$data = array('success' => TRUE, 'message' => SUCCESS, 'updateInfo' => $output);
			ob_end_clean();
			echo json_encode($data);
		}else{
			ob_end_clean();
			echo json_encode($result);
			die();
		}
	}else{
		ob_end_clean();
		echo json_encode($result);
		die();
	}


	// //Instantiate a fresh class
	// $t = new j_WorkTeam();

	// //Load in dynamic data to return...
	// $d = $t->getTeam($jid);
	// $output = '
	// 	<div class="table-responsive">
	// 		<table class="table table-sm table-hover">
	// 			<thead>
	// 				<tr>
	// 					<th width="35%">Name</th>
	// 					<th width="35%">Role</th>
	// 					<th width="10%">Lead</th>';
	// if($level <= 1){
	// 	$output .= '<th width="20%"></th>';
	// }
	
	// $output .= '	</tr>
	// 			<thead>
	// 			<tbody>';

	// foreach($d['updateInfo'] as $row){
	// 	$output .= '<tr>
	// 					<td class="align-middle">'.$row['NAME'].'</td>
	// 					<td class="align-middle">'.$row['ROLE'].'</td>';
	// 	if($row['LEAD'] == 1){
	// 		$output .= '<td class="align-middle"><i class="fas fa-check"></i></td>';

	// 	}else{
	// 		$output .= '<td></td>';
	// 	}

	// 	if($level <= 1){
	// 		$output .= '
	// 		<td width="10%" class="align-middle" align="right">
	// 			<button id="int_team_del_button" class="deleteInternalTeam btn btn-danger btn-xs" name="int_team_del" value="'.$row['ID'].'" jid="'.$jid.'">
	// 				<i class="fas fa-ban"></i>
	// 			</button>
	// 		</td>';
	// 	}

	// 	$output .= '</tr>';
	// }
	// $output .= '</tbody></table></div>';

	//At the end of the loop, if all goes well, return SUCCESS and the count.
	

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