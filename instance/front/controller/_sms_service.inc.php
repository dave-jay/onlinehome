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
if(isset($_REQUEST['txt_sms'])){
    unset($fields);
    $fields['sms'] = $_REQUEST['txt_sms'];
    $fields['activity'] = $_REQUEST['ddl_type'];
    $fields['agent'] = $_REQUEST['ddl_agent'];    
    qi("messages",  _escapeArray($fields));
    $_SESSION['greetings_msg']='Record Added successfully!';
}
 $message_list = q("SELECT * FROM  `messages`");
 
_cg("page_title", "SMS Text");
?>