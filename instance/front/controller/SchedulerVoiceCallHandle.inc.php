<?php

$calls = q("select distinct(deal_id) as deal_id from voice_call where is_handled='0' and AND created_at<=NOW() - INTERVAL 5 MINUTE order by id asc");
foreach ($calls as $each_call) {
    echo $each_call['deal_id'];
    $agent_call_dialed = q("select * from agent_call_dialed where is_received='1' and deal_id='" . $each_call['deal_id'] . "'");
    echo "<br>-" . count($agent_call_dialed) . "<br>";
    if (count($agent_call_dialed) == 0) {
        $voice_calls = qs("select group_concat(curr_agent) as curr_agent ,group_concat(all_agents) as all_agents from voice_call where deal_id='" . $each_call['deal_id'] . "'");
        $first_voice_call = qs("select * from voice_call where deal_id='" . $each_call['deal_id'] . "' order by id asc");
        $curr_agent_arr = explode(",", $voice_calls['curr_agent']);
        $all_agent_arr = explode(",", $voice_calls['all_agents']);
        $all_agent_arr_unique = array_unique($all_agent_arr);
        $new_agent_numbers = array();
        foreach ($all_agent_arr_unique as $each_value) {
            if (in_array($each_value, $curr_agent_arr)) {
                echo "<br>duplicate: " . $each_value;
            } else {
                echo "<br>call to: " . $each_value;
                $new_agent_numbers[] = $each_value;
            }
        }
        echo "<br>new array:";
        d($new_agent_numbers);
        if(count($new_agent_numbers)>0){
            $apiCall = new callWebhook();
            $apiCall->callNow($first_voice_call['customer_phone'], $new_agent_numbers, $each_call['deal_id'], "1");
        }
        break;
    } else {
        qu("voice_call", array("is_handled" => "1"), "deal_id='" . $each_call['deal_id'] . "'");
    }
}
die;
?>