<?php
/*
***********************************
********uri.php********************
********Created by HUW*************
********Created on 12-10-2014******
********Modified on ***************
***********************************
***********************************
*/
if ( ! function_exists('uri'))
{
       
    function uri($key,$full = false)
    {
        
        $url=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $base=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']. preg_replace('@/+$@','',stripslashes(dirname($_SERVER['SCRIPT_NAME']))).'/';
        $furl= str_replace($base,'', $url);
        $furl=str_replace('index.php','', $furl);
        $qrysplit=explode('?',$furl);
        $query=isset($qrysplit[1])?$qrysplit[1]:'';
        $furl=isset($qrysplit[0])?$qrysplit[0]:'';
        $segment= explode('/',$furl);
        $segment= array_values(array_filter($segment));
        if(!$full)
        {
            if(isset($segment[$key]))
            {
                $final=explode('?',trim($segment[$key]));
                return $final[0];
            }else
            {
                return "";
            }
        }else
        {
            return array('base_url'=>$base,'current_url'=>$url,'full'=>$segment,'actions'=>$furl,'query'=>$query);
        }
    }
}
