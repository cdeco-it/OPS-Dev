<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
?>

<!doctype html>
<html lang="en">

    <head>

        <title>OPS:::Employee Records:::Edit Employee</title>

<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/inc.header.php');
?>                

			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
        	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css">

    </head>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.navigation.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.employee.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');

	//Get the load employee id that needs to be loaded
	$edit_id = $_GET['id'];

	//Instantiate a new Db connector
	$employee = new Employee();
	$employee->getEmployeeById($edit_id);
	$name = $employee->getName();
	$address = $employee->getAddress();

	//Instantiate a new Helper
	$helper = new Helper();
?>

<!-- BODY -->

<div class="container-fluid">

	<div class="modal hide" id="waitDialog" data-backdrop="static" data-keyboard="false">
	    <div class="modal-body">
	        <div id="ajax_loader">	             
	            <div class="spinner">
				  <div class="cube1"></div>
				  <div class="cube2"></div>
				</div>
	        </div>
	    </div>
	</div>

	<div class="alert alert-danger collapse" id="error">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>

    <div class="alert alert-success collapse" id="success">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>

	<div class="row container-fluid pt-2 pb-2">
		<div class="col-8">
			<h4>Edit Employee Records: <?php echo $name['first'].' '.$name['last']; ?></h4>
		</div>
		<div class="col-4" align="right">
			Last Edited: <?php echo $employee->getDateModified(); ?>
		</div>
	</div>
	
	<div class="container-fluid" id="update_form">
		<form method="post" id="edit" data-toggle="validator" role="form">
			<div class="row container-fluid">
				<div class="col-md-6">
					<div class="form-group row">
						<label for="fname" class="col-2 col-form-label">Prefix:</label>
						<div class="col-10">
					    	<select name="prefix" class="form-control">
					    		<?php $helper->populatePrefix($name['prefix']); ?>
					    	</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="fname" class="col-2 col-form-label">First:</label>
						<div class="col-10">
					    	<input class="form-control" value="<?php echo $name['first'] ?>" id="fname" name="fname" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="mname" class="col-2 col-form-label">Middle:</label>
						<div class="col-10">
					    	<input class="form-control" value="<?php echo $name['middle'] ?>" id="mname" name="mname" >
						</div>
					</div>
					<div class="form-group row">
						<label for="lname" class="col-2 col-form-label">Last:</label>
						<div class="col-10">
					    	<input class="form-control" value="<?php echo $name['last'] ?>" id="lname" name="lname" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="suffix" class="col-2 col-form-label">Suffix:</label>
						<div class="col-10">
					    	<select name="suffix" class="form-control">
					    		<?php $helper->populateSuffix($name['suffix']); ?>
					    	</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="hiredate" class="col-2 col-form-label">Hire Date:</label>
						<div class="col-10 input-group date">
							<div class="input-group-prepend">
					        	<div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
					        </div>
					    	<input class="form-control" value="<?php echo $helper->date_toStandard($employee->getHireDate()); ?>" id="hiredate" name="hiredate" placeholder="mm-dd-yyyy" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="dob" class="col-2 col-form-label">Birthday:</label>
						<div class="col-10 input-group date">
							<div class="input-group-prepend">
					        	<div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
					        </div>
					    	<input class="form-control" value="<?php echo $helper->date_toStandard($employee->getDob()); ?>" id="dob" name="dob" placeholder="mm-dd-yyyy" required>
						</div>
					</div>
					<!-- @TODO
					
					1.) Reinitialize the database to include status and acl.
					2.) Fix ACL selector

					-->
					<div class="form-group row">
						<label for="status" class="col-2 col-form-label">Status:</label>
						<div class="col-10">
							<select name="status" id="status" class="form-control">
								<?php echo $helper->populateEmployeeStatus($employee->getStatus()); ?>
							</select>
					    	<!-- <input class="form-control" value="<?php echo $employee->getStatus(); ?>" id="status" name="status" > -->
						</div>
					</div>
					<div class="form-group row">
						<label for="status" class="col-2 col-form-label">ACL:</label>
						<div class="col-10">
					    	<input class="form-control" value="<?php echo $employee->getACL(); ?>" id="acl" name="acl" >
						</div>
					</div>
					<div class="form-group row">
						<label for="subscription" class="col-2 col-form-label">Subscription:</label>
						<div class="col-10">
							<select name="subscription" id="subscription" class="form-control">
								<?php echo $helper->populateEmployeeSubscription($employee->getSubscription()); ?>
							</select>
					    	<!-- <input class="form-control" value="<?php echo $employee->getSubscription(); ?>" id="subscription" name="subscription" > -->
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group row">
						<label for="addr1" class="col-2 col-form-label">Address 1:</label>
						<div class="col-10">
					    	<input class="form-control" value="<?php echo $address['addr1'] ?>" id="addr1" name="addr1" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="addr2" class="col-2 col-form-label">Address 2:</label>
						<div class="col-10">
					    	<input class="form-control" value="<?php echo $address['addr2'] ?>" id="addr2" name="addr2" >
						</div>
					</div>
					<div class="form-group row">
						<label for="city" class="col-2 col-form-label">City:</label>
						<div class="col-10">
					    	<input class="form-control" value="<?php echo $address['city'] ?>" id="city" name="city" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="state" class="col-2 col-form-label">State:</label>
						<div class="col-10">
							<select name="state" class="form-control">
					    		<?php $helper->populateStates($address['state']); ?>
					    	</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="postcode" class="col-2 col-form-label">Postcode:</label>
						<div class="col-10">
					    	<input class="form-control" value="<?php echo $address['postcode'] ?>" id="postcode" name="postcode"  required>
						</div>
					</div>
					<div class="form-group row">
						<label for="country" class="col-2 col-form-label">Country:</label>
						<div class="col-10">
							<select name="country" class="form-control">
					    		<?php $helper->populateCountry($address['country']); ?>
					    	</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="homephone" class="col-2 col-form-label">Home Phone:</label>
						<div class="col-10">
					    	<input class="form-control" value="<?php echo $employee->getHomePhone(); ?>" id="homephone" name="homephone"  placeholder="xxx-xxx-xxxx">
						</div>
					</div>
					<div class="form-group row">
						<label for="mobilephone" class="col-2 col-form-label">Mobile Phone:</label>
						<div class="col-10">
					    	<input class="form-control" value="<?php echo $employee->getMobilePhone(); ?>" id="mobilephone" name="mobilephone" placeholder="xxx-xxx-xxxx" required>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<fieldset class="form-group">
					<legend>Password &amp; Username Information</legend>
					<p>Leave password fields blank if you do not wish to change the existing password.</p>
					<div class="form-group row">
						<label for="username" class="col-2 col-form-label">Username:</label>
						<div class="col-10">
					    	<input class="form-control" value="<?php echo $employee->getusername(); ?>" id="username" name="username"  READONLY>
						</div>
					</div>
					<div class="form-group row">
						<label for="password" class="col-2 col-form-label">Password:</label>
						<div class="col-10">
					    	<input class="form-control" value="" id="password" type="password" name="password" >
						</div>
					</div>
					<div class="form-group row">
						<label for="passwordverify" class="col-2 col-form-label">Password Again:</label>
						<div class="col-10">
					    	<input class="form-control" value="" id="passwordverify" type="password" name="passwordverify" >
						</div>
					</div>
				</fieldset>
			</div>
			<br />
			<input type="hidden" name="id" name="id" value="<?php echo $employee->getId(); ?>">
			<button type="submit" class="btn btn-success" value="submit">Process Changes</button>
			<a href="index.php" class="btn btn-warning">Go Back</a>
		</form>
	</div>
	<br />
</div>

<script>  

	$(function() {
		$( "#hiredate" ).datepicker({
			format: "mm-dd-yyyy",
		 	clearBtn: true
		});
		$( "#dob" ).datepicker({
			format: "mm-dd-yyyy",
			clearBtn: true
		});
	});

	$('#edit').on("submit", function(e){
		e.preventDefault();
		$('#waitDialog').modal('show');
		$.ajax({
			url: "update.php",
			method: "POST",
			data: $('#edit').serialize(),
			dataType: 'json'
		})
		.done(function(data){
			if(!data.success){
				$('#waitDialog').modal('hide');
				$('#error').html(data.message);
				$("#error").show();
			}else{ 
				$('#waitDialog').modal('hide'); 
				$('#success').html(data.message);
				$("#success").show().fadeTo(5000,500).slideUp(500, function(){
                	$('#success').hide();
                });
			}
		})
	});
 </script>

<?php include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 
unset($employee);
unset($helper);
?>