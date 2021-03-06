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

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=s4dkk47wxltlkoe91dill48cz6m4a3ttnhpntfa3lt5gpjk0"></script> 

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

	//Check if PID and JID is passed correctly...if not, die.
	if(!isset($_GET['jid']) && !isset($_GET['pid'])){
		die(E_NO_ID);
	}else{
		$pid = $_GET['pid'];
		$jid = $_GET['jid'];
	}

	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.work.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.work.phases.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.milestones.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.delays.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.discussions.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.team.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.consultants.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.actions.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.subsrfi.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.manhours.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.accounting.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.accounting.inv.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.accounting.subs.inv.php');
	$helper = new Helper();
	$w = new Work();
	$j = new WorkPhases();
	$jM = new j_WorkMilestones();
	$jD = new j_WorkDelays();
	$jDi = new j_WorkDiscussions();
	$jT = new j_WorkTeam();
	$jC = new j_WorkConsultants();
	$jA = new j_WorkActions();
	$jSr = new j_WorkSubsRfis();
	$jMan = new j_WorkManHours();
	$jAcct = new j_WorkAccounting();
	$jAcctInv = new j_WorkAccountingInv();
	$jAcctInv = new j_WorkAccountingSubsInv();

	//Pass parent id to load master info
	$w->loadEntry($pid);

	//Pass wID
	//$j->loadEntry($w->getJID(), 'j');
	$j->loadEntry($jid, 'j');
?>

<!-- BODY -->
<!--
<div class="container-fluid">
	<div class="container-fluid no-gutters pt-2 pb-2">
-->

<div class="container-fluid">

	<div class="alert alert-danger collapse" id="error">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>

    <div class="alert alert-success collapse" id="success">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>

    <div class="row">
        <main role="main" class="col px-4">
        	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            	<h2><?php echo $w->generateFormalNumber($w->getYear(), $w->getWorkNumber()); ?> ::: <?php echo $w->getTitle(); ?></h2>
            	<div class="btn-toolbar mb-2 mb-md-0">
              		<div class="btn-group">
                		<button class="btn btn-info">PDF</button> 
                		<button class="btn btn-warning">Print</button>
                		<?php
							if($level <= 1){
								echo '<a href="#" name="edit_j" id="edit_j" data-toggle="modal" data-target="#j_edit" class="btn btn-primary">Edit</a>';
							}
						?>
              		</div>
            	</div>
          	</div>

			
			<div class="row mb-3 bottom-border">
				<div class="col-1 border-right">
					<h5>Status</h5>
					<div>
						<?php echo $j->getStatusDesc(); ?>
					</div>
				</div>
				<div class="col-2 border-right">
					<h5>Associated Numbers</h5>
					<div>
						<?php 
							if(!is_null($j->getAssocNum())){
								echo $j->getAssocNum();
							}else{
								echo "None defined";
							}
						?>
					</div>
				</div>
				
				<div class="col-9">
					<h5>Percent Complete</h5>
					<div class="progress" style="height: 30px;">
						<?php
								$percent = ($j->getPercentComplete());
							echo '<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width:'.$percent.'%;" aria-valuenow="'.$percent.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percent.';">'.$percent.'%</div>
							';
						?>
					</div>
				</div>
			</div>

			<div name="details">
				<ul class="nav nav-tabs">
					<li class="nav-item">
				 		<a class="nav-link active" data-toggle="tab" role="tab" href="#scope">Scope of Work</a>
				  	</li>
					<li class="nav-item">
				 		<a class="nav-link" data-toggle="tab" role="tab" href="#milestones">Milestones</a>
				  	</li>
				  	<li class="nav-item">
				 		<a class="nav-link" data-toggle="tab" role="tab" href="#team">Team</a>
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
				
<!-- START TABS -->

				<div class="tab-content">
<!-- TABS -->
<!-- SCOPE --->
					<div class="tab-pane active" id="scope" role="tabpanel">
											
						<div class="row">
							<div class="col-sm-11 pt-2 pb-2">
								<h5>Scope of Work</h5>
							</div>
							<div class="col-sm pt-2 pb-2">
								
							</div>
						</div>
						<div class="row">
							<div class="col">
		      					<?php echo $j->getSOW(); ?>
		      				</div>
		      			</div>
					</div>
