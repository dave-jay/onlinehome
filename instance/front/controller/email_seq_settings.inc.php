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
if(isset($_REQUEST['hid_is_edit'])){
    qu("config",array("value"=>$_REQUEST['txt_api_key']),"id='{$_REQUEST['hid_is_edit']}'");
    $_SESSION['config']['PIPEDRIVER_API_KEY'] = $_REQUEST['txt_api_key'];
    $_SESSION['greetings_msg']='Api Key Updated successfully!';
    if($_REQUEST['is_first_time']=="1"){
         _R(lr('twilio_settings?first_time=1'));
    }
}
 $pipedriver_api_key = qs("SELECT * FROM  `email_seq_time`  WHERE  `key` LIKE  'PIPEDRIVER_API_KEY' and tenant_id='{$_SESSION['user']['tenant_id']}'");
 $first_time = (isset($_REQUEST['first_time'])&&$_REQUEST['first_time'])?1:0;
_cg("page_title", "PipeDrive Settings");
?>