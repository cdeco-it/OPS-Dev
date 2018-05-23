<?php 


require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.authenticator.php'); 
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.j.milestones.php');

$x = new j_WorkMilestones();

echo "***GET ENTRY***<br />";
$x->getEntry(1);

echo $x->getFetchId().'<br />';
echo $x->getWorkJID().'<br />';
echo $x->getWorkID().'<br />';
echo $x->getMilestone().'<br />';
echo $x->getFormalMilestone().'<br />';
echo $x->getMilestoneValue().'<br />';
echo $x->getDateCreated().'<br />';
echo $x->getDateModified().'<br />';

echo "<br />***UPDATE PARTS***<br />";

$x->setMilestoneValue("1999-01-01");
$x->setMilestone(3);

echo $x->getFetchId().'<br />';
echo $x->getWorkJID().'<br />';
echo $x->getWorkID().'<br />';
echo $x->getMilestone().'<br />';
echo $x->getFormalMilestone().'<br />';
echo $x->getMilestoneValue().'<br />';
echo $x->getDateCreated().'<br />';
echo $x->getDateModified().'<br />';

?>