<!-- SCOPE -->
<!-- MILESTONES -->
					<div class="tab-pane" id="milestones" role="tabpanel">
						<div class="d-flex justify-content-between flex-wrap  align-items-center pt-3 pb-2 mb-2 ">
			            	<h5>Milestones</h5>
			            	<div class="btn-toolbar mb-2 mb-md-0">
			              		<div class="btn-group">
			                		<?php
										if($level <= 1){
										echo '<a href="#" name="add_milestone" id="add_milestone" data-toggle="modal" data-target="#j_add_milestone" class="btn btn-success ">Add</a>';
									}
									?>
			              		</div>
			            	</div>
			          	</div>
						<?php
							$result = $jM->getMilestones(1);
							if($result['success']){
			          			if($result['message'] === SUCCESS){
			          				echo '
									<div class="table-responsive">
			    	     				<table class="table table-striped">
			    	       					<thead>
							             		<tr>
								                  	<th width="60%">Event</th>
								                  	<th width="10%">Due Date</th>
								                   	<th width="10%">Days Remaining</th>
								                  	<th width="20%">Action</th>
								                 </tr>
					 	             		</thead>
				   	            		<tbody>';
					     			$i = 1;	
			          				foreach($result['updateInfo'] as $row){
			          					echo '<tr>
		    	          						<td>'.$row['DESCRIPTION'].'</td>
		       		       						<td>'.$helper->date_toStandard($row['VALUE']).'</td>';

			              				if($row['REMAINING'] < 0){
			              					echo '<td> Deadline past </td>';
			              				}else{
			              					echo '<td>'.$row['REMAINING'].' days remain</td>';
			              				}

			              				echo '<td>';

		              						if($level <= 1){
		              							echo '
												<button type="button" id="m_editButton'.$i.'" class="m_editButton btn btn-info btn-xs" value='.$row['UID'].'>Edit</button> 
			              						<button type="button" id="m_delButton'.$i.'" class="m_delButton btn btn-danger btn-xs" value='.$row['UID'].'>Delete</button>';
			              					}
					              		echo '</td>
				              				</tr>';
				              			$i++;	
			              			}
			              		echo '</tbody>
			              			</table>
			              		</div>';
			          			}else{
			          				echo $result['message'];
			          			}
			          		}else{
			          			echo $result['message'];
			          		}		
						?>
					</div>
