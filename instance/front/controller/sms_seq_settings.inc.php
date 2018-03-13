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
if (isset($_REQUEST['hid_is_edit'])) {
    $sms_data = q("SELECT * FROM  `sms_seq_time`  WHERE  tenant_id='{$_SESSION['user']['tenant_id']}'");
    foreach ($sms_data as $each) {
        $data[$each['sequence_name']] = $each;
    }
    foreach ($data as $key => $value) {
        $is_active = isset($_REQUEST['chk_'.$key])?"1":"0";
        qu("sms_seq_time", array("time" => $_REQUEST[$key],"is_active"=>$is_active), "sequence_name='{$key}' AND tenant_id='{$_SESSION['user']['tenant_id']}'");
    }
    $_SESSION['greetings_msg'] = 'Api Key Updated successfully!';
    if ($_REQUEST['is_first_time'] == "1") {
        _R(lr('twilio_settings?first_time=1'));
    }
}

$sms_data = q("SELECT * FROM  `sms_seq_time`  WHERE  tenant_id='{$_SESSION['user']['tenant_id']}'");
foreach ($sms_data as $each) {
    $data[$each['sequence_name']] = $each;
}
$first_time = (isset($_REQUEST['first_time']) && $_REQUEST['first_time']) ? 1 : 0;
_cg("page_title", "PipeDrive Settings");
?>