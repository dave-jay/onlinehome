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
    $call_detail_id = $call_detail_data['id'];
}else{
    $call_detail_fields['sid'] = $_REQUEST['ParentCallSid'];
    $call_detail_id = qi('call_detail',$call_detail_fields);
}
$fields['subject'] = 'Call';
$fields['done'] = '0';
$fields['type'] = 'call';
$fields['deal_id'] = $urlArgs[1]; // Test Deal Id - $fields['deal_id'] = '4586';
$fields['note'] = "<iframe src='".lr("playAudio?call_detail_id=".$call_detail_id)."' width='380' height='100'></iframe>";
//$data = $apiPD->createActivity($fields);
$activity_data = json_decode($data);
if(isset($activity_data->success) && $activity_data->success){    
    qu('call_detail',array("activity_id"=>$activity_data->data->id),"id='{$call_detail_id}'");
}else{
    echo "Failed to create activity";
}


header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<Response></Response>";
die; ?>