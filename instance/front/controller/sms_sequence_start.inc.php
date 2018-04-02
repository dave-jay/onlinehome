<?php

$apiCall = new callWebhook();
$all_tenants = q("select * from admin_users where is_active='1'");
foreach($all_tenants as $each_tenant):
    $GLOBALS['tenant_id'] = $each_tenant['id'];
    include _PATH.'instance/front/controller/define_settings.inc.php';
    $sequence = getSMSSequenceByTenant($GLOBALS['tenant_id']);
    
    if(strtolower($conf_data['SEQUENCE_STATUS'])!="on"){
        continue;        
    }
    
    $need_to_start_data = qs("select * from active_campaign_contact where tenant_id='{$GLOBALS['tenant_id']}' AND  need_to_start='1' order by created_at desc");
    if(!empty($need_to_start_data)){
        if(time()>(strtotime($need_to_start_data['need_to_start_time']))){
            addLogs($_REQUEST['q'], $GLOBALS['tenant_id'], "SMS:One new deal found");
            qu("active_campaign_contact",array("need_to_start"=>"0"),"id='{$need_to_start_data['id']}'");            
        }else{
            echo "please wait for ".((strtotime($need_to_start_data['modified_at'])+60)-time())." sec";
            continue;
        }
    }else{
        echo "no new deal is coming";
        continue;
    }
    //Getting Deal Info and change stage if pipeline id is '1' (i.e. for "Leads")
    $apiPD = new apiPipeDrive($conf_data['PIPEDRIVER_API_KEY']);
    $deal_info = $apiPD->getDealInfo($need_to_start_data['last_deal_id']);
    $deal_info = json_decode($deal_info, TRUE);
    $agent = $deal_amount  = $fname = $lname = $email = $org = $pipedrive_id = $pipedrive_stage = '';
    $agent_id = $agent_linkedin_link = $agent_phone = '';
    $phone = $need_to_start_data['phone'];
    $phone2 = $need_to_start_data['alternate_phone'];
    $active_campaign_contact_id = $need_to_start_data['id'];
    echo "<br>3";
    $mobile_number_found = $need_to_start_data['is_mobile_number'];
    if (isset($deal_info['data']['id'])) {
        $name = explode(" ", $deal_info['data']['person_id']['name']);
        $fname = ucwords(strtolower($name[0]));
        if (count($name) > 2) {
            array_shift($name);
            $lname = implode(" ", $name);
        } else {
            $lname = $name[1];
        }
        $lname = ucwords(strtolower($lname));
        foreach ($deal_info['data']['person_id']['email'] as $each) {
            if (isset($each['value']) && $each['value'] != '') {
                $email = $each['value'];
                break;
            }
        }    
        $org = $deal_info['data']['org_id']['name'];
        $org_id = $deal_info['data']['org_id']['value'];
        $agent = $deal_info['data']['user_id']['name'];
        $agent_id = $deal_info['data']['user_id']['value'];
        $deal_amount = $deal_info['data']['value'];
        $pipedrive_id = $deal_info['data']['id'];
        $pipedrive_stage = $deal_info['data']['stage_id'];
    } else {
        addLogs($_REQUEST['q'], $GLOBALS['tenant_id'], "Add: Deal info for '{$need_to_start_data['last_deal_id']}' deal not found. " . json_decode($data));
        continue;
    }
    $org_data = $apiPD->getOrganizationInfo($org_id);
    $org_data = json_decode($org_data, "true");
    if (isset($org_data['data']['e46960a5a8d75e6909eebf64ef3cd0c0fe426119'])) {
        $deal_amount = $org_data['data']['e46960a5a8d75e6909eebf64ef3cd0c0fe426119'];
    }
    if($deal_amount=='' || $deal_amount==0){
        $deal_amount = 50000;
    }
    $deal_amount = number_format($deal_amount);
    
    if ($agent_id != '' && $agent_id != "990918") {
        $agent_data = qs("select * from pd_users where pd_id='{$agent_id}'");
    } else {
        $agent_data = qs("select * from pd_users where is_default='1'");
    }
    $agent = $agent_data['name'];
    $org_for = 'Working Capital';
    if (isset($org_data['data']['48b7dac9e6fa7666a2f0d9e233bb5139f7493a44'])) {
        $org_for = getUseOfFundText($org_data['data']['48b7dac9e6fa7666a2f0d9e233bb5139f7493a44']);
    }
    echo "<br>9";
    if ($mobile_number_found == 1) {
        $sms_seq_data = qs("select * from sms_sequence where  tenant_id='{$GLOBALS['tenant_id']}' AND ( last10phone='" . last10Char($phone) . "' OR last_deal_id='".$pipedrive_id."')");
        if (!empty($sms_seq_data)) {
            qd("sms_sequence", "id='{$sms_seq_data['id']}'");
        }
        $time_zone_arr = getTimeZoneByPhone($phone, "1");
        qi("sms_sequence", _escapeArray(array("tenant_id"=>$GLOBALS['tenant_id'],  "customer_name" => $fname.' '.$lname,"agent_name" => $agent,"org_name" => $org,"deal_name" => $deal_info['data']['title'],"phone" => $phone, "deal_amount" => $deal_amount, "last10phone" => last10Char($phone), "state_code" => $time_zone_arr['state_code'], "state" => $time_zone_arr['state'], "area_code" => $time_zone_arr['area_code'], "timezone" => $time_zone_arr['timezone'], "last_deal_id" => $pipedrive_id, "day1_1_sent" => "1")));    
        echo "<br>10";
        $agent_arr = explode(" ", $agent);
        $agent = $agent_arr[0];
        $each_sms['day1_1_sent'] = 0;
        $req_sms_detail = getSMSText($each_sms,$sequence);
        $message = $req_sms_detail['message'];
        $message = str_ireplace("[COMPANY NAME]", $org, $message);
        $message = str_ireplace("[AGENTS NAME]", $agent, $message);
        $message = str_ireplace("[MERCHANTS NAME]", $fname, $message);
        $message = str_ireplace("[AMOUNT REQUESTED]", $deal_amount, $message);
        $message = str_ireplace("[USE OF FUNDS]", $org_for, $message);
        //$message = "Hi " . trim($fname) . ", it's {$agent} from Sprout. I just received your request for funding for your business {$org}. and I should be able to get you the $" . $deal_amount . " that you requested for {$org_for}. Can you chat for 2 minutes now to discuss?";
        $note_data['deal_id'] = $pipedrive_id;
        $note_data['content'] = "Welcome Text was sent on " . formatPhone($phone, 4) . ".<br><br>Text: {$message}";
        $data = $apiPD->createNote($note_data);
        $note_data['content'] = "SMS Sequence is executing on {$time_zone_arr['timezone']} Timezone. <br>Customer State: {$time_zone_arr['state']} ({$time_zone_arr['state_code']})<br>Area Code: {$time_zone_arr['area_code']}";
        $data = $apiPD->createNote($note_data);
        
        echo "<br>11";
        $apiCall->messageNow($phone, $message, "2");
        addLogs($_REQUEST['q'], $GLOBALS['tenant_id'], "Trying to message sending on ". formatPhone($phone, 4));
    }
endforeach;
die;
?>