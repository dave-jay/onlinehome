<?php

/**
 *
 * @author Dave Jay <dave.jay90@gmail.com>
 * @version 1.0
 * @package Documentation
 * 
 
 */
session_start();
error_reporting(0);
// For Mail variables 
define('SMTP_EMAIL_USER_NAME', 'testaccts001@gmail.com'); # smtp service username
define('SMTP_EMAIL_USER_PASSWORD', 'testaccts001.'); # smtp service password
define('MAIL_FROM_EMAIL', 'testaccts001@gmail.com'); # email to be used a from email
define('MAIL_FROM_NAME', 'Sprout Lending'); # name to be used as from email

define('SMTP_EMAIL_USER_NAME_QUOTE', 'testaccts001@gmail.com'); # smtp service username for quotes 
define('SMTP_EMAIL_USER_PASSWORD_QUOTE', 'testaccts001.'); # smtp service password for quotes - old vanquotes

# DB informaitons
define('DB_HOST', 'localhost');
define('DB_PASSWORD', '');
define('DB_UNAME', 'root');
define('DB_NAME', 'lysoft');
include "loader.php";
?>
