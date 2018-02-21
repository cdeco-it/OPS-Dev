<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.employee.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');

ob_start();

//Do not process if nothing is posted
if(!empty($_POST) || $level <= 2){

	//Get the employee record and load it into object
	if(!empty($_POST['id'])){
		$getId = $_POST['id'];
		$employee = new Employee();
		$helper = new Helper();
		$employee->getEmployeeById($getId);
		
		//Toggle the employee status -- ignore other status values beyond 2
		if($employee->getStatus() == 1){
			$employee->setStatus(2);
		}elseif($employee->getStatus() == 2){
			$employee->setStatus(1);
		}
		
		//Process the changes
		$data = $employee->updateEmployee();

		//Run a query that returns the updated table for display elsewhere
		$query = "SELECT employee_id, employee_fname, employee_mname, employee_lname, employee_status, employee_home_phone, employee_mobile_phone FROM employee ORDER BY employee_lname ASC";
		$employee->set($query);
		$employee->execute();
		$result = $employee->returnSet();
		$count = $employee->rowCount();
		$output = '
			<table id="records" name="records" class="table table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
		    	<thead class="thead-default">
		    		<tr>
		    			<th width="15%">Last</th>
		    			<th width="15%">First</th>
		    			<th width="15%">Middle</th>
		    			<th width="5%">Status</th>
		    			<th width="10%">Home</th>
		    			<th width="10%">Mobile</th>
		    			<th width="15%">Actions</th>
		    		</tr>
		    	</thead>

		    	<tbody>';
		    		$i = 1;
				 	foreach($result as $row){
				 		$output .= '
					 		<tr>
					 			<td>'.$row['employee_lname'].'</td>
								<td>'.$row['employee_fname'].'</td>
								<td>'.$row['employee_mname'].'</td>
								<td>'.$helper->defineEmployeeStatus($row['employee_status']).'</td>
								<td>'.$row['employee_home_phone'].'</td>
								<td>'.$row['employee_mobile_phone'].'</td>
								<td align="center">
									<button type="button" id="viewUserButton'.$i.'" class="viewButton btn btn-primary btn-xs" value='.$row['employee_id'].'>View</button>';
							if($level <= 2){
								$output .= '
									<button type="button" id="editButton'.$i.'" class="editButton btn btn-info btn-xs" value='.$row['employee_id'].'>Edit</button>
									<button type="button" id="toggleUserButton'.$i.'" class="toggleButton btn btn-danger btn-xs" value='.$row['employee_id'].'>A/D User</button>';
							}
						echo'
							</td>
				 		</tr>
				 		';
			 		if($i <= $count){
			 			$i++;	
			 		}
			 	}
		$output .= '
	    	</tbody>
	    </table>';

		//Update the JSON 
		$data['updateInfo'] = $output; 

		
		//Set, encode, and return JSON data to main
		ob_end_clean();
		unset($employee);
		unset($helper);
		echo json_encode($data);
		
	//If the ID value isn't set...it is a fail.
	}else{
		$data = array("success" => FALSE, "message" => E_NO_ID);
		ob_end_clean();
		echo json_encode($data);
	}

}else{
	if($level > 2){
		$data = array("success" => FALSE, "message" => E_ACL_FAIL);
		ob_end_clean();
		unset($employee);
		echo json_encode($data);
	}else{
		$data = array("success" => FALSE, "message" => CRITICAL_ERROR.' - The required data has not been passed to the system.');
		ob_end_clean();
		unset($employee);
		echo json_encode($data);
	}	
}
?>