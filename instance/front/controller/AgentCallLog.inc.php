<?php
$urlArgs = _cg("url_vars");
//$dealId = $_SESSION['dealId'];

//d($urlArgs);

$agent = qs("select pd_id,name from pd_users where phone = '{$urlArgs[0]}'   ");
$agent_id = $agent['pd_id'];
$agent_name = $agent['name'];
qi('config',array("key"=>$agent_id,"value"=>$urlArgs[1]));
$apiPD = new apiPipeDrive();
$apiPD->assignDeal($urlArgs[1], $agent_id);

    //$agent_numbers = $_REQUEST['agent_no'];
    //$dealId = $_REQUEST['dealId'];


$call_detail_data = qs("select * from call_detail where deal_id='{$urlArgs[1]}'");
$call_detail_fields['agent_phone'] = $urlArgs[0];
$call_detail_fields['agent_id'] = $agent_id;
$call_detail_fields['agent_name'] = $agent_name;
$call_detail_fields['recording_duration'] = '';
$call_detail_fields['recording_url'] = '';
$call_detail_fields['customer_phone'] = urlencode($urlArgs[2]);
$call_detail_fields['deal_id'] = $urlArgs[1];

if(count($call_detail_data)>0){
    qu('call_detail',$call_detail_fields,"id='{$call_detail_data['id']}'");
}else{
    qi('call_detail',$call_detail_fields);
}


header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<Response></Response>";
die; ?>