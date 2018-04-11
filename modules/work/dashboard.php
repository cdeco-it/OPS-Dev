<?php require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php'); ?>

<!doctype html>

<html lang="en">

    <head>

    	<title>OPS:::Project Dashboard</title>

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
?>

<!-- BODY -->

<div class="container-fluid">
	<div class="container-fluid row no-gutters pt-2 pb-2">
		<main class="row">
			<h1>YY-XXX ::: Project Title</h1>
		</main>
		<div class=" col-sm-2 placeholder text-center">
            	<section class="row placeholders">	
            		<h4>Project Status</h4>
	              	<span class="text-muted">
	              		Ongoing
	              	</span>
	              	<hr />
            		<h4>Percent Complete</h4>
	              		<div class="progress blue">
							<span class="progress-left">
	                    		<span class="progress-bar"></span>
	                		</span>
	                		<span class="progress-right">
	                    		<span class="progress-bar"></span>
	                		</span>
	                		<div class="progress-value">34%</div>
	              		</div>
	              	<hr />
	              	<h4>Next Milestone</h4>
	              	<span class="text-muted">
	              		DD-MM-YYYY<br />
	              		This Milestone	
	              	</span>
            	</div>
	</div>

</div>


<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 
	unset($work);
	unset($helper);
	unset($db);
?>