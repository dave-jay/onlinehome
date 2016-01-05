<?php
$agent_numbers = explode(',', $_REQUEST['agent_numbers']);
$dealId = _e($_REQUEST['dealId'], 0);
$phone_value = $_REQUEST['phone_value'];
$cur_agent = $_REQUEST['cur_agent'];

header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
// <Dial>+18774942065</Dial>
?>
<Response>
	<Say>Thank you Wayne. Connecting to customer!</Say>
    <Dial>        
        <Number statusCallbackEvent="answered"
                statusCallback="http://s606346885.onlinehome.us/AgentCallLog/<?php print $cur_agent; ?>/<?php print $dealId; ?>/<?php print $phone_value; ?>/<?php print $cur_agent; ?>"
                statusCallbackMethod="POST"><?php print $phone_value; ?></Number>
    </Dial>
</Response><?php die; ?>