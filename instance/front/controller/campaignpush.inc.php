<?php

$apiPD = new apiPipeDrive();
$apiCore = new apiCore();
date_default_timezone_set('America/New_York');


# receive the payload
$payload = file_get_contents('php://input');
$data = json_decode(@$payload, true);
$deal_source = $data['current']['c2a6fc3129578b646ae55717ed15f03ce3ee4df0'];
if (!in_array($deal_source, array('44'))) {
    die;
}
//Getting Deal Info and change stage if pipeline id is '1' (i.e. for "Leads")
$deal_info = $apiPD->getDealInfo($data['current']['id']);
$deal_info = json_decode($deal_info, TRUE);
$tag = $agent = $deal_amount = $phone2 = $active_campaign_contact_id = $fname = $lname = $email = $phone = $org = $pipedrive_id = $pipedrive_stage = '';
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
    $agent = ($deal_info['data']['user_id']['name'] == "Dave Jay (Programmer)" ? "Sprout Lending Team" : $deal_info['data']['user_id']['name']);
    $deal_amount = $deal_info['data']['value'];
    $pipedrive_id = $deal_info['data']['id'];
    $pipedrive_stage = $deal_info['data']['stage_id'];
} else {
    qi('active_campaign_log', array("log" => "Deal not added in active campaign. " . json_decode($data)));
    die;
}

$mobile_number_found = 0;
foreach ($phone_arr as $key => $each_phone) {
    $phone_carrier_data = $apiCore->getPhoneNumbersCarrier($each_phone['phone']);
    $phone_carrier_data = json_decode($phone_carrier_data, true);
    if (isset($phone_carrier_data['carrier']['type'])) {
        $phone_arr[$key]['type'] = $phone_carrier_data['carrier']['type'];
    }
    if (isset($phone_carrier_data['carrier']['type']) && strtolower($phone_carrier_data['carrier']['type'] == 'mobile')) {
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
$ac_data['phone'] = $phone;
$ac_data['last10phone'] = last10Char($phone);
$ac_data['phone_detail'] = json_encode($phone_arr);
$tag = $ac_data['tags'] = ac_tag_generate($stage[$pipedrive_stage]['name']);

if (empty($tbl_camp_data)) {
    $active_campaign_contact_id = qi('active_campaign_contact', _escapeArray($ac_data));
} else {
    //$tag .= ",".$tbl_camp_data['tags']; // Tag Should be new at every new deal. so, It is comment out
    $active_campaign_contact_id = qu('active_campaign_contact', _escapeArray($ac_data), "id='{$tbl_camp_data['id']}'");
    $active_campaign_contact_id = $tbl_camp_data['id'];
}
$stage_mapping_arr = json_decode(STAGE_MAPPING, true);
$campaing_class = new Campaign();
$campaing_class::$contact_email = $email;
$campaing_class::$contact_fname = $fname;
$campaing_class::$contact_lname = $lname;
$campaing_class::$contact_phone = $phone;
$campaing_class::$contact_org = $org;
$campaing_class::$tag = trim($tag, ",");

$campaing_class::$PIPEDRIVE_ID = $pipedrive_id;
$campaing_class::$PIPEDRIVE_STAGE = $stage[$pipedrive_stage]['name'];
$campaing_class::$AGENT_NAME = $agent;
$campaing_class::$DEAL_AMOUNT = $deal_amount;
$campaing_class::$ALTERNATE_PHONE = $phone2;
$campaing_class::$PIPEDRIVE_DEAL_LINK = "https://sprout2.pipedrive.com/deal/" . $pipedrive_id;
$deal_info = $apiPD->getDealInfo($data['current']['id']);
try {
    $data_camp = $campaing_class->pushContact($stage_mapping_arr[$pipedrive_stage]['ac_list_id']);
} catch (Exception $e) {
    qi('active_campaign_log', _escapeArray(array("log" => "6-Exce-" . $e->getMessage())));
}

qi('active_campaign_log', _escapeArray(array("log" => "5-" . json_encode($data_camp))));
if (isset($data_camp->success) && ($data_camp->success || $data_camp->success == '1')) {
    $active_campaign_contact_id = qu('active_campaign_contact', array("campaign_contact_id" => $data_camp->subscriber_id), "id='{$active_campaign_contact_id}'");
    qi('active_campaign_log', _escapeArray(array("log" => "Active Campaign Contact Id: " . $data_camp->subscriber_id . "<br>Message:" . $data_camp->result_message)));
} else {
    qi('active_campaign_log', _escapeArray(array("log" => "Active campaign error. " . json_encode($data_camp) . " Deal:" . $deal_info['data']['id'])));
}

$use_of_fund[1] = 'Advertising & Marketing';
$use_of_fund[2] = 'Additional Location';
$use_of_fund[3] = 'Buyout a Partner';
$use_of_fund[4] = 'Equipment';
$use_of_fund[5] = 'Supplies/Inventory';
$use_of_fund[6] = 'Start a New Business';
$use_of_fund[7] = 'Hiring Additional Staff';
$use_of_fund[8] = 'Get Through a Slow Period';
$use_of_fund[9] = 'Remodeling Location';
$use_of_fund[10] = 'Have In The Bank';
$use_of_fund[41] = 'Working Capital';
$org_data = $apiPD->getOrganizationInfo($org_id);
$org_data = json_decode($org_data, "true");
$org_for = 'Working Capital';
if (isset($org_data['data']['48b7dac9e6fa7666a2f0d9e233bb5139f7493a44'])) {
    qi('active_campaign_log', array("log" => "yes" . $org_data['data']['48b7dac9e6fa7666a2f0d9e233bb5139f7493a44']));
    $org_for = $use_of_fund[$org_data['data']['48b7dac9e6fa7666a2f0d9e233bb5139f7493a44']];
} else {
    qi('active_campaign_log', _escapeArray(array("log" => "No.{$org_id}" . json_encode($org_data['data']['48b7dac9e6fa7666a2f0d9e233bb5139f7493a44']))));
}

if ($mobile_number_found == 1) {
    $sms_seq_data = qs("select * from sms_sequence where last10phone='".last10Char($phone)."'");
    if(!empty($sms_seq_data)){
        qd("sms_sequence","id='{$sms_seq_data['id']}'");
    }
    qi("sms_sequence",array("phone"=>$phone,"last10phone"=>last10Char($phone),"last_deal_id"=>$pipedrive_id, "day1_1_sent"=>"1"));
    $message = "Hi " . trim($fname . ' ' . $lname) . ", it's {$agent}. I just received your request for funding for your business {$org}. and I should be able to get you the $" . $deal_amount . " that you requested for {$org_for}. Can you chat for 2 minutes now to discuss?";
    $note_data['deal_id'] = $pipedrive_id;
    $note_data['content'] = "Welcome Text was sent on {$phone}.<br><br>Text: {$message}";
    $data = $apiPD->createNote($note_data);
    $apiCall = new callWebhook();
    $apiCall->messageNow($phone, $message);
    qi('active_campaign_log', _escapeArray(array("log" => "Trying to message sending on " . $phone)));
}
die;
?>