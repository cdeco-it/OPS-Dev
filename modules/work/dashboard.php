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
	$helper = new Helper();
	$w = new Work();
	$j = new workPhases();
	$jM = new j_WorkMilestones();
	$jD = new j_WorkDelays();
	$jDi = new j_WorkDiscussions();
	$jT = new j_WorkTeam();

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
    	<nav class="col-md-1.5 d-none d-md-block bg-light sidebar" style="position: absolute;
 height: 100%;">
        	<div class="sidebar-sticky" >
            	<ul class="nav flex-column">
            		 <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 ">
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

        <main role="main" class="col-md-10 ml-sm-auto col-lg-11 px-4">
        	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            	<h2><?php echo $w->generateFormalNumber($w->getYear(), $w->getWorkNumber()); ?> ::: <?php echo $w->getTitle(); ?></h2>
            	<div class="btn-toolbar mb-2 mb-md-0">
              		<div class="btn-group mr-2">
                		<button class="btn btn-sm btn-outline-secondary">Export</button>
              		</div>
            	</div>
          	</div>
			
      		<div name="scope">
      			<h4>Scope of Project<a name="scope"></a> </h4>
      			<?php echo $j->getSOW(); ?>
			</div>

			<div name="curretstatus">
      			<h4>Current Status<a name="currentstatus"></a> </h4>
      			<?php echo $j->getStatusDesc(); ?>
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

<!-- MILESTONES -->

				<div class="tab-content">
					<div class="tab-pane active" id="milestones" role="tabpanel">
						<div class="row">
							<div class="col-sm-11 pt-2 pb-2">
									<h4>Milestones</h4>
							</div>
							<div class="col-sm pt-2 pb-2">
								<?php
									if($level <= 1){
										echo '<a href="#" name="add_milestone" id="add_milestone" data-toggle="modal" data-target="#addMilestone" class="btn btn-success ">Add</a>';
									}
								?>
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
							}else{
								echo $result;
							}							
						?>
		              		</tbody>
	        			</table>
	    			</div>
<!-- TEAM -->

					<div class="tab-pane" id="team" role="tabpanel">
						<div class="row">
							<div class="col-sm-11 pt-2 pb-2">
									<h4>Design Team</h4>
							</div>
							<div class="col-sm pt-2 pb-2">
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
		              			echo '</tbody>
	        					</table>';
							}else{
								echo $result;
							}
						?>
	    			</div>
					
<!-- DELAYS -->

					<div class="tab-pane" id="delays" role="tabpanel">
						<div class="row">
							<div class="col-sm-11 pt-2 pb-2">
									<h4>Delay Log</h4>
							</div>
							<div class="col-sm pt-2 pb-2">
								<?php 
									if($level <= 1){
										echo '<a href="#" name="add_delay" id="add_delay" data-toggle="modal" data-target="#addDelay" class="btn btn-success ">Add</a>';
									}
								?>
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
							}else{
								echo $result;
							}
						?>
		              		</tbody>
	        			</table>
	    			</div>

<!-- DISCUSSIONS -->

					<div class="tab-pane" id="discussions" role="tabpanel">
						<div class="row">
							<div class="col-sm-11 pt-2 pb-2">
									<h4>Discussions</h4>
							</div>
							<div class="col-sm pt-2 pb-2">
								<?php 
									if($level <= 1){
										echo '<a href="#" name="add_discussion" id="add_discussion" data-toggle="modal" data-target="#addDiscussion" class="btn btn-success ">Add</a>';
									}
								?>
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
	              			}else{
	              				echo 'No discussions entered.';
	              			}
				        ?>
		              		</tbody>
	        			</table>
	    			</div>
				</div>
			</div>
        </main>
    </div>
</div>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 
	unset($work, $helper, $db, $jM, $jD, $jDi);
?>