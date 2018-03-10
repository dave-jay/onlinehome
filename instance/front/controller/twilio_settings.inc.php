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
if(isset($_REQUEST['hid_sid_id']) && isset($_REQUEST['hid_token_id'])){
    qu("config",array("value"=>$_REQUEST['txt_account_sid']),"id='{$_REQUEST['hid_sid_id']}'");
    qu("config",array("value"=>$_REQUEST['txt_auth_token']),"id='{$_REQUEST['hid_token_id']}'");
    $_SESSION['greetings_msg']='Keys Updated successfully!';
    $_SESSION['config']['TWILIO_ACCOUNT_SID'] = $_REQUEST['txt_account_sid'];
    $_SESSION['config']['TWILIO_AUTH_TOKEN'] = $_REQUEST['txt_auth_token'];
    if($_REQUEST['is_first_time']=="1"){
         _R(lr('call_redial_setting?first_time=1'));
    }
    
}
 $TWILIO_ACCOUNT_SID = qs("SELECT * FROM  `config` WHERE  `key` LIKE  'TWILIO_ACCOUNT_SID' and tenant_id='{$_SESSION['user']['tenant_id']}'");
 $TWILIO_AUTH_TOKEN = qs("SELECT * FROM  `config` WHERE  `key` LIKE  'TWILIO_AUTH_TOKEN' and tenant_id='{$_SESSION['user']['tenant_id']}'");
 $first_time = (isset($_REQUEST['first_time'])&&$_REQUEST['first_time'])?1:0;
_cg("page_title", "Twilio Settings");
?>