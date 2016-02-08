<?php

/**
 * Main Index File...
 * 
 * App is single point entry
 * 
 * Assigns constant vars
 * 
 * 

 * @version 1.0
 * @package LySoft
 * 
 */
session_start();
error_reporting(0);

# DB informaitons
define('DB_HOST', 'localhost');
define('DB_PASSWORD', '');
define('DB_UNAME', 'root');
define('DB_NAME', 'lysoft');

define('IS_DEV_ENV', FALSE);
define('TOLL_FREE_NO', '18006676389');
define('CUSTOMER_NO', '918460422312');
define('AGENT_NO', '919737128291');
define('FOLDER_RUN','admin/'); // when you are want to test in dev folder changed to 'dev/' and in live server changed to 'admin/'

include "loader.php";
?>
