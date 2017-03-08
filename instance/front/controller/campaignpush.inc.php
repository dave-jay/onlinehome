<?php
$apiPD = new apiPipeDrive();
date_default_timezone_set('America/New_York');


# receive the payload
$payload = file_get_contents('php://input');
$data = json_decode(@$payload, true);

//Getting Deal Info and change stage if pipeline id is '1' (i.e. for "Leads")
$deal_info = $apiPD->getDealInfo($data['current']['id']);
$deal_info = json_decode($deal_info, TRUE);
$fname = $lname = $email = $phone = $org = '';
if(isset($deal_info['data']['id'])){
    $name = explode(" ", $deal_info['data']['person_id']['name']);
    $fname = $name[0];
    if(count($name)>2){
        array_shift($name);
        $lname = implode(" ", $name);
    }else{
        $lname = $name[1];
    }
    foreach($deal_info['data']['person_id']['email'] as $each){
        if(isset($each['value']) && $each['value']!=''){
            $email = $each['value'];
            break;
        }
    }
    foreach($deal_info['data']['person_id']['phone'] as $each){
        if(isset($each['value']) && $each['value']!=''){
            $phone = $each['value'];
            break;
        }
    }
    $org = $deal_info['data']['org_id']['name'];    
}else{
    $inserted_id = qi("activity_log",  _escapeArray(array("payload"=>  "Deal not added in active campaign. ".json_decode($data))));
    die;
}
$campaing_class  = new Campaign();
$campaing_class::$contact_email = $email;
$campaing_class::$contact_fname = $fname;
$campaing_class::$contact_lname = $lname;
$campaing_class::$contact_phone = $phone;
$campaing_class::$contact_org = $org;
$data_camp = $campaing_class->pushContact(1);
if(isset($data_camp->success) && ($data_camp->success || $data_camp->success=='1')){
    $inserted_id = qi("activity_log",  _escapeArray(array("payload"=>  "Success:".  json_encode($data_camp)." Deal:".$deal_info['data']['id'])));
}else{
    $inserted_id = qi("activity_log",  _escapeArray(array("payload"=>  "Active campaign error. ".json_encode($data_camp)." Deal:".$deal_info['data']['id'])));
}
die;
?>