<?php

	//require_once('../../lib/includes/inc.messages.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.messages.php');

	class Db{

		private $host = "localhost";
		private $user = "opsdev";
		private $pass = "ops";
		private $dbname = "opsdev";
		private $charset = "utf8";
		private $driver = "mysql";
		protected $connection;
		protected $error;
		protected $statement;

		public function __construct(){
		
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname. ';charset=' . $this->charset.';';
		    
		    $options = array(
		      PDO::ATTR_PERSISTENT => true,
		      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		    );

		    try{
		      $this->connection = new PDO($dsn, $this->user, $this->pass, $options);
		    }catch(PDOException $e){
		      $this->error = $e->getMessage();
		      echo $this->error;
		    }
	  	}

	  	/**
	  	 * Debug returns a string representation of the PDO statement object
	  	 * @return [type] [description]
	  	 */
	  	public function debug(){
	  		return $this->statement->debugDumpParams();
	  	}
	  	
	  	/**
	  	 * Basic query preparation function
	  	 * @param  [string] $query [A formatted SQL query string]
	  	 * @return [PDO:Statment object]	[A formatted PDO query object for use in execution]
	  	 */
	  	public function set($query){
	  		$this->statement = $this->connection->prepare($query);
	  	}

	  	/**
	  	 * Binds values inputted for prepared statements
	  	 * @param  [string] $param [SQL querty variable definition]
	  	 * @param  [mixed] $value [SQL variable value]
	  	 * @param  [mixed] $type  [Value data type definition (not required)]
	  	 * @return [PDO:Statement object]	[PDO Statemnet with mapped variable]
	  	 */
	  	public function bindValue($param, $value, $type = null){
	  		if(is_null($type)){
		    	switch(true){
		        	case is_int($value):
		        		$type = PDO::PARAM_INT;
		          		break;
		        	case is_bool($value):
		          		$type = PDO::PARAM_BOOL;
		          		break;
		        	case is_null($value):
		          		$type = PDO::PARAM_NULL;
		          		break;
		        	default:
		          		$type = PDO::PARAM_STR;
		          		break;
		    	}
		    }
		    $this->statement->bindValue($param, $value, $type);
	  	}

	  	/**
	  	 * [bindParam Binds parameters inputted for prepared statements]
	  	 * @param  [string] $param [SQL querty variable definition]
	  	 * @param  [mixed] $value [SQL variable value]
	  	 * @param  [mixed] $type  [Value data type definition (not required)]
	  	 * @return [PDO:Statement object]	[PDO Statemnet with mapped variable]
	  	 */
	  	public function bindParam($param, $value, $type = null){
	  		if(is_null($type)){
	  			switch(true){
	  				case is_int($value):
	  					$type = PDO::PARAM_INT;
	  					break;
	  				case is_bool($value):
	  					$type = PDO::PARAM_BOOL;
	  					break;
	  				case is_null($value):
	  					$type = PDO::PARAM_NULL;
	  					break;
	  				default:
	  					$type = PDO::PARAM_STR;
	  					break;
	  			}
	  		}
	  		$this->statement->bindParam($param, $value, $type);
	  	}

	  	/**
	  	 * Executes a query that has a set statement
	  	 * @return [PDO Database object] [Result set of query execution]
	  	 */
	  	public function execute(){
	  		return $this->statement->execute();
	  	}

	  	/**
	  	 * returnSet returns an array or of results for all rows
	  	 * @return [type] [description]
	  	 */
	  	public function returnSet(){
	  		$this->execute();
	  		return $this->statement->fetchAll();
	  	}

	  	/**
	  	 * returnSingle returns only a single record from the DB
	  	 * @return [type] [description]
	  	 */
	  	public function returnSingle(){
	  		$this->execute();
	  		return $this->statement->fetch();
	  	}

	  	/**
	  	 * rowCount simply returns a numerical count of result rows
	  	 * @return [type] [description]
	  	 */
	  	public function rowCount(){
	  		return $this->statement->rowCount();
	  	}

	  	/**
	  	 * lastInsertId returns the last insert id number
	  	 * @return [type] [description]
	  	 */
	  	public function lastInsertId(){
	  		return $this->connection->lastInsertId();
	  	}

	  	/**
	  	 * Starts a PDO transaction
	  	 * @return [type] [description]
	  	 */
	  	public function startTransaction(){
	  		$this->connection->beginTransaction();
	  	}

	  	/**
	  	 * Ends a transaction by committing all executions
	  	 * @return [type] [description]
	  	 */
	  	public function endTransaction(){
	  		$this->connection->commit();
	  	}

	  	/**
	  	 * Cancels the transaction and rolls back changes
	  	 * @return [type] [description]
	  	 */
	  	public function cancelTransaction(){
	  		$this->connection->rollBack();
	  	}

	  	public function getError(){
	  		$err = $this->statement->errorInfo();
	  		return($err[0].' - '.$err[2]);
	  	}
	}
?>