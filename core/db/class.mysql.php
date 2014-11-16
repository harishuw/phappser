<?php
/*
***********************************
********class.mysql.php************
********Created by HUW*************
********Created on 02-03-2014******
********Modified on 10-04-2014*****
***********************************
***********************************
*
*
*/
class mysql extends mysqlfunctions
{

	public $pipe;
	public $phost;
	public $puser;
	public $ppass;
	public $pdb;

	function __construct($dbconfig)
	{
			
			$this->phost=$dbconfig['DB_HOST'];
			$this->puser=$dbconfig['DB_USERNAME'];
			$this->ppass=$dbconfig['DB_PASSWORD'];
			$this->pdb=$dbconfig['DB_NAME'];
			$this->connect();
	}
	
	//connect to db
	function connect()
	{
	//echo $this->error->set_error_message("Controller ".$page." is not defined","Controller not defined");
		try
		{
	
		if($this->pipe=mysqli_connect($this->phost,$this->puser,$this->ppass,$this->pdb))
		{
		
		}else
		{
		global $error;
			$error->set_error_message();
			exit;
		}

		}catch(exception $e)
		{
		//print_r($e);
			if (mysqli_connect_errno()) {
				
				
				printf("Connect failed: %s\n", mysqli_connect_error());
	   
			}
		}
	}
		
	
	//query to db
	
	function query($query)
	{
		return mysqli_query($this->pipe,$query);
	}
	
	//close connection
	function closedb()
	{
		mysql_close($this->pipe);
	}
	
	function insert_id()
	{
		return mysqli_insert_id($this->pipe);
	}
}





?>