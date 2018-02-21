<?php

require_once('../../class/class.db.php');

	$db = new Db();
	$query = "SELECT employee_id, employee_fname, employee_mname, employee_lname, employee_status, employee_home_phone, employee_mobile_phone FROM employee ORDER BY employee_id";
	$db->set($query);
	$db->execute();
	$result = $db->returnSet();
	$count = $db->rowCount();
	$output = '
	<table class="table table-responsive table-sm table-hover table-bordered" id="records" name="records">
	    	<thead class="thead-default">
	    		<tr>
	    			<th>First</th>
	    			<th>Middle</th>
	    			<th>Last</th>
	    			<th>Status</th>
	    			<th>Home</th>
	    			<th>Mobile</th>
	    			<th>Actions</th>
	    		</tr>
	    	</thead>
	    	<tfoot>
	    		<tr>
	    			<th>First</th>
	    			<th>Middle</th>
	    			<th>Last</th>
	    			<th>Status</th>
	    			<th>Home</th>
	    			<th>Mobile</th>
	    			<th>Actions</th>
	    		</tr>
	    	</tfoot>
	    	<tbody>';
			 	foreach ($result as $row){
			 		$output .= '
			 		<tr>
						<td>'.$row['employee_fname'].'</td>
						<td>'.$row['employee_mname'].'</td>
						<td>'.$row['employee_lname'].'</td>
						<td>'.$row['employee_status'].'</td>
						<td>'.$row['employee_home_phone'].'</td>
						<td>'.$row['employee_mobile_phone'].'</td>
						<td> <input type="button" name="edit" value="Edit" id="'.$row["employee_id"].'"" class="btn btn-info btn-xs edit_data" /> </td>
			 		</tr>';
			 	}
		$output .= '
	    	</tbody>
	    </table>
	    <pre>Retrieved '.$count.' records.</pre>';

	    unset($db);
	    unset($helper);
	    echo $output;
	    
?>