<?php

$from_date = '';
$to_date = '';

if (isset($_REQUEST['download']) && $_REQUEST['download']==3) {    
    $destination_name_ulaw = "https://api.twilio.com/2010-04-01/Accounts/".ACCOUNT_SID."/Recordings/RE338a2c7e3153c26600a45d42c6c4b358.wav";
    $src = $destination_name_ulaw;
    $dest = _PATH."b.wav";
    file_put_contents($dest, file_get_contents($src));
    die;
    exit();
}


if (isset($_REQUEST['download'])) {
    //$destination_name_ulaw1 = 'a.wav';
    $destination_name_ulaw = _PATH . 'RE338a2c7e3153c26600a45d42c6c4b358.wav';
    //$destination_name_ulaw = "https://api.twilio.com/2010-04-01/Accounts/".ACCOUNT_SID."/Recordings/RE338a2c7e3153c26600a45d42c6c4b358";
    header('Content-Description: File Transfer');
    header('Content-Type: audio/wave');
    header('Content-Disposition: attachment; filename=' . basename($destination_name_ulaw));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($destination_name_ulaw));
    ob_clean();
    flush();
    readfile($destination_name_ulaw);

    die;
    exit();
}
if (isset($_REQUEST['start_date']) && trim($_REQUEST['start_date']) != '') {
    $from_date = trim($_REQUEST['start_date']);
}

if (isset($_REQUEST['end_date']) && trim($_REQUEST['end_date']) != '') {
    $to_date = trim($_REQUEST['end_date']);
}

$where = '';
if ($from_date != '' && $to_date != '') {
    $where = " AND DATE(created_at) >= '{$from_date}' AND DATE(created_at) <= '{$to_date}' ";
}

$call_list = q("SELECT * FROM `call_detail` WHERE 1=1 {$where} order by created_at desc");

$jsInclude = "call_report.js.php";
_cg("page_title", "Call Report");
?>