<?php

$url = "https://lookups.twilio.com/v1/PhoneNumbers/%2B918460422312?Type=carrier";
$postfields['username'] = ACCOUNT_SID;
$postfields['password'] = AUTH_TOKEN;
$postfields = json_encode($postfields);
echo $postfields;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_USERPWD, ACCOUNT_SID.":".AUTH_TOKEN);
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