<?php
$urlArgs = _cg("url_vars");
//$dealId = $_SESSION['dealId'];

//d($urlArgs);

$agent_id = qs("select pd_id from pd_users where phone = '{$urlArgs[0]}'   ");
$agent_id = $agent_id['pd_id'];
qi('config',array("key"=>$agent_id,"value"=>$urlArgs[1]));
$apiPD = new apiPipeDrive();
$apiPD->assignDeal($urlArgs[1], $agent_id);

    //$agent_numbers = $_REQUEST['agent_no'];
    //$dealId = $_REQUEST['dealId'];


header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<Response></Response>";
die; ?>