<?php

//Process.php
//Written: S. Mized
//10-6-2017

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/class.acl.php');

$sec = new ACL();

if(isset($_POST['username']) && isset($_POST['password'])){

	if(!empty($_POST['username']) && !empty($_POST['password'])){
		
		$result = $sec->authenticateLogin($_POST['username'], $_POST['password']);

		sleep(3);

		switch($result['auth']){
			case true:
				if(is_null($result['flag'])){
					header('Location: index.php');
				}else{
					//We should never ever hit this...if so critical error
					header('Location: login.php?flag=9');
				}
				break;

			case false:
				switch($result['flag']){
					case 0:
						//Level 0 = Bad passwprd
						header('Location: login.php?flag=0');
						break;

					case 1:
						//Not logged in
						header('Location: login.php?flag=1');
						break;

					case 2:
						//No matching account
						header('Location: login.php?flag=2');
						break;

					case 3:
						//No matching account
						header('Location: login.php?flag=3');
						break;

					case 9:
						//Critical error
						header('Location: login.php?flag=9');
						break;

					default:
						//Default
						header('Location: login.php?flag=0');
						break;
				}
				break;

			default:
				//Default is not logged in
				header('Location: login.php?flag=1');
				break;
		}
	}
}else{
	//Default is not logged in
	header('Location: login.php?flag=1');
}
?>