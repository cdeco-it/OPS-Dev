<?php

/**
 Logout.php
 By: S. Mized
 10/9/2017
 */

session_start();

$skey = session_id();

echo $skey;

//Bring in the ACL class
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.acl.php');

//Create new ACL object
$sec = new ACL();

//Delete the session
$sec->destroySession($skey);

//Check the session to see if it is still active...if it isn't it will
//redirect...otherwise it will go elsewhere.
$sec->authenticateSession($skey);

//Destroy the ACL object
unset($sec);
?>