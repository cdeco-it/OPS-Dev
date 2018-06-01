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
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.work.phases.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.milestones.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.delays.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.discussions.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.team.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.consultants.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/j/class.j.actions.php');
	$helper = new Helper();
	$w = new Work();
	$j = new workPhases();
	$jM = new j_WorkMilestones();
	$jD = new j_WorkDelays();
	$jDi = new j_WorkDiscussions();
	$jT = new j_WorkTeam();
	$jC = new j_WorkConsultants();
	$jA = new j_WorkActions();

	$w->loadEntry(1);

	$j->loadEntry($w->getJID(), 'j');
?>

<!-- BODY -->
<!--
<div class="container-fluid">
	<div class="container-fluid no-gutters pt-2 pb-2">
-->

<div class="container-fluid">
    <div class="row">
        <main role="main" class="col px-4">
        	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            	<h2><?php echo $w->generateFormalNumber($w->getYear(), $w->getWorkNumber()); ?> ::: <?php echo $w->getTitle(); ?></h2>
            	<div class="btn-toolbar mb-2 mb-md-0">
              		<div class="btn-group">
                		<button class="btn btn-secondary">Export</button> 
                		<?php
							if($level <= 1){
								echo '<a href="#" name="edit_j" id="edit_j" data-toggle="modal" data-target="#editj" class="btn btn-primary">Edit</a>';
							}
						?>
              		</div>
            	</div>
          	</div>

			
			<div class="row mb-3 bottom-border">
				<div class="col-2">
					<h5>Status</h5>
					<div>
						<?php echo $j->getStatusDesc(); ?>
					</div>
				</div>
				
				<div class="col-10">
					<h5>Percent Complete</h5>
					<div class="progress">
						<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">75%</div>
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
										echo '<a href="#" name="add_milestone" id="add_milestone" data-toggle="modal" data-target="#addMilestone" class="btn btn-success ">Add</a>';
									}
									?>
			              		</div>
			            	</div>
			          	</div>
						<?php
							$result = $jM->getMilestones(1);
							if(!is_null(($result))){
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
		              			foreach($result as $row){
		              				echo '<tr>
		              						<td>'.$row['DESCRIPTION'].'</td>
		              						<td>'.$helper->date_toStandard($row['VALUE']).'</td>';
		              				
		              				if($row['REMAINING'] < 0){
		              					echo '<td> Deadline past </td>';
		              				}else{
		              					echo '<td>'.$row['REMAINING'].' days remain</td>';
		              				}

		              				echo '<td>
		              						<button type="button" id="m_editButton'.$i.'" class="m_editButton btn btn-info btn-xs" value='.$row['UID'].'>Edit</button> 
		              						<button type="button" id="m_delButton'.$i.'" class="m_delButton btn btn-danger btn-xs" value='.$row['UID'].'>Delete</button>
		              					</td>
		              					</tr>';
		              				$i++;	
		              			}

		              			echo '
			              				</tbody>
		        					</table>
	        					</div>';
							}else{
								echo 'No milestones defined.';
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
									if(!is_null($result)){
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
				              			foreach($result as $row){
				              				echo '<tr>
			              						<td>'.$row['NAME'].'</td>';
			              						if(!is_null($row['LEADER']) && $row['LEADER'] === 1){
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
				              			echo '
				              					</tbody>
			        						</table>
			        					</div>';
									}else{
										echo 'No internal team defined.';
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
									if(!is_null($result)){
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
				              			foreach($result as $row){
				              				echo '<tr>
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
				              			echo '
				              					</tbody>
			        						</table>
			        					</div>';
									}else{
										echo 'No external consultants defined.';
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
							if(!is_null($result)){
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
		              			foreach($result as $row){
		              				echo '<tr>
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
		              			echo '
		              					</tbody>
	        						</table>
	        					</div>';
	              			}else{
	              				echo 'No discussions entered.';
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
							if(!is_null($result)){
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
			              		foreach($result as $row){
		              				echo '<tr>
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
								echo $result;
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
							if(!is_null($result)){
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
			              		foreach($result as $row){
		              				echo '<tr>
		              						<td>';
		              						if($row['CAUSE'] = 0){
		              							echo 'Interal Issue';
		              						}else{
		              							echo 'External Issue';
		              						}
		              				echo '	</td>	
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
								echo $result;
							}
						?>
					</div>
<!-- END DELAYS -->
<!-- ACCOUNTING -->
					<div class="tab-pane" id="accounting" role="tabpanel">
						<div class="d-flex justify-content-between flex-wrap  align-items-center pt-3 pb-2 mb-2 ">
			            	<h5>Accounting</h5>
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
					</div>
<!-- END ACCOUNTING -->
<!-- !TAB -->
				</div>
<!-- END -->
	    	</div>	
        </main>
    </div>
</div>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 
	unset($work, $helper, $db, $jM, $jD, $jDi, $jT, $jC, $jA);
?>