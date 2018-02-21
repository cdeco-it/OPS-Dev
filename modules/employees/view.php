<?php 
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
?>

<!doctype html>

<html lang="en">

    <head>

<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/inc.header.php');
?>

        <title>OPS:::Address Book:::Contact Details</title>

    </head>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.navigation.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.employee.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');

	//Get the load employee id that needs to be loaded
	$view_id = $_GET['id'];

	//Instantiate a new Db connector
	$employee = new Employee();
	$helper = new Helper();

	$employee->getFormalizedEmployeeById($view_id);
	$address = $employee->getAddress();


?>

<!-- BODY -->

<div class="container-fluid">
	<div class="row p-2">
		<div class="col">
			<h4>Employee Details: </h4>
		</div>

		<div class="col" align="right">
			<a href="/modules/employees/" name="cancel" class="btn btn-warning">Go Back</a> 
		</div>
	</div>

    <div class="alert alert-danger collapse" id="error">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>

    <div class="alert alert-success collapse" id="success">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>
	
	<div class="container-fluid">
		<div class="row container-fluid">
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<div class="card-header">
							<h4 class="card-title">
								<?php 
									if(!empty($employee->getMiddleName())){
										echo $employee->getPrefix().' '
											.$employee->getFirstName().' '
											.$employee->getMiddleName().' '
											.$employee->getLastName().' '
											.$employee->getSuffix();
									}else{
										echo $employee->getPrefix().' '
											.$employee->getFirstName().' '
											.$employee->getLastName().' '
											.$employee->getSuffix();
									}
								?>
							</h4>
						</div>
						<div class="row">
							<div class="col">
								<h6 class="text-muted">Mailing Address:</h6><hr />
								<p class="card-text">
									<?php 

										echo $address['addr1'].'<br />'; 
										if(!empty($address['addr2'])){
											echo $address['addr2'].'<br />';
										}

										echo $address['city'].', '.$address['state'].' '.$address['postcode'].'<br />';
										echo $address['country'];
									?>
								</p>
								<p class="card-text">
								<h6 class="text-muted">Contact Information:</h6>
									<ul class="list-group list-group-flush">
										<li class="list-group-item"><strong>Home:</strong><?php echo $employee->getHomePhone(); ?> 
										<li class="list-group-item"><strong>Mobile: </strong><?php echo $employee->getMobilePhone(); ?>
									</ul>	
								<br />
									


								<p class="text-muted">Last Edited: <?php echo $employee->getDateModified(); ?></p>
								</p>
							</div>

							<div class="col">
								<p class="card-text">
								<h6 class="text-muted">Statistics Information:</h6>
									<ul class="list-group list-group-flush">
										<li class="list-group-item"><strong>Status: </strong><?php echo $employee->getStatus(); ?> </li>
										<li class="list-group-item"><strong>Birth: </strong><?php echo $helper->date_toStandard($employee->getDob()); ?> </li>
										<li class="list-group-item"><strong>Age: </strong><?php echo $helper->date_calculateAge($employee->getDob()); ?> </li>
										<li class="list-group-item"><strong>Hire: </strong><?php echo $helper->date_toStandard($employee->getHireDate()); ?></li>
										<li class="list-group-item"><strong>Tenure: </strong><?php echo $helper->date_calculateAge($employee->getHireDate()); ?> </li>
									</ul>
								</p>
								<br />
								<?php  if($level <= 2) { ?>

									<p class="card-text">
									<h6 class="text-muted">ACL:</h6>
									<ul class="list-group list-group-flush">
										<li class="list-group-item"><strong>Level: </strong><?php echo $employee->getACL(); ?> </li>
									</ul>
									</p>
								<?php } ?>
								
							</div>

						</div>
					</div>
				</div>
				<a href="edit.php?id=<?php echo $view_id; ?>" class="btn btn-primary mt-2">Edit This Entry</a>
			</div>
		</div>
	</div>    
</div>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 
?>