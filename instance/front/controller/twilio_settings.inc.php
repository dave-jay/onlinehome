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
}
 $TWILIO_ACCOUNT_SID = qs("SELECT * FROM  `config` WHERE  `key` LIKE  'TWILIO_ACCOUNT_SID'");
 $TWILIO_AUTH_TOKEN = qs("SELECT * FROM  `config` WHERE  `key` LIKE  'TWILIO_AUTH_TOKEN'");
 
_cg("page_title", "Twilio Settings");
?>