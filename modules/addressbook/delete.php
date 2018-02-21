<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.address.php');

ob_start();

//Do not process if nothing is posted
if(!empty($_POST) || $level <= 2){

	if(!empty($_POST['id'])){
		$addr = new Address();
		$deleteId = $_POST['id'];
		$result = $addr->deleteEntry($deleteId);
		
		//Only proceed if the deletion was successful
		if($result['success']){

			//Set the query to update the table...
			$query = "SELECT 
				addr_id, 
				addr_fname, 
				addr_lname, 
				addr_nname, 
				addr_org, 
				addr_org_phone, 
				addr_address_1, 
				addr_address_2, 
				addr_city, 
				common_usstates_abbr AS addr_state, 
				addr_postcode, 
				common_countries_full AS 'addr_country', 
				addr_org_phone_ext, 
				addr_direct, 
				addr_email 
			FROM addr 
			LEFT JOIN common_countries 
				ON common_countries_id = addr_country
			LEFT JOIN common_usstates Organization 
				ON common_usstates_id = addr_state
			ORDER BY addr_lname ASC";

			$addr->set($query);
			
			//Execute a single quuery
			$addr->execute();

			//Get all results as a set array
			$results = $addr->returnSet();

			//Get a count of results
			$count = $addr->rowCount();

			$output = '<table class="table table-responsive table-sm table-hover table-bordered" id="records" name="records">
	    					<thead class="thead-default">
					    		<tr>
					    			<th width="15%">Last</th>
					    			<th width="15%">First</th>
					    			<th width="10%">Nickname</th>
					    			<th width="20%">Organization</th>
					    			<th width="15%">Phone</th>
					    			<th width="10%">Email</th>
					    			<th width="20%">Actions</th>
					    		</tr>
					    	</thead>
	    					<tbody>';
					$i = 1;
				 	foreach ($results as $row){
				 		if(!empty($row['addr_address_2'])){
				 			$address = '<p>'.$row['addr_address_1'].'<br />'.
				 							$row['addr_address_2'].'<br />'.
				 							$row['addr_city'].', '.$row['addr_state'].' '.$row['addr_postcode'].' <br />'.
				 							$row['addr_country'].'</p>';
				 		}else{
				 			$address = '<p>'.$row['addr_address_1'].'<br />'.
				 							$row['addr_city'].', '.$row['addr_state'].' '.$row['addr_postcode'].' <br />'.
				 							$row['addr_country'].'</p>';
				 		}
				 		
						$output .= '<tr>
							 			<td>'.$row['addr_lname'].'</td>
										<td>'.$row['addr_fname'].'</td>
										<td>'.$row['addr_nname'].'</td>
										<td><strong>'.$row['addr_org'].'</strong>'.$address.'</td>
										<td>
											<ul>
												<li><strong>Office: </strong>'.$row['addr_org_phone'].'</li>
												<li><strong>Ext: </strong>'.$row['addr_org_phone_ext'].'</li>
												<li><strong>Direct: </strong>'.$row['addr_direct'].'</li>
											</ul>
										</td>
										<td><a href="mailto:'.$row['addr_email'].'"">'.$row['addr_email'].'</a></td>
										<td align="center">
											<button type="button" id="viewUserButton'.$i.'" class="viewButton btn btn-primary btn-xs" value='.$row['addr_id'].'>View</button>';
						if($level <= 2){
							$output .= '
								<button type="button" id="editButton'.$i.'" class="editButton btn btn-info btn-xs" value='.$row['addr_id'].'>Edit</button>
								<button type="button" id="deleteButton'.$i.'" class="deleteButton btn btn-danger btn-xs" value='.$row['addr_id'].'>Delete</button>';
						}

						$output .= '</td>
				 				</tr>';

				 		if($i <= $count){
				 			$i++;	
				 		}
				 	}
			$output .= '</tbody>
		    </table>';
		    
		    //Update the return
		    $result['updateInfo'] = $output; 
			ob_end_clean();
			unset($addr);
			echo json_encode($result);

		//If deletion was not successful, end and return errors.
		}else{
			ob_end_clean();
			unset($addr);
			echo json_enconde($result);
		}
	
	//Handle the event where the ID isn't passed.
	}else{
		$data = array("success" => FALSE, "message" => E_NO_ID);
		ob_end_clean();
		unset($addr);
		echo json_encode($data);
	}

//Other error handling.
}else{

	//Insufficient ACL
	if($level > 2){
		$data = array("success" => FALSE, "message" => E_ACL_FAIL);
		ob_end_clean();
		unset($addr);
		echo json_encode($data);

	//Critical errors
	}else{
		$data = array("success" => FALSE, "message" => CRITICAL_ERROR.' - The required data has not been passed to the system.');
		ob_end_clean();
		unset($addr);
		echo json_encode($data);
	}	
}
?>