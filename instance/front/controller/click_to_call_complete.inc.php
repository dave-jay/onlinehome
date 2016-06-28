<?php
d($_REQUEST);
$agent_numbers = $_REQUEST['agent_number'];
$dealId = _e($_REQUEST['dealId'], '0');
$phone_value = urlencode($_REQUEST['phone_value']);
$click_to_call_id = urlencode($_REQUEST['click_to_call_id']);
qu("click_to_call",$fields,"id='{$click_to_call_id}'");
die;
?>