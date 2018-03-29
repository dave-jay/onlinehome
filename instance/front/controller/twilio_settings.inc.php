<?php

/**
 * Admin side Login file
 * 
 * 
 
 * @version 1.0
 * @package lysoft
 * 
 */
//$jsInclude = "home.js.php";
 //_R(lr('dashboard'));
$urlArgs = _cg("url_vars");
if(isset($_REQUEST['txt_account_sid']) && isset($_REQUEST['txt_auth_token'])){
    
    qu("config",array("value"=>$_REQUEST['txt_account_sid']),"tenant_id='{$_SESSION['user']['tenant_id']}' AND `key`='TWILIO_ACCOUNT_SID'");
    qu("config",array("value"=>$_REQUEST['txt_auth_token']),"tenant_id='{$_SESSION['user']['tenant_id']}' AND `key`='TWILIO_AUTH_TOKEN'");
    qu("config",array("value"=>$_REQUEST['txt_phone1']),"tenant_id='{$_SESSION['user']['tenant_id']}' AND `key`='TWILIO_PHONE_1'");
    qu("config",array("value"=>$_REQUEST['txt_phone2']),"tenant_id='{$_SESSION['user']['tenant_id']}' AND `key`='TWILIO_PHONE_2'");
    $_SESSION['greetings_msg']='Keys Updated successfully!';
    $_SESSION['config']['TWILIO_ACCOUNT_SID'] = $_REQUEST['txt_account_sid'];
    $_SESSION['config']['TWILIO_AUTH_TOKEN'] = $_REQUEST['txt_auth_token'];
    $_SESSION['config']['TWILIO_PHONE_1'] = $_REQUEST['txt_phone1'];
    $_SESSION['config']['TWILIO_PHONE_2'] = $_REQUEST['txt_phone2'];
    if($_REQUEST['is_first_time']=="1"){
         _R(lr('call_redial_setting?first_time=1'));
    }
    
}
$conf_data = User::setConfig($_SESSION['user']['tenant_id']);  
 $first_time = (isset($_REQUEST['first_time'])&&$_REQUEST['first_time'])?1:0;
_cg("page_title", "Twilio Settings");
?>