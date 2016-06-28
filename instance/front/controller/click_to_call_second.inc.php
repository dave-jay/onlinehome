<?php
//d($_REQUEST);
$urlArgs = _cg("url_vars");
$click_to_call_id = $urlArgs[0];

$recording_url = (isset($_REQUEST['RecordingUrl'])?$_REQUEST['RecordingUrl']:'');
$recording_duration = (isset($_REQUEST['RecordingDuration'])?$_REQUEST['RecordingDuration']:'0');

$fields['recording_url'] = $recording_url;
$fields['recording_duration'] = $recording_duration;
qu("click_to_call",$fields,"id='{$click_to_call_id}'");
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<Response></Response>";
?><?php die; ?>