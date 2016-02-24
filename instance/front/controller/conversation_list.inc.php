<?php
if (isset($_REQUEST['sendMessage'])) {
    include _PATH . "/TextMagic/TextMagicAPI.php";
    $api = new TextMagicAPI(array(
        "username" => "davejay",
        "password" => "uUXgZoOkpG"
    ));

    $text = _escape($_REQUEST['txtMessage']);

    $phones = array($_REQUEST['ddlPhone']);
    $results = $api->send($text, $phones, true);
    $messageId = '';
    $phone = '';
    if (isset($results['messages'])) {
        foreach ($results['messages'] as $key => $value) {
            $messageId = $key;
            $phone = $value;
        }
        $conv_fields = array();
        $conv_fields['deal_id'] = $_REQUEST['hidDealId'];
        $conv_fields['message_id'] = $messageId;
        $conv_fields['receiver'] = $phone;
        $conv_fields['receiver_last10'] = last10Char($phone);
        $conv_fields['type'] = 'SENT';
        $conv_fields['text'] = $results['sent_text'];
        $conv_fields['messageTime'] = _mysqlDate();
        $text_conv_list = q("select id from text_conversation where message_id='{$messageId}'");
        if (count($text_conv_list) == 0) {
            qi("text_conversation", $conv_fields);
        } else {
            qu("text_conversation", $conv_fields, "message_id='{$messageId}'");
        }
    }
    echo "success";
    die;
}
if (isset($_REQUEST['conv_list'])) {
    $dealId = $_REQUEST['dealId'];
    $conversation_list = q("select * from text_conversation where deal_id='{$dealId}' order by messageTime asc");
    include _PATH.'instance/front/tpl/conversation_list_data.php';
    die;
}
$dealId = $_REQUEST['dealId'];
$phone_count = $_REQUEST['phone_count'];
$contact_list = array();
for ($index = 1; $index <= $phone_count; $index++) {
    $contact_list[] = removeCellFormat($_REQUEST['phone_' . $index]);
}


$conversation_list = q("select * from text_conversation where deal_id='{$dealId}' order by messageTime asc");
$no_visible_elements = TRUE;
_cg("page_title", "Conversation");
$jsInclude = "conversation_list.js.php";
?>