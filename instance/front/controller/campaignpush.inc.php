<?php
$call_status = qs("select *,value as seq_status from config where `key` = 'SEQUENCE_STATUS'");
if(strtolower($call_status['seq_status'])!="on"){
//    qi("test",array("t"=>"followup seq is off."));
    die;
}

$apiPD = new apiPipeDrive();
$apiCore = new apiCore();
date_default_timezone_set('America/New_York');


# receive the payload
$payload = file_get_contents('php://input');
$data = json_decode(@$payload, true);
$deal_source = $data['current']['c2a6fc3129578b646ae55717ed15f03ce3ee4df0'];
qi('active_campaign_log', array("log" => "push: 1"));
if (!in_array($deal_source, array('44','37'))) {
    die;
}
qi('active_campaign_log', array("log" => "push: 2"));
//Getting Deal Info and change stage if pipeline id is '1' (i.e. for "Leads")
$deal_info = $apiPD->getDealInfo($data['current']['id']);
qi('active_campaign_log', array("log" => "push: 3"));
$deal_info = json_decode($deal_info, TRUE);
$tag = $agent = $deal_amount = $phone2 = $active_campaign_contact_id = $fname = $lname = $email = $phone = $org = $pipedrive_id = $pipedrive_stage = '';
$agent_id = $agent_linkedin_link = $agent_phone = '';
$phone_arr = array();
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
        if (isset($each['value']) && $each['value'] != '') {
            $phone_arr[] = array('phone' => $each['value'], 'type' => 'NOT CHECK');
            if ($phone != '') {
                $phone2 = $each['value'];
            } else {
                $phone = $each['value'];
            }
        }
    }
    $org = $deal_info['data']['org_id']['name'];
    $org_id = $deal_info['data']['org_id']['value'];
    $agent = $deal_info['data']['user_id']['name'];
    $agent_id = $deal_info['data']['user_id']['value'];
    $deal_amount = $deal_info['data']['value'];
    $pipedrive_id = $deal_info['data']['id'];
    $pipedrive_stage = $deal_info['data']['stage_id'];
    qi('active_campaign_log', array("log" => "push: 4"));
} else {
    qi('active_campaign_log', array("log" => "Deal info not found. " . json_decode($data)));
    die;
}
qi('active_campaign_log', array("log" => "push: 5"));

$org_data = $apiPD->getOrganizationInfo($org_id);
qi('active_campaign_log', array("log" => "push: 6"));
$org_data = json_decode($org_data, "true");
if (isset($org_data['data']['e46960a5a8d75e6909eebf64ef3cd0c0fe426119'])) {
    $deal_amount = $org_data['data']['e46960a5a8d75e6909eebf64ef3cd0c0fe426119'];
}
if($deal_amount=='' || $deal_amount==0){
    $deal_amount = 50000;
}
$deal_amount = number_format($deal_amount);
if(isset($deal_info['data']['person_id']['value'])){
    $personal_info_data = $apiPD->getPersonInfo($deal_info['data']['person_id']['value']);
    $personal_info_data = json_decode($personal_info_data,true);
    if(isset($personal_info_data['data']['d02fbfc390b8bec4159df2146340e8468a2c3d10'])){
        $phone_arr[] = array('phone' => $personal_info_data['data']['d02fbfc390b8bec4159df2146340e8468a2c3d10'], 'type' => 'NOT CHECK');
    }
}
$mobile_number_found = 0;
qi('active_campaign_log', array("log" => "push: 7"));
foreach ($phone_arr as $key => $each_phone) {
    qi('active_campaign_log', array("log" => "push: 8"));
    $phone_carrier_data = $apiCore->getPhoneNumbersCarrier($each_phone['phone']);
    $phone_carrier_data = json_decode($phone_carrier_data, true);
    if (isset($phone_carrier_data['carrier']['type'])) {
        $phone_arr[$key]['type'] = $phone_carrier_data['carrier']['type'];
    }
    //strtolower($phone_carrier_data['carrier']['type']) == 'voip'
    if (isset($phone_carrier_data['carrier']['type']) && (strtolower($phone_carrier_data['carrier']['type']) == 'mobile')) {
        $mobile_number_found = 1;
        if ($phone != $each_phone['phone']) {
            if ($phone2 == $each_phone['phone']) {
                $phone2 = $phone;
                $phone = $each_phone['phone'];
                qi('active_campaign_log', array("log" => "Phone number swap"));
            } else {
                $phone = $each_phone['phone'];
            }
        }
        break;
    }
}

if($mobile_number_found!=1){
    $note_data = array();
    $note_data['deal_id'] = $pipedrive_id;
    $note_data['content'] = "Note: Get a Mobile Phone Number from the Merchant";
    $apiPD->createNote($note_data);
}
qi('active_campaign_log', array("log" => "push: 9"));
$stage_data = $apiPD->getAllStage();
$stage_data = json_decode($stage_data, "true");
$stage = array();

if (isset($stage_data['data'])) {
    foreach ($stage_data['data'] as $each_stage) {
        $stage[$each_stage['id']] = $each_stage; //'order_nr','name'
    }
}
$deal_detail['e585bd988070d2bdfb2af36d968521c3f9aa949a'] = 'ON';
$apiPD->modifyDeal($pipedrive_id, $deal_detail);
$tbl_camp_data = qs("select * from active_campaign_contact where email='$email'");
$ac_data = array();
$ac_data['email'] = $email;
$ac_data['need_to_start'] = '1';
$ac_data['need_to_start_email'] = '1';
$ac_data['need_to_start_time'] = date("Y-m-d H:i:s",(time()));
$ac_data['last_deal_id'] = $pipedrive_id;
$ac_data['last_stage_id'] = $pipedrive_stage;
$ac_data['last_stage_name'] = $stage[$pipedrive_stage]['name'];
$ac_data['phone'] = formatPhone($phone,4);
$ac_data['is_mobile_number'] = $mobile_number_found;
$ac_data['last10phone'] = last10Char($phone);
$ac_data['alternate_phone'] = formatPhone($phone2,4);
$ac_data['phone_detail'] = json_encode($phone_arr);
$tag = $ac_data['tags'] = ac_tag_generate($stage[$pipedrive_stage]['name']);
qi('active_campaign_log', array("log" => "push: 10"));
if (empty($tbl_camp_data)) {
    qi('active_campaign_log', array("log" => "push: 11"));
    $active_campaign_contact_id = qi('active_campaign_contact', _escapeArray($ac_data));
} else {
    qi('active_campaign_log', array("log" => "push: 12"));
    //$tag .= ",".$tbl_camp_data['tags']; // Tag Should be new at every new deal. so, It is comment out
    $active_campaign_contact_id = qu('active_campaign_contact', _escapeArray($ac_data), "id='{$tbl_camp_data['id']}'");
    $active_campaign_contact_id = $tbl_camp_data['id'];
}
die;
?>