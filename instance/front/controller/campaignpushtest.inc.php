<?php


$apiPD = new apiPipeDrive();
$deal_info = $apiPD->getDealInfo('10109');
    $deal_info = json_decode($deal_info, TRUE);
d($deal_info);
  die;
//$data = $apiPD->getDealInfo("10100");
//$data = $apiPD->getPersonInfo("3997");
$data = $apiPD->getOrganizationInfo("3644");
$data = json_decode($data,true);
d($data);
die;
$phone  = "516-524-9063";
$pipedrive_id = '10100';
$sms_seq_data = qs("select * from sms_sequence where last10phone='" . last10Char($phone) . "'");
if (!empty($sms_seq_data)) {
    qd("sms_sequence", "id='{$sms_seq_data['id']}'");
}
qi("sms_sequence", array("phone" => $phone, "last10phone" => last10Char($phone), "last_deal_id" => $pipedrive_id, "day1_1_sent" => "1"));
$message = "Hi " . trim('WAYNE SHIRREFFS') . ", it's Wayne Shirreffs. I just received your request for funding for your business Lysoft Media. and I should be able to get you the $0 that you requested for Hiring Additional Staff. Can you chat for 2 minutes now to discuss?";
$note_data['deal_id'] = $pipedrive_id;
$note_data['content'] = "Welcome Text was sent on {$phone}.<br><br>Text: {$message}";
$data = $apiPD->createNote($note_data);
$apiCall = new callWebhook();
$apiCall->messageNow($phone, $message);
qi('active_campaign_log', _escapeArray(array("log" => "Trying to message sending on " . $phone)));
die;
$stage_data = $apiPD->getDealInfo('10100');
$stage_data = json_decode($stage_data, "true");
d($stage_data);
die;

$url = "https://lookups.twilio.com/v1/PhoneNumbers/%2B918460422312?Type=carrier";
$postfields['username'] = ACCOUNT_SID;
$postfields['password'] = AUTH_TOKEN;
$postfields = json_encode($postfields);
echo $postfields;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_USERPWD, ACCOUNT_SID . ":" . AUTH_TOKEN);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$data = curl_exec($ch);
echo $data;
$headerLen = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
$result = json_decode($data, true);
d($result);
die;

$apiPD = new apiPipeDrive();
$stage_data = $apiPD->getOrganizationInfo('9019');
$stage_data = json_decode($stage_data, "true");
d($stage_data);
die;


$apiCall = new callWebhook();
$phone_value = "+918460422312";
$message = "Welcome to sproutlab";
echo $apiCall->messageNow($phone_value, $message);
die;

$campaing_class = new Campaign();
$data_camp = $campaing_class->deleteContact(7);
d($data_camp);
die;
$stage_mapping_arr = json_decode(STAGE_MAPPING, true);
d($stage_mapping_arr);
die;
sleep(5);

$fname = 'Dave';
$lname = 'Jay';
$email = 'mybusiness01@business.com';
$phone = '18006676389';
$org = '';
$pipedrive_id = '10041';

$campaing_class = new Campaign();
$campaing_class::$contact_email = $email;
$campaing_class::$contact_fname = $fname;
$campaing_class::$contact_lname = $lname;
$campaing_class::$contact_phone = $phone;
$campaing_class::$contact_org = $org;
$campaing_class::$PIPEDRIVE_ID = $pipedrive_id;
$campaing_class::$PIPEDRIVE_STAGE = 'Prospects';
$data_camp = $campaing_class->pushContact(3);
d($data_camp);
echo $data_camp;
die;
if (isset($data_camp->success) && ($data_camp->success || $data_camp->success == '1')) {
    $inserted_id = qi("activity_log", _escapeArray(array("payload" => "Success:" . json_encode($data_camp) . " Deal:" . $deal_info['data']['id'])));
} else {
    $inserted_id = qi("activity_log", _escapeArray(array("payload" => "Active campaign error. " . json_encode($data_camp) . " Deal:" . $deal_info['data']['id'])));
}
die;
?>