<?php 
//Bring in the ACL class
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.acl.php');

//Start the session
session_start();

//Get the session key
$skey = session_id();

//Create new ACL object
$sec = new ACL();

//Authentication the session using the session key
$sec->authenticateSession($skey);

//Save the ACL lever for the logged in use
//$level = $sec->returnSessionACL($skey);
$level = $sec->getAuthlevel();

//Get username
$user = $sec->getAuthuser();

//Destroy the ACL object
unset($sec);
?>