<!-- END MILESTONES -->
<!-- TEAM -->
					<div class="tab-pane" id="team" role="tabpanel">
						<div class="row border-bottom">
							<div class="col pt-2 pb-2">
								<div class="row pt-2 pb-2">
									<div class="col">
										<h5>Internal Team</h5>
									</div>
									<div class="col-12 col-md-auto">
										<?php
											if($level <= 1){
												echo '<a href="#" name="add_team" id="add_team" data-toggle="modal" data-target="#addTeam" class="btn btn-success ">Add</a>';
											}
										?>
									</div>
								</div>
								
									<?php
									$result = $jT->getTeam(1);
									if($result['success']){
					          			if($result['message'] === SUCCESS){
					          				echo '
											<div class="table-responsive">
						        				<table class="table table-striped">
						           					<thead>
									               		<tr>
										                   	<th width="10%">Employee</th>
										                  	<th width="25%">Team Leader</th>
										                   	<th width="10%">Action</th>
										                </tr>
								               		</thead>
								  	         		<tbody>';
							     			$i = 1;	
					          				foreach($result['updateInfo'] as $row){
					          					echo '<tr>
				      	         						<td>'.$row['NAME'].'</td>';
				              						if(!is_null($row['LEADER']) && $row['LEADER'] == 1){
				              							echo '<td><i class="fas fa-check"></i></td>';
				              						}else{
				              							echo '<td></td>';
				              						}
				              					echo '<td>';
				              						if($level <= 1){
				              							echo '<button type="button" id="t_editButton'.$i.'" class="t_editButton btn btn-info btn-xs" value='.$row['ID'].'>Edit</button> 
					              						<button type="button" id="t_delButton'.$i.'" class="t_delButton btn btn-danger btn-xs" value='.$row['ID'].'>Delete</button>';
					              					}
						              			echo '			
					              						</td>
					              					</tr>';
					              				$i++;
					              			}
					              		echo '</tbody>
					              			</table>
					              		</div>';
					          			}else{
					          				echo $result['message'];
					          			}
					          		}else{
					          			echo $result['message'];
					          		}		
								?>
							</div>

							<div class="col-sm-6 pt-2 pb-2">
								<div class="row pt-2 pb-2">
									<div class="col">
										<h5>External Team</h5>
									</div>
									<div class="col-12 col-md-auto">
										<?php
											if($level <= 1){
												echo '<a href="#" name="add_consultant" id="add_consultant" data-toggle="modal" data-target="#addConsultant" class="btn btn-success ">Add</a>';
											}
										?>
									</div>
								</div>
								
								<?php
									$result = $jC->getConsultants(1);
									if($result['success']){
					          			if($result['message'] === SUCCESS){
					          				echo '
											<div class="table-responsive">
						        				<table class="table table-striped">
						          					<thead>
								                		<tr>
										                  	<th width="20%">Firm</th>
										                  	<th width="30%">Consultant</th>
										                  	<th width="30%">Role</th>
										                  	<th width="20%">Action</th>
										                </tr>
								              		</thead>
								              		<tbody>';
							     			$i = 1;	
					          				foreach($result['updateInfo'] as $row){
					          					echo '
					          					<tr>
			              							<td>'.$row['ORG'].'</td>
			              							<td>'.$row['NAME'].'</td>
			              							<td>'.$row['ROLE'].'</td>';
			              						
			              					echo '<td>';
			              						if($level <= 1){
			              							echo '<button type="button" id="c_editButton'.$i.'" class="c_editButton btn btn-info btn-xs" value='.$row['ID'].'>Edit</button> 
				              						<button type="button" id="c_delButton'.$i.'" class="c_delButton btn btn-danger btn-xs" value='.$row['ID'].'>Delete</button>';
				              					}
					              			echo '			
				              						</td>
				              					</tr>';
				              				$i++;	
					              			}
					              		echo '</tbody>
					              			</table>
					              		</div>';
					          			}else{
					          				echo $result['message'];
					          			}
					          		}else{
					          			echo $result['message'];
					          		}	
								?>
							</div>
						</div>
					</div>
<!-- END TEAM -->
<!-- DISCUSSIONS -->
					<div class="tab-pane" id="discussions" role="tabpanel">
						<div class="d-flex justify-content-between flex-wrap  align-items-center pt-3 pb-2 mb-2 ">
			            	<h5>Discussions</h5>
			            	<div class="btn-toolbar mb-2 mb-md-0">
			              		<div class="btn-group">
			                		<?php
									if($level <= 1){
										echo '<a href="#" name="add_milestone" id="add_milestone" data-toggle="modal" data-target="#addMilestone" class="btn btn-success ">Add</a>';
									}
									?>
			              		</div>
			            	</div>
			          	</div>
						<?php 
							$result = $jDi->getDiscussions(1);
							if($result['success']){
			          			if($result['message'] === SUCCESS){
			          				echo '
									<div class="table-responsive">
				        				<table class="table table-striped">
				          					<thead>
						                		<tr>
								                  	<th width="80%">Notes</th>
								                  	<th width="10%">Date</th>
								                  	<th width="10%">Action</th>
								                </tr>
						              		</thead>
						              		<tbody>';
					     			$i = 1;	
			          				foreach($result['updateInfo'] as $row){
			          					echo '
			          					<tr>
		              						<td>'.$row['work_j_discussions_entry'].'</td>
		              						<td>'.$helper->date_toStandard($row['work_j_discussions_created']).'</td>
		              						<td>';
		              						if($level <= 1){
			              						echo '<button type="button" id="di_editButton'.$i.'" class="di_editButton btn btn-info btn-xs" value='.$row['DELAY_ID'].'>Edit</button> ';
			              					}
		              				echo '	</td>
		              					</tr>';
		              				$i++;	
			              			}
				              		echo '</tbody>
				              			</table>
				              		</div>';
			          			}else{
			          				echo $result['message'];
			          			}
			          		}else{
			          			echo $result['message'];
			          		}	
				        ?>
					</div>
