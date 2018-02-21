<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.employee.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');

ob_start();

//DONT PROCEED IF EMPTY OR IF NOT HAVING PROPER PERMISSIONS
if(!empty($_POST) || $level <= 2){
	
	//Instiantiate new Employee and Helper objects
	$employee = new Employee();
	$helper = new Helper();

	//Set all required parameters of an Employee Object
	$employee->setName($_POST['fname'], $_POST['mname'], $_POST['lname']);
	$employee->setPrefix($_POST['prefix']);
	$employee->setSuffix($_POST['suffix']);
	$employee->setHireDate($helper->date_toSQL($_POST['hiredate']));
	$employee->setDob($helper->date_toSQL($_POST['dob']));
	$employee->setAddress();
	$employee->setHomePhone();
	$employee->setMobilePhone();
	$employee->setACL();
	$employee->setStatus(1);
	$employee->setSubscription(0);
	
	//Setup initial username and password information
	$pwdinfo = array("first" => $_POST['fname'], "last" => $_POST['lname'], "dob" => $_POST['dob']);
	$username = $helper->generate_Username($pwdinfo);
	$sec = $helper->generate_Password($pwdinfo);
	$employee->setPassword($sec['crypt']);
	$employee->setUsername($username);

	//Update the database with the currently set information.
	//This also get the JSON data back.
	$data = $employee->addEmployee();

	//Run a query that returns the updated table for display elsewhere
	$query = "SELECT employee_id, employee_fname, employee_mname, employee_lname, employee_status, employee_home_phone, employee_mobile_phone FROM employee ORDER BY employee_lname ASC";
	$employee->set($query);
	$employee->execute();
	$result = $employee->returnSet();
	$count = $employee->rowCount();
	$output = '
	<table class="table table-responsive table-sm table-hover table-bordered" id="records" name="records">
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
				 		</tr>';
			 		if($i <= $count){
			 			$i++;	
			 		}
			 	}
		$output .= '
	    	</tbody>
	    </table>
	    <pre>Retrieved '.$count.' records.</pre>';

	//Update the JSON 
	$data['updateInfo'] = $output; 

	ob_end_clean();

	//Unset the classes and terminate.
	unset($employee);
	unset($helper);

	//Set, encode, and return JSON data to main
	echo json_encode($data);
	
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