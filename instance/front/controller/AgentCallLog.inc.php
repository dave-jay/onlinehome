<?php
$urlArgs = _cg("url_vars");
//$dealId = $_SESSION['dealId'];

    $agent_id = qs("select pd_id from pd_users where phone = '{$urlArgs[0]}'   ");
$agent_id = $agent_id['pd_id'];

$apiPD = new apiPipeDrive();
$apiPD->assignDeal($urlArgs[1], $agent_id);

    //$agent_numbers = $_REQUEST['agent_no'];
    //$dealId = $_REQUEST['dealId'];
    
   
die; ?>