<?php
session_start();
//echo $_SESSION['user_id'];
if(!$_SESSION['user_id'] && !$_POST['login']) {
	header('location:login');
	exit;
}
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set( 'display_errors',1); 

//Application Username & token Start

define('DOMAIN','https://vimalrecharge.com');
define('UNAME','KWA001');
define('TOKEN','b13ed02094631fa0a6b1817f90cd17a6');

//Application Username & token End
//Abhipay Supoort & Bank Start
$phone="+91-9313606065";
$email="abhipaycare@gmail.com";



//Shiba technology Supoort & Bank End
 $username = 'vimalrec_tajmoney';
 $password = 'Pass@1234567890';
 $databasename = 'vimalrec_tajmoney';
 $servername = 'localhost';

 define('DBHOST',$servername);
 define('DBUSER',$username);
 define('DBPASS',$password);
 define('DBNAME',$databasename);

class DB
{
	private $link;
	function __construct()
	{
		$this->connect();

	}
	function __destruct()
	{
		$this->close();
	}
	public function connect($server = DBHOST, $username = DBUSER, $password = DBPASS, $database = DBNAME)
	{
		
		$this->link = mysqli_connect($server, $username, $password, $database,'3306') or die(mysqli_error());
	}

	public function query_to_array($query)
	{
		$ret = array();
		$result=mysqli_query($this->link, $query);// or die("MySQL Error:query_to_array ".mysqli_error($this->link)." for query $query");
		if(@mysqli_num_rows($result)>0)
		{
			while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				array_push($ret, $row);
			}
		}
		return $ret;
	}

	public function get_row($query)
	{
		$ret = array();
		$result = mysqli_query($this->link, $query);
		if(@mysqli_num_rows($result)==1)
		{
			$row=mysqli_fetch_array($result);
			$ret= $row;
		}
		return $ret;
	}

	public function get_scalar($query)
	{
		$ret = null;
		try
		{
			$res = @mysqli_query($this->link, $query);
			$row=@mysqli_fetch_array($res);
			$ret = $row[0];
		}
		catch (Exception $e) { print_r($e->getTrace()); }
		return $ret;
	}
	public function get_no_rows($query)
	{
		$res = null;
		$res = mysqli_query($this->link, $query) or die(mysqli_error($this->link));;
		return mysqli_num_rows($res);
	}
	public function query($query)
	{
		return mysqli_query($this->link, $query);// or die($query.mysqli_error($this->link));		
	}

	public function insert_id()
	{
		return	mysqli_insert_id($this->link);
	}
	public function affected_rows()
	{
		return mysqli_affected_rows($this->link);
	}
	public function close() {
		return mysqli_close($this->link);
	}
	public function insert_db($table, $fields, $return_id=false) {
        $field_names = array();
        $values = array();
		//$cols = $this->get_columns($table);
        foreach ($fields as $key => $val) {
			//if(in_array($key,$cols)) 
			//{
            $field_names[] = "$key";
			$val2 = trim(addslashes($val));
            $values[] = "'$val2'";
			//}
        }
		//echo "INSERT INTO $table (" . implode(", ", $field_names) . ") VALUES (" . implode(", ", $values) . ")".PHP_EOL;
		
        mysqli_query($this->link, "INSERT INTO $table (" . implode(", ", $field_names) . ") VALUES (" . implode(", ", $values) . ")") or die("Error inserting new data into the ".$table." table - ".mysqli_error($this->link));

        if ($return_id == 1) {
            $new_id = mysqli_insert_id($this->link);
            return $new_id;
        }
    }
    
	public function update_db($table,$where,$fields,$value) {
		$update_string = array();
		$cols = $this->get_columns($table);
		foreach ($fields as $key => $val) {
			if(in_array($key,$cols)) 
			{
				$val2 = trim(addslashes($val));
				$update_string[] = "$key = '$val2'";
			}
		}
		mysqli_query($this->link,"UPDATE $table SET ".implode(", ", $update_string)." WHERE $where = '$value'") or die("Error updating new data into the ".$table." table - ".mysqli_error($this->link));
	}

	public function delete_db($table,$where,$value) {
	$success = mysqli_query($this->link,"DELETE FROM ".$table." WHERE ".$where." = ".$value."")
	or die("Error deleting from the ".$table." table - ".mysqli_error());
	}
}
global $Db;
$Db = new DB();
?>