<?php
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');

	$db = new Db();

	if(!empty($_GET['term'])){

		//Set a reference to POST
		$value = $_GET['term'];

		//Create the query
		$query = "SELECT addr_orgs.addr_orgs_id, addr_orgs.addr_orgs_name FROM addr_orgs WHERE addr_orgs.addr_orgs_name LIKE '%".$value."%' ORDER BY addr_orgs.addr_orgs_name ASC";

		//Set the query
		$db->set($query);

		//Execute a single quuery
		$db->execute();

		//Get all results as a set array
		$result = $db->returnSet();

		if(!empty($result)){
			$data = array();
			foreach($result as $row){
				$data[] = array(
							'value' => $row['addr_orgs_name'],
							'id' => $row['addr_orgs_id']
							);
			}
			echo json_encode($data);
		}
		unset($db);
	}
?>


