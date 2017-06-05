<?php
$call_status = qs("select *,value as seq_status from config where `key` = 'SEQUENCE_STATUS'");
if(strtolower($call_status['seq_status'])!="on"){
//    qi("test",array("t"=>"followup seq is off."));
    die;
}

sleep(5);
$apiPD = new apiPipeDrive();
$payload = file_get_contents('php://input');
$data = json_decode(@$payload, true);
$deal_source = $data['current']['c2a6fc3129578b646ae55717ed15f03ce3ee4df0'];
if (!in_array($deal_source, array('44','37'))) {
    die;
}
if (isset($data['current']['stage_id'])) {
    $deal_info = $apiPD->getDealInfo($data['current']['id']);
    $deal_info = json_decode($deal_info, TRUE);
    $sms_seq_data = qs("select * from sms_sequence where last_deal_id='{$data['current']['id']}'");
    if (isset($deal_info['data']['e585bd988070d2bdfb2af36d968521c3f9aa949a'])) {
        if ($deal_info['data']['e585bd988070d2bdfb2af36d968521c3f9aa949a'] == '196') {
            if(!empty($seq_deal) && $seq_deal['day7_1_sent']=='1' && $seq_deal['day7_1_sent']=='0'){
                qu("deal_seq_status", _escapeArray(array("seq_status" => 'OFF_AUTO')),"deal_id='{$data['current']['id']}'");            
            }else{
                qu("deal_seq_status", _escapeArray(array("seq_status" => 'OFF_MANU')),"deal_id='{$data['current']['id']}'");            
            }            
        } else if ($deal_info['data']['e585bd988070d2bdfb2af36d968521c3f9aa949a'] == '195') {
            qu("deal_seq_status", _escapeArray(array("seq_status" => 'ON')),"deal_id='{$data['current']['id']}'");                        
        }
    }
    qi("test",  _escapeArray(array("payload"=> json_encode($data))));
    qi("test",  _escapeArray(array("payload"=> json_encode($deal_info))));
    $sms_seq_app_out_data = qs("select * from sms_sequence_app_out where last_deal_id='{$data['current']['id']}'");
    if((!empty($sms_seq_data) || !empty($sms_seq_app_out_data)) && !empty($deal_info)){
        if(($sms_seq_data['need_to_send_sms']==1 || $sms_seq_app_out_data['need_to_send_sms']==1) && $deal_info['data']['e585bd988070d2bdfb2af36d968521c3f9aa949a']=='196'){
            $user_detail = qs("select * from pd_users where pd_id='{$data['meta']['user_id']}'");
            $note_data['deal_id'] = $data['current']['id'];            
            $note_data['content'] = "SMS Sequence(FOLLOW-UP SEQUENCE) has been set to 'OFF'".(isset($user_detail['name'])?" by {$user_detail['name']} ":"").".";
            $apiPD->createNote($note_data);
            if(!empty($sms_seq_data))
                qu("sms_sequence",array("need_to_send_sms"=>"0"),"id='{$sms_seq_data["id"]}'");
            if(!empty($sms_seq_app_out_data))            
                qu("sms_sequence_app_out",array("need_to_send_sms"=>"0"),"id='{$sms_seq_app_out_data["id"]}'");
        }
        if($sms_seq_data['need_to_send_sms']==0 && ((isset($sms_seq_app_out_data) && $sms_seq_app_out_data['need_to_send_sms']==0) || !isset($sms_seq_app_out_data)) && $deal_info['data']['e585bd988070d2bdfb2af36d968521c3f9aa949a']!='196'){
            $user_detail = qs("select * from pd_users where pd_id='{$data['meta']['user_id']}'");
            $note_data['deal_id'] = $data['current']['id'];            
            $note_data['content'] = "SMS Sequence(FOLLOW-UP SEQUENCE) has been set to 'ON'".(isset($user_detail['name'])?" by {$user_detail['name']} ":"").".";
            $apiPD->createNote($note_data);
            if(!empty($sms_seq_data))
                qu("sms_sequence",array("need_to_send_sms"=>"1"),"id='{$sms_seq_data["id"]}'");
            if(!empty($sms_seq_app_out_data))     
                qu("sms_sequence_app_out",array("need_to_send_sms"=>"1"),"id='{$sms_seq_app_out_data["id"]}'");
        }
    }
    $email_seq_data = qs("select * from email_sequence where last_deal_id='{$data['current']['id']}'");
    if(!empty($email_seq_data) && !empty($deal_info)){
        if($email_seq_data['need_to_send_email']==1 && $deal_info['data']['e585bd988070d2bdfb2af36d968521c3f9aa949a']=='196'){            
            qu("email_sequence",array("need_to_send_email"=>"0"),"id='{$email_seq_data["id"]}'");
        }
        if($email_seq_data['need_to_send_email']==0 && $deal_info['data']['e585bd988070d2bdfb2af36d968521c3f9aa949a']!='196'){            
            qu("email_sequence",array("need_to_send_email"=>"1"),"id='{$email_seq_data["id"]}'");
        }
    }
    $tag = $agent = $deal_amount = $phone2 = $active_campaign_contact_id = $fname = $lname = $email = $phone = $org = $pipedrive_id = $pipedrive_stage = '';
    $agent_id = $agent_linkedin_link = $agent_phone = '';
    if (isset($deal_info['data']['id'])) {
        $name = explode(" ", $deal_info['data']['person_id']['name']);
        $fname = $name[0];
        if (count($name) > 2) {
            array_shift($name);
            $lname = implode(" ", $name);
        } else {
            $lname = $name[1];
        }
        foreach ($deal_info['data']['person_id']['email'] as $each) {
            if (isset($each['value']) && $each['value'] != '') {
                $email = $each['value'];
                break;
            }
        }
        foreach ($deal_info['data']['person_id']['phone'] as $each) {
            if($phone!=''){
                $phone2 = $each['value'];
                break;
            }else{
                $phone = $each['value'];
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
        qi('active_campaign_log', array("log" => "Deal info not found. Detail" . json_decode($deal_info)));
        die;
    }
} else {
    qi('active_campaign_log', array("log" => "Stage id not found. Details:" . json_encode($data)));
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
q("update sms_sequence set deal_amount='".$deal_amount."',hold_till_date='".date("Y-m-d",strtotime($deal_info['data']['c96027b10f722b45d43a1821b25b192528934972']))."' where last_deal_id='".$pipedrive_id."'");
q("update sms_sequence_app_out set hold_till_date='".date("Y-m-d",strtotime($deal_info['data']['c96027b10f722b45d43a1821b25b192528934972']))."' where last_deal_id='".$pipedrive_id."'");

$stage_data = $apiPD->getAllStage();
$stage_data = json_decode($stage_data, "true");
$stage = array();

if (isset($stage_data['data'])) {
    foreach ($stage_data['data'] as $each_stage) {
        $stage[$each_stage['id']] = $each_stage; //'order_nr','name'
    }
}
$tbl_camp_data = qs("select * from active_campaign_contact where email='$email'");
$ac_data = array();
$ac_data['email'] = $email;
$ac_data['last_deal_id'] = $pipedrive_id;
$ac_data['last_stage_id'] = $pipedrive_stage;
$ac_data['last_stage_name'] = $stage[$pipedrive_stage]['name'];
$tag = $ac_data['tags'] = ac_tag_generate($stage[$pipedrive_stage]['name']);


if (empty($tbl_camp_data)) {
    qi('active_campaign_log', array("log" => "Update: no need to add."));
    die;
    //$active_campaign_contact_id = qi('active_campaign_contact', _escapeArray($ac_data));
} else {
    if ($tbl_camp_data['last_stage_id'] == $pipedrive_stage) {
        qi('active_campaign_log', array("log" => "Stage id not changed."));
    }else{
        if ($pipedrive_stage == '3' && in_array($deal_source, array('44','37'))){
            $ac_data['need_to_start'] = '2';
            $ac_data['need_to_start_email'] = '2';
            //$ac_data['need_to_start_time'] = date("Y-m-d",(time()+84600));
            $ac_data['need_to_start_time'] = date("Y-m-d");
            qi("active_campaign_log", _escapeArray(array("log"=>"App Out Email is set for deal ".$pipedrive_id)));
        }
        $tag .= ",".$tbl_camp_data['tags'];
    }
    $active_campaign_contact_id = qu('active_campaign_contact', _escapeArray($ac_data), "id='{$tbl_camp_data['id']}'");
    $active_campaign_contact_id = $tbl_camp_data['id'];
}

if($agent_id!='' && $agent_id != "990918"){
    $agent_data = qs("select * from pd_users where pd_id='{$agent_id}'");
}else{
    $agent_data = qs("select * from pd_users where is_default='1'");
}
$agent = $agent_data['name'];

if (isset($data_camp->success) && ($data_camp->success || $data_camp->success == '1')) {
    $active_campaign_contact_id = qu('active_campaign_contact', array("campaign_contact_id" => $data_camp->subscriber_id), "id='{$active_campaign_contact_id}'");
    qi('active_campaign_log', array("log" => "Active Campaign Contact Id: " . $data_camp->subscriber_id . "<br>Message:" . $data_camp->result_message));
} else {
    qi('active_campaign_log', array("log" => "Active campaign error. " . json_encode($data_camp) . " Deal:" . $deal_info['data']['id']));
}
die;
?>