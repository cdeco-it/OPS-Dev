<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
?>

<!doctype html>

<html lang="en">

    <head>

        <title>OPS:::Employee Records</title>
<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/inc.header.php');
?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>

	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js"></script>

    </head>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.navigation.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');

	//Instantiate a new Db connector
	$db = new Db();

	//Define the query
	$query = "SELECT employee_id, employee_fname, employee_mname, employee_lname, employee_status, employee_home_phone, employee_mobile_phone 
			FROM employee ORDER BY employee_lname ASC";

	//Set the query in PDO
	$db->set($query);

	//Execute a single quuery
	$db->execute();

	//Get all results as a set array
	$result = $db->returnSet();

	//Get a count of results
	$count = $db->rowCount();

	//Instantiate a new Helper
	$helper = new Helper();
?>

<!-- BODY -->

<div class="container-fluid">

	<div class="alert alert-danger collapse" id="error">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>

    <div class="alert alert-success collapse" id="success">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>

	<div class="container-fluid row no-gutters pt-2 pb-2">
		<div class="col-8">
			<h4>Viewing Employee Records</h4>
		</div>

		<div class="col-4" align="right">
			<?php if($level <= 1){ ?>	
			<a href="#" name="add" id="add" data-toggle="modal" data-target="#addModal" class="btn btn-success">Add New Employee</a> 
			<?php } ?>
		</div>
	</div>

	<div id="outputData">
	    <table id="records" name="records" class="table table-hover table-bordered dt-responsive" cellspacing="0" cellpadding="0" width="100%">
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
	    	<tbody>
				<?php 
					$i = 1;
				 	foreach ($result as $row){
				 		
				 		echo '
				 		<tr>
				 			<td>'.$row['employee_lname'].'</td>
							<td>'.$row['employee_fname'].'</td>
							<td>'.$row['employee_mname'].'</td>
							<td>'.$helper->defineEmployeeStatus($row['employee_status']).'</td>
							<td>'.$row['employee_home_phone'].'</td>
							<td>'.$row['employee_mobile_phone'].'</td>
							<td align="center">
								<button type="button" id="viewUserButton'.$i.'" class="viewButton btn btn-primary btn-xs" value='.$row['employee_id'].'>View</button>';
							if($level <= 1){
								echo'
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
				?>
	    	</tbody>
	    </table>
	</div>

    <div id="addModal" class="modal fade">

    	<div class="modal-dialog">  

           <div class="modal-content">  

                <div class="modal-header">  
                     <h4 class="modal-title">Quick Add: New Employee</h4>
                     <a href="#" class="close" data-dismiss="modal">&times;</a>
                </div>  

                <div class="modal-body">  
                    <form method="post" id="quickadd" data-toggle="validator" role="form">

                 		<label>Prefix</label>  
                      	<select name="prefix" id="prefix" class="form-control">
                      		<?php echo $helper->populatePrefix(); ?>
                      	</select>
                      	<br />

                      	<label>First Name</label>  
                      	<input type="text" name="fname" id="fname" class="form-control" data-error="A first name is required". required />  
                      	<div class="help-block with-errors"></div>
                      	<br />

                      	<label>Middle Name</label>  
                      	<input type="text" name="mname" id="mname" class="form-control" />  
                      	<br />  

                      	<label>Last Name</label>  
                      	<input type="text" name="lname" id="lname" class="form-control" required /> 
                      	<br />

                      	<label>Suffix</label>  
                      	<select name="suffix" id="suffix" class="form-control">
                      		<?php echo $helper->populateSuffix(); ?>
                      	</select>
                      	<br />  

                      	<label>Date of Hire</label>
                      	<div class="input-group date">
                      		<div class="input-group-prepend">
					        	<div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
					        </div>
  							<input type="text" name="hiredate" id="hiredate" class="form-control" placeholder="mm-dd-yyyy" required>
						</div>  
                      	<br />  

                      	<label>Date of Birth</label>  
                      	<div class="input-group date">
                      		<div class="input-group-prepend">
					        	<div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
					        </div>
  							<input type="text" id="dob" name="dob" class="form-control" placeholder="mm-dd-yyyy" required>
						</div>   
                      	<br /> 

                      	<input type="hidden" name="employee_id" id="employee_id" />  
                      	<input type="submit" name="insert" id="insert" value="Add New Employee" class="btn btn-success" /> 

                     </form>  
                </div>  
        	</div>  
      	</div>  
    </div>

	<br />

</div>

<script type="text/javascript" src="inc.employee.js"></script>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 

	unset($db);
	unset($employee)
?>