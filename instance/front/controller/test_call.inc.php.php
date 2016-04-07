<?php
$urlArgs = _cg("url_vars");
$apiCall = new callWebhook();
//$agent_numbers = array('+18774942065','+18664632339','+18009614454','+18006676389','+919601431313','+13234733078');
$rand = mt_rand(1,1000) . "_" . mt_rand(1,1000);

$phone_value = '18006676389';
$agent_numbers = array("919737128291");
$deal_id = "T{$rand}";
if(isset($urlArgs[0]) && $urlArgs[0]!=''){
    $deal_id = $urlArgs[0];
}

$apiCall->callNow($phone_value, $agent_numbers, $deal_id);
die;
?>