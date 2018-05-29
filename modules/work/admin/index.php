<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
?>

<!doctype html>

<html lang="en">

    <head>
    	
<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/inc.header.php');
?>
       
        <title>OPS:::Work:::Administration</title>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js"></script>

    </head>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.navigation.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');

	$helper = new Helper();
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
			<h4>Project Administration Options</h4>
		</div>

		<div class="col-4" align="right">
			hhhh
		</div>
	</div>
<hr />
	<div class="container-fluid">
		<div class="card-group">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Engineering Milestones</h5>
					<p class="card-text">Unique to J phase projects only.</p>
					<select name="j-milestones" size="10" class="form-control">
						<?php
							$helper->populateEngineeringMilestones();
						?>
					</select>
					<br />
					<center>
						<a href="#" name="J-add" id="J-add" data-toggle="modal" data-target="#addJ" class="btn btn-success">Add Milestone</a>
						<a href="#" name="editJ" id="EditJ" data-toggle="modal" data-target="#editJ" class="btn btn-primary" class="btn btn-primary">Edit Selected</a>
					</center>
			  	</div>
			</div>

			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Support Milestones</h5>
					<p class="card-text">Unique to S phase projects only.</p>
					<select name="s-milestones" size="10" class="form-control">
					</select>
					<br />
					<center>
						<a href="#" name="addS" id="addS" data-toggle="modal" data-target="#addS" class="btn btn-success">Add Milestone</a>
						<a href="#" name="editS" id="EditS" data-toggle="modal" data-target="#editS" class="btn btn-primary" class="btn btn-primary">Edit Selected</a>
					</center>
			  	</div>
			</div>

			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Bidding Milestones</h5>
					<p class="card-text">Unique to B phase projects only.</p>
					<select name="b-milestones" size="10" class="form-control">
					</select>
					<br />
					<center>
						<a href="#" name="addB" id="addB" data-toggle="modal" data-target="#addB" class="btn btn-success">Add Milestone</a>
						<a href="#" name="editB" id="EditB" data-toggle="modal" data-target="#editB" class="btn btn-primary" class="btn btn-primary">Edit Selected</a>
					</center>
			  	</div>
			</div>

			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Construction Milestones</h5>
					<p class="card-text">Unique to C phase projects only.</p>
					<select name="c-milestones" size="10" class="form-control">
						<?php
							$helper->populateConstructionMilestones();
						?>
					</select>
					<br />
					<center>
						<a href="#" name="addC" id="addC" data-toggle="modal" data-target="#addC" class="btn btn-success">Add Milestone</a>
						<a href="#" name="editC" id="EditC" data-toggle="modal" data-target="#editC" class="btn btn-primary" class="btn btn-primary">Edit Selected</a>
					</center>
			  	</div>
			</div>

			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Proposal Milestones</h5>
					<p class="card-text">Unique to P phase projects only.</p>
					<select name="j-milestones" size="10" class="form-control">
					</select>
					<br />
					<center>
						<a href="#" name="addP" id="addP" data-toggle="modal" data-target="#addP" class="btn btn-success">Add Milestone</a>
						<a href="#" name="editP" id="EditP" data-toggle="modal" data-target="#editP" class="btn btn-primary" class="btn btn-primary">Edit Selected</a>
					</center>
			  	</div>
			</div>
		</div>
	</div>

<hr />

	<div class="container-fluid">
		<div class="card-group">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Project Status</h5>
					<p class="card-text">Common and available to all projects.</p>
					<select name="work-status" size="10" class="form-control">
						<?php
							$helper->populateWorkStatus();
						?>
					</select>
					<br />
					<center>
						<a href="#" name="ws-add" id="ws-add" data-toggle="modal" data-target="#addJ" class="btn btn-success">Add Status</a>
						<a href="#" name="editWS" id="EditWS" data-toggle="modal" data-target="#editWS" class="btn btn-primary" class="btn btn-primary">Edit Selected</a>
					</center>
			  	</div>
			</div>

			<div class="card">
				<div class="card-body">
					<h5 class="card-title">RFI & Submittals</h5>
					<p class="card-text">Common to all projects.</p>
					<select name="s-milestones" size="10" class="form-control">
					</select>
					<br />
					<center>
						<a href="#" class="btn btn-primary">Add Milestone</a>
						<a href="#" class="btn btn-warning">Edit Selected</a>
					</center>
			  	</div>
			</div>

			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Roles</h5>
					<p class="card-text">Common to all projects</p>
					<select name="b-milestones" size="10" class="form-control">
					</select>
					<br />
					<center>
						<a href="#" class="btn btn-primary">Add Milestone</a>
						<a href="#" class="btn btn-warning">Edit Selected</a>
					</center>
			  	</div>
			</div>
		</div>
	</div>

	<!-- MODALS -->

	<div id="addJ" class="modal fade">
		<div class="modal-dialog">  
			<div class="modal-content">  
				<div class="modal-header">  
					<h4 class="modal-title">Quick Add: Engineering Milestone</h4>
					<a href="#" class="close" data-dismiss="modal">&times;</a>
				</div>  

				<div class="modal-body">  
					<form method="post" id="quickaddJ" data-toggle="validator" role="form">

						<label>Milestone</label>  
						<input type="text" name="milestone" id="milestone" class="form-control" data-error="A milestone is required". required />  
						<div class="help-block with-errors"></div>
						<br />
						<label>Grouping</label>  
						<input type="text" name="grouping" id="grouping" class="form-control" data-error="A milestone is required". required />  
						<div class="help-block with-errors"></div>
						<br />

						<input type="submit" name="insertJ" id="insertJ" value="Add Milestone" class="btn btn-success" /> 
					</form>  
				</div>  
			</div>  
		</div>  
	</div>




	<!-- END MODALS -->
</div>



<!-- <script type="text/javascript" src="inc.address.js"></script> -->

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 
?>