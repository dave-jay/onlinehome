<?php

$agent_call_detail = q("SELECT deal_id, COUNT(id) as total_call FROM `agent_call_dialed` where is_redial='0'  AND modified_at>=CURRENT_DATE  - INTERVAL 1 DAY GROUP BY deal_id HAVING COUNT(id)<5");
foreach ($agent_call_detail as $each_data) {
    $received_call = qs("select * from agent_call_dialed where is_received='1' and deal_id='{$each_data['deal_id']}'");
    if (empty($received_call)) {
        echo "<br>Yes need to redial for deal: " . $each_data['deal_id'];
        qd("deal_sid", "deal_id='{$each_data['deal_id']}'");
        if($each_data['total_call']==1){
            echo "<br>Total Count:  1<br>";
            $last_updated_record = q("select *,(NOW()  - INTERVAL 5 MINUTE) as ccc,NOW()  from agent_call_dialed where deal_id='{$each_data['deal_id']}' AND modified_at<=NOW()   - INTERVAL 5 MINUTE order by modified_at DESC");
            d($last_updated_record);
            if(count($last_updated_record)==0){
                echo "wait to call";
                continue;
            }else{
                echo "dial";
            }
        }else{
            echo "<br>Total Count:  ".$each_data['total_call'];
        }
        $redial_data = qs("select * from agent_call_dialed where deal_id='{$each_data['deal_id']}' order by id ASC");
        $phone_value = $redial_data['customer_phone'];
        $new_agent_numbers = explode(",", $redial_data['agent_numbers']);
        $dealId = $each_data['deal_id'];
        $apiCall = new callWebhook();
        $apiCall->callNow($phone_value, $new_agent_numbers, $dealId, "0");
        echo "<br><br>Call Generated -<br>Agents:";
        d($new_agent_numbers);
        echo "<br>Customer Phone:";
    }
}
$agent_call_detail = q("SELECT deal_id,customer_phone, is_mail_send,COUNT(id) FROM `agent_call_dialed` where is_redial='0'  AND modified_at>=CURRENT_DATE  - INTERVAL 1 DAY GROUP BY deal_id HAVING COUNT(id)>=5");
foreach ($agent_call_detail as $each_data) {
    if ($each_data['is_mail_send'] == '0') {
        $apiPD = new apiPipeDrive();
        $deal_data = json_decode($apiPD->getDealInfo($each_data['deal_id']));
        $source_id = isset($deal_data->data->c2a6fc3129578b646ae55717ed15f03ce3ee4df0)?($deal_data->data->c2a6fc3129578b646ae55717ed15f03ce3ee4df0):'';

        //qi("call_detail",  _escapeArray(array("deal_id"=>$each_data['deal_id'],"recording_duration"=>"0","source_id"=>$source_id)));
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
        echo "Mail Sent: ";
        _phpmail(ADMIN_EMAIL, $mail_subject, $content);
        //_mail("testoperators@gmail.com", "Agent Missed Customer Call", $content);
    }
}
//qi("test",array("t"=>"test"));
die;
?>