<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.work.php');
	$helper = new Helper();
	$work = new Work();
?>

<!doctype html>

<html lang="en">

    <head>

<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/inc.header.php');
?>

        <title>OPS:::Work:::Edit Project Master</title>

        <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    </head>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.navigation.php');

	if(isset($_GET['year'])){
		$year = $_GET['year'];
	}else{
		$year = date('Y');
	}

	if(isset($_GET['id'])){
		$result = $work->loadEntry($_GET['id']);
	}else{
		$result = $work->loadEntry();
	}

	if(!$result['success']){
		echo '
		<div class="container-fluid">
			<div class="row p-2">
				<div class="col">
					<h4>Edit Master Work Record</h4>
				</div>

				<div class="col" align="right">
					<a href="/modules/work/" name="cancel" class="btn btn-warning">Go Back</a> 
				</div>
			</div>

		    <div class="alert alert-danger" id="error">'.$result['message'].'
		    	<a href="#" class="close" data-dismiss="alert">&times;</a>
		    </div>
		</div>';
		die();
	}
?>

<!-- BODY -->

<div class="container-fluid">
	<div class="row p-2">
		<div class="col">
			<h4>Edit Master Work Record</h4>
		</div>

		<div class="col" align="right">
			<a href="/modules/work/" name="cancel" class="btn btn-warning">Go Back</a> 
		</div>
	</div>

    <div class="alert alert-danger collapse" id="error">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>

    <div class="alert alert-success collapse" id="success">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>
	
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

	<div class="container-fluid" id="entryForm">
		<form method="post" id="entry" data-toggle="validator" role="form">
			<div class="row container-fluid">
				<div class="col-md-6">
					<div class="form-group row">
						<label for="work_year" class="col-2 col-form-label">Year:</label>
						<div class="col-10">
					    	<input class="form-control" id="work_year" name="work_year" value="<?php echo $year; ?>" REQUIRED READONLY>
					    	<input type="hidden" id="work_id" name="work_id" value="<?php echo $work->getId(); ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="work_number_formal" class="col-2 col-form-label">Work Number:</label>
						<div class="col-10">
							<input class="form-control" id="work_number_formal" name="work_number_formal" value="<?php echo $work->generateFormalNumber($work->getYear(), $work->getWorkNumber()); ?>" REQUIRED READONLY>

					    	<input type="hidden" id="work_number" name="work_number" value="<?php echo $work->getWorkNumber(); ?>" REQUIRED READONLY>
						</div>
					</div>
					<div class="form-group row">
						<label for="work_title" class="col-2 col-form-label">Title:</label>
						<div class="col-10">
					    	<input class="form-control" id="work_title" name="work_title" value="<?php echo $work->getTitle(); ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="work_client_display" class="col-2 col-form-label">Client:</label>
						<div class="col-10">
					    	<input class="form-control" id="work_client_display" name="work_client_display" value="<?php echo $helper->defineOrganizationName($work->getClient()); ?>" REQUIRED>
					    	<input type="hidden" id="work_client" name="work_client" value="<? echo $work->getClient(); ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="work_poc_display" class="col-2 col-form-label">Point of Contact:</label>
						<div class="col-10">
					    	<input class="form-control" id="work_poc_display" name="work_poc_display" value="<?php echo $helper->defineContactName($work->getClientRep()); ?>" REQUIRED>
					    	<input type="hidden" id="work_poc" name="work_poc" value="<?php echo $work->getClientRep(); ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="work_db" class="col-2 col-form-label">Is D/B Project?:</label>
						<div class="col-10">
					    	<select name="work_db" id="work_db" class="form-control">
					    		<?php echo $helper->populateYesNo($work->getDB()); ?>
					    	</select>
						</div>
					</div>
				</div>
				
				<div class="col-md-6">
					<?php
						if(!is_null($work->getPID())){
							echo '<div class="form-group row">
								<label for="work_p_decision" class="col-2 col-form-label">Setup P: </label>
								<div class="col-10">
							    	<select name="work_p_decision" id="work_p_decision" class="form-control" READONLY DISABLED>';
							    		echo $helper->populateYesNo($work->getPID());
							echo '</select>
								</div>
							</div>';

						}else{
							echo '<div class="form-group row">
								<label for="work_p_decision" class="col-2 col-form-label">Setup P: </label>
								<div class="col-10">
							    	<select name="work_p_decision" id="work_p_decision" class="form-control">';
							    		echo $helper->populateYesNo();
							echo '</select>
								</div>
							</div>';
						}

						if(!is_null($work->getJID())){
							echo '<div class="form-group row">
								<label for="work_j_decision" class="col-2 col-form-label">Setup J: </label>
								<div class="col-10">
							    	<select name="work_j_decision" id="work_j_decision" class="form-control" READONLY DISABLED>';
							    		echo $helper->populateYesNo($work->getJID());
							echo '</select>
								</div>
							</div>';

						}else{
							echo '<div class="form-group row">
								<label for="work_j_decision" class="col-2 col-form-label">Setup J: </label>
								<div class="col-10">
							    	<select name="work_j_decision" id="work_j_decision" class="form-control">';
							    		echo $helper->populateYesNo();
							echo '</select>
								</div>
							</div>';
						}

						if(!is_null($work->getBID())){
							echo '<div class="form-group row">
								<label for="work_b_decision" class="col-2 col-form-label">Setup B: </label>
								<div class="col-10">
							    	<select name="work_b_decision" id="work_b_decision" class="form-control" READONLY DISABLED>';
							    		echo $helper->populateYesNo($work->getBID());
							echo '</select>
								</div>
							</div>';

						}else{
							echo '<div class="form-group row">
								<label for="work_b_decision" class="col-2 col-form-label">Setup B: </label>
								<div class="col-10">
							    	<select name="work_b_decision" id="work_b_decision" class="form-control">';
							    		echo $helper->populateYesNo();
							echo '</select>
								</div>
							</div>';
						}

						if(!is_null($work->getCID())){
							echo '<div class="form-group row">
								<label for="work_c_decision" class="col-2 col-form-label">Setup C: </label>
								<div class="col-10">
							    	<select name="work_c_decision" id="work_c_decision" class="form-control" READONLY DISABLED>';
							    		echo $helper->populateYesNo($work->getCID());
							echo '</select>
								</div>
							</div>';

						}else{
							echo '<div class="form-group row">
								<label for="work_c_decision" class="col-2 col-form-label">Setup C: </label>
								<div class="col-10">
							    	<select name="work_c_decision" id="work_c_decision" class="form-control">';
							    		echo $helper->populateYesNo();
							echo '</select>
								</div>
							</div>';
						}

						if(!is_null($work->getSID())){
							echo '<div class="form-group row">
								<label for="work_s_decision" class="col-2 col-form-label">Setup S: </label>
								<div class="col-10">
							    	<select name="work_s_decision" id="work_s_decision" class="form-control" READONLY DISABLED>';
							    		echo $helper->populateYesNo($work->getSID());
							echo '</select>
								</div>
							</div>';

						}else{
							echo '<div class="form-group row">
								<label for="work_s_decision" class="col-2 col-form-label">Setup S: </label>
								<div class="col-10">
							    	<select name="work_s_decision" id="work_s_decision" class="form-control">';
							    		echo $helper->populateYesNo();
							echo '</select>
								</div>
							</div>';
						}
					?>
					
					<div class="form-group row">
						<div class="col-12">
					    	<input type="submit" name="updateButton" id="updateButton" value="Update Entry" class="btn btn-success col-12" />
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>    
</div>

