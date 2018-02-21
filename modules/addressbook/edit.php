<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.address.php');
	$addr = new Address();
	$helper = new Helper();

	if(isset($_GET) && $level <= 2){
		$edit_id = $_GET['id'];
		$addr->getEntry($edit_id);
		$address = $addr->getAddress();
		$contact = $addr->getContactInfo();
	}else{
		echo '
		<div class="alert alert-danger collapse" id="error">
			'.E_NO_ID.'
    		<a href="#" class="close" data-dismiss="alert">&times;</a>
    	</div>';
    	die();
	}
?>

<!doctype html>

<html lang="en">

    <head>

<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/inc.header.php');
?>
        <title>OPS:::Address Book:::Edit Contact</title>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

    </head>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.navigation.php');
?>

<!-- BODY -->

<div class="container-fluid">

	<div class="alert alert-danger collapse" id="error">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>

    <div class="alert alert-success collapse" id="success">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>
	
	<div class="row p-2">
		<div class="col">
			<h4>Edit Entry</h4>
		</div>

		<div class="col" align="right">
			<a href="/modules/addressbook/" name="cancel" class="btn btn-warning">Go Back</a> 
		</div>
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
						<label for="prefix" class="col-2 col-form-label">Prefix:</label>
						<div class="col-10">
					    	<select name="prefix" class="form-control">
					    		<?php $helper->populatePrefix($addr->getPrefix()); ?>
					    	</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="fname" class="col-2 col-form-label">First:</label>
						<div class="col-10">
					    	<input class="form-control" id="fname" name="fname" value="<?php echo $addr->getFirstName(); ?>" REQUIRED>
						</div>
					</div>
					<div class="form-group row">
						<label for="mname" class="col-2 col-form-label">Middle:</label>
						<div class="col-10">
					    	<input class="form-control" id="mname" name="mname" value="<?php echo $addr->getMiddleName(); ?>" >
						</div>
					</div>
					<div class="form-group row">
						<label for="lname" class="col-2 col-form-label">Last:</label>
						<div class="col-10">
					    	<input class="form-control" id="lname" name="lname" value="<?php echo $addr->getLastName(); ?>" REQUIRED>
						</div>
					</div>
					<div class="form-group row">
						<label for="nname" class="col-2 col-form-label">Nickname:</label>
						<div class="col-10">
					    	<input class="form-control" id="nname" name="nname" value="<?php echo $addr->getNickName(); ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="suffix" class="col-2 col-form-label">Suffix:</label>
						<div class="col-10">
					    	<select name="suffix" class="form-control">
					    		<?php $helper->populateSuffix($addr->getSuffix()); ?>
					    	</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="org" class="col-2 col-form-label">Organization:</label>
						<div class="col-10">
					    	<input class="form-control" id="org" name="org" value="<?php echo $addr->getOrganization(); ?>" autocomplete="off">
					    	<input type="hidden" id="org_id" name="org_id" value="<?php echo $addr->getOrganizationId(); ?>" >
						</div>
					</div>
					<div class="form-group row">
						<label for="title" class="col-2 col-form-label">Title/Role:</label>
						<div class="col-10">
					    	<input class="form-control" id="title" name="title" value="<?php echo $addr->getTitle(); ?>" REQUIRED>
						</div>
					</div>
					<div class="form-group row">
						<label for="isclient" class="col-2 col-form-label">Is Client:</label>
						<div class="col-10">
					    	<select name="isclient" class="form-control">
					    		<?php $helper->populateYesNo($addr->getIsClient()); ?>
					    	</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="isvendor" class="col-2 col-form-label">Is Vendor:</label>
						<div class="col-10">
					    	<select name="isvendor" class="form-control">
					    		<?php $helper->populateYesNo($addr->getIsVendor()); ?>
					    	</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="isconsultant" class="col-2 col-form-label">Is Consultant:</label>
						<div class="col-10">
					    	<select name="isconsultant" class="form-control">
					    		<?php $helper->populateYesNo($addr->getIsConsultant()); ?>
					    	</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="newsletter" class="col-2 col-form-label">Newsletter:</label>
						<div class="col-10">
					    	<select name="newsletter" class="form-control">
					    		<?php $helper->populateYesNo($addr->getNewsletter()); ?>
					    	</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="calendars" class="col-2 col-form-label">Calendars:</label>
						<div class="col-10">
					    	<select name="calendars" class="form-control">
					    		<?php $helper->populateYesNo($addr->getCalendar()); ?>
					    	</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="gifts" class="col-2 col-form-label">Gifts:</label>
						<div class="col-10">
					    	<select name="gifts" class="form-control">
					    		<?php $helper->populateYesNo($addr->getGifts()); ?>
					    	</select>
						</div>
					</div>
				</div>
				

				<div class="col-md-6">
					<div class="form-group row">
						<label for="address1" class="col-2 col-form-label">Address Line 1: </label>
						<div class="col-10">
					    	<input class="form-control" id="address1" name="address1" value="<?php echo $address['addr1']; ?>" REQUIRED>
						</div>
					</div>
					<div class="form-group row">
						<label for="address" class="col-2 col-form-label">Address Line 2: </label>
						<div class="col-10">
					    	<input class="form-control" id="address2" name="address2" value="<?php echo $address['addr2']; ?>" >
						</div>
					</div>
					<div class="form-group row">
						<label for="city" class="col-2 col-form-label">City:</label>
						<div class="col-10">
					    	<input class="form-control" id="city" name="city" value="<?php echo $address['city']; ?>" REQUIRED>
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
					    	<input class="form-control" id="postcode" name="postcode" value="<?php echo $address['postcode'] ?>" REQUIRED>
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
						<label for="email" class="col-2 col-form-label">E-Mail:</label>
						<div class="col-10">
					    	<input class="form-control" id="email" name="email" value="<?php echo $addr->getEmail(); ?>" REQUIRED>
						</div>
					</div>
					<div class="form-group row">
						<label for="url" class="col-2 col-form-label">URL:</label>
						<div class="col-10">
					    	<input class="form-control" id="url" name="url" value="<?php echo $addr->getUrl(); ?>" REQUIRED>
						</div>
					</div>
					<div class="form-group row">
						<label for="orgphone" class="col-2 col-form-label">Org. Phone: </label>
						<div class="col-10">
					    	<input class="form-control" id="orgphone" name="orgphone" value="<?php echo $contact['org']; ?>" REQUIRED>
						</div>
					</div>
					<div class="form-group row">
						<label for="orgphoneext" class="col-2 col-form-label">Extension: </label>
						<div class="col-10">
					    	<input class="form-control" id="orgphoneext" name="orgphoneext" value="<?php echo $contact['ext']; ?>" >
						</div>
					</div>
					<div class="form-group row">
						<label for="orgfax" class="col-2 col-form-label">Fax: </label>
						<div class="col-10">
					    	<input class="form-control" id="orgfax" name="orgfax" value="<?php echo $contact['fax']; ?>" >
						</div>
					</div>
					<div class="form-group row">
						<label for="directphone" class="col-2 col-form-label">Direct Phone: </label>
						<div class="col-10">
					    	<input class="form-control" id="directphone" name="directphone" value="<?php echo $contact['direct']; ?>" >
						</div>
					</div>
					<div class="form-group row">
						<label for="mobilephone" class="col-2 col-form-label">Mobile Phone: </label>
						<div class="col-10">
					    	<input class="form-control" id="mobilephone" name="mobilephone" value="<?php echo $contact['mobile']; ?>" >
						</div>
					</div>
					<div class="form-group row">
						<div class="col-12">
							<input type="hidden" name="updateId" id="updateId" value="<?php echo $edit_id; ?>">
					    	<input type="submit" name="updateButton" id="updateButton" value="Update Record" class="btn btn-success col-12" />
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>    
</div>

<script>
	$(function(){
		$("#org").autocomplete({
			source: '/lib/assistants/asst.orglookup.php',
		 	minLength: 1,
		 	select: function(event, ui){
				event.preventDefault();
				$("#org_id").val(ui.item.id);
				$("#org").val(ui.item.value);
				alert($("#org_id").val());
			},
			change: function(event, ui){
				event.preventDefault();
				if(ui.item == null){
					$("#org_id").val(null);
				}else{
					$("#org_id").val(ui.item.id);
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
				url: "update.php",
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
					$('#insertButton').removeAttr("disabled");
					$('#success').html(data.message);
					$("#success").show().fadeTo(5000,500).slideUp(500, function(){
	                	$('#success').hide();
	                });
				}
			})
		});
	});
</script>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 
?>