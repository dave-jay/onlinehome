<?php

$calls = q("select distinct(deal_id) as deal_id,tenant_id from voice_call where is_handled='0' AND is_aborted='0' AND in_progress='0' AND  DATE(`created_at`) = CURDATE() AND created_at<=NOW() - INTERVAL 1 MINUTE order by id asc");
foreach ($calls as $each_call) {
    $GLOBALS['tenant_id'] = $each_call['tenant_id'];
    $pipedriver_api_key = User::getSingleConfig($each_call['tenant_id'],'PIPEDRIVER_API_KEY'); 
    
    $agent_call_dialed = q("select * from agent_call_dialed where is_received='1' and deal_id='" . $each_call['deal_id'] . "' and tenant_id ='" . $each_call['tenant_id'] . "' order by id asc");
    $agent_call_dialed_data = q("select * from agent_call_dialed where deal_id='" . $each_call['deal_id'] . "' and tenant_id ='" . $each_call['tenant_id'] . "' order by id asc");
    $count = count($agent_call_dialed_data);
    $cate = $agent_call_dialed_data[$count-1]['category'];
    if($agent_call_dialed_data[$count-1]['is_aborted']=='1'){
        qu("voice_call", array("is_aborted" => "1"), "deal_id='" . $each_call['deal_id'] . "' and tenant_id ='" . $each_call['tenant_id'] . "'");
            $dealId = $each_call['deal_id'];
            $data = qs("select * From pd_users where tenant_id ='" . $each_call['tenant_id'] . "' AND is_active='1' and is_default='1' order by name asc");
            if(!empty($data)){
                $apiPD = new apiPipeDrive($pipedriver_api_key);
                $agent_id = $data['pd_id'];
                $deal_data = json_decode($apiPD->getDealInfo($dealId)); 
                $person_id = isset($deal_data->data->person_id->value)?($deal_data->data->person_id->value):'';
                $org_id = isset($deal_data->data->org_id->value)?($deal_data->data->org_id->value):'';
                $apiPD->assignDeal($dealId, $agent_id);
                $apiPD->assignPerson($person_id, $agent_id);
                $apiPD->assignOrganization($org_id, $agent_id);
                die;
            }
    } else if (count($agent_call_dialed) == 0) {
        sleep(10);
        $count = qs("select count(*) as count from agent_call_dialed where deal_id='" . $each_call['deal_id'] . "' and category='{$cate}' and tenant_id ='" . $each_call['tenant_id'] . "'");
        $voice_calls = qs("select group_concat(curr_agent) as curr_agent ,group_concat(all_agents) as all_agents from voice_call where deal_id='" . $each_call['deal_id'] . "' and tenant_id ='" . $each_call['tenant_id'] . "'");
        $first_voice_call = q("select * from voice_call where deal_id='" . $each_call['deal_id'] . "' and tenant_id ='" . $each_call['tenant_id'] . "'order by id asc");
        if (count($first_voice_call) >= 9 || $count['count']>=9) {
            qu("voice_call", array("is_aborted" => "1"), "deal_id='" . $each_call['deal_id'] . "' and tenant_id ='" . $each_call['tenant_id'] . "'");
            $data = qs("select * From pd_users where tenant_id ='" . $each_call['tenant_id'] . "' and is_active='1' and is_default='1' order by name asc");
            $dealId = $each_call['deal_id'];
            if(!empty($data)){
                $apiPD = new apiPipeDrive($pipedriver_api_key);
                $agent_id = $data['pd_id'];
                $deal_data = json_decode($apiPD->getDealInfo($dealId)); 
                $person_id = isset($deal_data->data->person_id->value)?($deal_data->data->person_id->value):'';
                $org_id = isset($deal_data->data->org_id->value)?($deal_data->data->org_id->value):'';
                $apiPD->assignDeal($dealId, $agent_id);
                $apiPD->assignPerson($person_id, $agent_id);
                $apiPD->assignOrganization($org_id, $agent_id);
                die;
            }
        }
        elseif($count['count']==3 && $cate!='A' && $cate!='B'){
            qu("voice_call", array("is_aborted" => "1"), "deal_id='" . $each_call['deal_id'] . "'");
            $data = qs("select * From pd_users where tenant_id ='" . $each_call['tenant_id'] . "' and is_active='1' and is_default='1' order by name asc");
            $dealId = $each_call['deal_id'];
            if(!empty($data)){
                $apiPD = new apiPipeDrive($pipedriver_api_key);
                $agent_id = $data['pd_id'];
                $deal_data = json_decode($apiPD->getDealInfo($dealId)); 
                $person_id = isset($deal_data->data->person_id->value)?($deal_data->data->person_id->value):'';
                $org_id = isset($deal_data->data->org_id->value)?($deal_data->data->org_id->value):'';
                $apiPD->assignDeal($dealId, $agent_id);
                $apiPD->assignPerson($person_id, $agent_id);
                $apiPD->assignOrganization($org_id, $agent_id);
                die;
            }
        }
        else {
            if($count['count']==3 && $cate=='A'){
                $cate = 'B';
            }elseif($count['count']==3 && $cate=='B'){
                $cate = 'C';
            }
            if($cate!='A' && $cate!='B' && $cate!='C'){
                $cate = 'A';
            }
            
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
            if (count($new_agent_numbers) > 0) {
                qu("voice_call", array("in_progress" => "1"), "tenant_id ='" . $each_call['tenant_id'] . "' and deal_id='" . $each_call['deal_id'] . "'");
                $apiCall = new callWebhook();
                echo "cust: " . $first_voice_call[0]['customer_phone'] . "<br>";
                echo "Agents: <br>";
                d($new_agent_numbers);
                $apiCall->callNow($first_voice_call[0]['customer_phone'], $new_agent_numbers, $each_call['deal_id'], "1", $cate);
            }else{
                qu("voice_call", array("is_aborted" => "2"), "tenant_id ='" . $each_call['tenant_id'] . "' and deal_id='" . $each_call['deal_id'] . "'");
                $data = qs("select * From pd_users where tenant_id ='" . $each_call['tenant_id'] . "' and is_active='1' and is_default='1' order by name asc");
                $dealId = $each_call['deal_id'];
                if(!empty($data)){
                    $apiPD = new apiPipeDrive($pipedriver_api_key);
                    $agent_id = $data['pd_id'];
                    $deal_data = json_decode($apiPD->getDealInfo($dealId)); 
                    $person_id = isset($deal_data->data->person_id->value)?($deal_data->data->person_id->value):'';
                    $org_id = isset($deal_data->data->org_id->value)?($deal_data->data->org_id->value):'';
                    $apiPD->assignDeal($dealId, $agent_id);
                    $apiPD->assignPerson($person_id, $agent_id);
                    $apiPD->assignOrganization($org_id, $agent_id);
                    die;
                }
            }
            break;
        }
    } else {
        qu("voice_call", array("is_handled" => "1"), "deal_id='" . $each_call['deal_id'] . "'");
    }
}
die;
?>