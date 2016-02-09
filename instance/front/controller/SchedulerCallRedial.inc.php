<?php
$agent_call_detail = q("SELECT deal_id, COUNT(id) FROM `agent_call_dialed` where is_redial='0'  AND modified_at>=CURRENT_DATE  - INTERVAL 1 DAY GROUP BY deal_id HAVING COUNT(id)<5");
foreach($agent_call_detail as $each_data){
    $received_call = qs("select * from agent_call_dialed where is_received='1' and deal_id='{$each_data['deal_id']}'");
    if(empty($received_call)){
        echo "<br>Yes need to redial for deal: ".$each_data['deal_id'];
        qd("deal_sid", "deal_id='{$each_data['deal_id']}'");
        $redial_data = qs("select * from agent_call_dialed where deal_id='{$each_data['deal_id']}' order by id ASC");
        $phone_value = $redial_data['customer_phone'];
        $new_agent_numbers = explode(",", $redial_data['agent_numbers']);
        $dealId = $each_data['deal_id'];
        $apiCall = new apiCall();
        //$apiCall->doBroadcast($phone_value, $new_agent_numbers, $dealId,"0");
    }
    
}
//qi("test",array("t"=>"test"));
die;
?>