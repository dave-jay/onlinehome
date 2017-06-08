<?php
$apiPD = new apiPipeDrive();

$call_status = qs("select *,value as seq_status from config where `key` = 'SEQUENCE_STATUS'");
if(strtolower($call_status['seq_status'])!="on"){
    die;
}
$need_to_start_data = qs("select * from active_campaign_contact where need_to_start='2' order by created_at desc");
if(!empty($need_to_start_data)){
    if(time()>(strtotime($need_to_start_data['need_to_start_time']))){
        qu("active_campaign_contact",array("need_to_start"=>"0"),"id='{$need_to_start_data['id']}'");            
    }else{
        echo "please wait for ".((strtotime($need_to_start_data['modified_at'])+60)-time())." sec";
        die;
    }
}else{
    echo "no new deal is coming";
    die;
}
qd("sms_sequence_app_out", "last_deal_id='{$need_to_start_data['last_deal_id']}' OR last10phone='{$need_to_start_data['last10phone']}'");
$last_seq = qs("select * from sms_sequence where last10phone = '{$need_to_start_data['last10phone']}'");

$fields = array();
$fields['last_deal_id'] = $last_seq['last_deal_id'];
$fields['customer_name'] = $last_seq['customer_name'];
$fields['agent_name'] = $last_seq['agent_name'];
$fields['org_name'] = $last_seq['org_name'];
$fields['deal_name'] = $last_seq['deal_name'];
$fields['deal_amount'] = $last_seq['deal_amount'];
$fields['phone'] = $last_seq['phone'];
$fields['last10phone'] = $last_seq['last10phone'];
$fields['timezone'] = $last_seq['timezone'];
qi("sms_sequence_app_out",  _escapeArray($fields));

$deal_detail=array();
$deal_detail['e585bd988070d2bdfb2af36d968521c3f9aa949a'] = 'ON';
$apiPD->modifyDeal($last_seq['last_deal_id'], $deal_detail);
die;
?>