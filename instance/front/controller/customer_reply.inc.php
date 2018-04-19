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

$from_number = $sms_sequence_data['phone'];
$body = $sms_sequence_data['reply'];
$message_con = "Text replied by client from {$from_number}.<br><br>Reply: {$body}";
$note_data['deal_id'] = $sms_sequence_data['last_deal_id'];
$note_data['content'] = $message_con;
$apiPD->createNote($note_data);

$agent_name = explode(" ", $sms_sequence_data['agent_name']);
$agent = $agent_name[0];
$customer_name = explode(" ", $sms_sequence_data['customer_name']);
$customer = $customer_name[0];
$deal_link = $conf_data['PIPEDRIVE_URL']."/deal/".$sms_sequence_data['last_deal_id'];

$deal_info = $apiPD->getDealInfo($sms_sequence_data['last_deal_id']);
$deal_info = json_decode($deal_info, TRUE);
$deal_title = $deal_info['data']['title'];

$subject = "Customer replied on your SMS";

$message = "<html>";
$message .= "<body>";
$message .= "<div style = 'font-family:verdana;'>";
$message .= "<div style = 'font-family: verdana;'>Hello, </div><br>";
$message .= "<div style = 'font-family: verdana;'>Customer replied on your SMS.</div><br>";
$message .= "<table style='border-collapse:collapse;border:1px solid #DADADA' border='1' cellpadding='10' cellspacing='0'/>";
$message .= "<tr><th style='background-color:#EEEEEE;text-align:left;'>Deal Name</th><td><a href='".$deal_link."' style='font-family: verdana; cursor: pointer; color: #4a79e7; text-decoration: none; font-weight: bold;'>".$deal_title."</a></td></tr>";
$message .= "<tr><th style='background-color:#EEEEEE;text-align:left;'>Customer Name</th><td>".$sms_sequence_data['customer_name']."</td></tr>";
$message .= "<tr><th style='background-color:#EEEEEE;text-align:left;'>Customer Phone Number</th><td>".$from_number."</td></tr>";
$message .= "<tr><th style='background-color:#EEEEEE;text-align:left;'>Customer Reply</th><td>".$body."</td></tr>";
$message .= "</table>";
$message .= "</div>";
$message .= "</body>";
$message .= "</html>";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
$headers .= "From: Lysoft Media  wayne@lysoft.com\r\n";
$headers .= "Reply-To: wayne@lysoft.com\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();
$headers .= "X-Priority: 1" . "\r\n";

$to = $deal_info['data']['user_id']['email'];
if(!empty($to)){
    mail("davej@lysoft.com", "TEST: ".$subject, $message, $headers);
    if (mail($to, $subject, $message, $headers) === TRUE) {
        addLogs($_REQUEST['q'],$sms_sequence_data['tenant_id'], "Mail send successfully");
    } else {
        addLogs($_REQUEST['q'],$sms_sequence_data['tenant_id'], "Mail sending fail");    
    }    
}else{
    addLogs($_REQUEST['q'],$sms_sequence_data['tenant_id'], "404 - Agent email address not found for deal :".$sms_sequence_data['last_deal_id']);    
}

//SEND SMS TO AGENT
$pd_user_data = qs("select * from pd_users where tenant_id='{$GLOBALS['tenant_id']}' AND  pd_id='{$deal_info['data']['user_id']['id']}'");
if(!empty($pd_user_data['cell'])){
    $message_con = "Text replied by client from {$from_number}.<br><br>Deal Name: {$deal_title}<br><br>Customer Name: {$sms_sequence_data['customer_name']}<br><br>Reply: {$body}";
    $message_con = str_replace("<br><br>","__",str_replace(" ", "||", $message_con));
    addLogs($_REQUEST['q'],$sms_sequence_data['tenant_id'], "sending message to agent on '{$pd_user_data['cell']}' for deal :".$sms_sequence_data['last_deal_id']);
    //$pd_user_data['cell'] = '+919265715578';
    file_get_contents("https://leadpropel.com/admin/sms_agent?tenant_id={$GLOBALS['tenant_id']}&phone={$pd_user_data['cell']}&message=".$message_con);
    
}else{
    addLogs($_REQUEST['q'],$sms_sequence_data['tenant_id'], "404 - Agent cell not found for deal :".$sms_sequence_data['last_deal_id']);
}

qu("sms_sequence",array("need_to_send_sms"=>"0"),"tenant_id='{$GLOBALS['tenant_id']}' AND last_deal_id='{$sms_sequence_data['last_deal_id']}'");
qu("email_sequence",array("need_to_send_email"=>"0"),"tenant_id='{$GLOBALS['tenant_id']}' AND last_deal_id='{$sms_sequence_data['last_deal_id']}'");
if($GLOBALS['tenant_id']!=1){ die; }

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
$text .= "*".$sms_sequence_data['customer_name']." (Customer)* : ".$sms_sequence_data['reply']."\n\n";
$text .= "*Deal Name* : ".$sms_sequence_data['deal_name']."\n\n";
$text .= "*Link* : https://sprout2.pipedrive.com/deal/".$sms_sequence_data['last_deal_id']."\n\n";
$Slack = new apiSlack();
$result = $Slack->pingSlack($text);
die;
?>