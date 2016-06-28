<?php

$agent_numbers = $_REQUEST['agent_number'];
$dealId = _e($_REQUEST['dealId'], '0');
$phone_value = urlencode($_REQUEST['phone_value']);
$click_to_call_id = urlencode($_REQUEST['click_to_call_id']);
header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    ?>

<Response>   
    <Say>We are connecting with customer.</Say>
    <Dial timeout="10" record="record-from-answer" action="<?php print _U; ?>click_to_call_second/<?php print $click_to_call_id; ?>"><?= $phone_value; ?></Dial>
</Response>
<?php
die;
?>