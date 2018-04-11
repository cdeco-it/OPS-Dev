<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php');
?>

<!doctype html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>OPS:::Projects:::Dashboard</title>

        <meta name="description" content="">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">

        <link rel="stylesheet" href="/lib/css/dashboard.css">

        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

		<script  src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>  

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.2.1/jq-3.2.1/dt-1.10.16/datatables.min.js"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>

        <script src="https://use.fontawesome.com/a05d68758b.js"></script>

    </head>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.navigation.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
?>

<!-- BODY -->
<div class="container-fluid">
    <div class="row">
        
		<!-- <main role="main" class="col-sm-9 ml-sm-auto "> -->
        <main role="main" class="">
        	<h1>YY-XXX-J ::: Project Title</h1>
          	<section class="row placeholders">
            	<div class=" col-sm-2 placeholder text-center">
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
            	<div class="col-sm-10 ">
              		<h4>Project Scope</h4>
              		<span class="text-muted">
              			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et maximus tellus, et porta tellus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam elementum interdum metus, et pellentesque elit vehicula in. Duis luctus finibus mattis. Proin mattis risus imperdiet, scelerisque leo eget, ullamcorper nisl. Etiam egestas vitae lectus vitae efficitur. Praesent lorem metus, mollis ut mollis non, egestas laoreet est. In at dolor ultrices, dapibus lectus sit amet, gravida dolor. Duis ac auctor libero. Aliquam non sagittis augue, quis ultrices quam.</p>

						<p>Sed ullamcorper, sapien efficitur accumsan finibus, dui ante euismod orci, rutrum pulvinar nisi dui eget ante. Sed mattis ultricies justo, quis aliquet nibh dictum ut. Proin varius dolor velit, sed varius nunc pulvinar in. Proin quis tellus eget leo bibendum tincidunt ac malesuada mi. Phasellus fermentum metus sed molestie ultricies. In eget efficitur enim. Vivamus congue tincidunt lectus ac faucibus. Ut bibendum sed dui at pretium. In hac habitasse platea dictumst. Mauris feugiat sapien at nisi viverra cursus.</p>
					</span>
					<div class="row">
						<div class="col-sm-6">
							<h4>Assigned Team</h4>
							<ul>
								<li>Lead: John Doe</li>
								<li>Jane Doe</li>
								<li>Billy Bob</li>
							</ul>
						</div>
						<div class="col-sm-6">
							<h4>Consultant Team</h4>
							<ul>
								<li>Role: Consultant A</li>
								<li>Role: Consultant B</li>
								<li>Role: Consultant C</li>
							</ul>
						</div>

            	</div>
          	</section>

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

			<div class="tab-content">
				<div class="tab-pane active" id="milestones" role="tabpanel">
					<div class="row">
						<div class="col-sm-11 pt-2 pb-2">
							<h4>Milestones</h4>
						</div>
						<div class="col-sm pt-2 pb-2">
							<a href="#" name="add_milestone" id="add_milestone" data-toggle="modal" data-target="#addMilestone" class="btn btn-success ">Add</a>
						</div>
					</div>
		          	<div class="table-responsive">
        				<table class="table table-striped">
          					<thead>
		                		<tr>
				                  	<th width="5%">#</th>
				                  	<th>Event</th>
				                  	<th width="10%">Date Due</th>
				                  	<th width="10%">Days Remaining</th>
				                  	<th width="10%">Action</th>
				                </tr>
		              		</thead>
		              		
		              		<tbody>
		                		<tr>
				                	<td>1</td>
				                  	<td>Lorem</td>
				                  	<td>01-01-2018</td>
				                  	<td>27 Days</td>
				                  	<td><button type="button" id="editButton'.$i.'" class="editButton btn btn-info btn-xs" value='.$row['employee_id'].'>Edit</button></td>
				                </tr>
				                <tr>
				                	<td>2</td>
				                  	<td>Ipsum</td>
				                  	<td>01-01-2018</td>
				                  	<td>37 Days</td>
				                  	<td><button type="button" id="editButton'.$i.'" class="editButton btn btn-info btn-xs" value='.$row['employee_id'].'>Edit</button></td>
				                </tr>
				                <tr>
				                	<td>3</td>
				                  	<td>Lorem</td>
				                  	<td>6-24-2019</td>
				                  	<td>421 Days</td>
				                  	<td><button type="button" id="editButton'.$i.'" class="editButton btn btn-info btn-xs" value='.$row['employee_id'].'>Edit</button></td>
				                </tr>
				                <tr>
				                	<td>4</td>
				                  	<td>Final</td>
				                  	<td>4-24-2018</td>
				                  	<td>52 Days</td>
				                  	<td><button type="button" id="editButton'.$i.'" class="editButton btn btn-info btn-xs" value='.$row['employee_id'].'>Edit</button></td>
				                </tr>
				            </tbody>
				        </table>
				    </div>
				</div>

			  	<div class="tab-pane" id="discussions" role="tabpanel">
			  		<div class="row">
						<div class="col-sm-11 pt-2 pb-2">
							<h4>Discussions</h4>
						</div>
						<div class="col-sm pt-2 pb-2">
							<a href="#" name="add_milestone" id="add_milestone" data-toggle="modal" data-target="#addMilestone" class="btn btn-success ">Add</a>
						</div>
					</div>
		          	<div class="table-responsive">
        				<table class="table table-striped">
          					<thead>
		                		<tr>
				                  	<th width="5%">Entry</th>
				                  	<th>Comments</th>
				                  	<th width="10%">Date Revised</th>
				                  	<th width="10%">Action</th>
				                </tr>
		              		</thead>
		              		
		              		<tbody>
		                		<tr>
				                	<td>1</td>
				                  	<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et maximus tellus, et porta tellus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam elementum interdum metus, et pellentesque elit vehicula in. Duis luctus finibus mattis. Proin mattis risus imperdiet, scelerisque leo eget, ullamcorper nisl. Etiam egestas vitae lectus vitae efficitur. Praesent lorem metus, mollis ut mollis non, egestas laoreet est. In at dolor ultrices, dapibus lectus sit amet, gravida dolor. Duis ac auctor libero. Aliquam non sagittis augue, quis ultrices quam</td>
				                  	<td>01-01-2018</td>
				                  	<td>Edit</td>
				                </tr>
				                <tr>
				                	<td>2</td>
				                  	<td>Sed ullamcorper, sapien efficitur accumsan finibus, dui ante euismod orci, rutrum pulvinar nisi dui eget ante. Sed mattis ultricies justo, quis aliquet nibh dictum ut. Proin varius dolor velit, sed varius nunc pulvinar in. Proin quis tellus eget leo bibendum tincidunt ac malesuada mi. Phasellus fermentum metus sed molestie ultricies. In eget efficitur enim. Vivamus congue tincidunt lectus ac faucibus. Ut bibendum sed dui at pretium. In hac habitasse platea dictumst. Mauris feugiat sapien at nisi viverra cursus.</td>
				                  	<td>01-01-2018</td>
				                  	<td>Edit</td>
				                </tr>
				                <tr>
				                	<td>3</td>
				                  	<td>Sed ullamcorper, sapien efficitur accumsan finibus, dui ante euismod orci, rutrum pulvinar nisi dui eget ante. Sed mattis ultricies justo, quis aliquet nibh dictum ut. Proin varius dolor velit, sed varius nunc pulvinar in. Proin quis tellus eget leo bibendum tincidunt ac malesuada mi. Phasellus fermentum metus sed molestie ultricies. In eget efficitur enim. Vivamus congue tincidunt lectus ac faucibus. Ut bibendum sed dui at pretium. In hac habitasse platea dictumst. Mauris feugiat sapien at nisi viverra cursus.</td>
				                  	<td>6-24-2019</td>
				                  	<td>Edit</td>
				                </tr>
				                <tr>
				                	<td>4</td>
				                  	<td>Sed ullamcorper, sapien efficitur accumsan finibus, dui ante euismod orci, rutrum pulvinar nisi dui eget ante. Sed mattis ultricies justo, quis aliquet nibh dictum ut. Proin varius dolor velit, sed varius nunc pulvinar in. Proin quis tellus eget leo bibendum tincidunt ac malesuada mi. Phasellus fermentum metus sed molestie ultricies. In eget efficitur enim. Vivamus congue tincidunt lectus ac faucibus. Ut bibendum sed dui at pretium. In hac habitasse platea dictumst. Mauris feugiat sapien at nisi viverra cursus.</td>
				                  	<td>4-24-2018</td>
				                  	<td>Edit</td>
				                </tr>
				            </tbody>
				        </table>
				    </div>
			  		
			  	</div>

			  	<div class="tab-pane" id="actions" role="tabpanel">
			  		<div class="row">
						<div class="col-sm-11 pt-2 pb-2">
							<h4>Actions</h4>
						</div>
						<div class="col-sm pt-2 pb-2">
							<a href="#" name="add_milestone" id="add_milestone" data-toggle="modal" data-target="#addMilestone" class="btn btn-success ">Add</a>
						</div>
					</div>
		          	<div class="table-responsive">
        				<table class="table table-striped">
          					<thead>
		                		<tr>
				                  	<th>Action</th>
				                  	<th>Assigned To</th>
				                  	<th>Comments</th>
				                  	<th>Date Due</th>
				                  	<th>Complete</th>
				                  	<th>Action</th>
				                </tr>
		              		</thead>
		              		
		              		<tbody>
		                		<tr>
				                	<td>Review Specs for Steel</td>
				                  	<td>L. Mized</td>
				                  	<td>None</td>
				                  	<td>01-01-2018</td>
				                  	<td><i class="fa fa-check-circle-o fa-lg" aria-hidden="true"></i></td>
				                  	<td>Edit</td>
				                </tr>
				                <tr>
				                	<td>Verify coil sizing with AAON</td>
				                  	<td>L. Li</td>
				                  	<td>01-01-2018</td>
				                  	<td>37 Days</td>
				                  	<td></td>
				                  	<td>Edit</td>
				                </tr>
				            </tbody>
				        </table>
				    </div>
			  	</div>

			  	<div class="tab-pane" id="delays" role="tabpanel">
			  		<div class="row">
						<div class="col-sm-11 pt-2 pb-2">
							<h4>Delays</h4>
						</div>
						<div class="col-sm pt-2 pb-2">
							<a href="#" name="add_milestone" id="add_milestone" data-toggle="modal" data-target="#addMilestone" class="btn btn-success ">Add</a>
						</div>
					</div>
		          	<div class="table-responsive">
        				<table class="table table-striped">
          					<thead>
		                		<tr>
				                  	<th>Milestone</th>
				                  	<th>Cause</th>
				                  	<th>Notes</th>
				                  	<th>Date Completed</th>
				                  	<th>Total Delay</th>
				                </tr>
		              		</thead>
		              		
		              		<tbody>
		                		<tr>
				                	<td>50% Design Review</td>
				                  	<td>Engineering Delay</td>
				                  	<td>Engineering backlog caused a delay in CAD development.</td>
				                  	<td>01-25-2018</td>
				                  	<td>25 Days</td>
				                </tr>
				                <tr>
				                	<td>75% Design Review</td>
				                  	<td>Consultant Delay</td>
				                  	<td>Consultant backlog caused a delay in CAD development.</td>
				                  	<td>03-25-2018</td>
				                  	<td>5 Days</td>
				                  	<td></td>
				                </tr>
				            </tbody>
				        </table>
				    </div>
			  		
			  	</div>

			  	<div class="tab-pane" id="subsrfi" role="tabpanel">
			  		<div class="row">
						<div class="col-sm-11 pt-2 pb-2">
							<h4>Submittal &amp; RFI Register</h4>
						</div>
						<div class="col-sm pt-2 pb-2">
							<a href="#" name="add_milestone" id="add_milestone" data-toggle="modal" data-target="#addMilestone" class="btn btn-success ">Add</a>
						</div>
					</div>

		          	<div class="table-responsive">
        				<table class="table table-striped">
          					<thead>
		                		<tr>
		                			<th>Type</th>
				                  	<th>Subject</th>
				                  	<th>Assigned To</th>
				                  	<th>Date Due</th>
				                  	<th>Disposition</th>
				                  	<th>Date Returned</th>
				                  	<th>Action</th>
				                </tr>
		              		</thead>
		              		
		              		<tbody>
		                		<tr>
		                			<td>R</td>
				                	<td>Review Specs for Steel</td>
				                  	<td>L. Mized</td>
				                  	<td>None</td>
				                  	<td>Approved as noted.</td>
				                  	<td>01-01-2018</td>
				                  	<td>Edit</td>
				                </tr>
				                <tr>
				                	<td>S</td>
				                	<td>Verify coil sizing with AAON</td>
				                  	<td>L. Li</td>
				                  	<td>01-01-2018</td>
				                  	<td></td>
				                  	<td>37 Days</td>
				                  	<td>Edit</td>
				                </tr>
				            </tbody>
				        </table>
				    </div>
			  	</div>

			  	<div class="tab-pane" id="accounting" role="tabpanel">

			  		<div class="row">
						<div class="col-sm-11 pt-2 pb-2">
							<h4>Accounting Details</h4>
						</div>
						<div class="col-sm pt-2 pb-2">
							<a href="#" name="add_milestone" id="add_milestone" data-toggle="modal" data-target="#addMilestone" class="btn btn-info ">Edit</a>
						</div>
					</div>

					<table class="table table-striped">
      					<thead>
	                		<tr>
			                  	<th>Contract Value</th>
			                  	<th>Time &amp; Materials</th>
			                  	<th>Invoiced To Date</th>
			                  	<th>Invoiced Remaining</th>
			                  	<th>% Invoiced</th>
			                  	<th>Action</th>
			                </tr>
	              		</thead>
	              		<tbody>
	                		<tr>
			                	<td>$xxxxxxx.xx</td>
			                  	<td><i class="fa fa-check-circle-o fa-lg" aria-hidden="true"></i></td>
			                  	<td>$yyyyy.00</td>
			                  	<td>$x-$y</td>
			                  	<td>5%</td>
			                  	<td>Action</td>
			                </tr>
			            </tbody>
			        </table>
			        <h5>Notes</h5>
			        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et maximus tellus, et porta tellus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam elementum interdum metus, et pellentesque elit vehicula in. Duis luctus finibus mattis. Proin mattis risus imperdiet, scelerisque leo eget, ullamcorper nisl. Etiam egestas vitae lectus vitae efficitur. Praesent lorem metus, mollis ut mollis non, egestas laoreet est. In at dolor ultrices, dapibus lectus sit amet, gravida dolor. Duis ac auctor libero. Aliquam non sagittis augue, quis ultrices quam.</p>

					<div class="row no-gutter">
						<div class="col-6">
							<div class="row pt-2 pb-2">
								<div class="col-10">
									<h5>Client Invoices</h5>
								</div>
								<div class="col-2">
									<button class="btn btn-success"> Add </button>
								</div>
							</div>
							<table class="table table-striped">
		      					<thead>
			                		<tr>
					                  	<th>Date</th>
					                  	<th>Amount</th>
					                  	<th>Paid</th>
					                  	<th>Date Recieved</th>
					                  	<th>Action</th>
					                </tr>
			              		</thead>
			              		<tbody>
			                		<tr>
					                	<td>01-01-2018</td>
					                  	<td>$4000.00</td>
					                  	<td><i class="fa fa-check-circle-o fa-lg" aria-hidden="true"></i></td>
					                  	<td>01-27-2018</td>
					                  	<td>Edit</td>
					                </tr>
					                <tr>
					                	<td>03-28-2018</td>
					                  	<td>$4000.00</td>
					                  	<td></td>
					                  	<td></td>
					                  	<td>Edit</td>
					                </tr>
					            </tbody>
					        </table>

						</div>
						<div class="col-sm-6">
							<div class="row pb-2 pt-2">
								<div class="col-10">
									<h5>Consultant Invoices</h5>
								</div>
								<div class="col-2">
									<button class="btn btn-success"> Add </button>
								</div>
							</div>


								<table class="table table-striped">
			      					<thead>
				                		<tr>
						                  	<th>Date</th>
						                  	<th>Amount</th>
						                  	<th>Paid</th>
						                  	<th>Date Recieved</th>
						                  	<th>Action</th>
						                </tr>
				              		</thead>
				              		<tbody>
				                		<tr>
						                	<td>01-01-2018</td>
						                  	<td>$4000.00</td>
						                  	<td><i class="fa fa-check-circle-o fa-lg" aria-hidden="true"></i></td>
						                  	<td>01-27-2018</td>
						                  	<td>Edit</td>
						                </tr>
						                <tr>
						                	<td>03-28-2018</td>
						                  	<td>$4000.00</td>
						                  	<td></td>
						                  	<td></td>
						                  	<td>Edit</td>
						                </tr>
						            </tbody>
						        </table>
						</div>
						</div>
					</div>
			  	</div>
			</div>
        </main>
    </div>		
</div>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 
?>