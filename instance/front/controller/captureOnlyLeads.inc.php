<?php
$call_status = qs("select *,value as call_status from config where `key` = 'CALL_STATUS'");
if(strtolower($call_status['call_status'])!="on"){
    qi("test",array("t"=>"call distribution is off."));
    die;
}
_errors_on();
# Get Pipedrive API object
$apiPD = new apiPipeDrive();
$apiCall = new callWebhook();

# Set default timezone
date_default_timezone_set('America/New_York');

# receive the payload
$payload = file_get_contents('php://input');
$data = json_decode(@$payload, true);

//Getting Deal Info and change stage if pipeline id is '1' (i.e. for "Leads")
$deal_info = $apiPD->getDealInfo($data['current']['id']);
$deal_info = json_decode($deal_info, TRUE);
if($deal_info['data']['pipeline_id']=="1"){
    $deal_info = $apiPD->modifyDeal($data['current']['id'],array("stage_id"=>"1"));
}
// store into the database
//qi("pd_push_notification_log", array("payload" => _escape($payload)));

# now, identify if that is hot lead then get the number of customer and start calling the customer
# c2a6fc3129578b646ae55717ed15f03ce3ee4df0 - this is key for custom attribute/field - "Source"
$deal_source = $data['current']['c2a6fc3129578b646ae55717ed15f03ce3ee4df0'];
if (in_array($deal_source, array('37')) || 1) {
    
    # Get Person ID
    $person_id = $data['current']['person_id'];
    
    # Get Deal ID
    $deal_id = $data['current']['id'];
    
    # Get Person info
    $person_info = $apiPD->getPersonInfo($person_id);
    $person_info = json_decode($person_info, true);

    # Get Phone
    $phone = $person_info['data']['phone']['0'];
    $phone_label = $phone['label'];
    $phone_value = $phone['value'];

    # Get Email
    $email = $data['email']['0'];

    # Retrieve which agents we have to broadcast from source ( i.e. HotDeal, CCC, Dialer )
    $agent_numbers = $apiPD->getAgentByDealSource($deal_source);
   
    # Finally call the agents
    $apiCall->callNow($phone_value, $agent_numbers , $deal_id, "0", "A"); 
}
//15162004065 - dj
// 15165249063 - wayne

// 18664632339 - godaddy
// salesforce - 18006676389
die;
?>