<?php

/**
 * Admin side Signup file
 * 
 * 

 * @version 1.0
 * @package LySoft
 * 
 */
$login_error = '';
if ($_REQUEST['submit']) {
    if (!User::doDirectQuoteLogin($_REQUEST['email'])) {
        if (User::doSignup($_REQUEST)) {
            User::doDirectQuoteLogin($_REQUEST['email']);
            User::setSession($_REQUEST['email']);
            $_SESSION['user']['tenant_id'] = $_SESSION['user']['id'];
            User::createUniqueCode($_SESSION['user']['tenant_id']);
            User::setDefaults($_SESSION['user']['tenant_id']);
            User::setConfig($_SESSION['user']['tenant_id']); 
            _R(lr('plans'));
        } else {
            $error_msg = "Something is beign wrong. Please try again.";
            $login_error = 1;
        }
    } else {
        $error_msg = "Email already exist";
        $login_error = 1;
    }
}


if (isset($_SESSION['user'])) {
    _R(lr('pipedrive-dashboard-source'));
}

$no_visible_elements = true;
$jsInclude = "signup.js.php";

_cg("page_title", "Signup");
?>