<?php
$apiCall = new apiCall();
$agent_numbers = array('+18774942065','+18664632339','+18009614454');
$deal_id = '0';
$apiCall->doBroadcast('+13234733078', $agent_numbers, $deal_id);
die;
?>