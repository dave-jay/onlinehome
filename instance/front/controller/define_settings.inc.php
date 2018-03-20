<?php
if(!isset($tenant_id) && !isset($unique_code)){
    addLogs($_REQUEST['q'], 0, "tenant_id or unique_code must be set.");
    die;
}

if(isset($unique_code)){
    $tenant_data = qs("select *,id as tenant_id from admin_users where `unique_code` = '{$unique_code}'");    
    if(empty($tenant_data['tenant_id'])){
        addLogs($_REQUEST['q'], 0, "Tenant not found for unique code = {$_REQUEST['unique_code']}");        
        die;
    }
    $tenant_id = $tenant_data['tenant_id'];
}
$conf_data = User::setConfig($tenant_data['tenant_id']); 


//SET VALUE FROM CONFIG TABLE
define("ACCOUNT_SID",$conf_data['TWILIO_ACCOUNT_SID']);
define("AUTH_TOKEN",$conf_data['TWILIO_AUTH_TOKEN']);
define("TWILIO_PHONE_NUMBER",$conf_data['TWILIO_PHONE_1']);
define("TWILIO_PHONE_NUMBER2",$conf_data['TWILIO_PHONE_2']);
date_default_timezone_set($conf_data['TIMEZONE']);

?>