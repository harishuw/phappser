<?php/********************************************class.phappser.php*****************Created by HUW*********************Created on 08-04-2014**************Modified on 13-10-2014****************************************************************************/    $time = microtime(TRUE);    $mem = memory_get_usage();    $controller;    include_once('core/functions/uri.php');    include_once('core/class.error.php');    include_once('functions/config.php');    include_once('core/class.controller.php');    include_once('core/class.routing.php');          $error=new error();    $config=config();    if($config->config['session'])    {        session_start();    }  $r=new routing();  $r->set_routing();    exit();    $page=uri(0);    set_routing();          /*  if(trim($page)=="")        {            $page=$routing['index_controller'];            $page=  explode('/', $page);            print_r($page);        }	if(file_exists('app/controller/'.$page.'.php'))	{	            include('app/controller/'.$page.'.php');            $controller=new $page();            route();	}else	{            $m=$t="";            if($config->config['debug'])            {                $m="Controller '".$page."' is not found";                $t="Controller not defined";            }            echo set_error_page($m,$t);            exit;	}	*/	function route($route)	{                        call_controller($route);exit;            global $controller;            global $page;            global $routing;            global $config;            $routes=$routing;            $uri=uri(0,TRUE);                      if(isset($uri['full'][1]))            {                $final=explode('?',trim($uri['full'][1]));                if($final[0]!='' && $final[0]!=null)                {                    $action=$final[0];                    $arg_array=array();                    $i=0;                    foreach($uri['full'] as $uris)                    {                        if($i!=0 && $i!=1)                        {                            if($uris)                            {                                $uris=explode('?',trim($uris));                                $arg_array[]=$uris[0];                            }                        }					                        $i++;                    }                    if(is_callable(array($controller, $action)))                    {                                call_user_func_array(array($controller,$action),$arg_array);                     }else if(is_callable(array($controller,'index')))                    {                        $k=array_unshift($arg_array,$action);                        call_user_func_array(array($controller,'index'),$arg_array);                     }else                    {                        $m=$t="";                        if($config->config['debug'])                        {                            $m="There is no '". $action."' function in Controller '".$page."'";                            $t="No Action defined";                        }                        echo set_error_page($m,$t);                        exit;                    }                }else                {                       if(is_callable(array($controller,'index')))                    {                        $controller->index();                    } else                    {                        $m=$t="";                        if($config->config['debug'])                        {                            $m="There is no index function in Controller '".$page."'";                            $t="No index function defined";                        }                        echo set_error_page($m,$t);                        exit;                    }				                }            }else            {                if(is_callable(array($controller,'index')))                {                    $controller->index();                }else                {                   $m=$t="";                    if($config->config['debug'])                    {                        $m="There is no index function in Controller '".$page."'";                        $t="No index function defined";                    }                    echo set_error_page($m,$t);                    exit;                }	            }	}        function call_controller($route)        {            global $controller;            $controll="";            $action="";            $actioncall=true;            if(isset($route[0]))            {                $controll=trim($route[0]);                unset($route[0]);            }            if(file_exists('app/controller/'.$controll.'.php'))            {	                include('app/controller/'.$controll.'.php');                $controller=new $controll();            }else            {                $m="Controller '".$controll."' is not found";                $t="Controller not found";                echo set_error_page($m,$t);                exit;            }            //print_r($route);            if(isset($route[1]))            {                $action=$route[1];               //echo$action;                if(!is_callable(array($controller, $action)) )                {                    $actioncall=FALSE;                    $action=check_callable($controller);                }else                {                    $actioncall=TRUE;                                                     }                 unset($route[1]);               // echo $route[1];            }else            {                $action=check_callable($controller);            }            $argarray=$route;            $argarray=  array_values($argarray);            print_r($action);            if($actioncall)            {                        call_user_func_array(array($controller,$action),$argarray);             }else            {                              $m="There is no '". $action."' function in Controller '".$controll."'";                $t="No Action defined";                echo set_error_page($m,$t);                exit;            }        }/*Set routing*/function set_routing(){    global $routing;    $routes=$routing;    $page=uri(0,TRUE);    $seg=$page['full'];    $main=$routes['index_controller'];        $main= explode('/',$main);    $main= array_values(array_filter($main));        if(count($seg)==0)    {       $seg=$main;    }    if(!file_exists('app/controller/'.$seg[0].'.php')){        unset($routes['index_controller']);        //$seg=$main;         array_unshift($seg,$main[0]);       }       //print_r($seg);        //return $page['actions'];             foreach ($routes as $key => $value)        {        }                call_controller($seg);   }/*Setting error page*/        function set_error_page($m="",$t=""){    global $error;    global $config;    if(!$config->config['debug'])    {         $m=$t="";    }    return $error->set_error_message($m,$t);        }	/*Chek callable controller*/function check_callable($controller){    global $config;    $index=$config->config['index_functions'];    $found=FALSE;    $result="";    foreach($index as $in)    {        if(is_callable(array($controller, $in)))        {            $found=TRUE;            $result=$in;            break;        }    }    if($found)    {        return $result;    }else    {        return "";        }}        