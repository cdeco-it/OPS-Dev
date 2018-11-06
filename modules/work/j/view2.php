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


<div class="container-fluid">
	<div class="alert alert-danger collapse" id="error">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>

    <div class="alert alert-success collapse" id="success">
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
											<td width="30%"  class="align-middle"  title="'.$row['REMAINING'].' days remain">'.$helper->date_toStandard($row['VALUE']).'</td>';
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
				<div class="row">
					<?php
						if($level <= 1){
						echo '<button" name="add_milestone" id="add_milestone" data-toggle="modal" data-target="#j_add_milestone" class="btn btn-success btn-block ">Add Milestone</button>';
						}
					?>
				</div>
			</div>
			
			<div class="col-10">
				<ul class="nav nav-tabs">
					
				  	<li class="nav-item">
				 		<a class="nav-link active" data-toggle="tab" role="tab" href="#team">Team</a>
				  	</li>
				  	<li class="nav-item">
				 		<a class="nav-link" data-toggle="tab" role="tab" href="#scope">Scope of Work</a>
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
				
				<!-- TEAM -->
					<div class="tab-pane active" id="team" role="tabpanel">
						<div class="row">
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


					<!-- SCOPE --->
					<div class="tab-pane" id="scope" role="tabpanel">
						<div class="row">
							<div class="col">
		      					<?php echo $j->getSOW(); ?>
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

                      	<input type="hidden" name="j_id" id="j_id" value="<?php echo $jid; ?>"/>
                      	<input type="hidden" name="p_id" id="p_id" value="<?php echo $pid; ?>"/>  

                      	<input type="submit" name="j_ms_add" id="j_ms_add" value="Add Milestone" class="btn btn-success" />

                     </form>  
                </div>  
        	</div>  
      	</div>  
    </div>
    <!-- END ADD MILESTONE MODAL -->


<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 
	unset($work, $helper, $db, $jM, $jD, $jDi, $jT, $jC, $jAm, $jSr, $jAcct);
?>
