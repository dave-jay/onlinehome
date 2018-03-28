<?php

/**
 * Admin side Login file
 * 
 * 

 * @version 1.0
 * @package lysoft
 * 
 */

//_R(lr('dashboard'));
$urlArgs = _cg("url_vars");
if (isset($_REQUEST['hid_is_edit'])) {
    $sms_data = q("SELECT * FROM  `email_seq_time`  WHERE  tenant_id='{$_SESSION['user']['tenant_id']}'");
    foreach ($sms_data as $each) {
        $data[$each['sequence_name']] = $each;
    }
    foreach ($data as $key => $value) {
        $time = $_REQUEST[$key];
        $dynamic_time = $_REQUEST[$key.'_dynamic_time'];
        $sub = $_REQUEST[$key.'_sub'];
        $text = $_REQUEST[$key.'_text'];
        $is_active = ($_REQUEST['rd_'.$key]=="fixed")?"1":"0";
        qu("email_seq_time", _escapeArray(array("time" => $time,"dynamic_time"=>$dynamic_time,"email_text"=>$text,"email_subject"=>$sub,"is_active"=>$is_active)), "sequence_name='{$key}' AND tenant_id='{$_SESSION['user']['tenant_id']}'");
    }
    $_SESSION['greetings_msg'] = 'Email Sequence Updated successfully!';
    if ($_REQUEST['is_first_time'] == "1") {
        _R(lr('twilio_settings?first_time=1'));
    }
}

$sms_data = q("SELECT * FROM  `email_seq_time`  WHERE  tenant_id='{$_SESSION['user']['tenant_id']}'");
foreach ($sms_data as $each) {
    $data[$each['sequence_name']] = $each;
}
$first_time = (isset($_REQUEST['first_time']) && $_REQUEST['first_time']) ? 1 : 0;

$jsInclude = "sequence.js.php";
_cg("page_title", "Email Sequence Settings");
?>