<!-- END DISCUSSIONS -->
<!-- ACTIONS -->
					<div class="tab-pane" id="actions" role="tabpanel">
						<div class="d-flex justify-content-between flex-wrap  align-items-center pt-3 pb-2 mb-2 ">
			            	<h5>Action Log/Assignments</h5>
			            	<div class="btn-toolbar mb-2 mb-md-0">
			              		<div class="btn-group">
			                		<?php
									if($level <= 1){
										echo '<a href="#" name="add_milestone" id="add_milestone" data-toggle="modal" data-target="#addMilestone" class="btn btn-success ">Add</a>';
									}
									?>
			              		</div>
			            	</div>
			          	</div>
						<?php
							$result = $jA->getActions(1);
							if($result['success']){
			          			if($result['message'] === SUCCESS){
			          				echo '
									<div class="table-responsive">
				        				<table class="table table-striped">
				          					<thead>
						                		<tr>
								                  	<th width="20%">Task</th>
								                  	<th width="10%">Assigned To</th>
								                  	<th widht="10%">Date Assigned</th>
								                  	<th width="10%">Date Due</th>
								                  	<th width="10%">Days Remaining</th>
								                  	<th width="10%">Date Completed</th>
								                  	<th width="20%">Comments</th>
								                  	<th width="10%">Action</th>
								                </tr>
						              		</thead>
						              		<tbody>';
					     			$i = 1;	
			          				foreach($result['updateInfo'] as $row){
			          					echo '
			          					<tr>
		              						<td>'.$row['TASK'].'</td>
		              						<td>'.$row['EMP_NAME'].'</td>
		              						<td>'.$helper->date_toStandard($row['DATE_ASSIGNED']).'</td>
		              						<td>'.$helper->date_toStandard($row['DATE_DUE']).'</td>
		              						<td>'.$row['REMAIN'].' days</td>
		              						<td>'.$row['DATE_COMP'].' days</td>
		              						<td>'.$row['COMMENTS'].' days</td>
		              						<td>';
		              						if($level <= 1){
		              							echo '<button type="button" id="act_editButton'.$i.'" class="act_editButton btn btn-info btn-xs" value='.$row['ACT_ID'].'>Edit</button> 
			              						<button type="button" id="act_delButton'.$i.'" class="act_delButton btn btn-danger btn-xs" value='.$row['ACT_ID'].'>Delete</button>';
		              						}
					              		echo '			
				              					</td>
				              				</tr>';
				              			$i++;
			              			}
				              		echo '</tbody>
				              			</table>
				              		</div>';
			          			}else{
			          				echo $result['message'];
			          			}
			          		}else{
			          			echo $result['message'];
			          		}	
						?>
					</div>
