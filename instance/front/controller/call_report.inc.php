<?php

$from_date = '';
$to_date = '';
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

$call_list = q("SELECT * FROM `call_detail` WHERE 1=1 {$where}");

$jsInclude = "call_report.js.php";
_cg("page_title", "Call Report");
?>