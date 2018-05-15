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

    <!-- <style>
		ul.ui-autocomplete.ui-menu {
 			z-index: 1200;
		}
		table.dataTable tbody td {
			vertical-align: middle;
		}
	</style> -->

    </head>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.navigation.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.work.php');
?>

<!-- BODY -->
<!--
<div class="container-fluid">
	<div class="container-fluid no-gutters pt-2 pb-2">
-->

<div class="container-fluid">
    <div class="row">
    	<nav class="col-md-2 d-none d-md-block bg-light sidebar">
        	<div class="sidebar-sticky">
            	<ul class="nav flex-column">
            		 <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
		             	<span>Project Navigation</span>
		            </h6>
              		<li class="nav-item">
		                <a class="nav-link active" href="#">
		                	<i class="fas fa-angle-double-up"></i> ::: Go To Top
		                </a>
              		</li>
              		<li class="nav-item">
		                <a class="nav-link" href="#">
		                	<i class="far fa-file-alt"></i> ::: Scope
		                </a>
		              </li>
		            <li class="nav-item">
		                <a class="nav-link" href="#">
		                 	<i class="far fa-compass"></i> ::: Current Status
		                </a>
		            </li>
		            <li class="nav-item">
		                <a class="nav-link" href="#">
		                	<i class="fas fa-cogs"></i> ::: Details 
		                </a>
		            </li>
            	</ul>
        	</div>
        </nav>

        <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
        	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            	<h2>YY-XXX ::: Title</h2>
            	<div class="btn-toolbar mb-2 mb-md-0">
              		<div class="btn-group mr-2">
                		<button class="btn btn-sm btn-outline-secondary">Export</button>
              		</div>
            	</div>
          	</div>
			
      		<div name="scope">
      			<h4>Scope of Project<a name="scope"></a> </h4>
      			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et maximus tellus, et porta tellus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam elementum interdum metus, et pellentesque elit vehicula in. Duis luctus finibus mattis. Proin mattis risus imperdiet, scelerisque leo eget, ullamcorper nisl. Etiam egestas vitae lectus vitae efficitur. Praesent lorem metus, mollis ut mollis non, egestas laoreet est. In at dolor ultrices, dapibus lectus sit amet, gravida dolor. Duis ac auctor libero. Aliquam non sagittis augue, quis ultrices quam.</p>

				<p>Sed ullamcorper, sapien efficitur accumsan finibus, dui ante euismod orci, rutrum pulvinar nisi dui eget ante. Sed mattis ultricies justo, quis aliquet nibh dictum ut. Proin varius dolor velit, sed varius nunc pulvinar in. Proin quis tellus eget leo bibendum tincidunt ac malesuada mi. Phasellus fermentum metus sed molestie ultricies. In eget efficitur enim. Vivamus congue tincidunt lectus ac faucibus. Ut bibendum sed dui at pretium. In hac habitasse platea dictumst. Mauris feugiat sapien at nisi viverra cursus.</p>
			</div>

			<div name="curretstatus">
      			<h4>Current Status<a name="currentstatus"></a> </h4>
      			
			</div>

			<div name="team">
      			<h4>Project Team<a name="team"></a> </h4>
      			
			</div>

			<div name="details">
				<h4>Details<a name="detail"></a> </h4>
				<ul class="nav nav-tabs">
					<li class="nav-item">
				 		<a class="nav-link active" data-toggle="tab" role="tab" href="#milestones">Milestones</a>
				  	</li>
				  	<li class="nav-item">
						<a class="nav-link" data-toggle="tab" role="tab" href="#discussions">Discussions</a>
				  	</li>
				  	<li class="nav-item">
						<a class="nav-link" data-toggle="tab" role="tab" href="#actions">Action Log</a>
				  	</li>
				  	<li class="nav-item">
						<a class="nav-link" data-toggle="tab" role="tab" href="#subsrfi">Submittals/RFI</a>
				  	</li>
				  	<li class="nav-item">
						<a class="nav-link" data-toggle="tab" role="tab" href="#delays">Delay Log</a>
				  	</li>
				  	<li class="nav-item">
						<a class="nav-link" data-toggle="tab" role="tab" href="#accounting">Accounting</a>
				  	</li>
				</ul>
			</div>
        </main>
    </div>
</div>


<!--
	</div>
</div>
-->

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 
	unset($work);
	unset($helper);
	unset($db);
?>