<?php
_errors_on();
//$person_id_test = '4421';
//$apiPD = new apiPipeDrive();
//$person_info = $apiPD->getPersonInfo($person_id_test);
//$person_info = json_decode($person_info, true);
//d($person_info);
//die;
//
//$wayne_user_id = '701588';
//$dave_user_id = '990918';
//$dave_test_deal_id = '4409';
//
//$apiPD = new apiPipeDrive();
//
////$apiPD->assignDeal($dave_test_deal_id, $dave_user_id); 
//$apiPD->assignDeal($dave_test_deal_id, $wayne_user_id); 
//$deal_data = $apiPD->getDealInfo('4409');
//
//d(json_decode($deal_data),true);
//
//die;

$data = qs("select * from pd_push_notification_log");
$payload = json_decode($data['payload'], true);
d($payload);

die;

# Get Pipedrive API object
$apiPD = new apiPipeDrive();

# Set default timezone
date_default_timezone_set('America/New_York');

# receive the payload
$payload = file_get_contents('php://input');
$data = json_decode(@$payload, true);

// store into the database
qi("pd_push_notification_log", array("payload" => $payload));

# now, identify if that is hot lead then get the number of customer and start calling the customer
# c2a6fc3129578b646ae55717ed15f03ce3ee4df0 - this is key for custom attribute/field - "Source"
if (in_array($data['current']['c2a6fc3129578b646ae55717ed15f03ce3ee4df0'], array('37'))) {
    $person_id = $data['current']['person_id'];

    # Get Person info
    $person_info = $apiPD->getPersonInfo($person_id);
    $person_info = json_decode($person_info, true);

    # Get Phone
    $phone = $data['data']['phone']['0'];
    $phone_label = $phone['label'];
    $phone_value = $phone['value'];

    # Get Email
    $email = $data['email']['0'];
    
    //
}

die;
?>