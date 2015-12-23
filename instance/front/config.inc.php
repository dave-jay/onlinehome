<?php
# Commit Test
//error_reporting(E_ALL);
$auth_pages = array();
$auth_pages[] = "home";



if ($_REQUEST['logout']) {
    User::killSession();
}
_auth_url($auth_pages, "login_new");
?>