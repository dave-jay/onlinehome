<?php

$all_tenants = q("select * from admin_users where is_active='1'");
foreach($all_tenants as $each_tenant):
    $GLOBALS['tenant_id'] = $each_tenant['id'];
    include _PATH.'instance/front/controller/define_settings.inc.php';
    $apiPD = new apiPipeDrive($conf_data['PIPEDRIVER_API_KEY']);
    
    if(strtolower($conf_data['SEQUENCE_STATUS'])!="on"){
        continue;        
    }
    
    $need_to_start_data = qs("select * from active_campaign_contact where tenant_id='{$GLOBALS['tenant_id']}' AND need_to_start='2' order by created_at desc");
    if(!empty($need_to_start_data)){
        if(time()>(strtotime($need_to_start_data['need_to_start_time']))){
            qu("active_campaign_contact",array("need_to_start"=>"0"),"id='{$need_to_start_data['id']}'");            
        }else{
            echo "please wait for ".((strtotime($need_to_start_data['modified_at'])+60)-time())." sec";
            continue;
        }
    }else{
        echo "no new deal is coming";
        continue;
    }
    qd("sms_sequence_app_out", " tenant_id='{$GLOBALS['tenant_id']}' AND (last_deal_id='{$need_to_start_data['last_deal_id']}' OR last10phone='{$need_to_start_data['last10phone']}')");
    $last_seq = qs("select * from sms_sequence where  tenant_id='{$GLOBALS['tenant_id']}' AND  last10phone = '{$need_to_start_data['last10phone']}'");

    $fields = array();
    $fields['tenant_id'] = $GLOBALS['tenant_id'];
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
endforeach;
die;
?>