<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.consultants.php');

ob_start();

//Do not process if nothing is posted
if(!empty($_POST) || $level > 1){

	//Get the values from post
	$extTeamId = $_POST['etid'];
	$jid = $_POST['jid'];

	//Instantiate the new class
	$wc = new j_WorkConsultants();

	//Delete the entry passed
	$result = $wc->deleteEntry($extTeamId);

	//If we succeed...
	if($result['success']){

		//Let's get the refreshed data after delete
		$update = $wc->getConsultants($jid);

		//If we succeed...
		if($update['success']){

			//Check for success by zero results
			if($update['message'] === SUCCESS){
				
				//Begin our basic table html output
				$output = '<div class="table-responsive">
							<table class="table table-sm table-hover">
								<thead>
									<tr>
										<th width="35%">Name</th>
										<th width="35%">Role</th>
										<th width="10%">Lead</th>
										<th width="20%"></th>
									</tr>
								</thead>
								<tbody>';

				//Let's go thru each result and build our output
				foreach($update['updateInfo'] as $row){
					$output .= '<tr>
									<td>'.$row['ORG'].'</td>
			              			<td>'.$row['NAME'].'</td>
			              			<td>'.$row['ROLE'].'</td>
			              			<td class="align-middle" align="right">
			              				<button type="button" class="viewExternalTeam btn btn-info btn-xs" value='.$row['ADDR_ID'].'><i class="far fa-address-card"></i></button>';
					//If this is an admin level user, add delete button
					if($level <= 1){	
						$output .= '
							<button class="deleteExternalTeam btn btn-danger btn-xs" name="ext_team_del" value="'.$row['ID'].'" jid="'.$jid.'">
								<i class="fas fa-ban"></i>
							</button>';
					}
					$output .= '</td></tr>';

				}

				$output .= '</tbody>
						</table>
					</div>';

			//Success, but zero rows...
			}else{
				$output = '<div class="col">'.$update['message'].'</div>';
			}

			ob_end_clean();
			unset($wc);
			$update['updateInfo'] = $output;
			echo json_encode($update);

		//If we fail...
		}else{
			ob_end_clean();
			unset($wc);
			echo json_encode($update);
		}

	//If we fail...
	}else{
		ob_end_clean();
		unset($wc);
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