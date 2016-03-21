<?php

_errors_on();
$apiPD = new apiPipeDrive();
$apiCall = new apiCall();
# Set default timezone
date_default_timezone_set('America/New_York');

# receive the payload
//Test Mode  - Remove comment on Live
$payload = file_get_contents('php://input');
$data = json_decode(@$payload, true);
//Test Mode - Delete following static code
//$payload1='{"v":1,"matches_filters":null,"meta":{"v":1,"action":"added","object":"activity","id":19126,"company_id":501009,"user_id":990918,"host":"sprout2.pipedrive.com","timestamp":1454411818,"permitted_user_ids":["*"],"trans_pending":false,"is_bulk_update":false},"retry":0,"current":{"id":19126,"company_id":501009,"user_id":990918,"done":false,"type":"text","reference_type":"none","reference_id":null,"due_date":"2016-02-02","due_time":"","duration":"","add_time":"2016-02-0211:16:58","marked_as_done_time":"","subject":"Dave Jay - (918)460-312","deal_id":4586,"org_id":4058,"person_id":4421,"active_flag":true,"update_time":"2016-02-0211:16:58","gcal_event_id":null,"google_calendar_id":null,"google_calendar_etag":null,"person_name":"DaveTest","org_name":"DaveTest","note":"Thisistest","deal_title":"DaveTestdeal","assigned_to_user_id":990918,"created_by_user_id":990918,"owner_name":"DaveJay(Programmer)","person_dropbox_bcc":"sprout2@pipedrivemail.com","deal_dropbox_bcc":"sprout2+deal4586@pipedrivemail.com","participants":[],"updates_story_id":128972,"parties":[{"id":3108,"activity_id":19126,"party_id":3108,"active_flag":true,"add_time":"2016-02-0211:16:58","update_time":null,"name":"DaveJay(Programmer)","address":"dave.jay90@gmail.com","person_id":null,"user_id":990918},{"id":3109,"activity_id":19126,"party_id":3109,"active_flag":true,"add_time":"2016-02-0211:16:58","update_time":null,"name":"DaveTest","address":"","person_id":4421,"user_id":null}]},"previous":null,"event":"added.activity"}';
//$data = json_decode($payload1,true);

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
    $activityLogArray['log'] = "Phone value is blank";
    qi('activity_log',$activityLogArray);
}else{
    
    $activityLogArray['log'] = "Message sending on ".$phone_value;
    $activityLogArray['phone_value']= $phone_value = $apiCall->ValidateNumber($phone_value);
    $activityLogArray['phone_last10'] = last10Char($phone_value);
    qi('activity_log',$activityLogArray);
    $apiCall->doMessage($phone_value, $message); 
}


die;
?>