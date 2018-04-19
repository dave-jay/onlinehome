<?php

$GLOBALS['tenant_id'] = $_REQUEST['tenant_id'];
include _PATH.'instance/front/controller/define_settings.inc.php';    

$message = str_replace("__","\n\r",str_replace("||", " ", $_REQUEST['message']));
addLogs($_REQUEST['q'],$_REQUEST['tenant_id'], "Trying to send on {$_REQUEST['phone']} Message is : ".$message);
file_put_contents("/kunden/homepages/21/d606346880/htdocs/admin/error_log/error.txt", "\nMessage from leadpropel".$message, FILE_APPEND);
$apiCall = new callWebhook();
$apiCall->messageNow($_REQUEST['phone'], $message, "2");
die;
?>