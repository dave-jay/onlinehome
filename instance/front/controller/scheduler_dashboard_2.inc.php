<?php

date_default_timezone_set('America/Chicago');
$tz = new DateTimeZone('Asia/Kolkata');
$filter_array = array('488' => 'Prospects');

$start_record_from = 0;
$no_of_records = 100;

$apiPD = new apiPipeDrive();
$source_data = $apiPD->getDealField('12463');
$stage_data = $apiPD->getAllStage();

$source_data = json_decode($source_data, "true");
$stage_data = json_decode($stage_data, "true");
$source = array();
$stage = array();

if (isset($source_data['data']['options'])) {
    foreach ($source_data['data']['options'] as $each_source) {
        $source[$each_source['id']] = $each_source; // 'label';
    }
}

if (isset($stage_data['data'])) {
    foreach ($stage_data['data'] as $each_stage) {
        $stage[$each_stage['id']] = $each_stage; //'order_nr','name'
    }
}
foreach ($filter_array as $filter_id => $filter_stage_name) {
    $deal_data = $apiPD->getFilterDeals($filter_id, $start_record_from, $no_of_records);
    $deal_data = json_decode($deal_data, "true");
    while ($deal_data['success']) {
        if ($deal_data['data'] && count($deal_data['data']) > 0) {
            foreach ($deal_data['data'] as $each_deal) {
                if ($each_deal['pipeline_id'] != '1')
                    continue;
                $fields = array();
                $fields['reference'] = strtotime(date('Y-m-d H:i:s')) . "" . $each_deal['id'] . mt_rand(1, 1000);
                $fields['deal_id'] = $each_deal['id'];
                $fields['agent_id'] = $each_deal['user_id']['id'];
                $fields['agent_name'] = $each_deal['user_id']['name'];
                $fields['agent_email'] = $each_deal['user_id']['email'];
                $fields['cust_id'] = $each_deal['person_id']['value'];
                $fields['cust_name'] = $each_deal['person_id']['name'];
                $fields['cust_email'] = $each_deal['person_id']['email'][0]['value'];
                $fields['stage_id'] = $each_deal['stage_id'];
                $fields['value'] = $each_deal['value'];
                $fields['source'] = _e($source[$each_deal['c2a6fc3129578b646ae55717ed15f03ce3ee4df0']]['label'], "");
                $fields['status'] = $each_deal['status'];
                $fields['curr_stage'] = $stage[$each_deal['stage_id']]['name'];
                //$fields['initial_move_stage'] = $filter_stage_name;
                $fields['stage_order_nr'] = $stage[$each_deal['stage_id']]['order_nr'];

                $duplicate = qs("select * from dashboard_pipedrive_deals where deal_id = '{$fields['deal_id']}' and initial_move_stage = '{$fields['initial_move_stage']}'");
                if (!empty($duplicate)) {
                    unset($fields['reference']);
                    qu("dashboard_pipedrive_deals", _escapeArray($fields), "deal_id= '{$fields['deal_id']}' and initial_move_stage = '{$fields['initial_move_stage']}'");
                    echo "<br> Record Update for deal: " . $fields['deal_id'];
                } else {
                    $fields['pipedrive_added_date'] = $each_deal['add_time'];
                    $dt = new DateTime($each_deal['add_time']);
                    $dt->setTimezone($tz);
                    $fields['added_date'] = $dt->format('Y-m-d H:i:s');
                    qi("dashboard_pipedrive_deals", _escapeArray($fields));
                    echo "<br>Record Insert for deal: " . $fields['reference'];
                }
            }
            echo "new call<Br><Br><br>";
            $start_record_from += $no_of_records;
            $deal_data = array();
            $deal_data = $apiPD->getFilterDeals($filter_id, $start_record_from, $no_of_records);
            $deal_data = json_decode($deal_data, "true");
        } else {
            echo "no more records";
            break;
        }
    }
    if (!$deal_data['success']) {
        echo "<br>Error - " . $filter_stage_name . " - " . $deal_data['error'];
    }
    $start_record_from = 0;
    $no_of_records = 100;
}
die;
$call_list['call_duration'] = "86400";
if ($call_list['call_duration'] < 86400) {
    echo (gmdate("H", $call_list['call_duration']) + 0) . "<br>" . "Hoursd";
} else {
    echo $call_list['call_duration'] = number_format(( $call_list['call_duration'] / 86400), 0);
}

echo "<Br><Br>";

echo $res_arr['call_duration'] = (gmdate("H", $call_list['call_duration']) + 0) . "<br>" . "Hours";
die;
echo "my test";
$d = q("select * from plecto");
$c = 11;
foreach ($d as $a) {
    for ($i = 0; $i < $a['total']; $i++) {
        $f = array();
        $f['reference'] = $c++;
        $f['member_name'] = $a['member_name'];
        $f['member_id'] = $a['member_id'];
        $f['date'] = $a['date'];
        $f['stage_id'] = $a['stage_id'];
        $f['total'] = $a['total'];
        $f['open'] = $a['open'];
        $f['won'] = $a['won'];
        $f['loss'] = $a['loss'];
        qi("plecto", $f);
    }
}
die;
_errors_on();
include _PATH . "/Services/Twilio.php";
$account_sid = ACCOUNT_SID;
$auth_token = AUTH_TOKEN;
$client = new Services_Twilio($account_sid, $auth_token);
$each_agent = "919737128291";

$url_agent_calling = _U . "DialingAgent?";
$url_agent_received = _U . "ReceivedAgent?";
try {
    $call = $client->account->calls->create(TWILIO_PHONE_NUMBER, $each_agent, $url_agent_received, array(
        "Method" => "GET",
        "StatusCallback" => $url_agent_calling,
        "StatusCallbackMethod" => "POST",
        "StatusCallbackEvent" => array("ringing"),
        //"IfMachine" => "Hangup",
        "Timeout" => "25"
    ));
    echo $call->sid . "<br>";
} catch (Exception $e) {
    // Failed calls will throw
    echo $e;
    die;
}
die;
?>