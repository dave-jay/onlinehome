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
    $_SESSION['greetings_msg']='Call redial time Updated successfully!';
    $_SESSION['config']['CALL_REDIAL_TIME'] = $_REQUEST['txt_api_key'];
    if($_REQUEST['is_first_time']=="1"){
         _R(lr('call_report?first_time=1'));
    }
}
 $pipedriver_api_key = qs("SELECT * FROM  `config` WHERE  `key` LIKE  'CALL_REDIAL_TIME' and tenant_id='{$_SESSION['user']['tenant_id']}'");
 $first_time = (isset($_REQUEST['first_time'])&&$_REQUEST['first_time'])?1:0;
_cg("page_title", "PipeDrive Settings");
?>