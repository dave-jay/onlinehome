<?php

$message = str_replace("__","\n\r",str_replace("||", " ", $_REQUEST['message']));
file_put_contents("/kunden/homepages/21/d606346880/htdocs/admin/error_log/error.txt", "\nMessage from leadpropel".$message, FILE_APPEND);
$apiCall = new callWebhook();
$apiCall->messageNow($_REQUEST['phone'], $message, "2");
die;
?>