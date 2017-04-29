<?php

if (date("l") == "Sunday") {
    die;
}
$call_status = qs("select *,value as seq_status from config where `key` = 'SEQUENCE_STATUS'");
if (strtolower($call_status['seq_status']) != "on") {
    die;
}
$apiPD = new apiPipeDrive();
$sms_sequence_data = q("select * from sms_sequence_app_out where need_to_send_sms='1'");
foreach ($sms_sequence_data as $each_sms) {
    $deal_info = $seq_data = array();
    $req_sms_detail = getSMSTextAppOut($each_sms);
    if ($req_sms_detail['success'] == 1) {
        if (IsTimeToSendSMS(strtotime($each_sms['modified_at']), $req_sms_detail['next_seq'], $each_sms['timezone'])) {
            $message = $req_sms_detail['message'];
            $phone = $each_sms['phone'];
            $deal_info = $apiPD->getDealInfo($each_sms['last_deal_id']);
            $deal_info = json_decode($deal_info, true);
            if (isset($deal_info['data']['stage_id']) && $deal_info['data']['stage_id'] == '3' && $deal_info['data']['status'] == 'open' && $deal_info['data']['e585bd988070d2bdfb2af36d968521c3f9aa949a'] != '196') {
                $name = explode(" ", $deal_info['data']['person_id']['name']);
                $agent = $deal_info['data']['user_id']['name'];
                $agent_id = $deal_info['data']['user_id']['value'];
                $fname = ucwords(strtolower($name[0]));
                
                if ($agent_id != '' && $agent_id != "990918") {
                    $agent_data = qs("select * from pd_users where pd_id='{$agent_id}'");
                } else {
                    $agent_data = qs("select * from pd_users where is_default='1'");
                }
                $agent = ucwords(strtolower($agent_data['name']));
                $agent_arr = explode(" ", $agent);
                $agent = $agent_arr[0];

                $message = str_ireplace("[AGENTS NAME]", $agent, $message);
                $message = str_ireplace("[MERCHANTS NAME]", $fname, $message);
                echo "<br><br><div style='font-size:30px;color:green;font-weight:bold;'>SMS Sent</div>";

                echo "Following Message sent: " . $message;

                qu("sms_sequence_app_out", array($req_sms_detail['next_seq'] => '1'), "id='{$each_sms['id']}'");
                $note_data = array();
                $note_data['deal_id'] = $each_sms['last_deal_id'];
                $note_data['content'] = "Text was sent on " . formatPhone($each_sms['phone'], 4) . ".<br><br>Text: {$message}";
                //$data = $apiPD->createNote($note_data);
                $apiCall = new callWebhook();
                $apiCall->messageNow($each_sms['phone'], $message, "2");
                qi("test", array("payload" => "AppOut: message sent on " . $each_sms['phone']));
                die;
            } else {
                echo "App Is In or Deal is closed";
                qi("test", array("payload" => "AppOut: App is in"));
            }
        } else {
            qi("test", array("payload" => "AppOut: Please wait"));
            echo "Please wait some time.";
            continue;
        }
    } else {
        qi("test", array("payload" => "AppOut: No need to send"));
        echo "No need to send sms";
    }

    if (isset($deal_info['data']['stage_id']) && $deal_info['data']['stage_id'] == "9") {
        $seq_data['is_app_in'] = '1';
    }
    $seq_data['need_to_send_sms'] = '0';
    qi("test", array("payload" => "AppOut: seq set to off"));
    qu("sms_sequence_app_out", _escapeArray($seq_data), "id='{$each_sms['id']}'");
}
die;
?>