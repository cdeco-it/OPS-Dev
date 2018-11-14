<?php
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');

	$db = new Db();

	if(!empty($_GET['term'])){

		//Set a reference to POST
		$value = $_GET['term'];

		//Create the query
		$query = "SELECT
					addr.addr_id,
					addr.addr_org_id,
					addr.addr_fname,
					addr.addr_lname,
					CONCAT_WS(' ', addr.addr_fname, addr.addr_lname) AS 'addr_fullname',
					addr_orgs.addr_orgs_name
					FROM addr
					LEFT JOIN addr_orgs	
						ON addr.addr_org_id = addr_orgs_id
					WHERE addr.addr_fname
						LIKE '%".$value."%'
					OR addr.addr_lname
						LIKE '%".$value."%'
					ORDER BY addr.addr_fname ASC";

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
							'value' => $row['addr_fullname'],
							'id' => $row['addr_id'],
							'org_id' => $row['addr_org_id'],
							'org_name' => $row['addr_orgs_name']
							);
			}
			echo json_encode($data);
		}
		unset($db);
	}
?>


