<?php

$payload = file_get_contents('php://input');
$data = json_decode(@$payload, true);
qi("test",  _escapeArray(array("payload"=> json_encode($data))));
qi("test",  _escapeArray(array("payload"=> json_encode($_POST))));
qi("test",  _escapeArray(array("payload"=> json_encode($_REQUEST))));
die;
?>