<!-- END ACTIONS -->
<!-- SUBSRFI -->	
					<div class="tab-pane" id="subsrfi" role="tabpanel">
						<div class="d-flex justify-content-between flex-wrap  align-items-center pt-3 pb-2 mb-2 ">
			            	<h5>Submittal / RFI Log</h5>
			            	<div class="btn-toolbar mb-2 mb-md-0">
			              		<div class="btn-group">
			                		<?php
									if($level <= 1){
										echo '<a href="#" name="add_subrfi" id="add_subrfi" data-toggle="modal" data-target="#addSubrfi" class="btn btn-success">Add</a>';
									}
									?>
			              		</div>
			            	</div>
			          	</div>
			          	<?php
			          		$result = $jSr->getAllEntries(1);
			          		if($result['success']){
			          			if($result['message'] === SUCCESS){
			          				echo '
									<div class="table-responsive">
			     						<table class="table table-striped">
			    	     					<thead>
							              		<tr>
								                  	<th width="10%">Type</th>
								                  	<th width="10%">Internal #</th>
									               	<th width="10%">External #</th>
								                  	<th width="35%">Subject</th>
								                  	<th widht="10%">Status</th>
								                  	<th width="10%">Due Date</th>
								                  	<th width="15%">Action</th>
								                </tr>
					  		           		</thead>
					              		<tbody>';
					     			$i = 1;	
			          				foreach($result['updateInfo'] as $row){
			          					echo '
			          						<tr>
		     	    							<td>';
			              						if($row['TYPE'] == 0){
			              							echo 'Submittal';
			              						}elseif($row['TYPE'] == 1){
			              							echo 'RFI';
			              						}elseif($row['TYPE'] == 2){
			              							echo 'Pay Application';
			              						}
		              					echo '	</td>
		              							<td>'.$row['INT_TRACK'].'</td>
		              							<td>'.$row['EXT_TRACK'].'</td>
												<td>'.$row['SUBJECT'].'</td>
		              							<td>';
		              							if($row['STATUS'] == 0){
		              								echo 'Closed';
		              							}else{
		              								echo 'Open';
		              							}
		              					echo '	</td>
		              							<td>'.$helper->date_toStandard($row['DUE_DATE']).'</td>
		              							<td>';
			              						if($level <= 1){
			              							echo '
													<button type="button" id="rfi_viewButton'.$i.'" class="rfi_viewButton btn btn-dark btn-xs" value='.$row['ID'].'>View</button>
			              							<button type="button" id="rfi_editButton'.$i.'" class="rfi_editButton btn btn-info btn-xs" value='.$row['ID'].'>Edit</button> 
				              						<button type="button" id="rfi_delButton'.$i.'" class="rfi_delButton btn btn-danger btn-xs" value='.$row['ID'].'>Delete</button>';
			              						}
					              		echo '			
				              					</td>
				              				</tr>';
				              			$i++;	
			              			}
			              		echo '</tbody>
			              			</table>
			              		</div>';
			          			}else{
			          				echo $result['message'];
			          			}
			          		}else{
			          			echo $result['message'];
			          		}
			          	?>
					</div>
<!-- END SUBSRFI -->
<!-- DELAYS -->
					<div class="tab-pane" id="delays" role="tabpanel">
						<div class="d-flex justify-content-between flex-wrap  align-items-center pt-3 pb-2 mb-2 ">
			            	<h5>Delays</h5>
			            	<div class="btn-toolbar mb-2 mb-md-0">
			              		<div class="btn-group">
			                		<?php
									if($level <= 1){
										echo '<a href="#" name="add_delay" id="add_delay" data-toggle="modal" data-target="#addDelay" class="btn btn-success ">Add</a>';
									}
									?>
			              		</div>
			            	</div>
			          	</div>
						<?php
							$result = $jD->getDelays(1);
							if($result['success']){
			          			if($result['message'] === SUCCESS){
			          				echo '
									<div class="table-responsive">
				        				<table class="table table-striped">
				          					<thead>
						                		<tr>
								                  	<th width="10%">Cause</th>
								                  	<th width="25%">Event</th>
								                  	<th widht="25%">Justification</th>
								                  	<th width="10%">Original Date</th>
								                  	<th width="10%">Actual Date</th>
								                  	<th width="10%">Delay Total</th>
								                  	<th width="10%">Action</th>
								                </tr>
						              		</thead>
						              		<tbody>';
					     			$i = 1;	
			          				foreach($result['updateInfo'] as $row){
			          					echo '
			          					<tr>
		              						<td>';
		              						if($row['CAUSE'] = 0){
		              							echo 'Interal Issue';
		              						}else{
		              							echo 'External Issue';
		              						}
		              					echo '
		              						</td>	
		              						<td>'.$row['DESCRIPTION'].'</td>
		              						<td>'.$row['REASON'].'</td>
		              						<td>'.$helper->date_toStandard($row['ORIG_DATE']).'</td>
		              						<td>'.$helper->date_toStandard($row['ACT_DATE']).'</td>
		              						<td>'.$row['DIFF'].' days</td>
		              						<td>';

		              						if($level <= 1){
		              							echo '<button type="button" id="d_editButton'.$i.'" class="d_editButton btn btn-info btn-xs" value='.$row['DELAY_ID'].'>Edit</button> 
			              						<button type="button" id="d_delButton'.$i.'" class="d_delButton btn btn-danger btn-xs" value='.$row['DELAY_ID'].'>Delete</button>';
		              						}
				              		echo '			
			              					</td>
			              				</tr>';
			              			$i++;
			              			}
				              		echo '</tbody>
				              			</table>
				              		</div>';
			          			}else{
			          				echo $result['message'];
			          			}
			          		}else{
			          			echo $result['message'];
			          		}		
						?>
					</div>
