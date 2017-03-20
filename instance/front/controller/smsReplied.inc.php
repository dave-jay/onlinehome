<?php

//Test Mode - Live Server Comment following 2 line.
//$_REQUEST['From']="+918460422312";
//$_REQUEST['Body']="Test Static Data";
$apiPD = new apiPipeDrive();

$phone_value = urldecode($_REQUEST['From']);
$phone_value = last10Char($phone_value);


$payload = file_get_contents('php://input');


$activity_data = qs("select * from sms_sequence where last10phone like '%{$phone_value}%' order by id desc");
qi('test', array('payload' => $payload, 't' => "test payload. From" . $_REQUEST['From']));
if (isset($activity_data)) {
    $replied_for = getSMSReply($activity_data);
    qu("sms_sequence", array($replied_for['next_seq'] => "1"), "id='{$activity_data['id']}'");
    $fields['subject'] = 'Replied By Customer';
    $fields['done'] = '1';
    $fields['type'] = 'text';
    $fields['deal_id'] = $activity_data['last_deal_id']; // Test Deal Id - $fields['deal_id'] = '4586';        
    $fields['note'] = _escape(urldecode($_REQUEST['Body']));
    //$data = $apiPD->createActivity($fields);
    
    $note_data['deal_id'] = $activity_data['last_deal_id'];
    $note_data['content'] = "Text replied by client from {$_REQUEST['From']}.<br><br>Reply: {$_REQUEST['Body']}";
    $data = $apiPD->createNote(_escapeArray($note_data));
    
    qi('test', array('payload' => $data, 't' => 'note added in deal'));
} else {
    $activity_data = qs("select * from activity_log where phone_last10 like '%{$phone_value}%' order by id desc");
    if (isset($activity_data)) {
        $fields['subject'] = 'SMS - Replied By Customer';
        $fields['done'] = '1';
        $fields['type'] = 'text';
        $fields['deal_id'] = $activity_data['deal_id']; // Test Deal Id - $fields['deal_id'] = '4586';
        $fields['person_id'] = $activity_data['person_id'];
        $fields['org_id'] = $activity_data['org_id'];
        $fields['note'] = _escape(urldecode($_REQUEST['Body']));
        $data = $apiPD->createActivity($fields);
        qi('test', array('payload' => $data, 't' => 'note added in the deal.'));
    } else {
        qi('test', array('payload' => $payload, 't' => "3"));
    }
}
qi('test', array('payload' => $payload, 't' => $_REQUEST['From']));



die;
?>