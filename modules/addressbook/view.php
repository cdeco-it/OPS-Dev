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
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.address.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');

	//Get the load employee id that needs to be loaded
	$view_id = $_GET['id'];

	//Instantiate a new Db connector
	$addr = new Address();
	$helper = new Helper();
	$addr->getFormalizedEntry($view_id);
	$address = $addr->getAddress();
	$contact = $addr->getContactInfo();

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
			<h4>Contact Details: </h4>
		</div>

		<div class="col" align="right">
			<a href="/modules/addressbook/" name="cancel" class="btn btn-warning">Go Back</a> 
		</div>
	</div>
	
	<div class="container-fluid">
		<div class="row container-fluid">
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<div class="card-header">
							<h4 class="card-title">
								<?php 
									if(!empty($addr->getNickName())){
										echo $addr->getPrefix().' '.$addr->getFirstName().' '.$addr->getLastName().' '.$addr->getSuffix().' (a/k/a "'.$addr->getNickName().'")';
									}else{
										echo $addr->getPrefix().' '.$addr->getFirstName().' '.$addr->getLastName().' '.$addr->getSuffix();
									}
								?>
								
							</h4>
						</div>
						<h5 class="card-subtitled mb-2 text-muted"><?php echo $addr->getTitle().' ::: '.$addr->getOrganization(); ?></h5>
						<div class="row">
							<div class="col">
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
									<div class="row">
										<div class="col">
											<h6 class="text-muted">Relation:</h6><hr />
											<ul class='fa-ul'>
											<?php
											 	$x = 0;
												if($addr->getIsClient()){
													echo '<li><i class="fa-li fa fa-check-square "></i>Client</li>';
												}else{
													$x++;
												}

												if($addr->getIsConsultant()){
													echo '<li><i class="fa-li fa fa-check-square "></i>Consultant</li>';
												}else{
													$x++;
												}

												if($addr->getIsVendor()){
													echo '<li><i class="fa-li fa fa-check-square "></i>Vendor</li>';
												}else{
													$x++;
												}

												if($x == 3){
													echo '<li>No class assigned</li>';
												}

											?>
											</ul>
										</div>
										<div class="col">
											<h6 class="text-muted">Receiving:</h6><hr />
											<ul class='fa-ul'>
											<?php
											 	$x = 0;
												if($addr->getNewsletter()){
													echo '<li><i class="fa-li far fa-check-square "></i>Newsletters</li>';
													$x++;
												}

												if($addr->getCalendar()){
													echo '<li><i class="fa-li far fa-check-square "></i>Calendars</li>';
													$x++;
												}
												if($addr->getGifts()){
													echo '<li><i class="fa-li far fa-check-square "></i>Gifts</li>';
													$x++;
												}

												if($x == 0){
													echo '<li><i class="fa-li far fa-square"></i>Nothing</li>';
												}
											?>
											</ul>
										</div>
									</div>
									<h6 class="text-muted">Resource:</h6><hr />
									<i class="far fa-address-card" aria-hidden="true"></i> 
									<i class="fas fa-qrcode" aria-hidden="true"></i> 
									<a href="directions.php"><i class="far fa-map" aria-hidden="true"></i></a>
									<p class="text-muted">Last Edited: <?php echo $addr->getDateModified(); ?></p>
								</p>
							</div>
							<div class="col">
								<ul class="list-group list-group-flush fa-ul">
								<?php
									if(!empty($contact['org'])){
										echo '<li class="list-group-item"><strong>Main: </strong>'.$helper->format_PhoneNumber($contact['org'], $helper->defineCountryCode($address['country'])).'</li>';
									}

									if(!empty($contact['ext'])){
										echo '<li class="list-group-item"><strong>Ext.: </strong>'.$contact['ext'].'</li>';
									}

									if(!empty($contact['fax'])){
										echo '<li class="list-group-item"><strong>Fax: </strong>'.$helper->format_PhoneNumber($contact['fax'], $helper->defineCountryCode($address['country'])).'</li>';
									}

									if(!empty($contact['direct'])){
										echo '<li class="list-group-item"><strong>Direct: </strong>'.$helper->format_PhoneNumber($contact['direct'], $helper->defineCountryCode($address['country'])).'</li>';
									}

									if(!empty($contact['mobile'])){
										echo '<li class="list-group-item"><strong>Mobile: </strong>'.$helper->format_PhoneNumber($contact['mobile'], $helper->defineCountryCode($address['country'])).'</li>';
									}

									if(!empty($contact['email'])){
										echo '<li class="list-group-item"><strong>Email: </strong><a href="mailto:'.$contact['email'].'">'.$contact['email'].'</a></li>';
									}

									if(!empty($contact['url'])){
										echo '<li class="list-group-item"><strong>Web: </strong>'.$contact['url'].'</li>';
									}
								?>

								</ul>
							</div>
						</div>
					</div>
				</div>
				<a href="edit.php?id=<?php echo $view_id; ?>" class="btn btn-primary mt-2">Edit This Entry</a>
			</div>
			

			<div id="map" class="col-md-6">
			</div>
		</div>
	</div>    
</div>

<input type="hidden" id="lat" value="<?php echo $addr->getLat(); ?>">
<input type="hidden" id="lng" value="<?php echo $addr->getLng(); ?>">

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARqjTlbbzCLTq2equWgoqM2gCDQDivktg&callback=initMap" ></script>

<script>
	var x = parseFloat($('#lat').val());
	var y = parseFloat($('#lng').val());
	var coords = {lat: x, lng: y};

	function initMap(){
	
		var plot = new google.maps.Map(document.getElementById('map'), {
			zoom: 17,
			center: coords
		});
		var marker = new google.maps.Marker({
			position: coords,
			map: plot
		});

	}
</script>


<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 
?>