<!-- END DELAYS -->
<!-- ACCOUNTING -->
					<div class="tab-pane" id="accounting" role="tabpanel">
						<div class="d-flex justify-content-between flex-wrap  align-items-center pt-3 pb-2 mb-2 border-bottom">
			            	<h5>Accounting</h5>
			            	<div class="btn-toolbar mb-2 mb-md-0">
			              		<div class="btn-group">
			                		<?php
									if($level <= 1){
										echo '<a href="#" name="add_milestone" id="add_milestone" data-toggle="modal" data-target="#addMilestone" class="btn btn-info ">Edit</a>';
									}
									?>
			              		</div>
			            	</div>
			          	</div>

			          	<?php
			          		$result = $jAcct->getEntry(1);
			          		if($result['success']){

			          		}else{
			          			echo $result['message'];
			          		}
			          	?>

			          	<div class="row">
							<div class="col-sm">
								<h6>Contract Amount:
								<?php  
									if(is_null($jAcct->getContractValue())){
										echo "Value not set";
									}else{
										echo "$".$jAcct->getContractValue();
									}
								?>
								</h6>
							</div>
							<div class="col-sm">
								<h6>T & M:
								<?php
									if(is_null($jAcct->getTimeMaterials())) {
										echo "Not defined";
									}elseif($jAcct->getTimeMaterials() == 0){
										echo "No";
									}else{
										echo "Yes";
									}
								?>
								</h6>
							</div>
			          	</div>
				
						<div class="d-flex justify-content-between flex-wrap  align-items-center pt-3 pb-2 mb-2 border-bottom">
			            	<h5>Modifications</h5>
			            	<div class="btn-toolbar mb-2 mb-md-0">
			              		<div class="btn-group">
			                		<?php
									if($level <= 1){
										echo '<a href="#" name="add_inv_milestone" id="add_inv_milestone" data-toggle="modal" data-target="#addInvMilestone" class="btn btn-success ">Add</a>';
									}
									?>
			              		</div>
			            	</div>
			          	</div>

			          	<div class="row">
			          		<div class="col">
								<!--content here -->
			          		</div>
			          	</div>


			          	<div class="d-flex justify-content-between flex-wrap  align-items-center pt-3 pb-2 mb-2 border-bottom">
			            	<h5>Hour Programming</h5>
			            	<div class="btn-toolbar mb-2 mb-md-0">
			              		<div class="btn-group">
			                		<?php
									if($level <= 1){
										echo '<a href="#" name="add_manhours" id="add_manhours" data-toggle="modal" data-target="#addManhours" class="btn btn-success ">Add</a>';
									}
									?>
			              		</div>
			            	</div>
			          	</div>

						<?php
							$result = $jMan->getManHours(1);
							if($result['success']){
			          			if($result['message'] === SUCCESS){
			          				

			          			}else{
			          				echo $result['message'];
			          			}
			          		}else{
			          			echo $result['message'];
			          		}		
						?>

						<div class="d-flex justify-content-between flex-wrap  align-items-center pt-3 pb-2 mb-2 border-bottom">
			            	<h5>Invoicing Information</h5>
			            	<div class="btn-toolbar mb-2 mb-md-0">
			              		<div class="btn-group">
			                	
			              		</div>
			            	</div>
			          	</div>
			          	
			          	<div class="row">
			          		<div class="col-sm">
			          			<div class="d-flex justify-content-between flex-wrap  align-items-center pt-3 pb-2 mb-2 border-bottom">
					            	<h6>Client Invoicing</h6>
					            	<div class="btn-toolbar mb-2 mb-md-0">
					              		<div class="btn-group">
					                		<?php
											if($level <= 1){
												echo '<a href="#" name="add_clientinv" id="add_clientinv" data-toggle="modal" data-target="#addClientInv" class="btn btn-success ">Add</a>';
											}
											?>
					              		</div>
					            	</div>
					          	</div>
			          		</div>

			          		<div class="col-sm">
			          			<div class="d-flex justify-content-between flex-wrap  align-items-center pt-3 pb-2 mb-2 border-bottom">
					            	<h6>Subconsultant Invoicing</h6>
					            	<div class="btn-toolbar mb-2 mb-md-0">
					              		<div class="btn-group">
					                		<?php
											if($level <= 1){
												echo '<a href="#" name="add_subinv" id="add_subinv" data-toggle="modal" data-target="#addSubInv" class="btn btn-success ">Add</a>';
											}
											?>
					              		</div>
					            	</div>
					          	</div>
			          		</div>
			          	</div>
					</div>
