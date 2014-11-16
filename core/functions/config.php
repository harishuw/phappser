<?php
/*
***********************************
********config.php*****************
********Created by HUW*************
********Created on 12-10-2014******
********Modified on ***************
***********************************
***********************************
*/
    function config($dbconfig='',$config='')
    {
        include_once('core/class.config.php');
        return new config($dbconfig,$config);
    }