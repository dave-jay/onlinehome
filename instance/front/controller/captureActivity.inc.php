<?php
$unique_code = $_REQUEST['unique_code'];
include _PATH.'instance/front/controller/define_settings.inc.php';

_errors_on();
$apiPD = new apiPipeDrive($conf_data['PIPEDRIVER_API_KEY']);
$apiCall = new callWebhook();

# receive the payload
//Test Mode  - Remove comment on Live
$payload = file_get_contents('php://input');
$data = json_decode(@$payload, true);

if($data['meta']['host']=='api.pipedrive.com' || $data['current']['type']!='text' || $data['current']['subject'] == 'SMS - Replied By Customer'){
    die;
}

$activity_id = $data['meta']['id'];
$person_id = $data['current']['person_id'];
$person_data = $apiPD->getPersonInfo($person_id);
$person_data = json_decode($person_data,true);
$message = $data['current']['note'];
$deal_id = $data['current']['deal_id'];
$org_id = $data['current']['org_id'];
$subject = $data['current']['subject'];
$subject = preg_replace("/[^0-9]/","",$subject);


$activityLogArray = array();

if(strlen($subject)<10){
    $phone_value = isset($person_data['data']['phone'][0]['value'])?$person_data['data']['phone'][0]['value']:'-1';
}else{
    $phone_value = $subject;
    $activityLogArray['number_from_subject'] = '1';
}

$activityLogArray['payload'] = $payload;
$activityLogArray['activity_id'] = $activity_id;
$activityLogArray['person_id'] = $person_id;
$activityLogArray['deal_id'] = $deal_id;
$activityLogArray['org_id'] = $org_id;

if($phone_value=='-1' || $phone_value==''){
    addLogs($_REQUEST['q'], $GLOBALS['tenant_id'], "Phone value is blank ");
}else{    
    $activityLogArray['log'] = "Message sending on ".$phone_value;
    $activityLogArray['phone_value']= $phone_value = $apiCall->ValidateNumber($phone_value);
    $activityLogArray['phone_last10'] = last10Char($phone_value);
    addLogs($_REQUEST['q'], $GLOBALS['tenant_id'], "Message sending on ".$phone_value);
    $apiCall->messageNow($phone_value, $message); 
}


die;
?>