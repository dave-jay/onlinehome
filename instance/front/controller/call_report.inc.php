<?php

$fil_from_date = '';
$fil_to_date = '';
$fil_source = '';
$fil_agents = '';
$fil_duration = '';
$start_limit = 0;
$page_size = 20;

if(isset($_REQUEST['change_call_status']) && $_REQUEST['change_call_status']=="1"){
    if($_REQUEST['curr_status']=="on"){
        qu("config",array("value"=>"off"),"`key`='CALL_STATUS'");
    }else{
        qu("config",array("value"=>"on"),"`key`='CALL_STATUS'");
    }
    die;
}
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

if (isset($_REQUEST['ddlDateRange']) && trim($_REQUEST['ddlDateRange']) != '') {
    $fil_duration = $_REQUEST['ddlDateRange'];
    if ($_REQUEST['ddlDateRange'] == "ALL_TIME") {
        $fil_from_date = '';
        $fil_to_date = '';
    } elseif ($_REQUEST['ddlDateRange'] == "TODAY") {
        $fil_to_date = $fil_from_date = date('Y-m-d');
    } elseif ($_REQUEST['ddlDateRange'] == "YESTERDAY") {
        $fil_to_date = $fil_from_date = date('Y-m-d', strtotime("-1 day"));
    } elseif ($_REQUEST['ddlDateRange'] == "CURRENT_WEEK") {
        $fil_from_date = date('Y-m-d', strtotime('monday this week'));
        $fil_to_date = date('Y-m-d');
    } elseif ($_REQUEST['ddlDateRange'] == "CURRENT_MONTH") {
        $fil_from_date = date('Y-m-d', strtotime('first day of this month'));
        $fil_to_date = date('Y-m-d');
    } else {
        if (isset($_REQUEST['start_date']) && trim($_REQUEST['start_date']) != '') {
            $fil_from_date = trim($_REQUEST['start_date']);
        }

        if (isset($_REQUEST['end_date']) && trim($_REQUEST['end_date']) != '') {
            $fil_to_date = trim($_REQUEST['end_date']);
        }
    }
}
if (isset($_REQUEST['txtAgent']) && trim($_REQUEST['txtAgent']) != '') {
    $fil_agents = $_REQUEST['txtAgent'];
}
if (isset($_REQUEST['ddlSource']) && trim($_REQUEST['ddlSource']) != '') {
    $fil_source = $_REQUEST['ddlSource'];
}


$where = '';
if ($fil_from_date != '' && $fil_to_date != '') {
    $where .= " AND DATE(created_at) >= '{$fil_from_date}' AND DATE(created_at) <= '{$fil_to_date}' ";
}
if ($fil_agents != '') {
    $where .= " AND agent_name like '%{$fil_agents}%' ";
}
if ($fil_source != '') {
    $where .= " AND source_id = '{$fil_source}' ";
}
if (isset($_REQUEST['count_detail'])) {
    $res_arr = array();
    $call_list = qs("SELECT count(*) as total_calls,sum(recording_duration) as call_duration,min(created_at) as min_date,max(created_at) as max_date FROM `call_detail` cd WHERE 1=1 {$where}");
    if($call_list['total_calls']>0){
        $res_arr['total_calls'] = $call_list['total_calls'];
        $res_arr['call_duration'] = (gmdate("H", $call_list['call_duration'])+0)."<br>"."Hours";
        if($res_arr['call_duration']==0){
            $res_arr['call_duration'] = (gmdate("i", $call_list['call_duration'])+0)."<br>"."Minutes";
            if($res_arr['call_duration']==0){
                $res_arr['call_duration'] = (gmdate("s", $call_list['call_duration'])+0)."<br>"."Seconds";
            }
        }
        if ($_REQUEST['ddlDateRange'] == "ALL_TIME") {
            $now  = (strtotime($call_list['max_date'])+86400); // or your date as well
            $your_date = strtotime($call_list['min_date']);
        }else{
            $now  = (strtotime($fil_to_date)+86400); //Min. 1 day diff for selected date
            $your_date = strtotime($fil_from_date);
        }
        $datediff = $now - $your_date;
        $res_arr['days'] = floor($datediff/(60*60*24));
    }else{
        $res_arr['total_calls'] = 0;
        $res_arr['call_duration'] = 0;
        $res_arr['days'] = 0;
    }
    json_die(true, $res_arr);
    die;
}
if(isset($_REQUEST['load_detail']) && $_REQUEST['load_detail']==1){
    $start_limit = $_REQUEST['hidLastRecord'];
    $call_list = q("SELECT * FROM `call_detail` cd WHERE 1=1 {$where} order by cd.deal_id desc limit {$start_limit},{$page_size}");
    //sleep(1);
    
    include _PATH.'instance/front/tpl/call_report_data.php';
    die;
}
include _PATH.'instance/front/controller/updateDeal.inc.php'; //Update Deal which is not handled by any agents
$call_list = q("SELECT * FROM `call_detail` cd WHERE 1=1 {$where} order by cd.deal_id desc limit {$start_limit},{$page_size}");

if(!isset($_SESSION['pipedrive_source'])){
    $_SESSION['pipedrive_source'] = User::getSources();
}

$jsInclude = "call_report.js.php";
_cg("page_title", "Call Report");
?>