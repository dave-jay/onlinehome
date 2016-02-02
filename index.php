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

define('IS_DEV_ENV', false);
define('FOLDER_RUN','admin/'); // when you are want to test in dev folder changed to 'dev/' and in live server changed to 'admin/'

include "loader.php";
?>
