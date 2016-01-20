<?php
$agent_numbers = explode(',', $_REQUEST['agent_numbers']);
$dealId = _e($_REQUEST['dealId'], 0);
$phone_value = urlencode($_REQUEST['phone_value']);
$cur_agent = $_REQUEST['cur_agent'];
$agent = qs("select pd_id,name from pd_users where phone = '{$cur_agent}'");

$agent_id = $agent['pd_id'];
$agent_name = $agent['name'];

////Assign Deal to Agent before calling to customer
$apiPD = new apiPipeDrive();
$apiPD->assignDeal($dealId, $agent_id);

header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Say>Connecting to customer!</Say>    
    <Dial record="record-from-answer" action="<?php print _U; ?>RecordCallBack/<?php print $cur_agent; ?>/<?php print $dealId; ?>/<?php print $phone_value; ?>/<?php print $cur_agent; ?>" >        
        <Number statusCallbackEvent="answered"
                statusCallback="<?php print _U; ?>AgentCallLog/<?php print $cur_agent; ?>/<?php print $dealId; ?>/<?php print $phone_value; ?>/<?php print $cur_agent; ?>"
                statusCallbackMethod="POST"><?php print $phone_value; ?></Number>
    </Dial>        
</Response><?php die; ?>