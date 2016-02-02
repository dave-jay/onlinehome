<?php

if (isset($_REQUEST['call_detail_id']) && $_REQUEST['call_detail_id'] != '') {
    //$call_detail_array = explode("|",$_REQUEST['call_detail_id']);
    $call_data = qs("select * from call_detail where id='{$_REQUEST['call_detail_id']}'");
    echo "<!DOCTYPE html>";
    echo "<html>";
    echo "<body style='padding:10px;'>";
    echo "<div style='padding: 10px; font-family: verdana; font-size: 14px;'>Inbound Call - ";
    //echo ($call_data['recording_duration'] == 0 ? '00:00:00' : (gmdate("H:i:s", $call_data['recording_duration'])));
    echo ((gmdate("H:i:s", $call_data['recording_duration'])));
    echo "</div>";
    if (isset($call_data['recording_url']) && $call_data['recording_url'] != '') {

        echo '<audio controls>';
        echo '<source src="' . $call_data['recording_url'] . '" type="audio/mpeg">';
        echo 'Your browser does not support the audio element.';
        echo '</audio>';
    } elseif($call_data['status']=='busy') {
        echo "<div style='color:red;'>Customer was busy at that moment!</div>";
    }
    elseif($call_data['status']=='no-answer') {
        echo "<div style='color:red;'>No Answer of the Call!</div>";
    }
    elseif($call_data['status']=='running') {
        echo "<div style='color:green;'>Call is running at this moment!</div>";
    }
    elseif($call_data['status']=='in-progress') {
        echo "<div style='color:green;'>Call is in-progress!</div>";
    }
    else{
        echo "<div style='color:red;'>No Recording Found!</div>";
    }
    echo "</body>";
    echo "</html>";
}

die;

//echo <audio controls = ""><source src = "https://api.twilio.com/2010-04-01/Accounts/".ACCOUNT_SID"./Recordings/RE338a2c7e3153c26600a45d42c6c4b358" type = "audio/mpeg">Your browser does not support the audio element.</audio>
?>