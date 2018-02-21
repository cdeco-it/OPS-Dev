<?php

include_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.db.php');

class ACL extends Db{

	private $authuser;
	private $authlevel;

	/**
	 * Parent construction from class.db.php
	 */
	function __construct(){
		parent::__construct();
	}

	/**
	 * setAuthuser sets the name of the authorized user for use by the authenticator
	 * @param String $value Employee name
	 */
	function setAuthuser($value = NULL){
		if(!is_null($value)){
			$this->authuser = $value;
		}else{
			$this->authuser = "Undefined";
		}
	}

	/**
	 * getAuthuser simply returns the username
	 * @return String Employee name
	 */
	function getAuthuser(){
		return($this->authuser);
	}

	/**
	 * setAuthLevel sets the ACL level of the user based on session key and DB record
	 * @param int $value ACL Level
	 */
	function setAuthlevel($value = NULL){
		if(!is_null($value)){
			$this->authlevel = $value;
		}else{
			$this->authlevel = NULL;
		}
	}

	/**
	 * getAuthlevel returns the current ACL level for a session 
	 * @return int ACL Level
	 */
	function getAuthlevel(){
		return($this->authlevel);
	}

	/**
	 * authenticateLogin is used to process a system log in
	 * @param  String $username String representation of a username
	 * @param  String $password String representation of a password
	 * @return String[]           Array continaing two flags AUTH and FLAG. Auth is a boolean to determin if authentication is good, Flag is a redirector to login.
	 */
	function authenticateLogin($username, $password){
		if(!empty($username) && !empty($password)){

			$query = "SELECT employee_id, employee_password, employee_acl, employee_status FROM employee WHERE employee_username = :username";
			$this->set($query);
			$this->bindParam(':username', $username);
			$this->execute();	

			if($this->rowCount() > 0){

				foreach($this->returnSet() as $row){

					//Check for active employees 
					if($row['employee_status'] != 2){

						//If password is legit proceed
						if(password_verify($password, $row['employee_password'])){

							if(!empty($row['employee_id'])){
							
								//Process the login and record the session...
								session_start();
								$skey = session_id();
								$this->startTransaction();
								try{
									$query = "INSERT INTO security_sessions (
											employee_id,
											employee_acl,
											security_sessions_key,
											security_sessions_address,
											security_sessions_useragent,
											security_sessions_expires
											) 
											VALUES (
											:employee_id,
											:employee_acl,
											:session_key,
											:session_address,
											:session_agent,
											DATE_ADD(NOW(), INTERVAL 1 HOUR)
											);";

									$this->set($query);
									$this->bindParam(':employee_id', $row['employee_id']);
									$this->bindParam(':employee_acl', $row['employee_acl']);
									$this->bindParam(':session_key', $skey);
									$this->bindParam(':session_address', $_SERVER['REMOTE_ADDR']);
									$this->bindParam(':session_agent', $_SERVER['HTTP_USER_AGENT']);
									$auth = $this->execute();
									$this->endTransaction();

									if($auth){
										$control = array("auth" => true, "flag" => NULL);
										return($control);
									}
								}catch(Exception $e){
									//If something goes wrong...cancel the transaction and redirect to login
									//Display critical error.
									$this->cancelTransaction();
									$control = array("auth" => false, "flag" => 9);
									return($control);
								}
							//Critical error...
							}else{
								$control = array("auth" => false, "flag" => 9);
								return($control);
							}

						//If not legit, redirect.
						}else{
							$control = array("auth" => false, "flag" => 0);
							return($control);
						}
					//For disabled employee
					}else{
						$control = array("auth" => false, "flag" => 3);
						return($control);
					}
				}
			//For an invalid account
			}else{
				$control = array("auth" => false, "flag" => 2);
				return($control);
			}
		//Redirect if empty...
		}else{
			
			$control = array("auth" => false, "flag" => 1);
			return($control);
		}
	}

	/**
	 * authenticateSession is used to ensure that a user is logged
	 * into the system and the database is tracking that user.
	 * @return [type] [description]
	 */
	function authenticateSession($skey){
		//Modified query to do a join to get username...
		$query = "SELECT 
					security_sessions.security_sessions_id, 
					security_sessions.employee_id, 
					security_sessions.employee_acl, 
					CONCAT(employee.employee_fname,' ',employee.employee_lname) AS 'username' 
				FROM security_sessions
				INNER JOIN employee 
					ON employee.employee_id = security_sessions.employee_id
				WHERE security_sessions.security_sessions_key = :session_key 
				AND security_sessions.security_sessions_address = :session_address 
				AND security_sessions.security_sessions_useragent = :session_useragent 
				AND security_sessions.security_sessions_expires > NOW()";

		//Original query replaced 10/9/17.  Left in file for reversion if necessary.
		//$query = "SELECT security_sessions_id, employee_id FROM security_sessions WHERE 
		//	security_sessions_key = :session_key AND 
		//	security_sessions_address = :session_address AND
		//	security_sessions_useragent = :session_useragent AND
		//	security_sessions_expires > NOW()";

		$this->set($query);
		$this->bindParam(':session_key', $skey);
		$this->bindParam(':session_address', $_SERVER["REMOTE_ADDR"]);
		$this->bindParam(':session_useragent', $_SERVER["HTTP_USER_AGENT"]);
		$this->execute();
		$result = $this->returnSingle();

		if(empty($result['security_sessions_id'])){
			//If there is no record of a session...default to login.
			header('Location: http://localhost/login.php?flag=1');
		}else{
			$sid = $result['security_sessions_id'];

			$this->setAuthuser($result['username']);
			$this->setAuthlevel($result['employee_acl']);
			
			$this->startTransaction();
			$query = "UPDATE security_sessions SET security_sessions_expires = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE security_sessions_id = $sid";
			$this->set($query);
			try{
				$this->execute();
				$this->endTransaction();
			}catch(Exception $e){
				$this->cancelTransaction();
				//If we have a PDO exception flag critical error...
				header('Location: http://localhost/login.php?flag=9');
			}
		}
	}

	/**
	 * destroySession is used to end a user session based upon session key
	 * @param  String $skey The session key.
	 * @return [type]       [description]
	 */
	function destroySession($skey){
		$this->startTransaction();
		try{
			$query = "DELETE FROM security_sessions WHERE security_sessions_key = :session_key";
			$this->set($query);
			$this->bindParam(':session_key', $skey);
			$result = $this->execute();
			if($result){
				$this->setAuthuser();
				$this->setAuthlevel();
				$this->endTransaction();
			}else{

			}
		}catch(Exception $e){
			$this->cancelTransaction();
		}
	}


	/**
	 * returnSessionACL simply fetched the predefined user ACL stored in session and returns the value
	 * @param  String $skey A valid session key
	 * @return int       Employee ACL level
	 */
	function returnSessionACL($skey){
		$query = "SELECT employee_acl FROM security_sessions WHERE security_sessions_id = :session_id";
		$this->set($query);
		$this->bindParam(':session_id', $skey);
		$this->execute();
		$result = $this->returnSingle();
		if(empty($result['employee_acl'])){
			return(NULL);
		}else{
			return($result['employee_acl']);
		}
	}

	/**
	 * generateRandomPassword is a random password generator that takes in an array
	 * containing the first and last name and DOB and converts it to a standard
	 * formatted password.  It is is then BCRYPTED.  An array of the plain text and
	 * BCRYPT hash is returned.  If input is NULL, a random password is generated
	 * with the same output.
	 * @param  String[] $value Contains first and last names, and DOB
	 * @return String[]        Contains plaintext and BCRYPT hash
	 */
	public function generate_Password($value = NULL){
		if(is_null($value)){
			return($this->generate_RandomPassword());
		}else{
			$x = strtolower(substr($value['first'], 0, 1));
			$y = strtolower(substr($value['last'], 0, 1));
			$d = explode("-", $value['dob']);
			$z = $d[0].$d[1].substr($d[2], -2);
			$plain = $x.$y.$z;
			$hash = password_hash($plain, PASSWORD_BCRYPT);
			$password = array("plain" => $plain, "crypt" => $hash);
			return($password);
		}
	}
}

?>