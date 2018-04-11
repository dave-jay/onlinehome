<?php
die;
$call_status = qs("select *,value as seq_status from config where `key` = 'EMAIL_SEQUENCE_STATUS'");
if(strtolower($call_status['seq_status'])!="on"){
//    qi("test",array("t"=>"followup seq is off."));
    die;
}

$need_to_start_data = qs("select * from active_campaign_contact where need_to_start_email='2' order by created_at desc");
if (!empty($need_to_start_data)) {
    if (time() > (strtotime($need_to_start_data['need_to_start_time']))) {
        qu("active_campaign_contact", array("need_to_start_email" => "0"), "id='{$need_to_start_data['id']}'");
    } else {
        echo "please wait for " . ((strtotime($need_to_start_data['modified_at']) + 60) - time()) . " sec";
        die;
    }
} else {
    echo "no new deal is coming";
    die;
}
qd("email_sequence_app_out", "last_deal_id='{$need_to_start_data['last_deal_id']}' OR email='{$need_to_start_data['email']}'");
$last_seq = qs("select * from email_sequence where last_deal_id = '{$need_to_start_data['last_deal_id']}'");

$fields = array();
$fields['tenant_id'] = $need_to_start_data['tenant_id'];
$fields['last_deal_id'] = $last_seq['last_deal_id'];
$fields['email'] = $need_to_start_data['email'];
$fields['timezone'] = $last_seq['timezone'];
qi("email_sequence_app_out",  _escapeArray($fields));

$deal_detail=array();
$deal_detail['e585bd988070d2bdfb2af36d968521c3f9aa949a'] = 'ON';
$apiPD->modifyDeal($last_seq['last_deal_id'], $deal_detail);
die;
?>