<?php
sleep(5);
$apiPD = new apiPipeDrive();
$payload = file_get_contents('php://input');
$data = json_decode(@$payload, true);
if (isset($data['current']['stage_id'])) {
    $deal_info = $apiPD->getDealInfo($data['current']['id']);
    $deal_info = json_decode($deal_info, TRUE);
    $tag = $agent = $deal_amount = $phone2 = $active_campaign_contact_id = $fname = $lname = $email = $phone = $org = $pipedrive_id = $pipedrive_stage = '';
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
        $agent = ($deal_info['data']['user_id']['name']=="Dave Jay (Programmer)"?"Sprout Lending Team":$deal_info['data']['user_id']['name']);
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
    $active_campaign_contact_id = qi('active_campaign_contact', _escapeArray($ac_data));
} else {
    if ($tbl_camp_data['last_stage_id'] == $pipedrive_stage) {
        qi('active_campaign_log', array("log" => "Stage id not changed."));
        die;
    }
    $tag .= ",".$tbl_camp_data['tags'];
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
$campaing_class::$tag = trim($tag,",");

$campaing_class::$PIPEDRIVE_ID = $pipedrive_id;
$campaing_class::$PIPEDRIVE_STAGE = $stage[$pipedrive_stage]['name'];
$campaing_class::$AGENT_NAME = $agent;
$campaing_class::$DEAL_AMOUNT = $deal_amount;
$campaing_class::$ALTERNATE_PHONE = $phone2;
$campaing_class::$PIPEDRIVE_DEAL_LINK = "https://sprout2.pipedrive.com/deal/".$pipedrive_id;
$data_camp = $campaing_class->pushContact($stage_mapping_arr[$pipedrive_stage]['ac_list_id']);
if (isset($data_camp->success) && ($data_camp->success || $data_camp->success == '1')) {
    $active_campaign_contact_id = qu('active_campaign_contact', array("campaign_contact_id" => $data_camp->subscriber_id), "id='{$active_campaign_contact_id}'");
    qi('active_campaign_log', array("log" => "Active Campaign Contact Id: " . $data_camp->subscriber_id . "<br>Message:" . $data_camp->result_message));
} else {
    qi('active_campaign_log', array("log" => "Active campaign error. " . json_encode($data_camp) . " Deal:" . $deal_info['data']['id']));
}
die;
?>