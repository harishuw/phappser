<?php/*******************************************class.error.php*********************Created by Harish U Warrier*********Created on 01-06-2014***************Modified on ************************huwz1it@gmail.com**************************************************/class error {		public $image;		function __construct()	{		$this->image=$this->get_phappser_img();		}			function get_error_type()	{		$date=date('m-d-Y g:i A');	}	function log_error()	{	}	function set_error_message()	{		$error_msg=func_num_args()>0?trim(func_get_arg(0))!=""?func_get_arg(0):"Page Not Found":"Page Not Found";		$error_title=func_num_args()>1?trim(func_get_arg(1))!=""?func_get_arg(1):"Page Not Found":"Page Not Found";		return'<!DOCTYPE html>				<html xmlns="http://www.w3.org/1999/xhtml">					<head>					  <title>'.$error_title.'</title>					  <style>						body						{							text-align:center;							color:#A09296;							font-size:25px;						}						.bor						{							margin: 90px;						}					  </style>					</head>					<body>						<div class="bor">							<img src="'.$this->image.'" width>							<div>'.$error_msg.'</div>						</div>					</body>				</html>';	}		function get_phappser_img()	{		return"data:image/png;base64,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";	}	function get_oops_img()	{		return "data:image/png;base64,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			SuQmCC";	}	}