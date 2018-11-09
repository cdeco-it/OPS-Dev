<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.team.php');

ob_start();

//Do not process if nothing is posted
if(!empty($_POST) || $level > 1){

	$tid = $_POST['tid'];
	$jid = $_POST['jid'];

	//Instantiate the objects
	$t = new j_WorkTeam();

	//Delete the entry
	$result = $t->deleteEntry($tid);
	if($result['success']){
		//Get reload data
		$update = $t->getTeam($jid);
		
		//If we get valid data, process results
		if($update['success']){
			if($update['message'] === SUCCESS){

				$output = '
					<div class="table-responsive">
						<table class="table table-sm table-hover">
							<thead>
								<tr>
									<th width="35%">Name</th>
									<th width="35%">Role</th>
									<th width="10%">Lead</th>';
				if($level <= 1){
					$output .= '<th width="20%"></th>';
				}
				
				$output .= '	</tr>
							<thead>
							<tbody>';

				foreach($update['updateInfo'] as $row){
					$output .= '<tr>
									<td class="align-middle">'.$row['NAME'].'</td>
									<td class="align-middle">'.$row['ROLE'].'</td>';
					if($row['LEAD'] == 1){
						$output .= '<td class="align-middle"><i class="fas fa-check"></i></td>';

					}else{
						$output .= '<td></td>';
					}

					if($level <= 1){
						$output .= '
						<td width="10%" class="align-middle" align="right">
							<button id="int_team_del_button" class="deleteInternalTeam btn btn-danger btn-xs" name="int_team_del" value="'.$row['ID'].'" jid="'.$jid.'">
								<i class="fas fa-ban"></i>
							</button>
						</td>';
					}

					$output .= '</tr>';
				}

				$output .= '</tbody></table></div>';

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