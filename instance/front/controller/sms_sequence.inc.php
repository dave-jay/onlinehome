<?php

$apiPD = new apiPipeDrive();
$sms_sequence_data = q("select * from sms_sequence where need_to_send_sms='1'");
foreach ($sms_sequence_data as $each_sms) {
    $deal_info = $seq_data = array();
    $req_sms_detail = getSMSText($each_sms);
    if ($req_sms_detail['success'] == 1) {
        if (IsTimeToSendSMS(strtotime($each_sms['modified_at']), $req_sms_detail['next_seq'])) {
            $message = $req_sms_detail['message'];
            $phone = $each_sms['phone'];
            $deal_info = $apiPD->getDealInfo($each_sms['last_deal_id']);
            $deal_info = json_decode($deal_info, true);
            if (isset($deal_info['data']['stage_id']) && ($deal_info['data']['stage_id'] == '28' || $deal_info['data']['stage_id'] == '1') && $deal_info['data']['status'] == 'open') {
                echo "<br><br><div style='font-size:30px;color:green;font-weight:bold;'>SMS Sent</div>";
                $message = str_ireplace("[MERCHANTS NAME]", $deal_info['data']['person_id']['name'], $message);
                $message = str_ireplace("[AMOUNT REQUESTED]", $deal_info['data']['value'], $message);
                echo "Following Message sent: " . $message;

                qu("sms_sequence", array($req_sms_detail['next_seq'] => '1'), "id='{$each_sms['id']}'");
                $note_data = array();
                $note_data['deal_id'] = $each_sms['last_deal_id'];
                $note_data['content'] = "Text was sent on {$each_sms['phone']}.<br><br>Text: {$message}";
                $data = $apiPD->createNote($note_data);
                $apiCall = new callWebhook();
                $apiCall->messageNow($each_sms['phone'], $message);
                die;
            } else {
                echo "Contact Is Made or Deal is closed";
            }
        } else {
            echo "Please wait some time.";
            continue;
        }
    } else {
        echo "No need to send sms";
    }

    if (isset($deal_info['data']['stage_id']) && $deal_info['data']['stage_id'] == "2") {
        $seq_data['is_contact_made'] = '1';
    }
    $seq_data['need_to_send_sms'] = '0';
    qu("sms_sequence", _escapeArray($seq_data), "id='{$each_sms['id']}'");
}
die;
?>