<!-- END ACCOUNTING -->
<!-- !TAB -->
				</div>
<!-- END -->
	    	</div>	
        </main>
    </div>

<!-- MODALS -->

	<!-- BASE INFO MODAL -->
    <div id="j_edit" class="modal fade">
    	<div class="modal-dialog modal-lg">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <h4 class="modal-title">Edit Base Information</h4>
                     <a href="#" class="close" data-dismiss="modal">&times;</a>
                </div>  

                <div class="modal-body">  
                    <form method="post" id="j_edit_form" data-toggle="validator" role="form">

                 		<label>Status</label>  
                      	<select name="j_status" id="j_status" class="form-control">
                      		<?php echo $helper->populateWorkStatus($j->getStatus()); ?>
                      	</select>
                      	<br />

                      	<label>Associated Numbers</label>  
                      	<input type="text" name="j_assocNum" id="j_assocNum" class="form-control" value="<?php echo $j->getAssocNum(); ?>" />  
                      	<div class="help-block with-errors"></div>
                      	<br />

                      	<label>Percent Complete</label>  
                      	<input type="text" name="j_percentComp" id="j_percentComp" class="form-control" value="<?php echo $j->getPercentComplete(); ?>" />  
                      	<br />  

                      	<label>Scope of Work</label>  
                      	<textarea type="text" name="j_sow" id="j_sow" class="form-control" required />
						<?php echo $j->getSOW(); ?>
                      	</textarea>

                      	<br /> 

                      	<input type="hidden" name="j_id" id="j_id" value="<?php echo $jid; ?>"/><input type="hidden" name="p_id" id="p_id" value="<?php echo $pid; ?>"/>  
                      	<input type="submit" name="j_update" id="j_update" value="Process Changes" class="btn btn-success" />

                     </form>  
                </div>  
        	</div>  
      	</div>  
    </div>
    <!-- END BASE INFO MODAL -->

    <!-- ADD MILESTONE MODAL -->
	<div id="j_add_milestone" class="modal fade">
    	<div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <h4 class="modal-title">Add Milestone</h4>
                     <a href="#" class="close" data-dismiss="modal">&times;</a>
                </div>  

                <div class="modal-body">  
                    <form method="post" id="j_add_milestone_form" data-toggle="validator" role="form">

                 		<label>Milestone</label>  
                      	<select name="j_milestone" id="j_milestone" class="form-control">
                      		<?php echo $helper->populateEngineeringMilestones(); ?>
                      	</select>
                      	<br />

                      	<label>Date</label>  
                      	<input type="text" name="j_milestone_date" id="j_milestone_date" class="form-control"  />  
                      	<div class="help-block with-errors"></div>
                      	<br />

                      	<input type="hidden" name="j_id" id="j_id" value="<?php echo $jid; ?>"/><input type="hidden" name="p_id" id="p_id" value="<?php echo $pid; ?>"/>  
                      	<input type="submit" name="j_ms_add" id="j_ms_add" value="Add Milestone" class="btn btn-success" />

                     </form>  
                </div>  
        	</div>  
      	</div>  
    </div>
    <!-- END ADD MILESTONE MODAL -->

</div>

<script type="text/javascript" src="inc.j.work.js"></script>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 
	unset($work, $helper, $db, $jM, $jD, $jDi, $jT, $jC, $jAm, $jSr, $jAcct);
?>