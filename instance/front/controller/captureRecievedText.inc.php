<?php

$conv_fields = array();
$conv_fields['message_id'] = isset($_REQUEST['id'])?$_REQUEST['id']:'';
$conv_fields['text'] = isset($_REQUEST['text'])?_escape($_REQUEST['text']):'';

$conv_fields['sender'] = isset($_REQUEST['sender'])?$_REQUEST['sender']:'';
$conv_fields['sender_last10'] = isset($_REQUEST['sender'])?last10Char($_REQUEST['sender']):'';

$last_conv = qs("select * from text_conversation where receiver_last10='{$conv_fields['sender_last10']}' order by id desc limit 0,1");
$conv_fields['deal_id'] = isset($last_conv['deal_id'])?$last_conv['deal_id']:"-";

$conv_fields['type'] = 'RECEIVED';
$conv_fields['messageTime'] = _mysqlDate();
$conv_fields['receiver'] = isset($_REQUEST['receiver'])?$_REQUEST['receiver']:'';
$conv_fields['receiver_last10'] = isset($_REQUEST['receiver'])?last10Char($_REQUEST['receiver']):'';

qi("text_conversation", $conv_fields);

die;
?>