<?php
$agent_numbers = explode(',', $_REQUEST['agent_numbers']);
$dealId = _e($_REQUEST['dealId'], 0);
$phone_value = urlencode($_REQUEST['phone_value']);
$cur_agent = $_REQUEST['cur_agent'];
$agent = qs("select pd_id,name from pd_users where phone = '{$cur_agent}'");

$agent_id = $agent['pd_id'];
$agent_name = $agent['name'];

$apiPD = new apiPipeDrive();
$apiPD->assignDeal($dealId, $agent_id);

$deal_data = json_decode($apiPD->getDealInfo($dealId)); //$deal_data = json_decode($apiPD->getDealInfo('4586'));
$person_id = isset($deal_data->data->person_id->value)?($deal_data->data->person_id->value):'';
$org_id = isset($deal_data->data->org_id->value)?($deal_data->data->org_id->value):'';
$source_id = isset($deal_data->data->c2a6fc3129578b646ae55717ed15f03ce3ee4df0)?($deal_data->data->c2a6fc3129578b646ae55717ed15f03ce3ee4df0):'';
$cust_name = isset($deal_data->data->person_id->name)?($deal_data->data->person_id->name):'';
$cust_email = isset($deal_data->data->person_id->email[0]->value)?($deal_data->data->person_id->email[0]->value):'';
$org_name = isset($deal_data->data->org_name)?($deal_data->data->org_name):'';
$apiPD->assignPerson($person_id, $agent_id);
$apiPD->assignOrganization($org_id, $agent_id);


$call_detail_data = q("select * from call_detail where sid='{$_REQUEST['CallSid']}'");
$call_detail_fields['agent_phone'] = $cur_agent;
$call_detail_fields['agent_id'] = $agent_id;
$call_detail_fields['agent_name'] = $agent_name;
$call_detail_fields['status'] = (isset($_REQUEST['CallStatus'])?$_REQUEST['CallStatus']:'');
$call_detail_fields['customer_phone'] = $phone_value;
$call_detail_fields['source_id'] = $source_id;
$call_detail_fields['customer_name'] = $cust_name;
$call_detail_fields['customer_email'] = $cust_email;
$call_detail_fields['org_name'] = $org_name;
$call_detail_fields['deal_id'] = $dealId;
$call_detail_fields['sid'] = $_REQUEST['CallSid'];
$call_detail_id = qi('call_detail',  _escapeArray($call_detail_fields));


$fields['subject'] = 'Call';
$fields['done'] = '1';
$fields['type'] = 'call';
$fields['deal_id'] = $dealId; // Test Deal Id - $fields['deal_id'] = '4586';
$fields['person_id'] = $person_id;
$fields['org_id'] = $org_id;

$param = http_build_query(array('call_detail_id'=>$call_detail_id));
$fields['note'] = "<iframe src='https://www.leadpropel.com/".FOLDER_RUN."playAudio?".$param."' width='380' height='110'></iframe>";
$data = $apiPD->createActivity($fields);
$activity_data = json_decode($data);
if(isset($activity_data->success) && $activity_data->success){    
    qu('call_detail',array("activity_id"=>$activity_data->data->id),"id='{$call_detail_id}'");
}

header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
// <Dial>+18774942065</Dial>
?>
<Response>
    <Say>Connecting to customer!</Say>    
    <Dial record="record-from-answer" action="<?php print _U; ?>RecordCallBack/<?php print $cur_agent; ?>/<?php print $dealId; ?>/<?php print $phone_value; ?>/<?php print $cur_agent; ?>" >        
        <Number statusCallbackEvent="answered"
                statusCallback="<?php print _U; ?>AgentCallLog/<?php print $cur_agent; ?>/<?php print $dealId; ?>/<?php print $phone_value; ?>/<?php print $cur_agent; ?>"
                statusCallbackMethod="POST"><?php print $phone_value; ?></Number>
    </Dial>        
</Response><?php die; ?>