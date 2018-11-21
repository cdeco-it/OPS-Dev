<?php

	require_once('class.db.php');

	class Helper extends Db {

		function __construct(){
			parent::__construct();
		}

/***** DEBUGGER *****/
/**
 * Send debug code to the Javascript console
 */ 
		public function debugToConsole($data) {
		    if(is_array($data) || is_object($data))
			{
				echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
			} else {
				echo("<script>console.log('PHP: ".$data."');</script>");
			}
		}

/****	DEFINER METHODS 	*****/

		public function defineContactName($value = NULL){
			if(is_numeric($value) && !is_null($value)){
				$query = "SELECT CONCAT_WS(' ', addr.addr_fname, addr.addr_lname) AS 'fullname' FROM addr WHERE addr.addr_id = :value";
				$this->set($query);
				$this->bindParam(':value', $value);
				$result = $this->returnSingle();
				if($this->rowCount() >= 1){
					return($result['fullname']);
				}else{
					return("Undefined");
				}
			}else{
				return("Undefined");
			}
		}

		public function defineOrganizationName($value = NULL){
			if(is_numeric($value) && !is_null($value)){

				$query = "SELECT addr_orgs.addr_orgs_name FROM addr_orgs WHERE addr_orgs.addr_orgs_id = :value";
				$this->set($query);
				$this->bindParam(':value', $value);
				$result = $this->returnSingle();
				if($this->rowCount() >= 1){
					return($result['addr_orgs_name']);
				}else{
					return("Undefined");
				}
			}else{
				return("Undefined");
			}
		}

		public function defineEmployeeStatus($value = NULL){
			if($value == 1){
				return("Active");
			}else{
				return("Inactive");
			}
		}

		public function defineYesNo($value = NULL){
			if($value == 1){
				return("Yes");
			}else{
				return("No");
			}
		}

		public function defineStateAbbr($value = NULL){
			if(!is_null($value)){
				$query = "SELECT common_usstates_abbr AS 'abbr' FROM common_usstates WHERE common_usstates_id = :id";
				$this->set($query);
				$this->bindParam(':id', $value);
				$result = $this->returnSingle();
				if($this->rowCount() >= 1){
					return($result['abbr']);
				}else{
					echo"BR";
					return('Undefined');
				}
			}else{
				echo"LR";
				return('Undefined');
			}
		}

		public function defineStateFull($value = NULL){
			if(!is_null($value)){
				$query = "SELECT common_usstates_full AS 'full' FROM common_usstates WHERE common_usstates_id = :id";
				$this->set($query);
				$this->bindParam(':id', $value);
				$result = $this->returnSingle();
				if($this->rowCount() >= 1){
					return($result['full']);
				}else{
					return('Undefined');
				}
			}else{
				return('Undefined');
			}
		}

		public function defineCountryAbbr($value = NULL){
			if(!is_null($value)){
				$query = "SELECT common_countries_abbr AS 'abbr' FROM common_countries WHERE common_countries_id = :id";
				$this->set($query);
				$this->bindParam(':id', $value);
				$result = $this->returnSingle();
				if($this->rowCount() >= 1){
					return($result['abbr']);
				}else{
					return('Undefined');
				}
			}else{
				return('Undefined');
			}
		}

		public function defineCountryFull($value = NULL){
			if(!is_null($value)){
				$query = "SELECT common_countries_full AS 'full' FROM common_countries WHERE common_countries_id = :id";
				$this->set($query);
				$this->bindParam(':id', $value);
				$result = $this->returnSingle();
				if($this->rowCount() >= 1){
					return($result['full']);
				}else{
					return('Undefined');
				}
			}else{
				return('Undefined');
			}
		}

		public function defineCountryCode($value = NULL){
			if(!is_null($value)){
				$query = "SELECT common_countries_id AS id FROM common_countries WHERE common_countries_full LIKE :value";
				$this->set($query);
				$this->bindParam(':value', $value);
				$result = $this->returnSingle();
				if($this->rowCount() >= 1){
					return($result['id']);
				}else{
					return(237);
				}
			}else{
				return(NULL);
			}
		}

/****	POPULATE METHODS 	*****/

		public function populateCommonRoles($value = NULL){
			$query = "SELECT * FROM common_roles ORDER BY common_roles_id ASC";
			$this->set($query);
			$this->execute();
			foreach($this->returnSet() as $row){
				if($row['common_roles_id'] == $value){
					echo'<option value="'.$row['common_roles_id'].'" selected="SELECTED">'.$row['common_roles_desc'].'</option>';
				}else{
					echo'<option value="'.$row['common_roles_id'].'">'.$row['common_roles_desc'].'</option>';
				}
			}
		}

		public function populateEmployeeNames($value = NULL){
			$query = "SELECT CONCAT(employee.employee_fname,' ', employee.employee_lname) AS 'name', employee_id FROM employee WHERE employee.employee_status = 1 ORDER BY employee.employee_lname ASC";
			$this->set($query);
			$this->execute();
			foreach($this->returnSet() as $row){
				if($row['employee_id'] == $value){
					echo'<option value="'.$row['employee_id'].'" selected="SELECTED">'.$row['name'].'</option>';
				}else{
					echo'<option value="'.$row['employee_id'].'">'.$row['name'].'</option>';
				}
			}
		}
	
		public function populateEngineeringMilestones($value = NULL){
			$query = "SELECT * FROM common_eng_milestones ORDER BY common_eng_milestones_id ASC";
			$this->set($query);
			$this->execute();
			foreach($this->returnSet() as $row){
				if($row['common_eng_milestones_id'] == $value){
					echo'<option value="'.$row['common_eng_milestones_id'].'" selected="SELECTED">'.$row['common_eng_milestones_desc'].'</option>';
				}else{
					echo'<option value="'.$row['common_eng_milestones_id'].'">'.$row['common_eng_milestones_desc'].'</option>';
				}
			}
		}

		public function populateConstructionMilestones($value = NULL){
			$query = "SELECT * FROM common_cons_milestones ORDER BY common_cons_milestones_id ASC";
			$this->set($query);
			$this->execute();
			foreach($this->returnSet() as $row){
				if($row['common_cons_milestones_id'] == $value){
					echo'<option value="'.$row['common_cons_milestones_id'].'" selected="SELECTED">'.$row['common_cons_milestones_desc'].'</option>';
				}else{
					echo'<option value="'.$row['common_cons_milestones_id'].'">'.$row['common_cons_milestones_desc'].'</option>';
				}
			}
		}

		public function populateYesNo($value = NULL){
			if($value == 0 || is_null($value)){
				echo '<option value="0" selected=SELECTED>No</option><option value="1">Yes</option>';
			}else{
				echo '<option value="0">No</option><option value="1" selected=SELECTED>Yes</option>';
			}
		}

		public function populateSubOrRFI($value = NULL){
			if($value == 0 || is_null($value)){
				echo '<option value="0" selected=SELECTED>Submittal</option><option value="1">RFI</option>';
			}else{
				echo '<option value="0">Submittal</option><option value="1" selected=SELECTED>RFI</option>';
			}
		}

		public function populateDelayCause($value = NULL){
			if($value == 0 || is_null($value)){
				echo '<option value="0" selected=SELECTED>Internal Issues</option><option value="1">External Issues</option>';
			}else{
				echo '<option value="0">Internal Issues</option><option value="1" selected=SELECTED>External Issues</option>';
			}
		}

		public function populatePrefix($value = NULL){
			$query = "SELECT * FROM common_prefix ORDER BY common_prefix_id ASC";
			$this->set($query);
			$this->execute();
			foreach($this->returnSet() as $row){
				if($row['common_prefix_id'] == $value){
					echo'<option value="'.$row['common_prefix_id'].'" selected="SELECTED">'.$row['common_prefix_desc'].'</option>';
				}else{
					echo '<option value="'.$row['common_prefix_id'].'">'.$row['common_prefix_desc'].'</option>';
				}
			}
		}

		public function populateSuffix($value = NULL){
			$query = "SELECT * FROM common_suffix ORDER BY common_suffix_id ASC";
			$this->set($query);
			$this->execute();
			foreach($this->returnSet() as $row){
				if($row['common_suffix_id'] == $value){
					echo '<option value="'.$row['common_suffix_id'].'" selected="SELECTED">'.$row['common_suffix_abbr'].'  ('.$row['common_suffix_desc'].')</option>';
				}else{
					echo '<option value="'.$row['common_suffix_id'].'">'.$row['common_suffix_abbr'].' ('.$row['common_suffix_desc'].')</option>';
				}
			}
		}

		public function populateStates($value = NULL){
			$query = "SELECT * FROM common_usstates ORDER BY common_usstates_id ASC";
			$this->set($query);
			$this->execute();
			foreach($this->returnSet() as $row){
				if($row['common_usstates_id'] == $value){
					echo '<option value="'.$row['common_usstates_id'].'" selected="SELECTED">'.$row['common_usstates_full'].'</option>';
				}else{
					echo '<option value="'.$row['common_usstates_id'].'">'.$row['common_usstates_full'].'</option>';
				}
			}
		}

		public function populateCountry($value = NULL){
			$query = "SELECT * FROM common_countries ORDER BY common_countries_id ASC";
			$this->set($query);
			$this->execute();
			foreach($this->returnSet() as $row){
				if($row['common_countries_id'] == $value){
					echo '<option value="'.$row['common_countries_id'].'" selected="SELECTED">'.$row['common_countries_proper'].'</option>';
				}else{
					echo '<option value="'.$row['common_countries_id'].'">'.$row['common_countries_full'].'</option>';
				}
			}
		}

		public function populateEmployeeStatus($value = NULL){
			$query = "SELECT * FROM employee_status ORDER BY employee_status_id ASC";
			$this->set($query);
			$this->execute();
			foreach($this->returnSet() as $row){
				if($row['employee_status_id'] == $value){
					echo '<option value="'.$row['employee_status_id'].'" selected="SELECTED">'.$row['employee_status_desc'].'</option>';
				}else{
					echo '<option value="'.$row['employee_status_id'].'" >'.$row['employee_status_desc'].'</option>';
				}
			}
		}

		public function populateWorkStatus($value = NULL){
			$query = "SELECT * FROM work_status ORDER BY work_status_id ASC";
			$this->set($query);
			$this->execute();
			foreach($this->returnSet() as $row){
				if($row['work_status_id'] == $value){
					echo '<option value="'.$row['work_status_id'].'" selected="SELECTED">'.$row['work_status_desc'].'</option>';
				}else{
					echo '<option value="'.$row['work_status_id'].'">'.$row['work_status_desc'].'</option>';
				}
			}
		}

		public function populateWorkYears($value = NULL){
			$query = "SELECT DISTINCT work.work_year FROM work ORDER BY work.work_year DESC";
			$this->set($query);
			$this->execute();
			foreach($this->returnSet() as $row){
				if($row['work_year'] == $value){
					echo '<option value="'.$row['work_year'].'" selected="SELECTED">'.$row['work_year'].'</option>';
				}else{
					echo '<option value="'.$row['work_year'].'">'.$row['work_year'].'</option>';
				}
			}
		}

		public function populateRelevantConsultants($value = NULL, $inputs = NULL){
			if(!is_null($value)){
				$query = "SELECT 
						work_j_consultants.work_j_consultants_id AS 'id',
						CONCAT(addr.addr_fname, ' ', addr.addr_lname) AS 'name'
						FROM work_j_consultants
						LEFT JOIN addr
						ON work_j_consultants.addr_id = addr.addr_id
						WHERE work_j_consultants.work_j_id = :id
						ORDER BY addr.addr_lname ASC";
				$this->set($query);
				$this->bindParam(':id', $value);
				$this->execute();

				//Get size of inputs array
				$len = count($input);
				//Process thru each row returned
				foreach($this->returnSet() as $row){
					//Let's make sure input isn't null, if it i
					if(!empty($input)){
						//Cycle thru all options in the input array
						for($i = 0; $i < $len; $i++){
							//Look for mataches
							if($inputs[$i] == $row['id']){
								echo '<option value="'.$row['id'].'" selected="SELECTED">'.$row['name'].'</option>';
							//No matches
							}else{
								echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
							}
						}
					//If input is null, just create all options without selctions
					}else{
						echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
					}
				}
			//If no JID, then we cannot process the request.  Provide a empty option.
			//May need to revisit this soon....
			}else{
				echo '<option>No consultants available</option>';
			}
		}

		public function populateRelevantEmployees($value = NULL, $inputs = NULL){
			error_log("VAL = ".$value." ::: IPNUTS = ".$ipnuts);

			if(!is_null($value)){
				$query = "SELECT 
						work_j_team.work_j_team_id AS 'id',
						CONCAT(employee.employee_fname, ' ', employee.employee_lname) AS 'name'
						FROM work_j_team
						LEFT JOIN employee
						ON work_j_team.employee_id = employee.employee_id
						WHERE work_j_team.work_j_id = :id
						ORDER BY employee.employee_lname ASC";
				$this->set($query);
				$this->bindParam(':id', $value);
				$this->execute();

				//Get size of inputs array
				$len = count($input);
				//Process thru each row returned
				foreach($this->returnSet() as $row){
					//Let's make sure input isn't null, if it i
					if(!empty($input)){
						//Cycle thru all options in the input array
						for($i = 0; $i < $len; $i++){
							//Look for mataches
							if($inputs[$i] == $row['id']){
								echo '<option value="'.$row['id'].'" selected="SELECTED">'.$row['name'].'</option>';
							//No matches
							}else{
								echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
							}
						}
					//If input is null, just create all options without selctions
					}else{
						echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
					}
				}
			//If no JID, then we cannot process the request.  Provide a empty option.
			//May need to revisit this soon....
			}else{
				echo '<option>No consultants available</option>';
			}
		}

		//@TODO
		//
		public function populateEmployeeACL($value = NULL){

		}

		public function populateEmployeeSubscription($value = NULL){
			if($value != NULL && $value == 0){
				echo '<option value="0" selected="SELECTED">No</option>
						<option value="1"> Yes </option>';
			}

			if($value != NULL && $value == 1){
				echo '<option value="0" >No</option>
						<option value="1" selected="SELECTED"> Yes </option>';
			}

		}

/****	TIME & DATE METHODS 	*****/

		public function date_toStandard($value){
			$da = array('Y' => NULL, 'M' => NULL, 'D' => NULL);
			$valueX = explode("-", $value);
			$da['Y'] = $valueX[0];
			$da['M'] = $valueX[1];
			$da['D'] = $valueX[2];
			$standardDate = $da['M'].'-'.$da['D'].'-'.$da['Y']; 
			return $standardDate;
		}

		public function date_toSQL($value){
			$da = array('Y' => NULL, 'M' => NULL, 'D' => NULL);

			if(substr_count($value, '-') > 0){
				$valueX = explode("-", $value);
			}else if(substr_count($value, '/') > 0){
				$valueX = explode("/", $value);
			}
			
			$da['M'] = $valueX[0];
			$da['D'] = $valueX[1];
			$da['Y'] = $valueX[2];
			$sqlDate = $da['Y'].'-'.$da['M'].'-'.$da['D']; 
			return $sqlDate;
		}

		public function date_calculateAge($value = NULL){
			if(!is_null($value)){
				$now = date("Y-m-d");
				$diff = date_diff(date_create($value), date_create($now));
				return($diff->format('%y'));
			}else{
				return('Unable to calculate.');
			}
		}

/****	GENERATOR METHODS 	*****/

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

		public function generate_RandomPassword(){
			$x = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
			$random = array();
			$len = strlen($x) - 1;
			for($i = 0; $i < 8; $i++){
				$n = rand(0, $len);
				$random[] = $x[$n];
			}
			$final = implode($random);
			$password = array("plain" => $final, "crypt" => password_hash($final, PASSWORD_BCRYPT));
			return($password);
		}

		public function generate_Username($value = NULL){
			if(is_null($value)){
				return(NULL);
			}else{
				//Set the basic username pattern...
				$f = strtolower($value['first']);
				$l = strtolower(substr($value['last'], 0, 1));
				$username = $f.$l;

				//First check to see if there are repeated names...
				$query = "SELECT COUNT(employee_username) AS count FROM employee WHERE employee_username = '$username'";
				$this->set($query);
				$result = $this->returnSingle();

				//If there are...then adjust the username with incremental addition to username
				if($result['count'] >= 1 ){
					$mod = $result['count']+1;
					$username = $f.$l.$mod;
				}
				return($username);
			}
		}


/****	FORMATTER METHODS 	*****/
		/**
		 * format_PhoneNumber is used to format/standardize phone numbers for proper storage.
		 * This function really only formats phone numbers that can be 10 digit dialed with in the
		 * USA.  Internatinoal calling simply removes all characters and returns.
		 * @param  String $value  The phone number to be formatted.
		 * @param  int $locale The country the phone number should be in
		 * @return String         The formatted phone number
		 */
		public function format_PhoneNumber($value = NULL, $locale = NULL){
			if(is_null($value)){
				return(NULL);
			}else{
				if(!empty($value)){
					//Get all locally dialed numbers so we can know how to process them from international numbers
					$query = "SELECT common_countries_id FROM common_countries WHERE common_countries_phonecode IS NULL";
					$this->set($query);
					$result = $this->returnSet();
					$exempt = array();

					//Push these into an array.
					foreach($result as $row){
						array_push($exempt, $row['common_countries_id']);
					}

					//Deal with numbers that are 10/11 digit dialable in the USA
					if(is_null($locale) || in_array($locale, $exempt)){

						//Remove everything but the digits
						$number = preg_replace("[\D]","", $value);

						//Let's drop the 1 prefix
						if($number[0] == 1){
							$number = substr($number, 1);
						}

						$formatted = "".substr($number, 0, 3)."-".substr($number, 3, 3).'-'.substr($number, 6, 4);
						return($formatted);

					//International calling formats.
					//This part of the method is rather useless....hard to predict area codes for differing countries.
					}else{
						$number = preg_replace("[\D]","", $value);
						return($number);
					}
				}else{
					return(NULL);
				}
			}
		}
	}
?>