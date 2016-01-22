<?php
//d($_REQUEST);
$urlArgs = _cg("url_vars");
$agent = qs("select pd_id,name from pd_users where phone = '{$urlArgs[0]}'   ");
$agent_id = $agent['pd_id'];
$agent_name = $agent['name'];
$recording_url = (isset($_REQUEST['RecordingUrl'])?$_REQUEST['RecordingUrl']:'');
$recording_duration = (isset($_REQUEST['RecordingDuration'])?$_REQUEST['RecordingDuration']:'0');
//qi('config',array("key"=>$agent_id,"value"=>$urlArgs[1]));

$apiPD = new apiPipeDrive();
//$apiPD->assignDeal($urlArgs[1], $agent_id);

$call_detail_data = q("select * from call_detail where sid='{$_REQUEST['CallSid']}'");
$call_detail_fields['agent_phone'] = $urlArgs[0];
$call_detail_fields['agent_id'] = $agent_id;
$call_detail_fields['agent_name'] = $agent_name;
$call_detail_fields['status'] = (isset($_REQUEST['DialCallStatus'])?$_REQUEST['DialCallStatus']:'');
$call_detail_fields['recording_duration'] = $recording_duration;
$call_detail_fields['recording_url'] = $recording_url;
$call_detail_fields['customer_phone'] = urlencode($urlArgs[2]);
$call_detail_fields['deal_id'] = $urlArgs[1];

if(count($call_detail_data)>0){
    $call_detail_id = $call_detail_data[0]['id'];
    qu('call_detail',$call_detail_fields,"id='{$call_detail_data[0]['id']}'");
}else{
    $call_detail_fields['sid'] = $_REQUEST['CallSid'];
    $call_detail_id = qi('call_detail',$call_detail_fields);
}

$deal_data = json_decode($apiPD->getDealInfo($urlArgs[1])); //$deal_data = json_decode($apiPD->getDealInfo('4586'));
//$deal_data = json_decode($apiPD->getDealInfo('4586'));
$person_id = isset($deal_data->data->person_id->value)?($deal_data->data->person_id->value):'';
$org_id = isset($deal_data->data->org_id->value)?($deal_data->data->org_id->value):'';
//$apiPD->assignPerson($person_id, $agent_id);
//$apiPD->assignOrganization($org_id, $agent_id);

$fields['subject'] = 'Call';
$fields['done'] = '1';
$fields['type'] = 'call';
$fields['deal_id'] = $urlArgs[1]; // Test Deal Id - $fields['deal_id'] = '4586';
$fields['person_id'] = $person_id;
$fields['org_id'] = $org_id;
/*
$param = http_build_query(array('call_detail_id'=>$call_detail_id.'|'.urlencode($recording_url.'|'.$recording_duration)));
$fields['note'] = "<iframe src='https://www.leadpropel.com/playAudio?".$param."' width='380' height='110'></iframe>";
$data = $apiPD->createActivity($fields);
$activity_data = json_decode($data);
if(isset($activity_data->success) && $activity_data->success){    
    qu('call_detail',array("activity_id"=>$activity_data->data->id),"id='{$call_detail_id}'");
}else{
    d($activity_data);
    echo "Failed to create activity";
}*/
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<Response></Response>";
?><?php die; ?>