<?php

$apiPD = new apiPipeDrive();
 
$deal = q("select * from call_detail where source_id!='' order by id asc");


foreach ($deal as $each_deal) {

    $deal_data = json_decode($apiPD->getDealInfo($each_deal['deal_id']));
    if (isset($deal_data->success) && $deal_data->success) {
        $customer_name = isset($deal_data->data->person_id->name) ? $deal_data->data->person_id->name : '';
        $customer_email = isset($deal_data->data->person_id->email[0]->value) ? $deal_data->data->person_id->email[0]->value : '';

        if ($customer_name != '' || $customer_email != '') {
            qu("call_detail", array("customer_name" => $customer_name, "customer_email" => $customer_email), "id='{$each_deal['id']}'");
            echo $customer_name . " - " . $customer_email." - ".$each_deal['id'] . " - set";
        } else {
            echo $customer_name . " - " . $customer_email." - ".$each_deal['id'] . " - not set";
        }
        echo "<br>";
    }else{
        echo "<br><br>-error-".$each_deal['deal_id'];
        d($deal_data);
    }
}
die;
qi("call_detail", _escapeArray(array("deal_id" => 'a', "recording_duration" => "0")));
die;
$apiPD = new apiPipeDrive();

$person_data = json_decode($apiPD->getDealField('12463'), true);
foreach ($person_data['data']['options'] as $each_source)
//$person_data = json_decode($apiPD->getDealInfo('4844'),true);
    d($person_data);

die;
sleep(10);
d(date('Y-m-d H:i:s'));
die;
$t = $_SESSION['t'];
foreach ($t['messages'] as $key => $value) {
    echo $key . ' ' . $value;
}

d($_SESSION['t']);
die;
_errors_on();
include _PATH . "/TextMagic/TextMagicAPI.php";
$api = new TextMagicAPI(array(
    "username" => "davejay",
    "password" => "uUXgZoOkpG"
        ));

$text = "Hi, Please reply after getting this test message";

// Use this number for testing purposes. This is absolutely free.
$phones = array(918460422312);

$results = $api->send($text, $phones, true);
echo $results;
d($results);
d(json_decode($results, TRUE));
die;
$urlArgs = _cg("url_vars");
$apiPD = new apiPipeDrive();
echo $urlArgs[0] . "<br>";
$person_data = json_decode($apiPD->getDealInfo($urlArgs[0]), true);
d($person_data);
die;
$apiCall = new apiCall();
//$apiCall->doMessage($phone_value, $message); 

$apiPD = new apiPipeDrive();
$person_data = json_decode($apiPD->getPersonInfo('4421'), true);
$phone = $apiCall->ValidateNumber("973-712-8291");
echo $phone;
d($person_data);
die;

$fields['subject'] = 'Call';
$fields['done'] = '0';
$fields['type'] = 'call';
$fields['deal_id'] = 4843; // Test Deal Id - $fields['deal_id'] = '4586';
$fields['person_id'] = 4421;
$fields['org_id'] = 4058;
$recording_url = "https://api.twilio.com/2010-04-01/Accounts/ACaa30ea6de17c65f4407de5a34cbe1efa/Recordings/RE24a2c91ec44c341006b1c88ee15b0623";
$param = http_build_query(array('call_detail_id' => $call_detail_id . '|' . urlencode($recording_url . '|80')));
$fields['note'] = "<iframe src='https://my-brilliant.info/wakeup/playAudio?" . $param . "' width='380' height='110'></iframe>";
//$fields['note'] = "<irf>s</irf>";

$data = $apiPD->modifyActivity('16241', $fields);
//$data = $apiPD->createActivity($fields);

d(json_decode($data));







die;
//echo "------------------------------------------------------------------------------";
//------------------------------
$deal_data = json_decode($apiPD->getDealInfo('4586'));
$person_id = isset($deal_data->data->person_id->value) ? ($deal_data->data->person_id->value) : '';
$org_id = isset($deal_data->data->org_id->value) ? ($deal_data->data->org_id->value) : '';
echo $person_id;
echo "<br>";
echo $org_id;
die;

$fields['subject'] = 'Call';
$fields['done'] = '0';
$fields['type'] = 'call';
$fields['deal_id'] = 'T170_219';
$call_detail_id = '5';
$recording_url = 'https://api.twilio.com/2010-04-01/Accounts/ACaa30ea6de17c65f4407de5a34cbe1efa/Recordings/RE2f1420ecfe81cfbaabd78257b75392c7';
$param = http_build_query(array('call_detail_id' => $call_detail_id . '-' . urlencode($recording_url)));
$fields['note'] = "<iframe src='http://s606346885.onlinehome.us/playAudio' width='380' height='100'></iframe>";
//$fields['note'] = 'test';
echo $fields['note'];
$data = $apiPD->modifyActivity('16236', $fields);
d($data);
die;
$fields['subject'] = 'Call';
$fields['done'] = '0';
$fields['type'] = 'call';
$fields['deal_id'] = '4586';
//$fields['user_id'] = '';
//$fields['person_id'] = '';
//$fields['org_id'] = '';
$call_detail_id = 2;
$fields['note'] = "<iframe src='" . lr("playAudio?call_detail_id=" . $call_detail_id) . "' width='380' height='100'></iframe>";

//$data = $apiPD->getAllActivityType();
$data = $apiPD->createActivity($fields);
$activity_data = json_decode($data);
d($activity_data);
if (isset($activity_data->success) && $activity_data->success) {
    echo $activity_data->data->id;
} else {
    echo "not set";
}
die;
?>