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

    </head>

    <style>
    	ul.ui-autocomplete {
		    z-index: 1500;
		}
	</style>
	<body>
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
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.address.php');
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
	$addr = new Address();
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


<div class="container-fluid">
	<div class="alert alert-danger collapse pt" id="error">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>

    <div class="alert alert-success collapse pt-2" id="success">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>

	<div class="container-fluid">
		<div class="row pt-3 mb-3 border-bottom">
			<div class="col-lg-10">
				<h2>
					<?php echo $w->generateFormalNumber($w->getYear(), $w->getWorkNumber()); ?> ::: <?php echo $w->getTitle(); ?>
					
				</h2>
			</div>
			<div class="col-sm pt-1 text-right">
				<div class="btn-toolbar mb-2 mb-md-0">
					<div class="btn-group">
		        		<button class="btn btn-info">PDF</button> 
		        		<button class="btn btn-warning"><i class="fas fa-print"></i></button>
		        		<?php
							if($level <= 1){
								echo '<button class="btn btn-primary" name="edit_j" id="edit_j" data-toggle="modal" data-target="#j_edit"><i class="fas fa-edit"></i></button>';
							}
						?>
		      		</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row pt-3 ">
			<div class="col-2 border-right">
				<h5>Status</h5>
				<div>
					<?php echo $j->getStatusDesc(); ?>
				</div>
			</div>
			<div class="col-3 border-right">
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
			<div class="col-3 border-right">
				<h5>Client/POC</h5>
				<div>
					<?php 
						if(!is_null($w->getClient())){
							$clientId = $w->getClient();
							$addr->getEntry($clientId);
							echo($addr->getOrganization()).'<br />';
						}else{
							echo "No client defined<br />";
						}

						if(!is_null($w->getClientRep())){
							$pocId = $w->getClientRep();
							$addr->getEntry($pocId);
							$pocArray = $addr->getName();
							echo $pocArray['first'].' '.$pocArray['last'];
						}else{
							echo "No Point of Contact defined";
						}
					?>
				</div>
			</div>
			<div class="col">
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
	</div>

	<div class="container-fluid">
		<div class="row pt-3 mb-3">
			<div class="col-2">
				<h5>Milestones</h5>
				<div class="row" id="milestones">
					<?php
						$milestones = $jM->getMilestones($jid);
						if($milestones['success']){
					        if($milestones['message'] === SUCCESS){
					        	echo '<table class="table table-sm table-hover">';
					        	foreach($milestones['updateInfo'] as $row){
					        		echo '
					        			<tr>
					        				<td width="60%" class="align-middle">'.$row['DESCRIPTION'].'</td>
											<td width="30%"  class="align-middle"  title="';
											if($row['REMAINING'] < 0){
												echo abs($row['REMAINING']).' days ago.">'.$helper->date_toStandard($row['VALUE']).'</td>';
											}if($row['REMAINING'] > 0){
												echo $row['REMAINING'].' days remain">'.$helper->date_toStandard($row['VALUE']).'</td>';
											}else{
												echo 'Due today">'.$helper->date_toStandard($row['VALUE']).'</td>';
											}
											
									if($level <= 1){
										echo '
										<td width="10%" class="align-middle"">
											<button class="deleteMilestone btn btn-danger btn-xs" name="mid" value="'.$row['UID'].'" jid="'.$jid.'">
												<i class="fas fa-ban"></i>
											</button>
										</td>';
									}
									echo '</tr>';
					        	}
					        	echo '</table>';
					        }else{
					        	echo '<div class="col">'.$milestones['message'].'</div>';
					        }
					    }else{
					    	echo '<div class="col">'.$milestones['message'].'</div>';
					    }
					?>
				</div>
				<div class="row pt-2">
					<?php
						if($level <= 1){
						echo '<br/><button" name="add_milestone" id="add_milestone" data-toggle="modal" data-target="#j_add_milestone" class="btn btn-success btn-block ">Add Milestone</button>';
						}
					?>
				</div>
			</div>
			
			<div class="col-10">
				<ul class="nav nav-tabs">
					
				  	<li class="nav-item">
				 		<a class="nav-link active" data-toggle="tab" role="tab" href="#scope">Scope of Work</a>
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

				<!-- BEGIN CONTENT OF TABS -->
				<div class="tab-content">
				
				<!-- SCOPE --->
					<div class="tab-pane active" id="scope" role="tabpanel">
						<div class="row">
							<div class="col">
		      					<?php echo $j->getSOW(); ?>
		      				</div>
		      			</div>
					</div>

				<!-- INTERNAL TEAM -->
					<div class="tab-pane" id="team" role="tabpanel">
						<div class="row">
							<div class="col-sm-6 pt-2 pb-2">
								<div class="row pt-2 pb-2">
									<div class="col">
										<h5>Internal Team</h5>
									</div>
									<div class="col-12 col-md-auto">
										<?php
											if($level <= 1){
												echo '<button" name="add_int_team" id="add_int_team" data-toggle="modal" data-target="#j_add_internal_team" class="btn btn-success btn-block ">Add</button>';
											}
										?>
									</div>
								</div>
								<div id="internal_team">
									<?php
									$result = $jT->getTeam($jid);
									if($result['success']){
					          			if($result['message'] === SUCCESS){
					          				echo '
											<div class="table-responsive">
						        				<table class="table table-sm table-hover">
						           					<thead>
									               		<tr>
										                   	<th width="35%">Name</th>
										                  	<th width="35%">Role</th>
										                   	<th width="10%">Lead</th>';
										    if($level <= 1){
										    	echo '<th width="20%"></th>';
										    }
										    echo '</tr>
								               		</thead>
								  	         		<tbody>';

							     			// $i = 1;	
					          				foreach($result['updateInfo'] as $row){
					          					echo '<tr>
				      	         						<td class="align-middle">'.$row['NAME'].'</td>
				      	         						<td class="align-middle">'.$row['ROLE'].'</td>';
				              						if(!is_null($row['LEAD']) && $row['LEAD'] == 1){
				              							echo '<td class="align-middle"><i class="fas fa-check"></i></td>';
				              						}else{
				              							echo '<td></td>';
				              						}
				              					echo '<td class="align-middle" align="right">';
				              						if($level <= 1){
				              							echo '<button type="button" class="deleteInternalTeam btn btn-danger btn-xs" value='.$row['ID'].' jid="'.$jid.'"><i class="fas fa-ban"></i></button>';
					              					}
						              			echo '			
					              						</td>
					              					</tr>';
					              				// $i++;
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
				<!-- EXTERNAL TEAM -->
							<div class="col-sm-6 pt-2 pb-2">
								<div class="row pt-2 pb-2">
									<div class="col">
										<h5>External Team</h5>
									</div>
									<div class="col-12 col-md-auto">
										<?php
											if($level <= 1){
												echo '<a href="#" name="add_ext_team" id="add_consultant" data-toggle="modal" data-target="#j_add_external_team" class="btn btn-success ">Add</a>';
											}
										?>
									</div>
								</div>
								<div id="external_team">
									<?php
									$result = $jC->getConsultants($jid);
									if($result['success']){
					          			if($result['message'] === SUCCESS){
					          				echo '
											<div class="table-responsive">
						        				<table class="table table-sm table-hover">
						          					<thead>
								                		<tr>
										                  	<th width="30%">Firm</th>
										                  	<th width="30%">Name</th>
										                  	<th width="20%">Role</th>
										                  	<th width="20%"></th>
										                </tr>
								              		</thead>
								              		<tbody>';

					          				foreach($result['updateInfo'] as $row){
					          					echo '
					          					<tr>
			              							<td>'.$row['ORG'].'</td>
			              							<td>'.$row['NAME'].'</td>
			              							<td>'.$row['ROLE'].'</td>';
			              						
			              					echo '<td class="align-middle" align="right">';
			              							echo '<button type="button" class="viewExternalTeam btn btn-info btn-xs" value='.$row['ADDR_ID'].'><i class="far fa-address-card"></i></button> ';

			              						if($level <= 1){
			              							
			              							echo '<button type="button"  class="deleteExternalTeam btn btn-danger btn-xs" value='.$row['ID'].' jid="'.$jid.'"><i class="fas fa-ban"></i></button>';
				              					}
					              			echo '			
				              						</td>
				              					</tr>';	
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
					</div>
				<!-- DISCUSSIONS -->
					<div class="tab-pane" id="discussions" role="tabpanel">
						<div class="col pt-2 pb-2">
							<div class="row pt-2 pb-2">
								<div class="col">
									<h5>Project Discussion Log</h5>
								</div>
								<div class="col-12 col-md-auto">
									<?php
										if($level <= 1){
											echo '<a href="#" name="add_discussion" id="add_discussion" data-toggle="modal" data-target="#j_add_discussion" class="btn btn-success">Add</a>';
										}
									?>
								</div>
							</div>

							<div class="row">
								<div class="col" id="discussion_entries">

			      					<?php

			      						$result = $jDi->getDiscussions($jid);
			      						if($result['success']){
			      							if($result['message'] === SUCCESS){
			      								$i = count($result['updateInfo']);
			      								echo '
												<div class="table-responsive">
							        				<table class="table table-hover">
							          					<thead>
									                		<tr>
											                  	<th width="5%">#</th>
											                  	<th width="5%">Date Entered</th>
											                  	<th width="5%">Last Updated</td>
											                  	<th width="70%">Discussion</th>';
											    if($level <= 1){
											    	echo '<th width="15%"></th>';
											    }
											                  	
											            echo '</tr>
									              		</thead>
									              	<tbody>';
			      								foreach($result['updateInfo'] as $row){
			      									echo '<tr>
			      											<td>'.$i.'</td>
			      											<td>'.$row['work_j_discussions_created'].'</td>
			      											<td>'.$row['work_j_discussions_updated'].'</td>
			      											<td>'.$row['work_j_discussions_entry'].'</td>';
			      									if($level <= 1){
			      										echo '<td class="align-middle" align="right">
																<button type="button" class="editDiscussion btn btn-info btn-xs" value='.$row['work_j_discussions_id'].'>
								<i class="fas fa-edit"></i>
							</button> 

								<button type="button" class="deleteDiscussion btn btn-danger btn-xs" value='.$row['work_j_discussions_id'].' jid="'.$jid.'"><i class="fas fa-trash-alt"></i></i></button>
			      												</td>';
			      									}

			      									echo '</tr>';
			      									$i--;
			      								}

			      								echo '</tbody>
			      									</table>';
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

					




				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript" src="inc.j.work.js"></script>

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
                      	<textarea type="text" name="j_sow" id="j_sow" class="tinymce form-control" required />
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

                      	<input type="hidden" name="j_id" id="j_id" value="<?php echo $jid; ?>"/>
                      	<input type="hidden" name="p_id" id="p_id" value="<?php echo $pid; ?>"/>  

                      	<input type="submit" name="j_ms_add" id="j_ms_add" value="Add Milestone" class="btn btn-success" />

                     </form>  
                </div>  
        	</div>  
      	</div>  
    </div>
    <!-- END ADD MILESTONE MODAL -->

    <!-- ADD INTERNAL TEAM MODAL -->
	<div id="j_add_internal_team" class="modal fade">
    	<div class="modal-dialog modal-lg">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <h4 class="modal-title">Add Internal Team Member</h4>
                     <a href="#" class="close" data-dismiss="modal">&times;</a>
                </div>  

                <div class="modal-body">  
                    <form method="post" id="j_add_internal_team_form" data-toggle="validator" role="form">
                 		<div class="int_team">
                 			<div class="form-row" id="int_team_content_1">
                 				<div class="form-group col-4">
									<label for="j_team_employee">Employee</label>
									<select name="j_int_team[1][name]" id="j_team_employee" class="form-control">
		                      			<?php echo $helper->populateEmployeeNames(); ?>
		                      		</select>
		                      	</div>
		                      	<div class="form-group col-4">
		                      		<label for="j_team_employee_role">Role</label>
		                      		<select name="j_int_team[1][role]" id="j_team_employee_role" class="form-control">
		                      			<?php echo $helper->populateCommonRoles(); ?>
		                      		</select>
		                      	</div>
		                      	<div class="form-group col-2">
		                      		<label for="j_team_employee_lead">Lead</label>
		                      		<select name="j_int_team[1][lead]" id="j_team_employee_lead" class="form-control">
		                      			<?php echo $helper->populateYesNo(); ?>
		                      		</select>
		                      	</div>
		                      	<div class="form-group col-2">
		                      		<label for="del_int_team_row">Action</label><br />
									<button name="del_int_team_row" class="del_int_team_row btn btn-danger" id="del_int_team_row" value="1"><i class="fas fa-times"></i></button>
		                      	</div>
		                    </div>
	                 	</div>
                      	
                      	<br />
                      	<div class="help-block with-errors"></div>
                      	<br />

                      	<input type="hidden" name="j_id" id="j_id" value="<?php echo $jid; ?>"/>
                      	<input type="hidden" name="p_id" id="p_id" value="<?php echo $pid; ?>"/>  
						<div class="btn-group">
	                      	<button name="expand_int_team" class="expand_int_team btn btn-warning">Add Additional Memeber</button>
	                      	<input type="submit" name="j_interal_team_add" id="j_internal_team_add" value="Add To Team" class="btn btn-success" />
						</div>
                     </form>  
                </div>  
        	</div>  
      	</div>
    </div>
    <!-- END ADD INTERNAL MODAL -->

    <!-- ADD EXTERNAL TEAM MODAL -->
	<div id="j_add_external_team" class="modal fade">
    	<div class="modal-dialog modal-lg">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <h4 class="modal-title">Add External Team Member</h4>
                     <a href="#" class="close" data-dismiss="modal">&times;</a>
                </div>  

                <div class="modal-body">  
                	<p><strong>NOTE:</strong> You MUST use a suggested name from the address book before adding the individual to the external team. As you type in the name, select the suggestion below to select the individual.</p>
                    <form method="post" id="j_add_external_team_form" data-toggle="validator" role="form">
                 		<div class="ext_team">
                 			<div class="form-row" id="ext_team_content">
                 				<div class="form-group col-4">
									<label for="j_team_ext_member">Name</label>
									<input type="text" name="j_ext_member_name" id="j_ext_name" class="form-control"></input>
									<input type="hidden" name="j_ext_member_name_id" id="j_ext_member_name_id">
		                      	</div>
		                      	<div class="form-group col-4">
									<label for="j_team_ext_org">Organization</label>
									<input type="text" name="j_ext_team_org" id="j_ext_team_org" class="form-control" READONLY></input>
									<input type="hidden" name="j_ext_org_name_id" id="j_ext_org_name_id">
		                      	</div>
		                      	<div class="form-group col-4">
		                      		<label for="j_team_ext_role">Role</label>
		                      		<select name="j_ext_role" id="j_ext_role" class="form-control">
		                      			<?php echo $helper->populateCommonRoles(); ?>
		                      		</select>
		                      	</div>
		                    </div>
	                 	</div>
                      	
                      	<br />
                      	<div class="help-block with-errors"></div>
                      	<br />

                      	<input type="hidden" name="j_id" id="j_id" value="<?php echo $jid; ?>"/>
                      	<input type="hidden" name="p_id" id="p_id" value="<?php echo $pid; ?>"/>  
						<div class="btn-group">
	                      	<input type="submit" name="j_external_team_add" id="j_external_team_add" value="Add To Team" class="btn btn-success" DISABLED />
						</div>
                     </form>  
                </div>  
        	</div>  
      	</div>
    </div>
    <!-- END ADD EXTERNAL MODAL -->

    <!-- DISCUSSION MODAL -->
    <div id="j_add_discussion" class="modal fade">
    	<div class="modal-dialog modal-lg">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <h4 class="modal-title">Add Disussion to Project</h4>
                     <a href="#" class="close" data-dismiss="modal">&times;</a>
                </div>  

                <div class="modal-body">  
                    <form method="post" id="j_add_discussion_form" data-toggle="validator" role="form">

                      	<textarea type="text" name="j_add_disc" id="j_add_disc" class="tinymce form-control" required />

                      	</textarea>
                      	<br /> 

                      	<input type="hidden" name="j_id" id="j_id" value="<?php echo $jid; ?>"/><input type="hidden" name="p_id" id="p_id" value="<?php echo $pid; ?>"/>

                      	<input type="submit" name="j_add_disc_btn" id="j_add_disc_btn" value="Insert Discussion" class="btn btn-success" />

                     </form>  
                </div>  
        	</div>  
      	</div>  
    </div>
    <!-- END DISCUSSION MODAL -->


<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 
	unset($work, $helper, $db, $jM, $jD, $jDi, $jT, $jC, $jAm, $jSr, $jAcct, $addr);
?>
