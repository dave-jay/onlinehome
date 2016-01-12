<?php
d($_REQUEST);
$urlArgs = _cg("url_vars");
$agent = qs("select pd_id,name from pd_users where phone = '{$urlArgs[0]}'   ");
$agent_id = $agent['pd_id'];
$agent_name = $agent['name'];

$call_detail_data = q("select * from call_detail where sid='{$_REQUEST['CallSid']}'");
$call_detail_fields['agent_phone'] = $urlArgs[0];
$call_detail_fields['agent_id'] = $agent_id;
$call_detail_fields['agent_name'] = $agent_name;
$call_detail_fields['recording_duration'] = $_REQUEST['RecordingDuration'];
$call_detail_fields['recording_url'] = $_REQUEST['RecordingUrl'];
$call_detail_fields['customer_phone'] = urlencode($urlArgs[2]);
$call_detail_fields['deal_id'] = $urlArgs[1];

if(count($call_detail_data)>0){
    qu('call_detail',$call_detail_fields,"id='{$call_detail_data[0]['id']}'");
}else{
    $call_detail_fields['sid'] = $_REQUEST['CallSid'];
    qi('call_detail',$call_detail_fields);
}
?><?php die; ?>