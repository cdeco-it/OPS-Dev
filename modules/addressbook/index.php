<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
?>

<!doctype html>

<html lang="en">

    <head>
    	
<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/inc.header.php');
?>
       
        <title>OPS:::Address Book</title>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js"></script>

    </head>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.navigation.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
	//Instantiate a new Db connector
	$db = new Db();
	//Define the query
	$query = "SELECT 
				addr_id, 
				addr_fname, 
				addr_lname, 
				addr_suffix,
				common_suffix_abbr,
				addr_org_id, 
				addr_orgs_name AS addr_org,
				addr_org_phone,
				addr_org_fax, 
				addr_address_1, 
				addr_address_2, 
				addr_city, 
				common_usstates_abbr AS addr_state, 
				addr_postcode, 
				common_countries_full AS 'addr_country', 
				addr_org_phone_ext, 
				addr_direct, 
				addr_mobile,
				addr_email 
			FROM addr 
			LEFT JOIN common_countries 
				ON common_countries_id = addr_country
			LEFT JOIN common_usstates Organization 
				ON common_usstates_id = addr_state
			LEFT JOIN addr_orgs
				ON addr_orgs_id = addr_org_id
			LEFT JOIN common_suffix
				ON addr_suffix = common_suffix_id
			ORDER BY addr_lname ASC";
	//Set the query in PDO
	$db->set($query);
	//Execute a single quuery
	$db->execute();
	//Get all results as a set array
	$result = $db->returnSet();
	//Get a count of results
	$count = $db->rowCount();
?>

<!-- BODY -->

<div class="container-fluid">
	<div class="container-fluid row no-gutters pt-2 pb-2 ">

		<div class="alert alert-danger collapse" id="error">
	    	<a href="#" class="close" data-dismiss="alert">&times;</a>
	    </div>

	    <div class="alert alert-success collapse" id="success">
	    	<a href="#" class="close" data-dismiss="alert">&times;</a>
	    </div>
		
		<div class="col-8">
			<h4>Viewing Address Book Entries</h4>
		</div>

		<div class="col-4" align="right">
			<?php if($level <= 1){ ?>
				<a href="add.php" name="add" id="add" class="btn btn-success">Add New Contact</a> 
			<?php } ?>
		</div>
	</div>



	<div id="output">
	    <!-- <table class="table table-responsive table-sm table-hover table-bordered dt-responsive" id="records" name="records"> -->
	    <table id="records" name="records" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
	    	<thead class="thead-default">
	    		<tr>
	    			<th width="20%">Last</th>
	    			<th width="20%">First</th>
	    			<th width="15%">Contact Info</th>
	    			<th width="15%">Phone</th>
	    			<th width="15%">Email</th>
	    			<th width="20%">Actions</th>
	    		</tr>
	    	</thead>
	    	<tbody>
				<?php 
					$i = 1;
				 	foreach ($result as $row){
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
				 		
				 		echo '
				 		<tr>
				 			<td>'.$row['addr_lname'].' '.$row['common_suffix_abbr'].'</td>
							<td>'.$row['addr_fname'].'</td>
							<td><strong>'.$row['addr_org'].'</strong>'.$address.'</td>
							<td>
								<ul>';
								if(!empty($row['addr_org_phone']) || !is_null($row['addr_org_phone'])){
									echo'<li><strong>Office: </strong>'.$row['addr_org_phone'].'</li>';
								}
								if(!empty($row['addr_org_phone_ext']) || !is_null($row['addr_org_phone_ext'])){
									echo'<li><strong>Ext: </strong>'.$row['addr_org_phone_ext'].'</li>';
								}
								if(!empty($row['addr_org_fax']) || !is_null($row['addr_org_fax'])){
									echo'<li><strong>Fax: </strong>'.$row['addr_org_fax'].'</li>';
								}
								if(!empty($row['addr_direct']) || !is_null($row['addr_direct'])){
									echo'<li><strong>Direct: </strong>'.$row['addr_direct'].'</li>';
								}
								if(!empty($row['addr_mobile']) || !is_null($row['addr_mobile'])){
									echo'<li><strong>Mobile: </strong>'.$row['addr_mobile'].'</li>';
								}
									
						echo '</ul>
							</td>
							<td><a href="mailto:'.$row['addr_email'].'"">'.$row['addr_email'].'</a></td>
							<td align="center">
								<button type="button" id="viewUserButton'.$i.'" class="viewButton btn btn-primary btn-xs" value='.$row['addr_id'].'>View</button>';
							if($level <= 2){
								echo'
								<button type="button" id="editButton'.$i.'" class="editButton btn btn-info btn-xs" value='.$row['addr_id'].'>Edit</button>
								<button type="button" id="deleteButton'.$i.'" class="deleteButton btn btn-danger btn-xs" value='.$row['addr_id'].'>Delete</button>';
							}
						echo'
							</td>
				 		</tr>
				 		';
				 		if($i <= $count){
				 			$i++;	
				 		}
				 	}
				?>
	    	</tbody>
	    </table>
	</div>
</div>

<script type="text/javascript" src="inc.address.js"></script>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 
	unset($db);
?>