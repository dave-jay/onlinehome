<?php

$conv_fields = array();
$conv_fields['message_id'] = $_REQUEST['message_id'];
$conv_fields['price'] = $_REQUEST['credits_cost'];
$conv_fields['status'] = $_REQUEST['status'];

sleep(10); // To Remove Duplicate Entry Sleep Is Required - Conversation List Page Also inserting Same Record;
$text_conv_list = q("select id from text_conversation where message_id='{$_REQUEST['message_id']}'");
if (count($text_conv_list) == 0) {
    qi("text_conversation", $conv_fields);
} else {
    qu("text_conversation", $conv_fields, "message_id='{$_REQUEST['message_id']}'");
}

die;
?>