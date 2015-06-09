<?php
class MyConnection
{
    	private $host = '174.136.57.160';
		private $username = 'www7tech_Pro';
		private $database = 'www7tech_WebShopDB';
		private $mylink;
		private $sql;
		private $result;
		private $password = 'piseth123';
		
		
		/*
		private $host = 'localhost';
		private $username = 'root';
		private $database = '7stockweb';
		private $mylink;
		private $sql;
		private $result;
		private $password = '';
		
		private $host = 'localhost';
		private $username = 'sm24all_stock';
		private $database = 'sm24all_stock';
		private $mylink;
		private $sql;
		private $result;
		private $password = 'QNUbK$gT$d^y';
		
		*/
		
			    
    function connect()
	{
		$this->mylink = mysql_connect($this->host,$this->username,$this->password) or die("Fail to Select Host");
		mysql_select_db($this->database) or die("Fail to select Database. Please Contact Admin"); 
		return $this->mylink;
	}
	
    function query($sql)
	{
		if (!empty($sql))
		{
			$this->sql = $sql;
			$this->result = mysql_query($sql,$this->mylink);
			return $this->result;
		}else
		{
			return false;
		}
    }
	
	function dbCountRows(&$result) 
	{
		$numRows = @mysql_num_rows($result);
		if ( $numRows ) 
		{
			return $numRows;
		}
		else
		{
			return 0;
		}
	}	
			
	function fetch($result=""){
                if (empty($result)){ $result = $this->result; }
                return mysql_fetch_object($result);
        }
				
	function disconnect()
	{
        mysql_close($this->mylink);
    }
	
	//Create Function for query Select
    function Select($info, $table) 
	{ 
		if (!is_array($info)) 
		{ 
			die("insert member failed, info must be an array"); 
		} 
		
		//build the query 
		$sql = "Select * ".$table." ("; 
		for ($i=0; $i<count($info); $i++) 
		{ 
			//we need to get the key in the info array, which represents the column in $table 
			$sql .= key($info); 
			//echo commas after each key except the last, then echo a closing parenthesis 
			if ($i < (count($info)-1)) 
			{ 
				$sql .= ", "; 
			} 
			else 
				$sql .= ") "; 
			//advance the array pointer to point to the next key 
			next($info); 
		} 
		//now lets reuse $info to get the values which represent the insert field values 
		reset($info); 
		$sql .= "VALUES ("; 
		for ($j=0; $j<count($info); $j++) 
		{ 
			$sql .= "'".current($info)."'"; 
			if ($j < (count($info)-1)) { 
			$sql .= ", "; 
			} else $sql .= ") "; 
			next($info); 
		} 
			//execute the query 
			mysql_query($sql) or die("query failed ".mysql_error()); 
			return mysql_insert_id(); 
	}
	
	
		
	function delete($table,$column,$condition)
	{
		$sql="delete from $table where $column='".intval($condition)."' ";
		$query=mysql_query($sql);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		
		}
	}
 }
?>