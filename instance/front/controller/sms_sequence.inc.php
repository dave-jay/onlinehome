<?php
if(date("l")=="Sunday"){ die; }

$apiCall = new callWebhook();
$all_tenants = q("select * from admin_users where is_active='1'");
foreach($all_tenants as $each_tenant):
    $GLOBALS['tenant_id'] = $each_tenant['id'];
    include _PATH.'instance/front/controller/define_settings.inc.php';
    $sequence = getSMSSequenceByTenant($GLOBALS['tenant_id']);
    
    if(strtolower($conf_data['SEQUENCE_STATUS'])!="on"){
        continue;        
    }
    
    $apiPD = new apiPipeDrive($conf_data['PIPEDRIVER_API_KEY']);
    $sms_sequence_data = q("select * from sms_sequence where  tenant_id='{$GLOBALS['tenant_id']}' AND need_to_send_sms='1'");
    foreach ($sms_sequence_data as $each_sms) {
        if(!isTimetoSend($each_sms["timezone"])){ //SMS will only send if current time is between 8AM - 8PM (NOTE: this time is dynamic)
            continue;             
        }
        $deal_info = $seq_data = array();
        $req_sms_detail = getSMSText($each_sms,$sequence);
        if ($req_sms_detail['success'] == 1) {
            if (IsTimeToSendSMS($GLOBALS['tenant_id'],strtotime($each_sms['modified_at']), $req_sms_detail['next_seq'],$each_sms['timezone'],$each_sms['hold_till_date'])) {
                $message = $req_sms_detail['message'];
                $phone = $each_sms['phone'];
                $deal_info = $apiPD->getDealInfo($each_sms['last_deal_id']);
                $deal_info = json_decode($deal_info, true);
                if (isset($deal_info['data']['stage_id']) && ($deal_info['data']['stage_id'] == '28' || $deal_info['data']['stage_id'] == '1') && $deal_info['data']['status'] == 'open') {

                    $org_data = $apiPD->getOrganizationInfo($deal_info['data']['org_id']['value']);
                    $org_data = json_decode($org_data, "true");
                    $deal_amount = $each_sms['deal_amount'];
                    if (isset($org_data['data']['e46960a5a8d75e6909eebf64ef3cd0c0fe426119'])) {
                        $deal_amount = $org_data['data']['e46960a5a8d75e6909eebf64ef3cd0c0fe426119'];
                    }
                    if($deal_amount=='' || $deal_amount==0){
                        $deal_amount = 50000;
                    }
                    $deal_amount = number_format($deal_amount);

                    echo "<br><br><div style='font-size:30px;color:green;font-weight:bold;'>SMS Sent</div>";
                    $name = explode(" ", $deal_info['data']['person_id']['name']);
                    $agent = $deal_info['data']['user_id']['name'];
                    $agent_id = $deal_info['data']['user_id']['value'];
                    $org = $deal_info['data']['org_id']['name'];
                    $fname = ucwords(strtolower($name[0]));

                    if ($agent_id != '' && $agent_id != "990918") {
                        $agent_data = qs("select * from pd_users where tenant_id='{$GLOBALS['tenant_id']}' AND  pd_id='{$agent_id}'");
                    } else {
                        $agent_data = qs("select * from pd_users where tenant_id='{$GLOBALS['tenant_id']}' AND is_default='1'");
                    }
                    $agent = ucwords(strtolower($agent_data['name']));
                    $agent_arr = explode(" ", $agent);
                    $agent = $agent_arr[0];


                    $message = str_ireplace("[COMPANY NAME]", $org, $message);
                    $message = str_ireplace("[AGENTS NAME]", $agent, $message);
                    $message = str_ireplace("[MERCHANTS NAME]", $fname, $message);
                    $message = str_ireplace("[AMOUNT REQUESTED]", $deal_amount, $message);
                    echo "Following Message sent: " . $message;

                    qu("sms_sequence", array($req_sms_detail['next_seq'] => '1'), "id='{$each_sms['id']}'");
                    $note_data = array();
                    $note_data['deal_id'] = $each_sms['last_deal_id'];
                    $note_data['content'] = "Text was sent on ".formatPhone($each_sms['phone'],4).".<br><br>Text: {$message}";
                    $data = $apiPD->createNote($note_data);
                    
                    $apiCall->messageNow($each_sms['phone'], $message, "2");
                    break;
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
endforeach;
die;
?>