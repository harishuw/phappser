<?php
/*
**************************************
******class.curl.php******************
******Created by Harish U Warrier*****
******Created on 14-10-2014***********
******Modified on 14-10-2014**********
******huwz1it@gmail.com***************
**************************************
*/
class curl
{
	public $url;
	public $output;
	public $curl_var;
	public $is_post=true;
	public $is_return=true;
	public $ssl_verifier=false;
	public $params=array();
	public $request_type="GET";

	public function __construct()
	{
		$this->curl_var = curl_init();
    }
	
	public function process_request()
	{
		curl_setopt($this->curl_var, CURLOPT_URL, $this->url);
        curl_setopt($this->curl_var, CURLOPT_POST,$this->is_post);
        curl_setopt($this->curl_var, CURLOPT_POSTFIELDS,$this->params);
        curl_setopt($this->curl_var, CURLOPT_RETURNTRANSFER, $this->is_return);
		curl_setopt($this->curl_var, CURLOPT_CUSTOMREQUEST, $this->request_type);
        curl_setopt($this->curl_var, CURLOPT_SSL_VERIFYPEER, $this->ssl_verifier);
		
		$this->output = curl_exec($this->curl_var);
		curl_close($this->curl_var);
	}
	
	public function get_output()
	{
		return $this->output;
	}
	
	public function send_request($options=array())
	{
		if(isset($options['url']))
			$this->url=$options['url'];
			
		if(isset($options['post]']))
			$this->is_post=$options['post'];	
		
		if(isset($options['is_return]']))
			$this->is_return=$options['is_return'];
		
		if(isset($options['ssl_verifier]']))
			$this->is_return=$options['ssl_verifier'];		
		
		if(isset($options['params]']))
			$this->params=$options['params'];	
		
		$this->process_request();	
		return $this->get_output();
	}
	
}
