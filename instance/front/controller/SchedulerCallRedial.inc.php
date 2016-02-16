<?php

$agent_call_detail = q("SELECT deal_id, COUNT(id) FROM `agent_call_dialed` where is_redial='0'  AND modified_at>=CURRENT_DATE  - INTERVAL 1 DAY GROUP BY deal_id HAVING COUNT(id)<5");
foreach ($agent_call_detail as $each_data) {
    $received_call = qs("select * from agent_call_dialed where is_received='1' and deal_id='{$each_data['deal_id']}'");
    if (empty($received_call)) {
        echo "<br>Yes need to redial for deal: " . $each_data['deal_id'];
        qd("deal_sid", "deal_id='{$each_data['deal_id']}'");
        $redial_data = qs("select * from agent_call_dialed where deal_id='{$each_data['deal_id']}' order by id ASC");
        $phone_value = $redial_data['customer_phone'];
        $new_agent_numbers = explode(",", $redial_data['agent_numbers']);
        $dealId = $each_data['deal_id'];
        $apiCall = new apiCall();
        $apiCall->doBroadcast($phone_value, $new_agent_numbers, $dealId, "0");
    }
}
$agent_call_detail = q("SELECT deal_id,customer_phone, is_mail_send,COUNT(id) FROM `agent_call_dialed` where is_redial='0'  AND modified_at>=CURRENT_DATE  - INTERVAL 1 DAY GROUP BY deal_id HAVING COUNT(id)>=5");
foreach ($agent_call_detail as $each_data) {
    if ($each_data['is_mail_send'] == '0') {
        qu("agent_call_dialed", _escapeArray(array("is_mail_send" => "1")), " deal_id='{$each_data['deal_id']}'");
        $dealId = $each_data['deal_id']; 
        //$dealId = "5232";// Test Mode
        $apiPD = new apiPipeDrive();
        $deal_data = $apiPD->getDealInfo($dealId);
        $deal_data = json_decode($deal_data);
        $deal_amount = number_format($deal_data->data->value, 2);
        $deal_amount = $deal_amount . ' ' . $deal_data->data->currency;
        $organization = $deal_data->data->org_name;
        $customer_name = $deal_data->data->person_name;
        $customer_phone=$each_data['customer_phone'];
        ob_start();
        $mail_subject = $mail_heading = "Missed Customer Call";
        include _PATH."instance/front/tpl/missed_call_mail_template.php";
        $content = ob_get_contents();
        ob_end_clean();
        //echo $content;
        _phpmail("testoperators@gmail.com", $mail_subject, $content);
        //_mail("testoperators@gmail.com", "Agent Missed Customer Call", $content);
    }
}
//qi("test",array("t"=>"test"));
die;
?>