<?php 


require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php'); 
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.j.milestones.php');

$x = new j_WorkMilestones();
$x->setWorkJID(1);
$x->setMilestone("A");
$r = $x->addEntry();

print_r($r);

// echo "***GET ENTRY***<br />";
// $x->getEntry(1);

// echo $x->getFetchId().'<br />';
// echo $x->getWorkJID().'<br />';
// echo $x->getWorkID().'<br />';
// echo $x->getMilestone().'<br />';
// echo $x->getFormalMilestone().'<br />';
// echo $x->getMilestoneValue().'<br />';
// echo $x->getDateCreated().'<br />';
// echo $x->getDateModified().'<br />';

// echo "<br />***UPDATE PARTS***<br />";

// $x->setMilestoneValue("1999-01-01");
// $x->setMilestone(3);
// $r = $x->updateEntry();

// echo $r['message'].'<br /><br />';

// $x = new j_WorkMilestones();
// $x->getEntry(1);

// echo $x->getFetchId().'<br />';
// echo $x->getWorkJID().'<br />';
// echo $x->getWorkID().'<br />';
// echo $x->getMilestone().'<br />';
// echo $x->getFormalMilestone().'<br />';
// echo $x->getMilestoneValue().'<br />';
// echo $x->getDateCreated().'<br />';
// echo $x->getDateModified().'<br />';

// echo "<br />***ADD NEW PARTS***<br />";

// unset($x);
// $x = new j_WorkMilestones();
// $x->setWorkJID(3);
// $x->setWorkID(1);
// $x->setMilestone(5);
// $x->setMilestoneValue("2018-01-01");
// $x->addEntry();
// $r = $x->addEntry();

// echo $r['message'].'<br /><br />';




?>