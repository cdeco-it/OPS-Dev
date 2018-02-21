<?php require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php'); ?>

<!doctype html>

<html lang="en">

    <head>

    	<title>OPS:::Work Records</title>

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/inc.header.php'); ?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js"></script>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

    <style>
		ul.ui-autocomplete.ui-menu {
 			z-index: 1200;
		}
		table.dataTable tbody td {
			vertical-align: middle;
		}
	</style>

    </head>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.navigation.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.work.php');

	//Instantiate a new Db connector and Work Class
	$db = new Db();
	$work = new Work();
	$helper = new Helper();

	if(isset($_GET['year'])){
		$year = $_GET['year'];
	}else{
		$year = date('Y');
	}

	//Define the query
	$query = "SELECT
				work.work_id,
				work.work_year,
				work.work_number,
				work.work_client,
				work.work_title,
				work.work_j_id,
				work.work_p_id,
				work.work_s_id,
				work.work_c_id,
				work.work_b_id,
				work.work_status,
				work.work_db,
				work_status.work_status_desc,
				addr.addr_org_id,
				addr_orgs.addr_orgs_name
			FROM work
			LEFT JOIN work_status
				ON work.work_status = work_status.work_status_id
			LEFT JOIN addr	
				ON work.work_client = addr.addr_id
			LEFT JOIN addr_orgs
				ON addr_orgs.addr_orgs_id = work.work_client
			WHERE work.work_year = :year
			ORDER BY work_number ASC";

	//Set the query in PDO
	$db->set($query);

	//Bind the year
	$db->bindParam(':year', $year);

	//Execute a single quuery
	$db->execute();

	//Get all results as a set array
	$result = $db->returnSet();

	//Get a count of results
	$count = $db->rowCount();
?>

<!-- BODY -->

<div class="container-fluid">
	<div class="container-fluid row no-gutters pt-2 pb-2">
		<div class="col-8">
			<h4>Viewing All Projects for Year:
				<select name="yearselect" id="yearselect" onchange="loadYear()" style=" border: none;">
					<?php
						$helper->populateWorkYears($year);
					?>
				</select>
			</h4>
		</div>

		<div class="col-4" align="right">
			<?php if($level <= 1){ ?>
				<a href="add.php" name="add" id="add" class="btn btn-success">Add New Project</a> 
			<?php } ?>

		</div>
	</div>

	<div id="output">
	    <table class="table table-hover table-bordered dt-responsive" id="work" name="work" cellspacing="0" width="100%">
	    	<thead class="thead-default">
	    		<tr>
	    			<th width="5%">Number</th>
	    			<th width="15%">Client</th>
					<th width="44%">Title</th>
				    <th width="10%" style="text-align:center">Status</th>
				    <th width="3%" class="no-sort" style="text-align:center" >DB</th>
				    <th width="3%" class="no-sort" style="text-align:center" >P</th>
	    			<th width="3%" class="no-sort" style="text-align:center" >J</th>
	    			<th width="3%" class="no-sort" style="text-align:center" >B</th>
	    			<th width="3%" class="no-sort" style="text-align:center" >C</th>
	    			<th width="3%" class="no-sort" style="text-align:center" >S</th>
				    <th width="8%" class="no-sort" style="text-align:center" >Actions</th>
	    		</tr>
	    	</thead>
	    	<tbody>
				<?php 
					$i = 1;
					if($count > 0){

						foreach ($result as $row){
				 		$formalID = $work->generateFormalNumber($row['work_year'], $row['work_number']);
				 		echo '
				 		<tr>
				 			<td>'.$formalID.'</td>
							<td>'.$row['addr_orgs_name'].'</td>
							<td>'.$row['work_title'].'</td>';
						if(!is_null($row['work_status_desc']) || !empty($row['work_status_desc'])){
							echo '<td align="center">'.$row['work_status_desc'].'</td>';
						}else{
							echo '<td align="center">Undefined</td>';
						}

						if($row['work_db']){
							echo '<td align="center"><i class="fas fa-check"></i></td>';
						}else{
							echo '<td align="center"></td>';
						}

						if(!is_null($row['work_p_id'])){
							echo '<td align="center"><a href="view.php?mode=p&id='.$row['work_p_id'].'"><i class="fas fa-check"></i></a></td>';
						}else{
							echo '<td align="center"></td>';
						}

						if(!is_null($row['work_j_id'])){
							echo '<td align="center"><a href="view.php?mode=j&id='.$row['work_j_id'].'"><i class="fas fa-check"></i></a></td>';
						}else{
							echo '<td align="center"></td>';
						}

						if(!is_null($row['work_b_id'])){
							echo '<td align="center"><a href="view.php?mode=b&id='.$row['work_b_id'].'"><i class="fas fa-check"></i></a></td>';
						}else{
							echo '<td align="center"></td>';
						}

						if(!is_null($row['work_c_id'])){
							echo '<td align="center"><a href="view.php?mode=c&id='.$row['work_c_id'].'"><i class="fas fa-check"></i></a></td>';
						}else{
							echo '<td align="center"></td>';
						}

						if(!is_null($row['work_s_id'])){
							echo '<td align="center"><a href="view.php?mode=s&id='.$row['work_s_id'].'"><i class="fas fa-check"></i></a></td>';
						}else{
							echo '<td align="center"></td>';
						}

						echo '	
							<td align="center">
								<!-- <button type="button" id="viewButton'.$i.'" class="viewButton btn btn-primary btn-xs" value='.$row['work_id'].'>View</button> -->';
							if($level <= 2){
								echo'
								<button type="button" id="editButton'.$i.'" class="editButton btn btn-info btn-xs" value='.$row['work_id'].'>Edit</button>';
							}
						echo'
							</td>
					 		</tr>
					 		';
					 		if($i <= $count){
					 			$i++;	
					 		}
					 	}
					}
				?>
	    	</tbody>
	    </table>
	</div>

	<br />
    <div class="alert alert-danger collapse" id="error">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>

    <div class="alert alert-success collapse" id="success">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>

</div>

<script type="text/javascript" src="inc.work.js"></script>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 
	unset($work);
	unset($helper);
	unset($db);
?>