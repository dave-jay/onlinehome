<?php

//Update Deal which is not handled by any agents
$agent_call_dialed = q("select * from agent_call_dialed where is_updated='0' and created_at < DATE_SUB(NOW(), INTERVAL 2 minute) group by deal_id");
if (count($agent_call_dialed) > 0) {
    foreach ($agent_call_dialed as $each_deal) {
        $new_deal = qs("select * from call_detail where deal_id='{$each_deal['deal_id']}'");
        if (isset($new_deal) && !empty($new_deal)) {
            //echo "<br>-" . $each_deal['is_updated'] . "-not-" . $each_deal['deal_id'];
        } else {
            $new = array();
            $new['customer_phone'] = $each_deal['customer_phone'];
            $new['deal_id'] = $each_deal['deal_id'];
            $new['call_handled'] = '0';
            $a = qi("call_detail", $new);
            //echo "<br>-" . $each_deal['is_updated'] . "-added-" . $each_deal['deal_id'];
        }
    }
    $apiPD = new apiPipeDrive();
    $agent_call_dialed = q("select * from agent_call_dialed where is_updated='0'");
    foreach ($agent_call_dialed as $each_deal) {

        $deal_data = $apiPD->getDealInfo($each_deal['deal_id']);
        $deal_data = json_decode($deal_data);
        //d($deal_data);
        $person_id = isset($deal_data->data->person_id->value) ? ($deal_data->data->person_id->value) : '';
        $org_id = isset($deal_data->data->org_id->value) ? ($deal_data->data->org_id->value) : '';
        $source_id = isset($deal_data->data->c2a6fc3129578b646ae55717ed15f03ce3ee4df0) ? ($deal_data->data->c2a6fc3129578b646ae55717ed15f03ce3ee4df0) : '';
        $cust_name = isset($deal_data->data->person_id->name) ? ($deal_data->data->person_id->name) : '';
        $cust_email = isset($deal_data->data->person_id->email[0]->value) ? ($deal_data->data->person_id->email[0]->value) : '';
        $org_name = isset($deal_data->data->org_name) ? ($deal_data->data->org_name) : '';

        $created_at = qs("select created_at from agent_call_dialed where deal_id='{$each_deal['deal_id']}' order by id asc limit 0,1");
        $call_detail_fields['source_id'] = $source_id;
        $call_detail_fields['customer_name'] = $cust_name;
        $call_detail_fields['customer_email'] = $cust_email;
        $call_detail_fields['org_name'] = $org_name;
        $call_detail_fields['deal_id'] = $each_deal['deal_id'];
        $call_detail_fields['created_at'] = $created_at['created_at'];
        $call_detail_id = qu('call_detail', _escapeArray($call_detail_fields), "deal_id='{$each_deal['deal_id']}'");
        $call_detail_id = qu('agent_call_dialed', array("is_updated" => '1'), "deal_id='{$each_deal['deal_id']}'");        
    }
}
?>