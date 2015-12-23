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
    $_SESSION['greetings_msg']='Api Key Updated successfully!';
}
 $pipedriver_api_key = qs("SELECT * FROM  `config` WHERE  `key` LIKE  'PIPEDRIVER_API_KEY'");
 
_cg("page_title", "PipeDrive Settings");
?>