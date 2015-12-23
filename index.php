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
define('DB_HOST', 'db606436013.db.1and1.com');
define('DB_PASSWORD', 'Brusgus23!');
define('DB_UNAME', 'dbo606436013');
define('DB_NAME', 'db606436013');

define('IS_DEV_ENV', false);

include "loader.php";
?>
