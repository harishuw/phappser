<?php
/*
***********************************
********class.model.php************
********Created by HUW*************
********Created on 27-04-2014******
********Modified on 29-04-2014*****
***********************************
***********************************
*/
class model 
{
	
	public $dbconfig;
	public $db;
			
	function __construct($dbconfig)
	{
		include_once('db/class.mysqlfunctions.php');
		include_once('db/class.mysql.php');
		$this->dbconfig=$dbconfig;
		$this->db=new mysql($dbconfig);
	}
	
	function query($query)
	{
		return $this->db->query($query);
	}
	function result($query)
	{
		return $this->db->result($query);
	}
	
	function results($query)
	{
		return $this->db->results($query);
	}
	function num_result($query)
	{
		return $this->db->num_result($query);
	}
	
	function num_results($query)
	{
		return $this->db->num_results($query);
	}
	
	function obj_result($query)
	{
		return $this->db->obj_result($query);
	}
	
	function obj_results($query)
	{
		return $this->db->obj_results($query);
	}
	function insert_id()
	{
	
		return $this->db->insert_id();
	}





}
?>