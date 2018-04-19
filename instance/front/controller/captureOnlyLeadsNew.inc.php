<?php
$unique_code = $_REQUEST['unique_code'];
include _PATH.'instance/front/controller/define_settings.inc.php';
 addLogs($_REQUEST['q'], $GLOBALS['tenant_id'],"Yes, It's here");

if(strtolower($conf_data['CALL_STATUS'])!="on"){
    addLogs($_REQUEST['q'], $GLOBALS['tenant_id'], "call distribution is off");
    die;
}
_errors_on();
# Get Pipedrive API object
$apiPD = new apiPipeDrive($conf_data['PIPEDRIVER_API_KEY']);
$apiCall = new callWebhook();

# receive the payload
$payload = file_get_contents('php://input');
$data = json_decode(@$payload, true);

//Getting Deal Info and change stage if pipeline id is '1' (i.e. for "Leads")
addLogs($_REQUEST['q'], $GLOBALS['tenant_id'],"new Deal: ".$data['current']['id']);
$deal_info = $apiPD->getDealInfo($data['current']['id']);
$deal_info = json_decode($deal_info, TRUE);
//if($deal_info['data']['pipeline_id']=="1"){
//    $deal_info = $apiPD->modifyDeal($data['current']['id'],array("stage_id"=>"1"));
//}
// store into the database
//qi("pd_push_notification_log", array("payload" => _escape($payload)));

# now, identify if that is hot lead then get the number of customer and start calling the customer
# c2a6fc3129578b646ae55717ed15f03ce3ee4df0 - this is key for custom attribute/field - "Source"
$deal_source = $data['current'][$conf_data['PIPEDRIVE_SOURCE']];
$pd_sources = q("select * from pd_sources where is_active='1' AND tenant_id='2'");
$source = array();
addLogs($_REQUEST['q'], $GLOBALS['tenant_id'],"source: ".$deal_source);
foreach ($pd_sources as $each) { $source[] = $each['pd_source_id']; }
addLogs($_REQUEST['q'], $GLOBALS['tenant_id'],"All sources: ".  json_encode($source));

if (in_array($deal_source, $source)) { //37 for HotLeads & 44 for HotLead2
    
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
    $agent_numbers = $apiPD->getAgentByDealSource($deal_source,$GLOBALS['tenant_id']);
   
    # Finally call the agents
    addLogs($_REQUEST['q'], $GLOBALS['tenant_id'],"All Agents: ".json_encode($agent_numbers));
    $apiCall->callNow($phone_value, $agent_numbers , $deal_id, "0", "A"); 
}
//15162004065 - dj
// 15165249063 - wayne

// 18664632339 - godaddy
// salesforce - 18006676389
die;
?>