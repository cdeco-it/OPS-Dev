<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.team.php');

ob_start();

//Do not process if nothing is posted
if(!empty($_POST) || $level > 1){

	//Set the post results
	$input = $_POST['j_int_team'];
	$jid = $_POST['j_id'];
	$pid = $_POST['p_id'];

	//Count the amount of data brought over
	$count = count($input);

	//This will count the number of successful record insertions.
	$success = 0;

	//Let's deal with the looping and processing. This will loop n amount of times. If an insert fails, break out of the loop and return the error.
	for($i = 1; $i <= $count; $i++){
		
		//Create a new class
		$t = new j_WorkTeam();

		//Set the values
		$t->setWorkJID($jid);
		$t->setWorkID($pid);
		$t->setEmployeeId($input[$i]['name']);
		$t->setLeader($input[$i]['lead']);
		$t->setCommonRole($input[$i]['role']);

		//Add the entry
		$result = $t->addEntry();
		if($result['success']){
			if($result['message'] === SUCCESS){
				//If we get succes, increment the counter and loop again
				$success++;
				unset($t);
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
	}

	//Instantiate a fresh class
	$t = new j_WorkTeam();

	//Load in dynamic data to return...
	$d = $t->getTeam($jid);
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

	foreach($d['updateInfo'] as $row){
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

	//At the end of the loop, if all goes well, return SUCCESS and the count.
	
	$data = array('success' => TRUE, 'message' => SUCCESS, 'updateInfo' => $output);
	ob_end_clean();
	echo json_encode($data);
	unset($t);

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