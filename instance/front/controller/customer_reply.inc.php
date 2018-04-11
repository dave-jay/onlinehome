<?php
if(!isset($_REQUEST['seq_id'])){
    addLogs($_REQUEST['q'], 0, "Id not set");
    die;
}else{
    $sms_sequence_data = qs("select * from sms_sequence where id = '{$_REQUEST['seq_id']}'");
    if(!isset($sms_sequence_data['tenant_id'])){
        addLogs($_REQUEST['q'], 0, "tenant_id must be set.");
        die;
    }
    addLogs($_REQUEST['q'],$sms_sequence_data['tenant_id'], "Sequence id has been set");
}
$GLOBALS['tenant_id'] = $sms_sequence_data['tenant_id'];
include _PATH.'instance/front/controller/define_settings.inc.php';    

$apiPD = new apiPipeDrive($conf_data['PIPEDRIVER_API_KEY']);
$deal_detail[$conf_data['FOLLOWUP_SEQUENCE_KEY']] = 'OFF';
$apiPD->modifyDeal($sms_sequence_data['last_deal_id'], $deal_detail);
qu("sms_sequence",array("need_to_send_sms"=>"0"),"tenant_id='{$GLOBALS['tenant_id']}' AND last_deal_id='{$sms_sequence_data['last_deal_id']}'");
qu("email_sequence",array("need_to_send_email"=>"0"),"tenant_id='{$GLOBALS['tenant_id']}' AND last_deal_id='{$sms_sequence_data['last_deal_id']}'");
if($GLOBALS['tenant_id']!=1){ die; }
$_REQUEST['cont']=$sms_sequence_data['reply'];
$agent_name = explode(" ", $sms_sequence_data['agent_name']);
$agent = $agent_name[0];
$customer_name = explode(" ", $sms_sequence_data['customer_name']);
$customer = $customer_name[0];

$deal_info = $apiPD->getDealInfo($sms_sequence_data['last_deal_id']);
$deal_info = json_decode($deal_info, TRUE);

$org_id = $deal_info['data']['org_id']['value'];

$org_data = $apiPD->getOrganizationInfo($org_id);
$org_data = json_decode($org_data, "true");

$org_for = 'Working Capital';
if (isset($org_data['data']['48b7dac9e6fa7666a2f0d9e233bb5139f7493a44'])) {
    $org_for = getUseOfFundText($org_data['data']['48b7dac9e6fa7666a2f0d9e233bb5139f7493a44']);
}

$getSMSReply = getSMSReply($sms_sequence_data);
$message = getSMSText($sms_sequence_data, "1", $getSMSReply['key']);
$message = str_ireplace("[USE OF FUNDS]", $org_for, $message);
$message = str_ireplace("[COMPANY NAME]", $sms_sequence_data['org_name'], $message);
$message = str_ireplace("[AGENTS NAME]", $agent, $message);
$message = str_ireplace("[MERCHANTS NAME]", $customer, $message);
$message = str_ireplace("[AMOUNT REQUESTED]", $sms_sequence_data['deal_amount'], $message);

$text = "Customer replied on following SMS.\n\n";
$text .= "*".$sms_sequence_data['agent_name']." (Agent)* : ".$message."\n\n";
$text .= "*".$sms_sequence_data['customer_name']." (Customer)* : ".$_REQUEST['cont']."\n\n";
$text .= "*Deal Name* : ".$sms_sequence_data['deal_name']."\n\n";
$text .= "*Link* : https://sprout2.pipedrive.com/deal/".$sms_sequence_data['last_deal_id']."\n\n";
$Slack = new apiSlack();
$result = $Slack->pingSlack($text);
die;
?>