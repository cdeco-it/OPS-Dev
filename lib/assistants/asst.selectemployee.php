<?php
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');

	$db = new Db();

	//Create the query
	$query = "SELECT CONCAT(employee.employee_fname,' ', employee.employee_lname) AS 'name', employee_id FROM employee WHERE employee.employee_status = 1 ORDER BY employee.employee_lname ASC";

	//Set the query
	$db->set($query);

	//Execute a single quuery
	$db->execute();

	//Get all results as a set array
	$result = $db->returnSet();

	if(!empty($result)){
		$data = array();
		foreach($result as $row){
			$data[] = array('name' => $row['name'], 'id' => $row['employee_id']);
		}
		unset($db);
		echo json_encode($data);
	}
	unset($db);
?>