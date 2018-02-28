<?php

# Commit Test
//error_reporting(E_ALL);
$auth_pages = array();
$auth_pages[] = "home";
$auth_pages[] = "call_distribution";
$auth_pages[] = "call_statistics";
$auth_pages[] = "sms_service";
$auth_pages[] = "agents";
$auth_pages[] = "call_report";
$auth_pages[] = "dashboard";
$auth_pages[] = "twilio_settings";
$auth_pages[] = "pipedrive_settings";
$auth_pages[] = "pipedrive-dashboard-source";



if ($_REQUEST['logout']) {
    User::killSession();
}
_auth_url($auth_pages, "login");
?>