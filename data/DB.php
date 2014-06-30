<?php

class DB
{
	private $conn;
	private $dbselected;
	private $isOpen;
	
	private $dbhost;
	private $dbname;
	private $dbuser;
	private $dbpass;
	
	private $queries;
	protected $tablesInstaled;
	
	public function __construct( $config )
	{
		$this->dbhost = $config->host;
		$this->dbname = $config->name;
		$this->dbuser = $config->user;
		$this->dbpass = $config->pass;
		
		$this->conn = null;
		$this->dbselected = null;
		$this->isOpen = false;
		
		$this->queries = array();
	}
	
	/**
	 * Method: q
	 * @var	   $string_query (string)
	 */
	public function q($string_query,$msg="")
	{
		$this->open();
			$this->addQuery($string_query);
			$query = mysql_query($string_query) or $this->error($msg);
		$this->close();
		return $query;
	}
	
	public function query($string_query,$msg="")
	{
		$this->q($string_query,$msg);
	}
	
	/**
	 * Method: numRows
	 * @var	   $query (object)
	 */
	public function numRows($query)
	{
		$this->open();
			$this->addQuery($string_query);
			$numrows = mysql_num_rows($string_query);
		$this->close();
		return (int) $numrows;
	}
	
	/**
	 * Method: fetching...
	 * @var	   $query (object)
	 */
	
	//assoc...
	public function fetchAssoc($query)
	{
		$this->addQuery($query);
		$fetch = mysql_fetch_assoc($query);
		return $fetch;
	}
	
	//row...
	public function fetchRow($query)
	{
		$this->addQuery($query);
		$fetch = mysql_fetch_row($query);
		return $fetch;
	}
	
	//array...
	public function fetchArray($query)
	{
		$this->addQuery($query);
		$fetch = mysql_fetch_array($query);
		return $fetch;
	}
	
	//obj...
	public function fetchObj($query)
	{
		$this->addQuery($query);
		$fetch = mysql_fetch_object($query);
		return $fetch;
	}
	
	/**
	 * Method: results
	 * @var	   $string_query (string)
	 */
	public function results($string_query)
	{
		$this->addQuery($string_query);
		$result = array();
		//execute..
		$xq = $this->q($string_query);
		if($xq){
			$w=0;
			while($tmp = $this->fetchArray($xq))
			{
				for($i=0; $i<mysql_num_fields($xq); $i++)
				{
					$tmp[$i] = utf8_encode($tmp[$i]);
					$result[$w][mysql_field_name($xq, $i)] = stripslashes($tmp[$i]);
				}
				$w++;
			}
			return $result;
		}
		else {
			$this->error();
			return false;
		}
	}
	
	/**
	 * Method: result
	 * @var	   $string_query (string)
	 */
	public function result($string_query)
	{
		$this->addQuery($string_query);
		$info = array();
		//execute..
		$xq = $this->q($string_query);
		if($xq){
			$tmp = $this->fetchArray($xq);
			for($i=0; $i<mysql_num_fields($xq); $i++)
			{
				$tmp[$i] = utf8_encode($tmp[$i]);
				$info[mysql_field_name($xq, $i)] = stripslashes($tmp[$i]);
			}
			return $info;
		}
		else {
			$this->error();
			return false;
		}
	}
	
	/**
	 * Method: listTables
	 */
	public function listTables()
	{
		if(!$this->isOpen){
        	$this->open();
		}
		//
		$this->tablesInstaled = array();
		
		$result = @mysql_list_tables($this->dbname);
		//
		if (!$result) {
			$this->error();
		}
		//	
		while ($row = mysql_fetch_row($result)) {
			$this->tablesInstaled[] = $row[0];
		}
		//
		mysql_free_result($result);
		
		return $this->tablesInstaled;
	}
	
	/**
	 * Method: open
	 */
	private function open()
	{
		/*if(!$this->dbselected)
		{*/
			//conn
			$this->conn = mysql_connect($this->dbhost, 
										$this->dbuser, 
										$this->dbpass) or $this->error();
			//select_db
			$this->dbselected = mysql_select_db($this->dbname, $this->conn);
			$this->isOpen = true;
		/*}
		else {
			echo 'esta aberta<br/>';
		}*/
	}
		
	/**
	 * Method: open
	 */
	private function close()
	{
		if($this->isOpen) mysql_close($this->conn);
		$this->isOpen = false;
	}
	
	/**
	 * Method: error
	 */
	private function error($msg="")
	{
		if($msg) echo $msg.'<br/>';
		//$this->printQueries();
		die("\n<pre><strong>ATEN&Ccedil;&Atilde;O</strong>: " . mysql_error() . "</pre>");
	}
	
	/**
	 * Method: getters
	 */
	public function dbhost()
	{
		return $this->dbhost;
	}
	public function dbname()
	{
		return $this->dbname;
	}
	public function dbuser()
	{
		return $this->dbuser;
	}
	public function dbpass()
	{
		return $this->dbpass;
	}
	
	/**
	 * Method: Queries
	 */
	private function addQuery($string_query)
	{
		$this->queries[] = $string_query;
	}
	
	private function printQueries()
	{
		echo '<pre><hr/>';
		for($i=0;$i<count($this->queries);$i++):
			echo $this->queries[$i].'<br/>';
			echo '<hr/>';
		endfor;
		echo '</pre>';
	}
}

$Db = new DB( $config );

?>