<script>
	$(function(){
		$("#work_client_display").autocomplete({
			source: '/lib/assistants/asst.orglookup.php',
		 	minLength: 1,
		 	select: function(event, ui){
				event.preventDefault();
				$("#work_client").val(ui.item.id);
				$("#work_client_display").val(ui.item.value);
				alert($("#work_client").val());
			},
			change: function(event, ui){
				event.preventDefault();
				if(ui.item == null){
					$("#work_client").val(null);
				}else{
					$("#work_client").val(ui.item.id);
				}
			}
		});

		$("#work_poc_display").autocomplete({
			source: '/lib/assistants/asst.contactlookup.php',
		 	minLength: 1,
		 	select: function(event, ui){
				event.preventDefault();
				$("#work_poc").val(ui.item.id);
				$("#work_poc_display").val(ui.item.value);
				alert($("#work_poc").val());
			},
			change: function(event, ui){
				event.preventDefault();
				if(ui.item == null){
					$("#work_poc").val(null);
				}else{
					$("#work_poc").val(ui.item.id);
				}
			}
		});
	});

	$(document).ready(function(){
		$('#entry').on("submit", function(e){
			e.preventDefault();
			$('#insertButton').attr("disabled", "DISABLED");
			$('#waitDialog').modal('show');
			$.ajax({
				url: "insert.php",
				method: "POST",
				data: $("#entry").serialize(),
				dataType: "json"
			})
			.done(function(data){
				if(!data.success){
					$('#waitDialog').modal('hide');
					$('#error').html(data.message);
					$("#error").show();
					$('#insertButton').removeAttr("disabled");
				}else{
					$('#waitDialog').modal('hide');
					//Don't enable the button again!
					//$('#insertButton').removeAttr("disabled");
					$('#entry')[0].reset();
					$('#success').html(data.message);
					$("#success").show(); 
					var id = data.updateInfo;
					var url = 'view.php?id='+id;
					//Redirect
					window.location.replace(url);
				}
			})
		});
	});
</script>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 
?>